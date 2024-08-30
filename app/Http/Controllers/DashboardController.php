<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Call;
use App\Models\Contact;
use App\Models\Opportunity;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{

    public function tags($refresh = false)
    {
        $location_id = auth()->user()->location_id;
        $cacheKey = 'ghl_tags_' . $location_id;

        if ($refresh || !Cache::has($cacheKey)) {
            $tags = ghl_api_call('tags');
            $tags = json_decode($tags, true);

            if ($tags && isset($tags['tags'])) {
                Cache::put($cacheKey, $tags['tags'], now()->addDays(3));
                return $tags['tags'];
            }

            return [];
        }
        return Cache::get($cacheKey);
    }

    public function users($locid = null, $refresh = false)
    {

        if (is_null($locid)) {
            $location_id = auth()->user()->location_id;
        } else {
            $location_id = $locid;
        }
        $user = User::where('location_id', $location_id)->first();
        $cacheKey = 'ghl_users_' . $location_id;
        if ($refresh || !Cache::has($cacheKey)) {

            $users = ghl_api_call('users/', $user->id);
            $users = json_decode($users, true);

            if ($users && isset($users['users'])) {
                Cache::put($cacheKey, $users['users'], now()->addDays(3));

                return $users['users'];
            }

            return [];
        }

        return Cache::get($cacheKey);
    }

    public function contacts($locid = null, $filters = null)
    {
        if (is_null($locid)) {
            $location_id = auth()->user()->location_id;
        } else {
            $location_id = $locid;
        }
        $contacts = Contact::where('location_id', $location_id)->get();
        return $contacts;
    }

    public function groupContactsBasedOnAssgined($contacts, $users)
    {
        $grouped_contacts = [];
        foreach ($users as $user) {
            $grouped_contacts[$user['name']] = array_filter($contacts, function ($contact) use ($user) {
                return $contact['assigned_to'] == $user['id'];
            });
        }
        return $grouped_contacts;
    }

    public function dayWiseContactsCounts($contacts)
    {
        $daywise_contacts = [];
        foreach ($contacts as $contact) {
            $date = new DateTime($contact['date_added']);
            $day = $date->format('Y-m-d');
            if (isset($daywise_contacts[$day])) {
                $daywise_contacts[$day] += 1;
            } else {
                $daywise_contacts[$day] = 1;
            }
        }
        return $daywise_contacts;
    }

    public function groupContactsBasedOnTags($contacts, $tags)
    {
        $grouped_contacts = [];
        foreach ($tags as $tag) {
            $tagname = $tag['name'] ?? '';
            $grouped_contacts[$tagname] = array_filter($contacts, function ($contact) use ($tagname) {
                $contact['tags'] = makeTagsArray($contact['tags']);
                return in_array($tagname, $contact['tags']);
            });
        }
        return $grouped_contacts;
    }

    public function groupByCountries($contacts)
    {
        // Filter out contacts where the country is null
        $filteredContacts = array_filter($contacts, fn($contact) => !is_null($contact['country']));
        return array_map(
            fn($key, $value) => ['id' => $key, 'leads' => $value],
            array_keys($data = array_count_values(array_column($filteredContacts, 'country'))),
            $data
        );
    }

    public function contactsStats($users = [], $tags = [], $all_contacts = false)
    {

        if (!$all_contacts) {
            $all_contacts = $this->contacts();
            $all_contacts = $all_contacts->toArray();
        }

        $datewise_contacts = $this->dayWiseContactsCounts($all_contacts);
        $grouped_contacts = $this->groupContactsBasedOnAssgined($all_contacts, $users);
        $grouped_contacts_by_tags = $this->groupContactsBasedOnTags($all_contacts, $tags);
        $total_contacts = count($all_contacts);
        $group_by_countries = $this->groupByCountries($all_contacts);

        return [
            'datewise_contacts' => $datewise_contacts,
            'grouped_contacts' => $grouped_contacts,
            'grouped_contacts_by_tags' => $grouped_contacts_by_tags,
            'group_by_countries' => $group_by_countries,
            'total_contacts' => $total_contacts,
        ];

    }

    public function opportunities(Request $request)
    {
        if ($request->has('location_id') && !empty($request->location_id)) {
            $location_id = $request->location_id;
        } else {
            $location_id = auth()->user()->location_id;
        }
        $query = Opportunity::where('location_id', $location_id);
        if ($request->has('user') && !empty($request->user)) {
            $query->where('assigned_to', $request->user);
        }
        if ($request->has('dateRange') && !empty($request->dateRange)) {
            $dateRange = explode('-', $request->dateRange);
            $startDate = Carbon::parse(trim($dateRange[0]))->format('Y-m-d');
            $endDate = Carbon::parse(trim($dateRange[1]))->format('Y-m-d');
            if ($startDate && $endDate) {
                $query->whereBetween(DB::raw("DATE_FORMAT(date_added, '%Y-%m-%d')"), [$startDate, $endDate]);
            }
        }
        $opportunities = $query->get();
        return $opportunities;
    }

    public function pipelines($req)
    {
        //based on cache
        if ($req->has('location_id') && !empty($req->location_id)) {
            $location_id = $req->location_id;
        } else {
            $location_id = auth()->user()->location_id;
        }
        $cacheKey = 'ghl_pipelines_' . $location_id;
        $user = User::where('location_id', $location_id)->first();
        if (!Cache::has($cacheKey)) {
            $pipelines = ghl_api_call('opportunities/pipelines', $user->id);
            $pipelines = json_decode($pipelines, true);

            if ($pipelines && isset($pipelines['pipelines'])) {
                Cache::put($cacheKey, $pipelines, now()->addDays(3));
                return $pipelines;
            }

            return [];
        }
        return Cache::get($cacheKey);

    }

    public function groupByPiplinesAndStage1($opportunities, $pipelines)
    {

        $groupByPipes = array_group_by($opportunities, 'pipeline_id');
        $pipelines = $pipelines['pipelines'];
        // dd($pipelines);
        $pipelineswise = [];
        $pipelines = array_column($pipelines, 'name', 'id');
        foreach ($groupByPipes as $pipe_id => $pipe_opps) {
            $pipe_name = $pipelines[$pipe_id];
            $pipelineswise[$pipe_name] = $pipe_opps;
        }

        // dd($pipelineswise);
    }

    public function groupByPipelinesAndStages($opportunities, $pipelines)
    {
        // Group opportunities by pipeline ID
        $groupByPipes = array_group_by($opportunities, 'pipeline_id');

        // Extract pipeline names and stages
        $pipelineData = $pipelines['pipelines'];
        $pipelineNames = array_column($pipelineData, 'name', 'id');
        $stageNames = [];
        foreach ($pipelineData as $pipeline) {
            foreach ($pipeline['stages'] as $stage) {
                $stageNames[$stage['id']] = $stage['name'];
            }
        }

        $pipelinesWise = [];

        foreach ($groupByPipes as $pipe_id => $pipe_opps) {
            if (array_key_exists($pipe_id, $pipelineNames)) {
                $pipe_name = $pipelineNames[$pipe_id];
                $stageWise = array_group_by($pipe_opps, 'pipeline_stage_id');

                foreach ($stageWise as $stage_id => $stage_opps) {
                    $stage_name = $stageNames[$stage_id] ?? 'Unknown Stage';
                    $pipelinesWise[$pipe_name][$stage_name] = count($stage_opps);
                }
            }

        }

        return $pipelinesWise;
    }

    public function monetaryValueDistribution($opportunities)
    {
        //based on each status like won, lost, open, abandoned etc we will calculate the potential value of the opportunities and then show how much is converted (won) and how much is lost in day wise manner
        $revenue = [];
        $lost = [];
        $expected = [];

        // Process data
        foreach ($opportunities as $item) {
            $date = date('Y-m-d', strtotime($item['date_added']));
            $value = $item['monetary_value'] ? (float) $item['monetary_value'] : 0;

            if (!isset($revenue[$date])) {
                $revenue[$date] = 0;
            }

            if (!isset($lost[$date])) {
                $lost[$date] = 0;
            }

            if (!isset($expected[$date])) {
                $expected[$date] = 0;
            }

            if ($item['status'] === 'won') {
                $revenue[$date] += $value;
            } elseif ($item['status'] === 'lost') {
                $lost[$date] += $value;
            } else {
                $expected[$date] += $value;
            }
        }

        // Convert to arrays for charting
        $dates = array_keys($revenue + $lost + $expected);
        $revenue_values = array_map(fn($d) => $revenue[$d] ?? 0, $dates);
        $lost_values = array_map(fn($d) => $lost[$d] ?? 0, $dates);
        $expected_values = array_map(fn($d) => $expected[$d] ?? 0, $dates);

        $arr = [
            'dates' => $dates,
            'revenue' => $revenue_values,
            'lost' => $lost_values,
            'expected' => $expected_values,
        ];

        return $arr;

    }

    public function leadToSale($contacts, $opportunities)
    {
        // from how many contacts are in the opportunities that have status won
        $contacts = !is_array($contacts) ? $contacts->toArray() : $contacts;
        $contacts = array_column($contacts, 'ghl_contact_id');

        $opportunities = array_filter($opportunities, function ($opportunity) use ($contacts) {
            return in_array($opportunity['contact_id'], $contacts) && $opportunity['status'] == 'won';
        });

        //conversion rate formate
        $conversion_rate = (count($opportunities) / 100) * count($contacts);

        $arr = [
            'contacts' => count($contacts),
            'won' => count($opportunities),
            'conversion_rate' => $conversion_rate,
        ];

        return $arr;

    }

    public function appointments(Request $request)
    {
        $query = Appointment::where('location_id', auth()->user()->location_id);
        if ($request->has('user') && !empty($request->user)) {
            $query->where('assigned_user_id', $request->user);
        }
        if ($request->has('dateRange') && !empty($request->dateRange)) {
            $dateRange = explode('-', $request->dateRange);
            $startDate = Carbon::parse(trim($dateRange[0]))->format('Y-m-d');
            $endDate = Carbon::parse(trim($dateRange[1]))->format('Y-m-d');
            if ($startDate && $endDate) {
                $query->whereBetween(DB::raw("DATE_FORMAT(date_added, '%Y-%m-%d')"), [$startDate, $endDate]);
            }
        }

        $appointments = $query->get();

        return $appointments;
    }

    public function opportunityStats($users = [], $moreElem = false, $req)
    {

        $opportunities = $this->opportunities($req);
        $opportunities = $opportunities->toArray();

        $opportunities_assigned_per_user = [];

        foreach ($users as $user) {
            $key = $moreElem ? $user['name'] . '-' . $user['email'] . ')' : $user['name'];
            $opportunities_assigned_per_user[$key] = array_filter($opportunities, function ($opportunity) use ($user) {
                return $opportunity['assigned_to'] == $user['id'];
            });
        }

        //group by dates
        $dayWiseContactsCounts = [];
        foreach ($opportunities as $opportunity) {
            $date = new DateTime($opportunity['date_added']);
            $day = $date->format('Y-m-d');
            if (isset($dayWiseContactsCounts[$day])) {
                $dayWiseContactsCounts[$day] += 1;
            } else {
                $dayWiseContactsCounts[$day] = 1;
            }
        }

        //group by status
        $opportunities_by_status = [];
        foreach ($opportunities as $opportunity) {
            $status = $opportunity['status'];
            if (isset($opportunities_by_status[$status])) {
                $opportunities_by_status[$status] += 1;
            } else {
                $opportunities_by_status[$status] = 1;
            }
        }

        //group by monetary value
        $monetary_value_distribution = $this->monetaryValueDistribution($opportunities);
        $pipelineswise = $this->groupByPipelinesAndStages($opportunities, $this->pipelines($req));

        //group by source
        $opportunities_by_source = [];
        foreach ($opportunities as $opportunity) {
            $source = $opportunity['source'];
            if (isset($opportunities_by_source[$source])) {
                $opportunities_by_source[$source] += 1;
            } else {
                $opportunities_by_source[$source] = 1;
            }
        }

        $total_opportunities = count($opportunities);

        //lead to sale conversions
        $contacts = $this->contacts();
        $lead_to_sale = $this->leadToSale($contacts, $opportunities);

        return [
            'total_opportunities' => $total_opportunities,
            'opportunities_by_status' => $opportunities_by_status,
            'monetary_value_distribution' => $monetary_value_distribution,
            'pipelineswise' => $pipelineswise,
            'opportunities_by_source' => $opportunities_by_source,
            'opportunities_assigned_per_user' => $opportunities_assigned_per_user,
            'daywise_count' => $dayWiseContactsCounts,
            'lead_to_sale' => $lead_to_sale,
        ];

    }

    public function calendars($req)
    {
        if ($req->has('location_id') && !empty($req->location_id)) {
            $location_id = $req->location_id;
        } else {
            $location_id = auth()->user()->location_id;
        }
        $cacheKey = 'ghl_calendars_' . $location_id;
        $user = User::where('location_id', $location_id)->first();
        // dd(Cache::get('ghl_calendars_' . $location_id));
        if (!Cache::has($cacheKey)) {
            $calendars = ghl_api_call('calendars', $user->id);
            $calendars = json_decode($calendars, true);

            if ($calendars && isset($calendars['calendars'])) {
                Cache::put($cacheKey, $calendars, now()->addDays(3));
                return $calendars;
            }

            return [];
        }
        return Cache::get($cacheKey);
    }

    public function appointmentStats($users)
    {

        //daywise appointments,  appointments by status, appointments by source, appointments by assigned to

        $appointments = $this->appointments();
        $appointments = $appointments->toArray();

        $appointments_assigned_per_user = [];

        foreach ($users as $user) {
            $appointments_assigned_per_user[$user['name']] = array_filter($appointments, function ($appointment) use ($user) {
                return $appointment['assigned_user_id'] == $user['id'];
            });
        }

        //daywise appointments
        $dayWiseAppointmentsCounts = [];
        foreach ($appointments as $appointment) {
            $date = new DateTime($appointment['date_added']);
            $day = $date->format('Y-m-d');
            if (isset($dayWiseAppointmentsCounts[$day])) {
                $dayWiseAppointmentsCounts[$day] += 1;
            } else {
                $dayWiseAppointmentsCounts[$day] = 1;
            }
        }

        //group by status
        $appointments_by_status = [];
        foreach ($appointments as $appointment) {
            $status = $appointment['appointment_status'];
            if (isset($appointments_by_status[$status])) {
                $appointments_by_status[$status] += 1;
            } else {
                $appointments_by_status[$status] = 1;
            }
        }

        //group by source
        $appointments_by_source = [];
        foreach ($appointments as $appointment) {
            $source = $appointment['source'];
            if (isset($appointments_by_source[$source])) {
                $appointments_by_source[$source] += 1;
            } else {
                $appointments_by_source[$source] = 1;
            }
        }

        $total_appointments = count($appointments);

        //total appointment based on calendars
        $calendars = $this->calendars();

        $appointments_by_calendars = [];
        foreach ($calendars['calendars'] as $calendar) {
            $appointments_by_calendars[$calendar['name']] = array_filter($appointments, function ($appointment) use ($calendar) {
                return $appointment['calendar_id'] == $calendar['id'];
            });
        }

        return [
            'total_appointments' => $total_appointments,
            'appointments_by_status' => $appointments_by_status,
            'appointments_by_source' => $appointments_by_source,
            'appointments_assigned_per_user' => $appointments_assigned_per_user,
            'daywise_count' => $dayWiseAppointmentsCounts,
            'appointments_by_calendars' => $appointments_by_calendars,
        ];

    }
    public function calls($request)
    {
        if ($request->has('location_id') && !empty($request->location_id)) {
            $location_id = $request->location_id;
        } else {
            $location_id = auth()->user()->location_id;
        }
        $query = Call::where('location_id', $location_id);
        // if ($request->has('user') && !empty($request->user)) {
        //     $query->where('assigned_to', $request->user);
        // }
        if ($request->has('dateRange') && !empty($request->dateRange)) {
            $dateRange = explode('-', $request->dateRange);
            $startDate = Carbon::parse(trim($dateRange[0]))->format('Y-m-d');
            $endDate = Carbon::parse(trim($dateRange[1]))->format('Y-m-d');
            if ($startDate && $endDate) {
                $query->whereBetween(DB::raw("DATE_FORMAT(date_added, '%Y-%m-%d')"), [$startDate, $endDate]);
            }
        }
        $calls = $query->get();
        $calls = $calls->toArray();
        return $calls;

    }
    public function callStats()
    {
        $calls = Call::where('location_id', auth()->user()->location_id)->get();
        $calls = $calls->toArray();
        $dayWiseCallsCounts = [];
        foreach ($calls as $call) {
            $date = new DateTime($call['date_added']);
            $day = $date->format('Y-m-d');
            if (isset($dayWiseCallsCounts[$day])) {
                $dayWiseCallsCounts[$day] += 1;
            } else {
                $dayWiseCallsCounts[$day] = 1;
            }
        }

        $total_calls = count($calls);

        //leads to calls conversion
        $contacts = $this->contacts();
        $contacts = $contacts->toArray();
        $contacts = array_column($contacts, 'ghl_contact_id');

        $calls = array_filter($calls, function ($call) use ($contacts) {
            return in_array($call['contact_id'], $contacts);
        });

        return [
            'total_calls' => $total_calls,
            'daywise_count' => $dayWiseCallsCounts,
        ];
    }

    public function topStats($users, $tags, $req, $contacts = null, $opportunities = null)
    {

        if (is_null($contacts)) {
            $contacts = $this->contacts()->toArray();
        }

        $contactsfor_country = $contacts;
        $agencies = 0;
        $leads = 0;
        $recruitment = 0;
        $no_tags = 0;
        $sollicitants = 0;

        // Custom tags to show on the dashboard
        $custom_tags = ['agency', 'recruitment', 'vacature', 'leads'];

        // Group contacts by tags
        $grouped_contacts = [];

        foreach ($custom_tags as $tagname) {
            $grouped_contacts[$tagname] = array_filter($contacts, function ($contact) use ($tagname, &$no_tags) {
                if (empty($contact['tags'])) {
                    $no_tags += 1;
                }
                $contact_tags = makeTagsArray($contact['tags'] ?? []);
                return in_array($tagname, $contact_tags);
            });

            // Increment counters based on tag
            if ($tagname === 'agency') {
                $agencies = count($grouped_contacts[$tagname]);
            } elseif ($tagname === 'recruitment') {
                $recruitment = count($grouped_contacts[$tagname]);
            } elseif ($tagname === 'vacature') {
                $sollicitants = count($grouped_contacts[$tagname]);
            } elseif ($tagname === 'leads') {
                $leads = count($grouped_contacts[$tagname]);
            }
        }

        // Return  stats
        $contacts = [
            'total_contacts' => count($contacts),
            'agencies' => $agencies,
            'leads' => $leads,
            'recruitment' => $recruitment,
            'no_tags' => $no_tags,
            'sollicitants' => $sollicitants,
        ];

        arsort($contacts);
        // Filter opportunities for the current month
        if ($opportunities == null) {
            $opportunities = $this->opportunities($req)->toArray();
        }
        $currentMonth = date('Y-m');

        $data_year = array_group_by($opportunities, function ($item) {
            return date('Y', strtotime($item['date_added']));
        });

        $data_year_counts = array_map(function ($items) {
            return count($items);
        }, $data_year);

        // dd($data_year_counts);

        $opportunities = array_filter($opportunities, function ($opportunity) use ($currentMonth) {
            $dateAdded = new DateTime($opportunity['date_added']);
            $opportunityMonth = $dateAdded->format('Y-m');
            return ($opportunityMonth === $currentMonth);
        });

        // Calculate day-wise contact counts
        $dayWiseContactsCounts = [];
        foreach ($opportunities as $opportunity) {
            $date = new DateTime($opportunity['date_added']);
            $day = $date->format('Y-m-d');
            if (isset($dayWiseContactsCounts[$day])) {
                $dayWiseContactsCounts[$day] += 1;
            } else {
                $dayWiseContactsCounts[$day] = 1;
            }
        }

        // Calculate total sales and unique days with sales
        $totalSales = count($opportunities);
        $daysWithSales = count($dayWiseContactsCounts);

        // Calculate the average daily sales percentage
        $dayWiseSalesPercentages = [];
        foreach ($dayWiseContactsCounts as $day => $count) {
            $dayWiseSalesPercentages[$day] = round(($count / $totalSales) * 100, 1);
        }

        // dd($data_year_counts);

        // Find the day with the highest sales percentage
        $maxSalesDay = 0;
        if (count($dayWiseSalesPercentages) > 0) {
            $maxSalesDay = array_keys($dayWiseSalesPercentages, max($dayWiseSalesPercentages))[0];
        }

        // // Prepare the final output
        // dd($data_year);
        $opps = [
            'total' => $totalSales,
            'won_opportunities' => $dayWiseContactsCounts,
            'year_wise_sale_count' => $data_year_counts,
            'daily_sales_percentages' => $dayWiseSalesPercentages,
            'highest_sales_percentage_day' => $maxSalesDay,
        ];
        $group_by_countries = $this->groupByCountries($contactsfor_country);

        $response = [
            'contacts' => $contacts,
            'sales' => $opps,
            'countrywise' => $group_by_countries,
        ];

        return $response;

    }
    public function locations($refresh = false)
    {
        $alllocations = [];
        $locations = User::whereHas('roles', function ($query) {
            $query->where('name', 'company');
        })->pluck('location_id', 'id')->toArray();

        foreach ($locations as $uid => $locid) {
            $cacheKey = 'ghl_location_' . $locid;
            if ($refresh || !Cache::has($cacheKey)) {
                $locationdetail = ghl_api_call('locations/' . $locid, $uid);
                $locationdetail = json_decode($locationdetail, true);
                if ($locationdetail && isset($locationdetail['location'])) {
                    Cache::put($cacheKey, $locationdetail['location'], now()->addDays(3));
                    $alllocations[] = $locationdetail['location'];
                }
            }
            $alllocations[] = Cache::get($cacheKey);
        }

        return $alllocations;
    }
    public function companyDashboard()
    {
        set_time_limit(3000000);
        $locations = User::whereHas('roles', function ($query) {
            $query->where('name', 'company');
        })->pluck('location_id')->toArray();

        $locations = $this->locations();

        $users = $this->users('0fu8c2Te17KqLDYyr8RE');

        // $tags = $this->tags();

        // $opportunities_stats = null;
        // $contact_stats = null;
        // $opportunities_stats = null;
        // $oppointment_stats = null;
        // $call_stats = null;
        // $assigned_per_user = $this->opportunityStats($users, true, $req);
        // if ($assigned_per_user) {
        //     $assigned_per_user = $assigned_per_user['opportunities_assigned_per_user'] ?? [];
        // }

        // // dd($assigned_per_user);

        // // if (is_connected()) {
        // //     $contact_stats = $this->contactsStats($users, $tags);
        // //     $opportunities_stats = $this->opportunityStats();
        // //     $oppointment_stats = $this->appointmentStats($users);
        // //     $call_stats = $this->callStats();
        // //     $response = ['contact_stats' => $contact_stats,
        // //         'opportunities_stats' => $opportunities_stats,
        // //         'oppointment_stats' => $oppointment_stats,
        // //         'call_stats' => $call_stats];
        // // }

        // $top_stats = $this->topStats($users, $tags, $req);
        // $cov_stats = $this->conversionStats($users, $req);
        // dd($top_stats);
        return view('companydashboard', get_defined_vars());

    }
    public function dashboard(Request $req)
    {set_time_limit(0);
        if (Auth::user()->hasRole('admin')) {
            $current_year = Carbon::now()->year;
            $permissions = Permission::all();
            $roles = Role::all();
            $users = User::role('company')->latest()->limit(5)->get();

            return view('dashboard-backup', get_defined_vars());
        } elseif (Auth::user()->hasRole('company')) {
            //dd(Cache::get('ghl_tags_0fu8c2Te17KqLDYyr8RE'),Cache::get('ghl_users_0fu8c2Te17KqLDYyr8RE'));
            $users = $this->users();
            $tags = $this->tags();

            $opportunities_stats = null;
            $contact_stats = null;
            $opportunities_stats = null;
            $oppointment_stats = null;
            $call_stats = null;

            $assigned_per_user = $this->opportunityStats($users, true, $req);
            if ($assigned_per_user) {
                $assigned_per_user = $assigned_per_user['opportunities_assigned_per_user'] ?? [];
            }

            // dd($assigned_per_user);

            // if (is_connected()) {
            //     $contact_stats = $this->contactsStats($users, $tags);
            //     $opportunities_stats = $this->opportunityStats();
            //     $oppointment_stats = $this->appointmentStats($users);
            //     $call_stats = $this->callStats();
            //     $response = ['contact_stats' => $contact_stats,
            //         'opportunities_stats' => $opportunities_stats,
            //         'oppointment_stats' => $oppointment_stats,
            //         'call_stats' => $call_stats];
            // }

            $top_stats = $this->topStats($users, $tags, $req);
            $cov_stats = $this->conversionStats($users, $req);
            //dd($top_stats, $cov_stats);
        }
        return view('dashboard', get_defined_vars());}

    public function calendarsGroups($req)
    {
        if ($req->has('location_id') && !empty($req->location_id)) {
            $location_id = $req->location_id;
        } else {
            $location_id = auth()->user()->location_id;
        }
        $cacheKey = 'ghl_calendars_groups_' . $location_id;
        $user = User::where('location_id', $location_id)->first();
        if (!Cache::has($cacheKey)) {
            $groups = ghl_api_call('calendars/groups', $user->id);
            $groups = json_decode($groups, true);

            if ($groups && isset($groups['groups'])) {
                Cache::put($cacheKey, $groups, now()->addDays(3));
                return $groups;
            }

            return [];
        }
        return Cache::get($cacheKey);
    }
    public function meetingCalenders($calendars, $groups)
    {

        $targetGroupId = null;
        foreach ($groups['groups'] as $group) {
            if ($group['name'] === "Gold Estates online meeting") {
                $targetGroupId = $group['id'];
                break;
            }
        }
        $result = [];
        if ($targetGroupId !== null) {

            foreach ($calendars['calendars'] as $calendar) {

                if (array_key_exists('groupId', $calendar) && $calendar['groupId'] === $targetGroupId) {
                    $result[] = [
                        $calendar['id'],
                        //'id' => $calendar['id'],
                        // 'name' => $calendar['name'],
                    ];
                }
            }
        }
        return $result;
    }
    public function getSpecificPipelines($req)
    {$data = $this->pipelines($req);
        $result = [];
        foreach ($data['pipelines'] as $pipeline) {
            foreach ($pipeline['stages'] as $stage) {
                if ($stage['name'] === "INFOTRIP") {
                    $result[] = [
                        $pipeline['id'],
                        //'id' => $pipeline['id'],
                        //'name' => $pipeline['name']
                    ];
                    break;
                }
            }
        }
        return $result;}
    public function conversionStats($users, $req, $contacts = null)
    {
        $leads = ['total' => 0, 'conversion_rate' => 0, 'direction' => 'up', 'direction_value' => 0];
        $calls = ['total' => 0, 'conversion_rate' => 0, 'direction' => 'up', 'direction_value' => 0];
        $online_meet = ['total' => 0, 'conversion_rate' => 0, 'direction' => 'up', 'direction_value' => 0];
        $in_person_meet = ['total' => 0, 'conversion_rate' => 0, 'direction' => 'down', 'direction_value' => 0];
        $viewing = ['total' => 0, 'conversion_rate' => 0, 'direction' => 'up', 'direction_value' => 0];
        $sale = ['total' => 0, 'conversion_rate' => 0, 'direction' => 'down', 'direction_value' => 0];
        if ($req->has('location_id') && !empty($req->location_id)) {
            $location_id = $req->location_id;
        } else {
            $location_id = auth()->user()->location_id;
        }
        //contacts
        $contactsCount = Contact::where('location_id',  $location_id)->count();
        $leads['total'] = $contactsCount;

        //calls
        $callsCount = Call::where('location_id',  $location_id)->count();
        $calls['total'] = $callsCount;
        $calls['conversion_rate'] = ($callsCount / $contactsCount) * 100;

        //appointments
        $appointments = Appointment::where('location_id',  $location_id)->get()->toArray();

        $groupId = '6rpl3KNEcQL36RHY2qag';
        $calendars = $this->calendars($req);

        //all calendars with group id
        $meetingCalendars = array_filter($calendars['calendars'], function ($calendar) use ($groupId) {
            if (isset($calendar['groupId']) && $calendar['groupId'] == $groupId) {
                return $calendar;
            }

        });

        //only exact names of the calendars
        $meetingCalendars = array_column($meetingCalendars, 'name', 'id');

        //get all appointments where calendar id is in the meetingCalendars
        $online_meetings = array_filter($appointments, function ($appointment) use ($meetingCalendars) {
            $calendarIds = array_keys($meetingCalendars);
            if (in_array($appointment['calendar_id'], $calendarIds)) {
                return $appointment;
            }

        });

        $online_meet['total'] = count($online_meetings);
        $online_meet['conversion_rate'] = ($online_meet['total'] / $contactsCount) * 100;

        //sale
        $opportunityCounts = Opportunity::where('location_id',  $location_id)
            ->selectRaw('COUNT(*) as total, SUM(status = "won") as won')
            ->first();

        $sale['total'] = $opportunityCounts->total;
        $sale['conversion_rate'] = ($opportunityCounts->won / $contactsCount) * 100;

        //in person meetings

        //viewing

        $cov_stats = [
            'leads' => $leads,
            'calls' => $calls,
            'online_meet' => $online_meet,
            'in_person_meet' => $in_person_meet,
            'viewing' => $viewing,
            'sale' => $sale,
        ];

        return $cov_stats;
    }
    public function conversionStats_old($users, $req, $contacts = null)
    {
        if (is_null($contacts)) {
            $contacts = $this->contacts()->toArray();
        }
        $opportunities = $this->opportunities($req)->toArray();
        $appointments = $this->appointments($req)->toArray();
        $calls = $this->calls($req);
        $calendars = $this->calendars($req);
        $groups = $this->calendarsGroups($req);

        $meetingcalenders = $this->meetingCalenders($calendars, $groups);
        $piplines = $this->getSpecificPipelines($req);
        $callscount = 0;
        foreach ($contacts as $contact) {
            foreach ($calls as $call) {
                if ($contact['ghl_contact_id'] == $call['contact_id']) {
                    $callscount++;
                }
            }

        }
        $appointmentCount = 0;
        foreach ($appointments as $appointment) {
            if (in_array($appointment['calendar_id'], $meetingcalenders)) {
                $appointmentCount++;
            }
        }
        $opportunitiesCount = 0;
        $opportunitiessold = 0;
        foreach ($opportunities as $oppo) {
            if (in_array($oppo['pipeline_id'], $piplines)) {
                $opportunitiesCount++;
            }
            if ($oppo['status'] == 'won') {
                $opportunitiessold++;
            }
        }

        $totalContacts = count($contacts);
        //Lead to sale Conversion
        $callsConversionRate = [
            'Total' => count($calls),
            'Percent' => $totalContacts > 0 ? round(($callscount / $totalContacts) * 100, 2) : 0,
            // 'Percent' => $totalContacts > 0 ? round(($callscount / $totalContacts) * 100, 2) : 0,
            'Message' => 'CALLS',
        ];
        // Appointments Conversion rate
        $appointmentsConversionRate = [
            'Total' => count($appointments),
            'Percent' => $totalContacts > 0 ? round(($appointmentCount / $totalContacts) * 100, 2) : 0,
            'Conversion' => $totalContacts > 0 ? $callscount > 0 ? round(($appointmentCount / $callscount) * 100, 2) : 0 : 0,
            'Message' => 'ONlINE MEET',
        ];

        // Opportunities Conversion rate
        $opportunitiesConversionRate = [
            'Total' => count($opportunities),
            'Percent' => $totalContacts > 0 ? round(($opportunitiesCount / $totalContacts) * 100, 2) : 0,
            'Conversion' => $totalContacts > 0 ? $appointmentCount > 0 ? round(($opportunitiesCount / $appointmentCount) * 100, 2) : 0 : 0,
            'Message' => 'IN PERSON MEET',
        ];

        // Lead Sale Conversion rate
        $leadsSaleConversionRate = [
            'Total' => count($opportunities),
            'Percent' => $totalContacts > 0 ? round(($opportunitiessold / $totalContacts) * 100, 2) : 0,
            'Conversion' => $totalContacts > 0 ? $opportunitiesCount > 0 ? round(($opportunitiessold / $opportunitiesCount) * 100, 2) : 0 : 0,
            'Message' => 'SALE',
        ];

        // Return stats
        $response = [
            'LEAD' => [
                'Total' => count($contacts),
                'Message' => 'LEAD',
            ],
            'CALLS' => $callsConversionRate,
            'ONlINE MEET' => $appointmentsConversionRate,
            'IN PERSON MEET' => $opportunitiesConversionRate,
            'SALE' => $leadsSaleConversionRate,
            'users' => count($users),
        ];

        return $response;
    }

    public function filterContacts_old(Request $request)
    {

        $all_contacts = $this->contacts();
        $all_contacts = $all_contacts->toArray();

        $whereClause = [];
        $founds = 0;
        if ($request->has('tag') && !empty($request->tag)) {
            $tag = $request->tag;
            $all_contacts = array_filter($all_contacts, function ($contact) use ($tag, &$founds) {
                $tagArr = makeTagsArray($contact['tags']);
                if (in_array($tag, $tagArr)) {
                    $founds++;
                    return true;
                }
            });
        }

        if ($request->has('user') && !empty($request->user)) {
            $assigned_to = $request->user;
            $all_contacts = array_filter($all_contacts, function ($contact) use ($assigned_to) {
                return $contact['assigned_to'] == $assigned_to;
            });
        }

        //date range with start and end and split with -
        if ($request->has('dateRange') && !empty($request->dateRange)) {
            $date_range = explode('-', $request->dateRange);
            $start_date = Carbon::parse(trim($date_range[0]))->format('Y-m-d');
            $end_date = Carbon::parse(trim($date_range[1]))->format('Y-m-d');

            $all_contacts = array_filter($all_contacts, function ($contact) use ($start_date, $end_date) {
                $date = Carbon::parse($contact['date_added'])->format('Y-m-d');
                return $date >= $start_date && $date <= $end_date;
            });
        }

        // dd($all_contacts);

        $users = $this->users();
        $tags = $this->tags();
        $opportunities = $this->opportunities($req)->toArray();
        $contact_stats = $this->contactsStats($users, $tags, $all_contacts);
        $opportunities_stats = $this->opportunityStats();
        $oppointment_stats = $this->appointmentStats($users);
        $call_stats = $this->callStats();
        $allowed_charts = $request->allowed_chart ?? [];

        $html = view('htmls.dash_stats', get_defined_vars())->render();
        return response()->json([
            'status' => 'success',
            'contact_stats' => $contact_stats,
            'opportunities_stats' => $opportunities_stats,
            'oppointment_stats' => $oppointment_stats,
            'call_stats' => $call_stats,
            'html' => $html,
        ]);

    }
    public function filterContacts(Request $request)
    {

        $all_contacts = $this->contacts();
        $all_contacts = $all_contacts->toArray();
        $opportunities = $this->opportunities($request);
        $opportunities = $opportunities->toArray();
        $whereClause = [];
        $founds = 0;
        if ($request->has('tag') && !empty($request->tag)) {
            $tag = $request->tag;
            $all_contacts = array_filter($all_contacts, function ($contact) use ($tag, &$founds) {
                $tagArr = makeTagsArray($contact['tags']);
                if (in_array($tag, $tagArr)) {
                    $founds++;
                    return true;
                }
            });
        }

        if ($request->has('user') && !empty($request->user)) {
            $assigned_to = $request->user;
            $all_contacts = array_filter($all_contacts, function ($contact) use ($assigned_to) {
                return $contact['assigned_to'] == $assigned_to;
            });
        }

        //date range with start and end and split with -
        if ($request->has('dateRange') && !empty($request->dateRange)) {
            $date_range = explode('-', $request->dateRange);
            $start_date = Carbon::parse(trim($date_range[0]))->format('Y-m-d');
            $end_date = Carbon::parse(trim($date_range[1]))->format('Y-m-d');

            $all_contacts = array_filter($all_contacts, function ($contact) use ($start_date, $end_date) {
                $date = Carbon::parse($contact['date_added'])->format('Y-m-d');
                return $date >= $start_date && $date <= $end_date;
            });
        }

        $users = $this->users();
        $tags = $this->tags();
        $top_stats = $this->topStats($users, $tags, $request, $all_contacts, $opportunities);
        $cov_stats = $this->conversionStats($users, $request, $all_contacts);
        $conversionhtml = view('components.conversion_card', compact('cov_stats'))->render();
        return response()->json([
            'status' => 'success',
            'top_stats' => $top_stats,
            'html' => $conversionhtml,
        ]);

    }
    public function filterLocations(Request $request)
    {set_time_limit(0);
        $locationid = $request->location_id;
        $all_contacts = $this->contacts($locationid);

        $all_contacts = $all_contacts->toArray();
        $opportunities = $this->opportunities($request);
        $opportunities = $opportunities->toArray();
        $whereClause = [];
        $founds = 0;
        if ($request->has('tag') && !empty($request->tag)) {
            $tag = $request->tag;
            $all_contacts = array_filter($all_contacts, function ($contact) use ($tag, &$founds) {
                $tagArr = makeTagsArray($contact['tags']);
                if (in_array($tag, $tagArr)) {
                    $founds++;
                    return true;
                }
            });
        }

        if ($request->has('user') && !empty($request->user)) {
            $assigned_to = $request->user;
            $all_contacts = array_filter($all_contacts, function ($contact) use ($assigned_to) {
                return $contact['assigned_to'] == $assigned_to;
            });
        }
        if ($request->has('location_id') && !empty($request->location_id)) {
            $location_id = $request->location_id;
            $all_contacts = array_filter($all_contacts, function ($contact) use ($location_id) {
                return $contact['location_id'] == $location_id;
            });
        }
        //date range with start and end and split with -
        if ($request->has('dateRange') && !empty($request->dateRange)) {
            $date_range = explode('-', $request->dateRange);
            $start_date = Carbon::parse(trim($date_range[0]))->format('Y-m-d');
            $end_date = Carbon::parse(trim($date_range[1]))->format('Y-m-d');

            $all_contacts = array_filter($all_contacts, function ($contact) use ($start_date, $end_date) {
                $date = Carbon::parse($contact['date_added'])->format('Y-m-d');
                return $date >= $start_date && $date <= $end_date;
            });
        }
        if ($request->has('location_id') && !empty($request->location_id)) {
            $users = $this->users($locationid);
        } else {
            $users = $this->users();
        }
        $tags = $this->tags();

        $top_stats = $this->topStats($users, $tags, $request, $all_contacts, $opportunities);
        $cov_stats = $this->conversionStats($users, $request, $all_contacts);
        $assigned_per_user = $this->opportunityStats($users, true, $request);
        if ($assigned_per_user) {
            $assigned_per_user = $assigned_per_user['opportunities_assigned_per_user'] ?? [];
        }

        $wholehtml = view('components.chartshtml', get_defined_vars())->render();
        return response()->json([
            'status' => 'success',
            'top_stats' => $top_stats,
            'html' => $wholehtml,
        ]);}
    public function parseDateRange($date_range)
    {
        [$start_date, $end_date] = explode('-', $date_range);
        return [
            Carbon::parse(trim($start_date))->format('Y-m-d'),
            Carbon::parse(trim($end_date))->format('Y-m-d'),
        ];
    }
    public function setting()
    {
        $ghl_users = [];
        // try{
        //     $ghl_users = ghl_api_call('users/');
        //     $ghl_users = json_decode($ghl_users->users,true);

        //     // if($ghl_users && property_exists($ghl_users,'users')){
        //     //     dd($ghl_users);
        //     //     $ghl_users = json_decode($ghl_users->users,true);

        //     // }
        // }catch(\Exception $e){

        // }
        //  dd($ghl_users);

        return view('setting', get_defined_vars());
    }

    public function settingSave(Request $req)
    {

        foreach ($req->except('_token') as $key => $value) {
            $setting = Setting::where(['name' => $key, 'user_id' => auth()->id()])->first() ?? new Setting;
            // dd( $req->hasFile($key) );
            if ($req->hasFile($key)) {

                $path = uploadFile($value, 'uploads/cms', $key . '-' . rand());
                $setting->name = $key;
                $setting->value = $path;
                $setting->user_id = auth()->id();
                //   dd($setting);
                $setting->save();
            } else {
                $setting->name = $key;
                $setting->value = $value;
                $setting->user_id = auth()->id();

                $setting->save();

            }
        }

        $msg = 'Settings Updated Successfully';
        return redirect()->back()->with('success', $msg);
    }

    public function userSettingSave(Request $req)
    {
        foreach ($req->except('_token') as $key => $value) {
            $setting = Setting::where(['name' => $key, 'user_id' => Auth::id()])->first() ?? new Setting;

            $setting->name = $key;
            $setting->value = is_array($value) ? json_encode($value) : $value;
            $setting->user_id = Auth::id();
            $setting->save();

        }

        $msg = 'Users Settings Updated Successfully';
        return redirect()->back()->with('success', $msg);
    }

    public function profile()
    {
        $user = Auth::user();
        return view('profile.userprofile', get_defined_vars());
    }
    public function general(Request $req)
    {
        $user = Auth::user();
        $req->validate([
            'email' => 'required|email',
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        $user->first_name = $req->first_name;
        $user->last_name = $req->last_name;
        $user->email = $req->email;
        if ($req->photo) {
            $user->photo = uploadFile($req->photo, 'uploads/profile', $req->first_name . '-' . $req->last_name . '-' . time());
        }
        $user->save();
        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function password(Request $req)
    {

        $user = Auth::user();
        $req->validate([
            'current_password' => 'required|password',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ]);
        $user->password = bcrypt($req->password);
        $user->save();

        return redirect()->back()->with('success', 'Password updated Successfully!');
    }
    public function importAppointments(Request $request)
    {

        set_time_limit(3000000);
        $chunk = $request->input('chunk');
        $chunkIndex = $request->input('chunkIndex');
        $totalChunks = $request->input('totalChunks');

        // Decode the chunk data
        $chunkData = json_decode($chunk, true);

        // dd($chunkData);
        $users = ghl_api_call('users/', 4);
        $users = json_decode($users, true);
        //$users = $this->users(true);
        //$calendars = $this->calendars(true);
        $calendars = ghl_api_call('calendars', 4);
        $calendars = json_decode($calendars, true);
        $calendars = $calendars['calendars'];
        $users = $users['users'];

        // Process the chunk data
        foreach ($chunkData as $data) {
            $calendar = array_filter($calendars, function ($calendar) use ($data) {
                return $calendar['name'] == $data['calendarName'];
            });

            //the first one only
            $calendar = array_values($calendar);

            // user
            $user = array_filter($users, function ($user) use ($data) {
                return $user['name'] == $data['assignedTo'];
            });

            //the first one only
            $user = array_values($user);

            $location_id = auth()->user()->location_id;
            $where = ['location_id' => $location_id, 'ghl_appointment_id' => $data['id']];
            $appointment = Appointment::where($where)->first();

            $dateAdded = isset($data['dateAdded']) ? $data['dateAdded'] : null;
            $dateAdded = !is_null($dateAdded) ? Carbon::parse($dateAdded)->format('Y-m-d H:i:s') : null;
            $startTime = isset($data['startTime']) ? $data['startTime'] : null;
            $startTime = !is_null($startTime) ? Carbon::parse($startTime)->format('Y-m-d H:i:s') : null;
            $endTime = isset($data['endTime']) ? $data['endTime'] : null;
            $endTime = !is_null($endTime) ? Carbon::parse($endTime)->format('Y-m-d H:i:s') : null;
            // Data to update or create the appointment
            $appointmentData = [
                'ghl_appointment_id' => $data['id'],
                'location_id' => $location_id,
                'address' => isset($data['address']) ? $data['address'] : null,
                'title' => isset($data['title']) ? $data['title'] : null,
                'calendar_id' => isset($calendar[0]['id']) ? $calendar[0]['id'] : null,
                'contact_id' => isset($data['contactId']) ? $data['contactId'] : null,
                'group_id' => isset($calendar[0]['groupId']) ? $calendar[0]['groupId'] : null,
                'appointment_status' => isset($data['appointmentStatus']) ? $data['appointmentStatus'] : null,
                'assigned_user_id' => isset($user[0]['id']) ? $user[0]['id'] : null,
                'users' => isset($data['users']) ? json_encode($data['users']) : null,
                'notes' => isset($data['notes']) ? $data['notes'] : null,
                'source' => isset($data['source']) ? $data['source'] : null,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'date_added' => $dateAdded,
            ];

            // dd($appointmentData, $calendar, $user);

            // Update the existing appointment or create a new one
            if ($appointment) {
                $appointment->update($appointmentData);
                \Log::info("Appointment with GHL Appointment ID: {$data['id']} updated successfully.");
            } else {
                $appointment = Appointment::create($appointmentData);
                \Log::info("Appointment with GHL Appointment ID: {$data['id']} created successfully.");
            }

        }

        return response()->json(['message' => 'Chunk processed successfully']);

    }

}

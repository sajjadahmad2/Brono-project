<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Cache;
use DateTime;
use App\Models\Contact;
use App\Models\Opportunity;
use App\Models\Appointment;
use App\Models\Call;

class DashboardController extends Controller
{
    
    
    
    function tags($refresh = false){
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

    public function users($refresh = false){
        $location_id = auth()->user()->location_id;
        $cacheKey = 'ghl_users_' . $location_id;

        if ($refresh || !Cache::has($cacheKey)) {
            $users = ghl_api_call('users/');
            $users = json_decode($users, true);

            if ($users && isset($users['users'])) {
                Cache::put($cacheKey, $users['users'], now()->addDays(3)); 
                return $users['users'];
            }

            return [];
        }
        return Cache::get($cacheKey);
    }

    public function contacts($filters=null){
        $contacts = Contact::where('location_id', auth()->user()->location_id)->get();
        return $contacts;
    }

    public function groupContactsBasedOnAssgined($contacts,$users){
        $grouped_contacts = [];
        foreach($users as $user){
            $grouped_contacts[$user['name']] = array_filter($contacts, function($contact) use ($user){
                return $contact['assigned_to'] == $user['id'];
            });
        }
        return $grouped_contacts;
    }

    public function dayWiseContactsCounts($contacts){
        $daywise_contacts = [];
        foreach($contacts as $contact){
            $date = new DateTime($contact['date_added']);
            $day = $date->format('Y-m-d');
            if(isset($daywise_contacts[$day])){
                $daywise_contacts[$day] += 1;
            }else{
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


    public function contactsStats($users=[],$tags=[], $all_contacts=false){
       
        if(!$all_contacts){
            $all_contacts = $this->contacts();
            $all_contacts = $all_contacts->toArray();
        }


        $datewise_contacts = $this->dayWiseContactsCounts($all_contacts);
        $grouped_contacts = $this->groupContactsBasedOnAssgined($all_contacts,$users);
        $grouped_contacts_by_tags = $this->groupContactsBasedOnTags($all_contacts,$tags);
        $total_contacts = count($all_contacts);

        return [
            'datewise_contacts' => $datewise_contacts,
            'grouped_contacts' => $grouped_contacts,
            'grouped_contacts_by_tags' => $grouped_contacts_by_tags,
            'total_contacts' => $total_contacts
        ];

    }



    public function opportunities(){
        $opportunities =  Opportunity::where('location_id', auth()->user()->location_id)->get();
        return $opportunities;
    }

    public function pipelines(){
        //based on cache
        $location_id = auth()->user()->location_id;
        $cacheKey = 'ghl_pipelines_' . $location_id;

        if (!Cache::has($cacheKey)) {
            $pipelines = ghl_api_call('opportunities/pipelines');
            $pipelines = json_decode($pipelines, true);

            if ($pipelines && isset($pipelines['pipelines'])) {
                Cache::put($cacheKey, $pipelines, now()->addDays(3)); 
                return $pipelines;
            }

            return [];
        }
        return Cache::get($cacheKey);

    }


    public function groupByPiplinesAndStage1($opportunities, $pipelines){
       
        $groupByPipes = array_group_by($opportunities, 'pipeline_id');
        $pipelines = $pipelines['pipelines'];
        dd($pipelines);
        $pipelineswise = [];
        $pipelines = array_column($pipelines, 'name', 'id');
        foreach($groupByPipes as $pipe_id => $pipe_opps){
            $pipe_name = $pipelines[$pipe_id];
            $pipelineswise[$pipe_name] = $pipe_opps;
        }

        dd($pipelineswise);
    }


    public function groupByPipelinesAndStages($opportunities, $pipelines) {
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
                $pipe_name = $pipelineNames[$pipe_id];
                $stageWise = array_group_by($pipe_opps, 'pipeline_stage_id');

                foreach ($stageWise as $stage_id => $stage_opps) {
                    $stage_name = $stageNames[$stage_id] ?? 'Unknown Stage';
                    $pipelinesWise[$pipe_name][$stage_name] = count($stage_opps);
                }
            }

            return $pipelinesWise;
        }


    public function monetaryValueDistribution($opportunities){
        //based on each status like won, lost, open, abandoned etc we will calculate the potential value of the opportunities and then show how much is converted (won) and how much is lost in day wise manner
        $revenue = [];
        $lost = [];
        $expected = [];

        // Process data
        foreach ($opportunities as $item) {
            $date = date('Y-m-d', strtotime($item['date_added']));
            $value = $item['monetary_value'] ? (float)$item['monetary_value'] : 0;

            if (!isset($revenue[$date])) $revenue[$date] = 0;
            if (!isset($lost[$date])) $lost[$date] = 0;
            if (!isset($expected[$date])) $expected[$date] = 0;

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
                    'expected' => $expected_values
                ];

                
                return $arr;

    }


    public function leadToSale($contacts, $opportunities){
        // from how many contacts are in the opportunities that have status won
        $contacts = !is_array($contacts) ? $contacts->toArray() : $contacts;
        $contacts = array_column($contacts, 'ghl_contact_id');
        
        $opportunities = array_filter($opportunities, function($opportunity) use ($contacts){
            return in_array($opportunity['contact_id'], $contacts) && $opportunity['status'] == 'won';
        });

        //conversion rate formate
        $conversion_rate =  (count($opportunities) / 100 ) * count($contacts);
        
        $arr = [
            'contacts' => count($contacts),
            'won' => count($opportunities),
            'conversion_rate' => $conversion_rate
        ];

        return $arr;
       
    }

    public function appointments(){
        $appointments =  Appointment::where('location_id', auth()->user()->location_id)->get();
        return $appointments;
    }



    public function opportunityStats(){
        
        $opportunities = $this->opportunities();
        $opportunities = $opportunities->toArray();
   
        $users = $this->users();
        $opportunities_assigned_per_user = [];
        
        foreach($users as $user){
            $opportunities_assigned_per_user[$user['name']] = array_filter($opportunities, function($opportunity) use ($user){
                return $opportunity['assigned_to'] == $user['id'];
            });
        }

        //group by dates
        $dayWiseContactsCounts = [];
        foreach($opportunities as $opportunity){
            $date = new DateTime($opportunity['date_added']);
            $day = $date->format('Y-m-d');
            if(isset($dayWiseContactsCounts[$day])){
                $dayWiseContactsCounts[$day] += 1;
            }else{
                $dayWiseContactsCounts[$day] = 1;
            }
        }

        //group by status
        $opportunities_by_status = [];
        foreach($opportunities as $opportunity){
            $status = $opportunity['status'];
            if(isset($opportunities_by_status[$status])){
                $opportunities_by_status[$status] += 1;
            }else{
                $opportunities_by_status[$status] = 1;
            }
        }

        //group by monetary value
        $monetary_value_distribution = $this->monetaryValueDistribution($opportunities);
       $pipelineswise = $this->groupByPipelinesAndStages($opportunities, $this->pipelines());
     

        //group by source
        $opportunities_by_source = [];
        foreach($opportunities as $opportunity){
            $source = $opportunity['source'];
            if(isset($opportunities_by_source[$source])){
                $opportunities_by_source[$source] += 1;
            }else{
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
            'lead_to_sale' => $lead_to_sale
        ];

    }

    function calendars(){
        $location_id = auth()->user()->location_id;
        $cacheKey = 'ghl_calendars_' . $location_id;

        if (!Cache::has($cacheKey)) {
            $calendars = ghl_api_call('calendars');
            $calendars = json_decode($calendars, true);

            if ($calendars && isset($calendars['calendars'])) {
                Cache::put($cacheKey, $calendars, now()->addDays(3)); 
                return $calendars;
            }

            return [];
        }
        return Cache::get($cacheKey);
    }

    public function appointmentStats($users){
        
        //daywise appointments,  appointments by status, appointments by source, appointments by assigned to

        $appointments = $this->appointments();
        $appointments = $appointments->toArray();
        
        $appointments_assigned_per_user = [];

        foreach($users as $user){
            $appointments_assigned_per_user[$user['name']] = array_filter($appointments, function($appointment) use ($user){
                return $appointment['assigned_user_id'] == $user['id'];
            });
        }



        //daywise appointments
        $dayWiseAppointmentsCounts = [];
        foreach($appointments as $appointment){
            $date = new DateTime($appointment['date_added']);
            $day = $date->format('Y-m-d');
            if(isset($dayWiseAppointmentsCounts[$day])){
                $dayWiseAppointmentsCounts[$day] += 1;
            }else{
                $dayWiseAppointmentsCounts[$day] = 1;
            }
        }

        //group by status
        $appointments_by_status = [];
        foreach($appointments as $appointment){
            $status = $appointment['appointment_status'];
            if(isset($appointments_by_status[$status])){
                $appointments_by_status[$status] += 1;
            }else{
                $appointments_by_status[$status] = 1;
            }
        }

        //group by source
        $appointments_by_source = [];
        foreach($appointments as $appointment){
            $source = $appointment['source'];
            if(isset($appointments_by_source[$source])){
                $appointments_by_source[$source] += 1;
            }else{
                $appointments_by_source[$source] = 1;
            }
        }

        $total_appointments = count($appointments);

        //total appointment based on calendars
        $calendars = $this->calendars();
       
        $appointments_by_calendars = [];
        foreach($calendars['calendars'] as $calendar){
            $appointments_by_calendars[$calendar['name']] = array_filter($appointments, function($appointment) use ($calendar){
                return $appointment['calendar_id'] == $calendar['id'];
            });
        }

        return [
            'total_appointments' => $total_appointments,
            'appointments_by_status' => $appointments_by_status,
            'appointments_by_source' => $appointments_by_source,
            'appointments_assigned_per_user' => $appointments_assigned_per_user,
            'daywise_count' => $dayWiseAppointmentsCounts,
            'appointments_by_calendars' => $appointments_by_calendars
        ];

    }

    public function callStats(){
        $calls = Call::where('location_id', auth()->user()->location_id)->get();
        $calls = $calls->toArray();
        $dayWiseCallsCounts = [];
        foreach($calls as $call){
            $date = new DateTime($call['date_added']);
            $day = $date->format('Y-m-d');
            if(isset($dayWiseCallsCounts[$day])){
                $dayWiseCallsCounts[$day] += 1;
            }else{
                $dayWiseCallsCounts[$day] = 1;
            }
        }

        $total_calls = count($calls);

        
        //leads to calls conversion
        $contacts = $this->contacts();
        $contacts = $contacts->toArray();
        $contacts = array_column($contacts, 'ghl_contact_id');

        $calls = array_filter($calls, function($call) use ($contacts){
            return in_array($call['contact_id'], $contacts);
        });

        return [
            'total_calls' => $total_calls,
            'daywise_count' => $dayWiseCallsCounts
        ];
    }

    public function dashboardNew()
    {
        $users = $this->users();
        $tags = $this->tags();
        if(is_connected()){
              $contact_stats = $this->contactsStats($users,$tags);
        $opportunities_stats  = $this->opportunityStats();
        $oppointment_stats = $this->appointmentStats($users);
        $call_stats = $this->callStats();
        }
      
        return view('dashboard', get_defined_vars());
    }
    


    public function filterContacts(Request $request){
        
        // filters for tag, assigned to, date range
        $all_contacts = $this->contacts();
        $all_contacts = $all_contacts->toArray();
        
        $whereClause = [];
        $founds = 0;
        if($request->has('tag') && !empty($request->tag)){
            $tag = $request->tag;
            $all_contacts = array_filter($all_contacts, function($contact) use ($tag , &$founds){
                $tagArr= makeTagsArray($contact['tags']);
                if(in_array($tag, $tagArr)){
                    $founds++;
                    return true;
                }
            });
        }

        if($request->has('user') && !empty($request->user)){
            $assigned_to = $request->user;
            $all_contacts = array_filter($all_contacts, function($contact) use ($assigned_to){
                return $contact['assigned_to'] == $assigned_to;
            });
        }

      //date range with start and end and split with -
        if($request->has('dateRange') && !empty($request->dateRange)){
            $date_range = explode('-', $request->dateRange);
            $start_date = Carbon::parse(trim($date_range[0]))->format('Y-m-d');
            $end_date = Carbon::parse(trim($date_range[1]))->format('Y-m-d');

            $all_contacts = array_filter($all_contacts, function($contact) use ($start_date, $end_date){
                $date = Carbon::parse($contact['date_added'])->format('Y-m-d');
                return $date >= $start_date && $date <= $end_date;
            });
        }


        // dd($all_contacts);

        $users = $this->users();
        $tags = $this->tags();
        $contact_stats = $this->contactsStats($users,$tags,$all_contacts);
       
        
        $html = view('htmls.dash_stats', get_defined_vars())->render();
        return response()->json([
            'status' => 'success',
            'contact_stats' => $contact_stats,
            'html' => $html
        ]);

    }

    
    
    
    
    public function dashboard()
    {
        $current_year = Carbon::now()->year;
         $permissions = Permission::all();
            $roles = Role::all();
              $users = User::role('company')->latest()->limit(5)->get();
        return view('dashboard-backup', get_defined_vars());
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
            $setting = Setting::where(['name' => $key, 'user_id' =>  auth()->id()])->first() ?? new Setting;
            // dd( $req->hasFile($key) );
            if ($req->hasFile($key)) {
                
                $path =  uploadFile($value, 'uploads/cms', $key . '-' . rand());
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
    
    
    public function userSettingSave(Request $req){
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
            $user->photo = uploadFile($req->photo, 'uploads/profile', $req->first_name . '-' . $req->last_name.'-'.time());
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
            'confirm_password' => 'required|same:password'
        ]);
        $user->password = bcrypt($req->password);
        $user->save();

        return redirect()->back()->with('success', 'Password updated Successfully!');
    }
}

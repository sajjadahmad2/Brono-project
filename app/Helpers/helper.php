<?php

use App\Models\CrmAuth;
use App\Models\DashboardStyle;
use App\Models\Setting;
use App\Models\PropertyPermission;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

function setting($key, $uid = null)
{
    $user_id = is_null($uid) ? auth()->id() : $uid;
    try {
        // Attempt to get settings from cache first for better performance
        $settings = Cache::remember('settings_user_' . $user_id, 60, function () {
            return Setting::where('user_id', $user_id)->pluck('value', 'name');
        });

        switch ($key) {
            case 'company_name':
                return $settings[$key] ?? 'XMS Admin Panel';
            case 'address':
                return $settings[$key] ?? 'Please set your address in settings';
            default:
                return $settings[$key] ?? '';
        }
    } catch (ModelNotFoundException $e) {
        Log::error('Settings not found for user: ' . $user_id, ['exception' => $e]);
        return '';
    } catch (\Exception $e) {
        Log::error('An error occurred while retrieving settings for user: ' . $user_id, ['exception' => $e]);
        return '';
    }
}

function getCrmToken($type, $id = null)
{

    $auth = CrmAuth::where('user_id', $id)->first();
    if ($type == 'refresh') {
        return $auth->refresh_token ?? null;
    } elseif ($type == 'access') {
        return $auth->access_token ?? null;
    } elseif ($type == 'location') {
        return $auth->location_id ?? null;
    } elseif ($type == 'user_type') {
        return $auth->user_type ?? null;
    } else {
        return null;
    }
}

function logo($key, $uid = null)
{
    $user_id = is_null($uid) ? auth()->id() : $uid;
    $setting = Setting::where('name', $key)->where('user_id', $user_id)->first();
    if ($setting) {
        return asset($setting->value);
    } else {
        return asset('assets/media/logos/logo.png');
    }

}

function breadcrumb($arr)
{
    $html = '<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">';
    foreach ($arr as $ar) {
        $html .= '<li class="breadcrumb text-muted"><a href="' . $ar['url'] . '" class="text-muted text-hover-primary">' . $ar['name'] . '</a></li>';
    }
    $html .= '</ul>';
    return $html;
}

function uploadFile($file, $path, $name)
{

    $name = $name . '.' . $file->ClientExtension();
    $file->move($path, $name);
    return $path . '/' . $name;
}

function checkRolePerm($role_id, $permission_id)
{
    $permission = Permission::find($permission_id);
    $role = Role::find($role_id);

    $check = DB::table('role_has_permissions')->where('role_id', $role_id)->where('permission_id', $permission_id)->first();

    if ($check) {
        return "checked";
    } else {
        return "";
    }
}

function totalRoles()
{
    return Role::count();
}
function totalUsers()
{
    return User::where('id', '!=', 1)->count();
}
function totalPermissions()
{
    return Permission::count();
}
function totalPropertyPermissions()
{
    return  PropertyPermission::count();
}
function number_format_short($n)
{
    if ($n > 0 && $n < 1000) {
        // 1 - 999
        $n_format = floor($n);
        $suffix = '';
    } else if ($n >= 1000 && $n < 1000000) {
        // 1k-999k
        $n_format = floor($n / 1000);
        $suffix = 'K+';
    } else if ($n >= 1000000 && $n < 1000000000) {
        // 1m-999m
        $n_format = floor($n / 1000000);
        $suffix = 'M+';
    } else if ($n >= 1000000000 && $n < 1000000000000) {
        // 1b-999b
        $n_format = floor($n / 1000000000);
        $suffix = 'B+';
    } else if ($n >= 1000000000000) {
        // 1t+
        $n_format = floor($n / 1000000000000);
        $suffix = 'T+';
    } else {
        $n_format = 0;
        $suffix = '';
    }
    return !empty($n_format . $suffix) ? $n_format . $suffix : 0;
}

function checkEmptyValue($value)
{
    $data = setting($value);
    if ($data == '' || $data == null || $data == 'null' || $data == 'NULL' || $data == 'Null' || $data == 'undefined' || $data == 'Undefined' || $data == 'undefined') {
        return true;
    } else {
        return false;
    }
}

function get_user()
{
    $user = auth()->user();
    if ($user->hasRole('admin')) {
        return "Admin";
    } else {
        return "Company";
    }
}

if (!function_exists('generateActionButtons')) {
    function generateActionButtons($row, $editRoute, $deleteRoute, $statusRoute, $type = 'icons')
    {
        $html = '';

        if (Auth::user()->can('edit user')) {
            if ($type === 'button') {
                $html .= '
                    <a href="' . route($editRoute, $row->id) . '" class="btn btn-info mr-2">Edit</a>
                ';
            } else {
                $html .= '
                    <a href="' . route($editRoute, $row->id) . '" class="mr-2">
                        <i class="fas fa-edit text-info font-16"></i>
                    </a>
                ';
            }
        }

        if (Auth::user()->can('delete user')) {
            if ($type === 'button') {
                $html .= '
                    <a href="' . route($deleteRoute, $row->id) . '" class="btn btn-danger" onclick="event.preventDefault(); deleteMsg(\'' . route($deleteRoute, $row->id) . '\')">Delete</a>
                ';
            } else {
                $html .= '
                    <a href="' . route($deleteRoute, $row->id) . '" onclick="event.preventDefault(); deleteMsg(\'' . route($deleteRoute, $row->id) . '\')">
                        <i class="fas fa-trash-alt text-danger font-16"></i>
                    </a>
                ';
            }
        }

        if (Auth::user()->can('edit user')) {
            if ($type === 'button') {
                $html .= '
                    <a href="' . route($statusRoute, $row->id) . '" class="btn btn-warning">Change Status</a>
                ';
            } else {
                $html .= '
                    <a href="' . route($statusRoute, $row->id) . '" class="mr-2">
                        <i class="fas fa-sync-alt text-warning font-16"></i>
                    </a>
                ';
            }
        }

        return $html;
    }
}

//generate single button based on type button icon and also
if (!function_exists('generateSingleButton')) {
    function generateSingleButton($route, $text, $color = 'primary')
    {
        return '<a href="' . $route . '" class="btn btn-' . $color . '">' . $text . '</a>';
    }
}

function login_id()
{
    return auth()->id();
}

function save_auth($code, $type = 'code', $userid = null)
{
    if (is_null($userid)) {
        $user_id = login_id();
    } else {
        $user_id = $userid;
    }
    $data = [
        'access_token' => $code->access_token,
        'refresh_token' => $code->refresh_token,
        'user_id' => $user_id,
    ];

    if (empty($type)) {
        $data['location_id'] = $code->locationId ?? $user_id;
        $data['user_type'] = $code->userType ?? 'Location';
    }

    $auth = CrmAuth::updateOrCreate(
        ['user_id' => $user_id],
        $data
    );

    //update user's location_id
    //auth()->user();
    $user = User::where('id', $user_id)->first();
    $user->location_id = $auth->location_id;
    $user->save();

    return $auth;
}

if (!function_exists('ghl_oauth_call')) {

    function ghl_oauth_call($code = '', $method = '')
    {
        $url = 'https://api.msgsndr.com/oauth/token';
        $curl = curl_init();
        $data = [];
        $data['client_id'] = '668eb5cf0291d90e9f353acf-lyg20chd';
        $data['client_secret'] = '871e4edf-276d-484f-a2bb-a3c90273c717';
        $md = empty($method) ? 'code' : 'refresh_token';
        $data[$md] = $code;
        $data['grant_type'] = empty($method) ? 'authorization_code' : 'refresh_token';
        $postv = '';
        $x = 0;
        foreach ($data as $key => $value) {
            if ($x > 0) {
                $postv .= '&';
            }
            $postv .= $key . '=' . $value;
            $x++;
        }
        $curlfields = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postv,
        );
        curl_setopt_array($curl, $curlfields);
        $response = curl_exec($curl);
        $response = json_decode($response);
        curl_close($curl);
        return $response;
    }
}

function ghl_token($request, $type = '', $userid = null)
{
    $code = $request->code;
    $code = ghl_oauth_call($code, $type);

    $route = '/';
    if (is_null($userid)) {
        $id = login_id();
    } else {
        $id = $userid;
    }

    if ($code) {
        if (property_exists($code, 'access_token')) {
            session()->put('ghl_api_token', $code->access_token);
            save_auth($code, $type, $id);
            if (empty($type)) {
                abort(redirect()->route('dashboard')->with('success', 'Connected successfully'));
            } else {
                return true;
            }

        } else {
            if (property_exists($code, 'error_description')) {
                if (empty($type)) {
                    abort(redirect()->route('dashboard')->with('error', $code->error_description));
                }
            }
            return null;
        }
    } else {
        abort(redirect()->route('dashboard')->with('error', 'Server error'));
    }
}

function is_connected()
{
    $user_id = login_id();
    $user = CrmAuth::where('user_id', $user_id)->first();
    if ($user) {
        return true;
    }
    return false;
}

function dashboard_css($id = null, $name = '')
{
    $id = $id ?? login_id();
    $design = DashboardStyle::where(['user_id' => $id, 'name' => $name])->first();
    if ($design) {
        return $design->value;
    }
    return '';
}

function save_dashboard_css($css, $name = '')
{
    $design = DashboardStyle::where(['user_id' => login_id(), 'name' => $name])->first();
    if ($design) {
        $design->update([
            'value' => $css,
        ]);
    } else {
        DashboardStyle::create([
            'user_id' => login_id(),
            'name' => $name,
            'value' => $css,
            'type' => 'css',
        ]);
    }
    return redirect()->back();
}

function dashboard_keys($key, $id = null)
{
    $id = $id ?? login_id();
    $design = DashboardStyle::where(['user_id' => $id, 'name' => $key])->first();
    if ($design) {
        return $design->value;
    }
    return '';
}

//  <div class="card h-100 ">
//                     <!--begin::Card header-->
//                     <div class="card-header flex-nowrap border-0 pt-9">
//                         <!--begin::Card title-->
//                         <div class="card-title m-0">
//                             <!--begin::Icon-->
//                             <div class="symbol symbol-45px w-45px bg-light me-5">
//                                 <img width="40" height="40"
//                                     src="https://img.icons8.com/ios/50/000000/conference-call--v1.png"
//                                     alt="conference-call--v1" />
//                             </div>
//                             <!--end::Icon-->
//                             <!--begin::Title-->
//                             <a href="#" class="fs-4 fw-semibold text-hover-primary text-gray-600 m-0">
//                                 Total Companies </a>
//                             <!--end::Title-->
//                         </div>
//                         <!--end::Card title-->
//                     </div>
//                     <!--end::Card header-->

//                     <!--begin::Card body-->
//                     <div class="card-body d-flex flex-column px-9 pt-6 pb-8">
//                         <!--begin::Heading-->
//                         <div class="fs-2tx fw-bold mb-3">
//                             $500.00 </div>
//                         <!--end::Heading-->

//                         <!--begin::Stats-->
//                         <div class="d-flex align-items-center flex-wrap mb-5 mt-auto fs-6">
//                             <i class="ki-duotone ki-Up-right fs-3 me-1 text-danger"></i>
//                             <!--begin::Number-->
//                             <div class="fw-bold text-danger me-2">
//                                 +40.5% </div>
//                             <!--end::Number-->

//                             <!--begin::Label-->
//                             <div class="fw-semibold text-gray-500">
//                                 more impressions </div>
//                             <!--end::Label-->
//                         </div>
//                         <!--end::Stats-->

//                         <!--begin::Indicator-->
//                     </div>
//                     <!--end::Card body-->
//                 </div>

// function that will return the card html
function statcard($title, $icon, $value, $stats, $label, $color = 'primary', $url = '#')
{
    $html = '<div class="card h-100 ">
                    <!--begin::Card header-->
                    <div class="card-header flex-nowrap border-0 pt-9">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <!--begin::Icon-->
                            <div class="symbol symbol-45px w-45px bg-light me-5">
                                <img width="40" height="40"
                                    src="' . $icon . '"
                                    alt="' . $title . '" />
                            </div>
                            <!--end::Icon-->
                            <!--begin::Title-->
                            <a href="' . $url . '" class="fs-4 fw-semibold text-hover-primary text-gray-600 m-0">
                                ' . $title . ' </a>
                            <!--end::Title-->
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body d-flex flex-column px-9 pt-6 pb-8">
                        <!--begin::Heading-->
                        <div class="fs-2tx fw-bold mb-3 text-right">
                            ' . $value . ' </div>
                        <!--end::Heading-->
                    </div>
                    <!--end::Card body-->
                </div>';
    return $html;
}

function totalCompanies()
{

    //create stat card
    $users = User::where('id', '!=', 1)->count();
    return $users;
}

function totalStatusUser($active = true)
{

    $status = $active ? 1 : 0;
    $users = User::where('id', '!=', 1)->where('status', $status)->count();
    return $users;
}

//ghl api call
if (!function_exists('ghl_api_call')) {
    function ghl_api_call($urlmain = '', $userid = null, $method = 'get', $data = '', $headers = [], $json = false, $token = '')
    {
        $url = $urlmain;
        $api_call_version = '2021-04-15';
        $api_call = 'oauth';
        $oauth = $api_call == 'oauth';
        if (is_null($userid)) {
            $login_id = login_id();
        } else {
            $login_id = $userid;
        }

        if ($oauth) {
            $token = empty($token) ? getCrmToken('access', $login_id) : $token;

            $main_url = "https://services.leadconnectorhq.com/";
            $location = getCrmToken('location', $login_id);
            $headers['Version'] = $api_call_version;
            if ((strpos($url, 'templates') !== false || strpos($url, 'custom') !== false || strpos($url, 'tasks/search') !== false) && strpos($url, 'locations/') === false) {
                if (strpos($url, 'custom-fields') !== false) {
                    $url = str_replace('-fields', 'Fields', $url);
                }
                if (strpos($url, 'custom-values') !== false) {
                    $url = str_replace('-values', 'Values', $url);
                }
                $url = 'locations/' . $location . '/' . $url;
            } else if (strtolower($method) == 'get') {
                $urlap = (strpos($url, '?') !== false) ? '&' : '?';
                if (strpos($url, 'location_id=') === false && strpos($url, 'locationId=') === false && strpos($url, 'locations/') === false) {
                    if (strpos($url, 'opportunities/search') !== false) {
                        $url .= $urlap;
                        $url .= 'location_id=' . $location;
                    } else {
                        $isinnot = true;
                        $uri = ['users', 'opportunities', 'conversations', 'links', 'opportunities', 'notes', 'appointments', 'tasks', 'free-slots'];
                        foreach ($uri as $k) {
                            if (strpos($url, $k) != false) {
                                $isinnot = false;
                            }
                        }
                        if ($isinnot) {
                            $url .= $urlap;
                            $url .= 'locationId=' . $location;
                        }
                    }
                }
            }
            if (strpos($url, 'contacts') !== false) {
                if (strpos($url, 'q=') !== false) {
                    $url = str_replace('q=', 'query=', $url);
                }
                if (strpos($url, 'lookup') !== false) {
                    $url = str_replace('lookup', 'search/duplicate', $url);
                    if (strpos($url, 'phone=') !== false) {
                        $url = str_replace('phone=', 'number=', $url);
                    }
                }
            }

            // if tags then locations locationid and then tags will be append
            if (strpos($url, 'tags') !== false) {
                $url = 'locations/' . $location . '/' . $url;
                // dd($url);
            }

            $lastsl = '/';
            $sep = '?';
            $slash = explode($sep, $url);
            if (count($slash) > 1) {
                $urlpart = $slash[0];
                $lastindex = substr($urlpart, -1);
                if ($lastindex != $lastsl) {
                    $urlpart .= $lastsl;
                }
                $url = $urlpart . $sep . $slash[1];
            } else {
                $lastindex = substr($url, -1);
                if ($lastindex != $lastsl) {
                    $url .= $lastsl;
                    $urlmain .= $lastsl;
                }
            }
        } else {
            //things of API version 1
            $token = '';
            $main_url = '';
        }

        // dd($token);
        $headers['Authorization'] = 'Bearer ' . $token;
        if ($json) {
            $headers['Content-Type'] = "application/json";
        }
        if (empty($token)) {
            return '';
        }
        $url1 = $main_url . $url;

        $client = new \GuzzleHttp\Client(['http_errors' => false, 'headers' => $headers]);
        $options = [];
        if (!empty($data)) {
            $dat = json_decode($data);
            if (property_exists($dat, 'company_id')) {
                unset($dat->company_id);
            }
            if ($oauth) {
                if (property_exists($dat, 'customField')) {
                    $dat->customFields = $dat->customField;
                    unset($dat->customField);
                }
                if (strtolower($method) == 'post') {
                    $uri = ['businesses', 'calendars', 'contacts', 'conversations', 'links', 'opportunities', 'contacts/bulk/business'];
                    $matching = str_replace('/', '', $urlmain);
                    foreach ($uri as $k) {
                        if ($matching == $k) {
                            if (!property_exists($dat, 'locationId')) {
                                $dat->locationId = $location;
                            }
                        }
                    }
                }
                if (strtolower($method) == 'put' && strpos($url, 'contacts') !== false) {
                    if (property_exists($dat, 'locationId')) {
                        unset($dat->locationId);
                    }
                    if (property_exists($dat, 'gender')) {
                        unset($dat->gender);
                    }
                }
            }
            $options[GuzzleHttp\RequestOptions::JSON] = $dat;
        }

        $response = $client->request($method, $url1, $options);
        $cd = $response->getBody()->getContents();
        $bd = json_decode($cd);

        if (isset($bd->error) && strpos($bd->error, 'Unauthorized') !== false && strpos($api_call, 'oauth') !== false) {
            $code = getCrmToken('refresh', $login_id);
            request()->code = $code;
            $refresh_token = ghl_token(request(), 'refresh the token please',$login_id);

            if ($refresh_token) {
                return ghl_api_call($url, $login_id, $method, $data, $headers, $json);
            }
            abort(401, 'Unauthorized');
        }
        return $cd;
    }
}

//ghl Api calls

function fetch_all_contacts()
{
    $all_contacts = [];
    $current_page = 1;

    $response = ghl_api_call('contacts/?page=' . $current_page);
    dd($response);

    do {

        $contacts = json_decode($response, true);

        if (isset($contacts['contacts'])) {
            $all_contacts = array_merge($all_contacts, $contacts['contacts']);
        }
        if (isset($contacts['meta']['nextPageUrl'])) {
            $current_page++;
        } else {
            break;
        }
    } while (true);

    return $all_contacts;
}

function fetch_all_opportunities()
{
    $all_opportunities = [];
    $current_page = 1;

    do {
        $response = ghl_api_call('opportunities/search?page=' . $current_page);

        $opportunities = json_decode($response, true);

        if (isset($opportunities['opportunities'])) {
            $all_opportunities = array_merge($all_opportunities, $opportunities['opportunities']);
        }
        if (isset($opportunities['meta']['nextPageUrl'])) {
            $current_page++;
        } else {
            break;
        }
    } while (true);

    return $all_opportunities;
}

function makeTagsArray($tags)
{
    if (is_array($tags)) {
        // make sure all tags are strings
        $tags = array_map('strval', $tags);
    }

    $tags = explode(',', $tags);
    $tags = array_map('trim', $tags);
    $tag = array_unique($tags);
    // only values
    $tags = array_values($tag);
    return $tags;
}

if (!function_exists('array_group_by')) {
    function array_group_by(array $array, $key)
    {
        if (!is_string($key) && !is_int($key) && !is_float($key) && !is_callable($key)) {
            trigger_error('array_group_by(): The key should be a string, an integer, or a callback', E_USER_ERROR);
            return null;
        }

        $func = (!is_string($key) && is_callable($key) ? $key : null);
        $_key = $key;

        // Load the new array, splitting by the target key
        $grouped = [];
        foreach ($array as $value) {
            $key = null;

            if (is_callable($func)) {
                $key = call_user_func($func, $value);
            } elseif (is_object($value) && property_exists($value, $_key)) {
                $key = $value->{$_key};
            } elseif (isset($value[$_key])) {
                $key = $value[$_key];
            }

            if ($key === null) {
                continue;
            }

            $grouped[$key][] = $value;
        }

        // Recursively build a nested grouping if more parameters are supplied
        // Each grouped array value is grouped according to the next sequential key
        if (func_num_args() > 2) {
            $args = func_get_args();

            foreach ($grouped as $key => $value) {
                $params = array_merge([$value], array_slice($args, 2, func_num_args()));
                $grouped[$key] = call_user_func_array('array_group_by', $params);
            }
        }

        return $grouped;
    }
}
if (!function_exists('image')) {
    /**
     * Get image url by path
     *
     * @param $path
     *
     * @return string
     */
    function image($path)
    {
        return asset('assets/media/' . $path);
    }
}

if (!function_exists('getIcon')) {
    /**
     * Get icon
     *
     * @param $path
     *
     * @return string
     */
    function getIcon($name, $class = '', $type = '', $tag = 'span')
    {
        return theme()->getIcon($name, $class, $type, $tag);
    }
}
if (!function_exists('theme')) {
    function theme()
    {
        return app(App\Core\Theme::class);
    }
}
function convertFeatureData($data, $mode = 'toArray')
{
    if ($mode === 'toJson') {
        if (!is_array($data)) {
            throw new InvalidArgumentException('Data must be an array when converting to JSON.');
        }
        $formattedArray = array_map(function ($feature) {
            return ['value' => $feature];
        }, $data);

        return json_encode($formattedArray);
    } elseif ($mode === 'toArray') {
        if (!is_string($data)) {
            throw new InvalidArgumentException('Data must be a JSON string when converting to array.');
        }

        // Convert JSON string to array
        $decodedArray = json_decode($data, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new RuntimeException('Failed to decode JSON string.');
        }

        return array_map(function ($item) {
            return $item['value'];
        }, $decodedArray);
    } else {
        throw new InvalidArgumentException('Invalid mode. Use "toJson" or "toArray".');
    }
}
function getRandomColor()
{
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}

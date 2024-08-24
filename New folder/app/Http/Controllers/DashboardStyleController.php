<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardStyleController extends Controller
{
    public function dashboardStyle1(){
        $design = auth()->user()->dashboardDesign ?? '';
        if($design){
            $css = $design->value;
        }else{
            $css = '';
        }


        $navItems = [
            [
                'href' => '/v2/location/vcLxBfw01Nmv2VnlhtND/launchpad',
                'id' => 'sb_launchpad',
                'meta' => 'launchpad',
                'img_src' => 'https://storage.googleapis.com/highlevel-backend.appspot.com/sidebar-v2/icon_launchpad.svg',
                'title' => 'Launchpad',
            ],
            [
                'href' => '/v2/location/vcLxBfw01Nmv2VnlhtND/dashboard',
                'id' => 'sb_dashboard',
                'meta' => 'dashboard',
                'img_src' => 'https://storage.googleapis.com/highlevel-backend.appspot.com/sidebar-v2/icon_dashboard.svg',
                'title' => 'Dashboard',
            ],
            [
                'href' => '/v2/location/vcLxBfw01Nmv2VnlhtND/conversations/conversations',
                'id' => 'sb_conversations',
                'meta' => 'conversations',
                'img_src' => 'https://storage.googleapis.com/highlevel-backend.appspot.com/sidebar-v2/icon_conversations.svg',
                'title' => 'Conversations',
            ],
            [
                'href' => '/v2/location/vcLxBfw01Nmv2VnlhtND/calendars/view',
                'id' => 'sb_calendars',
                'meta' => 'calendars',
                'img_src' => 'https://storage.googleapis.com/highlevel-backend.appspot.com/sidebar-v2/icon_calendar.svg',
                'title' => 'Calendars',
            ],
            [
                'href' => '/v2/location/vcLxBfw01Nmv2VnlhtND/contacts/smart_list/All',
                'id' => 'sb_contacts',
                'meta' => 'contacts',
                'img_src' => 'https://storage.googleapis.com/highlevel-backend.appspot.com/sidebar-v2/icon_contacts.svg',
                'title' => 'Contacts',
            ],
            [
                'href' => '/v2/location/vcLxBfw01Nmv2VnlhtND/opportunities/list',
                'id' => 'sb_opportunities',
                'meta' => 'opportunities',
                'img_src' => 'https://storage.googleapis.com/highlevel-backend.appspot.com/sidebar-v2/icon_opportunities.svg',
                'title' => 'Opportunities',
            ],
            [
                'href' => '/v2/location/vcLxBfw01Nmv2VnlhtND/payments/invoices',
                'id' => 'sb_payments',
                'meta' => 'payments',
                'img_src' => 'https://storage.googleapis.com/highlevel-backend.appspot.com/sidebar-v2/icon_payments.svg',
                'title' => 'Payments',
            ],
            [
                'href' => '/v2/location/vcLxBfw01Nmv2VnlhtND/marketing/social-planner/',
                'id' => 'sb_email-marketing',
                'meta' => 'email-marketing',
                'img_src' => 'https://storage.googleapis.com/highlevel-backend.appspot.com/sidebar-v2/icon_emailmarketing.svg',
                'title' => 'Marketing',
            ],
            [
                'href' => '/v2/location/vcLxBfw01Nmv2VnlhtND/automation/workflows',
                'id' => 'sb_automation',
                'meta' => 'automation',
                'img_src' => 'https://storage.googleapis.com/highlevel-backend.appspot.com/sidebar-v2/icon_automation.svg',
                'title' => 'Automation',
            ],
            [
                'href' => '/v2/location/vcLxBfw01Nmv2VnlhtND/funnels-websites/funnels',
                'id' => 'sb_sites',
                'meta' => 'sites',
                'img_src' => 'https://storage.googleapis.com/highlevel-backend.appspot.com/sidebar-v2/icon_sites.svg',
                'title' => 'Sites',
            ],
            [
                'href' => '/v2/location/vcLxBfw01Nmv2VnlhtND/memberships/courses/dashboard',
                'id' => 'sb_memberships',
                'meta' => 'memberships',
                'img_src' => 'https://storage.googleapis.com/highlevel-backend.appspot.com/sidebar-v2/memberships.svg',
                'title' => 'Memberships',
            ],
            [
                'href' => '/v2/location/vcLxBfw01Nmv2VnlhtND/media-storage',
                'id' => 'sb_app-media',
                'meta' => 'app-media',
                'img_src' => 'https://storage.googleapis.com/highlevel-backend.appspot.com/sidebar-v2/media-storage.svg',
                'title' => 'Media Storage',
            ],
            [
                'href' => '/v2/location/vcLxBfw01Nmv2VnlhtND/reputation/overview',
                'id' => 'sb_reputation',
                'meta' => 'reputation',
                'img_src' => 'https://storage.googleapis.com/highlevel-backend.appspot.com/sidebar-v2/icon_reputation.svg',
                'title' => 'Reputation',
            ],
           
        ];


        return view('designs.dashboard-style', compact('design','navItems'));
    }
    
    
    public function dashboardStyle(){
        $css = dashboard_keys('dashboard_css');
        $css_json = dashboard_keys('dashboard_json');
        
        if(empty($css_json)){
            $css_json = [
                 "globalfontSize" => "",
                "globalfontColorType" => "code",
                "globalfontColor" => "",
                "globalbgColorType" => "code",
                "globalbgColor" => "",
                "globalfontFamily" => "",
                "fontSize" => "",
                "fontColorType" => "code",
                "fontColor" => "",
                "bgColorType" => "code",
                "bgColor" => "",
                "fontFamily" => "",
                "hoverBgColorType" => "code",
                "hoverBgColor" => "",
                "padding" => "",
                "margin" => "",
                "cardfontSize" => "",
                "cardfontColorType" => "code",
                "cardfontColor" => "",
                "cardbgColorType" => "code",
                "cardbgColor" => "",
                "cardBoxShadow" => "",
                "innerTextFontSize" => "",
                "labelsFontSize" => "",
                "labelsFontColorType" => "code",
                "labelsFontColor" => "",
                "chartFillColorType" => "code",
                "chartFillColor" => "",
                "chartStrokeColorType" => "code",
                "chartStrokeColor" => "",
                "customCSS" => "",
                "bgGradientColors" => [],
                "cardbgGradientColors" => [],
                "globalbgGradientColors" => []

            ];
        }else{
            $css_json = json_decode($css_json, true);
        }
    
       
        // dd($css_json);


        $navItems = [
            [
                'href' => '/v2/location/vcLxBfw01Nmv2VnlhtND/launchpad',
                'id' => 'sb_launchpad',
                'meta' => 'launchpad',
                'img_src' => 'https://storage.googleapis.com/highlevel-backend.appspot.com/sidebar-v2/icon_launchpad.svg',
                'title' => 'Launchpad',
            ],
            [
                'href' => '/v2/location/vcLxBfw01Nmv2VnlhtND/dashboard',
                'id' => 'sb_dashboard',
                'meta' => 'dashboard',
                'img_src' => 'https://storage.googleapis.com/highlevel-backend.appspot.com/sidebar-v2/icon_dashboard.svg',
                'title' => 'Dashboard',
            ],
            [
                'href' => '/v2/location/vcLxBfw01Nmv2VnlhtND/conversations/conversations',
                'id' => 'sb_conversations',
                'meta' => 'conversations',
                'img_src' => 'https://storage.googleapis.com/highlevel-backend.appspot.com/sidebar-v2/icon_conversations.svg',
                'title' => 'Conversations',
            ],
            [
                'href' => '/v2/location/vcLxBfw01Nmv2VnlhtND/calendars/view',
                'id' => 'sb_calendars',
                'meta' => 'calendars',
                'img_src' => 'https://storage.googleapis.com/highlevel-backend.appspot.com/sidebar-v2/icon_calendar.svg',
                'title' => 'Calendars',
            ],
            [
                'href' => '/v2/location/vcLxBfw01Nmv2VnlhtND/contacts/smart_list/All',
                'id' => 'sb_contacts',
                'meta' => 'contacts',
                'img_src' => 'https://storage.googleapis.com/highlevel-backend.appspot.com/sidebar-v2/icon_contacts.svg',
                'title' => 'Contacts',
            ],
            [
                'href' => '/v2/location/vcLxBfw01Nmv2VnlhtND/opportunities/list',
                'id' => 'sb_opportunities',
                'meta' => 'opportunities',
                'img_src' => 'https://storage.googleapis.com/highlevel-backend.appspot.com/sidebar-v2/icon_opportunities.svg',
                'title' => 'Opportunities',
            ],
            [
                'href' => '/v2/location/vcLxBfw01Nmv2VnlhtND/payments/invoices',
                'id' => 'sb_payments',
                'meta' => 'payments',
                'img_src' => 'https://storage.googleapis.com/highlevel-backend.appspot.com/sidebar-v2/icon_payments.svg',
                'title' => 'Payments',
            ],
            [
                'href' => '/v2/location/vcLxBfw01Nmv2VnlhtND/marketing/social-planner/',
                'id' => 'sb_email-marketing',
                'meta' => 'email-marketing',
                'img_src' => 'https://storage.googleapis.com/highlevel-backend.appspot.com/sidebar-v2/icon_emailmarketing.svg',
                'title' => 'Marketing',
            ],
            [
                'href' => '/v2/location/vcLxBfw01Nmv2VnlhtND/automation/workflows',
                'id' => 'sb_automation',
                'meta' => 'automation',
                'img_src' => 'https://storage.googleapis.com/highlevel-backend.appspot.com/sidebar-v2/icon_automation.svg',
                'title' => 'Automation',
            ],
            [
                'href' => '/v2/location/vcLxBfw01Nmv2VnlhtND/funnels-websites/funnels',
                'id' => 'sb_sites',
                'meta' => 'sites',
                'img_src' => 'https://storage.googleapis.com/highlevel-backend.appspot.com/sidebar-v2/icon_sites.svg',
                'title' => 'Sites',
            ],
            [
                'href' => '/v2/location/vcLxBfw01Nmv2VnlhtND/memberships/courses/dashboard',
                'id' => 'sb_memberships',
                'meta' => 'memberships',
                'img_src' => 'https://storage.googleapis.com/highlevel-backend.appspot.com/sidebar-v2/memberships.svg',
                'title' => 'Memberships',
            ],
            [
                'href' => '/v2/location/vcLxBfw01Nmv2VnlhtND/media-storage',
                'id' => 'sb_app-media',
                'meta' => 'app-media',
                'img_src' => 'https://storage.googleapis.com/highlevel-backend.appspot.com/sidebar-v2/media-storage.svg',
                'title' => 'Media Storage',
            ],
            [
                'href' => '/v2/location/vcLxBfw01Nmv2VnlhtND/reputation/overview',
                'id' => 'sb_reputation',
                'meta' => 'reputation',
                'img_src' => 'https://storage.googleapis.com/highlevel-backend.appspot.com/sidebar-v2/icon_reputation.svg',
                'title' => 'Reputation',
            ],
           
        ];


        return view('designs.dashboard-style', compact('navItems','css','css_json'));
    }

    public function dashboardStyleSave1(Request $request){
       
        $dashboard_css = $request->get('dashboard_css');
        dd($dashboard_css);
        // sanitize the css and make it safe
        $dashboard_css = htmlspecialchars($dashboard_css, ENT_QUOTES, 'UTF-8', false);

        if($dashboard_css){
            save_dashboard_css($dashboard_css, 'dashboard_css');
            return response()->json(['status' => 'success', 'message' => 'Dashboard style saved successfully']);
        }else{
            return response()->json(['status' => 'error', 'message' => 'No data found']);
        }

   }

   public function dashboardStyleSave(Request $request){
    $dashboard_css = (string) $request->get('dashboard_css');
    $dashboard_json = $request->get('dashboard_json');
    

    // dd($dashboard_css,$dashboard_json);

    // Sanitize the CSS
    // $dashboard_css = htmlspecialchars($dashboard_css, ENT_QUOTES, 'UTF-8', false);

    // Save CSS and JSON data
    if($dashboard_css && $dashboard_json){
        save_dashboard_css($dashboard_css, 'dashboard_css');
        save_dashboard_css($dashboard_json, 'dashboard_json');
        return response()->json(['status' => 'success', 'message' => 'Dashboard style and design saved successfully']);
    } else {
        return response()->json(['status' => 'error', 'message' => 'No data found']);
    }
}



   public function dashboardResponse(Request $request,$location_id=null){
        //santimzie location_id
        $location_id = htmlspecialchars($location_id, ENT_QUOTES, 'UTF-8', false);
        
        $user = User::where('location_id', $location_id)->first();
        if($user && $user->enable_design == 1){
            $design = $user->dashboardDesign ?? '';
            if($design){
                $css = $design->value;
                $res = [
                    'status' => 'success',
                    'message' => 'Dashboard style found',
                    'content' => $css
                ];

                return response($css, 200, ['Content-Type' => 'text/css']);

            }else{
               $res = [
                    'status' => 'error',
                    'message' => 'No dashboard style found',
                    'content' => ''
                ];
                return response('', 200, ['Content-Type' => 'text/css']);
            }
        }else{
            $res = [
                'status' => 'error',
                'message' => 'No user found',
                'content' => ''
            ];
            return response('', 200, ['Content-Type' => 'text/css']);
        }
   }



}

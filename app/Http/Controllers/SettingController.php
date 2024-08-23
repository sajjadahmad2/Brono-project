<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class SettingController extends Controller
{
     //goHighLevel oAuth 2.0 callback
    public function goHighLevelCallback(Request $request)
    {

        return ghl_token($request);
    }
}

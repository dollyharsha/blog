<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DailyUpdateController extends Controller
{
    public function Sendmail(Request $request)
    {
    	$count=array();
    $userdata = User::all();
    $result=array();
    foreach($userdata as $data)
    {
       $result['email']=$data->email;
        $job = (new \App\Jobs\SendQueueEmail($result))
            	->delay(now()->addSeconds(2)); 
        dispatch($job);
    }
        echo "Mail send successfully !!"; 
    }
}

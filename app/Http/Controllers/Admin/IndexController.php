<?php

namespace App\Http\Controllers\Admin;

use App\Feedback;
use App\Invoice;
use App\System;
use Illuminate\Http\Request;

class IndexController extends CommonController
{
    public function index()
    {
        $system = System::first();
        return view('admin.index',['system'=>$system]);
    }

    public function configure(Request$request)
    {
        if($file = $request->file('company_logo')) {
            $clientName = $file->getClientOriginalName();
            $entension = $file->getClientOriginalExtension();
            $newName = md5(date("Y-m-d H:i:s") . $clientName) . "." . $entension;
            $path = $file->move($_SERVER['DOCUMENT_ROOT'] . '/upload', $newName);
            $url = trim(str_replace($_SERVER['DOCUMENT_ROOT'], '', $path));
        }
        $logo = isset($url)?$url:$request['logo'];
        if(System::first() == null){
            System::create(['company_name'=>$request['company_name'],'company_log'=>$logo,'company_info'=>$request['company_info'],
                            'server_phone'=>$request['server_phone'],'company_address'=>$request['company_address'],'pay_left_time'=>$request['pay_left_time']
                            ,'ground_left_time'=>$request['ground_left_time'],'help'=>$request['help'],'about'=>$request['about'],'desc'=>$request['desc']
                        ]);
        }else{
            System::where('id',1)->update(['company_name'=>$request['company_name'],'company_log'=>$logo,'company_info'=>$request['company_info'],
                'server_phone'=>$request['server_phone'],'company_address'=>$request['company_address'],'pay_left_time'=>$request['pay_left_time']
                ,'ground_left_time'=>$request['ground_left_time'],'help'=>$request['help'],'about'=>$request['about'],'desc'=>$request['desc']
            ]);
        }
        return redirect('admin');
    }
    public function userInfo()
    {
        $feedback = Feedback::paginate();
        return view('admin.userback',['feedback'=>$feedback]);
    }

    public function adminInvoice()
    {
        $invoice = Invoice::paginate();
        return view('admin.admininvoice',['invoice'=>$invoice]);
    }
}

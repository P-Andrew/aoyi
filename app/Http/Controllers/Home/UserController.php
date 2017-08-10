<?php

namespace App\Http\Controllers\Home;

use App\Feedback;
use App\Invoice;
use App\Order;
use App\Package;
use App\System;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use ShareBuy\Facades\Visitor;
use Illuminate\Http\JsonResponse;



class UserController extends Controller
{
    public function index()
    {
        $shopUser = Visitor::user()->id;
        $farmUser = User::find($shopUser);
        $user = Visitor::user()->info;
        return view('home.user',['user'=>$user,'farmuser'=>$farmUser]);
    }
    public function orderRecord(){
        $shopUser = Visitor::user()->id;
        $user = User::find($shopUser);
        $order = $user->order()->orderBy('status')->get();
        return view('home.order_record',['order'=>$order]);
    }
    public function cropRecord()
    {

        $shopUser = Visitor::user()->id;
        $user = User::find($shopUser);
        $cropRecord = $user->record;
        return view('home.croprecord',['croprecord'=>$cropRecord]);
    }
    public function harvestRecord()
    {
        $shopUser = Visitor::user()->id;
        $user = User::find($shopUser);
        $vest =   $user->vest;
        return view('home.harvestrecord',['vest'=>$vest]);
    }
    public function package()
    {
        $shopUser = Visitor::user()->id;
        $user = User::find($shopUser);
        $package =  $user->package;
        return view('home.package',['package'=>$package]);
    }
    public function complete(Request$request)
    {
        $result = Package::where('id',$request['id'])->update(['status'=>2]);
        return  new JsonResponse($result);
    }
    public function callback(){

        return view('home.feedback');
    }
    public function feedback(Request$request){
        $shopUser = Visitor::user()->id;
        Feedback::create(['user_id'=>$shopUser,'content'=>$request['context']]);
        return redirect('user');
    }
    public function information(){
        $address = System::find(1);
        return view('home.information',['address'=>$address['company_address']]);
    }
    public function about(){

        return view('home.about');
    }
    public function help(){
        return view('home.help');
    }
    public function cards(){
        return view('home.cards');
    }
    public function invoice(){
        return view('home.invoice');
    }
    public function application()
    {
        $shopUser = Visitor::user()->id;
        $order_number = User::find($shopUser)->order()->where('status',1)->get();
        return view('home.application',['order_number'=>$order_number]);
    }
    public function send(Request $request)
    {
        $shopUser = Visitor::user()->id;
        $this->validate($request, [
            'class'=>'required',
            'order_number'=>'required',
            'title'=>'required',
            'tax_number'=>'required',
            'cash'=>'required|numeric|between:0,7000',
            'address'=>'required',
            'phone'=>'required',
        ]);
        if($request['class']==2){
            $this->validate($request,[
                'bank_account'=>'required',
            ]);
        }
        Invoice::create(['user_id'=>$shopUser,'class'=>$request['class'],'order_number'=>$request['order_number'],'title'=>$request['title'],'tax_number'=>$request['tax_number'],'cash'=>$request['cash'],'blank_account'=>$request['blank_account'],'address'=>$request['address'],'phone'=>$request['phone']]);
        return redirect('home.index');
    }
}

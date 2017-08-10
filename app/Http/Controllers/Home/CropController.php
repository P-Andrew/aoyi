<?php

namespace App\Http\Controllers\Home;

use App\Category;
use App\Ground;
use App\Harvest;
use App\Package;
use App\Record;
use App\System;
use App\Vest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use ShareBuy\Facades\Visitor;
use App\User;
use Illuminate\Http\JsonResponse;

class CropController extends Controller
{
    public function index()
    {
        $shopUser = Visitor::user()->id;
        $userGround =  User::find($shopUser)->ground;
        $groundLeftTime = System::first()->value('ground_left_time');
        return view('home.crop',['userGround'=>$userGround,'groundLeftTime'=>$groundLeftTime]);
    }
    public function choose($id)
    {
        $categories = Category::all();
        $ground =  Ground::find($id);
        $shopUser = Visitor::user()->id;
        return view('home.choosedish',['shopUser'=>$shopUser,'categories'=>$categories,'ground'=>$ground]);
    }
    public function crop(Request$request){

        $shopUser = Visitor::user()->id;
        $selected = $request['selected'];
        foreach($selected as $dishId=>$selectNum){
            Record::create(['crop_num'=>$selectNum,'dish_id'=>$dishId,'user_id'=>$shopUser]);
            $selectTotal[] = $selectNum;
        }
        $total = array_sum($selectTotal);
        $ground = Ground::find($request['id']);
        $ground->increment('croped_num',$total);
        return new JsonResponse(['success'=>'成功'],200);
    }
    public function show()
    {
        $shopUser = Visitor::user()->id;
        $user = User::find($shopUser);
        $userAddress = Visitor::user()->addrs;
        $dish = $user->harvest->where('status',0)->groupBy('dish_id')->map(function ($num) {
            return [
                'sum' => $num->sum('harvest_num'),
                'created_at' => $num->last()->created_at,
                'dishInfo' => $num->first()->dish,
            ];
        });
        $record = $user->record->where('status',0)->groupBy('dish_id')->map(function($item){
            return [
                'sum'=>$item->sum('crop_num'),
                'created_at' => $item->last()->created_at,
                'dishInfo'=>$item->first()->dish,
            ];
        });
        /*foreach($dish as $key=>$value){
            $dishInfo[$key] =  Dish::find($key);
            $dishInfo[$key]->sum= $value;
        }*/

        return view('home.harvest', ['record'=>$record,'dish' => $dish, 'userAddress' => $userAddress]);
    }

    public function address(Request$request){
        $shopUser = Visitor::user()->id;
        $userAddress = Visitor::user()->addrs->find($request['id']);
        $address = $userAddress['prvince'].$userAddress['city'].$userAddress['area'].$userAddress['addr'];
        $result =  Package::create(['user_id'=>$shopUser,'status'=>0,'consignee'=>$userAddress['consignee'],'iphone'=>$userAddress['tel'],'address'=>$address]);
        foreach($request['selected'] as $dishId=>$num){
              Harvest::where('dish_id',$dishId)->update(['status'=>1]);
              Vest::create(['user_id'=>$shopUser,'package_id'=>$result['id'],'dish_id'=>$dishId,'vest_num'=>$num]);
        }
        return new JsonResponse(['success'=>'成功'],200);
    }
    public function showDish(){
        $categories = Category::all();
        $shopUser = Visitor::user()->id;
        return view('home.showdish',['shopUser'=>$shopUser,'categories'=>$categories]);
    }
    public function scaleVideo()
    {
        return view('home.chiocegroundfd');
    }
}

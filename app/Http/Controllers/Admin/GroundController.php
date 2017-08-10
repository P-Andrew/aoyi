<?php

namespace App\Http\Controllers\Admin;

use App\GreenHouse;
use App\Ground;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class GroundController extends CommonController
{
    public function index(Request$request)
    {
        $key = $request->input('keywords');
        $cid = $request->input('house_id');
        $ground = Ground::when($key,function($query) use ($key){
            return $query->where('name','like','%'.$key.'%');
        })->when(strlen($cid),function($query) use ($cid){
            return $query->where('house_id',$cid);
        })->paginate(25);
        $house = GreenHouse::all();
        return view('admin.ground',['house'=>$house,'ground'=>$ground]);
    }
    public function create()
    {
        $house = GreenHouse::all();
        return view('admin.addground',['house'=>$house]);
    }
    public function store(Request$request)
    {
        $able = empty($request['able'])?1:0;
        Ground::create(['name'=>$request['title'],'house_id'=>$request['house_id'],'price'=>$request['price'],'dish_num'=>$request['num'],'able'=>$able,'sort'=>$request['sort']]);
        return redirect('ground');
    }
    public function edit($ground)
    {
        $house = GreenHouse::all();
        $grounds = Ground::find($ground);
        return view('admin.updateground',['house'=>$house,'ground'=>$grounds]);
    }
    public function update(Request$request,$ground)
    {

        $area = Ground::find($ground);
        if($area->able==1){
            $able = empty($request['able'])?1:0;
        }else{
            $able = empty($request['able'])?0:1;
        }
        $grounds = Ground::find($ground);
        $grounds->update(['name'=>$request['title'],'house_id'=>$request['house_id'],'price'=>$request['price'],'dish_num'=>$request['num'],'able'=>$able,'sort'=>$request['sort']]);
        return redirect('ground');

    }
    public function show()
    {

    }
    public function destroy($ground)
    {
        $grounds = Ground::find($ground);
        $result =  $grounds->delete();
        return  new JsonResponse($result);
    }


}

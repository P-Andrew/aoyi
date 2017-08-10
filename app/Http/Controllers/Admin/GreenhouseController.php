<?php

namespace App\Http\Controllers\Admin;

use App\GreenHouse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class GreenhouseController extends CommonController
{

    public function index()
    {
        $house = GreenHouse::paginate();
        return view('admin.house',['house'=>$house]);
    }
    public function create()
    {

        return view('admin.addhouse');
    }
    public function store(Request$request)
    {
       GreenHouse::create(['name'=>$request['name'],'ground_num'=>$request['num'],'desc'=>$request['desc']]);
       return redirect('house');
    }
    public function edit($house)
    {
        $houses =  GreenHouse::find($house);
        return view('admin.updatehouse',['house'=>$houses]);
    }
    public function update(Request$request,$house)
    {
        $houses = GreenHouse::find($house);
        $houses->update(['name'=>$request['name'],'ground_num'=>$request['num'],'desc'=>$request['desc']]);
        return redirect('house');
    }
    public function show()
    {

    }
    public function destroy($house)
    {
        $houses = GreenHouse::find($house);
        $result =  $houses->delete();
        return  new JsonResponse($result);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Record;
use App\User;
use App\Harvest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class RecordController extends Controller
{
    public function index()
    {

     $userRecord = User::paginate();
     return view('admin.record',['userRecord'=>$userRecord]);
    }
    public function edit($record)
    {
        $user = User::find($record);
        $record = $user->record->groupBy('dish_id')->map(function($item){
               return [
                   'sum'=>$item->sum('crop_num'),
                   'dishInfo'=>$item->first()->dish,
               ];
        });
        $ripe = $user->Harvest->groupBy('dish_id')->map(function($item){
            return [
                'sum'=>$item->sum('harvest_num'),
                'dishInfo'=>$item->first()->dish,
            ];
        });

        return view('admin.detail',['record'=>$record,'user'=>$user,'ripe'=>$ripe]);
    }
    public function store(Request$request)
    {
        $result = Harvest::create(['harvest_num' => $request['num'], 'dish_id' => $request['dishId'], 'user_id' => $request['userId']]);
        Record::where('dish_id',$result['dish_id'])->update(['status'=>1]);
       return  new JsonResponse($result);
    }
}

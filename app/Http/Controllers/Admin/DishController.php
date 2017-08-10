<?php

namespace App\Http\Controllers\Admin;

use App\Dish;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Http\JsonResponse;
class DishController extends CommonController
{
    public function index(Request$request)
    {
        $key = $request->input('keywords');
        $cid = $request->input('cid');
        $dish = Dish::when($key,function($query) use ($key){
            return $query->where('name','like','%'.$key.'%');
        })->when(strlen($cid),function($query) use ($cid){
            return $query->where('category_id',$cid);
        })->paginate();
        $node = Category::roots()->get();
        return view('admin.dish',['dish'=>$dish,'node'=>$node]);
    }
    public function create()
    {
        $node = Category::roots()->get();
        return view('admin.adddish',['node'=>$node]);
    }
    public function store(Request$request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'cid' => 'required',
            'thumbImg'=>'required|dimensions:max_width=2000,max_height=2000'

        ]);
        $file = $request->file('thumbImg');
        if($file->isValid()) {
            $clientName = $file->getClientOriginalName();
            $entension = $file->getClientOriginalExtension();
            $newName = md5(date("Y-m-d H:i:s") . $clientName) . "." . $entension;
            $path = $file->move($_SERVER['DOCUMENT_ROOT'] . '/upload', $newName);
            $url = trim(str_replace($_SERVER['DOCUMENT_ROOT'], '', $path));

        }
        Dish::create(['name'=>$request['title'],'category_id'=>$request['cid'],'thumb'=>$url,'desc'=>$request['desc']]);
        return redirect('dish' );
    }
    public function edit($dish)
    {
        $dishs = Dish::find($dish);
        $node = Category::roots()->get();
        return view('admin.updatedish',['dish'=>$dishs,'node'=>$node]);
    }
    public function update(Request$request,$dish)
    {

        $this->validate($request, [
            'title' => 'required|max:255',
            'cid' => 'required',
        ]);
        if($request['thumb']!=null){
            $this->validate($request,[
                'thumbImg'=>'required|dimensions:max_width=2000,max_height=2000'
            ]);
        }
        if($file = $request->file('thumbImg')){
            if($file->isValid()) {
            $clientName = $file->getClientOriginalName();
            $entension = $file->getClientOriginalExtension();
            $newName = md5(date("Y-m-d H:i:s") . $clientName) . "." . $entension;
            $path = $file->move($_SERVER['DOCUMENT_ROOT'] . '/upload', $newName);
            $url = trim(str_replace($_SERVER['DOCUMENT_ROOT'], '', $path));

        }
        }else {
            $url = $request['img'];
        }
        $dishs = Dish::find($dish);
        $dishs->update(['name'=>$request['title'],'thumb'=>$url,'category_id'=>$request['cid'],'desc'=>$request['desc']]);
        return redirect('dish');
    }
    public function show()
    {

    }
    public function destroy($dish)
    {
        $dishs = Dish::find($dish);
        $result =  $dishs->delete();
        return  new JsonResponse($result);
    }
}

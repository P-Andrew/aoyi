<?php

namespace App\Http\Controllers\Admin;

use App\Category;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CategoryController extends CommonController
{

    public function index()
    {

        $node = Category::roots()->paginate();
        return view('admin.category',['node'=>$node]);
    }
    public function create()
    {
        $node = Category::roots()->get();
        return view('admin.addcategory',['node'=>$node]);
    }
    public function store(Request$request)
    {


        if($request['pid']==null) {
            if(!empty($request['title'])) {
                Category::create(['name' => $request['title']]);
            }
            if(!empty($request['list'])){
                $list = trim($request['list']);
                $listArr = explode("\r\n",$list);
                foreach($listArr as $item){
                    Category::create(['name'=>$item]);
                }
            }
        }else{
            if(!empty($request['title'])){
                $category = Category::find($request['pid']);
                $category->children()->create(['name' => $request['title']]);
            }
            if(!empty($request['list'])){
                $list = trim($request['list']);
                $listArr = explode("\r\n",$list);
                $category = Category::find($request['pid']);
                foreach($listArr as $item){
                   $category->children()->create(['name'=>$item]);
                }
            }
        }
        return redirect('category' );
    }
    public function edit($category)
    {
        $categories = Category::find($category);
        $parent = $categories->parent;
        return view('admin.updatecategory',['category'=>$categories,'parent'=>$parent]);
    }
    public function update(Request$request,$category)
    {
        $categories = Category::find($category);
        $categories->update(['name'=>$request['title']]);
        return redirect('category' );
    }
    public function show()
    {

    }
    public function destroy($category)
    {
        $categories = Category::find($category);
        $result =  $categories->delete();
        return  new JsonResponse($result);
    }
}

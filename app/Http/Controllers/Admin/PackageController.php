<?php

namespace App\Http\Controllers\Admin;

use App\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class PackageController extends Controller
{
    public function index()
    {
        $package =  Package::paginate();
        return view('admin.package',['package'=>$package]);
    }
    public function store(Request$request)
    {
       $result = Package::where('id',$request['id'])->update(['express'=>$request['express'],'status'=>1]);
        return  new JsonResponse($result);
    }
    public function edit($packaged)
    {
        $package = Package::find($packaged);
        $detail = $package->vest;
        return view('admin.packagedetail',['detail'=>$detail]);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: zxh
 * Date: 17-3-31
 * Time: 下午5:59
 */
namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class Products extends Controller
{
	/**
	 * method of the products list
	 *
	 * @access puclic
	 * @return View
	 */
	public function index():View
	{dd(123);
		return view('list', ['name'=>'hello']);
	}
}

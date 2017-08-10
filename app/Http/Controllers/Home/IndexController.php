<?php

namespace App\Http\Controllers\Home;

use App\GreenHouse;
use App\Ground;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use ShareBuy\Facades\Visitor;
use Illuminate\Http\JsonResponse;
use GuzzleHttp\Client;


class IndexController extends Controller
{
  public function index()
  {
      $aoyiUser = User::all();
      $shopUser = Visitor::user()->id;
      $isRepeatUser = $aoyiUser->contains($shopUser);
      if(!$isRepeatUser)
      {
          User::create(['id'=>$shopUser]);
      }
      $userGround =  User::find($shopUser)->ground;
      $userHarvest = User::find($shopUser)->vest;
     return view('home.index',['userGround'=>$userGround,'userHarvest'=>$userHarvest]);
  }
  public function house()
  {
      $house = GreenHouse::all();
      return view('home.greenhouse',['house'=>$house]);
  }
  public function ground($id)
  {
    $house = GreenHouse::find($id);
      $user = Visitor::user()->info;
    $ground = $house->subGround()->get();

    return view('home.ground',['ground'=>$ground,'house'=>$house,'user'=>$user]);
  }
  public function confirmPay($id)
  {
      $ground = Ground::find($id);
      $userAddress = count(Visitor::user()->addrs);
      return view('home.chioceground',['ground'=>$ground,'userAddress'=>$userAddress]);
  }
  public function payInfo($id)
  {
      $ground = Ground::find($id);
      $shopUser = Visitor::user()->id;
      $openId = Visitor::user()->open_id;
      if($ground['status'] !=1)
      {
        $ground->update(['status'=>2]);
      }
      $time = time();
      if (!$ground->order) {
              $orderNumber = 'N' . date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
              $result = Order::create(['price' => $ground['price'], 'user_id' => $shopUser, 'ground_id' => $ground['id'], 'status' => 0, 'order_number' => $orderNumber]);
              return view('home.pay', ['ground' => $ground, 'time' => $time, 'openid' => $openId, 'orderNumber' => $result['order_number']]);
          } elseif ($shopUser == $ground->order->user_id && $ground->order->status == 0) {
              return view('home.pay', ['ground' => $ground, 'time' => $time, 'openid' => $openId, 'orderNumber' => $ground->order->order_number]);
          } else {
              return redirect()->back()->with('information', '你来晚了,地已经没了');
          }

  }
  public function pay(Request$request)
  {
      $ground = Ground::find($request['id']);
      if($request['payType']==2){
          try {
              Visitor::user()->recharge(-$ground['price'], '农场支付');
              $ground->update(['status'=>1,'user_id'=>$ground->order->user_id]);
              $ground->order->update(['status'=>1,'pay_type'=>$request['payType']]);
              $this->test($ground->price);
              return  new JsonResponse(['success'=>'支付成功'],200);
          }catch (\Exception $e)
          {
             return new JsonResponse(['error'=>$e->getMessage()],422);
          }


      }

  }
  public function radio($id)
  {
      $ground = Ground::find($id);
      return view('home.chioceground2',['ground'=>$ground]);
  }

  public function callback()
  {

      $order = Order::where('order_number',$_POST['out_trade_no'])->first();
        $ground = $order->ground;
        if($order['status']==0||$order['status']==2){
            if($ground->id == $order['ground_id']){
                $ground->update(['status'=>1,'user_id'=>$order->user_id]);
                $ground->order->update(['status'=>1,'pay_type'=>1]);
                $this->test($ground->price);
            }
        }
  }

  public function test($price)
  {
    $openId = Visitor::user()->open_id;
    $userId = Visitor::user()->id;
    $client = new Client();
    $response = $client->post(config('app.url').'/Api/get_token', ['form_params'=>['openid'=>$openId]]);
    $res = $response->getBody()->getContents();
    $result = json_decode($res);
    $clientGainers = $client->get(config('app.url').'/Api/v1/private/gainers?id='.$userId.'&token='.$result->token);
    $gainers = $clientGainers->getBody()->getContents();
    $gain = json_decode($gainers);

    foreach($gain->result as $value){
        $value->credit_rate>0?\ShareBuy\Models\User::find($value->id)->recharge($value->credit_rate*$price,'农场积分返还'):null;
        $value->point_rate>0?\ShareBuy\Models\User::find($value->id)->recharge($value->point_rate*$price,'农场积分返还','point'):null;
    }
    return true;
  }


}

@include('home.header')
<body>
<section class="g-flexview">
	<header class="m-navbar navbar-bg">
		<a href="javascript:history.back();" class="navbar-item navbar-color">
			<i class="cells-icon back-ico"></i>返回
		</a>
		<div class="navbar-center ">
			<span class="navbar-title navbar-color">种菜</span>
		</div>
	</header>
	@foreach($userGround as $item)
	<div class="zc_me_list">
		<div class="m-cell zc_host">
			<div class="cell-item tit">
			    <div class="cell-left">剩余时间</div>
				<div class="cell-right settime" endTime="{{date("Y-m-d H:i:s",strtotime($item->order->created_at)+$groundLeftTime*24*3600)}}"></div>
			</div>
		    <div class="cell-item tit">
		        <div class="cell-left">{{$item->topHouse->name}}{{$item->name}}</div>
				<div class="cell-right "><span style="color:red">可种({{$item->dish_num}})</span>/<span style="color:green">已种({{$item->croped_num}})</span></div>
		    </div>
		</div>
		<div class="zc_host_list">
			<div class="m-grids-2 st-grids" style="width: 100%">
				@if(time()-strtotime($item->order->created_at)>$groundLeftTime*24*3600)
					<a href="javascript:;" class="btn-block btn-danger">超时不可种</a>
				@elseif($item->croped_num < $item->dish_num)
					<a href="{{route('choose',['id'=>$item->id])}}" class="btn-block btn-primary">种菜</a>
				@else
					<a href="javascript:;" class="btn-block btn-danger">地已种满</a>
				@endif
			</div>
		</div>
	</div>
	@endforeach
</section>
<script  src="{{asset('starm/js/swiper.min.js')}}"></script>

@include('home.footer')
<script language="javascript">
$(function(){
updateEndTime();
});
//倒计时函数
function updateEndTime()
{
var date = new Date();
var time = date.getTime(); //当前时间距1970年1月1日之间的毫秒数

$(".settime").each(function(i){

var endDate =this.getAttribute("endTime"); //结束时间字符串
//转换为时间日期类型
var endDate1 = eval('new Date(' + endDate.replace(/\d+(?=-[^-]+$)/, function (a) { return parseInt(a, 10) - 1; }).match(/\d+/g) + ')');

var endTime = endDate1.getTime(); //结束时间毫秒数

var lag = (endTime - time) / 1000; //当前时间和结束时间之间的秒数
if(lag > 0)
{
var second = Math.floor(lag % 60);
var minite = Math.floor((lag / 60) % 60);
var hour = Math.floor((lag / 3600) % 24);
var day = Math.floor((lag / 3600) / 24);
$(this).html(day+"天"+hour+"小时"+minite+"分"+second+"秒");
}
else
$(this).html("倒计时结束啦！");
});
setTimeout("updateEndTime()",1000);
}
</script>

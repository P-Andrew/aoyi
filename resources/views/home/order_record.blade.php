@include('home.header')
<body>
<section class="g-flexview">
	<header class="m-navbar navbar-bg">
		<a href="javascript:history.back();" class="navbar-item navbar-color">
			<i class="cells-icon back-ico"></i>返回
		</a>
		<div class="navbar-center ">
			<span class="navbar-title navbar-color">全部订单</span>
		</div>
	</header>
	@if(!empty(session('provide')))
		<input type="hidden" name="info" value="{{session('provide')}}" />
	@endif
	@foreach($order as $item)
	<div class="m-cell zc_host">
	    <div class="cell-item tit">
	        <div class="cell-left">{{$item->ground->topHouse->name}} {{$item->ground->name}}</div>
	        <div class="cell-right ">@if($item->status==0)<a style="color:red" href="{{route('confirm',['id'=>$item->ground->id])}}">继续支付</a>@elseif($item->status==1)已完成订单@elseif($item->status==2)已过期订单@endif</div>
	    </div>
	</div>
	<div class="zc_host_list">
		<div class="m-grids-2 st-grids" style="width: 100%">
		    <a class="grids-item">
		        <div class="grids-txt col_eee"><span>{{$item->ground->topHouse->name}} {{$item->ground->name}}</span></div>
		    </a>
		    <a class="grids-item">
		        <div class="grids-txt"><span>X1</span></div>
		    </a>
		</div>
		<h5>总金额<span>{{$item->price}}</span>元</h5>
	</div>
	@endforeach
</section>
@include('home.footer')
<script>
    $(function(){
        var info =  $('input[name="info"]').val();

        if(info) {
            YDUI.dialog.alert(info, function () {


            })
        }
    })
</script>
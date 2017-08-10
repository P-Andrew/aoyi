@include('home.header')
<body>
<section class="g-flexview">
	<header class="m-navbar navbar-bg">
		<a href="javascript:history.back();" class="navbar-item navbar-color">
			<i class="cells-icon back-ico"></i>返回
		</a>
		<div class="navbar-center ">
			<span class="navbar-title navbar-color">种菜记录</span>
		</div>
	</header>
	@foreach($croprecord as $item)
	<div class="m-cell zc_host">
	    <div class="cell-item tit">
	        <div class="cell-left">种植时间</div>
	        <div class="cell-right ">{{$item->created_at}}</div>
	    </div>
	</div>
	<div class="zc_host_list">
		<div class="m-grids-2 st-grids" style="width: 100%">
		    <a class="grids-item">
		        <div class="grids-txt col_eee"><span>{{$item->dish->name}}</span></div>
		    </a>
		    <a class="grids-item">
		        <div class="grids-txt"><span>X{{$item->crop_num}}</span></div>
		    </a>
		</div>
	</div>
	@endforeach

</section>
@include('home.footer')
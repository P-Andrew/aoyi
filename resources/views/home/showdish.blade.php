@include('home.header')
<body>
<section class="g-flexview">
	<header class="m-navbar navbar-bg">
		<a href="{{route('index')}}/" class="navbar-item navbar-color">
			<i class="cells-icon icon-home-outline"></i>
		</a>
		<div class="navbar-center ">
			<span class="navbar-title navbar-color">看菜</span>
		</div>
	</header>
	<div class="g-scrollview choose">
		<div class="m-scrolltab" data-ydui-scrolltab><!-- 添加data-ydui-scrolltab就可以啦 -->
		    <div class="scrolltab-nav">
				@foreach($categories as $category)
		        <a href="javascript:;" class="scrolltab-item">
		            <div class="scrolltab-title">{{$category->name}}</div>
		        </a>

				@endforeach
		    </div>
		    <div class="scrolltab-content">
				@foreach($categories as $category)
		        <div class="scrolltab-content-item">
		            <strong class="scrolltab-content-title">{{$category->name}}</strong>
					<div class="m-cell">
					@foreach($category->subDish as $dish)
							<label class="cell-item">
								<span class="cell-left"><img src="{{$dish->thumb}}" width="70px" height="70px">{{$dish->name}}</span>
							</label>

		            	{{--<div class="st_num_dist">
			            	<a class="decrease">-</a>
			            	<input data-dish="{{$dish->id}}"  name="crop_num" class="text_box"  type="text" value="0">
			            	<a class="increase">+</a>
			            </div>--}}
						@endforeach
					</div>
		        </div>
				@endforeach
		    </div>
		</div>
	</div>
	<footer class="m-tabbar padd0" >
	<div class="m-grids-2 st-grids" style="width: 100%">
	    <a href="{{route('index')}}/" class="grids-item">
	        <div class="grids-txt"><span>取消</span></div>
	    </a>
	    <a href="{{route('site')}}" id="croping" class="grids-item" style="background: #22a837;color:#fff">
	        <div  class="grids-txt col_fff"><span>买地</span></div>
	    </a>
	</div>
    </footer>
</section>
@include('home.footer')



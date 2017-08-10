@include('home.header')
<body>
<section class="g-flexview">
	<header class="m-navbar">
		<a href="{{route('user')}}" class="navbar-item navbar-color">
			<i class="back-ico"></i>返回
		</a>
		<div class="navbar-center ">
			<span class="navbar-title navbar-color">反馈建议</span>
		</div>
		<a href="javascript:history.back();" class="navbar-item navbar-color">
			<img src="{{asset('starm/images/xiaoxi.png')}}" width="18">
		</a>
	</header>
	<div class="g-scrollview">
		<form action="{{route('feedback')}}" method="post">
			{{csrf_field()}}
		<div class="m-cell" style="margin-top: 20px;">
		    <div class="cell-item">
		        <div class="cell-right">
		            <textarea name="context" class="cell-textarea" placeholder="留下你的建议吧，处理完后我们会与您联系的"></textarea>
		        </div>
		    </div>

		</div>
		<div class="marg10">
		<button type="submit" class="btn-block btn-primary">提交</button>
		</div>
		</form>
	</div>
</section>
@include('home.footer')

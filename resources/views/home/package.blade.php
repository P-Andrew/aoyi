@include('home.header')
<body>
<section class="g-flexview">
	<header class="m-navbar navbar-bg">
		<a href="javascript:history.back();" class="navbar-item navbar-color">
			<i class="cells-icon back-ico"></i>返回
		</a>
		<div class="navbar-center ">
			<span class="navbar-title navbar-color">包裹列表</span>
		</div>
	</header>
	@foreach($package as $item)
	<div class="m-cell zc_host">
	    <div class="cell-item tit">
	        <div class="cell-left">收获时间</div>
			<div class="cell-right">{{$item->created_at}}</div>
	    </div>
	</div>
	<div class="zc_host_list">
		<div class="m-grids-2 st-grids" style="width: 100%">
			@foreach($item->vest as $value)
		    <a class="grids-item">
		        <div class="grids-txt col_eee"><span>{{$value->dish->name}}</span></div>
		    </a>
		    <a class="grids-item">
		        <div class="grids-txt"><span>X{{$value->vest_num}}</span></div>
		    </a>
			@endforeach
		</div>
	</div>
	<div class="ckwl">
		@if($item->status ==0)
			<a href="javascript:;" class="btn btn-primary" style="width: 107px;margin-bottom: 10px;margin-right: 10px">暂无物流信息</a>
		@elseif($item->status==1)
			<a href="javascript:;" class="btn btn-danger confirm" data-id="{{$item->id}}" style="width: 107px;margin-bottom: 10px;margin-right: 10px">确认收货</a>
			<a href="javascript:;" class="btn btn-primary" id="sliviler" data-express="{{$item->express}}" style="width: 100px;margin-bottom: 10px;margin-right: 10px">查看物流</a>
		@elseif($item->status==2)
			<a href="javascript:;" class="btn btn-danger" style="width: 107px;margin-bottom: 10px;margin-right: 10px">完成派送</a>
		@endif
	</div>
	@endforeach
</section>
@include('home.footer')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    });
$('.confirm').each(function(){
    var id = $(this).data('id');
    $(this).click(function(){
		YDUI.dialog.confirm('确认收货',function(){
            $.ajax({
                    type: 'post',
                    url: "{{route('complete')}}",
                    data:{'id':id},
                    success: function (data) {
                        if (data) {
							YDUI.dialog.alert('欢迎再次光临',function(){
                                window.location.href = '{{route('index')}}'+'/';
							});

                        }
                    },
                    error: function () {

                    }
                }
            );
		})
	});
})
$('#sliviler').each(function(){
   var express = $(this).data('express');
   $(this).click(function(){
       window.location.href = 'http://wap.guoguo-app.com/wuliuDetail.htm?mailNo='+express;
   });
});
</script>
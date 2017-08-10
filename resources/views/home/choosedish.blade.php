@include('home.header')
<body>
<section class="g-flexview">
	<header class="m-navbar navbar-bg">
		<a href="{{route('index')}}/" class="navbar-item navbar-color">
			<i class="cells-icon icon-home-outline"></i>
		</a>
		<div class="navbar-center ">
			<span class="navbar-title navbar-color">选菜</span>
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
								<label class="cell-right">
									<input data-dish="{{$dish->id}}" type="checkbox" name="crop_num" value="1" >
									<i class="cell-checkbox-icon"></i>
								</label>
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
	    <a href="#" class="grids-item">
	        <div class="grids-txt"><span>取消</span></div>
	    </a>
	    <a href="javascript:;" id="croping" class="grids-item" style="background: #22a837;color:#fff">
	        <div  class="grids-txt col_fff"><span>确认(<i id="total"></i>/{{$ground->dish_num}})</span></div>
	    </a>
	</div>
    </footer>
</section>
@include('home.footer')
<script>
$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    });
/*$('.increase').click(function(){
    var self = $(this);
    var current_num = parseInt(self.siblings('input').val());
    current_num += 1;
    if(current_num > 0){
        self.siblings(".decrease").show();
        self.siblings(".text_box").show();
    }
    self.siblings('input').val(current_num);
    // update_item(self.siblings('input').data('item-id'));
    setTotal();
})
$('.decrease').click(function(){
    var self = $(this);
    var current_num = parseInt(self.siblings('input').val());
    if(current_num > 0){
        current_num -= 1;
        if(current_num < 1){
            self.hide();
            self.siblings(".text_box").hide();
        }
        self.siblings('input').val(current_num);
        // update_item(self.siblings('input').data('item-id'));
    }
    setTotal();
});*/
    $('input[name="crop_num"]').each(function(){
        $(this).click(function(){
            var past =  $('#total').html();
            if($(this).is(':checked')){
                var sum = $(this).val();
                $('#total').html(parseInt(past)+parseInt(sum));
            }else{
                var desc = $(this).val();
                $("#total").html(parseInt(past)-parseInt(desc));
            }
        });
    });
$('#croping').click(function(){

	var selectNum = parseInt($('#total').html());
	var cropNum = parseInt("{{$ground->dish_num}}");
	if(selectNum > cropNum){
        YDUI.dialog.toast('已超过可种种类','error',2000);
	}else if(selectNum < cropNum) {
	    YDUI.dialog.toast('还可以种菜,请继续添加','error',2000);
    }else{
		var data = {};
        $('input[name="crop_num"]').each(function(){
            if($(this).is(':checked')){
                var dishId = $(this).data('dish');
                var num  = $(this).val();
                data[dishId] = num;
            }else{
                var dishId = $(this).data('dish');
                delete data[dishId];
            }
		});
        $.ajax({type:'POST',url:"{{route('croping')}}",data:{'id':"{{$ground->id}}",'selected':data},success:function(data){
                if(data.success)
                {
                    YDUI.dialog.toast('正在给您种菜','success',2000,function(){
                        window.location.href = "{{route('harvest')}}";
                    })
                }
            }, error:function(data){

            }}
        )
	}
});
function setTotal(){
    var s= parseInt("{{$ground->croped_num}}");
	$(".st_num_dist").each(function(){
    s+=parseInt($(this).find('input[class*=text_box]').val());
    });
    $("#total").html(s.toFixed(0));
    }
    setTotal();
})

</script>


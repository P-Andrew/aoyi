@include('home.header')
<body>
<section class="g-flexview">
	<header class="m-navbar">
		<a href="javascript:history.back();" class="navbar-item navbar-color">
			<i class="cells-icon back-ico"></i>返回
		</a>
		<div class="navbar-center ">
			<span class="navbar-title navbar-color">收菜</span>
		</div>
	</header>
	<div class="g-scrollview">
	<div class="st_shoucai_list">
		<h5 class="cs">已成熟</h5>
		<div class="m-cell st_shoucai">
			@foreach($dish as $item)
				<label class="cell-item">
		        <span class="cell-left"><img src="{{$item['dishInfo']['thumb']}}"></span>
					<span class="st_shoucai_tit"><p style="font-size:10px;">种菜时间:{{$item['created_at']}}</p><p>{{$item['dishInfo']['name']}}<i style="font-size:10px;color:#999">X{{$item['sum']}}</i></p></span>

		         <label class="cell-right">
		            <input type="checkbox" name="harvest" value="{{$item['sum']}}" data-dish="{{$item['dishInfo']['id']}}"  class="nub"/>
		            <i class="cell-checkbox-icon"></i>
		        </label>

		    </label>
			@endforeach
		</div>
		<h5 class="cs">未成熟</h5>
		<div class="m-cell st_shoucai">
			@foreach($record as $item)
				<label class="cell-item">
					<span class="cell-left"><img src="{{$item['dishInfo']['thumb']}}"></span>
					<span class="st_shoucai_tit"><p style="font-size:10px;">种菜时间:{{$item['created_at']}}</p><p>{{$item['dishInfo']['name']}}<i style="font-size:10px;color:#999">X{{$item['sum']}}</i></p></span>

					<label class="cell-right">

					</label>

				</label>
			@endforeach
		</div>
	</div>
	</div>
	<!-- 选择地址 -->
	<div class="m-actionsheet starm_address" id="J_ActionSheet2" style="top:0">
			<header class="m-navbar navbar-bg">
				<a class="navbar-item navbar-color" id="J_Cancel">
					<i class="cells-icon back-ico"></i>返回
				</a>
				<div class="navbar-center ">
					<span class="navbar-title navbar-color">选择地址</span>
				</div>
			</header>
			<div style="height: 100%;overflow: auto;">
				<div class="address_list">
					@foreach($userAddress as $address)
					<label class="cell-item">
					      <span class="cell-left"><i class="icon-location"></i></span>
					      <div class="addres">
					      	<p>收货人：{{$address->consignee}}<span>{{$address->tel}}</span></p>
					      	<p>地址：{{$address->province}}{{$address->city}}{{$address->area}}{{$address->addr}}</p>
					      </div>
					      <label class="cell-right">
					          <input type="radio" name="selectAddress" value="{{$address->id}}"/>
					          <i class="cell-checkbox-icon"></i>
					      </label>
					</label>
					@endforeach
				</div>
				<div class="m-cell address_input" id="J_ShowActionSheet3">
						<i></i>
					    <div class="cell-item">
					        <div class="cell-left">新建收菜地址</div>
					        <div class="cell-right cell-arrow"></div>
					    </div>
						<i></i>
				</div>
				<div class="address_main">
					<p>选个地址让我回到你怀抱吧！</p>
					<img src="{{asset('starm/images/address_img.png')}}">
				</div>
			</div>
			<div id="note" class="note" style="display:none;">
				<div class="st_add_tishi">
					<img src="{{asset('starm/images/address_tishi.png')}}">
					<span>温馨提示:每周二固定发货，预计每周三下午五点前到货。</span>
					<a onclick="closeclick()">X</a>
				</div>
			</div>
		<footer class="m-tabbar padd0" style="position: fixed;bottom:0" >
		<div class="m-grids-2 st-grids" style="width: 100%">
		    <a href="#" class="grids-item" id="J_Cancel2">
		        <div class="grids-txt"><span>取消</span></div>
		    </a>
		    <a href="javascript:;" id="send-addr" class="grids-item" style="background: #22a837;color:#fff">
		        <div class="grids-txt col_fff"><span>派送</span></div>
		    </a>
		</div>
		</footer>
	</div>

	<!-- 选择地址 -->


	<footer class="m-tabbar padd0" >
	<div class="m-grids-2 st-grids" style="width: 100%">
	    <a href="#" class="grids-item">
	        <div class="grids-txt"><span>取消</span></div>
	    </a>
	    <a class="grids-item" style="background: #22a837;color:#fff" id="J_ShowActionSheet2">
	        <div id="confirm" class="grids-txt col_fff"><span>确认(<i id="total">0</i>)</span></div>
	    </a>
	</div>
    </footer>

    <!-- 地址 -->
    <div class="sheet3bg" style="display: none"></div>
    <div class="m-actionsheet" id="J_ActionSheet3">

    	<form  class="jsonp" action="{{config('app.url')}}/User/set_addr.html">
    		<div class="m-cell">
    			<div class="cell-item">
    			    <div class="cell-left">姓名：</div>
    			    <div class="cell-right"><input type="text" name="consignee"  class="cell-input" placeholder="请输入收件人姓名" autocomplete="off" /></div>
    			</div>
    			<div class="cell-item">
    			    <div class="cell-left">手机号：</div>
    			    <div class="cell-right"><input type="tel" name="tel" pattern="[0-9]*" class="cell-input" placeholder="请输入手机号" autocomplete="off" /></div>
    			</div>
    			<div class="cell-item">
    				<div class="cell-left">地址：</div>
    				<div class="cell-right" style="-webkit-justify-content: flex-start;">
    					<select name="province" id="cmbProvince" style="height: 1rem;border:0"></select>
    					<select name="city" id="cmbCity"  style="height: 1rem;border:0;padding:0 0.2rem;"> </select>
    					<select name="area" id="cmbArea"  style="height: 1rem;border:0;padding:0 0.2rem;"> </select>
    				</div>
    			</div>
    			<div class="cell-item">
    			    <div class="cell-left">街道：</div>
    			    <div class="cell-right"><input type="text"  name="addr"  class="cell-input" placeholder="请输入具体街道" autocomplete="off"/></div>
    			</div>
    		</div>
    	    <button type="submit" class="btn-block btn-danger" >确认</button>
    	</form>
    </div>
    <!-- 地址 -->



</section>
@include('home.footer')
<script type="text/javascript" src="http://kuangci.mkd.vpinpai.cn/Public/js/form.js"></script>
<script type="text/javascript" src="http://kuangci.mkd.vpinpai.cn/Application/Tpl/Home/mobile/Public/js/jsAddress.js"></script>
<script>
	$(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        });
	    var data = {};
        $('input[name="harvest"]').each(function(){
            $(this).click(function(){
                if($(this).is(':checked')){
                    var dishId = $(this).data('dish');
                    var num  = $(this).val();
                    data[dishId] = num;
                }else{
                    var dishId = $(this).data('dish');
                    delete data[dishId];
				}
			})
		});
		$('#send-addr').click(function(){
		    if(!$('input[name="selectAddress"]').is(':checked')){
		       YDUI.dialog.alert('请选择收菜地址');
			}else{
		        var addrId = $('input[name="selectAddress"]:checked').val();
                $.ajax({type:'POST',url:"{{route('address')}}",data:{'id':addrId,'selected':data},success:function(data){
                        if(data.success)
                        {
                            window.location.href = "{{route('package')}}";
                        }
                    }, error:function(data){

                    }}
                )

			}
		   /* $('input[name="selectAddress"]').each(function(){
		        if(!$(this).is(':checked')){
		            YDUI.dialog.alert('请选择收菜地址');
				}else {

				}
			})*/
		});
	});
</script>
<script type="text/javascript">
//地址管理
!function(){
	addressInit('cmbProvince', 'cmbCity', 'cmbArea', '上海', '杨浦');
	$('#ajxaaddress').submit(function(){
		$.ajax({
			method : 'post',
			url : '{{config('app.url')}}/User/set_addr.html',
			data : $(this).serialize(),
			success: function(d,e,s){
				var ap = document.createElement('div');
				document.body.appendChild(ap);
				$(ap).html(s.responseText);

			}
		})
	});

	var $as = $('#J_ActionSheet');
	window.showError=function(err){
		YDUI.dialog.alert(err);
	}
	window.setAddrLi=function(array){
		$as.actionSheet('close');
		YDUI.dialog.alert('添加成功');
		window.location.reload();
	}
}();

</script>
<script>
	$(function(){
	 $('input[name="harvest"]').each(function(){
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


	});

</script>
<script>
    var $as = $('#J_ActionSheet2');
    var $as3 = $('#J_ActionSheet3');

    $('#J_ShowActionSheet2').on('click', function () {
        if($('#total').html()< 1){
            YDUI.dialog.alert('请选择所要收获的菜');
        }else {
            $as.actionSheet('open');
        }
    });

    $('#J_Cancel').on('click', function () {
        $as.actionSheet('close');
    });
    $('#J_Cancel2').on('click', function () {
        $as.actionSheet('close');
    });

    $('#J_ShowActionSheet3').on('click', function () {
        $as3.actionSheet('open');
        $('.mask-black').hide();
         $('.sheet3bg').show();
    });
    $('.sheet3bg').on('click', function () {
        $as3.actionSheet('close');
         $('.sheet3bg').hide();
    });

</script>
<script type="text/javascript">
	function cookiesave(n, v, mins, dn, path)
	{
	    if(n)
	    {

	     if(!mins) mins = 365 * 24 * 60;
	  if(!path) path = "/";
	     var date = new Date();

	     date.setTime(date.getTime() + (mins * 60 * 1000));

	     var expires = "; expires=" + date.toGMTString();

	     if(dn) dn = "domain=" + dn + "; ";
	     document.cookie = n + "=" + v + expires + "; " + dn + "path=" + path;
	    }
	}
	function cookieget(n)
	{
	    var name = n + "=";
	 var ca = document.cookie.split(';');
	 for(var i=0;i<ca.length;i++) {
	  var c = ca[i];
	  while (c.charAt(0)==' ') c = c.substring(1,c.length);
	  if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
	 }
	 return "";
	}
	function closeclick(){
	 document.getElementById('note').style.display='none';
	 cookiesave('closeclick','closeclick','','','');
	}
	function clickclose(){
	 if(cookieget('closeclick')=='closeclick'){
	  document.getElementById('note').style.display='none';
	 }else{
	  document.getElementById('note').style.display='block';
	 }
	}
	window.onload=clickclose;
</script>

@include('home.header')
<body>
<section class="g-flexview">
	<header class="m-navbar navbar-bg">
		<a href="javascript:history.back();" class="navbar-item navbar-color">
			<i class="cells-icon back-ico"></i>返回
		</a>
		<div class="navbar-center ">
			<span class="navbar-title navbar-color">选择地址</span>
		</div>
	</header>
	<div class="g-scrollview" style="background: #f0ffdb">
		@if(count($userAddress))
		<div class="m-cell address_input" id="J_ShowActionSheet" style="margin-bottom: 0.1rem;">
			<i></i>
			    <div class="cell-item">
			        <div class="cell-left">添加收菜地址</div>
			        <div class="cell-right cell-arrow"></div>
			    </div>
			<i></i>
		</div>
		<div class="address_list">
			@foreach($userAddress as $address)
			<label class="cell-item">
			      <span class="cell-left"><i class="icon-location"></i></span>
			      <div class="addres">
			      	<p>收货人：{{$address->consignee}}<span>{{$address->tel}}</span></p>
			      	<p>地址：{{$address->province}}{{$address->city}}{{$address->area}}{{$address->addr}}</p>
			      </div>
			      <label class="cell-right">
			          <input type="radio" name="radio" checked/>
			          <i class="cell-checkbox-icon"></i>
			      </label>
			</label>
			@endforeach
		</div>
		@else
			<div class="m-cell address_input" id="J_ShowActionSheet" style="margin-bottom: 0.1rem;">
				<i></i>
				<div class="cell-item">
					<div class="cell-left">添加收菜地址</div>
					<div class="cell-right cell-arrow"></div>
				</div>
				<i></i>
			</div>
		<div class="address_main">
			<p>选个地址让我回到你怀抱吧！</p>
			<img src="{{asset('starm/images/address_img.png')}}">
		</div>
		<div id="note" class="note" style="display:none;">
		<div class="st_add_tishi">
			<img src="{{asset('starm/images/address_tishi.png')}}">
			<span>温馨提示：为了保证蔬菜的新鲜，农场今日下午5:00前统一安排收菜并寄出，预计明日下午5点亲啊送达。</span>
			<a onclick="closeclick()">X</a>
		</div>
		@endif
			</div>
		</div>
	</div>
	<div class="m-actionsheet" id="J_ActionSheet">
		<form action="javascript:;" id="ajxaaddress" >
			<div class="m-cell">
				<div class="cell-item">
				    <div class="cell-left">姓名：</div>
				    <div class="cell-right"><input type="text" name="consignee"  class="cell-input" placeholder="请输入收件人姓名" autocomplete="off" /></div>
				</div>
				<div class="cell-item">
				    <div class="cell-left">手机号：</div>
				    <div class="cell-right"><input type="tel" name="tel" pattern="^(((13)|(14)|(15)|(17)|(18))\d{9})|((0[0-9]{2,3}\-)?([2-9][0-9]{6,7})+(\-[0-9]{1,4})?)$" class="cell-input" placeholder="请输入手机号" autocomplete="off" /></div>
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
	<footer class="m-tabbar padd0" >
	<div class="m-grids-2 st-grids" style="width: 100%">
	    <a href="#" class="grids-item">
	        <div class="grids-txt"><span>取消</span></div>
	    </a>
	    <a href="#" class="grids-item" style="background: #22a837;color:#fff">
	        <div class="grids-txt col_fff"><span>派送</span></div>
	    </a>
	</div>
    </footer>
</section>
@include('home.footer')
<script type="text/javascript" src="http://kuangci.mkd.vpinpai.cn/Public/js/form.js"></script>
<script type="text/javascript" src="http://kuangci.mkd.vpinpai.cn/Application/Tpl/Home/mobile/Public/js/jsAddress.js"></script>
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
<script>
    var $as = $('#J_ActionSheet');

    $('#J_ShowActionSheet').on('click', function () {
        $as.actionSheet('open');
    });
    $('#J_Cancel').on('click', function () {
        $as.actionSheet('close');
    });


</script>


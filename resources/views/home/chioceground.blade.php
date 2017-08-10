@include('home.header')
<body style="background: #fff">
<section class="g-flexview">
	<header class="m-navbar">
	   <a href="javascript:history.back();" class="navbar-item navbar-color">
        <i class="cells-icon back-ico"></i>
    </a>
	    <div class="navbar-center ">
	        <span class="navbar-title navbar-color">自选菜地</span>
	    </div>

	</header>
	@if(!empty(session('information')))
		<input type="hidden" name="info" value="{{session('information')}}" />
		@endif
	<div class=" g-scrollview">
		<div class="qrc_quanj">
			<div class="quanj_video">
				<div class="viewo_show">
					<div class="video_hide"><i class="icon-error-outline"></i></div>
					<div class="iframe_box">

                        <iframe src="http://mudu.tv/?a=index&c=show&id=51859&type=mobile" style="border:0;overflow: auto;" allowfullscreen="true"  webkitallowfullscreen="true"  mozallowfullscreen="true"></iframe>
					</div>
				</div>
				<p>大棚全景<span id="J_ShowActionSheet"><a href="{{route('scalevideo')}}">菜地</a></span></p>
			</div>
		</div>

		<div class="qrc_goumai">
			<h5>「推荐菜地」</h5>
			<ul>
				<li><img src="{{asset('starm/images/x.png')}}"></li>
				<li><img src="{{asset('starm/images/x.png')}}"></li>
				<li><img src="{{asset('starm/images/x.png')}}"></li>
				<li><img src="{{asset('starm/images/x.png')}}"></li>
				<li><img src="{{asset('starm/images/x.png')}}"></li>
			</ul>
			<p>{{$ground->topHouse->name}}，{{$ground->name}}</p>
			<div class="pay_btn" id="J_ShowActionSheet3">确认购买</div>
			<span><a href="{{route('site')}}">自选菜地></a></span>
		</div>
	</div>


	<!-- 选择地址 -->


	<!-- 选择地址 -->

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
		    <button  type="submit" class="btn-block btn-danger" >确认</button>
		</form>
	</div>
	<!-- 地址 -->
</section>
@include('home.footer')
<script type="text/javascript" src="http://kuangci.mkd.vpinpai.cn/Public/js/form.js"></script>
<script type="text/javascript" src="http://kuangci.mkd.vpinpai.cn/Application/Tpl/Home/mobile/Public/js/jsAddress.js"></script>
<script>
	$(function(){
	    var info =  $('input[name="info"]').val();

		if(info) {
            YDUI.dialog.alert(info, function () {


            })
        }
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
    var $as3 = $('#J_ActionSheet3');
    var addr = "{{$userAddress}}";
    $('#J_ShowActionSheet3').on('click', function () {
    	if(addr == 0){
	        $as3.actionSheet('open');
	        $('.mask-black').hide();
	         $('.sheet3bg').show();
	     }else{
    	    window.location.href = "{{route('confirm',['id'=>$ground->id])}}";
		}
    });
    $('.sheet3bg').on('click', function () {
        $as3.actionSheet('close');
         $('.sheet3bg').hide();
    });

</script>

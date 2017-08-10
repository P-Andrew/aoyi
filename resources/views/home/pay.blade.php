@include('home.header')
<body>
<section class="g-flexview">
	<header class="m-navbar">
	<a id="cancel-pay" href="javascript:history.back();" class="navbar-item navbar-color">
		<i class="cells-icon back-ico"></i>放弃支付
	</a>
	<div class="navbar-center ">
		<span class="navbar-title navbar-color">自选菜地</span>
	</div>

	</header>
	<div class="g-scrollview">
		<div class="cd_pay_box">
			<div class="cd_pay_top">您已选择&nbsp;{{$ground->topHouse->name}}，{{$ground->name}}</div>
			<h5>选择支付方式</h5>
			<div class="pay_time">
				<h6>支付剩余时间</h6>
				<div class="time" id="time">
                    @if($ground->order)
                       {{\App\System::first()->value('pay_left_time')-floor((time()-strtotime($ground->order->created_at))/60)}}:00
                        <input type="hidden" name="left_time" value="{{\App\System::first()->value('pay_left_time')-floor((time()-strtotime($ground->order->created_at))/60)}}">
                    @else
                     {{\App\System::first()->value('pay_left_time')}}:00
                        <input type="hidden" name="left_time" value="{{\App\System::first()->value('pay_left_time')}}">
                    @endif
				</div>
				<span>已为您锁定此菜地，离开本页面后自动解锁</span>
			</div>
			<label class="cell-item box_bg">
				<span class="cell-left"><img src="{{asset('starm/images/wx.png')}}" width="25px" style="margin-right: 10px">微信支付</span>
				<label class="cell-right">
					<input type="radio" name="pay-type" checked="checked" value="1" />
					<i class="cell-checkbox-icon"></i>
				</label>
			</label>
			<label class="cell-item box_bg">
				<span class="cell-left"><img src="{{asset('starm/images/webwxgetmsgimg.png')}}" width="25px" style="margin-right: 10px">积分支付</span>
				<label class="cell-right">
					<input type="radio" name="pay-type" value="2"  />
					<i class="cell-checkbox-icon"></i>
				</label>
			</label>
		</div>
	</div>
	<footer class="cd-pay-footer">
	<p>总金额：<span id="pay-num">{{$ground->price}}</span>元</p>
		<a id="pay-button" href="javascript:;">确认支付</a>
	</footer>
</section>

@include('home.footer')
<script type="text/javascript">
    $(function(){
        var openId = "{{$openid}}";
        var url = '{{config('app.url')}}/Api/get_token';
        var token =  getToken(url,openId);
        var price = $('#pay-num').html()*100;
        var payInfo = getPayInfo();

		function getPayInfo()
        {
            var parameter;
            $.ajax({
                type:'POST',
                url:'{{config('app.url')}}/Api/v1/private/wx_create_pay',
                async:false,
                data:{'token':token,'order_body':"{{$ground->name}}",'fee':price,'out_trade_no':"{{$orderNumber}}",'notify_url':"{{route('callback')}}"},
                success:function(data){
                    parameter = data.result;
                },
                error:function(data){

                }
            });
            return parameter;
        }
		function getToken(url,openId){
            var result;
            $.ajax({
                type:'POST',
                url:url,
                async:false,
                data:{'openid':openId},
                success:function(data){
                    result = data.token;
                },
                error:function(data){

                }
            });
            return result;
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}',
            }
		});
        $('#cancel-pay').click(function(){
			var url = "{{route('pay')}}";
			fetch(url).then(function(response){
			    return response.json();
			}).then(function(json){
			    console.log(json);
			})
		});
        $('#pay-button').click(function(){
			var id = "{{$ground->id}}";
            var limitTime = "{{$time}}";
            var payType = $('input[name="pay-type"]:checked').val();
            if(payType == 2) {
                YDUI.dialog.loading.open('正在支付...');
                $.ajax({
                        type: 'POST',
                        url: "{{route('pay')}}",
                        data: {'id': id, 'payType': payType, 'limitTime': limitTime},
                        success: function (data) {
                            if (data.success) {
                                YDUI.dialog.loading.close();
                                YDUI.dialog.toast('支付成功', 'success', 200, function () {
                                    window.location.href = "{{route('crop')}}";
                                })
                            }
                        },
                        error: function (data) {
                            if (data.error) {
                                YDUI.dialog.loading.close();
                                YDUI.dialog.toast('余额不足，请充值', 'error', function () {

                                })
                            }
                        }
                    }
                )
            }else if(payType ==1){
                callpay();
                function callpay()
                {
                    if (typeof WeixinJSBridge == "undefined"){
                        if( document.addEventListener ){
                            document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
                        }else if (document.attachEvent){
                            document.attachEvent('WeixinJSBridgeReady', jsApiCall);
                            document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
                        }
                    }else{
                        jsApiCall();
                    }
                }
				function jsApiCall()
                {

                    WeixinJSBridge.invoke(
                        'getBrandWCPayRequest',
                         payInfo,
                        function(res){
                            if(res.err_msg == 'get_brand_wcpay_request:cancel')
                            {
                              YDUI.dialog.alert('支付已取消');
                            }else if(res.err_msg == 'get_brand_wcpay_request:ok'){
                              YDUI.dialog.alert('支付成功',function(){
                                  window.location.href = "{{route('crop')}}";
                              })
                            }else{
                                YDUI.dialog.alert('支付失败');
                            }
                            console.log(res.err_msg);
                            WeixinJSBridge.log(res.err_msg.get_brand_wcpay_request);
                            /*alert(res.err_code+res.err_desc+res.err_msg);*/
                        }
                    );
                }
			}
        })
    });
	$(function(){
	    var m=$('input[name="left_time"]').val()-1;
	    var s=59;
	    setInterval(function(){
	        if(s<10){
	            $('#time').html(m+':0'+s);
	        }else{
	            $('#time').html(m+':'+s);
	        }
	        s--;
	        if(s<0){
	            s=0;

	        }
	    },1000)
	})

</script>



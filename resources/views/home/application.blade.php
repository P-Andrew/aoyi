@include('home.header')
<body>
<section class="g-flexview">
	<header class="m-navbar">
		<a href="javascript:history.back();" class="navbar-item navbar-color">
			<i class="back-ico"></i>返回
		</a>
		<div class="navbar-center ">
			<span class="navbar-title navbar-color">申请开票</span>
		</div>
		<a href="javascript:history.back();" class="navbar-item navbar-color">
			<img src="{{asset('starm/images/xiaoxi.png')}}" width="18">
		</a>
	</header>
	<div class="g-scrollview">
	<form action="{{route('send')}}" method="post">
	{{csrf_field()}}
	<div class="m-cell">
		<div class="cell-item">
			<label class="cell-right cell-arrow">
				<select class="cell-select type" name="class">
					<option value="">发票类型</option>
					<option value="1">增值税普通发票</option>
					<option value="2">增值税专用发票</option>
				</select>
			</label>
		</div>
		<div class="cell-item">
			<label class="cell-right cell-arrow">
				<select class="cell-select" name="order_number">
					<option value="">开票订单编号</option>
					@foreach($order_number as $number)
						<option value="{{$number->order_number}}">{{$number->order_number}}</option>
					@endforeach
				</select>
			</label>
		</div>
	<div class="cell-item">
		<div class="cell-left">开票抬头：</div>
		<div class="cell-right"><input type="text"  name="title" class="cell-input" placeholder="请输入开票抬头" autocomplete="off" /></div>
	</div>
		<div class="cell-item">
			<div class="cell-left">开票税号：</div>
			<div class="cell-right"><input type="text" name="tax_number" class="cell-input" placeholder="请输入开票税号" autocomplete="off" /></div>
		</div>
		<div class="cell-item">
			<div class="cell-left">开票金额：</div>
			<div class="cell-right"><input type="number" name="cash" class="cell-input" placeholder="请输入开票金额" autocomplete="off" /></div>
		</div>
		<div class="cell-item " >
			<div class="cell-left">地址：</div>
			<div class="cell-right"><input type="text" name="address" class="cell-input" placeholder="请输入地址" autocomplete="off" /></div>
		</div>
		<div class="cell-item ">
			<div class="cell-left">电话：</div>
			<div class="cell-right"><input type="number"  name="phone" class="cell-input" placeholder="请输入电话" autocomplete="off" /></div>
		</div>
		<div class="cell-item pro" style="display:none">
			<div class="cell-left">开户行帐号：</div>
			<div class="cell-right"><input type="text"  name="bank_account" class="cell-input" placeholder="请输入开户行帐号" autocomplete="off" /></div>
		</div>

		<button type="submit" class="btn-block btn-primary">提交申请</button>
	</div>
		</form>
	</div>

</section>

@include('home.footer')
@if(count($errors) > 0)
	<div class="alert alert-danger" style="display:none">
		<ul>
			@foreach ($errors->all() as $error)
				<li class="error">{{$error}}</li>
			@endforeach
		</ul>
	</div>
<script>
    var error = document.getElementsByClassName('error');
    if(error.length >0){
        YDUI.dialog.alert(error[0].innerHTML);
    }
</script>
@endif
<script>
    $(function(){
        $('.type').change(function(){
            var type=$(this).val();
            if(type == 1){
                $('.pro').hide();
            }else{
                $('.pro').show();
            }
        });

    });
</script>

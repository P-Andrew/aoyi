@include('admin.header')
<div class="admin">
    <div class="panel admin-panel">
        <div class="panel-head"><strong><span class="icon-pencil-square-o"></span> 网站信息</strong></div>
        <div class="body-content">
            <div class="body-content">
                <form method="post" class="form-x" action="{{route('configure')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <div class="label">
                            <label>公司名称：</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input w50"  name="company_name" value="{{$system->company_name}}" />
                            <div class="tips"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label" style="padding-top:26px">
                            　 <label>公司logo<span style="font-size:10px;color:lightslategrey;"></span>：</label>
                        </div>
                        <div class="uploader blue">
                            <input type="text" class="filename" readonly/>
                            <input type="button" name="file" class="button" value="点击上传..."/>
                            <input type="file" size="30" name="company_logo" id="f" onchange="change()"/>

                            <input type="hidden" name="logo" value="{{$system->company_log}}" >
                        </div>
                        <span>
                            <img style="border-radius:50%;width:60px;height:60px;border:1px solid green" src="{{--{{$system->company_log}}--}}"  alt="">
                        </span>
                        {{--<div style="margin-top:-14px;margin-bottom:20px;">
                            <img style="--}}{{--width:200px" id="preview" src="" alt="" name="pic">

                        </div>--}}
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label>公司地址：</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input w50"  name="company_address" value="{{$system->company_address}}" />
                            <div class="tips"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label>客服电话：</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input w50"  name="server_phone" value="{{$system->server_phone}}"/>
                            <div class="tips"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label>订单过期时间：</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input w50"  name="pay_left_time" value="{{$system->pay_left_time}}" />
                            <div class="tips">默认为15分钟</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label>种菜剩余时间：</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input w50"  name="ground_left_time" value="{{$system->ground_left_time}}" />
                            <div class="tips">默认为7天</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label>帮助教程：</label>
                        </div>
                        <div class="field">
                           {{-- <textarea class="input" name="help" style="height:90px;" >{{$system->help}}</textarea>--}}
                            <textarea id="help" name="help" type="text/plain" style="width:1024px;height:350px;">{{$system->help}}</textarea>
                            <div class="tips"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label>关于內容：</label>
                        </div>
                        <div class="field">
                           {{-- <textarea class="input" name="about" style="height:90px;" >{{$system->about}}</textarea>--}}
                            <textarea id="about" name="about" type="text/plain" style="width:1024px;height:350px;">{{$system->about}}</textarea>
                            <div class="tips"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label>推荐分享：</label>
                        </div>
                        <div class="field">
                            <textarea id="desc" name="desc" type="text/plain" style="width:1024px;height:350px;">{{$system->desc}}</textarea>
                            <div class="tips"></div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-group">
                        <div class="label">
                            <label></label>
                        </div>
                        <div class="field">
                            <button class="button bg-main icon-check-square-o" type="submit">提交</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('admin.footer')
<script type="text/javascript" charset="utf-8" src="{{asset('ueditor/ueditor.config.js')}}"></script>
<script type="text/javascript" charset="utf-8" src="{{asset('ueditor/ueditor.all.min.js')}}"> </script>
<script type="text/javascript" charset="utf-8" src="{{asset('ueditor/lang/zh-cn/zh-cn.js')}}"></script>
<script>
    var desc = UE.getEditor('desc');
    desc.ready(function(){
        desc.execCommand('serverparam','_token','{{ csrf_token()}}');
    });
    var help = UE.getEditor('help');
    help.ready(function(){
        help.execCommand('serverparam','_token','{{ csrf_token()}}');
    });
    var about = UE.getEditor('about');
    about.ready(function(){
        about.execCommand('serverparam','_token','{{ csrf_token()}}');
    });
    $(function(){
        $("input[type=file]").change(function(){$(this).parents(".uploader").find(".filename").val($(this).val());});
        $("input[type=file]").each(function(){
            if($(this).val()==""){$(this).parents(".uploader").find(".filename").val("未选择文件...");}
        });
    });

    function change() {
        var pic = document.getElementById("preview"),
            file = document.getElementById("f");

        var ext = file.value.substring(file.value.lastIndexOf(".") + 1).toLowerCase();

        // gif在IE浏览器暂时无法显示
        if (ext != 'png' && ext != 'jpg' && ext != 'jpeg') {
            alert("图片的格式必须为png或者jpg或者jpeg格式！");
            return;
        }
        var isIE = navigator.userAgent.match(/MSIE/) != null,
            isIE6 = navigator.userAgent.match(/MSIE 6.0/) != null;

        if (isIE) {
            file.select();
            var reallocalpath = document.selection.createRange().text;

            // IE6浏览器设置img的src为本地路径可以直接显示图片
            if (isIE6) {
                pic.src = reallocalpath;
            } else {
                // 非IE6版本的IE由于安全问题直接设置img的src无法显示本地图片，但是可以通过滤镜来实现
                pic.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='image',src=\"" + reallocalpath + "\")";
                // 设置img的src为base64编码的透明图片 取消显示浏览器默认图片
                pic.src = 'data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==';
            }
        } else {
            html5Reader(file);
        }
    }

    function html5Reader(file) {
        var file = file.files[0];
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function (e) {
            var pic = document.getElementById("preview");
            pic.src = this.result;
        }
    }

</script>

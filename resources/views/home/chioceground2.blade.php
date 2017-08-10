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
                <p>大棚全景<span id="J_ShowActionSheet"><a href="{{route('scalevideo')}}">菜地>></a></span></p>
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
            @if($ground->user)
                <p style="margin:5px 0;padding:10px 0;font-size:0.27rem;background:#14800f;color:#ffffff;border-radius:2px;">购买人:<span style="font-size:0.3rem;font-weight:normal">{{\ShareBuy\Models\User::find($ground->user->id)->info->nickname}}</span></p>
            @else

            @endif
            <p style="margin:5px 0">{{$ground->topHouse->name}}，{{$ground->name}}</p>
            <span><a href="{{route('site')}}">自选菜地></a></span>
        </div>
    </div>
</section>
@include('home.footer')
<script>
    $(function(){
        var info =  $('input[name="info"]').val();

        if(info) {
            YDUI.dialog.alert(info, function () {


            })
        }
    });
</script>

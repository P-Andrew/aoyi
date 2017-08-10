
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/pintuer.js')}}"></script>
<div style="text-align:center;">
    <p>技术支持:<a href="javascript:;">猫口袋</a></p>
</div>
<script type="text/javascript">
    $(function(){
        $(".leftnav h2").click(function(){
            $(this).next().slideToggle(200);
            $(this).toggleClass("on");
        })
        $(".leftnav ul li a").click(function(){
            $("#a_leader_txt").text($(this).text());
            $(".leftnav ul li a").removeClass("on");
            $(this).addClass("on");
        })
    });
</script>
</body>
</htm>
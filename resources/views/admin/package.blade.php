@include('admin.header')
<div class="admin">
<form method="get" action="{{route('dish.index')}}" id="listform">
    <div class="panel admin-panel">
        <div class="panel-head"><strong class="icon-reorder"> 内容列表</strong>
        <div class="padding border-bottom">
           {{-- <ul class="search" style="padding-left:10px;">
                <li> <a class="button border-main icon-plus-square-o" href="{{route('dish.create')}}"> 添加内容</a> </li>
                <li>搜索：</li>
                <if condition="$iscid eq 1">
                    <li>
                        <select name="cid" class="input" style="width:200px; line-height:17px;" >
                            <option value="">请选择分类</option>
                            @foreach($node as $cate)
                                <option value="{{old($cate->id)??$cate->id}}">{!!str_repeat('├',$cate->depth)!!}{{old($cate->name)??$cate->name}}</option>
                                @include('admin.option',['cateid'=>$cate->id])
                            @endforeach
                        </select>
                    </li>
                </if>
                <li>
                    <input type="text" placeholder="请输入搜索关键字" name="keywords" class="input" style="width:250px; line-height:17px;display:inline-block" />
                    <button type="submit" class="button border-main icon-search" > 搜索</button></li>
            </ul>--}}
        </div>
        <table class="table table-hover text-center">
            <tr>
                <th>Id</th>
                <th>收获人</th>
                <th>电话</th>
                <th>地址</th>
                <th>快递单号</th>
                <th>包裹状态</th>
                <th width="310">操作</th>
            </tr>
            <volist name="list" id="vo">
                @foreach($package as $item)
                <tr>
                    <td width="10%">{{$item->id}}</td>
                    <td>{{$item->consignee}}</td>
                    <td>{{$item->iphone}}</td>
                    <td>{{$item->address}}</td>
                    <td data-id="{{$item->id}}" class="tracking" contenteditable="true">{{$item->express}}</td>
                    <td>@if($item->status == 0)未寄送@elseif($item->status==1)已寄送@else已收货@endif</td>
                    <td><div class="button-group"> <a class="button border-main" href="{{route('packaged.edit',['packaged'=>$item->id])}}"><span class="icon-edit"></span>查看详情</a></div></td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="8"><div class="pagelist">{{$package->links()}}</div></td>
                </tr>
            </volist>
        </table>
    </div>
</div>
@include('admin.footer')
<script src="{{asset('layer/layer.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    });
    $('.tracking').each(function(){
        var id = $(this).data('id');
        $(this).focus(function(){
            layer.tips('填写快递单号',$(this),{tips:[4,'#0ae']});
        });
        $(this).blur(function(){
            var express = $(this).html();
            $.ajax({
                    type: 'post',
                    url: "{{route('packaged.store')}}",
                    data:{'id':id,'express':express},
                    success: function (data) {
                        if (data) {
                           /* window.location.href = ''*/
                        }
                    },
                    error: function () {

                    }
                }
            );
        })
    });
    </script>
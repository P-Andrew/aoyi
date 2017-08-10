@include('admin.header')
<div class="admin">
<form method="get" action="" id="listform">
    <div class="panel admin-panel">
        <div class="panel-head"><strong class="icon-reorder"> 内容列表</strong> <a href="" style="float:right; display:none;"></a></div>
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
                <th width="100" style="text-align:left; padding-left:20px;">ID</th>
                <th>反馈用户</th>
                <th>反馈内容</th>
                <th>反馈提交时间</th>
            </tr>
            <volist name="list" id="vo">
                @foreach($feedback as $item)
                <tr>
                    <td style="text-align:left; padding-left:20px;">{{$item->id}}</td>
                    <td>{{\ShareBuy\Models\User::find($item->user)->getInfoAttribute()->nickname}}</td>
                    <td>{{$item->content}}</td>
                    <td>{{$item->created_at}}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="8"><div class="pagelist">{{$feedback->links()}}</div></td>
                </tr>
            </volist>
        </table>
    </div>
</form>
</div>
@include('admin.footer')

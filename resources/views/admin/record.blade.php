@include('admin.header')
<div class="admin">
<form method="get" action="{{route('dish.index')}}" id="listform">
    <div class="panel admin-panel">
        <div class="panel-head"><strong class="icon-reorder"> 内容列表</strong> <a href="" style="float:right; display:none;">添加字段</a></div>
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
                <th>种菜人</th>
                <th>已种菜数量</th>
                <th>未成熟数量</th>
                <th>已成熟数量</th>
                <th>待收菜数量</th>
                <th>已收菜数量</th>
                <th width="310">操作</th>
            </tr>
            <volist name="list" id="vo">
                @foreach($userRecord as $item)
                    @if(count($item->ground))
                <tr>
                    <td width="10%">{{$item->user->info->nickname}}</td>
                    <td>{{$item->record()->sum('crop_num')}}</td>
                    <td>{{$item->record()->sum('crop_num')-$item->harvest()->sum('harvest_num')}}</td>
                    <td>{{$item->harvest()->sum('harvest_num')}}</td>
                    <td>{{$item->harvest()->sum('harvest_num')-$item->vest()->sum('vest_num')}}</td>
                    <td>{{$item->vest()->sum('vest_num')}}</td>
                    <td><div class="button-group"> <a class="button border-main" href="{{route('record.edit',['record'=>$item->id])}}"><span class="icon-edit"></span>查看详情</a></div></td>
                </tr>
                    @else
                    @endif
                @endforeach
                <tr>
                    <td colspan="8"><div class="pagelist">{{$userRecord->links()}}</div></td>
                </tr>
            </volist>
        </table>
    </div>
</form>
</div>
@include('admin.footer')
<script src="{{asset('layer/layer.js')}}"></script>
<script>
    function del(id) {
        layer.msg('确定删除该产品？', {
            time: 0,
            btn: ['确定', '再想想'],
            yes: function (index) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    }
                });
                $.ajax({
                        type: 'DELETE',
                        url: "{{route( 'dish.destroy', [ 'category'=>'%d' ] ) }}".replace('%d', id),
                        success: function (data) {
                            if (data) {
                                window.location.href = '';
                            }
                        },
                        error: function () {

                        }
                    }
                );
                layer.close(index);
            }
        })
    }
</script>
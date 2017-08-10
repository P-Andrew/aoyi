@include('admin.header')
<div class="admin">
<form method="get" action="{{route('ground.index')}}" id="listform">
    <div class="panel admin-panel">
        <div class="panel-head"><strong class="icon-reorder"> 内容列表</strong> <a href="" style="float:right; display:none;">添加字段</a></div>
        <div class="padding border-bottom">
            <ul class="search" style="padding-left:10px;">
                <li> <a class="button border-main icon-plus-square-o" href="{{route('ground.create')}}"> 添加内容</a> </li>
                <li>搜索：</li>
                <if condition="$iscid eq 1">
                    <li>
                        <select name="house_id" class="input" style="width:200px; line-height:17px;" >
                            <option value="">请选择大棚</option>
                                @foreach($house as $item)
                                    <option value="{{$item->id}}">{{old('house_id')??$item->name}}</option>
                                @endforeach

                        </select>
                    </li>
                </if>
                <li>
                    <input type="text" placeholder="请输入搜索关键字" name="keywords" class="input" style="width:250px; line-height:17px;display:inline-block" />
                    <button type="submit" class="button border-main icon-search" > 搜索</button></li>
            </ul>
        </div>
        <table class="table table-hover text-center">
            <tr>
                <th width="100" style="text-align:left; padding-left:20px;">ID</th>
                <th>名称</th>
                <th>所属大棚</th>
                <th>价格</th>
                <th>可种植菜种类数</th>
                <th>菜地是否可用</th>
                <th>排序</th>
                <th width="310">操作</th>
            </tr>
            <volist name="list" id="vo">
                @foreach($ground as $item)
                <tr>
                    <td style="text-align:left; padding-left:20px;">{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td width="10%">@if($item->topHouse){{\App\Ground::find($item->id)->topHouse->name}}@else @endif</td>
                    <td>{{$item->price}}</td>
                    <td>{{$item->dish_num}}</td>
                    <td>@if($item->able ==1)可用@else不可用@endif</td>
                    <td>{{$item->sort}}</td>
                    <td><div class="button-group"> <a class="button border-main" href="{{route('ground.edit',['ground'=>$item->id])}}"><span class="icon-edit"></span> 修改</a> <a class="button border-red" href="javascript:void(0)" onclick="del({{$item->id}})"><span class="icon-trash-o"></span> 删除</a> </div></td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="8"><div class="pagelist">{{$ground->links()}}</div></td>
                </tr>
            </volist>
        </table>
    </div>
</form>
</div>
@include('admin.footer')
<script src="{{asset('layer/layer.js')}}"></script>
<script>
    function del(id){
        layer.msg('确定删除此菜地？',{
                time:0,
                btn:['确定','再想想'],
                yes:function(index){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': '{{csrf_token()}}'
                        }
                    });
                    $.ajax({type:'DELETE',url:"{{route( 'ground.destroy', [ 'ground'=>'%d' ] ) }}".replace('%d',id),success:function(data){
                            if(data){
                                window.location.href='';
                            }
                        }, error:function(){

                        }}
                    );
                    layer.close(index);
                }
            })


    }
</script>
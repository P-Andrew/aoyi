@include('admin.header')
<div class="admin">
<form method="get" action="{{route('dish.index')}}" id="listform">
    <div class="panel admin-panel">
        <div class="panel-head"><strong class="icon-reorder"> 内容列表</strong> <a href="" style="float:right; display:none;">添加字段</a></div>
        <div class="padding border-bottom">
            <ul class="search" style="padding-left:10px;">
                <li> <a class="button border-main icon-plus-square-o" href="{{route('house.create')}}"> 添加内容</a> </li>
                {{--<li>搜索：</li>
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
                    <button type="submit" class="button border-main icon-search" > 搜索</button></li>--}}
            </ul>
        </div>
        <table class="table table-hover text-center">
            <tr>
                <th width="100" style="text-align:left; padding-left:20px;">ID</th>
                <th>大棚名称</th>
                <th>菜地数量</th>
                <th>已种数量</th>
                <th>描述</th>
                <th width="310">操作</th>
            </tr>
            <volist name="list" id="vo">
                @foreach($house as $item)
                <tr>
                    <td style="text-align:left; padding-left:20px;">{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td width="10%">{{$item->ground_num}}</td>
                    <td>{{count($item->subGround()->whereNotNull('user_id')->get())}}</td>
                    <td>{{$item->desc}}</td>
                    <td><div class="button-group"> <a class="button border-main" href="{{route('house.edit',['house'=>$item->id])}}"><span class="icon-edit"></span> 修改</a> <a class="button border-red" href="javascript:void(0)" onclick="del('{{$item->id}}','{{count($item->subGround)}}')"><span class="icon-trash-o"></span> 删除</a> </div></td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="8"><div class="pagelist">{{$house->links()}}</div></td>
                </tr>
            </volist>
        </table>
    </div>
</form>
</div>
@include('admin.footer')
<script src="{{asset('layer/layer.js')}}"></script>
<script>
    function del(id,children){

      if(parseInt(children)){
            layer.msg('该大棚中已有菜地，请谨慎删除？',{
                time:0,
                btn:['确定','再想想'],
                yes:function(index){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': '{{csrf_token()}}'
                        }
                    });
                    $.ajax({type:'DELETE',url:"{{route( 'house.destroy', [ 'house'=>'%d' ] ) }}".replace('%d',id),success:function(data){
                            if(data){
                                window.location.href='';
                            }
                        }, error:function(){

                        }}
                    );
                    layer.close(index);
                }
            })
        }else{
            layer.msg('确定删除此大棚？',{
                time:0,
                btn:['确定','再想想'],
                yes:function(index){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': '{{csrf_token()}}'
                        }
                    });
                    $.ajax({type:'DELETE',url:"{{route( 'house.destroy', [ 'house'=>'%d' ] ) }}".replace('%d',id),success:function(data){
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

    }
</script>
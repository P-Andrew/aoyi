@include('admin.header')
<div class="admin">
<div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder">分类列表</strong></div>
    <div class="padding border-bottom">
        <button type="button" class="button border-yellow" onclick="window.location.href='{{route('category.create')}}'"><span class="icon-plus-square-o"></span> 添加分类</button>
    </div>
    <table class="table  text-center" id="cate">
        <tr>
            <th width="5%">ID</th>
            <th width="10%" style="text-align:left">分类名称</th>
            <th width="10%">操作</th>
        </tr>
        @foreach($node as $cate)
        <tr>
            <td>{{$cate->id}}</td>
            <td align="left" >{!!str_repeat('├',$cate->depth)!!}{{$cate->name}}</td>
            <td><div class="button-group"> <a class="button border-main" href="{{route('category.edit',['category'=>$cate->id])}}"><span class="icon-edit"></span> 修改</a> <a class="button border-red" href="javascript:void(0)" onclick="return del('{{$cate->id}}','{{count($cate->children)}}')"><span class="icon-trash-o"></span> 删除</a> </div></td>
        </tr>
            @include('admin.foreach',['cateid'=>$cate->id])
       @endforeach
        <tr>
            <td colspan="8"><div class="pagelist">  {{$node->links()}} </div></td>
        </tr>
    </table>
</div>
</div>

@include('admin.footer')
<script src="{{asset('layer/layer.js')}}"></script>
<script type="text/javascript">
function del(id,parent){

if(parseInt(parent)){
   layer.msg('该分类下存在子分类，确定删除？',{
       time:0,
       btn:['确定','再想想'],
       yes:function(index){
           $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': '{{csrf_token()}}'
               }
           });
           $.ajax({type:'DELETE',url:"{{route( 'category.destroy', [ 'category'=>'%d' ] ) }}".replace('%d',id),success:function(data){
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
    layer.msg('确定删除此分类？',{
        time:0,
        btn:['确定','再想想'],
        yes:function(index){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });
            $.ajax({type:'DELETE',url:"{{route( 'category.destroy', [ 'category'=>'%d' ] ) }}".replace('%d',id),success:function(data){
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

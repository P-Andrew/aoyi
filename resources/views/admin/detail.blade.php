@include('admin.header')
<div class="admin">
<form method="get" action="{{route('dish.index')}}" id="listform">
    <div class="panel admin-panel">
        <div class="panel-head"><strong class="icon-reorder"> {{$user->user->info->nickname}}</strong>种菜详情</div>
        <div class="padding border-bottom">
        </div>
        <table class="table table-hover text-center">
            <tr>
                <th>Id</th>
                <th>已种菜名</th>
                <th>缩略图</th>
                <th>已种菜数</th>
                <th>已成熟数</th>
                <th width="310">操作</th>
            </tr>
            <volist name="list" id="vo">
                @foreach($record as $key=>$item)
                    <tr>
                    <td  width="10%">{{$item['dishInfo']['id']}}</td>
                    <td>{{$item['dishInfo']['name']}}</td>
                    <td><img src="{{$item['dishInfo']['thumb']}}" alt="" width="70" height="50" /></td>
                    <td class="sum">{{$item['sum']}}</td>
                    <td>{{$ripe[$key]['sum']??0}}</td>
                    <td><div class="button-group"><a  class="button border-main prompt" data-dish="{{$item['dishInfo']['id']}}" href="javascript:;"><span class="icon-edit"></span>成熟</a></div></td>
                </tr>

                @endforeach
                <tr>

                </tr>
            </volist>
        </table>
    </div>
</form>
</div>
@include('admin.footer')
<script src="{{asset('layer/layer.js')}}"></script>
<script>
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        });
        var userId = "{{$user->user->id}}";
        $('.prompt').each(function(){
            $(this).click(function(){
               var sum = $(this).parent().parent().prev().prev().html();
               var harvest = $(this).parent().parent().prev().html();
               var min = sum-harvest;
               var dishId = $(this).data('dish');
               layer.prompt({title:'输入已成熟菜的数量,并确定',formType:0},function(text,index){
                   var preg = /^[1-9]*[1-9][0-9]*$/;
                   if(!preg.test(text)){
                       alert('请输入正整数');
                   }else if(parseInt(text)>parseInt(min)){
                       alert('可用菜不足');
                   }else{
                       $.ajax({
                               type: 'post',
                               url: "{{route('record.store')}}",
                               data:{'num':text,'dishId':dishId,'userId':userId},
                               success: function (data) {
                                   if (data) {
                                      window.location.href = ''
                                   }
                               },
                               error: function () {

                               }
                           }
                       );
                   }


               });


            });
        });
    });
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
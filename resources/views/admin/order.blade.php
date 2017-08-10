@include('admin.header')
<div class="admin">
<form method="get" action="{{route('order.index')}}" id="listform">
    <div class="panel admin-panel">
        <div class="panel-head"><strong class="icon-reorder"> 内容列表</strong> <a href="" style="float:right; display:none;">添加字段</a></div>
        <div class="padding border-bottom">
           <ul class="search" style="padding-left:10px;">
               {{-- <li> <a class="button border-main icon-plus-square-o" href="{{route('dish.create')}}"> 添加内容</a> </li>--}}
                <li>搜索：</li>
                <if condition="$iscid eq 1">
                    <li>
                        <select name="status" class="input" style="width:200px; line-height:17px;" >
                            <option value="">选择订单状态</option>
                            <option value="0">未付款</option>
                            <option value="1">已付款</option>
                            <option value="2">已过期</option>
                        </select>
                    </li>
                </if>
                <li>
                    <input type="text" placeholder="请输入订单编号" name="order-item" class="input" style="width:250px; line-height:17px;display:inline-block" />
                    <button type="submit" class="button border-main icon-search" > 搜索</button></li>
            </ul>
        </div>
        <table class="table table-hover text-center">
            <tr>
                <th width="100" style="text-align:left; padding-left:20px;">ID</th>
                <th>订单号</th>
                <th>土地名称</th>
                <th>购买人(真实姓名)</th>
                <th>手机号码</th>
                <th>地址</th>
                <th>订单状态</th>
                <th>支付方式</th>
                <th>支付金额</th>
                <th width="10%">下单时间</th>
            </tr>
            <volist name="list" id="vo">
                @foreach($order as $item)
                <tr>
                    <td style="text-align:left; padding-left:20px;">{{$item->id}}</td>
                    <td>{{$item->order_number}}</td>
                    <td width="10%">{{$item->ground->topHouse->name}} {{$item->ground->name}}</td>
                    <td>{{\ShareBuy\Models\User::find($item->user)->getInfoAttribute()->nickname}}@if(count(\ShareBuy\Models\User::find($item->user)->addrs()->get()))({{\ShareBuy\Models\User::find($item->user)->addrs()->get()->last()->consignee}})@else @endif</td>
                    <td>@if(\ShareBuy\Models\User::find($item->user)->getMobileAttribute()){{\ShareBuy\Models\User::find($item->user)->getMobileAttribute()}}@else @endif</td>
                    <td>@if(count(\ShareBuy\Models\User::find($item->user)->addrs()->get()))
                        {{\ShareBuy\Models\User::find($item->user)->addrs()->get()->last()->province}}
                        {{\ShareBuy\Models\User::find($item->user)->addrs()->get()->last()->city}}
                        {{\ShareBuy\Models\User::find($item->user)->addrs()->get()->last()->area}}
                        {{\ShareBuy\Models\User::find($item->user)->addrs()->get()->last()->addr}}
                        @else
                        @endif
                    </td>
                    <td> @if($item->status == 0)<span style="color:red">未付款</span>@elseif($item->status == 1)<span style="color:green">已付款</span>@elseif($item->status=2)<span style="color:darkgray">已过期</span>@endif</td>
                    <td>@if($item->status == 1) @if($item->pay_type==1)微信支付@else积分支付@endif  @endif</td>
                    <td>{{$item->price}}</td>
                    <td>{{$item->created_at}}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="8"><div class="pagelist">{{$order->links()}}</div></td>
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
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
                <th>发票类型</th>
                <th>开票订单编号</th>
                <th>开票抬头</th>
                <th>开票税号</th>
                <th>开票金额</th>
                <th>地址</th>
                <th>电话</th>
                <th>开户行帐号</th>
            </tr>
            <volist name="list" id="vo">
                @foreach($invoice as $item)
                <tr>
                    <td style="text-align:left; padding-left:20px;">{{$item->id}}</td>
                    <td>@if($item->class==1)增值税普通发票@else增值税专用发票@endif</td>
                    <td>{{$item->order_number}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->tax_number}}</td>
                    <td>{{$item->cash}}</td>
                    <td>{{$item->address}}</td>
                    <td>{{$item->phone}}</td>
                    <td>{{$item->bank_account}}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="8"><div class="pagelist">{{$invoice->links()}}</div></td>
                </tr>
            </volist>
        </table>
    </div>
</form>
</div>
@include('admin.footer')

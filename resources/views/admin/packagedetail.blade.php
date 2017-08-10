@include('admin.header')
<div class="admin">
<form method="get" action="{{route('dish.index')}}" id="listform">
    <div class="panel admin-panel">
        <div class="panel-head"><strong class="icon-reorder"> 内容列表</strong>
        <div class="padding border-bottom">
        </div>
        <table class="table table-hover text-center">
            <tr>
                <th>Id</th>
                <th>菜名</th>
                <th>缩略图</th>
                <th>收获数量</th>
                <th>收获时间</th>
            </tr>
            <volist name="list" id="vo">
                @foreach($detail as $item)
                <tr>
                    <td width="10%">{{$item->id}}</td>
                    <td>{{$item->dish->name}}</td>
                    <td><img src="{{$item->dish->thumb}}" alt="" width="70" height="50" /></td>
                    <td>{{$item->vest_num}}</td>
                    <td>{{$item->created_at}}</td>
                </tr>
                @endforeach
            </volist>
        </table>
    </div>
</div>
@include('admin.footer')
<script src="{{asset('layer/layer.js')}}"></script>

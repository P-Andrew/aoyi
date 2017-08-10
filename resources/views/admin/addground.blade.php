@include('admin.header')
<link rel="stylesheet" href="{{asset('checkout/css/style.css')}}">
<div class="admin">
    <div class="panel admin-panel">
        <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>增加内容</strong></div>
        <div class="body-content">
            <form method="post" class="form-x" action="{{route('ground.store')}}">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="label">
                        <label>菜地名称：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input w50" value="{{old('title')}}" name="title" data-validate="required:请输入名称" />
                        <div class="tips"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label>所属大棚：</label>
                    </div>
                    <div class="field">
                        <select name="house_id" class="input w50" id="house">
                            @foreach($house as $item)
                                <option value="{{$item->id}}" data-house="{{$item->ground_num}}" data-ground="{{count(\App\GreenHouse::find($item->id)->subGround)}}">{{old('house_id')??$item->name}}</option>
                            @endforeach
                        </select>
                        <div class="tips"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label>排序(值越大,排序越靠前)：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input w50" {{--value="{{old('price')}}"--}} name="sort" data-validate="required:请输入排序" />
                        <div class="tips"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label>价格：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input w50" value="{{old('price')}}" name="price" data-validate="required:请输入价格" />
                        <div class="tips"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label>可种植菜种类数：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input w50" value="{{old('num')}}" name="num" data-validate="required:请输入数量" />
                        <div class="tips"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label>菜地是否可用：</label>
                    </div>
                <div class="field">
                <li class='tg-list-item'>
                    <input class='tgl tgl-skewed' id='cb3' type='checkbox' name="able">
                    <label class='tgl-btn' data-tg-off='是' data-tg-on='否' for='cb3'></label>
                </li>
                </div>
                </div>
                <div class="clear"></div>
                <div class="form-group">
                    <div class="label">
                        <label></label>
                    </div>
                    <div class="field">
                        <button id="check" class="button bg-main icon-check-square-o" type="submit"> 提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('admin.footer')
<script src="{{asset('layer/layer.js')}}"></script>
<script>
    $('#house').change(function(){
        var house = $('#house option:selected').data('house');
        var ground = $('#house option:selected').data('ground');
        $('#check').on('click',function(){
            if(house == ground){
                layer.msg('超过大棚设置菜地数');
                return false;
            }
        });



    });



</script>

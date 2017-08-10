@include('admin.header')
<link rel="stylesheet" href="{{asset('checkout/css/style.css')}}">
<div class="admin">
    <div class="panel admin-panel">
        <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>增加内容</strong></div>
        <div class="body-content">
            <form method="post" class="form-x" action="{{route('ground.update',['ground'=>$ground->id])}}">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="put">
                <div class="form-group">
                    <div class="label">
                        <label>菜地名称：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input w50" value="{{old('title')??$ground->name}}" name="title" data-validate="required:请输入名称" />
                        <div class="tips"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label>所属大棚：</label>
                    </div>
                    <div class="field">
                        <select name="house_id" class="input w50">
                            <option value="{{\App\Ground::find($ground->id)->topHouse->id}}">{{\App\Ground::find($ground->id)->topHouse->name}}</option>
                            @foreach($house as $item)
                                <option value="{{$item->id}}">{{old('house_id')??$item->name}}</option>
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
                        <input type="text" class="input w50" value="{{old('sort')??$ground->sort}}" name="sort" data-validate="required:请输入排序" />
                        <div class="tips"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label>价格：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input w50" value="{{old('price')??$ground->price}}" name="price" data-validate="required:请输入价格" />
                        <div class="tips"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label>可种植菜种类数：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input w50" value="{{old('num')??$ground->dish_num}}" name="num" data-validate="required:请输入数量" />
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
                            <label id="super" class='tgl-btn' @if($ground->able ==1)data-tg-off='是' data-tg-on='否' style="background:#86d993" @else data-tg-off='否' data-tg-on='是' style="background:#888"@endif for='cb3'></label>
                        </li>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="form-group">
                    <div class="label">
                        <label></label>
                    </div>
                    <div class="field">
                        <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('admin.footer')
<script>
    $('#super').click(function(){
        if($('#super').css('background-color')=='rgb(134, 217, 147)'){
            $('#super').css('background-color','#888');
        }else{
            $('#super').css('background-color','#86d993');
        }

       /* if($(this).css('background'));*/
    });
</script>

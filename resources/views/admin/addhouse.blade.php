@include('admin.header')
<div class="admin">
    <div class="panel admin-panel">
        <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>增加内容</strong></div>
        <div class="body-content">
            <form method="post" class="form-x" action="{{route('house.store')}}">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="label">
                        <label>大棚名称：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input w50" value="{{old('title')}}" name="name" data-validate="required:请输入名称" />
                        <div class="tips"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label>菜地数量：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input w50" value="{{old('title')}}" name="num" data-validate="required:请输入数量" />
                        <div class="tips"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label>描述：</label>
                    </div>
                    <div class="field">
                        <textarea class="input" name="desc"  style=" height:90px;">{{old('desc')}}</textarea>
                        <div class="tips"></div>
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

@include('admin.header')
<div class="admin">
    <div class="panel admin-panel margin-top">
       <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>添加分类</strong></div>
        <div class="body-content">
            <form method="post" class="form-x" action="{{route('category.store')}}">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="label">
                        <label>上级分类：</label>
                    </div>
                    <div class="field">
                        <select name="pid" class="input w50">
                            <option value="">请选择分类</option>
                           @foreach($node as $cate)
                                <option value="{{$cate->id}}">{!!str_repeat('├',$cate->depth)!!}{{$cate->name}}</option>
                                @include('admin.option',['cateid'=>$cate->id])
                            @endforeach
                        </select>
                        <div class="tips">不选择上级分类默认为一级分类</div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label>分类标题：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input w50" name="title" value="{{old('title')}}"  />
                        <div class="tips"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label>批量添加：</label>
                    </div>
                    <div class="field">
                        <textarea type="text" class="input w50" name="list" style="height:150px;" value="{{old('list')}}" placeholder="多个分类标题请转行"></textarea>
                        <div class="tips">多个分类标题请转行</div>
                    </div>
                </div>
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
@include('admin.header')
<div class="admin">
    <div class="panel admin-panel margin-top">
        <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>添加内容</strong></div>
        <div class="body-content">
            <form method="post" class="form-x" action="{{route('category.update',['category'=>$category->id])}}">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="put">
                <div class="form-group">
                    <div class="label">
                        <label>上级分类：</label>
                    </div>
                    <div class="field">
                        <select name="pid" class="input w50">
                            @if(count($parent))
                                <option >{{$parent->name}}</option>
                            @else
                                <option value="">无上级分类</option>
                            @endif
                           {{-- @foreach($node as $cate)
                                <option value="{{$cate->id}}">{!!str_repeat('├',$cate->depth)!!}{{$cate->name}}</option>
                                @include('admin.option',['cateid'=>$cate->id])
                            @endforeach--}}
                        </select>
                        <div class="tips"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label>分类标题：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input w50" name="title" value="{{old('title')??$category->name}}"  />
                        <div class="tips"></div>
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
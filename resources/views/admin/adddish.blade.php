@include('admin.header')
<div class="admin">
<div class="panel admin-panel">
    <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>增加内容</strong></div>
    <div class="body-content">
        <form method="post" class="form-x" action="{{route('dish.store')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                <div class="label">
                    <label>产品名称：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" value="{{old('title')}}" name="title" data-validate="required:请输入标题" />
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    　 <label>产品图片<span style="font-size:10px;color:lightslategrey">(226*165)</span>：</label>
                </div>

                    <div class="uploader blue">
                        <input type="text" class="filename" readonly/>
                        <input type="button" name="file" class="button" value="点击上传..."/>
                        <input type="file" size="30" name="thumbImg"/>
                    </div>

            </div>


                <div class="form-group">
                    <div class="label">
                        <label>所属分类：</label>
                    </div>
                    <div class="field">
                        <select name="cid" class="input w50">
                            <option value="">请选择分类</option>
                            @foreach($node as $cate)
                                <option value="{{old($cate->id)??$cate->id}}">{!!str_repeat('├',$cate->depth)!!}{{old($cate->name)??$cate->name}}</option>
                                @include('admin.option',['cateid'=>$cate->id])
                            @endforeach
                        </select>
                        <div class="tips"></div>
                    </div>
                </div>


            <div class="form-group">
                <div class="label">
                    <label>产品描述：</label>
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
<script>$(function(){
        $("input[type=file]").change(function(){$(this).parents(".uploader").find(".filename").val($(this).val());});
        $("input[type=file]").each(function(){
            if($(this).val()==""){$(this).parents(".uploader").find(".filename").val("未选择文件...");}
        });
    });
</script>
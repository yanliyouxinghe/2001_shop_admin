@extends('layouts.layout')
@section('title','品牌添加')
@section('content')
<blockquote class="layui-elem-quote layui-text">
<h4 style="color:green">品牌添加</h4>
</blockquote>


<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="/static/admin/jquery.min.js"></script>
	<script src="/static/admin/bootstrap.min.js"></script>
<form action="{{url('/brand/store')}}" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">

@if (session('msg'))
    <div class="alert alert-success">
       {{ session('msg') }}
    </div>
@endif
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">品牌名称</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname" name="brand_name"
                   placeholder="请输入品牌名称"><span></span>
        </div>   <span style="color: darkred;"></span>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">品牌网址</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname" name="brand_url"
                   placeholder="请输入品牌网址"><span></span>
        </div><span style="color: darkred;"></span>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">品牌LOGO</label>
        <div class="layui-upload-drag" id="test10">
            <input type="hidden" id="fileview" name="brand_logo" value="">
            <i class="layui-icon"></i>
            <p>点击上传，或将文件拖拽到此处</p>
            <div class="layui-hide" id="uploadDemoView">
                <hr>
                <img src="" alt="上传成功后渲染" style="max-width: 196px">
            </div>
        </div>
        <span style="color: darkred;"></span>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">品牌描述</label>
        <div class="col-sm-8">
			<textarea type="text" class="form-control" id="firstname" name="brand_desc"
                      placeholder="请输入品牌描述"></textarea><span></span>
        </div><span style="color:green"></span>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default aww">添加</button>
            <button type="reset" class="btn btn-default">重置</button>
            <a href="/brand/list" class="btn btn-default">前往列表</a>
        </div>
    </div>
</form>
<script src="status/js/jquery.min.js"></script>
<script>
    $(document).on('click','.aww',function(){
        // alert(111);
         var falg = false;
      var brand_name = $('input[name="brand_name"]').val();
      if (brand_name == '') {
                $("input[name='brand_name']+span").html("<font color='red'>品牌名不能为空</font>");
                falg = false;
            } else {
                $("input[name='brand_name']+span").html("<font color='green'>√</font>");
                falg = true;
        }
      var pfalg = false;
      var brand_url = $('input[name="brand_url"]').val();
      if (brand_url == '') {
                $("input[name='brand_url']+span").html("<font color='red'>品牌网址不能为空</font>");
                pfalg = false;
            } else {
                $("input[name='brand_url']+span").html("<font color='green'>√</font>");
                pfalg = true;
          }
      var ofalg = false;
      var brand_desc = $('textarea[name="brand_desc"]').val();
      if (brand_desc == '') {
                $("textarea[name='brand_desc']+span").html("<font color='red'>品牌描述不能为空</font>");
                ofalg = false;
            } else {
                $("textarea[name='brand_desc']+span").html("<font color='green'>√</font>");
                ofalg = true;
          }
      if(falg === false || pfalg === false || ofalg === false){
          return false;
      }
    })
</script>
@endsection

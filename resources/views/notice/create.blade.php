@extends('layouts.layout')
@section('title','公告添加')
@section('content')
<blockquote class="layui-elem-quote layui-text">
<h4 style="color:green">公告添加</h4>
</blockquote>


<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="/static/admin/jquery.min.js"></script>
	<script src="/static/admin/bootstrap.min.js"></script>
<form action="{{url('/notice/store')}}" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">

@if (session('msg'))
    <div class="alert alert-success">
       {{ session('msg') }}
    </div>
@endif
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">公告名称</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname" name="notice_name"
                   placeholder="请输入公告名称"><span></span>
        </div>   <span style="color: darkred;"></span>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">公告网址</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname" name="notice_url"
                   placeholder="请输入公告网址"><span></span>
        </div><span style="color: darkred;"></span>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">公告描述</label>
        <div class="col-sm-8">
			<textarea type="text" class="form-control" id="firstname" name="notice_desc"
                      placeholder="请输入公告描述"></textarea><span></span>
        </div><span style="color:green"></span>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default aww">添加</button>
            <button type="reset" class="btn btn-default">重置</button>
            <a href="/notice/list" class="btn btn-default">前往列表</a>
        </div>
    </div>
</form>
	<script src="/static/admin/jquery.min.js"></script>
<script>
    $(document).on('click','.aww',function(){
         var falg = false;
      var notice_name = $('input[name="notice_name"]').val();
      if (notice_name == '') {
                $("input[name='notice_name']+span").html("<font color='red'>公告名称不能为空</font>");
                falg = false;
            } else {
                $("input[name='notice_name']+span").html("<font color='green'>√</font>");
                falg = true;
        }
      var pfalg = false;
      var notice_url = $('input[name="notice_url"]').val();
      if (notice_url == '') {
                $("input[name='notice_url']+span").html("<font color='red'>公告网址不能为空</font>");
                pfalg = false;
            } else {
                $("input[name='notice_url']+span").html("<font color='green'>√</font>");
                pfalg = true;
          }
      var ofalg = false;
      var notice_desc = $('textarea[name="notice_desc"]').val();
      if (notice_desc == '') {
                $("textarea[name='notice_desc']+span").html("<font color='red'>品牌描述不能为空</font>");
                ofalg = false;
            } else {
                $("textarea[name='notice_desc']+span").html("<font color='green'>√</font>");
                ofalg = true;
          }
      if(falg === false || pfalg === false || ofalg === false){
          return false;
      }
    })
</script>
@endsection

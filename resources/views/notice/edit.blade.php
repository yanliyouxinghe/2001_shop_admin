@extends('layouts.layout')
@section('title','公告编辑')
@section('content')
   <blockquote class="layui-elem-quote layui-text">
<h4 style="color:green">修改公告</h4>
</blockquote>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="/static/admin/jquery.min.js"></script>
    <script src="/static/admin/bootstrap.min.js"></script>
    <form action="{{url('/notice/update/'.$data->notice_id)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">

        @if (session('msg'))
            <div class="alert alert-success">
                {{ session('msg') }}
            </div>
        @endif
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">公告名称</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="firstname" name="notice_name"
                       placeholder="请输入公告名称" value="{{$data->notice_name}}">
            </div>   <span style="color: darkred;"></span>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">公告网址</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="firstname"  value="{{$data->notice_url}}" name="notice_url"
                       placeholder="请输入公告网址" >
            </div><span style="color: darkred;"></span>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">公告描述</label>
            <div class="col-sm-8">
			<textarea type="text" class="form-control" id="firstname" name="notice_desc"
                      placeholder="请输入公告描述">{{$data->notice_desc}}</textarea>
            </div><span style="color:green"></span>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">编辑</button>
                <button type="reset" class="btn btn-default">重置</button>
                <a href="/notice/list" class="btn btn-default">取消</a>
            </div>
        </div>
    </form>
@endsection

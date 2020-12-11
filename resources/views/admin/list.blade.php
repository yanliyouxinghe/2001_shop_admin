@extends('layouts.layout')  
@section('content')
    <!-- 内容主体区域 -->
    <!-- <div style="padding: 15px;"></div> -->
    <blockquote class="layui-elem-quote layui-text">
<h4 style="color:green">管理员展示</h4>
</blockquote>
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
        <legend>
            <span class="layui-breadcrumb">
                <a href="/">后台首页</a>
                <a href="/demo/">管理员</a>
                <a><cite>管理员列表</cite></a>
            </span>
        </legend>
    </fieldset>

    <div class="layui-form">
        <table class="layui-table">
            <colgroup>
            <col width="150">
            <col width="150">
            <col width="200">
            <col>
            </colgroup>
            <thead>
            <tr>
                <th>管理员id</th>
                <th>管理员名称</th>
                <th>管理员logo</th>
                <th>操作</th>
            </tr> 
            </thead>
            <tbody>
            @foreach($data as $v)
            <tr>
                <td>{{$v->admin_id}}</td>
                <td>{{$v->admin_name}}</td>
                <td>
            @if($v->admin_logo)
            <img src="{{$v->admin_logo}}" width="50px" height="50px">
            @endif

            </td>
                <td>
                
                    <a href="admin/destroy/{{$v->admin_id}}" onclick="DeleteGetId({{$v->admin_id}},this)">
                        <button type="button" class="layui-btn layui-btn-danger">删除</button>
                    </a>
                    <a href="{{url('admin/edit/'.$v->admin_id)}}">
                        <button type="button" class="layui-btn layui-btn-normal">编辑</button>
                    </a>
                    
                </td>
            </tr>
            @endforeach
            <tr>
            <<td colspan="6">{{ $data->links('vendor.pagination.adminbrand') }}</td>
            </tr>
            
            
            <!--  -->
            </tbody>       
        </table>
        
    </div>

  @endsection
  
  


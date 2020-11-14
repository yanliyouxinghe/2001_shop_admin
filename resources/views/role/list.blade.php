@extends('layouts.layout')  
@section('content')
    <!-- 内容主体区域 -->
    <!-- <div style="padding: 15px;"></div> -->
    <center><h1>角色列表</h1></center>
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
        <legend>
            <span class="layui-breadcrumb">
                <a href="/">后台首页</a>
                <a href="/demo/">角色</a>
                <a><cite>角色列表</cite></a>
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
                <th>角色id</th>
                <th>角色名称</th>
                <th>角色描述</th>
                <th>操作</th>
            </tr> 
            </thead>
            <tbody>
            @foreach($data as $v)
            <tr>
                <td>{{$v->role_id}}</td>
                <td>{{$v->role_name}}</td>
                <td>{{$v->role_desc}}</td>
                <td>
                    <a href="role/destroy/{{$v->role_id}}" onclick="DeleteGetId({{$v->role_id}},this)">
                        <button type="button" class="layui-btn layui-btn-danger">删除</button>
                    </a>
                    <a href="role/addpriv/{{$v->role_id}}">
                        <button type="button" class="layui-btn layui-btn-normal">添加权限</button>
                    </a>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="5">{{$data->links()}}</td>
            </tr>
            
            
            <!--  -->
            </tbody>       
        </table>
        
    </div>

  @endsection
  
  


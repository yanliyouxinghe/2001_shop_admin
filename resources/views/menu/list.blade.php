@extends('layouts.layout')  
@section('content')
    <!-- 内容主体区域 -->
    <!-- <div style="padding: 15px;"></div> -->
    <center><h1>菜单列表</h1></center>
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
        <legend>
            <span class="layui-breadcrumb">
                <a href="/">后台首页</a>
                <a href="/demo/">菜单</a>
                <a><cite>菜单列表</cite></a>
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
                <th>菜单id</th>
                <th>菜单名称</th>
                <th>路由别名</th>
                <th>是否显示</th>
                <th>操作</th>
            </tr> 
            </thead>
            <tbody>
            @foreach($data as $v)
            <tr>
                <td>{{$v->menu_id}}</td>
                <td>{{$v->menu_name}}</td>
                <td>{{$v->menu_url}}</td>
                <td>
                    @if($v->is_show==1)
                      是
                    @else
                      否
                    @endif
                </td>
                <td>
                    <a href="{{url('menu/destroy/'.$v->menu_id)}}" onclick="">
                        <button type="button" class="layui-btn layui-btn-danger">删除</button>
                    </a>
                    <a href="{{url('menu/edit/'.$v->menu_id)}}">
                        <button type="button" class="layui-btn layui-btn-normal">编辑</button>
                    </a>
                </td>
            </tr>
            @endforeach
            
            
            
            <!--  -->
            </tbody>       
        </table>
        
    </div>

  @endsection
  
  


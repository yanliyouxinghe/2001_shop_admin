@extends('layouts.layout')  
@section('content')
<!DOCTYPE html>
<form action="{{url('/seckill/store')}}" method="post" name="theForm" enctype="multipart/form-data" onsubmit="return validate()">

{{--        <form class="layui-form layui-form-pane" action="/adver/store" method="POST" enctype="multipart/form-data">--}}
           
                <div class="layui-form" style="color:red">
                   
                </div>
            
            <div class="layui-form-item">
                <label class="layui-form-label">抢购名称</label>
                <div class="layui-input-block">
                    <input type="text" name="seckill_name" autocomplete="off" placeholder="请输入抢购名称" class="layui-input">
                </div>
            </div>
             <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">开始时间</label>
                    <div class="layui-input-block">
                        <input type="text" name="start_time" id="date1" autocomplete="off" class="layui-input">
                    </div>
                </div>
            </div>
             <div class="layui-form-item">
                <div class="layui-inline">
                     <label class="layui-form-label">结束时间</label>
                    <div class="layui-input-block">
                        <input type="text" name="end_time" id="date" autocomplete="off" class="layui-input">
                    </div>
                </div>
            </div>
           
            <div class="layui-form-item">
                <label  class="layui-form-label">设置抢购商品</label>
                <div class="layui-input-block" >
                <select name="goods_id">
                <option value="0">--请选择商品--</option>
                @foreach($goods as $v)
                  
                   
                   <option value="{{$v['goods_id']}}">{{$v['goods_name']}}￥{{$v['shop_price']}}</option>
                  @endforeach
                </select>
                </div>
            </div>
            
            
            <div class="layui-form-item">
                <label class="layui-form-label">限时抢购价格</label>
                    <div class="layui-input-block">
                    <input type="text" name="new_price" autocomplete="off" placeholder="请输入限时抢购价格" class="layui-input">
                    </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">限时抢购数量</label>
                    <div class="layui-input-block">
                    <input type="text" name="seckill_number" autocomplete="off" placeholder="请输入限时抢购价格" class="layui-input">
                    </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">介绍</label>
                <div class="layui-input-inline">
                    <textarea type="text" name="seckill_desc" lay-verify="required" placeholder="请输入介绍" autocomplete="off" class="layui-input"></textarea>
                </div>
            </div>

            <center><div>
                    <button type="submit" class="layui-btn">添加</button>
                            <button type="reset" class="layui-btn layui-btn-danger">重置</button>
                </div></center>
</form>

@endsection

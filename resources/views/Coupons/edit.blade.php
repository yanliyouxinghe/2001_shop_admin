@extends('layouts.layout')
@section('title','优惠券添加')
@section('content')
<blockquote class="layui-elem-quote layui-text">
<h4 style="color:green">优惠券添加</h4>
</blockquote>


<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="/static/admin/jquery.min.js"></script>
  <script src="/static/admin/bootstrap.min.js"></script>
<form action="{{url('/coupons/update/'.$data->coupons_id)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">

@if (session('msg'))
    <div class="alert alert-success">
       {{ session('msg') }}
    </div>
@endif
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">优惠券名称</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname" name="coupons_name"
                   placeholder="请输入优惠券名称" value='{{$data->coupons_name}}'>
        </div>   <span style="color: darkred;"></span>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品名称</label>
        <div class="col-sm-8">
            <select name="goods_id" lay-filter="aihao" value='{{$data->goods_id}}'>
            @foreach($data1 as $v)

        <option value="{{$v['goods_id']}}">{{$v['goods_name']}}</option>
                @endforeach

      </select>
        </div><span style="color: darkred;"></span>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">优惠券图片</label>
        <div >
            <input type="file"  name="coupons_img" value="">
                        <img src="{{env('APP_URL')}}{{$data->coupons_img}}" width="50px" height="50px">
        </div>
        <span style="color: darkred;"></span>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">满足条件</label>
        <div class="col-sm-8">
      <input type="text" class="form-control" id="firstname" name="coupons_meet"
                   placeholder="" value='{{$data->coupons_meet}}'>
        </div><span style="color:green"></span>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">优惠券价格</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname" name="coupons_price"
                   placeholder="请输入优惠券价格" value='{{$data->coupons_price}}'>
        </div><span style="color: darkred;"></span>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">修改</button>
            <button type="reset" class="btn btn-default">重置</button>
            <a href="/coupons/list" class="btn btn-default">前往列表</a>
        </div>
    </div>
</form>


@endsection

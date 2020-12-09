@extends('layouts.layout')
@section('title','优惠券添加')
@section('content')
<blockquote class="layui-elem-quote layui-text">
<h4 style="color:green">优惠券添加</h4>
</blockquote>


<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="/static/admin/jquery.min.js"></script>
  <script src="/static/admin/bootstrap.min.js"></script>
<form action="{{url('/coupons/store')}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">

@if (session('msg'))
    <div class="alert alert-success">
       {{ session('msg') }}
    </div>
@endif
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">优惠券名称</label>
        <div class="col-sm-8 coupons_name">
            <input type="text" class="form-control couponsname" id="firstname" name="coupons_name"
                   placeholder="请输入优惠券名称"><span></span>
        </div>   <span style="color: darkred;"></span>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品名称</label>
        <div class="col-sm-8">
            <select name="goods_id" lay-filter="aihao">
            @foreach($data as $v)

        <option value="{{$v->goods_id}}">{{$v->goods_name}}</option>
                @endforeach

      </select>
        </div><span style="color: darkred;"></span>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">优惠券图片</label>
        <div >
            <input type="file"  name="coupons_img" value="">
            
        </div>
        <span style="color: darkred;"></span>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">满足条件</label>
        <div class="col-sm-8">
      <input type="text" class="form-control coupons_meet" id="firstname" name="coupons_meet"
                   placeholder="">
        </div><span style="color:green"></span>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">优惠券价格</label>
        <div class="col-sm-8">
            <input type="text" class="form-control coupons_price" id="firstname" name="coupons_price"
                   placeholder="请输入优惠券价格">
        </div><span style="color: darkred;"></span>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="coupons btn btn-default">添加</button>
            <button type="reset" class="btn btn-default">重置</button>
            <a href="/coupons/list" class="btn btn-default coupons">前往列表</a>
        </div>
    </div>
</form>


@endsection
  <script src="/static/admin/jquery.min.js"></script>

<script>
    $(document).on('click','.coupons',function(){
        var coupons_name=$("div[class='col-sm-8 coupons_name']").children().val();
        var reg=/^([A-Za-z]|[\u4E00-\u9FA5]|[0-9])+$/;
        if(!reg.test(coupons_name)){
                $("#article_title").next('span').text('标题已存在');
            alert("优惠券名称不正确");
            return false;
        }
 
    })

</script>




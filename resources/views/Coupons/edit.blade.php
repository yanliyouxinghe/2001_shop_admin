@extends('layouts.layout')
@section('title','优惠券添加')
@section('content')
<blockquote class="layui-elem-quote layui-text">
<h4 style="color:green">优惠券添加</h4>
</blockquote>


<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="/static/admin/bootstrap.min.js"></script>
<form action="{{url('/coupons/update/'.$data->coupons_id)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">

@if (session('msg'))
    <div class="alert alert-success">
       {{ session('msg') }}
    </div>
@endif
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">优惠券名称</label>
        <div class="col-sm-8 coupons_name">
            <input type="text" class="form-control couponsname" id="firstname" name="coupons_name"
                   placeholder="请输入优惠券名称" value='{{$data->coupons_name}}'><span style="color: red" ></span>
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
        <div class="layui-upload-drag" id="test10">
            <input type="hidden" id="fileview" name="coupons_img" value="">
            <i class="layui-icon"></i>
            <p>点击上传，或将文件拖拽到此处</p>
            <div class="layui-hide" id="uploadDemoView">
                <hr>
                <img src="{{$data->coupons_img}}" alt="上传成功后渲染" style="max-width: 196px">
            </div>
        </div>

        <span style="color: darkred;"></span>
                <img src="{{$data->coupons_img}}" alt="" style="max-width: 196px">
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">满足条件</label>
        <div class="col-sm-8 coupons_meet">
      <input type="text" class="form-control couponsmeet" id="firstname" name="coupons_meet"
                   placeholder="" value='{{$data->coupons_meet}}'><span style="color: red" ></span>
        </div><span style="color:green"></span>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">优惠券价格</label>
        <div class="col-sm-8 coupons_price">
            <input type="text" class="form-control couponsprice" id="firstname" name="coupons_price"
                   placeholder="请输入优惠券价格" value='{{$data->coupons_price}}'><span style="color: red" ></span>
        </div><span style="color: darkred;"></span>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default coupons">修改</button>
            <button type="reset" class="btn btn-default">重置</button>
            <a href="/coupons/list" class="btn btn-default">前往列表</a>
        </div>
    </div>
</form>


@endsection
  <script src="/static/admin/jquery.min.js"></script>

<script>
    $(document).on('click','.coupons',function(){
        var reg=/^([A-Za-z]|[\u4E00-\u9FA5]|[0-9])+$/;
        var reg2=/^[0-9]*$/;
        var flag=false;
        var coupons_name=$("div[class='col-sm-8 coupons_name']").children().val();
         if(coupons_name==''){
            // alert(111);
            $(".couponsname").next('span').text('优惠券名称不能为空');
            flag=false;
        }else if(!reg.test(coupons_name)){
            $(".couponsname").next('span').text('优惠券名称格式不正确');
            flag= false;
        }else{
            $(".couponsname").next('span').text('✔');
            flag=true;
        }
        var mflag=false;
        var coupons_meet=$("div[class='col-sm-8 coupons_meet']").children().val();
        if(coupons_meet==''){
            $(".couponsmeet").next('span').text('满足条件不能为空');
            mflag=false;
        }else if(!reg2.test(coupons_meet)){
            $(".couponsmeet").next('span').text('只能为数字');
            mflag=false;
        }else{
            $(".couponsmeet").next('span').text('✔');
            mflag=true;
        }
        var pflag=false;
        var coupons_price=$("div[class='col-sm-8 coupons_price']").children().val();
        if(coupons_price==''){
            $(".couponsprice").next('span').text('优惠价格不能为空');
            pflag= false;
        }else if(!reg2.test(coupons_price)){
            $(".couponsprice").next('span').text('只能为数字');
            pflag= false;
        }else if(coupons_price>=coupons_meet){
            $(".couponsprice").next('span').text('优惠价格不能大于等于满足条件');
            pflag=false;
        }else{
            $(".couponsprice").next('span').text('✔');
            pflag=true;
        }        
        if(flag==false||mflag==false||pflag==false){
            return false;
        }
    })

</script>


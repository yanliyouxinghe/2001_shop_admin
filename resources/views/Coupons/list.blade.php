@extends('layouts.layout')
@section('title','优惠券列表')
@section('content')
  
    <!DOCTYPE html>
<html>

<body>
 <blockquote class="layui-elem-quote layui-text">
<h4 style="color:green">优惠券列表</h4>
</blockquote>
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <a href="/coupons/create"><button type="button" class="btn btn-primary">前往添加</button></a>
<table class="table">
    <thead>
    <tr>
        <th><input type="checkbox" name="checkbox1"></th>
        <th>ID</th>
        <th>优惠券名称</th> 
        <th>商品名称</th>
        <th>优惠券图片</th>
        <th>满足条件</th>
        <th>优惠价格</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $k=>$v)
    <tr>
        <td><input type="checkbox" name="checkbox2" value="{{$v->coupons_id}}"></td>
        <td>{{$v->coupons_id}}</td>
        <td id="{{$v->coupons_name}}"><span class="oldname brand_name">{{$v->coupons_name}}</span></td>
        <td>{{$data1->goods_name}}</td>
        <td>
            @if($v->coupons_img)
            <img src="{{env('APP_URL')}}{{$v->coupons_img}}" width="50px" height="50px">
            @endif

            </td>
        <td>{{$v->coupons_meet}}</td>
        <td>{{$v->coupons_price}}</td>
        <td>
            <a href="{{url('/coupons/destroy/'.$v->coupons_id)}}">
                <button type="button" class="btn btn-danger" coupons_id = "{{$v->coupons_id}}">删除</button>
           </a>
            <a href="{{url('/coupons/edit/'.$v->coupons_id)}}"><button type="button" class="btn btn-info">编辑</button></a>
        </td>
    </tr>

    @endforeach

    <button type="button" class="layui-btn layui-btn-xs layui-btn-normal" id="pil">批量删除</button>
    </tbody>

</table>
</body>
</html>
@endsection
<script src="http://apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
    //即点即该
    // var brand_name = $('.brand_name').text();
    $(document).on('click','.brand_name',function (){
                brand_name = $(this).text();
            var id = $(this).parent().attr('id');
            $(this).parent().html('<input type="text" id="input_rem" class="brand_id input_name" value='+brand_name+'>');
            $(".input_name"+id).val("").focus().val(brand_name);
    });
    $(document).on('blur',".brand_id",function (){
        var newname = $(this).val();
        var brand_id = $(this).parent().attr('id');
        var _this = $(this);
        if(!newname || !brand_id){
            // $(this).remove();
            _this.parent().html('<span class="brand_name">'+brand_name+'</span>');
            return ;
        }
        if(newname == brand_name){
            _this.parent().html('<span class="brand_name">'+brand_name+'</span>');
            return ;
        }

        $.ajax({
            url : '/brand/updated',
            dataType : 'json',
            type : 'post',
            data : {'brand_id':brand_id,'brand_name':newname},
            success:function ( res ){
                // console.log(res);
                if( res.code == 0 ){
                    // location.reload();
                    // alert(res.msg)
                    // $(".brand_id").remove();
                    _this.parent().html('<span class="brand_name">'+newname+'</span>');
                }else{
                    alert('操作繁忙，请稍后重试...');
                    return false;
                }
            }
        });
        return;
    });







//全选
$(document).on('click','input[name="checkbox1"]',function (){
    var _this = $(this);
    if(_this.prop('checked') == true){
        $('input[name="checkbox2"]').prop('checked',true);
    }else{
        $('input[name="checkbox2"]').prop('checked',false);
    }

});



// {{--    删除--}}
    // $(document).on("click",".btn-danger",function (){
    //     //这个对象
    //     var _this = $(this);
    //     //判断用户是否确认删除
    //    var ifdel = confirm("您确定删除吗？");
    //    if(ifdel == true){
    //        var id = _this.attr('coupons_id');
    //        // console.log(id);
    //         $.ajax({
    //             url : '/coupons/destroy',
    //             dataType : 'json',
    //             type : 'get',
    //             data : {'id':id},
    //             success:function ( res ){
    //                 if( res.code == 0 ){
    //                     location.reload();
    //                 }else{
    //                     alert('操作繁忙，请稍后重试...');
    //                     return false;
    //                 }
    //               }
    //         });
    //    }
    //    return false;
    // });
    //分页
    $(document).on('click','#layui-laypage-1 a',function(){
        // alert(111);
        var url = $(this).attr('href');
        $.get(url,function(result){
            $('tbody').html(result);
        });
        return false;
    });



</script>

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
 <form class="layui-form" action="/coupons/list" style="padding-bottom: 10px;padding-left: 10px;">
        优惠券名称：
        <div class="layui-input-inline">
            <input type="text" name="coupons_name"  class="layui-input" value="{{$data['coupons_name']??''}}" placeholder="请输入优惠券名称......">
        </div>
        <button type="submit" class="layui-btn">搜索</button>
    </form>
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
    @foreach($query as $v)
    <tr>
        <td><input type="checkbox" name="checkbox2" value="{{$v->coupons_id}}"></td>
        <td>{{$v->coupons_id}}</td>
        <td id="{{$v->coupons_id}}"><span class="oldname coupons_name">{{$v->coupons_name}}</span></td>
        <td>{{$data1->goods_name}}</td>
        <td>
            @if($v->coupons_img)
            <img src="{{$v->coupons_img}}" width="50px" height="50px">
            @endif

            </td>
        <td>{{$v->coupons_meet}}</td>
        <td>{{$v->coupons_price}}</td>
        <td>
            <a href="javascript:;">
                <button type="button" class="btn btn-danger" coupons_id = "{{$v->coupons_id}}">删除</button>
           </a>
            <a href="{{url('/coupons/edit/'.$v->coupons_id)}}"><button type="button" class="btn btn-info">编辑</button></a>
        </td>
    </tr>

    @endforeach
    <tr><td colspan="6">{{$query->links('vendor.pagination.adminbrand')}}</td></tr>
    <button type="button" class="layui-btn layui-btn-xs layui-btn-normal" id="pil">批量删除</button>
    </tbody>
    
</table>

</body>
</html>
@endsection
<script src="http://apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
    //分页
    $(document).on('click','#layui-laypage-1 a',function(){
        // alert(111);
        var url = $(this).attr('href');
        $.get(url,function(result){
            $('tbody').html(result);
        });
        return false;
    });

    //即点即该
    // var brand_name = $('.brand_name').text();
    $(document).on('click','.coupons_name',function (){
                coupons_name = $(this).text();
            var id = $(this).parent().attr('id');
            $(this).parent().html('<input type="text" id="input_rem" class="coupons_id input_name" value='+coupons_name+'>');
            $(".input_name"+id).val("").focus().val(coupons_name);
    });
    $(document).on('blur',".coupons_id",function (){
        var newname = $(this).val();
        var coupons_id = $(this).parent().attr('id');
        var _this = $(this);
        if(!newname || !coupons_id){
            // $(this).remove();
            _this.parent().html('<span class="coupons_name">'+coupons_name+'</span>');
            return ;
        }
        if(newname == coupons_name){
            _this.parent().html('<span class="coupons_name">'+coupons_name+'</span>');
            return ;
        }

        $.ajax({
            url : '/coupons/updated',
            dataType : 'json',
            type : 'post',
            data : {'coupons_id':coupons_id,'coupons_name':newname},
            success:function ( res ){
                if( res.code == 0 ){
                    _this.parent().html('<span class="coupons_name">'+newname+'</span>');
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

//批量删除
$(document).on('click',".layui-btn-xs",function(){
        var id = new Array();
        
   $('input[name="checkbox2"]:checked').each(function (i,k){
       id.push($(this).val());
   });
   if (id.length == 0){
       alert('请选择要删除的数据');
       return;
   }
       var isdel = confirm("确定要删除所选的数据吗？");
        if(isdel == true){
            $.ajax({
                url : '/coupons/destroy',
                dataType : 'json',
                type : 'get',
                data : {'id':id},
                success:function ( res ){
                    console.log(res);
                    if( res.code == 0 ){
                        location.reload();
                    }else{
                        alert('操作繁忙，请稍后重试...');
                        return false;
                    }
                }
            });
        }
        return false;
});


// {{--    删除--}}
    $(document).on("click",".btn-danger",function (){
        //这个对象
        var _this = $(this);
        //判断用户是否确认删除
       var ifdel = confirm("您确定删除吗？");
       if(ifdel == true){
           var id = _this.attr('coupons_id');
           // console.log(id);
            $.ajax({
                url : '/coupons/destroy',
                dataType : 'json',
                type : 'get',
                data : {'id':id},
                success:function ( res ){
                    if( res.code == 0 ){
                        location.reload();
                    }else{
                        alert('操作繁忙，请稍后重试...');
                        return false;
                    }
                  }
            });
       }
       return false;
    });
</script>

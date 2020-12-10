@extends('layouts.layout')
@section('title','品牌列表')
@section('content')
  
    <!DOCTYPE html>
<html>

<body>
 <blockquote class="layui-elem-quote layui-text">
<h4 style="color:green">品牌展示</h4>
</blockquote>
<p>

<div style="float:right">
  <a href="/brand/create"><button type="button" class="btn btn-primary">前往添加</button></a>
  <button type="button" class="layui-btn layui-btn-xs layui-btn-normal" id="pil">批量删除</button>
</div>
  <div id="di">
  <form action="">
             <label class="layui-form-label">品牌名称:</label>
             <div class="layui-input-inline">
                <input type="text" name="brand_name" lay-verify="required" placeholder="请输入品牌名称" autocomplete="off" class="layui-input">
             </div>
               <button type="submit" id="sou" class="layui-btn">搜索</button>
            </form>
            </div>
 </p>           
<table class="layui-table">
            
    <thead>
    <tr>
        <th><input type="checkbox" name="checkbox1"></th>
        <th>ID</th>
        <th>品牌名称</th>
        <th width="45%">品牌网址</th>
        <th>品牌logo</th>
        <th>品牌简介</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $k=>$v)
    <tr>
        <td><input type="checkbox" name="checkbox2" value="{{$v->brand_id}}"></td>
        <td>{{$v->brand_id}}</td>
        <td id="{{$v->brand_id}}"><span class="oldname brand_name">{{$v->brand_name}}</span></td>
        <td>{{$v->brand_url}}</td>
        <td>
            @if($v->brand_logo)
            <img src="{{$v->brand_logo}}" width="50px" height="50px">
            @endif

            </td>
        <td>{{$v->brand_desc}}</td>
        <td>
            <a href="{{url('/brand/destroy/'.$v->brand_id)}}">
                <button type="button" class="btn btn-danger" brand_id = "{{$v->brand_id}}">删除</button>
           </a>
            <a href="{{url('/brand/show/'.$v->brand_id)}}"><button type="button" class="btn btn-info">编辑</button></a>
        </td>
    </tr>

    @endforeach
    <tr><td colspan="6">{{ $data->links('vendor.pagination.adminbrand') }}</td></tr>
   
    </tbody>

</table>
</body>
</html>
@endsection
<script src="http://apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
 //搜索
    //   $(document).on('click', '#sou', function () {
    //     //   alert(222);
    //     var brand_name = $("input[name='brand_name']").val();
    //     $.ajax({
    //         url: "{'brand/list'}",
    //         data: { 'brand_name': brand_name },
    //         dataType: 'text',
    //         type: '',
    //         success: function (res) {
    //             $("#di").html(res);
    //         }
    //     });
    //     return false;
    // });
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

//批量删除
$(document).on('click',".layui-btn-xs",function(){
        var ids = new Array();

   $('input[name="checkbox2"]:checked').each(function (i,k){
       ids.push($(this).val());
   });
   if (ids.length == 0){
       alert('请选择要删除的数据');
       return;
   }
       var isdel = confirm("确定要删除所选的数据吗？");
        if(isdel == true){
            $.ajax({
                url : '/brand/destroy',
                dataType : 'json',
                type : 'get',
                data : {'ids':ids},
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

{{--    删除--}}
    $(document).on("click",".btn-danger",function (){
        //这个对象
        var _this = $(this);
        //判断用户是否确认删除
       var ifdel = confirm("您确定删除吗？");
       if(ifdel == true){
           var id = _this.attr('brand_id');
           // console.log(id);
            $.ajax({
                url : '/brand/destroy',
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

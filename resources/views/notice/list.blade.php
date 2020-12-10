@extends('layouts.layout')
@section('title','公告列表')
@section('content')
  
    <!DOCTYPE html>
<html>

<body>
 <blockquote class="layui-elem-quote layui-text">
<h4 style="color:green">公告展示</h4>
</blockquote>
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <a href="/notice/create"><button type="button" class="btn btn-primary">前往添加</button></a>
<table class="table">
    <thead>
    <tr>
        <th><input type="checkbox" name="checkbox1"></th>
        <th>ID</th>
        <th>公告名称</th>
        <th>公告网址</th>
        <th>公告简介</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $k=>$v)
    <tr>
        <td><input type="checkbox" name="checkbox2" value="{{$v->notice_id}}"></td>
        <td>{{$v->notice_id}}</td>
        <td id="{{$v->notice_id}}"><span class="oldname notice_name">{{$v->notice_name}}</span></td>
        <td>{{$v->notice_url}}</td>
        <td>{{$v->notice_desc}}</td>
        <td>
            <a href="{{url('/notice/destroy/'.$v->notice_id)}}">
                <button type="button" class="btn btn-danger" notice_id = "{{$v->notice_id}}">删除</button>
           </a>
            <a href="{{url('/notice/edit/'.$v->notice_id)}}"><button type="button" class="btn btn-info">编辑</button></a>
        </td>
    </tr>

    @endforeach
    <tr><td colspan="6">{{ $data->links('vendor.pagination.adminbrand') }}</td></tr>
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
    $(document).on('click','.notice_name',function (){
               notice_name = $(this).text();
            var id = $(this).parent().attr('id');
            $(this).parent().html('<input type="text" id="input_rem" class="notice_id input_name" value='+notice_name+'>');
            $(".input_name"+id).val("").focus().val(notice_name);
    });
    $(document).on('blur',".notice_id",function (){
        var newname = $(this).val();
        var notice_id = $(this).parent().attr('id');
        var _this = $(this);
        if(!newname || !notice_id){
            // $(this).remove();
            _this.parent().html('<span class="notice_name">'+notice_name+'</span>');
            return ;
        }
        if(newname == notice_name){
            _this.parent().html('<span class="notice_name">'+notice_name+'</span>');
            return ;
        }

        $.ajax({
            url : '/notice/updated',
            dataType : 'json',
            type : 'post',
            data : {'notice_id':notice_id,'notice_name':newname},
            success:function ( res ){
                // console.log(res);
                if( res.code == 0 ){
                    // location.reload();
                    alert(res.msg)
                    // $(".brand_id").remove();
                    _this.parent().html('<span class="notice_name">'+newname+'</span>');
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
                url : '/notice/destroy',
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
//删除
  $(document).on("click",".btn-danger",function (){
        //这个对象
        var _this = $(this);
        //判断用户是否确认删除
       var ifdel = confirm("您确定删除吗？");
       if(ifdel == true){
           var id = _this.attr('notice_id');
           // console.log(id);
            $.ajax({
                url : '/notice/destroy',
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

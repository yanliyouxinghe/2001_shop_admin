@extends('layouts.layout')
@section('title','分类管理')
@section('content')

<center><h1>分类列表</h1></center>

<div style="padding: 15px;">
    <button type="button" class="layui-btn layui-btn-danger pldel">批量删除</button>
    <div class="layui-form">
    <table class="layui-table">

        <thead width="1000px">
            <tr>
                <th width="4px"><input type="checkbox" lay-skin="primary"></th>
                <th width="30px">分类ID</th>
                <th width="70px">分类名称</th>
                <th width="200px">父极分类</th>
                <th width="100px">操作</th>
            </tr>
        </thead>
        <tbody>
        @foreach($cart_data as $v)
            <tr cat_id="{{$v->cat_id}}">
                <td><input type="checkbox" class="cat_id" value="{{$v->cat_id}}" lay-skin="primary"></td>
                <td>{{$v->cat_id}}</td>
                <td>{{$v->cat_name}}</td>
                <td>
                  @if($v->parent_name)
                  {{$v->parent_name[0]['cat_name']}}
                  @else
                  --
                  @endif
                </td>
                <td>
                      <a href="/cartgory/edit/{{$v->cat_id}}"><button type="button" class="layui-btn layui-btn-normal">修改</button></a>
                    <button type="button" class="layui-btn layui-btn-danger del" cat_id="{{$v->cat_id}}">删除</button>
                </td>
            </tr>
        @endforeach
        <tr><td colspan="6">{{ $cart_data->links('vendor.pagination.adminbrand') }}</td></tr>
        </tbody>

    </table>
    </div>
</div>
<script src="http://libs.baidu.com/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
  //分页
  $(document).on('click','#layui-laypage-1 a',function(){
      // alert(111);
      var url = $(this).attr('href');
      $.get(url,function(result){
          $('tbody').html(result);
          layui.form.render("checkbox");
          
          check();

      });
      return false;
  });
  //删除
      $(document).on('click','.del',function(){
          var _this = $(this);
          var cat_id = _this.attr('cat_id');
          if(!cat_id){
              return;
          }
          if(confirm('确定删除吗？')){
              $.ajax({
                  url : '/cartgory/destroy',
                  dataType : 'json',
                  type : 'post',
                  data : {'cat_id':cat_id},
                success:function(ret){
                    if(ret.code==0){
                        _this.parent().parent().remove();
                    }else{
                      alert(ret.msg);
                    }
                }
              });
          }
          return;
      });


//刷新页面批量删除那妞是否变灰
//分页之后的全选反选
function check(){
   var check = $('.layui-unselect:eq(0)').hasClass('layui-form-checked');
        if(check){
            $('.layui-unselect').addClass('layui-form-checked');
              $('.pldel').removeClass('layui-btn-disabled');
        }else{
          $('.layui-unselect').removeClass('layui-form-checked');
          $('.pldel').addClass('layui-btn-disabled');
        }
}

    $(function(){
        check();
    });
  
  
  //全选
  $(document).on('click','.layui-unselect:eq(0)',function(){
        var _this = $(this);

        if(_this.hasClass('layui-form-checked')){
              $('.layui-unselect').addClass('layui-form-checked');
              $('.pldel').removeClass('layui-btn-disabled');

        }else{
              $('.layui-unselect').removeClass('layui-form-checked');
              $('.pldel').addClass('layui-btn-disabled');

        }
  });


  $(document).on('click','.layui-unselect',function(){
       var _this = $(this);
       
        if($('.layui-form-checked').length){
             // _this.addClass('layui-form-checked');
              $('.pldel').removeClass('layui-btn-disabled');
        }else{
              _this.removeClass('layui-form-checked');
              $('.pldel').addClass('layui-btn-disabled');

        }
  });


  //批量删除
  $(document).on('click','.pldel',function(){
    var _this = $(this);
    if(_this.hasClass('layui-btn-disabled')){
        return;
    }else{
        if(confirm('确定删除所选分类吗？')){
            var cat_ids = new Array();
           $('.layui-form-checked').each(function(){
                var _this = $(this);
                var cat_id = _this.prev().val();
                cat_ids.push(cat_id);
           });
              $.ajax({
                url : '/cartgory/destrys',
                dataType : 'json',
                data : {'cat_ids':cat_ids},
                type : 'post',
                success:function(ret){
                    if(ret.code==0){
                       location.reload();
                    }else{
                      alert(ret.msg);
                    }
                }
              });
        }
        return;
    }
  });


</script>


@endsection

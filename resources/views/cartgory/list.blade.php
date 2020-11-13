@extends('layouts.layout')
@section('title','分类管理')
@section('content')

<center><h1>分类列表</h1></center>

<div style="padding: 15px;">

    <div class="layui-form">
    <table class="layui-table">

        <thead width="1000px">
            <tr>
                <th width="30px">分类ID</th>
                <th width="70px">分类名称</th>
                <th width="200px">父极分类</th>
                <th width="100px">操作</th>
            </tr>
        </thead>
        <tbody>
        @foreach($cart_data as $v)
            <tr cat_id="{{$v->cat_id}}">
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


@endsection

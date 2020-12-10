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
                <th width="100px">操作</th>
            </tr>
        </thead>
        <tbody>
        @foreach($cart_data as $k=>$v)
            <tr style="display: none" cat_id="{{$v->cat_id}}" parent_id="{{$v->parent_id}}">
            <td>{{$v->cat_id}}</td>
            <td>
            <a href="javascript:void(0)" class="showHide">+</a>
            {{@str_repeat('—',$v->level*2)}}
            {{$v->cat_name}}
            </td>
            <td>
            <button type="button" class="layui-btn layui-btn-danger del" cat_id="{{$v->cat_id}}">删除</button>
            <a href="/cartgory/edit/{{$v->cat_id}}"><button type="button" class="layui-btn layui-btn-normal">修改</button></a>
            </td>
            </tr>
        @endforeach
        </tbody>

    </table>
    </div>
</div>
<script src="http://libs.baidu.com/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">

    //顶级
    $(document).ready(function(){
    $("tr[parent_id='0']").show();
    })

    //子级
    $(document).on("click",'.showHide',function(){
    // alert(21212);
    var _this=$(this);
    var _sign=_this.text();
    // alert(_sign);
    var cat_id=_this.parents("tr").attr("cat_id");
    if(_sign=="+"){
    var child=$("tr[parent_id='"+cat_id+"']");
    if(child.length>0){
    child.show();
    _this.text("-");
    }
    }else{
    $("tr[parent_id='"+cat_id+"']").hide();
    _this.text("+");
    }
    })
  
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
</script>


@endsection

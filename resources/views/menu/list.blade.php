@extends('layouts.layout')
@section('title','菜单管理')
@section('content')
<blockquote class="layui-elem-quote layui-text">
<h4 style="color:green">菜单展示</h4>
</blockquote>

<div style="padding: 15px;">
    <div class="layui-form">
    <table class="layui-table">

        <thead width="1000px">
            <tr>
                <th width="30px">菜单ID</th>
                <th width="70px">菜单名称</th>
                <th width="70px">菜单路由</th>
                <th width="100px">操作</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $k=>$v)
            <tr style="display: none" menu_id="{{$v->menu_id}}" parent_id="{{$v->parent_id}}">
            <td>{{$v->menu_id}}</td>
            <td>
            <a href="javascript:void(0)" class="showHide">+</a>
            {{@str_repeat('—',$v->level*2)}}
            {{$v->menu_name}}
            </td>
            <td>
            {{$v->menu_url}}
            </td>
            <td>
            <button type="button" class="layui-btn layui-btn-danger del" menu_id="{{$v->menu_id}}">删除</button>
            <a href="/cartgory/edit/{{$v->menu_id}}"><button type="button" class="layui-btn layui-btn-normal">修改</button></a>
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
    var menu_id=_this.parents("tr").attr("menu_id");
    if(_sign=="+"){
    var child=$("tr[parent_id='"+menu_id+"']");
    if(child.length>0){
    child.show();
    _this.text("-");
    }
    }else{
    $("tr[parent_id='"+menu_id+"']").hide();
    _this.text("+");
    }
    })
  
  //删除
      $(document).on('click','.del',function(){
          var _this = $(this);
          var menu_id = _this.attr('menu_id');
          if(!menu_id){
              return;
          }
          if(confirm('确定删除吗？')){
              $.ajax({
                  url : '/menu/destroy',
                  dataType : 'json',
                  type : 'post',
                  data : {'menu_id':menu_id},
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

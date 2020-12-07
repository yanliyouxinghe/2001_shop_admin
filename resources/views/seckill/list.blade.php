@extends('layouts.layout')
@section('title', '抢购列表')
@section('content')

    <center><h1>添加抢购<a style="float:right" href="{{url('/seckill/create')}}" type="button" class="btn btn-default">添加</a></h1></center><hr/>
    <div class="table-responsive">
        <table class="table">
            <tbody>
            <tr>
                <th width="30px">ID</th>
                <th width="100px">限时抢购名称</th>
                <th width="50px">起始时间</th>
                <th width="50px">结束时间</th>
                <th width="50px">图片</th>
                <th width="50px">名称</th>
                <th width="50px">限时抢购价格</th>
                <th width="50px">限时抢购数量</th>
                <th width="50px">介绍</th>
                <th width="200px">操作</th>
            </tr>
            @foreach($data as $k=>$v)
                <tr>
                    <td>{{$v->seckill_id}}</td>
                    <td>{{$v->seckill_name}}</td>
                    <td>{{$v->start_time}}</td>
                    <td>{{$v->end_time}}</td>
                    <td>{{$v->seckill_number}}</td>
                    <td>
                        @if($v->goods_img)
                        <img src="{{$v->goods_img}}" width="50px" height="50px">
                        @endif

                    </td>
                    <td>{{$v->goods_name}}</td>
                    <td>{{$v->new_price}}</td>
                    <td>{{$v->seckill_desc}}</td>
                    <td>
                        <a href="/seckill/item/{{$v->seckill_id}}"><button type="button" class="layui-btn layui-btn-normal">查看</button></a>
                        <a href="{{url('/seckill/edit/'.$v->seckill_id)}}" id="" type="button" class="btn btn-dange">编辑</a>
                        <a href="{{url('/seckill/destroy/'.$v->seckill_id)}}" id="{{$v->position_id}}" type="button" class="btn btn-danger">删除</a>
                    </td>
          
            </tr>
            @endforeach
      
            </tbody>
        </table>
    </div>
    <script src="/static/jquery.min.js"></script>
    <script>
        //ajax删除
        $('.btn-danger').click(function(){
            var id = $(this).attr('id');
            var isdel = confirm('确定删除吗?');
            if(isdel == true){
                $.get('/poster/destroy/'+id,function(rest){
                    if(rest.error_no == '1'){
                        location.reload();
                    }
                },'json');
            }
        });
    </script>
@endsection

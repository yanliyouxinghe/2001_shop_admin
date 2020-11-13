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

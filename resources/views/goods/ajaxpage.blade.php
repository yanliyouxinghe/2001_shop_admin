 @foreach($goods as $v)
            <tr goods_id="{{$v->goods_id}}">
                <td>{{$v->goods_id}}</td>
                <td>{{$v->goods_name}}</td>
                <td>{{$v->goods_sn}}</td>
                <td>{{$v->shop_price}}</td>
                <td>{{$v->cat_id}}</td>
                <td>{{$v->brand_id}}</td>
                <td>@if(!empty($v->goods_img)) <img src="{{$v->goods_img}}" width="50px"> @endif </td>
                <td>{{$v->goods_weight}}</td>
                <td>{{$v->goods_number}}</td>
                <td>{{$v->warn_number}}</td>
                <td>
                <a href="/goods/jyl/{{$v->goods_id}}"><button type="button" class="layui-btn layui-btn-normal">查看</button></a>
                    <a href="{{'/goods/edit/'.$v->goods_id}}"><button type="button" class="layui-btn layui-btn-normal">修改</button></a>
                    <a href="javascript:;" class="layui-btn layui-btn-danger del">删除</a>
                </td>
            </tr>
        @endforeach
          <tr><td colspan="6">{{ $goods->links('vendor.pagination.adminbrand') }}</td></tr>
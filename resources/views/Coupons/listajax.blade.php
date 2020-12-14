@foreach($query as $k=>$v)
    <tr>
        <td><input type="checkbox" name="checkbox2" value="{{$v->coupons_id}}"></td>
        <td>{{$v->coupons_id}}</td>
        <td id="{{$v->coupons_name}}"><span class="oldname brand_name">{{$v->coupons_name}}</span></td>
        <td>{{$data1->goods_name}}</td>
        <td>
            @if($v->coupons_img)
            <img src="{{$v->coupons_img}}" width="50px" height="50px">
            @endif

            </td>
        <td>{{$v->coupons_meet}}</td>
        <td>{{$v->coupons_price}}</td>
        <td>
            <a href="{{url('/coupons/destroy/'.$v->coupons_id)}}">
                <button type="button" class="btn btn-danger" coupons_id = "{{$v->coupons_id}}">删除</button>
           </a>
            <a href="{{url('/coupons/edit/'.$v->coupons_id)}}"><button type="button" class="btn btn-info">编辑</button></a>
        </td>
    </tr>

    @endforeach
<tr><td colspan="6">{{ $query->links('vendor.pagination.adminbrand') }}</td></tr>
    <button type="button" class="layui-btn layui-btn-xs layui-btn-normal" id="pil">批量删除</button>
   
    
@foreach($adv as $v)
          <tr adv_id="{{$v->adv_id}}">
                <td><input type="checkbox" class="box" name="box" value="{{$v->adv_id}}"></td>
                <td>{{$v->adv_id}}</td>
                <td id="{{$v->adv_id}}" oldval="{{$v->adv_name}}">
                     <span class="span_name">{{$v->adv_name}}</span>
                </td>
                <td>{{$v->media_type==1?'图片':'文字'}}</td>
                <td>{{$v->ad_name}}</td>
                <td>{{$v->start_time}}</td>
                <td>{{$v->end_time}}</td>
                <td>{{$v->adv_link}}</td>
                <td>{{$v->is_open==1?'是':'否'}}</td>
                <td>{{$v->link_tel}}</td>
                <td>{{$v->link_email}}</td>
                <td>{{$v->adv_desc}}</td>
                <td>@if($v->template==1)单图片
                    @elseif($v->template==2)多图片
                    @else 文字
                    @endif
                </td>
            <td>
           <a href="{{url('adv/edit/'.$v->adv_id)}}"><button type="button" class="layui-btn layui-btn-normal">修改</button></a>
            <button type="button" class="layui-btn layui-btn-danger del" adv_id="{{$v->adv_id}}">删除</button>
               </td>
           
          </tr>
        @endforeach
        <tr><td colspan="8">{{$adv->links('vendor.pagination.adminbrand')}}</td>
          <button type="button" class="moredel">批量删除</button>
        </tr>
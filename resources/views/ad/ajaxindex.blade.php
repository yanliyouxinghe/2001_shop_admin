    @foreach($ad as $v)
          <tr ad_id="{{$v->ad_id}}">
            <td><input type="checkbox" name="box" value="{{$v->ad_id}}"></td>
            <td>{{$v->ad_id}}</td>
            <td id="{{$v->ad_id}}" oldval="{{$v->ad_name}}">
               <span class="span_ad">{{$v->ad_name}}</span>
            </td>
            <td>{{$v->ad_width}}</td>
            <td>{{$v->ad_height}}</td>
            <td>{{$v->ad_desc}}</td>
            <!-- <td>{{$v->template}}</td> -->
            <td>
            <a href="{{url('ad/sh/'.$v->ad_id)}}"><button type="button" class="layui-btn layui-btn-normal">生成广告</button></a>
            <a href="{{url('ad/ch/'.$v->ad_id)}}"><button type="button" class="layui-btn layui-btn-normal">查看广告</button></a>
            <a href="{{url('ad/edit/'.$v->ad_id)}}"><button type="button" class="layui-btn layui-btn-normal">修改</button></a>
            <button type="button" class="layui-btn layui-btn-danger del" ad_id="{{$v->ad_id}}">删除</button>
               </td>
           
          </tr>
        @endforeach
        <tr><td colspan="7">{{$ad->links('vendor.pagination.adminbrand')}}</td>
          <button type="button" class="moredel">批量删除</button>
        </tr>
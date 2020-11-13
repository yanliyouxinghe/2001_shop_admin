@foreach($data as $k=>$v)
    <tr>
        <td><input type="checkbox" name="checkbox2" value="{{$v->notice_id}}"></td>
        <td>{{$v->notice_id}}</td>
        <td id="{{$v->notice_id}}"><span class="oldname notice_name">{{$v->notice_name}}</span></td>
        <td>{{$v->notice_url}}</td>
        <td>{{$v->notice_desc}}</td>
        <td>{{$v->created_at}}</td>
        <td>
            {{--            <a href="{{url('/notice/destroy/'.$v->notice_id)}}">--}}
            <button type="button" class="btn btn-danger" notice_id = "{{$v->notice_id}}">删除</button>
            {{--            </a>--}}
            <a href="{{url('/notice/show/'.$v->notice_id)}}"><button type="button" class="btn btn-info">编辑</button></a>
        </td>
    </tr>

@endforeach
<tr><td colspan="6">{{ $data->links('vendor.pagination.adminbrand') }}</td></tr>

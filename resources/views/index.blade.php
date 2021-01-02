@extends('layouts.layout')  
@section('content')

<!DOCTYPE html>
<html>
<head>
	<title>首页</title>
	   <meta charset="utf-8"><link rel="icon" href="https://jscdn.com.cn/highcharts/images/favicon.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            /* css 代码  */
        </style>
        <script src="/static/admin/highcharts.js"></script>
        <script src="/static/admin/exporting.js"></script>
        <script src="/static/admin/highcharts-zh_CN.js"></script>
        <script src="/static/admin/grid-light.js"></script>
</head>
<body>
  <div id="container" style="min-width:400px;height:400px"></div>
<script>
	var chart = Highcharts.chart('container', {
    title: {
        text: '各项统计表'
    },
    xAxis: {
        categories: ['日', ' 周', '月', '总']
    },
    plotOptions: {
        series: {
            stacking: 'normal'
        }
    },
    labels: {
        items: [{
            html: '日/周/月注册量',
            style: {
                left: '100px',
                top: '18px',
                color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
            }
        }]
    },
    series: [{
        type: 'column',
        name: '活跃度',
        data: [17,53 , 109, 179]
    }, {
        type: 'column',
        name: '未支付订单',
        data: [12, 47, 94, 173]
    }, {
        type: 'column',
        name: '已支付订单',
        data: [14, 45, 69, 128]
    }, {
        type: 'pie',
        name: '注册量',
        data: [{
            name: '日',
            y: 7,
            color: Highcharts.getOptions().colors[0] // Jane's color
        }, {
            name: '周',
            y: 20,
            color: Highcharts.getOptions().colors[1] // John's color
        }, {
            name: '月',
            y: 40,
            color: Highcharts.getOptions().colors[2] // Joe's color
        }],
        center: [100, 80],
        size: 100,
        showInLegend: false,
        dataLabels: {
            enabled: false
        }
    }]
});
</script>
</body>
</html>

@endsection
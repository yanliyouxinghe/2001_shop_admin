@extends('layouts.layout')  
@section('content')

<!DOCTYPE html>
<html>
<head>
	<title>首页</title>
</head>
<body>
<div id="container"></div>
<div id="sliders">
	<table bgcolor="#FFFFFF" align="left">
		<tr>
			<td>α 角（内旋转角）</td>
			<td><input id="alpha" type="range" min="0" max="45" value="15"/> <span id="alpha-value" class="value"></span></td>
		</tr>
		<tr>
			<td>β 角（外旋转角）</td>
			<td><input id="beta" type="range" min="-45" max="45" value="15"/> <span id="beta-value" class="value"></span></td>
		</tr>
		<tr>
			<td>深度</td>
			<td><input id="depth" type="range" min="20" max="100" value="50"/> <span id="depth-value" class="value"></span></td>
		</tr>
	</table>
</div>

</body>
</html>
<script type="text/javascript" src="https://code.highcharts.com.cn/jquery/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="https://code.highcharts.com.cn/highcharts/highcharts.js"></script>
<script type="text/javascript" src="https://code.highcharts.com.cn/highcharts/highcharts-3d.js"></script>
<script type="text/javascript" src="https://code.highcharts.com.cn/highcharts/modules/exporting.js"></script>
<script type="text/javascript" src="https://img.hcharts.cn/highcharts-plugins/highcharts-zh_CN.js"></script>
<script type="text/javascript">
	var chart = new Highcharts.Chart({
	chart: {
		renderTo: 'container',
		type: 'column',
		options3d: {
			enabled: true,
			alpha: 0,
			beta: 7,
			depth: 50,
			viewDistance: 25
		}
	},
	title: {
		text: '各项数据统计'
	},
	subtitle: {
		text: '以此为：  商品总条数  分类总条数  品牌总条数   管理员总条数 广告位总条数  广告总条数  公告总条数 菜单总条数  角色总条数'
	},
	plotOptions: {
		column: {
			depth: 25
		}
	},
	series: [{
		name:'各项分析统计',
		data: {{$data}}
	}]
});
// 将当前角度信息同步到 DOM 中
var alphaValue = document.getElementById('alpha-value'),
	betaValue = document.getElementById('beta-value'),
	depthValue = document.getElementById('depth-value');
function showValues() {
	alphaValue.innerHTML = chart.options.chart.options3d.alpha;
	betaValue.innerHTML = chart.options.chart.options3d.beta;
	depthValue.innerHTML = chart.options.chart.options3d.depth;
}
// 监听 sliders 的变化并更新图表
$('#sliders input').on('input change', function () {
	chart.options.chart.options3d[this.id] = this.value;
	showValues();
	chart.redraw(false);
});
showValues();
</script>

@endsection
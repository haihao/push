<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ad</title>
	
</head>
<body>
<div class="container">
@include('header')
<table>
	<tr><td>点击次数</td> <td>展示次数</td> <td>日期</td><td>点击率(ctr)</td></tr>
@foreach($ads as $ad)
	<tr>
		<td>{{$ad->clicks}}</td> 
		<td>{{$ad->shows}}</td> 
		<td>{{date('Y年m月d日',strtotime($ad->time))}}</td>
		<td>{{round($ad->clicks/$ad->shows*100)}}%</td>
	</tr>
@endforeach
<!--{{$ads->links()}}-->
</div>
</body>
</html>

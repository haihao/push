<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>config</title>
	
</head>
<body>
	@include('header')
	
	</br>
	<div>
	<table>
		<tr>	
			<td>timerDuration:</td>
			<td><input type="text" disabled=ture value="{{$config->timerduration}}"/></td>
			<td>*是否静默广告，值小于daPopTime则不弹广告，否则弹</td>
		</tr>
		<tr>
			<td>adPopTime:</td><td><input type="text" disabled=ture value="{{$config->adpoptime}}"/></td>
			<td>*广告持续时间</td>
		</tr>
		<tr>
			<td>adDuration:</td>
			<td><input type="text" disabled=ture value="{{$config->adduration}}"/></td>
			<td>*弹广告的时间选择，但持续在一个应用中时弹</td>
		</tr>
		<tr>
			<td>serviceDelay:</td>
			<td><input type="text" disabled=ture value="{{$config->servicedelay}}"/></td>
			<td>*没用到</td>
		</tr>
		<tr>
			<td>perMilReload:</td>
			<td><input type="text" disabled=ture value="{{$config->permilreload}}"/></td>
			<td>*每弹多少次广告就重新请求数据，5即代表5次</td>
		</tr>
		<tr><td><input type="button" value="修改配置" onclick="window.location.href='/admin/config/modify'" /></td></tr>
	</table>
	</div>
	<div>
		<div>
			<table>
				{{Form::open(array('url' => '/admin/config/appadd','files' => true)) }}
				<tr>	
					
					<td>添加过滤应用名单</td>
					<td><input type="text" name="packagename"/></td>
					<td><input type="submit" value="添加"/></td>
					<td><input type="reset" value="重置"/></td>
				</tr>
				{{ Form::close() }}
			</table>
			
			<table>
			@foreach($apps as $app)
				<tr>
					<td>{{$app->packagename}}</td>
					<td><a href="/admin/config/appdel?id={{$app->id}}">删除</a></td>
				</tr>
			@endforeach
			</table>
		</div>
		<div>
			{{$apps->links()}}
		<div>
	</div>
	<div>		
		@foreach ($errors->all() as $error)
			<span style="color:red;">提示：{{$error}}</br></span>
    		@endforeach	
			
	</div>

</body>
</html>

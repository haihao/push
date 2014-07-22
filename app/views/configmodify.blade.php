<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>config</title>
	
</head>
<body>
	<h2>修改配置信息</h2>
	<input type="button" value="返回" onclick="window.location.href='/admin/config'"/>
	</br>
	{{Form::open(array('url' => 'admin/config/set')) }}
	<table>
		<tr>	
			<td>timerDuration:</td>
			<td><input type="text" value="{{$config->timerduration}}" name="timerduration" /></td>
			<td>*是否静默广告，值小于daPopTime则不弹广告，否则弹</td>
		</tr>
		<tr>
			<td>adPopTime:</td>
			<td><input type="text"value="{{$config->adpoptime}}" name="adpoptime" /></td>
			<td>*广告持续时间</td>
		</tr>
		<tr>
			<td>adDuration:</td>
			<td><input type="text" value="{{$config->adduration}}" name="adduration" /></td>
			<td>*弹广告的时间选择，但持续在一个应用中时弹</td>
		</tr>
		<tr>
			<td>serviceDelay:</td>
			<td><input type="text" value="{{$config->servicedelay}}" name="servicedelay" /></td>
			<td>*没用到</td>
		</tr>
		<tr>
			<td>perMilReload:</td>
			<td><input type="text" value="{{$config->permilreload}}" name="permilreload"/></td>
			<td>*每弹多少次广告就重新请求数据，5即代表5次</td>
		</tr>
		<tr>
			<td><input type="submit" value="确定" /></td>
			<td><input type="reset" value="重置"/></td>
		</tr>
	</table>
		
	{{ Form::close() }}

	<div>		
		@foreach ($errors->all() as $error)
			<span style="color:red;">提示：{{$error}}</br></span>
    		@endforeach	
			
	</div>
</body>
</html>

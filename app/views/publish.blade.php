<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>publish</title>
	
</head>
<body>
	@include('header')
	<div>
	{{Form::open(array('url' => 'admin/publish','files' => true)) }}
		<table>		
			<tr><td>广告图片:</td><td>{{Form::file('appimg');}}</td><td>*图片格式支持jpg/jpeg gif bmp png,最大支持4M </td></tr>
			<tr><td>apk包:</td><td>{{Form::file('appapk');}}</td><td>*请选择上传的的apk包</td></tr>
			<tr><td><input type="submit" name="Button1" value="上传"/></td></tr>
		</table>
	{{ Form::close() }}
	</div>
	<div>		
		@foreach ($errors->all() as $error)
			<span style="color:red;">提示：{{$error}}</span></br>
    		@endforeach	
			
	</div>
</body>
</html>

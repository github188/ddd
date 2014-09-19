<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta content="" name="keywords">
	<meta content="" name="description">
	<link rel="stylesheet" href="__ROOT__/Public/css/style.css">
	<script type="text/javascript" src="__ROOT__/Public/js/jquery-1.8.1.min.js"></script>
	<script type="text/javascript" src="__ROOT__/Public/js/jquery.SuperSlide.2.1.js"></script>
	<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
	<!--[if lt IE 9]>
	    <script src="__ROOT__/Public/js/html5.js"></script>
	<![endif]-->
	<title>管理登录-DNSPro</title>
	<script type="text/javascript">
		//如果是内部页，父级页面刷新,登录
		if(window.top!=this){ 
			parent.location.reload();
		}
		
		function validate_form(form){
			var user = $("#u").val();
			var pwd  = $("#p").val();
			if(!user){
				$("#u").focus();
				$("#msg").html("请输入用户名！");
				return false;
			}
			if(!pwd){
				$("#p").focus();
				$("#msg").html("请输入密码！");
				return false;
			}
			return true;
		}
	</script>
</head>
<body>
        <div class="loginbox">
		<form id="regist" name="regist" onsubmit="return validate_form(this);" method="post">
		<h1 style="font:17px 黑体">DNSPro管理后台</h1>
		<hr size="1" style="color:#3CADED;border-style:dotted;">
		<ul>
			<li><span>用户名：</span><input id="u" name="username" class="ui-ipt-txt" placeholder="输入用户名" type="text" style="width:130px;" /></li>
			<li><span>密&nbsp;&nbsp;&nbsp;&nbsp;码：</span><input id="p" name="password" placeholder="输入密码" class="ui-ipt-txt" type="password" style="width:130px;" /></li>
		</ul>
		<div class="memu_bar" style="text-align:right;margin-bottom:20px;">
			<ul>
				<li id="msg" style="width:120px;margin-right:12px;"><?php echo ($error); ?></li>
				<li style="margin-left:0px;"><input type="submit" value="登&nbsp;&nbsp;&nbsp;录"></li>
			</ul>
		</div>
		</form>
	</div>
</body>
</html>
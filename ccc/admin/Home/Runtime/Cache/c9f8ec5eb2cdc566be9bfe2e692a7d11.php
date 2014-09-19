<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Language" content="zh-CN">
<meta name="Keywords" content="DNSPro">
<meta name="Description" content="DNSPro DNS 域名解析">
<title>DNSPro管理后台</title>
<link type="text/css" rel="stylesheet" href="__ROOT__/Public/css/style.css">
<script type="text/javascript" src="__ROOT__/Public/js/jquery-1.8.1.min.js"></script>
<script type="text/javascript" src="__ROOT__/Public/js/jquery.SuperSlide.2.1.js"></script>
<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
<!--[if lt IE 9]>
    <script src="./js/html5.js"></script>
<![endif]-->
</head>
<body>
<div id="topBar">
	<div class="siteWidth">
		<span><a style="text-decoration:none;"><a href="#">收藏页面</a></span>
		<ul>
			<li><em>您的域名出现访问超时，请留意！</em>DNSpro监控到您的域名出现故障，请检查</li>
			<li><em>DNSPro退出个人用户免费套餐啦，欢迎免费试用！</em>试用对象：小型站点，企业网站，个人用户等</li>
		</ul>
	</div>
</div><div class="clear"></div>
<script type="text/javascript">jQuery("#topBar").slide({ mainCell:"ul",autoPlay:true,effect:"topLoop" });</script>

<!-- 头部 S -->
<div id="header">
	<div class="logoBar">
		<h1>DNSPro管理平台</h1>
	</div>

	<!-- navBar -->
	<div class="navBar">
		<ul class="nav clearfix">
			<li class="m">
				<h3><a target="_self" href="__APP__/Clientmgr/">客户管理</a></h3>
			</li>
			<li class="s">|</li>
			<li class="m">
				<h3><a target="_self" href="__APP__/Domainmgr/">域名管理</a></h3>
			</li>
			<li class="s">|</li>
			<li class="m">
				<h3><a target="_self" href="#">套餐管理</a></h3>
			</li>
			<li class="s">|</li>
			<li class="m">
				<h3><a target="_self" href="__APP__/Runmgr/">运行管理</a></h3>
			</li>
			<li class="s">|</li>
			<li class="m on">
				<h3><a target="_self" href="__APP__/System/">控制面板</a></h3>
			</li>
			<div>
				<span class='name'><?php echo ($_SESSION['user']); ?></span>
				<span class='notification'>|</span>
				<a class='account' href="__APP__/Index/"><span>退出</span></a>
			</div>
		</ul>
	</div>
</div><!-- 头部 e --><div class="clear"></div>

<div class="content"><!-- 内容 -->
	<!-- left菜单 S -->
	<div id="sideMenu" class="side">
		<div class="hd">
			<h3>服务器管理</h3>
		</div>
		<div class="bd">
			<ul>
				<li><a href="__APP__/System">服务器列表</a></li>
				<li><a href="__APP__/System/addServer">添加服务器</a></li>
			</ul>
		</div>
		<div class="hd on">
			<h3>系统用户管理</h3>
		</div>
		<div class="bd">
			<ul>
				<li><a href="__APP__/System/user">系统用户列表</a></li>
				<li><a style="color:#3CADED; text-decoration:underline;" href="__APP__/System/addUser">添加系统用户</a></li>
			</ul>
		</div>
		<div class="hd">
			<h3>任务下发管理</h3>
		</div>
		<div class="bd">
			<ul>
				<li><a href="__APP__/System/task">任务下发记录</a></li>
				<li><a href="#"></a></li>
				<li><a href="#"></a></li>
				<li><a href="#"></a></li>
			</ul>
		</div>
		<div class="hd">
			<h3>其他功能</h3>
		</div>
		<div class="bd">
			<ul>
				<li><a href="#"></a></li>
				<li><a href="#"></a></li>
			</ul>
		</div>
	</div>
	<script type="text/javascript">jQuery("#sideMenu").slide({ titCell:".hd", targetCell:".bd", effect:"slideDown", trigger:"click" });</script>
	<!-- left菜单 E -->
	
	<!-- mainContent s -->
	<div class="mainContent">
		
		<!-- Tab切换 S -->
		<div class="slideTxtBox">
			<div class="hd">
				<h2 style="float:left;">添加系统用户</h2>
			</div>
			<div class="bd">
				<ul>
					<table class="ui-table" cellpadding="0" cellspacing="0" width="100%" id="mytab" style="margin-left:20px;">
						<thead>
							<tr id="tr_title">
								<th style="text-align:left;font-size:13px;color:#404040;">[基本信息]</th>
								<th colspan="2"><input type="hidden" id="txt_id" value="<?php echo ($server["id"]); ?>"></th>
							</tr>
						</thead> 	
						<tbody id="myData">
							<tr class="data">
							    <td class="laber">备注信息</td>
							    <td class="edit"><input class="ui-ipt-txt" type="text" id="txt_desc" placeholder="备注信息"></td>
							    <td class="info">例如：系统管理员，曾小力</td>
							</tr>
							<tr class="data">
							    <td class="laber">用户名</td>
							    <td class="edit"><input class="ui-ipt-txt" type="text" id="txt_user" placeholder="用户名"> *</td>
							    <td class="info"></td>
							</tr>
							<tr class="data">
							    <td class="laber">密 码</td>
							    <td class="edit"><input class="ui-ipt-txt" type="password" id="txt_pwd" placeholder="密 码"> *</td>
							    <td class="info"></td>
							</tr>
							<tr class="data">
							    <td class="laber"></td> 	
							    <td class="edit">
								    <button id="submit_btn" onclick="save();">保存</button> <span id="save_msg" style="color:#3CADED"></span>
							    </td>
							    <td class="info"></td>  
							</tr>
						</tbody> 
					</table>
				</ul>
			</div>
		</div>
		<script type="text/javascript">jQuery(".slideTxtBox").slide();</script>
		<!-- Tab切换 E -->
	</div>
</div>

	<div class="footer">
		<span class="ui-color-grey">Copyright © 2014 DNSPro 版权所有</span>	  
	</div>

<script type="text/javascript">
	function save(){
		var user = $("#txt_user").val();
		var pwd = $("#txt_pwd").val();
		var desc = $("#txt_desc").val();
		if(!user){
			$("#save_msg").html("请输入用户名！");
			$("#txt_user").focus();
			return false;
		}
		if(!pwd){
			$("#save_msg").html("请输入密码！");
			$("#txt_pwd").focus();
			return false;
		}
		$.ajax({
			url: '__APP__/System/addUser',
			type: "post",
			data:{'user':user, 'pwd':pwd, 'desc':desc},
			success: function (data) {
				$("#save_msg").html(data.info);
			},
			error: function (data) {
				alert(data.statusText);
			}
		});
	}
	//这种导航效果相当于Tab切换，用titCell和mainCell 处理
	jQuery(".navBar").slide({ 
		titCell:".nav .m", // 鼠标触发对象
		mainCell:".subNav", // 切换对象包裹层
		delayTime:0, // 效果时间
		triggerTime:0, //鼠标延迟触发时间
		returnDefault:true  //返回默认状态
	});
</script> 
</body>
</html>
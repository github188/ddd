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
				<li><a style="color:#3CADED; text-decoration:underline;" href="__APP__/System">服务器列表</a></li>
				<li><a href="__APP__/System/addServer">添加服务器</a></li>
			</ul>
		</div>
		<div class="hd">
			<h3>系统用户管理</h3>
		</div>
		<div class="bd">
			<ul>
				<li><a href="__APP__/System/user">系统用户列表</a></li>
				<li><a href="__APP__/System/addUser">添加系统用户</a></li>
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
				<h2 style="float:left;">添加服务器</h2>
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
							    <td class="edit"><input class="ui-ipt-txt" type="text" id="txt_desc" value="<?php echo ($server["desc"]); ?>" placeholder="备注信息"></td>
							    <td class="info">例如：dns broker中山BGP</td>
							</tr>
							<tr class="data">
							    <td class="laber">服务器编码</td>
							    <td class="edit"><input class="ui-ipt-txt" type="text" id="txt_sid" value="<?php echo ($server["sid"]); ?>" placeholder="dns_broker_primary"> *</td>
							    <td class="info">例如：dns_broker_primary</td>
							</tr>
							<tr class="data">
							    <td class="laber">IP地址</td>
							    <td class="edit"><input class="ui-ipt-txt" type="text" id="txt_ip" value="<?php echo ($server["ip"]); ?>" placeholder="IP地址"> *</td>
							    <td class="info"></td>
							</tr>
						</tbody> 
						<thead>
							<tr id="tr_title">
								<th style="text-align:left;font-size:13px;color:#404040;">[分类信息]</th> 
								<th colspan="2"></th>
							</tr>
						</thead> 
						<tbody id="myData">
							<tr class="data">
							    <td class="laber">所属分类</td>
							    <td class="edit">
								  <select id="sel_type" class="ui-select">
									<?php if(is_array($tlist)): $i = 0; $__LIST__ = $tlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$t_vo): $mod = ($i % 2 );++$i; if($t_vo["type"] == $server.type): ?><option selected><?php echo ($t_vo["type"]); ?></option>
											<?php else: ?><option><?php echo ($t_vo["type"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
								  </select>
							    </td>
							    <td class="info"></td>
							</tr>
							<tr class="data">
							    <td class="laber">所属子类</td>
							    <td class="edit">
								    <select id="sel_subtype" class="ui-select">
									  <?php if(is_array($ctlist)): $i = 0; $__LIST__ = $ctlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ct_vo): $mod = ($i % 2 );++$i; if($ct_vo["subtype"] == $server.subtype): ?><option selected><?php echo ($ct_vo["subtype"]); ?></option>
											<?php else: ?><option><?php echo ($ct_vo["subtype"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
								    </select>
							    </td>
							    <td class="info"></td>
							</tr>
						</tbody> 
						<thead>
							<tr id="tr_title">
								<th style="text-align:left;font-size:13px;color:#404040;">[状态设定]</th> 
								<th colspan="2"></th>
							</tr>
						</thead>
						<tbody id="myData">
							<tr class="data">
							    <td class="laber">服务器状态</td>
							    <td class="edit">
								    <select id="sel_status" class="ui-select">
									  <?php if($server["status"] == 'true'): ?><option selected value="true">启用</option>
										<?php else: ?><option value="false">停用</option><?php endif; ?>
								    </select>
							    </td>
							    <td class="info">停用服务器将导致服务器不可用</td>  
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
		var id = $("#txt_id").val();
		var ip = $("#txt_ip").val();
		var desc = $("#txt_desc").val();
		var sid = $("#txt_sid").val();
		var type = $("#sel_type").val();
		var subtype = $("#sel_subtype").val();
		var status = $("#sel_status").val();
		if(!sid){
			$("#save_msg").html("请输入服务器编号！");
			$("#txt_sid").focus();
			return false;
		}
		if(!ip){
			$("#save_msg").html("请输入IP地址！");
			$("#txt_ip").focus();
			return false;
		}
		$.ajax({
			url: '__APP__/System/editServer',
			type: "post",
			data:{'id':id, 'ip':ip, 'sid':sid, 'desc':desc, 'type':type, 'subtype':subtype, 'status':status},
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
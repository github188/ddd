<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html><head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta content="" name="keywords">
	<meta content="" name="description">
	<title>EflyDNS - 域名设置</title>
    <link rel="shortcut icon" href="__ROOT__/Public/img/eflydns.ico" />
	<link rel="stylesheet" href="__ROOT__/Public/css/base.css">
	<link rel="stylesheet" href="__ROOT__/Public/css/dns.css">
	<link rel="stylesheet" href="__ROOT__/Public/css/artDialog.css">
	<script type="text/javascript" src="__ROOT__/Public/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="__ROOT__/Public/js/jquery.mailAutoComplete-3.1.js"></script>
	<script type="text/javascript" src="__ROOT__/Public/js/util.js"></script>
	<script type="text/javascript" src="__ROOT__/Public/js/layer/layer.min.js"></script>    
    <style type="text/css">     
		.out_box{border:1px solid #ccc; background:#fff; font-size:16px;}     
		.list_box{border-bottom:1px solid #eee; padding:0 5px; cursor:pointer;}     
		.focus_box{background:#f0f3f9;}     
		.mark_box{color:#c00;}     
	</style> 
	<script type="text/javascript" >
		$(function(){
			$(":radio").each(function(){
				if($(this).val()==$("#txt_default_ttl").val()){
					$(this).attr('checked','true');
				}
				//alert($(this).val);
			});
		});
		function bindEmail(){
			$("#txt_email").mailAutoComplete({     
				boxClass: "out_box", //外部box样式     
				listClass: "list_box", //默认的列表样式     
				focusClass: "focus_box", //列表选样式中     
				markCalss: "mark_box", //高亮样式     
				autoClass: true,     
				textHint: true, //提示文字自动隐藏 
			}); 	
		}
		function showLog(obj){
			$.layer({
				type : 2,
				title : ['查看域名操作日志',true],
				iframe : { src : '__APP__/Optlog/index' },
				area : ['750px' , '466px'],
				offset : ['100px','']
			});
		}
		function addUser(obj){
			if($("#txt_is_lock").val()==0){
				if($('.addUserInput').length<5){
					$(obj).parent().parent().after('<tr class="data"><td class="laber"><input type="hidden" class="addUserInput"/></td><td class="edit" colspan="2"><input class="ui-ipt-txt" type="text" placeholder="输入用户的DNSPro账号"><select style="margin-left:10px" class="ui-select" onchange="changeType(this);"><option value="全部记录" selected>全部记录</option><option value="单条记录">单条记录</option></select><select id="domain_sel" style="margin-left:10px;display:none;" class="ui-select" ></select><a style="margin-left:10px;" href="javascript:" onclick="doAddUser(this);">保存</a><a style="margin-left:10px;" href="javascript:" onclick="cancelUser(this);">取消</a><label style="margin-left:20px;color:red;" id="adduser_msg"></label></td></tr>');
				}
			}else{
				messageBox('jbzl_msg','['+$("#txt_zone").val()+']域名锁定，不能进行该操作');
			}
		}
		function doAddUser(obj){
			var user = $(obj).parent().find('input:eq(0)').val(),is_ok=true,
				sel_type=$(obj).parent().find('select:eq(0)').val(),sel_val;
			if(sel_type!="全部记录"){
				sel_val=$(obj).parent().find('select:eq(1)').val();	
			}
			if(user=='' || typeof(user)=='undefined'){
				$(obj).parent().find('input:eq(0)').focus();
				is_ok=false;
				return;		
			}
			if(checkemail(user)==false){
				$(obj).parent().find('input:eq(0)').focus();
				$(obj).next().next().html('输入的用户名有误，请重新输入');
				is_ok=false;
				return;
			}
			if(is_ok){
				$.ajax({
					url:'__APP__/Domain/doAddUser',
					type:'post',
					data:{'user':user,'zoneID':$("#txt_zoneID").val(),'type':sel_type,'domainID':sel_val},
					success:function(data){
						if(data.info=='success'){
							$(':disabled').each(function(e){
								if($(this).val()==user){
									$(this).parent().parent().empty();
								}else{
									if(sel_type=="全部记录"){
										$(obj).parent().html('<input class="ui-ipt-txt" type="text" value="'+user+'" disabled/><a style="margin-left:6px;" href="javascript:void(0);" onclick="deleteUser(this,'+data.data[0].client_id+','+data.data[0].zone_id+');"> 删除</a>');
									}else{
										$(obj).parent().html('<input class="ui-ipt-txt" type="text" value="'+user+'" disabled/><a style="margin-left:6px;" href="javascript:void(0);" onclick="deleteUser(this,'+data.data.client_id+','+data.data.zone_id+');"> 删除</a>');
									}
								}
							});
							messageBox('jbzl_msg','添加管理权限用户成功');
						}else{							
							$(obj).next().next().html(data.data);
						}
					},
					error:function(data){
						messageBox('jbzl_msg',data.statusText);
					}
				});
			}
		}
		function changeType(obj){
			if($(obj).val() != "全部记录"){
				$.ajax({
					url:'__APP__/Domain/findDomain',
					type:'post',
					data:{'zoneID':$("#txt_zoneID").val()},
					success:function(data){
						if(data.info=='success'){
							$("#domain_sel").empty();
							for(var i=0;i<data.data.length;i++){
								$("#domain_sel").append('<option value="'+data.data[i].id+'">'+data.data[i].host+'  '+data.data[i].type+'  '+data.data[i].val+'</option>')	
							}
							$("#domain_sel").css('display','inline');
						}else{						
							messageBox('jbzl_msg',data.data);
						}
					},
					error:function(data){
						messageBox('jbzl_msg',data.statusText);
					}
				});
			}else{
				$("#domain_sel").css('display','none');
			}
		}
		function cancelUser(obj){
			$(obj).parent().parent().remove();
		}
		function bindRoute(route){
			var val;
			if(typeof(route)=='undefined' || route==""){
				return "默认";
			}else{
				return val;
			}
		}
		function updateDesc(){
			if($("#txt_is_lock").val()==0){
				$.ajax({
					url:'__APP__/Domain/addZoneDesc',
					type:'post',
					data:{'domain':$("#txt_zone").val(),'desc':$("#txt_desc").val()},
					success:function(data){
						if(data.info=='success'){
							messageBox('jbzl_msg','域名备注修改成功');	
						}
					},
					error:function(data){
						messageBox('jbzl_msg',data.statusText);
					}
				});
			}else{
				messageBox('jbzl_msg','['+$("#txt_zone").val()+']域名锁定，不能进行该操作');
			}
		}
		function zoneLock(obj){
			$.ajax({
				url:'__APP__/Domain/zoneLock',
				type:'post',
				data:{'domain':$("#txt_zone").val()},
				success:function(data){
					if(data.info=='success'){
						if(data.data==0){
							$(obj).html('锁定');
							$(obj).prev().html('域名未锁定');
							$("#txt_is_lock").val(0);
							messageBox('aqsz_msg','域名解锁成功');
						}else{
							$(obj).html('解锁');
							$(obj).prev().html('域名已锁定');
							$("#txt_is_lock").val(1);
							messageBox('aqsz_msg','域名锁定成功');	
						}
					}else{
						messageBox('aqsz_msg',data.data);
					}
				},
				error:function(data){
					messageBox('aqsz_msg',data.statusText);
				}
			});
		}
		function startStopZone(obj){
			if($("#txt_is_lock").val()==0){
				$.ajax({
					url:'__APP__/Domain/startStopZone',
					type:'post',
					data:{'domain':$("#txt_zone").val()},
					success:function(data){
						if(data.info=='success'){
							if(data.data==0){
								$(obj).html('启用');
								$(obj).prev().html('暂停');
								messageBox('aqsz_msg','域名停用成功');
							}else{
								$(obj).html('暂停');
								$(obj).prev().html('启用');
								messageBox('aqsz_msg','域名启用成功');	
							}
						}else{
							messageBox('aqsz_msg',data.data);
						}
					},
					error:function(data){
						messageBox('aqsz_msg',data.statusText);
					}
				});
			}else{
				messageBox('aqsz_msg','['+$("#txt_zone").val()+']域名锁定，不能进行该操作');
			}
		}
		function deleteUser(obj,cid,zid){
			if($("#txt_is_lock").val()==0){
				if(confirm('确认删除管理账户？')){
					$.ajax({
						url:'__APP__/Domain/deleteUser',
						type:'post',
						data:{'cid':cid,'zid':zid},
						success:function(data){
							if(data.info=='success'){
								$(obj).parent().parent().empty();								
								messageBox('jbzl_msg',data.data);
							}else{
								messageBox('jbzl_msg',data.data);
							}
						},
						error:function(data){
							messageBox('jbzl_msg',data.statusText);
						}
					});
				}
			}else{
				messageBox('jbzl_msg','['+$("#txt_zone").val()+']域名锁定，不能进行该操作');
			}
		}
		function transfer(){
			if($("#txt_is_lock").val()==0){
				$.layer({
					type: 1,
					title: '域名过户',
					area: ['450px', '160px'],
					offset: ['220px' , ''],
					btns: 2,
					btn: ['确定', '取消'],
					page: {
						html: '<div style="margin-top:20px;margin-left:80px;"><strong style="color:#666;font-size:14px;">DNSPro账户：</strong><input style="border: 1px solid #ddd;width: 200px;height: 26px;font-size: 14px;color: #666;padding-left:5px;" id="txt_email" onfocus="bindEmail()" /><strong style="color:red;font-size:16px; margin-left:5px;">*</strong><br/><br/><font id="addGroup_msg" style="color:red;margin-left:98px;"></font></div>'
					},
					yes: function(index){						
						if(confirm('确认过户管理账户？')){
							$.ajax({
								url:'__APP__/Domain/transfer',
								type:'post',
								async:false,
								data:{'email':$("#txt_email").val()},
								success:function(data){
									if(data.info=='error'){
										$("#addGroup_msg").html(data.data);	
									}else{
										messageBox('jbzl_msg','域名过户成功，3秒跳转域名记录页面');
										layer.close(index);
										setTimeout(function(){
											window.location.href='__APP__/Domain/domainList';
										},3000);
									}
								},
								error:function(data){
									messageBox('jbzl_msg',data.statusText);
								}
							});							
						}
					}
				});	
			}else{
				messageBox('jbzl_msg','['+$("#txt_zone").val()+']域名锁定，不能进行该操作');
			}
		}
		function changeTTL(obj){
			if(confirm('确定修改域名TTL默认值？')){
				var val = $(obj).val(),id=$("#txt_zoneID").val();
				$.ajax({
					url:'__APP__/Domain/changeTTL',
					type:'post',
					data:{'id':id,'ttl':val},
					success:function(data){
						if(data.info=='success'){						
							messageBox('gnsz_msg','域名TTL默认值修改成功');		
						}else{
							messageBox('gnsz_msg',data.data);		
						}
					},
					error:function(data){
						messageBox('gnsz_msg',data.statusText);	
					}
				});
			}
		}
    </script>
</head>
<body class="page-dns">
	<div class="J_pageWrapper">
		<!-- header -->
		<div class="tc-page-head"> 	
	<div class="inner"> 		
		<h1 class="logo">
			<a href="http://www.eflydns.com/"><img class="main lf" src="__ROOT__/Public/img/DNSPro_w.png" alt="DNSPro"></a>
		</h1>
		<div class="info">
			<p class="user">您好，<?php echo ($_SESSION['user']); ?>
				<span class="s">|</span>
				<a href="javascript:void(0);" style="margin-left:-10px;padding: 5px 15px 5px 15px; background:url(__ROOT__/Public/img/down_arrow.png) no-repeat; background-position:40px 8px;" id="userinfo">账户</a>
                <!--span class="s">|</span>
				<a href="__APP__/Index/login/">退出</a><!--span class="s">|</span>	
				<a href="javascript:void(0);">购物车[0件]</a-->
			</p>
			<p class="nav">
				<span class="b active"></span><a href="__APP__/Domain/domainList/">域名解析</a>
				<!--span class="b"></span><a href="__APP__/Monitor/">域名监控</a>
				<span class="b"></span><a href="__APP__/Shop/">域名商城</a-->
				<span class="b"></span><a href="http://www.eflydns.com/index/Help/help/" target="_blank">帮助中心</a>
			</p>
		</div>        
        <div class="userset" id="userset">
            <ul>
                <li style=" border-top:none;">
                	<a href="__APP__/Index/user/"><i style="background:url(__ROOT__/Public/img/set.png) no-repeat;"></i>账户设置</a>
                </li>
                <!--li>
                	<a href="javascript:void(0);"><i style="background:url(__ROOT__/Public/img/service.png) no-repeat;"></i>我的服务</a>
                </li>
                <li>
                	<a href="javascript:void(0);"><i style="background:url(__ROOT__/Public/img/user.png) no-repeat;"></i>切换账户</a>
                </li-->
                <li>
                	<a href="__APP__/Index/login/"><i style="background:url(__ROOT__/Public/img/out.png) no-repeat;"></i>退出</a>
                </li>
            </ul>
        </div>
	</div>
</div> 
<script type="text/javascript">	
		
	$(function(e){
		
		$(".info .user a").hover(function(){
			$(this).css({'background':'#fff url(__ROOT__/Public/img/down_arrow1.jpg) no-repeat','color':'#666','background-position':'40px 8px'});
			$("#userset").show();
			
		},function(){
			//$(this).css({'background':'#1c8fdf url(__ROOT__/Public/img/down_arrow.png) no-repeat','color':'#fff','background-position':'40px 8px'});
		});
		
		$('html').bind('click',function(e){
			if($("#userset").is(":visible")){
				$("#userset").slideToggle();
				$(".info .user a").css({'background':'#1c8fdf url(__ROOT__/Public/img/down_arrow.png) no-repeat','color':'#fff','background-position':'40px 8px'});	
			}
		});
		
		$("#userset ul").mouseleave(function(){
			$(".info .user a").css({'background':'#1c8fdf url(__ROOT__/Public/img/down_arrow.png) no-repeat','color':'#fff','background-position':'40px 8px'});	
			$("#userset").hide();
		});
	});
	var stopPropagation = function(e) {
		if(e && e.stopPropagation){         //W3C取消冒泡事件         
			e.stopPropagation();     
		}else{         //IE取消冒泡事件         
			window.event.cancelBubble = true;     
		} 
	};
</script>

		<input type="hidden" value="<?php echo ($zone["domain"]); ?>" id="txt_zone"/>        
		<input type="hidden" value="<?php echo ($zone["id"]); ?>" id="txt_zoneID"/>        
		<input type="hidden" value="<?php echo ($zone["is_lock"]); ?>" id="txt_is_lock"/>            
		<input type="hidden" value="<?php echo ($userCount); ?>" id="txt_userCount"/>
		<input type="hidden" value="<?php echo ($zone["default_ttl"]); ?>" id="txt_default_ttl"/>        
		<div class="head-info">
			<div class="head-path">
				<a class="home" href="__APP__/Domain/domainList" ></a><span class="s"></span>
				<a href="__APP__/Domain/domainList">域名列表</a><span class="s"></span>
				<strong class="current"><?php echo ($zone["domain"]); ?> 的域名设置</strong>
			</div>
		</div> 
		<div class="J_singleTop">
			<p class="domain-title">
				<!--if condition="$is_on eq 0">
                	<span class="dtype icon-pause"></span>
					<else /-->
                    <?php if($level != 0): ?><span class="dtype icon-vip"></span>
                        <?php else: ?><span class="dtype icon-novip"></span><?php endif; ?>
                <!--<a href="__APP__/Domain/domainRoute?d=<?php echo ($zone["domain"]); ?>">自定义路线</a>-->
				<strong id="cur_zone" class="dname"><?php echo ($zone["domain"]); ?></strong>
				<span class="tab nocur"><a href="javascript:void(0);">自定义路线</a></span>
				<span class="tab nocur"><a href="__APP__/Domain/domainRpt?d=<?php echo ($zone["domain"]); ?>">解析统计</a></span>
				<span class="tab "><a href="__APP__/Domain/domainSet?d=<?php echo ($zone["domain"]); ?>">域名设置</a></span>
				<span class="tab nocur"><a href="__APP__/Domain/detail?d=<?php echo ($zone["domain"]); ?>">记录管理</a></span>
			</p>
		</div>
		<div class="table-box" style="margin-bottom:100px;">
			<table class="ui-table" cellpadding="0" cellspacing="0" width="100%" id="mytab">
				<thead>
					<tr id="tr_title">
						<th style="text-align:left;font-size:13px;color:#404040;">[基本资料]</th>
                        <th colspan="2">
                        <div class="ui-pop-box small-con-box" id="jbzl_msg" style="float:left; margin-left:10px; display:none;width:auto;height:auto;margin-top:-4px;">
							<div style="position: relative;background-color: #fff;border: solid 1px #999; height:20px;line-height:20px; padding:2px 10px 2px 10px">这里是提示信息</div>
						</div>
                        </th>
					</tr>
				</thead> 	
				<tbody id="myData">
					<tr class="data">
					    <td class="laber">备注</td>
					    <td class="edit"><input class="ui-ipt-txt" type="text" id="txt_desc" value="<?php echo ($zone["desc"]); ?>"><a style="margin-left:10px;" href="javascript:void(0);" onClick="updateDesc()">修改</a></td>
					    <td class="info">例如：这个域名在 Godaddy 注册，是静态文件域名</td>
					</tr>
					<tr class="data">
					    <td class="laber">管理权限</td> 	
					    <td class="edit"><input disabled class="ui-ipt-txt" type="text" id="session_user" value="<?php echo ($_SESSION['user']); ?>"><input type="hidden" class="addUserInput"/><a style="margin-left:10px;" href="javascript:" onclick="addUser(this);">添加</a><a style="margin-left:10px;" href="javascript:void(0);" onClick="transfer();">过户</a></td>
					    <td class="info">您可以添加管理用户，或者过户给其他用户（最多限制五个用户）</td>  
					</tr>
                    <?php if($userCount > 1): if(is_array($user)): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$u): $mod = ($i % 2 );++$i; if($u['mail'] != $_SESSION['user']): ?><tr class="data">
                                    <td class="laber"><input type="hidden" class="addUserInput"/></td>
                                    <td class="edit" colspan="2">
                                    <input class="ui-ipt-txt" type="text" value="<?php echo ($u["mail"]); ?>" disabled/>
                                    <a style="margin-left:6px;" href="javascript:void(0);" onclick="deleteUser(this,<?php echo ($u["client_id"]); ?>,<?php echo ($u["zone_id"]); ?>);">删除</a>
                                    </td>
                                </tr>
                               	<?php else: endif; endforeach; endif; else: echo "" ;endif; ?>
                    	<?php else: endif; ?>
				</tbody> 
				<thead>
					<tr id="tr_title">
						<th style="text-align:left;font-size:13px;color:#404040;">[功能设置]</th> 
                        <th colspan="2">
                        <div class="ui-pop-box small-con-box" id="gnsz_msg" style="float:left; margin-left:10px; display:none;width:auto;height:auto;margin-top:-4px;">
							<div style="position: relative;background-color: #fff;border: solid 1px #999; height:20px;line-height:20px; padding:2px 10px 2px 10px">这里是提示信息</div>
						</div>
                        </th>	
					</tr>
				</thead> 
				<tbody id="myData">
					<!--tr class="data">
					    <td class="laber">搜索引擎推送</td> 	
					    <td class="edit"><input class="ui-ipt-txt" type="text" placeholder=""></td>
					    <td class="info">暂时不提供改功能</td>  
					</tr-->
					<tr class="data">
					    <td class="laber">TTL默认值</td> 	
					    <td class="edit">
                            <input type="radio" name="ttl" value="1" id="ttl1" onClick="changeTTL(this)"/>1分钟
                            <input type="radio" name="ttl" value="5" id="ttl5" onClick="changeTTL(this)"/>5分钟
                            <input type="radio" name="ttl" value="10" id="ttl10" onClick="changeTTL(this)"/>10分钟
                            <input type="radio" name="ttl" value="30" id="ttl30" onClick="changeTTL(this)"/>30分钟
                            <input type="radio" name="ttl" value="60" id="ttl60" onClick="changeTTL(this)"/>60分钟
					    </td>
					    <td class="info">添加域名记录时的ttl默认值，最短1分钟，最长60分钟</td>  
					</tr>
					<tr class="data">
					    <td class="laber">套餐</td> 	
					    <td class="edit">
						    <?php if($zone[level] == 0){ ?> 免费套餐<a style="margin-left:10px;" href="javascript:">升级套餐</a>
						    <?php }else{ ?> 企业套餐，<?php echo ($level[end_time]); ?>到期，未开通自动续费<a style="margin-left:10px;" href="javascript:">套餐续费</a> <?php } ?>
					    </td>
					    <td class="info">选择企业套餐，享受VIP域名保障服务</td>
					</tr>
				</tbody> 
				<thead>
					<tr id="tr_title">
						<th style="text-align:left;font-size:13px;color:#404040;">[安全设置]</th>
                        <th colspan="2">
                        <div class="ui-pop-box small-con-box" id="aqsz_msg" style="float:left; margin-left:10px; display:none;width:auto;height:auto;margin-top:-4px;">
							<div style="position: relative;background-color: #fff;border: solid 1px #999; height:20px;line-height:20px; padding:2px 10px 2px 10px">这里是提示信息</div>
						</div>
                        </th>	
					</tr>
				</thead> 
				<tbody id="myData">
					<tr class="data">
					    <td class="laber">域名锁定</td> 	
					    <td class="edit">
						    <?php if($zone[is_lock] == 0){ ?> <label>域名未锁定</label><a style="margin-left:10px;" href="javascript:void(0);" onClick="zoneLock(this)">锁定</a> 
						    <?php }else{ ?><label>域名已锁定</label><a style="margin-left:10px;" href="javascript:void(0);" onClick="zoneLock(this)">解锁</a> <?php } ?>
					    </td>
					    <td class="info">域名锁定后，在加锁期间不接受用户的任何更改，保障您的解析服务！</td>
					</tr>
					<tr class="data">
					    <td class="laber">解析状态</td>
					    <td class="edit">
						    <?php if($zone[is_on] == 1){ ?> <label>启用</label><a style="margin-left:10px;" href="javascript:void(0);" onClick="startStopZone(this)">暂停</a> 
						    <?php }else{ ?> <label>暂停</label><a style="margin-left:10px;" href="javascript:void(0);" onClick="startStopZone(this)">启用</a> <?php } ?>
					    </td>
					    <td class="info">暂停域名解析，会暂停所有记录的解析服务！</td>  
					</tr>
					<tr class="data">
					    <td class="laber">操作日志</td> 	
					    <td class="edit"><a href="javascript:" onclick="showLog();">查看</a></td>
					    <td class="info">关注域名操作日志，保障域名正常服务</td>  
					</tr>
					<tr class="data">
					    <td class="laber">记录导出</td> 	
					    <td class="edit"><a href="javascript:">导出</a></td>
					    <td class="info">将所有记录导出为excel格式</td>  
					</tr>
					<tr class="data">
					    <td class="laber">自助诊断</td> 	
					    <td class="edit"><a href="javascript:">诊断</a></td>
					    <td class="info">对域名进行全方位诊断，保障域名正常服务</td>  
					</tr>
				</tbody> 
			</table>
		</div> 
		<!-- footer -->
		<style>
 #feedback {
   position:fixed;
   right:20px;
   /*top:92%;*/
   bottom: 14.5%;
   height:30px;
   width:100px;
   color:#fff;
   font-size:12px;
   line-height: 20px;
   background-color:#0066CB;
   border:1px solid #0099FF;
   text-align: center;
   z-index:16;
 }

 #feedback:hover {
   background-color: #0099FF;
 }

 #feedback a{
   line-height:30px;
   text-decoration:none;
   color:#fff;
 }

 .fix_bottom {
	position: absolute;
	bottom: 0;
	width: 100%;
 }
</style>

<div id="feedback" style="cursor:pointer;" onclick="location='tencent://message/?uin=1207197276';">
<a href="javascript:void(0);">客服咨询</a>
</div>
<div class="tc-page-foot">     
    <div class="foot_c1">
        <a href="http://www.eflypro.com/index.php/Aboutus/" target="_blank" class="link_gray">关于我们</a><!--span class="s">|</span>	      
        <a href="javascript:void(0);" target="_blank" class="link_gray">eflyDNS解析服务协议</a-->
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span class="ui-color-grey">Copyright © 2014 广东睿江科技有限公司 版权所有</span>	  
    </div>
</div>
	</div>
</body>
</html>
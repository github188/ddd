<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta content="" name="keywords">
	<meta content="" name="description">
	<title>EflyDNS - 域名解析</title>
    <link rel="shortcut icon" href="__ROOT__/Public/img/eflydns.ico" />
	<link rel="stylesheet" href="__ROOT__/Public/css/base.css" />
	<link rel="stylesheet" href="__ROOT__/Public/css/dns.css" />
	<link rel="stylesheet" href="__ROOT__/Public/css/jquery.autocomplete.css" />
	<link rel="stylesheet" href="__ROOT__/Public/css/artDialog.css">
	<script type="text/javascript" src="__ROOT__/Public/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="__ROOT__/Public/js/jquery.autocomplete.min.js"></script>
	<script type="text/javascript" src="__ROOT__/Public/js/layer/layer.min.js"></script> 
	<script type="text/javascript" src="__ROOT__/Public/js/util.js"></script>
	<script type="text/javascript" src="__ROOT__/Public/js/artDialog/jquery.artDialog.js"></script>
	<script type="text/javascript" >
	var mydata,tableObj;
	$(function(){		
		$('html').bind('click',function(e){
			if($("#opt_sel").is(":visible")){
				$("#opt_sel").slideToggle();
			}
			if($("#opt_group").is(":visible")){
				$("#opt_group").slideToggle();
			}
		});	
		
		$(".module_inner li a").removeClass("active");
		var strHref = window.location.href;
		var strname="";
		if (strHref.length > 0) {
			if(strHref.getQuery("g") != null){
				strname = strHref.getQuery("g");
				$(".module_inner li a").each(function(data){
					if($(this).attr('rel')==strname){
						$(this).addClass("active");
					}
				});
			}else{
				$(".module_inner li a:eq(0)").addClass("active");
			}
		}

		
		tableObj = $("#mydata .zoneRow");
		mydata=$("#mydata").html();
		
		hoverShowOpt();
		//添加
		$(".btn-extend").click(function(){
			$("#txtZone").val('');
			$("#warning_info").css('display','none');
			$(".J_extendAddBox").slideToggle("slow");
		});
		//返回单个添加
		$(".J_btnSwitchToSingle").click(function(){
			$(".J_boxSingle").show();
			$(".J_boxMultiple").hide();
		});
		//返回批量添加
		$(".J_btnSwitchToMultiple").click(function(){
			$(".J_boxSingle").hide();
			$(".J_boxMultiple").show();
		});
		$(".J_btnCloseExtendBox, .J_closeExtendBox").click(function(){
			$(".J_extendAddBox").slideToggle();
		});
		$(".J_cancleMultiplex, .J_closeMultiplexBox").click(function(){
			$(".J_domainMultiplexBox").slideToggle();
		});
		var g = $("#cur_group").val();
		$("#dgroup").val(g);
		
		//bindseach();
		
	});
	var stopPropagation = function(e) {
		if(e && e.stopPropagation){         //W3C取消冒泡事件         
			e.stopPropagation();     
		}else{         //IE取消冒泡事件         
			window.event.cancelBubble = true;     
		} 
	};
	/*function bindseach(){
		$.getJSON('__APP__/Domain/bindSearch',{'t':new Date().getTime()},function(data){			
			if(data.info=='success'){
				//绑定搜索框
				$('#searchTxt').autocomplete(data.data, {
					 max: 10,    //列表里的条目数
					 minChars: 0,    //自动完成激活之前填入的最小字符
					 width: 142,     //提示的宽度，溢出隐藏
					 scrollHeight: 300,   //提示的高度，溢出显示滚动条
					 matchContains: true,    //包含匹配，就是data参数里的数据，是否只要包含文本框里的数据就显示
					 autoFill: false,    //自动填充
					 matchContains: true, //否要在字符串内部查看匹配
					 mustMatch: false, //是否只会允许匹配的结果出现在输入框内
					 formatItem: function(row, i, max) {
						 return row.domain ;
					 },
					 formatMatch: function(row, i, max) {
						 return row.domain;
					 },
					 formatResult: function(row) {
						 return row.domain;
					 }
				}).result(function(event, row, formatted){
					$(tableObj).each(function(){
						if($(this).find('input').val()==row.domain){
							var desc = $(this).next().html(),
							tr = $(this).html(),
							cls = $(this).attr('class'),
							lv = $(this).attr('level');
							
							//绑定数据
							$("#mydata").empty();
							$("#mydata").html("<tr class='"+cls+"' level='"+lv+"'>"+tr+"</tr><tr style='display:none;'>"+desc+"</tr>");
							hoverShowOpt();
						}
					});
				});
			}
			
		});
	}*/
	function pageReload(type){
		if(type==0){
			var val = $("#searchTxt").val();
			if(val=="" || typeof(val)=='undefined'){
				//$("#mydata").empty();
				//$("#mydata").html(mydata);
				//hoverShowOpt();
				window.location.reload();
			}	
		}else{
			$("#searchTxt").val('');
			//$("#mydata").empty();
			//$("#mydata").html(mydata);
			//hoverShowOpt();
			window.location.reload();
		}
		
	}
	
	//移动显示操作
	function hoverShowOpt(){
		//先取消绑定
		$(".zoneRow").unbind('hover');
			
		var str=''; //保存表格原来的值
		$(".zoneRow").hover(function(){
			str = $($(this).find('.remark')).html();
			if($(this).attr("level") == 0){
				$($(this).find('.remark')).html("<a href='javascript:void(0);'>升级套餐</a>");
			}else{
				$($(this).find('.remark')).html("<a href='javascript:void(0);'>续费(3个月后到期)</a>");
			}
			//$($(this).find(".icon-add")).show();
			$($(this).find(".icon-manage")).show();
			//$($(this).find(".icon-copy")).show();
		},function(){
			$($(this).find(".remark")).html(str);
			//$($(this).find(".icon-add")).hide();
			$($(this).find(".icon-manage")).hide();
			//$($(this).find(".icon-copy")).hide();
		});
		
	}
	//添加备注
	function addDesc(obj,domain){
		if(selZoneLock(domain)){
			var desc;
			/*$.ajax({
				url: '__APP__/Domain/findZoneDesc',
				type: "post",
				data:{'domain':domain},
				async:false,
				success: function (data) {
					if(data.info=='success'){
						desc = data.data[0].desc;
					}else{
						messageBox('message',data.info);
					}
				},
				error: function (data) {
					messageBox('message',data.statusText);
				}
			});*/
			var trnext=$(obj).parent().parent().next();
			desc = $(trnext).find('textarea').val();
			$(obj).parent().parent().next().find('.btm b').html(200-desc.length);
			//绑定描述
			trnext.show();
			$(obj).parent().parent().addClass("row-opened");
		}else{
			messageBox('message','该域名被锁定，不能执行该操作');
		}
	}
	//保存备注
	function saveDomain(obj){		
		var val = $(obj).parent().parent().find('textarea').val(),
		domain = $(obj).parent().parent().parent().parent().parent().parent().prev().find('.domain_id').html();
		$.ajax({
			url:'__APP__/Domain/addZoneDesc',
			type:'post',
			data:{'domain':domain,'desc':val},
			success:function (data){
				if(data.info!='success'){
					messageBox('message','修改备注失败，请联系管理员');
				}
				cancelDomain(obj);
			},
			error:function (data){
				messageBox('message',data.statusText);
			}
		});
	}
	//取消编辑备注
	function cancelDomain(obj){
		$(obj).parent().parent().parent().parent().parent().parent().hide();
		$(obj).parent().parent().parent().parent().parent().parent().prev().removeClass("row-opened");
	}
	//添加域名
	function addZone(){
		var val = $("#txtZone").val().toLowerCase(),mess;
		if(val=='' || val.length==0){
			$("#txtZone").focus();
			//不能为空的提示
			$("#warning_info").css('display','').css('color','#f51d00')
			.css('background','url(__ROOT__/Public/img/warning.gif) 50px 12px no-repeat;')
			.html('请填写您的域名后，点击添加按钮，就能将域名添加到下面列表中开始解析。');
			return ;
		}
		//检查是否为域名
		if(!checkDomain(val)){
			$("#txtZone").focus();
			//域名格式的提示
			$("#warning_info").css('display','').css('color','#f51d00')
			.css('background','url(__ROOT__/Public/img/warning.gif) 50px 12px no-repeat;')
			.html('域名格式不正确，请填写正确的域名。');
			return ;
		}
		$.ajax({
			url: '__APP__/Domain/checkZone',
			type: "post",
			data:{'zone':val},
			async:false,
			success: function (data) {
				if(data.info=='error'){
					//域名存在的提示
					$("#warning_info").css('display','').css('color','#f51d00')
					.css('background','url(__ROOT__/Public/img/warning.gif) 50px 12px no-repeat;')
					.html(data.data);
					return;	
				}else{
					if($("#null_zone").html()){
						$("#null_zone").empty();
					}
					$.ajax({
						url: '__APP__/Domain/addZone',
						type: "post",
						async:false,
						data:{'zone':val},
						success: function (data) {
							//alert(data.info);return false;
							if(data.status == 1){
								prependRow(val);
								//隐藏添加div
								$(".J_extendAddBox").slideToggle();
								
								//tableObj = $("#mydata .zoneRow");		
								//mydata=$("#mydata").html();
								//bindseach();
								messageBox('message','域名添加成功！');
							}else{
								messageBox('message','域名添加失败：' + data.info);
							}
						},
						error: function (data) {
							messageBox('message',data.statusText);
						}
					});	
				}
			},
			error: function (data) {
				messageBox('message',data.statusText);
			}
		});
	}
	//全选、取消全选
	function checkAll(obj){
		$('#mydata :checkbox').each(function(){
			this.checked = obj.checked;
		});
	}
	//添加,取消标记
	function markStar(obj,domain){
		if(selZoneLock(domain)){
			var cls = $(obj).attr('class'),val;
			if(cls=='icon-star'){
				val = 1;
			}else{
				val = 0;
			}
			$.ajax({
				url:'__APP__/Domain/maskStar',
				type:'post',
				data:{'is_star':val,'domain':domain},
				success:function(data){
					if(data.info=='success'){
						if($(obj).attr('class')=='icon-star'){
							$(obj).attr('class','icon-star-on');
						}else{
							$(obj).attr('class','icon-star');
						}
					}else{
						messageBox('message','添加标记失败，请联系管理员');
					}
				},
				error:function(data){
					messageBox('message',data.statusText);
				}
			});
		}else{
			messageBox('message','该域名被锁定，不能执行该操作');	
		}
	}
	//字数限制
	function wordsLimit(obj){
		$(obj).next().find('b').html(200-$(obj).val().length);
	}
	//清除批量添加提示
	function clearInfo(obj){
		if($(obj).val().length==0){
			$(obj).next().find('div').html('例如， <br>eflydns.com，eflydns.net，eflydns.cn');
		}else{
			$(obj).next().find('div').html('');
		}
	}
	//批量添加域名
	function batchAddDomain(obj){
		//添加去掉暂无信息的提示
		if($("#null_zone").html()){
			$("#null_zone").empty();
		}
		var textarea = $(obj).parent().prev().find('textarea'),arr,tem,is_ok=true,text="";
		if($(textarea).val().substring($(textarea).val().length-1,$(textarea).val().length)==','){
			text = $(textarea).val().substring(0,$(textarea).val().length-1);
		}else{
			text = $(textarea).val();
		}		
		arr = text.toLowerCase().split(',');
		var s = arr.join(",");
		
		for(var i=0;i<arr.length;i++){
			if(s.replace(arr[i],"").indexOf(arr[i])>-1) {
				$(textarea).focus();
					//格式错误的提示
				$("#warning_info").css('display','').css('color','#f51d00')
				.css('background','url(__ROOT__/Public/img/warning.gif) 50px 12px no-repeat;')
				.html('['+arr[i]+']域名重复，请不要输入重复的域名。');
				is_ok=false;
			}
			if(arr[i]!=''){
				if(!checkDomain(arr[i])){
					$(textarea).focus();
					//格式错误的提示
					$("#warning_info").css('display','').css('color','#f51d00')
					.css('background','url(__ROOT__/Public/img/warning.gif) 50px 12px no-repeat;')
					.html('域名['+arr[i]+']格式不正确，请填写正确的域名。');
					is_ok=false;
				}else{
					$.ajax({
						url: '__APP__/Domain/checkZone',
						type: "post",
						data:{'zone':arr[i]},
						async:false,
						success: function (data) {
							if(data.info=='error'){
								$(textarea).focus();
								//域名存在的提示
								$("#warning_info").css('display','').css('color','#f51d00')
								.css('background','url(__ROOT__/Public/img/warning.gif) 50px 12px no-repeat;')
								.html('域名['+arr[i]+']已存在于解析列表中，无需再次添加。点击解析列表中的域名即可开始解析。');
								is_ok=false;
							}
						},
						error:function(data){
							messageBox('message',data.statusText);
						}
					});
				}
			}
		}
		if(is_ok){
			//批量添加
			$.ajax({
				url:'__APP__/Domain/batckAddZone',
				type:'post',
				async:false,
				data:{'str':$(textarea).val().toLowerCase()},
				success:function(data){
					if(data.info=='success'){
						for(var i=0;i<data.data.length;i++){
							prependRow(data.data[i].domain);
						}
						//tableObj = $("#mydata .zoneRow");		
						//mydata=$("#mydata").html();
						//bindseach();
					}
					//隐藏添加div
					$(".J_extendAddBox").slideToggle();
					//alert(data.data);
				},
				error:function(data){
					messageBox('message',data.statusText);
				}
			});
		}
		
	}
	function prependRow(domain){		
		$("#mydata").prepend('<tr class="zoneRow" level="0"><td class="chk"><input type="checkbox" class="J_chkForMe" value="'+domain+'"></td><td class="domain"><p class="icon-no-vip">&nbsp;<a href="javascript:void(0);" class="icon" title="EflyDNS，享受域名保障服务"></a><a class="domain_id ui-color-red" href="__APP__/Domain/detail?d='+ domain +'">'+ domain +'</a></p></td><td class="msg"><p><a class="" href="__APP__/Domain/detail?d='+domain+'">还没有解析记录？快点击这里添加解析记录吧！</a></p></td><td class="remark"><p><a href="javascript:void(0);"></a></p></td><td class="iop"><a class="icon-star" title="加星标记，方便下次查看哦！" href="javascript:void(0);" onClick="markStar(this,\''+domain+'\')"></a> <a class="icon-add" title="添加备注" href="javascript:void(0);" onClick="addDesc(this,\''+ domain +'\')"></a> <a class="icon-copy" title="添加别名" href="javascript:void(0);" onClick="addBiem(\''+ domain +'\')"></a></td></tr><tr style="display:none;"><td colspan="5" class="expand-outer fix"><div style="position: relative;"><div class="patch-left"></div><div class="patch-right"></div><div class="expand-box"><b class="expand-box-arr">◆<b class="expand-box-arr-in">◆</b></b><div class="remark-box fix J_remarkBox"><label class="lbl">备注：</label><textarea class="ui-textarea J_remarkTextarea" rows="3" maxlength="200" onKeyUp="wordsLimit(this)"></textarea> <div class="btm"><span class="info J_countInfo">最多还可写<b>200</b>个字</span><button class="ui-btn-blue btn-add J_btnSubmitRemark" onClick="saveDomain(this)">保存</button><button class="ui-btn-grey btn-cancle J_btnCancleRemark" onClick="cancelDomain(this)">取消</button></div></div></div></div></td></tr>');
		hoverShowOpt();
	}
	//域名添加别名
	function addBiem(domain){
		if(selZoneLock(domain)){
			$.ajax({
				url:'__APP__/Domain/lookBiem',
				type:'post',
				data:{ 'domain': domain },
				async:false,
				success:function(data){
					if(data.info=='success'){
						$('#bm_list').empty();
						for(var i=0;i<data.data.length;i++){
							$('#bm_list').append('<div style="padding:5px 50px; display:block;"><span class="lbl">已有别名：</span> <input class="addedbm ui-ipt-txt" value="'+data.data[i].name+'"> <a href="javascript:void(0);" onclick="cancelBrow(this);">删除</a></div>');
						}
						//$('.J_domainRecordList').html(tr);
					}
				},
				error:function(data){
					messageBox('message',data.statusText);
				}
			});
			$("#id_bm").html(domain);
			if($(".J_domainMultiplexBox").is(":hidden")){
				$(".J_domainMultiplexBox").slideToggle();
			}
		}else{
			messageBox('message','该域名被锁定，不能执行该操作');	
		}
	}
	function DoAddBiem(evt){
		var str = "",is_ok=true,zone=$("#id_bm").html();
		$(".addbm").each(function(){				
			str += $(this).val() + ",";
		});		
		if(str.substring(str.length-1,str.length)==','){
			str = str.substring(0,str.length-1);
		}
		var arr = str.split(',');
		var s = arr.join(","); 
		for(var i=0;i<arr.length;i++) {
			if(arr[i]=="" || typeof(arr[i])=='undefined'){
				$("#bm_error").css('color','red').html('别名不能为空，请重新输入。');
				is_ok=false;
				break;
			}
			if(!checkDomain(arr[i])){
				$("#bm_error").css('color','red').html('您输入的['+arr[i]+']不符合域名格式，请重新输入。');
				is_ok=false;
				break;
			}
			if(s.replace(arr[i],"").indexOf(arr[i])>-1) { 
				$("#bm_error").css('color','red').html('您输入的['+arr[i]+']别名重复，请重新输入。');
				is_ok=false;
				break;
			}
			$.ajax({
				url:'__APP__/Domain/checkBiem',
				type:'post',
				data:{'name':arr[i]},
				async:false,
				success:function(data){
					if(data.info!='success'){
						is_ok=false;
						$("#bm_error").css('color','red').html('您输入的['+data.data[0].name+']别名已存在，请重新输入。');
					}
				},
				error:function(data){
					messageBox('message',data.statusText);
				}
			});			
		}
		if(is_ok){
			$.ajax({
				url:'__APP__/Domain/addBiem',
				type:'post',
				data:{'name':str,'zone':zone},
				success:function(data){
					if(data.info=='success'){
						$(".J_domainMultiplexBox").slideToggle();
						$(".addbm").each(function(i,evt){				
							$(this).val('');
							if($(".addbm").length!=1){
								if(i==$(".addbm").length-1){
									$(this).parent().remove();
								}
							}
						});
					}else{
						messageBox('message',data.info)
					}
				},error:function(data){
					messageBox('message',data.statusText);
				}
			});
		}
	}
	function addBrow(evt){
		var addnum = $(".addbm").length,addednum = $(".addedbm").length;
		if(addnum+addednum>=5){
			messageBox('message',"一次不能添加超过5个别名");
			return false;
		}
		var str = '<div style="padding:5px 50px; display:block;"><span class="lbl">输入别名：</span> <input class="addbm ui-ipt-txt" placeholder="例如：eflydns.net"> <a href="javascript:void(0);" onclick="cancelBrow(this);">取消</a></div>';
		$(evt).parent().after(str);
	}
	function cancelBrow(evt){
		if($(evt).html()=='删除'){
			if(confirm('确认删除别名？')){
				$.ajax({
					url:'__APP__/Domain/deleteBiem'	,
					type:'post',
					data:{'name':$(evt).prev().val()},
					success:function(data){
						if(data.info=='success'){
							$(evt).parent().remove();
						}else{
							messageBox('message',data.info);
						}
					},error:function(data){
						messageBox('message',statusText);
					}
				});
			}
		}else{
			$(evt).parent().remove();	
		}
	}
	function editTable(d){
		$.layer({
			type: 2,
			title: '域名配置：'+d,
			iframe: { src : '__APP__/Domain/domainSet?d='+d},
			area: ['800px' , '560px'],
			offset: ['100px','']
		});
	}
	
	function readoptlog(){
		var chked = $('#mydata :checked');
		if(chked.length==0){
			messageBox('message','请先在列表中选择一个域名');
			return false;
		}
		if(chked.length != 1){
			messageBox('message','一次只能查看一个域名的操作日志');
			return false;
		}
		var domain = chked[0].value
		window.open("__APP__/Optlog/index?d="+domain);
	}
	
	function selectGroup(evt){
		var group = $(evt).val();
		window.location.href = "__APP__/Domain/domainList?g="+group;
	}
	function optSelect(e){
		if($("#opt_group").is(":visible")){
			$("#opt_group").slideToggle();
		}
		$("#opt_sel").slideToggle();
		stopPropagation(e);
		return false;
	}
	function optGroup(e){
		if($("#opt_sel").is(":visible")){
			$("#opt_sel").slideToggle();
		}
		$("#opt_group").slideToggle();
		stopPropagation(e);
		return false;
	}
	//删除域名
	function deleteDomain(){
		var chked = $('#mydata :checked'),domain="", htm=$('#mydata').html();
		if(chked.length==0){
			messageBox('message','请先在列表中选择域名');
		}else{
			if(confirm('删除域名会删除域名下面的解析记录，确定删除选中的域名吗？')){
				for(var i=0;i<chked.length;i++){
					if(i!=chked.length-1){
						domain += chked[i].value + ',';
					}else{
						domain += chked[i].value;
					}
				}
				var rtnval = batchSelZoneLock(domain);
				if(rtnval!='success'){
					messageBox('message',rtnval);
				}else{
					$.ajax({
						url:'__APP__/Domain/deleteZone',
						type:'post',
						async:false,
						data:{'domain':domain},
						success:function (data){
							if(data.info=='success'){
								for(var i=0;i<chked.length;i++){
									//域名备注
									$(chked[i]).parent().parent().next().empty();
									//域名信息
									$(chked[i]).parent().parent().empty();
								}
								//tableObj = $("#mydata .zoneRow");		
								//mydata=$("#mydata").html();
								//bindseach();
								if(typeof($('#mydata .zoneRow .domain').html())=='undefined'){
									$("#null_zone").html('<td colspan="5"><span class="ui-sorry">暂无域名记录~</span></td>');
								}
							}else{
								messageBox('message',data.info);
							}
						},
						error:function (data){
							messageBox('message',data.statusText);
						}
					});
				}
			}
		}
	}
	function stopDomain(){
		var chked = $('#mydata :checked'),domain="", htm=$('#mydata').html();
		if(chked.length==0){
			messageBox('message','请先在列表中选择域名');
		}else{
			if(confirm('确定停用选中的域名？')){
				for(var i=0;i<chked.length;i++){
					if(i!=chked.length-1){
						domain += chked[i].value + ',';
					}else{
						domain += chked[i].value;
					}
				}
				var rtnval = batchSelZoneLock(domain);
				if(rtnval!='success'){
					messageBox('message',rtnval);
				}else{
					$.ajax({
						url:'__APP__/Domain/stopZone',
						type:'post',
						async:false,
						data:{'domain':domain},
						success:function (data){
							if(data.info=='success'){
								for(var i=0;i<chked.length;i++){
									//修改域名前面的图标样式
									$(chked[i]).parent().parent().find('td :eq(1) p').attr('class','icon-stop');
									$(chked[i]).parent().parent().find('td :eq(1) p a :eq(0)').attr('title','该域名已暂停解析');
								}
							}else{
								messageBox('message',data.info);
							}
						},
						error:function (data){
							messageBox('message',data.statusText);
						}
					});
				}
			}
		}
	}
	function startDomain(){
		var chked = $('#mydata :checked'),domain="", htm=$('#mydata').html();
		if(chked.length==0){
			messageBox('message','请先在列表中选择域名');
		}else{
			for(var i=0;i<chked.length;i++){
				if(i!=chked.length-1){
					domain += chked[i].value + ',';
				}else{
					domain += chked[i].value;
				}
			}
			var rtnval = batchSelZoneLock(domain);
				if(rtnval!='success'){
					messageBox('message',rtnval);
			}else{
				$.ajax({
					url:'__APP__/Domain/startZone',
					type:'post',
					async:false,
					data:{'domain':domain},
					success:function (data){
						if(data.info=='success'){
							if(data.data!=null){
								for(var i=0;i<chked.length;i++){								
									for(var j=0;j<data.data.length;j++){
										if(chked[i].value==data.data[j]['domain']){
											if(data.data[j]['level']==0){
												//修改域名前面的图标样式
												$(chked[i]).parent().parent().find('td :eq(1) p').attr('class','icon-no-vip');
												$(chked[i]).parent().parent().find('td :eq(1) p a :eq(0)').attr('title','升级套餐，享受域名保障服务');
											}else{
												$(chked[i]).parent().parent().find('td :eq(1) p').attr('class','icon-vip');
												$(chked[i]).parent().parent().find('td :eq(1) p a :eq(0)').attr('title','VIP域名，享受域名保障服务');	
											}
										}
										
									}
								}
							}
						}else{
							messageBox('message',data.info);
						}
					},
					error:function (data){
						messageBox('message',data.statusText);
					}
				});		
			}	
		}
	}
	function selZoneLock(zone){
		var is_lock=true;
		$.ajax({
			url:'__APP__/Domain/selZoneLock',
			type:'post',
			async:false,
			data:{'zone':zone,'t':new Date().getTime()},
			success:function(data){
				if(data.info=='success'){
					if(data.data[0]['is_lock']==1){
						is_lock=false;
					}
				}else{
					messageBox('message',data.info);
				}
			},
			error:function(data){
				messageBox('message',data.statusText);
			}
		});
		return is_lock;
	}
	function batchSelZoneLock(zone){
		var is_lock='success';
		$.ajax({
			url:'__APP__/Domain/batchSelZoneLock',
			type:'post',
			async:false,
			data:{'zone':zone,'t':new Date().getTime()},
			success:function(data){
				if(data.info=='success'){
					is_lock = data.data;
				}else{
					messageBox('message',data.info);
				}
			},
			error:function(data){
				messageBox('message',data.statusText);
			}
		});
		return is_lock;
	}
	function addGroup(){
		$.layer({
			type: 1,
			title: '新建分组',
			area: ['450px', '160px'],
			offset: ['220px' , ''],
			btns: 2,
			btn: ['确定', '取消'],
			page: {
				html: '<div style="margin-top:20px;margin-left:80px;"><strong style="color:#666;font-size:14px;">分组名称：</strong><input style="border: 1px solid #ddd;width: 200px;height: 26px;font-size: 14px;color: #666;padding-left:5px;" id="gruop_name" maxlength="4" /><strong style="color:red;font-size:16px; margin-left:5px;">*</strong><label style="color:#666">4个字符限制</label><br/><br/><font id="addGroup_msg" style="color:red;margin-left:70px;"></font></div>'
			},
			yes: function(index){
				$.ajax({
					url:'__APP__/Domain/addGroup',
					type:'post',
					async:false,
					data:{'name':$("#gruop_name").val()},
					success:function(data){
						if(data.info=='error'){
							$("#addGroup_msg").html(data.data);	
						}else{
							messageBox('message','域名分组添加成功');
							layer.close(index);
						}
					},
					error:function(data){
						messageBox('message',data.statusText);
					}
				});
			}
		});
	}
	function groupBy(val){
		var chked = $('#mydata :checked'),domain="";
		if(chked.length==0){
			messageBox('message','请先在列表中选择域名');
		}else{
			//if(confirm('确定移动选中的域名吗？')){
				for(var i=0;i<chked.length;i++){
					if(i!=chked.length-1){
						domain += chked[i].value + ',';
					}else{
						domain += chked[i].value;
					}
				}
				//var rtnval = batchSelZoneLock(domain);
				//if(rtnval!='success'){
				//	messageBox('message',rtnval);
				//}else{
					$.ajax({
						url:'__APP__/Domain/groupBy',
						type:'post',
						data:{'name':val,'zone':domain},
						success:function(data){
							messageBox('message','域名已移动到['+val+']分组');
						},
						error:function(data){
							messageBox('message',data.statusText);
						}
					});
				//}
				
			//}
		}
	}
	function selectBy(obj){
		var val = $(obj).prev().val(),str="";
		if(val){
			$.ajax({
				url:'__APP__/Domain/selectZone',
				type:'post',
				async:false,
				data:{'val':val},
				success:function(data){
					if(data.info=='success'){
						$("#mydata").empty();
						for(var i=0;i<data.data.length;i++){
							str += zoneRows(data.data[i].level,data.data[i].domain,data.data[i].is_on,data.data[i].count,data.data[i].is_author,data.data[i].is_star,data.data[i].zone_name,data.data[i].desc);		
							str += bindZoneDesc(data.data[i].desc);
						}
						
						$("#mydata").html(str);
					}
				},
				error:function(data){
					messageBox('message','排序失败，错误代码：'+data.statusText);
				}
			});
		}else{
			messageBox('message','请输入主机记录（支持模糊查询）');
			//pageReload(0);
		}
	}
	function zoneRows(level,domain,is_on,count,is_author,is_star,zone_name,desc){
		var str = '<tr class="zoneRow" level="'+level+'"><td class="chk"><input type="checkbox" class="J_chkForMe" value="'+domain+'"></td><td class="domain">';
		if(is_on==0){
			str += '<p class="icon-stop"><a href="javascript:void(0);" class="icon" title="该域名已暂停解析"></a>';	
			if(is_author==0){
				str += '<a href="__APP__/Domain/detail?d='+domain+'" class="domain_id ui-color-red" title="'+desc+'">'+domain+'</a></p>';
			}else{
				str += '<a href="__APP__/Domain/detail?d='+domain+'" class="domain_id" title="'+desc+'">'+domain+'</a></p>';
			}
		}else{
			if(level==0){
				str += '<p class="icon-no-vip"><a href="javascript:void(0);" class="icon" title="升级套餐，享受域名保障服务"></a>';
				if(is_author==0){
					str += '<a href="__APP__/Domain/detail?d='+domain+'" class="domain_id ui-color-red" title="'+desc+'">'+domain+'</a></p>'	
				}else{
					str += '<a href="__APP__/Domain/detail?d='+domain+'" class="domain_id" title="'+desc+'">'+domain+'</a></p>';
				}
			}else{
				str += '<p class="icon-vip"><a href="javascript:void(0);" class="icon" title="VIP域名，享受域名保障服务"></a>';
				if(is_author==0){
					str += '<a href="__APP__/Domain/detail?d='+domain+'" class="domain_id ui-color-red" title="'+desc+'">'+domain+'</a></p>';
				}else{
					str += '<a href="__APP__/Domain/detail?d='+domain+'" class="domain_id" title="'+desc+'">'+domain+'</a></p>';
				}
			}
		}
		str += '</td><td class="msg">';
		if(count==0){
			str += '<p><a class="" href="__APP__/Domain/detail?d='+domain+'">还没有解析记录？快点击这里添加解析记录吧！</a></p>' ;
		}else{
			if(is_author==0){
				str += '<p><a class="ui-color-red" target="_blank" href="http://www.eflydns.com/index/Help/tools?domain='+domain+'">域名尚未修改DNS(点击诊断)。</a></p>';
			}
		}
		str += '</td><td class="remark">';
		if(count!=0){
			str += '<p>已有<span class="J_rrCount">'+count+'</span>条解析记录</p>'
		}
		str += '</td><td class="iop" style="width:130px;">';
		if(is_star==0){
			str += '<a class="icon-star" title="加星标记，方便下次查看哦！" href="javascript:void(0);" onClick="markStar(this,\''+domain+'\')"></a>';
		}else{
			str += '<a class="icon-star-on" title="已标记，点击取消标记" href="javascript:void(0);" onClick="markStar(this,\''+domain+'\')"></a>';	
		}
		if(desc==""){
			str += '<a class="icon-add" title="添加备注" href="javascript:void(0);" onClick="addDesc(this,\''+domain+'\')"></a>'	;
		}else{
			str += '<a class="icon-add-on" title="添加备注" href="javascript:void(0);" onClick="addDesc(this,\''+domain+'\')"></a>'	;
		}
		if(count!=0){
			if(zone_name==0){
				str += '<a class="icon-copy" title="添加别名" href="javascript:void(0);" onClick="addBiem(\''+domain+'\')"></a></td></tr>';
			}else{
				str += '<a class="icon-copy-on" title="添加别名" href="javascript:void(0);" onClick="addBiem(\''+domain+'\')"></a></td></tr>';
			}
		}
		return str;
	}
	function refreshStatus(){
		var d = new Date(new Date().getTime());
		nowtime = (d.getHours()<10 ? "0" + d.getHours():d.getHours())+""+(d.getMinutes()<10 ? "0" + d.getMinutes():d.getMinutes());
		//
		if($("#refresh_time").val()!="" && parseInt(nowtime) - parseInt($("#refresh_time").val())<3){
			messageBox('message','刷新太过频繁，请在三分钟后重试。');
			return false;
		}
		
		var loading = $.layer({
			type: 1,
			closeBtn: [0, false],
			title: false,
			shift: 'left', //从左动画弹出
			page: {
				html: '<img style="margin:20px 0px 0px 100px;" src="__ROOT__/Public/img/loading.gif" />'
			}
		});
		setInterval(function (){layer.close(loading);},3000);
		
		$.ajax({
			url:'__APP__/Domain/refreshStatus',
			type:'post',
			success:function(data){
				if(data.info=='success'){
					$("#refresh_time").val(nowtime);
				}
			},
			error:function(data){
				messageBox('message','刷新失败，错误代码：'+data.statusText);
			}
		});
		
	}
	</script>
</head>
<body style="">
	<input type="hidden" id="cur_group" value="<?php echo ($group); ?>"/>
    <input type="hidden" id="refresh_time" value=""/>
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

		<div class="head-info">
			<div class="head-path"> 	
				<a class="home" href="javascript:void(0);"></a>
				<span class="s"></span><strong class="current">域名列表</strong>
			</div>
		</div> 
		<div class="page-wrap J_domainMultiplexBox" style="display:none">
			<div class="box-multiplex J_conMultiplex"> 	
				<a class="ui-bubble-close J_closeMultiplexBox" href="javascript:void(0);">close</a>	
				<p style="padding: 25px 50px 0px 40px;"><span class="ui-color-red font-simsun">*&nbsp;</span>别名绑定可以使您在一个域名里管理记录完全相同的多个域名，免除您对多域名相同记录的重复操作。什么情况下会用到别名绑定？</p> 
				<p style="padding: 10px 50px 0px 50px;line-height: 20px;">例如： eflydns.com 和 eflydns.net 需要完全相同的解析记录，如果分别在两个域名内添加、修改记录会很麻烦。这个时候就可以使用别名绑定功能，将 eflydns.net 绑定到 eflydns.com 上，这样2个不同的域名就有了相同的记录，如果需要做什么更改，只需要在独立域名 eflydns.com 中修改一次即可。</p>
				<p class="hd">您已选择域名<b id="id_bm"></b>进行别名绑定。绑定后，每个别名都会保持与其相同的解析记录。</p>
				<p id="bm_list">
				<p style="padding: 0px 50px 0px 50px;" id="bm_error"></p>
					<div style="padding:5px 50px; display:block;">
						<span class="lbl">输入别名：</span>
						<input class="addbm ui-ipt-txt" placeholder="例如：eflydns.net">
						<a href="javascript:void(0);" onclick="addBrow(this);">添加下一个</a>
					</div>
				</p>
				<div class="op">
					<button class="ui-btn-blue btn-batch-remove J_submitMultiplex" onClick="DoAddBiem(this);">提交</button>
					<button class="ui-btn-grey btn-batch-remove J_cancleMultiplex">取 消</button>
				</div>
			</div>
		</div>
		
		<div class="table-toolbar J_tblToolbar"> 	
			<!--a class="icon icon-log" href="javascript:" onclick="readoptlog();">查看域名操作日志</a--> 
		</div> 
        <div style="width:942px;margin:0 auto;">        	
        	<div style="float:left;width:150px;">
            	<div class="filter module" id="filter">          
                	<div class="module_inner">
            			<ul>
                            <li><a class="active" href="__APP__/Domain/domainList?g=all" rel="all">全部域名</a></li>
                            <li><a href="__APP__/Domain/domainList?g=recent" rel="recent">最近域名</a></li>
                            <li><a href="__APP__/Domain/domainList?g=star" rel="star">加星域名</a></li>
                            <li><a href="__APP__/Domain/domainList?g=vip" rel="vip">VIP域名</a></li>
                            <li><a href="__APP__/Domain/domainList?g=error" rel="error">错误域名</a></li>
                			<?php if(is_array($grouplist)): $i = 0; $__LIST__ = $grouplist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$g_vo): $mod = ($i % 2 );++$i;?><li><a href="__APP__/Domain/domainList?g=<?php echo ($g_vo["id"]); ?>" rel="<?php echo ($g_vo["id"]); ?>"><?php echo ($g_vo["group"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                        <!--ul class="toolbox">
                            <li class="edit">修改</li>
                            <li class="del">删除</li>
                        </ul-->
                      </div>
				</div>
            </div>
            <div style="float:right;margin-bottom: 100px;">
                <div id="box-add-domain" class="box-add-domain" style="margin-left:10px;">
                <div class="hd fix"> 	
                    <a class="btn-extend" href="javascript:void(0);" style="display: inline;">添加域名</a> 	
                    <h2 class="txt-start-domain">解析，从添加域名开始</h2>
                    <!-- 信息提示 -->
                    <div class="ui-pop-box small-con-box" id="message" style="float:left; margin:8px 0px 0px 40px; display:none; width:auto;height:auto;">
                        <div style="position: relative;background-color: #fff;border: solid 1px #999; height:20px;line-height:20px; padding:2px 10px 2px 10px">这里是提示信息</div>
                    </div>
                </div> 
                <div class="bd ui-bubble J_extendAddBox" style="display:none;"> 	
                    <b class="ui-bubble-arr box-outer-arr">◆<b class="ui-bubble-arr-in">◆</b></b> 	
                    <a class="ui-bubble-close J_closeExtendBox" href="javascript:void(0);">close</a> 	
                    <div class="cont"> 		
                        <div class="single J_boxSingle">
                            <div class="ui-field-row">
                                <input class="ui-ipt-txt ipt-domain J_iptDomainSingle" placeholder="例如，eflydns.com" submit-with=".J_btnSubmitAddSingle" type="text" id="txtZone"/>
                            </div> 			
                            <div class="ui-field-row">
                                <button class="ui-btn-red btn-add J_btnSubmitAddSingle" onClick="addZone()">添 加</button><button class="ui-btn-grey btn-cancle J_btnCloseExtendBox">取 消</button>
                                <!--a class="add-batch J_btnSwitchToMultiple" href="javascript:void(0);">[批量添加域名]</a-->
                            </div>
                        </div> 		
                        <!-- 批量添加域名 -->
                        <div class="multiple J_boxMultiple">
                            <div class="ui-field-row">
                                <label class="lbl">批量添加域名</label><br>
                                <textarea id="txt_iptDomainMultiple" style="height:120px;" class="ui-textarea ipt-domain J_iptDomainMultiple" rows="6"  onKeyUp="clearInfo(this)"></textarea>
                                <label style="position:relative; display:block;" for="txt_iptDomainMultiple">
                                    <div style="position: absolute; cursor:text; margin: -120px 0 0 5px;color: #999;">
                                        例如， <br>eflydns.com，eflydns.net，eflydns.cn
                                    </div>	
                                </label>
                                <p class="desc">每个域名都以逗号隔开，每次最多添加100个域名</p>
                            </div>
                            <div class="ui-field-row">
                                <button class="ui-btn-red btn-add J_btnSubmitAddMultiple" onClick="batchAddDomain(this)">添 加</button>
                                <button class="ui-btn-grey btn-cancle J_btnCloseExtendBox">取 消</button>
                                <a class="add-batch J_btnSwitchToSingle" href="javascript:void(0);">[返回添加单个域名模式]</a>
                            </div>
                        </div>
                        <p class="ui-warning J_warning" style="display:none;" id="warning_info"></p>
                    </div> 
                </div>
            </div> 
            <div class="table-box" style="width:737px;float:right; margin:0; margin-left:10px;">
                <table class="ui-table" cellpadding="0" cellspacing="0" width="100%"> 	
                    <thead><tr> 
                        <th class="chk"><input type="checkbox" class="J_chkForAll" onClick="checkAll(this)" title="全选/取消全选"></th> 		
                        <th colspan="4">
                            <div class="lf"> 
                                <!--select id="dgroup" onchange="selectGroup(this);" class="ui-select">
                                    <option value="all">全部域名</option>
                                    <option selected value="recent">最近域名</option>
                                    <option value="star">加星域名</option> 
                                    <option value="vip">VIP域名</option>
                                    <option value="error">错误域名</option>
                                    <?php if(is_array($grouplist)): $i = 0; $__LIST__ = $grouplist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$g_vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($g_vo["id"]); ?>"><?php echo ($g_vo["group"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select-->
                                <!--button class="ui-btn-grey btn-batch-log">导出解析记录</button-->                                
                                
                                <a href="javascript:void(0)" onClick="refreshStatus()" title="刷新" class="refresh"></a>
                                <button class="ui-btn-grey btn-batch-log">添加到域名监控</button>
                                <button class="ui-btn-grey btn-batch-remove" style=" position:relative" id="group_btn" onClick="optGroup(event)">分组
                                    <span class="caret"></span>
                                </button> 
                                <ul class="dropdown-menu" style="margin-left:144px;width:126px;" id="opt_group">
                                    <li><a href="javascript:" onClick="groupBy('经常修改')">移动到<font>经常修改</font></a></li>
                                    <li><a href="javascript:" onClick="groupBy('很少修改')">移动到<font>很少修改</font></a></li>
                                    <li><a href="javascript:" onClick="groupBy('即将到期')">移动到<font>即将到期</font></a></li>
                                    <li><a href="javascript:" onClick="groupBy('公司域名')">移动到<font>公司域名</font></a></li>
                                    <li><a href="javascript:" onClick="groupBy('客户域名')">移动到<font>客户域名</font></a></li>
                                    <?php if(is_array($grouplist)): $i = 0; $__LIST__ = $grouplist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$g_vo): $mod = ($i % 2 );++$i; if(($g_vo['group'] == '经常修改') OR ($g_vo['group'] == '很少修改') OR ($g_vo['group'] == '即将到期') OR ($g_vo['group'] == '公司域名') OR ($g_vo['group'] == '客户域名')): else: ?><li><a href="javascript:void(0);" onClick="groupBy('<?php echo ($g_vo["group"]); ?>')">移动到<font id="<?php echo ($g_vo["id"]); ?>"><?php echo ($g_vo["group"]); ?></span></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                    <li ><a href="javascript:void(0);" style="border-top:1px solid #ccc;" onClick="addGroup()">新建分组</a></li>
                                </ul>
                                <button class="ui-btn-grey btn-batch-remove" style=" position:relative" id="opt_btn" onClick="optSelect(event)">更多
                                    <span class="caret"></span>
                                </button> 
                                <ul class="dropdown-menu" style="margin-left:210px;" id="opt_sel">
                                    <li><a id="disable-domain" href="javascript:" onClick="stopDomain()">停用</a></li>
                                    <li><a id="enable-domain" href="javascript:" onClick="startDomain()">启用</a></li>
                                    <li><a id="delete-domain" href="javascript:" onClick="deleteDomain()">删除</a></li>
                                </ul>
                            </div>
                            <div class="rf">
                                <input class="ui-ipt-txt ui-ipt-search J_iptSearchDomain" style="width:108px;" id="searchTxt" type="text" placeholder="域名快速查找"  onChange="pageReload(0)"/>
                                <button class="ui-btn-grey" onClick="selectBy(this)">查找</button>
                                <button class="ui-btn-grey" onClick="pageReload(1)">重置</button>
                            </div>
                        </th> 	
                    </tr></thead> 	
                    <tbody id="mydata">
                       <!-- 域名记录 -->
                       <?php if($zoneListCount==0): ?><tr class="con-empty J_listEmpty" id="null_zone">
                                <td colspan="5">
                                    <span class="ui-sorry">暂无域名记录~</span>
                                </td>
                        </tr>
                       <?php else: ?>
                       <?php if(is_array($zoneList)): $i = 0; $__LIST__ = $zoneList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$z_vo): $mod = ($i % 2 );++$i;?><tr class="zoneRow" level="<?php echo ($z_vo["level"]); ?>">
                                <td class="chk">
                                    <input type="checkbox" class="J_chkForMe" value="<?php echo ($z_vo["domain"]); ?>">
                                </td>	
                                <td class="domain">
                                    <?php if($z_vo['is_on']==0): ?><p class="icon-stop"><a href="javascript:void(0);" class="icon" title="该域名已暂停解析"></a>
                                        <a href="__APP__/Domain/detail?d=<?php echo ($z_vo["domain"]); ?>" class="domain_id <?php if($z_vo['is_author']==0): ?>ui-color-red<?php endif; ?>" title="<?php echo ($z_vo["desc"]); ?>"><?php echo ($z_vo["domain"]); ?></a></p>
                        <?php else: ?>
                                            <?php if($z_vo['level']==0): ?><p class="icon-no-vip"><a href="javascript:void(0);" class="icon" title="升级套餐，享受域名保障服务"></a>
                                                <a href="__APP__/Domain/detail?d=<?php echo ($z_vo["domain"]); ?>" class="domain_id <?php if($z_vo['is_author']==0): ?>ui-color-red<?php endif; ?>" title="<?php echo ($z_vo["desc"]); ?>"><?php echo ($z_vo["domain"]); ?></a></p>
                            <?php else: ?>                                       
                                                <p class="icon-vip"><a href="javascript:void(0);" class="icon" title="VIP域名，享受域名保障服务"></a>
                                                <a href="__APP__/Domain/detail?d=<?php echo ($z_vo["domain"]); ?>" class="domain_id <?php if($z_vo['is_author']==0): ?>ui-color-red<?php endif; ?>" title="<?php echo ($z_vo["desc"]); ?>"><?php echo ($z_vo["domain"]); ?></a></p><?php endif; endif; ?>
                                </td>
                                <td class="msg">
                                    <?php if($z_vo['count']==null): ?><p><a class="" href="__APP__/Domain/detail?d=<?php echo ($z_vo["domain"]); ?>">还没有解析记录？快点击这里添加解析记录吧！</a></p><?php endif; ?>
                                    <?php if($z_vo['count']!=null): if($z_vo['is_author']==0): ?><p><a class="ui-color-red" target="_blank" href="http://www.eflydns.com/index/Help/tools?domain=<?php echo ($z_vo["domain"]); ?>">域名尚未修改DNS(点击诊断)。</a></p><?php endif; endif; ?>
                                </td>
                                <td class="remark">
                                <?php if($z_vo['count']!=null): ?><p>已有<span class="J_rrCount"><?php echo ($z_vo["count"]); ?></span>条解析记录</p><?php endif; ?>
                                </td>
                                <td class="iop" style="width:130px;">
                                    <?php if($z_vo['is_star']==0): ?><a class="icon-star" title="加星标记，方便下次查看哦！" href="javascript:void(0);" onClick="markStar(this,'<?php echo ($z_vo["domain"]); ?>')"></a>
                        <?php else: ?><a class="icon-star-on" title="已标记，点击取消标记" href="javascript:void(0);" onClick="markStar(this,'<?php echo ($z_vo["domain"]); ?>')"></a><?php endif; ?>
                                    <a class="<?php if($z_vo["desc"] == ''): ?>icon-add<?php else: ?>icon-add-on<?php endif; ?>" title="添加备注" href="javascript:void(0);" onClick="addDesc(this,'<?php echo ($z_vo["domain"]); ?>')"></a>
                                    <!--a class="icon-manage" style="display:none" title="域名设置" href="javascript:void(0);" onClick="editTable('<?php echo ($z_vo["domain"]); ?>');"></a-->
                                    <?php if($z_vo['count']!=null): ?><a class="<?php if($z_vo["zone_name"] == ''): ?>icon-copy<?php else: ?>icon-copy-on<?php endif; ?>" title="添加别名" href="javascript:void(0);" onClick="addBiem('<?php echo ($z_vo["domain"]); ?>')"></a><?php endif; ?>
                                </td>
                            </tr>
                            <!-- 备注信息 -->
                            <tr style="display:none;"> 	
                                <td colspan="5" class="expand-outer fix">
                                    <div style="position: relative;">
                                        <div class="patch-left"></div>
                                        <div class="patch-right"></div>
                                        <div class="expand-box">
                                            <b class="expand-box-arr">◆<b class="expand-box-arr-in">◆</b></b>
                                            <div class="remark-box fix J_remarkBox">
                                                <label class="lbl">备注：</label>
                                                <textarea class="ui-textarea J_remarkTextarea" rows="3" maxlength="200"  onKeyUp="wordsLimit(this)"><?php echo ($z_vo["desc"]); ?></textarea>
                                                <div class="btm">
                                                    <span class="info J_countInfo">最多还可写<b>200</b>个字</span>
                                                    <button class="ui-btn-blue btn-add J_btnSubmitRemark" onClick="saveDomain(this)">保存</button>
                                                    <button class="ui-btn-grey btn-cancle J_btnCancleRemark" onClick="cancelDomain(this)">取消</button>
                                                </div> 				
                                            </div> 			
                                        </div> 		
                                    </div> 	
                                </td> 
                            </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>				
                    </tbody> 
                </table>
                </div>
            </div>
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
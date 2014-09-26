<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html><head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta content="" name="keywords">
	<meta content="" name="description">
	<title>EflyDNS - 域名解析</title>
    <link rel="shortcut icon" href="__ROOT__/Public/img/eflydns.ico" />
	<link rel="stylesheet" href="__ROOT__/Public/css/base.css">
	<link rel="stylesheet" href="__ROOT__/Public/css/dns.css">
	<link rel="stylesheet" href="__ROOT__/Public/css/artDialog.css">
	<link rel="stylesheet" href="__ROOT__/Public/css/jquery.autocomplete.css" />
	<script type="text/javascript" src="__ROOT__/Public/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="__ROOT__/Public/js/util.js"></script>
	<script type="text/javascript" src="__ROOT__/Public/js/layer/layer.min.js"></script>
	<script type="text/javascript" src="__ROOT__/Public/js/jquery.autocomplete.min.js"></script>
	<script type="text/javascript" src="__ROOT__/Public/js/artDialog/jquery.artDialog.js"></script>
	<script type="text/javascript" >
		var show_hide=0, Tip = null,mydata,tableObj;
		function optTakeEffect(){
			$(".J_infoBox").slideToggle();
		}
		function closeTip(){
			layer.close(Tip);
		}
		function pageReload(type){
			if(type==0){
				var val = $("#searchTxt").val();
				if(val=="" || typeof(val)=='undefined'){
					//$("#myData").empty();
					//$("#myData").html(mydata);
					window.location.reload();
				}	
			}else{
				$("#searchTxt").val('');
				//$("#myData").empty();
				//$("#myData").html(mydata);
				window.location.reload();
			}
			
		}
		/*function bindseach(){
			$.getJSON('__APP__/Domain/bindDomainsch',{'t':new Date().getTime(),'zone':$("#txt_zone").val()},function(data){			
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
							 return row.host ;
						 },
						 formatMatch: function(row, i, max) {
							 return row.host;
						 },
						 formatResult: function(row) {
							 return row.host;
						 }
					}).result(function(event, row, formatted){
						$(tableObj).each(function(){
							if($(this).find('input').val()==row.id){
								var desc = $(this).next().next().html(),
									msg = $(this).next().html(),
									tr = $(this).html(),
									dcls = $(this).next().next().attr('class'),
									mcls = $(this).next().attr('class'),
									mid = $(this).next().attr('id'),
									cls = $(this).attr('class');
									
								$("#myData").empty();
								$("#myData").html("<tr class='"+cls+"' >"+tr+"</tr><tr style='display:none;' class='"+mcls+"' id='"+mid+"'>"+msg+"</tr><tr style='display:none;' class='"+dcls+"'>"+desc+"</tr>");
							}
						});
					});
				}				
			});
		}*/
		$(function(){
			/*if($("#is_first").val() == "true"){
				var loadi, domain = $("#txt_zone").val();
				$.ajax({
					url:'__APP__/Domain/searchRecord',
					timeout : 3000, //超时时间设置，单位毫秒
					type:'post',
					beforeSend: function(){ loadi = layer.load("请稍后，正在为您扫描DNS记录..."); },
					data:{ 'rcd': domain },
					complete: function(){ layer.close(loadi); },
					success:function(data){
						layer.close(loadi);
						if(data.data && data.data.length > 0){
							var str = '[';  //[{"data":"10 mail.test1.com.","type":"MX","ttl":900,"head":"@"},{"data":"10 mail.test1.com.","type":"MX","ttl":900,"head":"@"}]str.replace(/Microsoft/g, "W3School")
							for(var i=0;i<data.data.length;i++){
								str += '{"d":"' + data.data[i].data.replace(/"/g, "") + '","t":"'+data.data[i].type+'","l":'+data.data[i].ttl+',"h":"'+data.data[i].head+'"},';
							}
							var d = str.substr(0,str.length-1) + ']';
							Tip = $.layer({
								type: 2,
								title: '记录自动导入',
								iframe: { src : '__APP__/Domain/recordList?d='+encodeURIComponent(d)},  //不会被编码的字符有 ! * ( ) '
								area: ['600px' , '406px'],
								offset: ['100px','']
							});
						}else{
							messageBox("message","没有查找到域名相关记录，请手动添加！");
						}
					},
					error:function(data){
						layer.close(loadi);
						messageBox('message','查找失败，网络错误代码：'+data.statusText);
					}
				});
			}*/
			//加载提示信息
			if($("#is_first").val() == "true"){
				setTimeout(function(){$('#first_show').slideToggle()},500);
			}

			$('.msg_info').children().html(info_val);
			
			//tableObj = $("#myData .data");
			//mydata=$("#myData").html();
			//bindseach();
		});
		//保存操作
		function saveOpt(obj,opt){
			var tr = $(obj).parent().parent(),trnext=$(tr).next(),
				type = tr.find("#type").val(),			//记录类型
				rr = tr.find("#rr").val(),				//主机记录
				route = tr.find("#route").val(),		//解析线路
				val = tr.find("#val").val(),			//记录值
				mx = '',	//MX优先级
				ttl = tr.find("#time :selected").val(),	//TTL
				status = tr.find("#status").val(),	
				id = tr.find("input").val();
				//如果不是mx
				if(tr.find(".mx").html()=='--'){
					mx = '0';
				}else{
					mx = tr.find("#mx :selected").val();
				}
			//主机记录RR验证
			if(rr=='' || typeof(rr)=='undefined'){
				if(type=='A' || type=='MX' || type=='TXT' || type=='AAAA' || type=='SRV' || type=='REDIRECT_URL' || type=='FORWARD_URL'){
					tr.find("#rr").val('@');	
				}else{
					tr.find("#rr").focus();
					return;
				}
			}
			//val记录值验证
			if(val=='' || typeof(val)=='undefined'){
				tr.find("#val").focus();
				//提示
				$(obj).parent().parent().next().show();
				return;
			}else{
				if(type=='A'){
					if(!CheckIp(val)){
						tr.find("#val").focus();				
						return;
					}
				}
				if(type=='CNAME' || type=='MX' || type=='NS'){
					if(!checkDomain(val)){
						tr.find("#val").focus();				
						return;
					}
				}else if(type=='AAAA'){
					if(!checkIpv6(val)){
						tr.find("#val").focus();				
						return;
					}
				}
				//else if(type=='REDIRECT_URL' || type=='FORWARD_URL'){
					//验证是否有备案号	
				//}
			}
			if(opt=='add'){
				//添加解析记录
				$.ajax({ 
					url:'__APP__/Domain/addDomain',
					type:'post',
					async:false,
					data:{'host':rr,'type':type,'view':route,'val':val,'mx':mx,'ttl':ttl,'zone':$("#txt_zone").val()},
					success:function(data){
						//alert(data.info);
						id = data.data;
						messageBox('message',data.info);
						if(data.status!=0){
							tr.attr("class","data");
							//清空
							tr.empty();
							route = bindRoute(route);
							tr.html(trcontent(id,type,rr,route,val,mx,ttl,status));
							$(tr).next().after(tr_desc);	
						}else{
							tr.empty();
						}
					},
					error:function(data){
						messageBox('message','添加失败，网络错误代码：'+data.statusText);
					}
				});
				
			}else{
				//修改解析记录
				$.ajax({
					url:'__APP__/Domain/updateDomain',
					type:'post',
					async:false,
					data:{'host':rr,'type':type,'view':route,'val':val,'mx':mx,'ttl':ttl,'id':id,'zone':$("#txt_zone").val()},
					success:function(data){
						//id = data.data;	
						if(data.info=='error'){
							messageBox('message',data.data);
						}else{							
							messageBox('message','解析记录修改成功。');
							tr.attr("class","data");
							//清空
							tr.empty();
							route = bindRoute(route);
							tr.html(trcontent(id,type,rr,route,val,mx,ttl,status));
						}
						
					},
					error:function(data){
						messageBox('message','修改失败，网络错误代码：'+data.statusText);
					}
				});
			}
			
			$(tr).attr('id','');
			trnext.hide();
			//tableObj = $("#myData .data");
			//mydata=$("#myData").html();
			//bindseach();
		}
		//取消操作
		function CancelOpt(obj,id,type,rr,route,val,mx,ttl,status){
			var tr = $(obj).parent().parent(),trnext=$(tr).next();
			tr.attr("class","data");
			//清空
			tr.empty();
			tr.html(trcontent(id,type,rr,route,val,mx,ttl,status));
			//提示
			trnext.hide();
		}
		//不可编辑tr内容
		function trcontent(id,type,rr,route,val,mx,ttl,status){
			if(mx==0){
				mx = '--';
			}
			if(status=='stop'){
				status = '<img src="__ROOT__/Public/img/Pause.png"/>';	
			}else{
				status = '';
			}
			var str = '<td class="chk"><input type="checkbox" class="data_chk" value="'+id+'"></td><td class="status">'+status+'</td><td class="rr" onclick="editTable(this)">'+ rr +'</td><td class="type" onclick="editTable(this)">'+ type +'</td><td class="route" onclick="editTable(this)">'+ route +'</td><td class="val" onclick="editTable(this)">'+ val +'</td><td class="mx" onclick="editTable(this)">'+ mx +'</td><td class="ttl" onclick="editTable(this)">'+ ttl +'</td><td class="iop"><a class="icon-manage" title="编辑" href="javascript:void(0);" onClick="editTable(this);"></a><a class="icon-add" title="编辑备注" href="javascript:void(0);" onClick="editDesc(this,'+ id +');"></a></td>'	;
			return str;
		}
		//编辑
		function editTable(obj){
			if($("#is_lock").val()==0){
				var tr = "";
				//编辑按钮
				if($(obj).html()==""){
					tr = $(obj).parent().parent();
				}else{
					tr = $(obj).parent();
				}
				var trnext=$(tr).next(),				
					type = tr.find(".type").html(),			//记录类型
					rr = tr.find(".rr").html(),				//主机记录
					route = tr.find(".route").html(),		//解析线路
					val = tr.find(".val").html(),			//记录值
					mx = tr.find(".mx").html(),				//MX优先级
					ttl = tr.find(".ttl").html(),			//TTL
					id = tr.find('input').val(),			
					str='<select class="ui-select" style="width:40px;" id="mx" onFocus="showInfo(\'mx\',this)">',
					img = tr.find('.status img').attr('src'),
					spancls = "";
					
					tr.attr("class","row-opened");
					if(type=='MX'){
						for(var i=0;i<10;i++){
							if(i+1==mx){
								str += "<option value='"+ (i+1) +"' selected>"+ (i+1) +"</option>";
							}else{
								str += "<option value='"+ (i+1) +"'>"+ (i+1) +"</option>";
							}
						}
						str +'</select>';
					}else{
						str = mx;
					}
					//清空
					tr.empty();
					//可编辑状态
					if(show_hide==1){
						spancls = "ui-help J_btnToggleHelp";
					}else{
						spancls = "ui-help J_btnToggleHelp ui-help-opened";
					}
					var option = $("#viewOpt").html();
					var zone = $("#cur_zone").html(),str_status="";
					if(typeof(img)!='undefined'){
						str_status = 'stop';
					}else{
						str_status = 'start';
					}
					tr.html('<td class="chk"><input type="hidden" value="'+id+'" id="id"/></td><td class="status"><input id="status" type="hidden" value="'+str_status+'"/></td><td class="rr"><input value="'+ rr +'" class="ui-ipt-txt" id="rr" onFocus="showInfo(\'rr\',this)"/><!--span class="ui-color-grey suffix" title=".'+zone+'">.'+zone+'</span--></td><td class="type"><select class="ui-select" id="type" onChange="bindingMX(this)" onFocus="showInfo(\'type\',this)"><option value="A" >A</option><option value="CNAME">CNAME</option><option value="MX">MX</option><option value="NS">NS</option><option value="TXT">TXT</option><option value="AAAA">AAAA</option><!--option value="REDIRECT_URL">显性URL</option><option value="FORWARD_URL">隐性URL</option--></select></td><td class="route"><select class="ui-select" id="route" onFocus="showInfo(\'route\',this)">'+option+'</select></td><td class="val"><input value="'+ val +'" class="ui-ipt-txt" id="val" onFocus="showInfo(\'val\',this)"/></td><td class="mx">'+ str +'</td><td class="ttl"><select class="ui-select" id="time" onFocus="showInfo(\'ttl\',this)"><option value="10" >10分钟</option><option value="30">30分钟</option><option value="60">60分钟</option><option value="720">720分钟</option><option value="1440">1440分钟</option></select></td><td class="iop"><button class="ui-btn-blue btn-update J_btnUpdateDnsRow" onclick="saveOpt(this,\'update\')">保存</button><button class="ui-btn-grey btn-cancle J_btnCancleEdit" onclick="CancelOpt(this,'+id+',\''+ type +'\',\''+ rr +'\',\''+ route +'\',\''+ val +'\',\''+ mx +'\',\''+ ttl +'\',\''+ str_status +'\')">取消</button><span id="icon_open_close" class="'+spancls+'" onclick="slideInfo(this)"></span></td>');
					//绑定下拉框值
					tr.find("#type").val(type);
					tr.find("#route option").each(function(){
						if($(this).text()==route){
							$(this).attr('selected','selected');
						}
					});		
					tr.find("#time option").each(function(){
						if($(this).val()==ttl){
							$(this).attr('selected','selected');
						}
					});
					
					//提示
					if(show_hide==0){
						$(tr).next().find('.help-tips-box div').hide();
						$(tr).next().find('.expand-box-arr').css('left','107px');
						$(tr).next().find('.J_helpRR_A_MX_AAAA').show();
						trnext.show();
					}
			}else{
				messageBox('message','['+$("#txt_zone").val()+']域名锁定，不能进行该操作');	
			}
		}
		//切换消息
		function slideInfo(obj){
			if($(obj).attr('class')=='ui-help J_btnToggleHelp ui-help-opened'){
				$(obj).attr('class','ui-help J_btnToggleHelp');
				$(obj).parent().parent().next().hide();				
			}else {
				$(obj).attr('class','ui-help J_btnToggleHelp ui-help-opened');
				$(obj).parent().parent().next().show();
			}
			show_hide=0;
		}
		//关闭
		function closeDiv(){
			$(".J_infoBox").slideToggle();
		}
		function closeInfo(){
			$("#first_show").slideToggle();
		}
		//消息提示
		function showInfo(cla,tr){
			var val = $(tr).parent().parent().find('#type').val(),
				id = $(tr).parent().parent().next().attr('id');
			//隐藏div
			$('#'+id+' .help-tips-box div').hide();
			
			switch (cla){
				case 'icon-manage':	
					$('#'+id).find('.expand-box-arr').css('left','242px');
					$('#'+id).find('.J_helpRecordType').show();
					break;
				case 'type':	
					$('#'+id).find('.expand-box-arr').css('left','242px');
					$('#'+id).find('.J_helpRecordType').show();
					break;
				case 'rr':
					$('#'+id).find('.expand-box-arr').css('left','107px');
					switch(val){
						case 'A':case 'MX':case 'AAAA':
							$('#'+id).find('.J_helpRR_A_MX_AAAA').show();
							break;
						case 'CNAME':
							$('#'+id).find('.J_helpRR_CNAME').show();
							break;
						case 'NS':
							$('#'+id).find('.J_helpRR_NS').show();
							break;
						case 'TXT':
							$('#'+id).find('.J_helpRR_TXT').show();
							break;
						case 'SRV':
							$('#'+id).find('.J_helpRR_SRV').show();
							break;
						case 'REDIRECT_URL':
							$('#'+id).find('.J_helpRR_URL1').show();
							break;
						case 'FORWARD_URL':
							$('#'+id).find('.J_helpRR_URL0').show();
							break;
					}
					break;
				case 'route':
					$('#'+id).find('.expand-box-arr').css('left','368px');
					$('#'+id).find('.J_helpRoute').show();
					break;
				case 'val':
					$('#'+id).find('.expand-box-arr').css('left','556.5px');
					switch(val){
						case 'A':
							$('#'+id).find('.J_helpValue_A').show();
							break;
						case 'CNAME':
							$('#'+id).find('.J_helpValue_CNAME').show();
							break;
						case 'MX':
							$('#'+id).find('.J_helpValue_MX').show();
							break;
						case 'NS':
							$('#'+id).find('.J_helpValue_NS').show();
							break;
						case 'TXT':
							$('#'+id).find('.J_helpValue_TXT').show();
							break;
						case 'AAAA':
							$('#'+id).find('.J_helpValue_AAAA').show();
							break;
						case 'SRV':
							$('#'+id).find('.J_helpValue_SRV').show();
							break;
						case 'REDIRECT_URL':
							$('#'+id).find('.J_helpValue_URL1').show();
							break;
						case 'FORWARD_URL':
							$('#'+id).find('.J_helpValue_URL0').show();
							break;
					}
					break;
				case 'mx':
					$('#'+id).find('.expand-box-arr').css('left','658px');
					$('#'+id).find('.J_helpMX').show();
					break;
				case 'ttl':
					$('#'+id).find('.expand-box-arr').css('left','737px');
					$('#'+id).find('.J_helpTTL').show();
					break;
			}
		}
		//不在提示
		function notshowInfo(obj){
			var span = $(obj).parent().parent().parent().parent().prev().find('#icon_open_close');
			$(span).attr('class','ui-help J_btnToggleHelp');
			//隐藏信息
			$(obj).parent().parent().parent().parent().hide();
			show_hide = 1;
		}
		//添加
		function addDNS(obj){			
			if($("#is_lock").val()==0){
				//添加去掉暂无信息的提示
				if($("#null_domain").html()){
					$("#null_domain").empty();
				}
				if(!$("#add_row").html()){
					var option = $("#viewOpt").html();
					$('#myData').prepend('<tr class="row-opened" id="add_row"><td class="chk"></td><td class="status"></td><td class="rr"><input value="" class="ui-ipt-txt" id="rr" onFocus="showInfo(\'rr\',this)"/><!--span class="ui-color-grey suffix" title=".'+$("#txt_zone").val()+'">.'+$("#txt_zone").val()+'</span--></td><td class="type"><select class="ui-select" id="type" onChange="bindingMX(this)" onFocus="showInfo(\'type\',this)"><option value="A" >A</option><option value="CNAME">CNAME</option><option value="MX">MX</option><option value="NS">NS</option><option value="TXT">TXT</option><option value="AAAA">AAAA</option><!--option value="SRV">SRV</option><option value="REDIRECT_URL">显性URL</option><option value="FORWARD_URL">隐性URL</option--></select></td><td class="route"><select class="ui-select" id="route" onFocus="showInfo(\'route\',this)">'+option+'</select></td><td class="val"><input value="" class="ui-ipt-txt" id="val" onFocus="showInfo(\'val\',this)"/></td><td class="mx">--</td><td class="ttl"><select class="ui-select" id="time" onFocus="showInfo(\'ttl\',this)"><option value="10" >10分钟</option><option value="30">30分钟</option><option value="60">60分钟</option><option value="720">720分钟</option><option value="1440">1440分钟</option></select></td><td class="iop"><button class="ui-btn-blue btn-update J_btnUpdateDnsRow" onclick="saveOpt(this,\'add\')">保存</button><button class="ui-btn-grey btn-cancle J_btnCancleEdit" onclick="CancelAdd()">取消</button><span id="icon_open_close" class="ui-help J_btnToggleHelp ui-help-opened" onclick="slideInfo(this)"></span></td></tr><tr class="msg_info" id="tx_0"><td colspan="9" class="expand-outer">'+info_val+'</td></tr>');
					//$("#add_row").after();
					//$("#add_row").next().children().html(info_val);			
					var tr = $("#add_row");
					$(tr).next().find('.help-tips-box div').hide();
					$(tr).next().find('.J_helpRR_A_MX_AAAA').show();
				}else{
					messageBox('message','您有正在编辑的解析尚未保存。');
				}
			}else{
				messageBox('message','['+$("#txt_zone").val()+']域名锁定，不能进行该操作');	
			}
		}
		//取消添加
		function CancelAdd(){
			$('#add_row').next().empty();
			$('#add_row').empty();
		}
		//绑定mx下拉框
		function bindingMX(obj){
			var val = $(obj).val(),str='',
				td = $(obj).parent().parent().find('.mx');
			$(td).empty();
			if(val=='MX'){
				for(var i=0;i<10;i++){
					str += "<option value='"+ (i+1) +"'>"+ (i+1) +"</option>";
				}
				$(td).append('<select class="ui-select" style="width:50px;" id="mx" onFocus="showInfo(\'mx\',this)">'+ str +'</select>');
			}else{
				$(td).append('--');
			}
		}
		//编辑备注
		function editDesc(obj,id){
			if($("#is_lock").val()==0){
				var tr = $(obj).parent().parent(), desc = $(tr).next().next().find('textarea').val();
				/*$(tr).next().next().find('textarea').val('');
				$.ajax({
					url:'__APP__/Domain/findDescById',
					type:'post',
					async:false,
					data:{'id':id},
					success:function(data){
						if(data.info=='success'){
							desc = data.data[0].desc;
						}
					},
					error:function(data){
						messageBox('message','修改失败，网络错误代码：'+data.statusText);
					}
				});*/
				$(tr).attr('class','row-opened');	
				$(tr).next().next().find('.btm b').html(200-desc.length);	
				//$(tr).next().next().find('textarea').val(desc);
				$(tr).next().next().show();					
			}else{
				messageBox('message','['+$("#txt_zone").val()+']域名锁定，不能进行该操作');	
			}
		}
		//取消保存备注
		function cancelEditDesc(obj){
			var tr = $(obj).parent().parent().parent().parent().parent().parent();
			if($(tr).prev().prev().attr('class')=='row-opened'){
				$(tr).prev().prev().attr('class','data');
			}else{
				$(tr).prev().prev().attr('class','row-opened');
			}
			$(tr).hide();
		}
		//保存备注
		function saveEditDesc(obj){
			var id = $(obj).parent().parent().parent().parent().parent().parent().prev().prev().find(':checkbox').val(),
			desc = $(obj).parent().prev().val();
			$.ajax({
				url:'__APP__/Domain/addDomainDesc',
				type:'post',
				async:false,
				data:{'id':id,'desc':desc},
				success:function(data){
					if(data.info=='success'){
						messageBox('message','解析记录备注修改成功。');
					}else{
						messageBox('message','修改备注失败，请联系管理员。');
					}
					cancelEditDesc(obj);
				},
				error:function(data){
					messageBox('message','修改失败，网络错误代码：'+data.statusText);
				}
			});
			
		}
		//启用
		function startDns(){
			if($("#is_lock").val()==0){
				var chk = $('#mytab .data_chk:checked'),id="";
				if($(chk).length>0){
					for(var i=0;i<chk.length;i++){
						if(i!=chk.length-1){
							id += chk[i].value + "," ;	
						}else{
							id += chk[i].value ;
						}
					}
					art.dialog({
						title:false,
						height:80,
						icon:'question',
						content:'确认启用解析记录？',
						ok:function(){
							$.ajax({
								url:'__APP__/Domain/startDns',
								type:'post',
								async:false,
								data:{'id':id,'zone':$("#txt_zone").val()},
								success:function(data){
									if(data.info=='success'){									
										messageBox('message','解析记录启用成功。');
										for(var i=0;i<chk.length;i++){
											$(chk[i]).parent().parent().find('.status').html('');
										}										
									}else{
										messageBox('message','解析记录启用失败，请联系管理员。');	
									}
								},
								error:function(data){
									messageBox('message','启用失败，网络错误代码：'+data.statusText);
								}
							});
						},
						cancelVal: '取消',
						cancel:true
					}).lock();
				}else{
					messageBox('message','请先选择一条要启用的解析记录');
				}
			}else{
				messageBox('message','['+$("#txt_zone").val()+']域名锁定，不能进行该操作');	
			}
		}
		//停用
		function stopDns(){
			if($("#is_lock").val()==0){
				var chk = $('#mytab .data_chk:checked'),id="";
				if($(chk).length>0){
					for(var i=0;i<chk.length;i++){
						if(i!=chk.length-1){
							id += chk[i].value + "," ;	
						}else{
							id += chk[i].value ;
						}
					}
					art.dialog({
						title:false,
						height:80,
						icon:'question',
						content:'确认停用解析记录？',
						ok:function(){
							$.ajax({
								url:'__APP__/Domain/stopDns',
								type:'post',
								async:false,
								data:{'id':id,'zone':$("#txt_zone").val()},
								success:function(data){
									if(data.info=='success'){									
										messageBox('message','解析记录停用成功。');
										for(var i=0;i<chk.length;i++){
											$(chk[i]).parent().parent().find('.status').html('<img src="__ROOT__/Public/img/Pause.png"/>');
										}
									}else{
										messageBox('message','解析记录停用失败，请联系管理员。');	
									}
								},
								error:function(data){
									messageBox('message','停用失败，网络错误代码：'+data.statusText);
								}
							});
						},
						cancelVal: '取消',
						cancel:true
					}).lock();
				}else{
					messageBox('message','请先选择一条要停用的解析记录');
				}
			}else{
				messageBox('message','['+$("#txt_zone").val()+']域名锁定，不能进行该操作');	
			}
		}
		//删除
		function deleteDns(){
			if($("#is_lock").val()==0){
			//批量
				var chk = $('#mytab .data_chk:checked'),id="";			
				if($(chk).length>0){
					for(var i=0;i<chk.length;i++){
						if(i!=chk.length-1){
							id += chk[i].value + "," ;	
						}else{
							id += chk[i].value ;
						}
					}
					art.dialog({
						title:false,
						height:80,
						icon:'question',
						content:'确认删除解析记录？',
						ok:function(){
							$.ajax({
								url:'__APP__/Domain/deleteDomain',
								type:'post',
								async:false,
								data:{'id':id,'zone':$("#txt_zone").val()},
								success:function(data){
									if(data.info=='success'){
										$('#mytab .data_chk:checked').each(function(){
											$(this).parent().parent().next().next().empty();
											$(this).parent().parent().next().empty();
											$(this).parent().parent().empty();
										});
										//tableObj = $("#myData .data");
										//mydata=$("#myData").html();
										//bindseach();
										messageBox('message','解析记录删除成功。');
									}else{
										messageBox('message','解析记录删除失败，请联系管理员。');	
									}
								},
								error:function(data){
									messageBox('message','删除失败，网络错误代码：'+data.statusText);
								}
							});
						},
						cancelVal: '取消',
						cancel:true
					}).lock();
				}else{
					messageBox('message','请先选择要删除的解析记录');
				}
			}else{
				messageBox('message','['+$("#txt_zone").val()+']域名锁定，不能进行该操作');	
			}
		}
		//解析记录排序
		function sortDomain(str,zone,obj){
			var ord = "";
			if($(obj).attr('class')=='el'){				
				$('.el').attr('class','el asc');
				$(obj).attr('class','el desc_on');
				ord = " order by "+ str + " desc";
			}else{
				if($(obj).attr('class')=='el desc_on'){
					$('.el').attr('class','el asc');
					$(obj).attr('class','el asc_on');
					ord = " order by "+ str + " asc";
				}else{
					$('.el').attr('class','el asc');
					$(obj).attr('class','el desc_on');
					ord = " order by "+ str + " desc";
				}
			}
			$.ajax({
				url:'__APP__/Domain/sortDomain',
				type:'post',
				async:false,
				data:{'ord':ord,'zone':zone},
				success:function(data){
					if(data.info=='success'){
						var tr="",tem="";									
						$('#myData').empty();
						for(var i=0;i<data.data.length;i++){
							if(data.data[i].mx==0){
								tem = "--";
							}else{
								tem = data.data[i].mx;
							}
							addRow(data.data[i].id, data.data[i].type, data.data[i].host, data.data[i].view, data.data[i].val, tem, data.data[i].ttl, data.data[i].desc,data.data[i].is_on,data.data[i].is_edit);
						}
					}
				},
				error:function(data){
					messageBox('message','排序失败，网络错误代码：'+data.statusText);
				}
			});
		}
		function addRow(id,type,host,route,val,mx,ttl,desc,isOn,isEidt){			
			var str_ison = "",str_isEdit = "",dis="";
			if(isOn==0){
				str_ison = '<img src="__ROOT__/Public/img/Pause.png"/>';
			}
			if(isEidt==0){
				str_isEdit = 'data nocolor';
				dis = "disabled";
			}else{
				str_isEdit = 'data';
			}
			$('#myData').prepend('<tr class="'+str_isEdit+'"><td class="chk"><input type="checkbox" '+dis+' class="data_chk" value="'+id+'"></td><td class="status">'+str_ison+'</td><td class="rr" onclick="editTable(this)">'+host+'</td><td class="type" onclick="editTable(this)">'+type+'</td><td class="route" onclick="editTable(this)">'+bindRoute(route)+'</td><td class="val" onclick="editTable(this)">'+val+'</td><td class="mx" onclick="editTable(this)">'+mx+'</td><td class="ttl" onclick="editTable(this)">'+ttl+'</td><td class="iop"><a class="icon-manage" title="编辑" href="javascript:void(0);" onClick="editTable(this);"></a><a class="icon-add" title="编辑备注" href="javascript:void(0);" onClick="editDesc(this,'+id+');"></a></td></tr><tr style="display:none" class="msg_info" id="tx_'+id+'"><td colspan="9" class="expand-outer">'+info_val+'</td></tr><tr style="display:none" class="edit_desc"><td colspan="9" class="expand-outer fix"><div style="position: relative;"><div class="patch-left"></div><div class="patch-right"></div><div class="expand-box"><b class="expand-box-arr">◆<b class="expand-box-arr-in">◆</b></b><div class="remark-box fix J_remarkBox"><label class="lbl">备注：</label><textarea class="ui-textarea J_remarkTextarea" rows="3" maxlength="200" onKeyUp="wordsLimit(this)">'+desc+'</textarea><div class="btm"><span class="info J_countInfo">最多还可写<b>200</b>个字</span><button class="ui-btn-blue btn-add J_btnSubmitRemark" onClick="saveEditDesc(this)">保存</button><button class="ui-btn-grey btn-cancle J_btnCancleRemark" onClick="cancelEditDesc(this)">取消</button></div></div></div></div></td></tr>');
		}
		//字数限制
		function wordsLimit(obj){
			$(obj).next().find('b').html(200-$(obj).val().length);
		}
		function bindRoute(route){
			var val;
			if(typeof(route)=='undefined' || route==0){
				return "默认";
			}else{
				$("#viewOpt option").each(function(){
					if($(this).val()==route){
						val = $(this).html();	
					}
				});
				return val;
			}			
		}
		//全选、取消全选
		function checkAll(obj){
			$('#myData :checkbox').each(function(){
				this.checked = obj.checked;
			});
			//过滤掉不能进行修改的记录
			$('#myData .nocolor :checkbox').each(function(){
				this.checked = false;
			});
		}
		function selectBy(obj){
			var val = $(obj).prev().val(),str="";
			if(val){
				$.ajax({
					url:'__APP__/Domain/selectDomain',
					type:'post',
					async:false,
					data:{'val':val,'zone':$("#txt_zone").val()},
					success:function(data){
						if(data.info=='success'){
							$("#myData").empty();
							for(var i=0;i<data.data.length;i++){
								var route = bindRoute(data.data[i].route);
								if(data.data[i].is_edit==0){
									str += '<tr class="data nocolor"> ' + trcontent(data.data[i].id,data.data[i].type,data.data[i].host,route,data.data[i].val,data.data[i].mx,data.data[i].ttl,data.data[i].status) + '</tr>';	
								}else{
									str += '<tr class="data">' + trcontent(data.data[i].id,data.data[i].type,data.data[i].host,route,data.data[i].val,data.data[i].mx,data.data[i].ttl,data.data[i].status) + '</tr>';
								}
								
								str += "<tr style='display:none;' class='msg_info' id='tx_"+data.data[i].id+"'><td colspan='9' class='expand-outer'>"+info_val+"</td></tr><tr style='display:none;' class='edit_desc'>"+bindDomainDesc(data.data[i].desc)+"</tr>";
							}
							$("#myData").html(str);
						}
					},
					error:function(data){
						messageBox('message','排序失败，网络错误代码：'+data.statusText);
					}
				});
			}else{
				messageBox('message','请输入主机记录（支持模糊查询）');
				//pageReload(0);
			}
		}
    </script>
</head>
<body class="page-dns" style="">
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

		<input type="hidden" value="<?php echo ($zone); ?>" id="txt_zone"/>
		<input type="hidden" value="<?php echo ($is_new); ?>" id="is_first"/>        
		<input type="hidden" value="<?php echo ($is_lock); ?>" id="is_lock"/>
		<div class="head-info">
			<div class="head-path">
				<a class="home" href="__APP__/Domain/domainList" ></a><span class="s"></span>
				<a href="domainList.html">域名列表</a><span class="s"></span>
				<strong class="current"><?php echo ($zone); ?> 的解析记录</strong>
			</div>
		</div> 
		<div class="J_infoBox" id="first_show" style="display:none;">
			<div class="dns-tip-box fix J_dnsTipBox">
				<div class="lf tips">
					<p><b class="ui-color-red">还差最后一步，即可开始使用 eflyDNS ：</b></p>
					<p class="dot"> 点击下方的添加记录按钮完成添加，再到域名注册的地方将 DNS 修改为 ：</p>
					<p class="dot"> ns1.eflydns.net</p>
					<p class="dot"> ns2.eflydns.net</p>
					<p class="dot">注意不能同时和其他 DNS 混用，会导致解析混乱哦～！</p>
					<p class="dot">修改 DNS 服务器需要最长 72 小时的全球生效时间，请耐心等待。</p>
				</div>
				<div class="lf helps">
					<p class="how"><a href="http://www.eflydns.com/index/index.php/Help/manual?41" target="_blank">如何使用EflyDNS？</a></p>
					<p class="when"><a href="http://www.eflydns.com/index/index.php/Help/manual?24" target="_blank">设置解析后多长时间生效？</a></p>
					<p class="qa"><a href="http://www.eflydns.com/index/index.php/Help/manual?25" target="_blank">解析不能生效？</a></p>
				</div>
				<a class="btn-close J_btnClose" href="javascript:void(0);" onClick="closeInfo();" >close</a>
			</div>
		</div>
		<!--div class="J_infoBox" style="display:none;">
			<div class="dns-tip-box fix J_dnsTipBox">
				<div class="lf tips">
					<p>
					    <b class="ui-color-red">
						域名解析记录生效的时间分为以下三种情况：
						<a class="ui-help" href="javascript:void(0);" title="先设置解析记录，后修改DNS，可使您的域名解析平滑过渡，访问无断点。"></a>
					    </b>
					</p>
					<p class="dot">
					  新增解析记录，我们是实时生效的。
					</p>
					<p class="dot">
					  修改域名记录，DNSPro解析权威服务器上是实时生效的，最终生效时间取决于各地运营商的缓存DNS刷新时间；一般可认为修改记录后生效时间为您域名记录之前设置的TTL时间，所以还请耐心等待。
					</p>
					<p class="dot">
					  新修改域名DNS指向DNSPro解析的DNS后，我们的DNS服务器的生效时间是实时的，但因各地ISP服务商刷新域名DNS的时间不一致，所以导致解析在全球生效一般需要0--72小时，所以还请您耐心的等待。
					</p>
				</div>
				<div class="lf helps">
					<p class="how"><a href="" target="_blank">如何修改DNS？</a></p>
					<p class="when"><a href="" target="_blank">设置解析后多长时间生效？</a></p>
					<p class="qa"><a href="" target="_blank">解析常见问题？</a></p>
				</div>
				<a class="btn-close J_btnClose" href="javascript:void(0);" onClick="closeDiv();" >close</a>
			</div>
		</div-->
		<div class="J_singleTop">
			<p class="domain-title">
			<?php if($level != 0): ?><span class="dtype icon-vip"></span>
			    <?php else: ?><span class="dtype icon-novip"></span><?php endif; ?>
                <!--<a href="__APP__/Domain/domainRoute?d=<?php echo ($zone); ?>">自定义路线</a>-->
				<strong id="cur_zone" class="dname"><?php echo ($zone); ?></strong>
				<span class="tab nocur"><a href="javascript:void(0);">自定义路线</a></span>
				<span class="tab nocur"><a href="__APP__/Domain/domainRpt?d=<?php echo ($zone); ?>">解析统计</a></span>
				<span class="tab nocur"><a href="__APP__/Domain/domainSet?d=<?php echo ($zone); ?>">域名设置</a></span>
				<span class="tab "><a href="__APP__/Domain/detail?d=<?php echo ($zone); ?>">记录管理</a></span>
			</p>
		</div> 
		<div class="table-box">
			<div class="table-toolbar">
				<div class="lf">
					<button class="ui-btn-blue" onClick="addDNS('icon-manage')">新增解析</button>
					<button class="ui-btn-grey" style="" onClick="startDns()">启用</button>
					<button class="ui-btn-grey" style="" onClick="stopDns()">暂停</button>
					<button class="ui-btn-grey" style="" onClick="deleteDns()">删除</button>
				</div>
			<!-- 消息提示 -->
                <div class="ui-pop-box small-con-box" id="message" style="float:left; margin-left:10px; display:none;width:auto;height:auto;">
							<div style="position: relative;background-color: #fff;border: solid 1px #999; height:20px;line-height:20px; padding:2px 10px 2px 10px">这里是提示信息</div>
						</div>
				<div class="rf">
					<input class="ui-ipt-txt ui-ipt-search J_iptSearchDomain" submit-with=".J_btnSearchDomain" id="searchTxt" type="text" placeholder="快速查找记录"><!-- onChange="pageReload(0)" -->
					<button class="ui-btn-grey" onClick="selectBy(this)">查找</button>
                    <button class="ui-btn-grey" onClick="pageReload(1)">重置</button>
				</div>
				<!--div class="rf"> 
					<a class="icon icon-log" href="__APP__/Optlog">解析记录日志</a>
					<a class="icon icon-export" href="javascript:void(0);" target="_blank">导出解析记录</a> 
					<input class="ui-ipt-txt ui-ipt-search " submit-with=".J_btnSubmitSearch" type="text" placeholder="请输入关键字词">
					<button class="ui-btn-grey">搜索</button> 	
				</div--> 
				<select id="viewOpt" style="display:none;">
				<?php if(is_array($viewList)): $i = 0; $__LIST__ = $viewList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rl): $mod = ($i % 2 );++$i;?><option value="<?php echo ($rl["id"]); ?>"><?php echo ($rl["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</div>
			<table class="ui-table" cellpadding="0" cellspacing="0" width="100%" id="mytab">
				<thead>
				<tr id="tr_title">
					<th class="chk"><input type="checkbox" class="J_chkForAll" onclick="checkAll(this);" title="全选/取消全选"/></th> 
					<th class="sortable"></th>
					<th class="sortable" sort="rr"><span class="el" onClick="sortDomain('host','<?php echo ($zone); ?>',this)">主机记录</span></th>
					<th class="sortable" sort="type"><span class="el" onClick="sortDomain('type','<?php echo ($zone); ?>',this)">记录类型</span></th>
					<th class="sortable" sort="line"><span class="el" onClick="sortDomain('view','<?php echo ($zone); ?>',this)">解析线路</span></th>
					<th><span>记录值</span></th> 		
					<th class="sortable" style="white-space:nowrap;" sort="mx"><span class="el" onClick="sortDomain('mx','<?php echo ($zone); ?>',this)">MX优先级</span></th> 		
					<th><span>TTL（分钟）</span></th> 		
					<th>操作&nbsp;<a href="javascript:void(0);" onClick="optTakeEffect()">[何时生效？]</a></th> 	
				</tr>
				</thead> 	
				<tbody id="myData">
				<?php if($count != 0): if(is_array($recordlist)): $i = 0; $__LIST__ = $recordlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$record): $mod = ($i % 2 );++$i; if($record[is_edit] == 0): ?><tr class="data nocolor"> 
						    <td class="chk"><input type="checkbox" disabled class="data_chk" value="<?php echo ($record["id"]); ?>"></td>
                            <?php if($record[is_on] == 0): ?><td class="status"><img src="__ROOT__/Public/img/Pause.png"/></td>
                                <?php else: ?><td class="status"></td><?php endif; ?>
						    <td class="rr"><?php echo ($record["host"]); ?></td>
						    <td class="type"><?php echo ($record["type"]); ?></td>
						    <?php if($record[view] == 0): ?><td class="route">默认</td>
							<?php else: ?>
							<?php if(is_array($viewList)): $i = 0; $__LIST__ = $viewList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rl): $mod = ($i % 2 );++$i; if($rl[id] == $record[view]): ?><td class="route"><?php echo ($rl["name"]); ?></td><?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
						    <td class="val"><?php echo ($record["val"]); ?></td>
						    <?php if($record[mx] != 0): ?><td class="mx"><?php echo ($record["mx"]); ?></td>
							<?php else: ?>
							<td class="mx">--</td><?php endif; ?>
						    <td class="ttl"><?php echo ($record["ttl"]); ?></td>
						    <td class="iop" style="color:#999;">系统默认添加，无需修改</td> 	 
						</tr>
						<?php else: ?>
                        	<tr class="data"><td class="chk"><input type="checkbox" class="data_chk" value="<?php echo ($record["id"]); ?>"></td>
                            <?php if($record[is_on] == 0): ?><td class="status"><img src="__ROOT__/Public/img/Pause.png"/></td>
                                <?php else: ?><td class="status"></td><?php endif; ?>
						    <td class="rr" onclick="editTable(this)"><?php echo ($record["host"]); ?></td>
						    <td class="type" onclick="editTable(this)"><?php echo ($record["type"]); ?></td>
						    <?php if($record[view] == 0): ?><td class="route" onclick="editTable(this)">默认</td>
							<?php else: ?>
							<?php if(is_array($viewList)): $i = 0; $__LIST__ = $viewList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rl): $mod = ($i % 2 );++$i; if($rl[id] == $record[view]): ?><td class="route" onclick="editTable(this)"><?php echo ($rl["name"]); ?></td><?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
						    <td class="val" onclick="editTable(this)"><?php echo ($record["val"]); ?></td>
						    <?php if($record[mx] != 0): ?><td class="mx" onclick="editTable(this)"><?php echo ($record["mx"]); ?></td>
							<?php else: ?>
							<td class="mx" onclick="editTable(this)">--</td><?php endif; ?>
						    <td class="ttl" onclick="editTable(this)"><?php echo ($record["ttl"]); ?></td>
						    <td class="iop">
							<a class="icon-manage" title="编辑" href="javascript:void(0);" onClick="editTable(this);"></a>
							<a class="<?php if($record["desc"] == ''): ?>icon-add<?php else: ?>icon-add-on<?php endif; ?>" title="编辑备注" href="javascript:void(0);" onClick="editDesc(this,<?php echo ($record["id"]); ?>);"></a>
						    </td> 	 
						</tr>
						<tr style="display:none" class="msg_info" id="tx_<?php echo ($record["id"]); ?>">	 	
						    <td colspan="9" class="expand-outer"></td>
						</tr>
						<!-- 备注信息 -->
						<tr style="display:none" class="edit_desc">
						    <td colspan="9" class="expand-outer fix">
						    <div style="position: relative;">
							<div class="patch-left"></div>
							<div class="patch-right"></div>
							<div class="expand-box">
							    <b class="expand-box-arr">◆<b class="expand-box-arr-in">◆</b></b>
							    <div class="remark-box fix J_remarkBox">
								<label class="lbl">备注：</label><textarea class="ui-textarea J_remarkTextarea" rows="3" maxlength="200" onKeyUp="wordsLimit(this)"><?php echo ($record["desc"]); ?></textarea>
								<div class="btm">
								    <span class="info J_countInfo">最多还可写<b>200</b>个字</span>
								    <button class="ui-btn-blue btn-add J_btnSubmitRemark" onclick="saveEditDesc(this)">保存</button>
								    <button class="ui-btn-grey btn-cancle J_btnCancleRemark" onclick="cancelEditDesc(this)">取消</button>
								</div>
							    </div>
							</div>
						    </div>
						    </td>
						</tr><?php endif; endforeach; endif; else: echo "" ;endif; ?>
				<?php else: ?>
				    <tr class="con-empty J_listEmpty" id="null_domain">
					<td colspan="9">
					    <span class="ui-sorry">暂无解析记录~</span>
					</td>
				    </tr><?php endif; ?>
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
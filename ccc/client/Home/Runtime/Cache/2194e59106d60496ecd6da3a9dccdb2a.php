<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html><head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta content="" name="keywords">
	<meta content="" name="description">
    <link rel="shortcut icon" href="__ROOT__/Public/img/eflydns.ico" />
	<link rel="stylesheet" href="__ROOT__/Public/css/core.css">
	<link rel="stylesheet" href="__ROOT__/Public/css/reg.css">
	<title>EflyDNS - 个人用户注册</title>
	<script type="text/javascript">
    	var APP = "__APP__";
    </script>
	<script type="text/javascript" src="__ROOT__/Public/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="__ROOT__/Public/js/util.js"></script>
	<script type="text/javascript" src="__ROOT__/Public/js/jquery.mailAutoComplete-3.1.js"></script>
    <script type="text/javascript">
		function changeVerify(){
			$('#verifyImg').attr('src','__APP__/Index/verify?t='+ new Date());
		}
		function keyEmail(){
			$("#fm-regist-id-email").mailAutoComplete({
				boxClass: "out_box", //外部box样式     
				listClass: "list_box", //默认的列表样式     
				focusClass: "focus_box", //列表选样式中     
				markCalss: "mark_box", //高亮样式     
				autoClass: true,     
				textHint: true //提示文字自动隐藏 
			}); 	
		}
		function checkForm(){
			if(checkEmail() && checkPwd() && checkRePwd() && checkCode()){
				var mail = $("#fm-regist-id-email").val(),
					pwd = $("#fm-regist-password").val(),
					code = $("#J-checkcode").val();
				$.ajax({
					url:'__APP__/Index/register',
					type:'post',
					data:{'mail':mail,'pwd':pwd,'code':code},
					success:function(data){
						if(data.info=='error'){
							showInfo(data.data);	
						}else{
							showInfo(data.data);
							setTimeout(function(){
								window.location.href='__APP__/Domain/domainList';
							},2000);
						}
					},
					error:function(data){
						showInfo(data.statusText);		
					}
				});
			}else{
				showInfo('请完整填写表单！');
			}
		}
	</script>
</head>
<body class="regist">
        <div id="header-container">
		<div id="header" class="clr">
			<h1 id="logo">
				<a href="http://www.eflydns.com/" title="EflyDNS"><img class="main lf" src="__ROOT__/Public/img/DNSPro_w.png" alt="EflyDNS"></a>
				<span class="header-title" style="display:block;">个人帐号注册</span>
			</h1>
		</div>
	</div>
	
	<div id="content-container">
    <div id="content" class="grid780 clr">
	
        <div id="regist-module" class="clr" style="">
            <div id="regist-wrap">
                 <form id="regist" name="regist" method="post">
                    <div id="regist-error" class="form-error notice notice-error" style="display:none;">
                        <span class="icon-notice icon-error"></span>
                        <span class="notice-descript" id="error_msg"></span>
                    </div>
                    <table id="regist-form" class="form">
                        <tbody><tr>
                            <td class="fm-label">
                                <div class="fm-label-wrap fm-relative">
                                    <span class="icon icon-regist-email"></span>
                                    <label for="fm-regist-id-email">
                                        <span class="noempty">*</span>
                                        电子邮箱:</label>
                                </div>
                            </td>
                            <td class="fm-field" width="300">
                                <div class="fm-field-wrap" style="z-index:2;">
                                    <input type="text" id="fm-regist-id-email" name="_fm-a-_0-e" tabindex="1" placeholder="输入电子邮箱作为帐户名" onFocus="keyEmail()" onBlur="checkEmail()" class="fm-text fm-validator" value="">
				    <div class="fm-validator-result"></div>
				</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="fm-label">
                                <label for="fm-regist-password">
                                    <span class="noempty">*</span>
                                    登录密码:</label>
                            </td>
                            <td class="fm-field">
                                <div class="fm-field-wrap">
                                    <input type="password" id="fm-regist-password" name="_fm-a-_0-p" tabindex="2" class="fm-text fm-password fm-validator" autocomplete="off" onkeyup="checkPwdBar(this.value)" onBlur="checkPwd()"/>
                                       <div id="fm-regist-password-pstrength" class="pstrength-container"><div id="fm-regist-password-pstrength-bar" class="pstrength-bar clr"><div class="pstrength-bar-weak" id="bar_ruo">弱</div><div class="pstrength-bar-middle" id="bar_zhong">中</div><div class="pstrength-bar-strong" id="bar_qiang">强</div></div></div><div class="fm-validator-result"></div></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="fm-label">
                                <label for="fm-regist-repassword">
                                    <span class="noempty">*</span>
                                    确认密码:</label>
                            </td>
                            <td class="fm-field">
                                <div class="fm-field-wrap">
                                    <input type="password" id="fm-regist-repassword" name="_fm-a-_0-r" tabindex="3" class="fm-text fm-password fm-validator" autocomplete="off" onBlur="checkRePwd()"/>
                                    <div class="fm-validator-result"></div></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="fm-label">
                                <label for="fm-regist-aliyun-checkcode">
                                    <span class="noempty">*</span>
                                    图片验证码:</label>
                            </td>
                            <td class="fm-field">
                                <div class="fm-field-wrap">
                                    <input id="J-checkcode" class="fm-text fm-checkcode fm-validator" type="text" maxlength="4" autocomplete="off" value="" name="_fm-a-_0-im" onBlur="checkCode()"/>
                                    <img id="verifyImg" src="__APP__/Index/verify" style="margin-left:10px;" align="absMiddle" onclick="changeVerify();" alt="点击图片刷新验证码" title="点击刷新图片验证码">
                                    <a href="javascript:void(0);" onclick="changeVerify();" class="J-changeCheckcode">看不清，换一张</a>
                                    <div class="fm-validator-result"></div></div>
                        </td></tr>
                        <tr>
                            <td></td>
                            <td class="fm-field">
                                <div class="fm-field-wrap">
                                    <input type="button" id="fm-regist-submit" value="同意协议并注册" name="event_submit_do_join" tabindex="7" onClick="checkForm()" class="fm-button fm-submit"/>
                                </div>
                                <div class="fm-field-extra">
                                    <a href="" target="_blank">《EflyDNS服务协议》</a>
                                </div>
                            </td>
                        </tr>
                    </tbody></table>
                </form>
            </div>
            <div id="regist-extra">
		    <p>&nbsp;</p>
		    <p>已有账户？  <a href="__APP__/Index/login">马上登录</a></p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <h3>企业账号</h3>
                    <p>&nbsp;</p>
                    <p>如果您是企业用户，请</p>
                    <a href="__APP__/Index/cregister">注册企业账号</a>
                    <p>&nbsp;</p>
                    <a href="http://www.eflydns.com/index/index.php/Help/manual?51">了解更多>></a>
              </div>
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
</body>
</html>
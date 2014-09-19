<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta content="" name="keywords">
	<meta content="" name="description">
    <link rel="shortcut icon" href="__ROOT__/Public/img/eflydns.ico" />
	<link rel="stylesheet" href="__ROOT__/Public/css/core.css">
	<link rel="stylesheet" href="__ROOT__/Public/css/reg.css">
	<script type="text/javascript" src="__ROOT__/Public/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="__ROOT__/Public/js/common.js"></script>
	<script type="text/javascript" src="__ROOT__/Public/js/jquery.mailAutoComplete-3.1.js"></script>
	<title>EflyDNS - 用户登录</title>
	<script type="text/javascript">
		//如果是内部页，父级页面刷新,登录
		if(window.top!=this){ 
			parent.location.reload();
		}
		$(function(){
			var msg = $("#error-msg").html();
			if(msg){
				  $("#regist-error").show();
			}
		});
		function keyEmail(){
			$("#username").mailAutoComplete({
				boxClass: "out_box", //外部box样式     
				listClass: "list_box", //默认的列表样式     
				focusClass: "focus_box", //列表选样式中     
				markCalss: "mark_box", //高亮样式     
				autoClass: true,     
				textHint: true, //提示文字自动隐藏 
			}); 	
		}
	</script>
	<script type="text/javascript">
	function changeVerify(){
		$('#verifyImg').attr('src','__APP__/Index/verify?t='+ new Date());
	}
	</script>
</head>
<body class="regist">
        <div id="header-container">
		<div id="header" class="clr">
			<h1 id="logo">
				<a href="http://www.eflydns.com" title="EflyDNS" ><img class="main lf" src="__ROOT__/Public/img/DNSPro_w.png" alt="EflyDNS"></a>
				<span class="header-title" style="display:block;">用户登录</span>
			</h1>
		</div>
	</div>
	
	<div id="content-container">
    <div id="content" class="grid780 clr">
	
        <div id="regist-module" class="clr" style="">
            <div id="regist-wrap">
                 <form id="regist" name="regist" onsubmit="return validate_form(this);" method="post">
                    <div id="regist-error" class="form-error notice notice-error" style="display:none">
                        <span class="icon-notice icon-error"></span>
                        <span id="error-msg" class="notice-descript"><?php echo ($error); ?></span>
                    </div>
                    <table id="regist-form" class="form">
                        <tbody><tr>
                            <td class="fm-label">
                                <div class="fm-label-wrap fm-relative">
                                    <span class="icon icon-regist-email"></span>
                                    <label for="username">
                                        电子邮箱:</label>
                                </div>
                            </td>
                            <td class="fm-field" width="300">
                                <div class="fm-field-wrap" style="z-index:2;">
                                    <input type="text" id="username" name="username" onclick="onBlue();" onFocus="keyEmail()" style="width:160px;" tabindex="1" placeholder="输入电子邮箱" class="fm-text fm-validator" value="<?php echo ($mail); ?>"><div id="msg-username" class="fm-validator-result"><span class="noempty">*</span>输入邮箱地址</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="fm-label">
                                <label for="password">
                                    登录密码:</label>
                            </td>
                            <td class="fm-field">
                                <div class="fm-field-wrap">
                                    <input type="password" onclick="onBlue();" id="password" name="password" value="" style="width:160px;" tabindex="2" class="fm-text fm-password fm-validator" autocomplete="off">
                                    <div id="msg-pwd" class="fm-validator-result"><span class="noempty">*</span>输入登录密码</div></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="fm-label">
                                <label for="fm-regist-aliyun-checkcode">
                                    验证码:</label>
                            </td>
                            <td class="fm-field">
                                <div class="fm-field-wrap">
                                    <input id="checkcode" name="checkcode" onclick="onBlue();" class="fm-text fm-checkcode fm-validator" tabindex="3" type="text" maxlength="4" autocomplete="off" value="" name="_fm-a-_0-im">
                                    <img id="verifyImg" src="__APP__/Index/verify" style="margin-left:10px;" align="absMiddle" onclick="changeVerify();" alt="点击图片刷新验证码" title="点击刷新图片验证码">
                                    <a href="javascript:void(0);" onclick="changeVerify();" class="J-changeCheckcode">看不清，换一张</a>
                                    <div id="msg-code" class="fm-validator-result"><span class="noempty">*</span>输入验证码</div>
                                </div>
                        </td></tr>
                        <tr><td align="right"></td><td>
                        <a href="__APP__/Index/forget" target="_blank">忘记密码？</a>
                        </td></tr>
                        <tr>
                            <td></td>
                            <td class="fm-field">
                                <div class="fm-field-wrap">
                                    <input type="submit" id="fm-regist-submit" value="登录" name="event_submit_do_join" tabindex="4" class="fm-button fm-submit">
                                </div>
                            </td>
                        </tr>
                    </tbody></table>
                </form>
            </div>
            <div id="regist-extra">
                    <h3>免费注册</h3>
                    <p>&nbsp;</p>
                    <a href="__APP__/Index/register">注册个人账号</a>
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
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta content="" name="keywords">
	<meta content="" name="description">
    <link rel="shortcut icon" href="__ROOT__/Public/img/eflydns.ico" />
	<link rel="stylesheet" href="__ROOT__/Public/css/core.css">
	<link rel="stylesheet" href="__ROOT__/Public/css/reg.css">
    <script type="text/javascript">var APP = "__APP__";</script>
	<script type="text/javascript" src="__ROOT__/Public/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="__ROOT__/Public/js/common.js"></script>
	<script type="text/javascript" src="__ROOT__/Public/js/util.js"></script>
	<script type="text/javascript" src="__ROOT__/Public/js/jquery.mailAutoComplete-3.1.js"></script>
	<title>EflyDNS - 修改密码</title>
	<script type="text/javascript">
		//如果是内部页，父级页面刷新,登录
		
		$(function(){
			var msg = $("#error-msg").html();
			if(msg){
				  $("#regist-error").show();
			}
		});
		
	</script>
	<script type="text/javascript">
	function updatepwd(){
		if(checkPwd() && checkRePwd()){
			var pwd = $("#fm-regist-password").val();
				$.ajax({
					url:'__APP__/Index/updatepwd',
					type:'post',
					data:{'mail':$("#email").val(),'pwd':pwd},
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
				<a href="http://www.eflydns.com" title="DNSPro" ><img class="main lf" src="__ROOT__/Public/img/DNSPro_w.png" alt="DNSPro"></a>
				<span class="header-title" style="display:block;">修改密码</span>
			</h1>
		</div>
	</div>
	
	<div id="content-container">
    <div id="content" class="grid780 clr">
	
        <div id="regist-module" class="clr" >
            <div id="regist-wrap" style="border:none;">
                 <form id="regist" name="regist" method="post">
                 	<input type="hidden" value="<?php echo ($mail); ?>" id="email"/>
                    <div id="regist-error" class="form-error notice notice-error" style="display:none">
                        <span class="icon-notice icon-error"></span>
                        <span id="error_msg" class="notice-descript"><?php echo ($error); ?></span>
                    </div>
                    <table id="regist-form" class="form">
                        <tbody>
                        <tr>
                            <td class="fm-label">
                                <label for="fm-regist-password">
                                    <span class="noempty">*</span>
                                    登录密码:</label>
                            </td>
                            <td class="fm-field">
                                <div class="fm-field-wrap">
                                    <input type="password" id="fm-regist-password" name="_fm-a-_0-p" tabindex="3" class="fm-text fm-password fm-validator" autocomplete="off" onkeyup="checkPwdBar(this.value)" onBlur="checkPwd()"/>
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
                                    <input type="password" id="fm-regist-repassword" name="_fm-a-_0-r" tabindex="4" class="fm-text fm-password fm-validator" autocomplete="off" onBlur="checkRePwd()"/>
                                    <div class="fm-validator-result"></div></div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="fm-field">
                                <div class="fm-field-wrap">
                                    <input type="button" id="fm-regist-submit" onClick="updatepwd()" value="提交" name="event_submit_do_join" tabindex="4" class="fm-button fm-submit">
                                </div>
                            </td>
                        </tr>
                    </tbody></table>
                </form>
            </div>
            <!--div id="regist-extra">
                    <h3>免费注册</h3>
                    <p>&nbsp;</p>
                    <a href="__APP__/Index/register">注册个人账号</a>
                    <p>&nbsp;</p>
                    <p>如果您是企业用户，请</p>
                    <a href="__APP__/Index/cregister">注册企业账号</a>
                    <p>&nbsp;</p>
                    <a href="#">了解更多>></a>
              </div-->
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
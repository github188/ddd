<?php if (!defined('THINK_PATH')) exit();?><!doctype html>

<!--

                   _ooOoo_
                  o8888888o
                  88" . "88
                  (| -_- |)
                  O\  =  /O
               ____/`---'\____
             .'  \\|     |//  `.
            /  \\|||  :  |||//  \
           /  _||||| -:- |||||-  \
           |   | \\\  -  /// |   |
           | \_|  ''\---/''  |   |
           \  .-\__  `-`  ___/-. /
         ___`. .'  /--.--\  `. . __
      ."" '<  `.___\_<|>_/___.'  >'"".
     | | :  `- \`.;`\ _ /`;.`/ - ` : | |
     \  \ `-.   \_ __\ /__ _/   .-` /  /
======`-.____`-.___\_____/___.-`____.-'======
                   `=---='
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
            佛祖保佑        永无BUG

-->

<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="zh_CN"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="zh_CN"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="zh_CN"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js" lang="zh-CN"> 
<!--<![endif]-->
<head>
  	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
	<meta name="renderer" content="webkit">

	<title>EflyDNS - 速度最快的智能DNS解析服务商,免费DNS,安全,可靠,智能划分</title>
	<meta name="description" content="EflyDNS - 速度最快的智能DNS解析服务商,免费DNS,安全,可靠,智能划分">
	<link rel="shortcut icon" href="__ROOT__/Public/images/eflydns.ico" />

	<link href="__ROOT__/Public/css/outter-global.css" media="screen" rel="stylesheet" type="text/css" />

	<script src="__ROOT__/Public/js/sea.js" id="seajsnode"></script>

	<!--[if lt IE 9]>
	<script type="text/javascript" src="__ROOT__/Public/js/html5.js"></script>
	<![endif]--> 

  <link rel="stylesheet" href="__ROOT__/Public/css/welcome.css">

</head>

<body>
  
    <!-- Topbar ================================================== -->
      <header style="height: 485px;">

    <nav class="outter-nav">
      <a href="__APP__/Index/index" class="brand">
        <img src="__ROOT__/Public/images/EflyDNS.png" width="140" height="36" alt="" title="">
      </a>

      <ul role="navigation" class="">
        <li class="index"><a href="__APP__/Index/index">首&nbsp;&nbsp;&nbsp;&nbsp;页</a></li>
        <li class="plan"><a href="__APP__/Product/product">购&nbsp;买&nbsp;套&nbsp;餐</a></li>
        <li class="support"><a href="__APP__/Help/help">帮&nbsp;助&nbsp;中&nbsp;心</a></li>
      </ul>

      <?php if(empty($_SESSION['user'])): ?><ul class="info" style="display:none;">
      <?php else: ?>
        <ul class="info"><?php endif; ?>
        <li>
            <span onclick="location='http://www.eflydns.com/client/Domain/domainList';">回到我的域名</span>
        </li>
      </ul>

      <?php if(empty($_SESSION['user'])): ?><ul class="account">
      <?php else: ?>
        <ul class="account" style="display:none;"><?php endif; ?>
        <li>
          <a href="http://www.eflydns.com/client/Index/register" class="signup">注册</a>
        </li>

        <li class='login_li' >
          <a href="http://www.eflydns.com/client/Index/login" id='login-widget'>登录</a>

         <div class='topbar-dropdown'>
            <form id="form-login-widget" class="form-stacked" method="POST" action='/Login'>
                <div class="clearfix">
                  <label for="email">E-Mail</label>
                  <div class="input">
                    <input class="large" id="email" name="email" size="30" type="text" />
                    <span class="help-inline"></span>
                  </div>
                </div><!-- /clearfix -->
                <div class="clearfix">
                  <label for="password">密码</label>
                  <div class="input">
                    <input class="large" id="password" name="password" size="30" type="password" />
                    <span class="help-inline"></span>
                  </div>
                </div><!-- /clearfix -->
                <div class="clearfix">
                  <div class="input remember ">
                    <label class="clearfix">
                      <input type="checkbox" name="remember" value="1" />
                      <span>一个月内自动登录</span>
                    </label>
                    <a href='#'>忘记密码</a>
                  </div>
                </div>
                <div class="">
                  <button type="submit" class='btn primary large' >登 录</button>
                </div>
            </form>
         </div>
        </li>

      </ul>
    </nav>

    <div class="bg"></div>
    
  </header>


<script>
  seajs.use(['jquery.js', 'cookie.js'], function($, cookie) {

      var ua = $.browser;
      if ( !(ua.msie && /^[67]/.test(ua.version)) ) {
        if (ua.msie && /^[9]/.test(ua.version)) {
            $('#email').keyup(function(e){
              if (e.keyCode==13) $('#password').focus();
            });
            $('#password').keyup(function(e){
              if (e.keyCode==13) $('#form-login-widget').submit();
            });
        }
        
        var $dropdown = $('.topbar-dropdown');
        var $login = $('#login-widget');
        var $form = $('#form-login-widget');

        $form.find('input, button').attr('tabindex', 1);

        //点击登陆按钮
        $login.click(function(e){
          //return;//不显示dropdown直接跳转

          e.preventDefault();
          e.stopPropagation();
          //button actived
          $(this).closest('.login_li').toggleClass('login-widget-show');
          //login in widget show up
          $dropdown.toggleClass('show');
          $form.find(':input[value=""]:first').select();
         
         if($(this).closest('.login_li').hasClass('login-widget-show')){
            $(this).css('color', '#000');
         }else{
            $(this).css('color', '#fff');
         }
         
        });


        //点击窗口其他地方关闭dropdown
        $(document).click(function(e) {
          var $target = $(e.target);
          if (!$target.closest('.login_li').length && $dropdown.hasClass('show')) {
            $login.closest('.login_li').removeClass('login-widget-show');
            $dropdown.removeClass('show');

            $login.css('color', '#fff');
          }
        });


        //提交登陆表单
        $form.submit(function(e) {
          e.preventDefault();
          $form.find('button[type=submit]').attr('disabled', true).addClass('disabled');
          $.ajax({
            url: '__APP__/Index/login',
            data: $form.serialize(),
            dataType: 'json',
            type: 'post',
            success: function(data) {
                //console.log(data);

                if (data.status == 'success') {
                  cookie.set('peach', $form.find('input[name=email]').val(), {
                    expires: 3650
                  });

                  //window.location.href = data.string + window.location.hash;

                  //$(".outter-nav .account").hide();
                  //$(".outter-nav .info").show();
                  window.location.href = 'http://www.eflydns.com/client/Domain/domainList';

                } else {
                  //cookie.set('loginError', data.string);

                  window.location.href = 'http://www.eflydns.com/client/Index/login';
                }
            }
          });

        });

        var last_login_email = cookie.get('peach');
        if (last_login_email) {
          $('input[name=email]').val(last_login_email);
        }

      } // end if ie6

  });

</script>

	
    <!-- Page
    ================================================== -->
      <div role="main">
        <!-- Page
================================================== -->
<div class='container pages main-banner'>

   <!-- 四周年临时添加 -->
      <style>
         header {background-image:none;background-color:#062C5B;}
         header.monitor{
          background-image: url("__ROOT__/Public/images/monitor.jpg");
          background-repeat: no-repeat;
          background-position: center;
         }
         /*header.year4_1 {
          background-image: -khtml-gradient(linear, left top, left bottom, from(#ffd401), to(#ffcc01));
          background-image: -moz-linear-gradient(top, #ffd401, #ffcc01);
          background-image: -ms-linear-gradient(top, #ffd401, #ffcc01);
          background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #ffd401), color-stop(100%, #ffcc01));
          background-image: -webkit-linear-gradient(top, #ffd401, #ffcc01);
          background-image: -o-linear-gradient(top, #ffd401, #ffcc01);
          background-image: linear-gradient(top, #ffd401, #ffcc01);
          filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffd401', endColorstr='#ffcc01', GradientType=0);
          background:url('/yantai/event/year2013/images/banner_bg.jpg');
         }*/
         header.origin {
          background-image: -khtml-gradient(linear, left top, left bottom, from(#50a5e6), to(#41a2e5));
          background-image: -moz-linear-gradient(top, #50a5e6, #41a2e5);
          background-image: -ms-linear-gradient(top, #50a5e6, #41a2e5);
          background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #50a5e6), color-stop(100%, #41a2e5));
          background-image: -webkit-linear-gradient(top, #50a5e6, #41a2e5);
          background-image: -o-linear-gradient(top, #50a5e6, #41a2e5);
          background-image: linear-gradient(top, #50a5e6, #41a2e5);
          filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#50a5e6', endColorstr='#41a2e5', GradientType=0);
          background:url('__ROOT__/Public/images/header-bg.jpg');
         }
      </style>

   <div id="myCarousel" class="carousel slide">
            <div class="carousel-inner">
              <div class="item active">
                <a href="#">
                    <!--
                  <img src="__ROOT__/Public/images/qiniuBanner.jpg" alt=""/>
                  <a href="#" class="qiniu_btn" target="_blank"></a>
                    -->
                    <img src="__ROOT__/Public/images/b2.jpg" alt=""/>
                </a>
              </div>

              <div class="item">
                <a href="#">
                  <img data-src="__ROOT__/Public/images/b1.jpg" alt="" class="ue-recrew"/>
                  <a href="http://www.eflydns.com/client/Index/register" class="banner-sign-up"></a>
                </a>
              </div>

              <!--
              <div class="item">
                <a href="#">
                  <img src="__ROOT__/Public/images/b3.jpg" alt="" />
                </a>
              </div>
              -->

              <!--
              <div class="item">
                <a href="#">
                  <img src="__ROOT__/Public/images/b4.jpg" alt="">
                  <div class="banner_data">约204万个网站信赖EflyDNS，昨天已为全球网民提供177亿次请求服务</div>
                  <a href="#" class="banner-sign-up"></a>
                </a>
              </div>
              -->

            </div><!--end of item innner-->

   </div><!--end of my carousel-->
   <div class='banner-nav'>
         <ul>

         </ul>
   </div>

  <!-- <a href='/SignUp' class='banner-sign-up'></a> -->
</div>


<!-- 客户轮播波部分，暂时没显示 -->
<section style="display:none;" class="customers">
  <h2>他们都在使用 EflyDNS</h2>
  <div class="gallery"></div>
  <nav>

    <ul>
      <li><a href="#previous" class="arrow previous"><b>上一个</b></a></li>
      <li><a href="#next" class="arrow next"><b>下一个</b></a></li>
    </ul>
  </nav>
   <div class='clients-display'>
       <ul>
                           <!-- 世界知名 -->
        <li><a href="#" class="clients_10"></a></li><!-- xingbake -->
        <li><a href="#" class="clients_59"></a></li><!-- maidanglao -->
        <li><a href="#" class="clients_64"></a></li><!-- xiangnaier -->
        <li><a href="#" class="clients_61"></a></li><!-- aipusheng -->
        <li><a href="#" class="clients_39"></a></li><!-- maidelong  -->

                           <!-- 上市公司 -->
        <li><a href="#" class="clients_32"></a></li><!-- sany  -->
        <li><a href="#" class="clients_1"></a></li><!-- 58 -->
        <li><a href="#" class="clients_60"></a></li><!-- qichezhijia -->
        <li><a href="#" class="clients_73"></a></li><!-- qunaer -->
        <li><a href="#" class="clients_37"></a></li><!-- tuniu  -->

                           <!-- 中国知名 -->
        <li><a href="#" class="clients_40"></a></li><!-- xiaomi -->
        <li><a href="#" class="clients_69"></a></li><!-- guomei  -->
        <li><a href="#" class="clients_66"></a></li><!-- chuizi -->
        <li><a href="#" class="clients_67"></a></li><!-- dididache -->
        <li><a href="#" class="clients_70"></a></li><!-- kuaididache -->

                           <!-- 中国知名2 -->
        <li><a href="#" class="clients_33"></a></li><!-- 4399 -->
        <li><a href="#" class="clients_16"></a></li><!-- meituan  -->
        <li><a href="#" class="clients_15"></a></li><!-- yinlian  -->
        <li><a href="#" class="clients_38"></a></li><!-- meituxiuxiu  -->
        <li><a href="#" class="clients_13"></a></li><!-- oppo  -->

                           <!-- 传统企业 -->
        <li><a href="#" class="clients_58"></a></li><!-- jiaduobao -->
        <li><a href="#" class="clients_3"></a></li><!-- yunnanbaiyao -->
        <li><a href="#" class="clients_35"></a></li><!-- hayaoliuchang -->
        <li><a href="#" class="clients_42"></a></li><!-- jili -->
        <li><a href="#" class="clients_41"></a></li><!-- zhongtong -->

                           <!-- 媒体相关 -->
        <li><a href="#" class="clients_24"></a></li><!-- cnbeta -->
        <li><a href="#" class="clients_29"></a></li><!-- csdn  -->
        <li><a href="#" class="clients_49"></a></li><!--  oschina -->
        <li><a href="#" class="clients_45"></a></li><!-- zhihu -->
        <li><a href="#" class="clients_68"></a></li><!-- douban -->

                           <!-- 合作伙伴 -->
        <li><a href="#" class="clients_28"></a></li><!-- chuangxingongchang  -->
        <li><a href="#" class="clients_2"></a></li><!-- baofeng -->
        <li><a href="#" class="clients_65"></a></li><!-- diaochapai -->
        <li><a href="#" class="clients_30"></a></li><!-- luowuzhe -->
        <li><a href="#" class="clients_18"></a></li><!-- chinaz -->

    </ul>
   </div>

</section>


<section class="features">
  <ul>
    <li>
      <span class="block">
        <h3>实时生效</h3>
        <p>修改解析，仅需 10 秒就可以同步到所有 DNS 服务器，快如闪电</p>
        <div class='down' id='feature-2-b'></div>
        <div class='up' id='feature-2-a'></div>
      </span>
    </li>
    <li>
      <span class="block">
        <h3>智能提速</h3>
        <p>我们拥有权威的地址库，99.99%精确匹配，最大可能提升访问速度</p>
        <div class='down' id='feature-4-b'></div>
        <div class='up' id='feature-4-a'></div>
      </span>
    </li>
    <li>
      <span class="block">
        <h3>7x24小时服务</h3>
        <p>EflyDNS 提供 7x24 技术运维团队，时刻在线，快速为您排忧解难</p>
        <div class='down' id='feature-5-b'></div>
        <div class='up' id='feature-5-a'></div>
      </span>
    </li>
    <li>
      <span class="block">
        <h3>永久免费</h3>
        <p>您可以将所有域名放在EflyDNS统一管理，任意添加解析</p>
        <div class='down' id='feature-1-b'></div>
        <div class='up' id='feature-1-a'></div>
      </span>
    </li>
    <li>
      <span class="block">
        <h3>永不宕机</h3>
        <p>EflyDNS支持多机房云计算集群自动宕机迁移，永远在线</p>
        <div class='down' id='feature-3-b'></div>
        <div class='up' id='feature-3-a'></div>
      </span>
    </li>
    <li>
      <span class="block">
        <h3>丰富的扩展功能</h3>
        <p>无论域名实时监控、混合泛解析、域名锁定、域名共享别名还是用户自定义功能，满足您任何细致需求</p>
        <div class='down' id='feature-6-b'></div>
        <div class='up' id='feature-6-a'></div>
      </span>
    </li>
  </ul>
</section>


<section class="features_p">
  <div class="page-stage fea-cont">
    <div class="summary">
      <p><strong>众多大型网站域名的选择，个人用户永久免费享用！</strong></p>
      <p>依托睿江集团技术实力、集多年互联网专业服务技术沉淀<br>倾力打造的新一代智能DNS解析系统。</p>
    </div>
    <div class="fea-block fea-1">
      <h2 class="title">极速</h2>
      <p><strong>解析实时生效<br>多线路智能分配</strong></p>
      <p>只需一点，即可让您的域名解析记录修改在瞬间更新，无论是联通、电信、移动、教育网还是国外的用户，我们都能智能匹配最佳解析地址，让您的网站访问者获得最为流畅的访问体验！</p>
    </div>
    <div class="fea-block fea-2">
      <h2 class="title align-right">可靠</h2>
      <p class="align-right"><strong>99.99%可靠性承诺<br>安心每一刻</strong></p>
      <p>拥有自建IDC机房，具备专业级强大抗攻击防护能力，支持多机房云计算集群自动宕机迁移，配备系统性能监测实时报警，确保域名解析服务的稳定有效，为您域名的每一次的访问保驾护航！</p>
    </div>
    <div class="fea-block fea-3">
      <h2 class="title">贴心</h2>
      <p><strong>最专业的运维客服团队<br>7x24小时保驾护航</strong></p>
      <p>拥有强大的运维和客服团队，时刻监控服务器和客户业务的正常运行，无论您遇到任何故障和难题，我们的24小时客服团队都会及时为您进行处理排障，让您轻松驾驭域名解析服务！</p>
    </div>
  </div>
</section>

<section class="more-features">
  <div class="page-stage">
    <h2 class="title">EflyDNS，您域名托管的最佳选择！</h2>
    <p class="descp">我们所做的一切，皆旨在为用户提供最大的价值</p>
  </div>
</section>


<section class="ft-entrance J_ftEntrance">
    <div class="inner">         
      <a class="btn2 btn-primary2 btn-enter2" href="http://www.eflydns.com/client/Index/login">立即使用</a>
      <a class="link" href="http://www.eflydns.com/client/Index/register">免费注册账号</a> 
    </div>
</section>

<!--
<section class="enterprise">
  <a href="#" class="block">
    <h2>企业用户</h2>
    <p>我们不仅有面向个人网站的免费服务，还有专门为企业量身打造的付费服务。独享DNS服务器<br/>集群，100% SLA。</p>
    <p class="contact-header">你可以 <span>了解更多详情</span>，或立即在线咨询</p>
  </a>
  <div class="contact">
    <img src="__ROOT__/Public/images/phone.gif" width="15" height="15" alt="使用400电话联系 EflyDNS" />
    <span>400-066-2212</span>
    <a href="tencent://message/?uin=1207197276&Site=wendns.com&Menu=yes"><img src="__ROOT__/Public/images/qq.gif" width="15" height="16" alt="1207197276"> <span>1207197276</span></a>
  </div>
</section>
-->

<script>
  seajs.use('jquery.js', function($) {

   window.jQuery = window.$ = $;

   /*
    Color animation jQuery-plugin
    http://www.bitstorm.org/jquery/color-animation/
    Copyright 2011 Edwin Martin <edwin@bitstorm.org>
    Released under the MIT and GPL licenses.
   */
   (function(d){function i(){var b=d("script:first"),a=b.css("color"),c=false;if(/^rgba/.test(a))c=true;else try{c=a!=b.css("color","rgba(0, 0, 0, 0.5)").css("color");b.css("color",a)}catch(e){}return c}function g(b,a,c){b = b ? b : [0,0,0,0];var e="rgb"+(d.support.rgba?"a":"")+"("+parseInt(b[0]+c*(a[0]-b[0]),10)+","+parseInt(b[1]+c*(a[1]-b[1]),10)+","+parseInt(b[2]+c*(a[2]-b[2]),10);if(d.support.rgba)e+=","+(b&&a?parseFloat(b[3]+c*(a[3]-b[3])):1);e+=")";return e}function f(b){var a,c;if(a=/#([0-9a-fA-F]{2})([0-9a-fA-F]{2})([0-9a-fA-F]{2})/.exec(b))c=[parseInt(a[1],16),parseInt(a[2],16),parseInt(a[3],16),1];else if(a=/#([0-9a-fA-F])([0-9a-fA-F])([0-9a-fA-F])/.exec(b))c=[parseInt(a[1],16)*17,parseInt(a[2],16)*17,parseInt(a[3],16)*17,1];else if(a=/rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/.exec(b))c=[parseInt(a[1]),parseInt(a[2]),parseInt(a[3]),1];else if(a=/rgba\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9\.]*)\s*\)/.exec(b))c=[parseInt(a[1],10),parseInt(a[2],10),parseInt(a[3],10),parseFloat(a[4])];return c}d.extend(true,d,{support:{rgba:i()}});var h=["color","backgroundColor","borderBottomColor","borderLeftColor","borderRightColor","borderTopColor","outlineColor"];d.each(h,function(b,a){d.fx.step[a]=function(c){if(!c.init){c.a=f(d(c.elem).css(a));c.end=f(c.end);c.init=true}c.elem.style[a]=g(c.a,c.end,c.pos)}});d.fx.step.borderColor=function(b){if(!b.init)b.end=f(b.end);var a=h.slice(2,6);d.each(a,function(c,e){b.init||(b[e]={a:f(d(b.elem).css(e))});b.elem.style[e]=g(b[e].a,b.end,b.pos)});b.init=true}})(jQuery);


   $(function(){
      var ua = $.browser;
      if ( !(ua.msie && ua.version.slice(0,1) == "6") ) {

         $('.features .block').hover(function() {
            $(this).find('.up').animate({
               opacity: 0
            }, 400);
         },function(){
            $(this).find('.up').animate({
               opacity: 1
            }, 120);
         });
      }
   });

   $(function(){

   /*rolling the logos

    function repeat(str, num) {
        return new Array( num + 1 ).join( str );
    }

   !function () {
        var $wrapper = $('.clients-display').css('overflow', 'hidden'),

            $slider = $wrapper.find('> ul'),
            $items = $slider.find('> li'),
            $single = $items.filter(':first'),

            singleWidth = $single.outerWidth(),
            visible = Math.ceil($wrapper.innerWidth() / singleWidth),
            currentPage = 1,
            pages = Math.ceil($items.length / visible);

        if (($items.length % visible) != 0) {
            $slider.append(repeat('<li class="empty" />', visible - ($items.length % visible)));
            $items = $slider.find('> li');
        }

        $items.filter(':first').before($items.slice(- visible).clone().addClass('cloned'));
        $items.filter(':last').after($items.slice(0, visible).clone().addClass('cloned'));
        $items = $slider.find('> li'); // reselect

        $wrapper.scrollLeft(singleWidth * visible);

        function gotoPage(page) {
            var dir = page < currentPage ? -1 : 1,
                n = Math.abs(currentPage - page),
                left = singleWidth * dir * visible * n;

            $wrapper.filter(':not(:animated)').animate({
                scrollLeft : '+=' + left
            }, 700, function () {
                if (page == 0) {
                    $wrapper.scrollLeft(singleWidth * visible * pages);
                    page = pages;
                } else if (page > pages) {
                    $wrapper.scrollLeft(singleWidth * visible);
                    // reset back to start position
                    page = 1;
                }

                currentPage = page;
            });

            return false;
        }

        $('.arrow.previous').click(function () {
            return gotoPage(currentPage - 1);
        });

        $('.arrow.next').click(function () {
            return gotoPage(currentPage + 1);
        });

        $(this).bind('goto', function (event, page) {
            gotoPage(page);
        });

        setInterval(function(){
          return gotoPage(currentPage + 1);
        },7000);
    }();
    */

   });


   /*rolling the banner*/
   (function(){


      !function($){

  "use strict"

    $.support.transition = (function () {
      var thisBody = document.body || document.documentElement
        , thisStyle = thisBody.style
        , support = thisStyle.transition !== undefined || thisStyle.WebkitTransition !== undefined || thisStyle.MozTransition !== undefined || thisStyle.MsTransition !== undefined || thisStyle.OTransition !== undefined

      return support && {
        end: (function () {
          var transitionEnd = "TransitionEnd"
          if ( $.browser.webkit ) {
          	transitionEnd = "webkitTransitionEnd"
          } else if ( $.browser.mozilla ) {
          	transitionEnd = "transitionend"
          } else if ( $.browser.opera ) {
          	transitionEnd = "oTransitionEnd"
          }
          return transitionEnd
        }())
      }
    })()


 /* CAROUSEL CLASS DEFINITION
  * ========================= */
  var Carousel = function (element, options) {
    this.$element = $(element)
    this.options = $.extend({}, $.fn.carousel.defaults, options)
    this.options.slide && this.slide(this.options.slide);


    //change header bg "ClassName#Color"
    //this.colorArr = ['#0d1216','#062C5B','#bdc2c6','#fff'];
    this.colorArr = ['#062C5B','#0d1216'];
    //add background color animation
    if(this.colorArr){
      var arr = this.colorArr;
      var color;
      if(/^#\w*/.test(arr[0])){
        color = arr[0];
      }else{
        var opt = arr[0].split('#');
        color = opt[1] ? ('#'+opt[1]) : '#4fa6e7';
      }
      var patt = /^#([\da-fA-F]{2})([\da-fA-F]{2})([\da-fA-F]{2})$/;
      var matches = patt.exec(color);
      var rgb = "rgb("+parseInt(matches[1], 16)+","+parseInt(matches[2], 16)+","+parseInt(matches[3], 16)+")";
      $('header').css({"backgroundColor": rgb});
    }

    var that = this;
    this.$element.on('to',function(e,id){
      that.to(id);
    });
  }

  Carousel.prototype = {

    cycle: function () {
      this.interval = setInterval($.proxy(this.next, this), 7000)
      return this
    }

  , to: function (pos) {
      var $active = this.$element.find('.active')
        , children = $active.parent().children()
        , activePos = children.index($active)
        , that = this

      if (pos > (children.length - 1) || pos < 0) return

      if (this.sliding) {
        return this.$element.one('slid', function () {
          that.to(pos)
        })
      }

      if (activePos == pos) {
        return this.pause().cycle()
      }

      return this.slide(pos > activePos ? 'next' : 'prev', $(children[pos]))
    }

  , pause: function () {
      clearInterval(this.interval)
      return this
    }

  , next: function () {
      if (this.sliding) return
      return this.slide('next')
    }

  , prev: function () {
      if (this.sliding) return
      return this.slide('prev')
    }
  , changebg: function(nextPos, arr){
      var color,classname;
      if(/^#\w*/.test(arr[nextPos])){
        color = arr[nextPos];
      }else{
        var opt = arr[nextPos].split('#');
        classname = opt[0] ? opt[0] : 'origin';
        color = opt[1] ? ('#'+opt[1]) : '#4fa6e7';
      }
      $('header').removeAttr('class').css({
         "backgroundImage":'none'
      }).stop().animate({
         "backgroundColor": color
      }, 700, function(){
          if(classname){
            $(this).css({"backgroundImage": ""}).addClass(classname);
          }
      });
  }

  , slide: function (type, next) {
      var $active = this.$element.find('.active')
        , $next = next || $active[type]()
        , isCycling = this.interval
        , direction = type == 'next' ? 'left' : 'right'
        , fallback  = type == 'next' ? 'first' : 'last'
        , children = $active.parent().children()
        , nextPos = children.index($next) < 0 ? 0: children.index($next)
        , that = this;

        //change header bg
        if(this.colorArr) this.changebg(nextPos, this.colorArr);

      //四周年活动banner，背景渐变
      /*  if (nextPos === 0) {
            $('header').removeAttr('class').css({
               'backgroundImage':'none',
            }).animate({
               backgroundColor:'#f4594f'
            }, 700);
        }else if (nextPos === 1) {
            $('header').removeAttr('class').animate({
               backgroundColor:'#4fa6e7'
            }, 700, function(){
               $(this).css({'backgroundImage':''}).addClass('origin');
            })
        }else if (nextPos === 2) {
            $('header').removeAttr('class').animate({
               backgroundColor:'#ffd401'
            }, 700, function(){
               $(this).css({'backgroundImage':''}).addClass('year4_1');
            })
        }else if (nextPos === 3) {
            $('header').removeAttr('class').css({
               'backgroundImage':'none',
            }).animate({
               backgroundColor:'#f75f54'
            }, 700);
        } else {
            $('header').removeAttr('class').css({
               'backgroundImage':'none',
            }).animate({
               backgroundColor:'#d04759'
            }, 700);
        }
      */
      this.sliding = true

      isCycling && this.pause()

      $next = $next.length ? $next : this.$element.find('.item')[fallback]()

      if (!$.support.transition && this.$element.hasClass('slide')) {
        this.$element.trigger('slide')
        $active.removeClass('active')
        this.$element.trigger('slide',nextPos)
        $next.addClass('active')
        this.sliding = false
        this.$element.trigger('slid')
      } else {
         $active.fadeTo(600,0.1,function(){
            $active.css('opacity',1);
         });
        $next.addClass(type)
        $next[0].offsetWidth // force reflow
        $active.addClass(direction)
        $next.addClass(direction)
        this.$element.trigger('slide',nextPos)
        this.$element.one($.support.transition.end, function () {
          $next.removeClass([type, direction].join(' ')).addClass('active')
          $active.removeClass(['active', direction].join(' '))
          that.sliding = false
          setTimeout(function () { that.$element.trigger('slid') }, 0)
        })
      }

      isCycling && this.cycle()

      return this
    }

  }


 /* CAROUSEL PLUGIN DEFINITION
  * ========================== */

  $.fn.carousel = function ( option ) {
    return this.each(function () {
      var $this = $(this)
        , data = $this.data('carousel')
        , options = typeof option == 'object' && option
      if (!data) $this.data('carousel', (data = new Carousel(this, options)))
      if (typeof option == 'number') data.to(option)
      else if (typeof option == 'string' || (option = options.slide)) data[option]()
      else data.cycle()

    })
  }

  $.fn.carousel.defaults = {
    interval: 5000
  }

  $.fn.carousel.Constructor = Carousel



//start
      $(function(){

         var ua = $.browser;
         //if not ie6
         if ( !(ua.msie && ua.version.slice(0,1) == "6") ) {


            // wrap our new image in jQuery, then:
            $('.ue-recrew')
               // once the image has loaded, execute this code
               .load(function () {

                  var a = $('#myCarousel'),b = $('.banner-nav');

                  a.carousel();

                  b.show();

                  a.find('.item').each(function(){
                     b.find('ul').append('<li ><a data-id="' + b.find('li').length + '" class="" href="#"></a></li>');
                  });

                  $(b.find('li')[0]).find('a').addClass('active');

                  a.on('slide',function(e,pos){
                     b.find('a').removeClass('active');
                     $(b.find('li')[pos]).find('a').addClass('active');
                  });

                  b.find('li a').on('click',function(e){
                        e.preventDefault();
                        a.trigger('to',$(e.target).data('id'));
                  })

               })
                  // if there was an error loading the image, react accordingly
               .error(function () {
                     // notify the user that the image could not be loaded
               })
               // *finally*, set the src attribute of the new image to our image
               .attr('src',$('.ue-recrew').data('src'));


         }


      });



}($);



})();/*------rolling the banner-------------*/



  });/*end of seajs*/


</script>

      </div>


	
    <!-- footer ================================================== -->
        <!-- <footer> -->
      <!--
      <nav>
        <ol class="breadcrumbs">
            <li class="home">首页</li>
        </ol>

        <div class="directorynav">
          <div id="dn-cola" class="column first">
            <h3>为什么使用 EflyDNS</h3>
            <ul>
              <li><a href="#">谁在使用 EflyDNS</a></li>
              <li><a href="#">快速入门</a></li>
            </ul>
          </div>
          <div id="dn-colb" class="column">
            <h3>产品介绍</h3>
            <ul>
              <li><a href="#">智能 DNS</a></li>
              <li><a href="#">D监控</a></li>
              <li><a href="#">D令牌</a></li>
              <li><a href="#">套餐服务</a></li>
              <li><a href="#">企业服务</a></li>
            </ul>
          </div>
          <div id="dn-colc" class="column">
            <a href="#"><h3>帮助中心</h3></a>
            <ul>
              <li><a href="#">常见问题</a></li>
              <li><a href="#">DNS 工具</a></li>
              <li><a href="#">服务器状态</a></li>
              <li><a href="#">本地DNS优化</a></li>
            </ul>
          </div>
          <div id="dn-cold" class="column">
            <h3>其他</h3>
            <ul>
              <li><a href="#">API</a></li>
              <li><a href="#">客户端</a></li>
              <li><a href="#">手机版</a></li>
              <li><a href="#">开源</a></li>
            </ul>
          </div>
          <div id="dn-cole" class="column">
            <h3>关于</h3>
            <ul>
              <li><a href="#">关于我们</a></li>
              <li><a href="#">官方博客</a></li>
              <li><a href="#">工作机会</a></li>
              <li><a href="#">合作伙伴</a></li>
              <li><a href="#">友情链接</a></li>
            </ul>
          </div>
          <div id="dn-colf" class="column last">
            <h3>联系我们</h3>
            <ul>
              <li>   
                <a href="#">80000000</a>
              </li>
              <li><a href="#">技术支持</a></li>
              <li><a href="#">投诉建议</a></li>
              <li class="weibo">
                 <a href="#"></a>  
                 <a href="#"></a> 
                 <a href="#"></a> 
                 <a href="#"></a> 
                 <a href="#"></a> 
              </li>
            </ul>
          </div>
          <div class="c"></div>
        </div>
      </nav>
      -->

      <!--
      <section class="links">
        <h3><a href="#">合作伙伴：</a></h3>
        <a href="#">站长之家</a>
        <a href="#">海波IDC</a>
        <a href="#">站长网</a>
        <a href="#">英拓网络</a>
        <a href="#">中客科技</a>
        <a href="#">BGP双线</a>
        <a href="#">零刻数据</a>
        <a href="#">亚洲诚信</a>
        <a href="#">炎黄网络</a>
        <a href="#">五月广告联盟</a>
        <a href="#">腾佑科技</a>
        <a href="#">维派科技</a>
        <a href="#">51IDC</a>
        <a href="#">虚拟主机</a>
        <a href="#">cnBeta</a>
      </section>
      -->
      
      <!--       
      <section class="copyright">
        <div><span style="font-family: arial;font-size: 14px;">©</span> 2007-2014 广东睿江科技有限公司版权所有</div>
        
        <div>&copy; 2014 <a href="#">Report Abuse</a> </div>
        <div>SSL Powered by <a href="#">TrustAsia</a></div>
        <div>• 昨天共提供了<a href="#">17,690,777,127</a>次查询服务 • 今年提供了3,406,230,418,485次查询服务</div>
        </table>
      </section> 
      -->
    <!-- </footer> -->

      <style>
        #footerdiv {
            width: 100 % ;
            min-width: 1000px;
            background-color: #2e2e2e;
            background-image: url(__ROOT__/Public/images/footbg.jpg);
            background-repeat: repeat-x;
            background-position: top;
            font-size: 12px;
            font-family: "Microsoft YaHei", Arial, Helvetica, sans-serif;
        }
        #footer {
            width: 1000px;
            margin: 0 auto;
            text-align: left;
            color: #999999;
            padding: 20px 0px 10px;
        }
        #footer #fleft {
            width: 600px;
            float: left;
            line-height: 25px;
        }
        #footer #fmiddle {
            width: 24px;
            float: right;
            line-height: 26px;
            padding-top: 10px;
            padding-right: 10px;
        }
        #footer #fright {
            margin-top: 7px;
            line-height: 18px;
            width: 300px;
            height: 36px;
            font-size: 13px;
            padding-left: 28px;
            float: right;
            background-image: url(__ROOT__/Public/images/tel.jpg);
            background-repeat: no-repeat;
            background-position: left;
        }
        #footer #fright #worktime {
            font-size: 11px;
        }
        #footer #fright li {
            float: left;
            padding-left: 10px;
            line-height: 18px;
        }
      </style>

      <footer>
        <section id="footerdiv">
          <div id="footer">
              <span id="fleft">
                  Copyright © 广东睿江科技有限公司 粤ICP备09026812号&nbsp;&nbsp;ISO9001国际标准质量管理体系认证
                  <br>
                  增值电信业务经营许可证(IDC、ISP) 编号：粤B1.B2-20070326
              </span>
              <span id="fright">
                  <ul>
                      <li>
                          全国客户服务热线
                          <br>
                          <font id="worktime">
                              TIME: 7*24 HOURS
                          </font>
                      </li>
                      <li>
                          <img src="__ROOT__/Public/images/telnum.jpg" width="164" height="32">
                      </li>
                  </ul>
              </span>
              <span id="fmiddle">
                  <a href="tencent://message/?uin=1207197276">
                      <img border="0" src="__ROOT__/Public/images/qq.jpg" alt="" width="24" height="26">
                  </a>
              </span>
              <div style="clear: both; font-size: 0px; line-height: 0px; height: 0px;"></div>
          </div>
        </section>
      </footer>


       <style>
         #feedback {
           position:fixed;
           right:20px;
           top:92%;
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

      <div id="feedback" style="cursor:pointer;[displayfb]" onclick="location='tencent://message/?uin=1207197276';">
        <a href="javascript:void(0);">客服咨询</a>
      </div>


      <script type="text/javascript">

        //获取浏览器窗口尺寸，通用！
        function findDimensions() //函数：获取尺寸
        {
          // 获取窗口宽度
          if (window.innerWidth)
            winWidth = window.innerWidth;
          else if ((document.body) && (document.body.clientWidth))
            winWidth = document.body.clientWidth;
          
          // 获取窗口高度
          if (window.innerHeight)
            winHeight = window.innerHeight;
          else if ((document.body) && (document.body.clientHeight))
            winHeight = document.body.clientHeight;
                   
          // 通过深入Document内部对body进行检测，获取窗口大小
          if (document.documentElement  && document.documentElement.clientHeight && document.documentElement.clientWidth)
          {
                winHeight = document.documentElement.clientHeight;
                winWidth = document.documentElement.clientWidth;
          }

          return {"winWidth": winWidth, "winHeight": winHeight};
        }

        var footer = document.getElementById('footerdiv');

        //底部自适应，保持在屏幕底部(不出滚动条时)，或在文档最底(出滚动条时)
        var intervalId = setInterval(function(){
          //console.log(new Date().getTime());

          var size = findDimensions();

          if(size.winHeight < document.body.offsetHeight){
            //出现滚动条
            footer.className = '';
            //clearInterval(intervalId);//出现滚动条后停止任务
          }else{
            footer.className = 'fix_bottom';
          }
        }, 300);

      </script>

      <!-- 百度统计 -->
      <div style="display:none;">
        <script type="text/javascript">
            var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
            document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F4507d6bdc805c13e1bdbbe784201ee2f' type='text/javascript'%3E%3C/script%3E"));
        </script>
      </div>
      

   

<!-- UserAgent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36 -->

<!--
<script type="text/javascript">
  (function(){
    try{
      if(window.console && window.console.log){
        console.log('             Qv.                                                      \n             ZBjIjv;           ..,..                                  \n              @yizero.mFLIEmQ0qFFzSuFFZZqFSl;                         \n              yBzl;vvvczFIv;::,:,:::::::: @haohu.                     \n               BZFCvvvc;:,::;;;;;;;:;:;;;;     ;Zbu.                  \n               7BuNNv7;::;;;;:::,,,,,::::;;       IBO.                \n              .D0zFv7;::;:,.:;v7jjVyCslv;:::;.    .:jBF               \n             :BqVNvvv:::,;sCzZFuIysLsVzZZ0Fl;;:;;v;;,:0B              \n             bZVFlv7v,.vmOSBs           ..;bB0z:,;;;;:.jB             \n            @kevensun.SBv  BjQ:          vEEq VBl,:;;;:.jB            \n            BFzFs;7vvZb   sI  0b;      ;bF  B  ,BI,:;;;:.BV           \n            BFVFvvvvvB.   D.  ;bCm:  ;0Nb   N;  .B;:;;;;.lB           \n            bNzFvv7vlB.   BZ  q;  EO8F  R   Bj   #N.;;;;:;B           \n            0ByF7vvv;bF   BBBCb   @Wwz  7qSBBD   B7:;;;;,7B           \n         lRu7BNzV;vvvvBZ ;BBBBR ;B;  vB  bBBBB  BE,:;;;,,BZ           \n        Eb:. ;BFzj;vvv;0EBBBBB;:D     .#:RBBBBNRS,:;;;,:ZB            \n       mE.,,: ;REylvvvv;vLObBBbz        NBBBBDC;.:::::;EB,            \n       B..,:::..SbFc;vvvv;:;vCENZOZNFZNSy0s;.  ,,::;;IBB              \n       D8:.,:,,  ;O#F;;;vvv;;;;v7ljjyjsv;,,,;;;;v;vsRBl  ,vvvv;       \n        lDOl;vsu;  :jbF7;;;;;vvvvvvvvvvvvvvvvv;v7V8BV  ;bZsjsjzBl     \n          ;ySVlvEEc .BOBbZzlv;;;;;;;;;;;;;vvsjNEDbBl7suq;.,,,,.,B;    \n                 ,IZBQc8EF0R @guohezou.08DRDQ#BsZ0  ...,:::::,.Ez    \n                    BRV#OjzVFuDBbbbQENZZEZqSuLN8sqB.;;;,,,::::: DC    \n                    .ZOBQSzIcv;RZ.vyIVCClvvyVzZBqB#jCuVBs,.,,,.vb,    \n                       7#;v;v;;;0s     ;7qF:vvOQv,       @arqiao.     \n                       lq,;;;;;:EQ ;BEb  R7;;,Ss          ,:,,        \n                       LBjuVSVCOB ,BEB; zBsyFzBy                      \n                       uBzVFzzNB       ,BVmBbbBBc                     \n                       zBCuzuCBmvzZOQ8bBFO8v;;  7EC                   \n                       SBCICsLLVNZZZFFjIBF:;vv    #Z                  \n                       .RNFzzy @kexianli.:;;;v7;;,0b                  \n                            BEuuIBj    BOFCjcllyI#B.                  \n                            Bs;;;CB.   :@secbone.b                    \n                           RZvv7;;vQR    IBB#RbBy                     \n                          BZ;v7v,.. Bc     :vv;                       \n                          RL;;vv;;:;NZ                                \n                          Fmv7l7ssIjqBBqv                             \n                         NBBOzIVVSu0bBbBBB                            \n                         jBbBBBbBbBBBBBBBB                            \n                           .vuqQ8DQEZuc;                              \n\n');
        console.log('Hi~ 欢迎加入EflyDNS，简历请发送至 %c hr@EflyDNS.com','color:#4FA6E7');
      }
    }catch(e){}
  })()
</script>
-->

<!--
<script>
    (function(){
        if (!window.addEventListener) return;
        window.addEventListener('load', function(){
            var performance = window.performance;
            if (performance === undefined) return;
            timing = window.performance.timing;
            if (timing === undefined) return;

            if (document.cookie.indexOf('statistics_clientid=') != -1) return;

            var domain_lookup_time = timing.domainLookupEnd - timing.domainLookupStart;
            var connect_time = timing.connectEnd - timing.connectStart;
            var read_content_time = timing.responseEnd - timing.responseStart;

            new Image().src = ('https:' == document.location.protocol ? 'https://' : 'http://')
                + 'stat.EflyDNS.cn/statistics/'
                + domain_lookup_time + "/" 
                + connect_time + "/" 
                + read_content_time + ".png"; 

            var exdate=new Date();
            exdate.setDate(exdate.getDate() + 1);
            document.cookie="statistics_clientid=me" 
            + ";expires="+exdate.toGMTString();

        }, false);
    }());
</script>
-->


</body>
</html>
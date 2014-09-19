<?php if (!defined('THINK_PATH')) exit();?>
                  <div class="help_item">
                      <div class="help_item_text">
                       
                       <p>什么情况下会用到CNAME记录？</p>
<p style="color:#B0A0A0;">［如果需要将域名指向另一个域名，再由另一个域名提供ip地址，就需要添加CNAME记录］</p>
<p style="color:#B0A0A0;">像CDN，企业邮局等都经常要用到CNAME。  </p>
<p>&nbsp;</p>
<p>CNAME记录的添加方式</p>
<p><img src="__ROOT__/Public/images/help/qp/q33-1.jpg" width="100%"/></p>
<p>A.主机记录处填子域名（比如需要添加www.test.com的解析，只需要在主机记录处填写www即可；如果只是想添加test.com的解析，主机记录直接留空，填入一个“@”到输入框内即可；如果想对所有以test.com结尾的域名解析生效，填入一个“*”到输入框内即可）</p>
<p>B.记录类型为CNAME</p>
<p>C.线路类型（默认为必填项，否则会导致部分用户无法解析；可根据对应运营商填写需要的解析结果，如无特殊要求，选择默认即可）</p>
<p>D.记录值为域名地址</p>
<p>E.MX优先级不需要填写</p>
<p>F.TTL不需要填写，添加时系统会自动生成，默认为10分钟</p>


                      </div>
                  </div>
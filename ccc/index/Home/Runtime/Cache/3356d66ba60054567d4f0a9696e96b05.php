<?php if (!defined('THINK_PATH')) exit();?>
                  <div class="help_item">
                      <div class="help_item_text">
                        
<p>什么情况下会用到TXT记录？</p>
<p style="color:#B0A0A0;">[如果希望对域名进行标识和说明，可以使用TXT记录，绝大多数的TXT记录是用来做SPF记录（反垃圾邮件）] </p>
<p>&nbsp;</p>
<p>TXT记录的添加方式</p>
<p><img src="__ROOT__/Public/images/help/qp/q36-1.jpg" width="100%"/></p>
<p>A.主机记录处填子域名（比如需要添加www.test.com的解析，只需要在主机记录处填写www即可；如果只是想添加test.com的解析，主机记录直接留空，填入一个“@”到输入框内即可；如果想对所有以test.com结尾的域名解析生效，填入一个“*”到输入框内即可）</p>
<p>B.记录类型为TXT</p>
<p>C.线路类型（默认为必填项，否则会导致部分用户无法解析；TXT记录不需要智能解析，直接默认即可）</p>
<p>D.记录值并没有固定的格式，不过大部分时间，TXT记录是用来做SPF反垃圾邮件的</p>
<p>最典型的spf格式的txt记录例子为“v=spf1 a mx ~all”，表示只有这个域名的a记录和mx记录中的ip地址有权限使用这个域名发送邮件</p>
<p>E.MX优先级不需要填写</p>
<p>F.TTL不需要填写，添加时系统会自动生成，默认为10分钟</p>


                      </div>
                  </div>
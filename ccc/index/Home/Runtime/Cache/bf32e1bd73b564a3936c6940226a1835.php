<?php if (!defined('THINK_PATH')) exit();?>
                  <div class="help_item">
                      <div class="help_item_text">
                          <p>
                                TXT的主要应用是SPF（Sender Policy Framework）反垃圾邮件。SPF的内容写在TXT记录里面。MX记录的作用是给寄信者指明某个域名的邮件服务器有哪些。SPF的作用则与MX相反，它向收信者表明，哪些邮件服务器是经过某个域名认可会发送邮件的。SPF的作用主要是反垃圾邮件，主要针对那些发信人伪造域名的垃圾邮件。例如：当邮件服务器收到自称是kk@gmail.com的邮件，那么它到底是不是gmail.com的邮件服务器发过来的呢，我们就可以查询gmail.com的SPF记录，一次防止别人伪造您来发邮件。
                          </p>
                      </div>
                  </div>
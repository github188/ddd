<?php if (!defined('THINK_PATH')) exit();?>
                  <div class="help_item">
                      <div class="help_item_text">
                          <p>当我们想获取一个域名对应的IP地址，或通过域名方式访问某一网页或程序，此时就需要在这个域名和所属的IP地址间创建一个映射关系。这个关系就是利用在DNS中为此名称创建的A记录。我们可以为一个域名添加多个IP，同一IP也可以对应多个主机名。</p>

                          <p><img src="__ROOT__/Public/images/help/qp/q2-1.png"/></p>
  
  
    <p>例如，我们已知gdzjwl.net该域名的IP地址为121.9.212.124.我们设主机名为www，IP地址为121.9.212.124。创建了一条A记录，当访问www.gdzjwl.net或者当我们访问www.dou.gdzjwl.net，DNS服务器都会自动解析到IP为121.9212.124的主机。</p>
    
    <p>提到A记录，也有些小技巧。当主机记录输入@的时候，DNS会直接解释到主域名地址即当建立这条A记录，我们访问gdzjwl.net时就会访问到121.9.214.124的IP地址。</p>

    <p><img src="__ROOT__/Public/images/help/qp/q2-2.png"/></p>

    <p>还有当我们在主机记录输入*时，之下所设的*.gdzjwl.net全部解析到同一个IP地址上去。 即访问aaa.gdzjwl.net（并没有设aaa.gdzjwl.net的A记录），也会自已自动解析到与gdzjwl.net同一个IP地址上去。</p>

    <p>总的来说，A记录即Address（地址）记录，目的是标识出一条特定的域名到IP地址的记录。</p>
                      </div>
                  </div>
# vercel_xss_platform
基于vercel Serverless Functions搭建的无服务xss平台

## XSS平台
通过github和vercel的Serverless Functions功能，可以搭建一个永久免费、闭源、匿名的XSS平台

### 1.vercel Serverless Functions
使用Vercel ，您可以部署Serverless Functions，这是用后端语言编写的代码片段，这些代码接受HTTP请求并提供响应。

您可以使用Serverless Functions来处理用户身份验证，表单提交，数据库查询等。

了解详情：[Serverless Functions](https://vercel.com/docs/serverless-functions/introduction)

### 2.XSS平台代码

基于蓝莲花的 [BlueLotus_XSSReceiver](https://github.com/firesunCN/BlueLotus_XSSReceiver)

我修改完支持vercel的代码 [vercel_xss_platform](https://github.com/veo/vercel_xss_platform)
### 3.改造

Serverless Functions在解析php代码时是这种形式

    php -c php.ini -S 127.0.0.1:8000 -t /var/task/user/api/index.php

只会解析一个php文件，如果多个文件则会启用多个Serverless服务来解析，所以为了保证服务正常，需要建一个路由，通过设置index.php和vercel.json可以达到目的

![](https://xwhoami.com/img/vercelxss/2021-03-11-16-04-41.png)
![](https://xwhoami.com/img/vercelxss/2021-03-11-16-06-15.png)

由于部署以后文件不可写入，读取也有些问题，修改了一些其他细节
### 4.设置

在目录下 新建/修改 config.php文件，DATA_PATH必须为tmp，因为只有tmp目录可写
![](https://xwhoami.com/img/vercelxss/2021-03-11-16-09-40.png)


## 安装

### 1.登录github，fork项目
[https://github.com/veo/vercel_xss_platform](https://github.com/veo/vercel_xss_platform)

PS: fork的项目为public，也可以自己建立一个private项目把文件push上去，vercel免费支持private项目
### 2.使用github账户注册/登录vercel
https://vercel.com/

### 3.导入项目并部署
为了安全起见可以选择只导入vercel_xss_platform项目
![](https://xwhoami.com/img/vercelxss/2021-03-11-16-21-25.png)
![](https://xwhoami.com/img/vercelxss/2021-03-11-16-22-48.png)
![](https://xwhoami.com/img/vercelxss/2021-03-11-16-25-06.png)
![](https://xwhoami.com/img/vercelxss/2021-03-11-16-26-27.png)

### 4.部署成功打开/login.php即可登录
![](https://xwhoami.com/img/vercelxss/2021-03-11-16-27-32.png)
![](https://xwhoami.com/img/vercelxss/2021-03-11-16-29-18.png)

### 5.设置域名
vercel 支持设置自己的域名
![](https://xwhoami.com/img/vercelxss/2021-03-11-16-30-05.png)

### 6.修改config.php文件，template里面js的website地址

生成登录密码

    php -r '$salt="!KTMdg#^^I6Z!deIVR#SgpAI6qTN7oVl";$key="你的密码";$key=md5($salt.$key.$salt);$key=md5($salt.$key.$salt);$key=md5($salt.$key.$salt);echo $key;'

![](https://xwhoami.com/img/vercelxss/2021-03-11-16-39-11.png)
修改完成以后 git push到github上，vercel会自动重新部署

### 7.缺陷
由于Serverless服务器会在接口一段时间不使用时关闭，所以保存的xss记录、保存的会话都会丢失失效，建议使用邮件通知功能，这样基本上也不需要登录后台了


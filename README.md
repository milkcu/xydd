# XiaoYuanDingDang

校园叮当是一款基于SinaAppEngine的校园社区平台，是参加齐鲁软件设计大赛的作品，并获得一等奖。系统基于PHP中Web Service的开源项目NuSOAP，使用新浪云平台SAE，采用模拟分布式的系统架构，实现了多终端跨平台的云端应用软件，其中包括PC网页版应用、移动网页版应用、Android客户端、微信公众平台等，还有面向开发者的Web服务接口。

项目讲解参见[Wiki](https://github.com/milkcu/xydd/wiki)。

## 安装部署

项目中使用了SAE提供的Memcache、Mail、Image等服务，通过创建多个应用模拟分布式的系统架构，为PC网页版应用、移动网页版应用、Android客户端、微信公众平台等提供服务。根目录下的各文件夹为各个分布式服务器中需要部署的文件，其中：

`xiaoyuandingdang`文件夹为[xiaoyuandingdang.sinaapp.com](http://xiaoyuandingdang.sinaapp.com/)服务器文件，该服务器为网页端服务器；  
`xyddapp`文件夹为[xyddapp.sinaapp.com](http://xiaoyuandingdang.sinaapp.com/)服务器文件，该服务器为安卓客户端服务器；  
`xyddext`文件夹为[xyddext.sinaapp.com](http://xyddext.sinaapp.com/)服务器文件，该服务器为微信公众账号服务器；  
`xyddws`文件夹为[xyddws.sinaapp.com](http://xyddws.sinaapp.com/)服务器文件，该服务器为Web Service服务器。

Web Service的WSDL语言描述详见<http://xyddws.sinaapp.com/nusoapService.php>

## 作品展示

该项目只是参赛作品，并未投入推广使用，可通过下面方式体验。

### 网页版应用

可使用电脑或手机访问下面地址：
<http://xiaoyuandingdang.sinaapp.com/>

### Android客户端

可通过访问下面的地址下载应用：
<http://xydd.sinaapp.com/xydd.apk>

### 微信公众账号

可搜索朋友`xiaoyuandingdang`关注使用。

## Android源码

Android客户端参考[eoe安卓客户端](https://github.com/eoecn/android-app/)完成，源码参见<https://github.com/milkcu/xydd-app>。

注：由于现在SAE禁用了socket和curl，需要把NuSOAP用于访问网络的代码改成用SAE的FetchURL实现，所以现在该项目暂时无法演示。

-EOF-

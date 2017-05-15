# whmcs-union
whmcs系统上使用银联的网关支付


### 如何使用

复制union.php文件到modules\gateways\下

复制union_callback.php和union_return.php文件到modules\gateways\callback\目录下

复制vendor2目录到whmcs系统的根目录下，及跟whmcs系统自带的vendor目录平级的目录（此处因为需要使用composer下载的依赖的原因）

进行vendor2目录，执行composer install ，安装相关依赖（liumapp/payment），请注意，对支付接口的封装是源于payment项目。

到whmcs后台配置相关参数即可。

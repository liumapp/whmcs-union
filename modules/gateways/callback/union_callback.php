<?php
/**
 * Created by PhpStorm.
 * User: liumapp
 * Email: liumapp.com@gmail.com
 * homePage: http://www.liumapp.com
 * Date: 4/25/17
 * Time: 3:44 PM
 */
include("../../../init.php");
include("../../../includes/functions.php");
include("../../../includes/gatewayfunctions.php");
include("../../../includes/invoicefunctions.php");
require_once("../../vendor2/vendor/autoloadLiumapp.php");

$gatewaymodule = "union"; # Enter your gateway module name here replacing template
$GATEWAY = getGatewayVariables($gatewaymodule);
if (!is_array($GATEWAY)) die("Module Not Activated"); # Checks gateway module is active before accepting callback

$callback = new unionCallBack();
$callback->name = $GATEWAY['name'];
$type = 'union_charge';
$config = [
    'merId' => $GATEWAY['unionMerId'],
    'sdk_sign_cert_path' => $GATEWAY['unionSignCertPath'],
    'sdk_sign_cert_pwd' => $GATEWAY['unionSignCertPwd'],
    'sdk_encrypt_cert_path' => $GATEWAY['unionEncryptCertPath'],
    'sdk_verify_cert_dir' => $GATEWAY['unionCertDir'],
    'frontUrl' => '',
    'backUrl' => '',
];

try {
    $ret = \liumapp\payment\client\Notify::run($type , $config , $callback);
} catch (\ErrorException $e) {
    echo 'false';
}
echo $ret;

class unionCallBack implements \liumapp\payment\notify\PayNotifyInterface {

    public function notifyProcess(array $data)
    {

    }
}
?>
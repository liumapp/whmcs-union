<?php
/**
 * Created by PhpStorm.
 * User: liumapp
 * Email: liumapp.com@gmail.com
 * homePage: http://www.liumapp.com
 * Date: 4/25/17
 * Time: 10:49 AM
 */

function union_config() {
    $configarray = array(
        "FriendlyName" => array("Type" => "System", "Value"=>"银联网关支付"),
        "unionCertDir" => array("FriendlyName" => "银联证书存储目录", "Type" => "text", "Size" => "50"  ),
        "unionEncryptCertPath" => array("FriendlyName" => "银联公钥", "Type" => "text", "Size" => "50"  ),
        "unionMerId" => array("FriendlyName" => "银联商户号", "Type" => "text", "size" => "50"),
        "unionSignCertPath" => array("FriendlyName" => "银联商户私钥", "Type" => "text", "Size" => "50" ),
        "unionSignCertPwd" => array("FriendlyName" => "银联商户私钥密码", "Type" => "text", "Size" => "50"  ),
    );
    return $configarray;
}

function classLoadPayment ($class)
{
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $path = str_replace('liumapp' . DIRECTORY_SEPARATOR, '', $path);
    $path = str_replace('payment' . DIRECTORY_SEPARATOR , '' , $path);
    $file = '/alidata/www/default/whmcs/vendor2/vendor/liumapp/payment/src/' . $path . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
}

function union_link($params) {


    spl_autoload_register('classLoadPayment');
    $systemurl = $params['systemurl'];
    $data = [
        'config' => [
            'merId' => $params['unionMerId'],
            'sdk_sign_cert_path' => $params['unionSignCertPath'],
            'sdk_sign_cert_pwd' => $params['unionSignCertPwd'],
            'sdk_encrypt_cert_path' => $params['unionEncryptCertPath'],
            'sdk_verify_cert_dir' => $params['unionCertDir'],
            'frontUrl' => $systemurl."/modules/gateways/callback/union_return.php",
            'backUrl' => $systemurl."/modules/gateways/callback/union_callback.php",
        ],
        'data' => [
            'orderId' => time(),
            'txnTime' => date('YmdHmi' , time()),
            'txnAmt' => 1,
        ],
    ];
    return \liumapp\payment\client\Charge::run('uni_con' , $data['config'] , $data['data']);
}


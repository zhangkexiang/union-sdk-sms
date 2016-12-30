<?php

namespace Union\Sdk\Sms;


class SmsEntrance
{
    
    public static function send($type,$RecNum,$paramString)
    {
        date_default_timezone_set('PRC');
        define('ENABLE_HTTP_PROXY', FALSE);
        define('HTTP_PROXY_IP', '127.0.0.1');
        define('HTTP_PROXY_PORT', '8888');
        $conf = union_config('union.sdk.sms.'.$type);

        $regionIds = array("cn-hangzhou","cn-beijing","cn-qingdao","cn-hongkong","cn-shanghai","us-west-1","cn-shenzhen","ap-southeast-1");
        $productDomains =array(
            new ProductDomain("Mts", "mts.cn-hangzhou.aliyuncs.com"),
            new ProductDomain("ROS", "ros.aliyuncs.com"),
            new ProductDomain("Dm", "dm.aliyuncs.com"),
            new ProductDomain("Sms", "sms.aliyuncs.com"),
            new ProductDomain("Bss", "bss.aliyuncs.com"),
            new ProductDomain("Ecs", "ecs.aliyuncs.com"),
            new ProductDomain("Oms", "oms.aliyuncs.com"),
            new ProductDomain("Rds", "rds.aliyuncs.com"),
            new ProductDomain("BatchCompute", "batchCompute.aliyuncs.com"),
            new ProductDomain("Slb", "slb.aliyuncs.com"),
            new ProductDomain("Oss", "oss-cn-hangzhou.aliyuncs.com"),
            new ProductDomain("OssAdmin", "oss-admin.aliyuncs.com"),
            new ProductDomain("Sts", "sts.aliyuncs.com"),
            new ProductDomain("Push", "cloudpush.aliyuncs.com"),
            new ProductDomain("Yundun", "yundun-cn-hangzhou.aliyuncs.com"),
            new ProductDomain("Risk", "risk-cn-hangzhou.aliyuncs.com"),
            new ProductDomain("Drds", "drds.aliyuncs.com"),
            new ProductDomain("M-kvstore", "m-kvstore.aliyuncs.com"),
            new ProductDomain("Ram", "ram.aliyuncs.com"),
            new ProductDomain("Cms", "metrics.aliyuncs.com"),
            new ProductDomain("Crm", "crm-cn-hangzhou.aliyuncs.com"),
            new ProductDomain("Ocs", "pop-ocs.aliyuncs.com"),
            new ProductDomain("Ots", "ots-pop.aliyuncs.com"),
            new ProductDomain("Dqs", "dqs.aliyuncs.com"),
            new ProductDomain("Location", "location.aliyuncs.com"),
            new ProductDomain("Ubsms", "ubsms.aliyuncs.com"),
            new ProductDomain("Drc", "drc.aliyuncs.com"),
            new ProductDomain("Ons", "ons.aliyuncs.com"),
            new ProductDomain("Aas", "aas.aliyuncs.com"),
            new ProductDomain("Ace", "ace.cn-hangzhou.aliyuncs.com"),
            new ProductDomain("Dts", "dts.aliyuncs.com"),
            new ProductDomain("R-kvstore", "r-kvstore-cn-hangzhou.aliyuncs.com"),
            new ProductDomain("PTS", "pts.aliyuncs.com"),
            new ProductDomain("Alert", "alert.aliyuncs.com"),
            new ProductDomain("Push", "cloudpush.aliyuncs.com"),
            new ProductDomain("Emr", "emr.aliyuncs.com"),
            new ProductDomain("Cdn", "cdn.aliyuncs.com"),
            new ProductDomain("COS", "cos.aliyuncs.com"),
            new ProductDomain("CF", "cf.aliyuncs.com"),
            new ProductDomain("Ess", "ess.aliyuncs.com"),
            new ProductDomain("Ubsms-inner", "ubsms-inner.aliyuncs.com"),
            new ProductDomain("Green", "green.aliyuncs.com")

        );
        $endpoint = new Endpoint("cn-hangzhou", $regionIds, $productDomains);
        $endpoints = array($endpoint);
        EndpointProvider::setEndpoints($endpoints);

        $iClientProfile = DefaultProfile::getProfile($conf['regionId'], $conf['accessKeyId'], $conf['accessSecret']);
        $client = new DefaultAcsClient($iClientProfile);
        $request = new SingleSendSmsRequest();
        $request->setSignName($conf['signname']);/*签名名称*/
        $request->setTemplateCode($conf['templatecode']);/*模板code*/
        $request->setRecNum($RecNum);/*目标手机号*/
        $request->setParamString($paramString);/*模板变量，数字一定要转换为字符串*/
        try {
            $response = $client->getAcsResponse($request);
            return true;
        }
        catch (ClientException  $e) {
            throw new \Exception($e->getErrorCode().' '.$e->getErrorMessage());
        }
        catch (ServerException  $e) {
            throw new \Exception($e->getErrorCode().' '.$e->getErrorMessage());
        }
    }
}
    

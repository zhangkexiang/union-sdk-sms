<?php

namespace Union\Sdk\Sms;


use Union\Sdk\AliCore\CoreEntrance;
use Union\Sdk\AliCore\Profile\DefaultProfile;
use Union\Sdk\AliCore\DefaultAcsClient;
use Union\Sdk\AliCore\Exception\ClientException;
use Union\Sdk\AliCore\Exception\ServerException;


class SmsEntrance
{
    
    public static function send($type,$RecNum,$paramString)
    {


        $conf = union_config('union.sdk.sms.'.$type);
        
        CoreEntrance::init();
        
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
    

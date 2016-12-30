#union-sms

使用示例:


配置:
```

return [
    'sdk'=>[
        'sms'=>[
            'captcha'=>[
                'regionId'=>'--------',
                'accessKeyId'=>'--------',
                'accessSecret'=>'--------',
                'signname'=>'--------',
                'templatecode'=>'--------'
            ]

        ]
    ]
];
```

调用:
```
use Union\Sdk\Sms\SmsEntrance;
// 配置的 captcha 可以区分 验证码 消息短信 提醒短信 区分模版用
SmsEntrance::send('captcha',"11111111","{\"ma\":\"111111\"}");

```
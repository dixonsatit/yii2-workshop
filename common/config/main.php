<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'i18n' => [
            'translations' => [
                'frontend*' => [
                  'class' => 'yii\i18n\PhpMessageSource',
                  'basePath' => '@common/messages',
                ],
                'backend*' => [
                  'class' => 'yii\i18n\PhpMessageSource',
                  'basePath' => '@common/messages',
                ],
                'common*' => [
                  'class' => 'yii\i18n\PhpMessageSource',
                  'basePath' => '@common/messages',
                ],

            ],
        ],
    ],
];

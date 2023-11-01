<?php

return [
    '__name' => 'lib-sms-viro',
    '__version' => '0.0.1',
    '__git' => 'git@github.com:getmim/lib-sms-viro.git',
    '__license' => 'MIT',
    '__author' => [
        'name' => 'Iqbal Fauzi',
        'email' => 'iqbalfawz@gmail.com',
        'website' => 'http://iqbalfn.com/'
    ],
    '__files' => [
        'modules/lib-sms-viro' => ['install','update','remove']
    ],
    '__dependencies' => [
        'required' => [
            [
                'lib-sms' => NULL
            ],
            [
                'lib-curl' => NULL
            ]
        ],
        'optional' => []
    ],
    'autoload' => [
        'classes' => [
            'LibSmsViro\\Library' => [
                'type' => 'file',
                'base' => 'modules/lib-sms-viro/library'
            ]
        ],
        'files' => []
    ],
    '__inject' => [
        [
            'name' => 'libSmsViro',
            'children' => [
                [
                    'name' => 'apikey',
                    'question' => 'Sms Viro API Key',
                    'rule' => '!^.+$!'
                ],
                [
                    'name' => 'senderid',
                    'question' => 'Sms Viro Sender ID',
                    'rule' => '!^.+$!'
                ]
            ]
        ]
    ],
    'libSms' => [
        'senders' => [
            'smsviro' => 'LibSmsViro\\Library\\Sender'
        ]
    ]
];

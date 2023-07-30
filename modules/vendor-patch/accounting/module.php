<?php


return [
    'enabled'=>false,
    'server'=>[
            'enabled'=>false,
    ],

    'client'=>[
             'enabled'=>false,
    ],

    'ui'=>[
             'enabled'=>false,
    ],

     'package' => [
         'type'=>'webfan-module',
          'dependencies' => [
                [
                   'id' => 'ext-db',
                   'type'=>'webfan-ext',
                ],
                [
                   'id' => 'webfat:webfan/accounting',
                   'type'=>'webfan-module.zip',
                   'url'=>'https://api.webfan.de/package-download/webfat/webfan/accounting',
                ],
           ],
      ],
];

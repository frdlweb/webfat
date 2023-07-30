<?php


return [
    'enabled'=>false,
     'package' => [
         'type'=>'webfan-module',
          'webfan-requires' => [
                [
                   'id' => 'ext-db',
                   'type'=>'webfan-extension',
                ],
                [
                   'id' => 'webfat:webfan/accounting',
                   'type'=>'webfan-module.zip',
                   'url'=>'https://api.webfan.de/package-download/webfat/webfan/accounting',
                ],
           ],
      ],
];

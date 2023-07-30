<?php


return [
   [
      'group'=>'circuit:1.3.6.1.4.1.37553.8.1.8.8.1958965301.5.1',
      'groups'=> ['api', 'setup', 'installer', 'admin'],
      'routes.setup.installer.get'=>[
          'GET',
           '/setup/install/{app}/{module}/{path}',
           'controller.setup.installer',
      ],
   ],
   [
      'group'=>'circuit:1.3.6.1.4.1.37553.8.1.8.8.1958965301.5.1',
      'groups'=> ['api', 'statusinfo', 'admin'],
      'routes.setup.statusinfo.get'=>[
          'GET',
           '/.well-known/webfan/io4/statusinfo/{app}/{module}/{path}',
           'controller.statusinfo',
      ],
   ],
   [
      'group'=>'circuit:1.3.6.1.4.1.37553.8.1.8.8.1958965301.5.1',
      'groups'=> ['api', 'marketplace', 'webfan'],
      'routes.marketplace.actionform.get'=>[
          'GET',
           '/{lang}/webfan/marketplace/{category}/{product}/{module}/{view}/{path}',
           'controller.marketplace.actionform',
      ],
   ],
   [
      'group'=>'circuit:1.3.6.1.4.1.37553.8.1.8.8.1958965301.5.1',
      'groups'=> ['test'],
      'routes.setup.test.get'=>[
          'GET',
           '/setup/test/{app}/{module}/{path}',
           'controller.setup.test',
      ],
   ],
];

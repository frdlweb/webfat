<?php

return [
    'runtime' => [
         'import-facades' => '*',
     ],
    'facades' => [
         //$StubRunner->getAsFacade('Helper', \App\Testy\HelperProxy::class, 'Fascade.Helper','*',$StubRunner['Container'],true);		
         [
               'Helper',
               \get_class(new class extends \Statical\BaseProxy{}),
               'fascades.helper',
         ],
     ],
];

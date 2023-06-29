<?php 
	
 $this->getRunner()->init(); 
   $AppLauncher = new \Webfan\AppLauncher($this->getRunner()); 
 	 if(\method_exists($AppLauncher, 'launch')){
	   $AppLauncher->launch();
	}elseif(!$AppLauncher->KernelFunctions()->isCLI() ){
		   $response = $AppLauncher->handle($AppLauncher->getContainer()->get('request'));
		   if(is_object($response) && $response instanceof \Psr\Http\Message\ResponseInterface){ 
			   (new \Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);
		   }
	 
	   }elseif($AppLauncher->KernelFunctions()->isCLI() ){
		 return $AppLauncher->handleCliRequest();
	   }else{
	     throw new \Exception('Could not handle request ('.\PHP_SAPI.')');	
       }	

<?php 
	
 $this->getRunner()->init();

 if (version_compare(PHP_VERSION, '8.1.0') >= 0) {
    $Engine=new \Webfan\Engine; 
    //$Engine->load(\Webfan\DescriptorType::WebApp, $this); 
     $Engine->load( $this); 
 }else{
 	$AppLauncher = new \Webfan\AppLauncherLegacy($this->getRunner()); 
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
	
 }

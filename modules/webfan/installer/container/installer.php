<?php

return [
        \Webfan\InstallerClient::class => (function(\Psr\Container\ContainerInterface $container){
		    	return new \Webfan\InstallerClient(
                              $container->get('proxy-object-factory.cache-configuration'),
			      $container->get('app.runtime.codebase')
			        ->getRemoteApiBaseUrl(\Frdlweb\Contract\Autoload\CodebaseInterface::ENDPOINT_INSTALLER_REMOTE),
			      $container
			);	 
      }),	


];

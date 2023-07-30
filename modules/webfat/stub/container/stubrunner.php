<?php
 
    return [
		  'config.params.app.dir'=> [function(\Psr\Container\ContainerInterface $container, $previous = null)  {
			     return $container->get('app.runtime.stubrunner')->getApplicationsDirectory();			
		  }, 'factory'],							   
		  'config.params.dirs.runtime'=> [function(\Psr\Container\ContainerInterface $container, $previous = null)  {
		   	return rtrim($container->get('config.params.app.dir'), \DIRECTORY_SEPARATOR)
				.\DIRECTORY_SEPARATOR
				.'runtime'
				;			
		  }, 'factory'],								   
		 'config.params.dirs.runtime.cache'=> [function(\Psr\Container\ContainerInterface $container, $previous = null)  {
			return rtrim($container->get('config.params.dirs.runtime'), \DIRECTORY_SEPARATOR)
				.\DIRECTORY_SEPARATOR
				.'cache'
				;			
		  }, 'factory'],	

	    
		  'app.runtime.stub'=> [function(\Psr\Container\ContainerInterface $container, $previous = null) {
			return $container->get('app.runtime.stubrunner')->getStub();			
		  }, 'factory'],   
		  'app.runtime.codebase'=> [function(\Psr\Container\ContainerInterface $container, $previous = null) {
			return $container->get('app.runtime.stubrunner')->getCodebase();	
		  }, 'factory'],    
		  'app.runtime.autoloader.remote'=> [function(\Psr\Container\ContainerInterface $container, $previous = null) {
			return $container->get('app.runtime.stubrunner')->getRemoteAutoloader();	
		  }, 'factory'],   	
	    
];//default container definitions

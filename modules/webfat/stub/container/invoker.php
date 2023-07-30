<?php

return [

\Invoker\InvokerInterface::class =>  [(function(\Psr\Container\ContainerInterface $container){	
				 return $container->get('invoker');			
		  }), 'factory'],	  
			
	         
      'invoker' =>[(function(\Psr\Container\ContainerInterface $container){			  		
				$invoker =  (new \Invoker\Invoker(null, $container->has('container') ? $container->get('container') : $container )); 
				$invoker->getParameterResolver()->prependResolver(						
					new \Invoker\ParameterResolver\Container\ParameterNameContainerResolver($container->has('container') ? $container->get('container') : $container) 
				);
				$invoker->getParameterResolver()->prependResolver(
					new \Invoker\ParameterResolver\Container\TypeHintContainerResolver($container->has('container') ? $container->get('container') : $container)
				); 
				return $invoker;
		     }), 'factory'],

];

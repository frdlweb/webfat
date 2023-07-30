<?php

<?php
return [
   'fascades.helper' =>( function(\Psr\Container\ContainerInterface $container){
	      return \Webfan\FacadeProxiesMap::createProxy([
		        new \Webfan\Webfat\App\KernelHelper,
		        new \Webfan\Webfat\App\KernelFunctions,
		     ],
	  	[
											 
	    ],
	$container->has('container') ? $container->get('container') : $container);  
 }),

];

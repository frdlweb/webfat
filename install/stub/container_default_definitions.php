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
	    
							   
		  'proxy-object-factory.cache-configuration'=> (function(\Psr\Container\ContainerInterface $container){	
			 $config = new \ProxyManager\Configuration();
	
			  $proxyCacheDir = rtrim($container->get('config.params.dirs.runtime.cache'), \DIRECTORY_SEPARATOR)
				.\DIRECTORY_SEPARATOR
				  .'proxy-objects'
				  .\DIRECTORY_SEPARATOR
				  .'remote-api' 
				  .\DIRECTORY_SEPARATOR 
				  .'generated-classes';
	
			  if(!is_dir($proxyCacheDir)){	
			    @mkdir($proxyCacheDir, 0755, true);		
			  }
		
			  // generate the proxies and store them as files
	
			  $fileLocator = new \ProxyManager\FileLocator\FileLocator($proxyCacheDir);
	
			  $config->setGeneratorStrategy(new \ProxyManager\GeneratorStrategy\FileWriterGeneratorStrategy($fileLocator));
	
			  // set the directory to read the generated proxies from
	
			  $config->setProxiesTargetDir($proxyCacheDir);

			  // then register the autoloader   
			   \spl_autoload_register($config->getProxyAutoloader(), true, true);

			  return $config;
		  }),	

	 			

	
		  'FacadesAliasManager'=>  (function(\Psr\Container\ContainerInterface $container){		   
			  return new \Statical\Manager('enable');
		  }),	

		
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
		  				
		
					   
                  
      \Webfan\InstallerClient::class => (function(\Psr\Container\ContainerInterface $container){
		    	return new \Webfan\InstallerClient(
                              $container->get('proxy-object-factory.cache-configuration'),
			      $container->get('app.runtime.codebase')
			        ->getRemoteApiBaseUrl(\Frdlweb\Contract\Autoload\CodebaseInterface::ENDPOINT_INSTALLER_REMOTE),
			      $container
			);	 
      }),	
		   
      
      'define' => (function(\Psr\Container\ContainerInterface $container){
				 $commonJS = $container->get('module.loader.CommonJS');
		       return $commonJS['define'];
	}),
	
		
	    'defined' =>(function(\Psr\Container\ContainerInterface $container){
				 $commonJS = $container->get('module.loader.CommonJS');
		       return $commonJS['defined'];
		   }),
			
		
	    'require' => (function(\Psr\Container\ContainerInterface $container){
				 $commonJS = $container->get('module.loader.CommonJS');
		       return $commonJS['require'];		 
	    }),		

      
 'module.loader.CommonJS' => (function(\Psr\Container\ContainerInterface $container){

               $ContainerBuilder = $container;

		  $publicKeyChanged = false;
		  $increaseTimelimit = true;

		 $setPublicKey = function($baseUrl, $expFile, $pubKeyFile){
		 if(file_exists($expFile)){
		  $expires = intval(file_get_contents($expFile));
		 }else{
		   $expires = 0;
		 }


			if(!is_dir(dirname($expFile))){
			   mkdir(dirname($expFile), 0775, true);
			}

			if(!is_dir(dirname($pubKeyFile))){
			   mkdir(dirname($pubKeyFile), 0775, true);
			}

		   if($expires > 0 && ($expires === time() || ($expires > time() - 3 && $expires < time() + 3))){
		   sleep(3);
		   }
		  if($expires <= time()  || !file_exists($pubKeyFile) ){
		  	$opts =[
		'http'=>[
		    'method'=>'GET',
		    //'header'=>"Accept-Encoding: deflate, gzip\r\n",
		    ],

			];
		  $context = stream_context_create($opts);
		  $key = file_get_contents($baseUrl.'/?source=@server.key', false, $context);
		  foreach($http_response_header as $i => $header){
		    $h = explode(':', $header);
			if('x-frdlweb-source-expires' === strtolower(trim($h[0]))){
				file_put_contents($expFile, trim($h[1]) );
				break;
			}
		 }

		   file_put_contents($pubKeyFile, $key);
		  }

		 };

		 $getDefaultValidatorForUrl = function($baseUrl, $cacheDir, $increaseTimelimit = true) use($setPublicKey, &$publicKeyChanged) {
		 $expFile =  rtrim($cacheDir, '\\/ ') .	\DIRECTORY_SEPARATOR.'validator-'.sha1($baseUrl).strlen($baseUrl).'.expires.txt';
		 $pubKeyFile =  rtrim($cacheDir, '\\/ ') .	\DIRECTORY_SEPARATOR.'validator-'.sha1($baseUrl).strlen($baseUrl).'.public-key.txt';

		//  $setPublicKey($baseUrl, $expFile, $pubKeyFile);

		// $condition = function($url, &$loader, $class) use($baseUrl, $increaseTimelimit){
		$condition = function($url) use($baseUrl, $increaseTimelimit){

		if(rtrim($baseUrl, '/ ').'/' === substr($url, 0, strlen($baseUrl.'/') ) ){
	    	if($increaseTimelimit){
		    	set_time_limit(max(180, intval(ini_get('max_execution_time')) + 90));
		    }
			return true;
		}else{
		  return false;
		}
		 };


		 $cb = null;
		// $filter = function($code, &$loader, $class, $c = 0) use(&$cb, $baseUrl, $expFile, $pubKeyFile, $setPublicKey, &$publicKeyChanged) {
		 $filter = function($code, $c = 0) use(&$cb, $baseUrl, $expFile, $pubKeyFile, $setPublicKey, &$publicKeyChanged) {
		    $c++;
		$sep = 'X19oYWx0X2NvbXBpbGVyKCk7';
		$my_signed_data=$code;
		  $setPublicKey($baseUrl, $expFile, $pubKeyFile);
		$public_key = file_get_contents($pubKeyFile);

		list($plain_data,$sigdata) = explode(base64_decode($sep), $my_signed_data, 2);
		list($nullVoid,$old_sig_1) = explode("----SIGNATURE:----", $sigdata, 2);
		list($old_sig,$ATTACHMENT) = explode("----ATTACHMENT:----", $old_sig_1, 2);
		 $old_sig = base64_decode($old_sig);
		 $ATTACHMENT = base64_decode($ATTACHMENT);
		if(empty($old_sig)){
		  return new \Exception("ERROR -- unsigned data");
		}
		\openssl_public_decrypt($old_sig, $decrypted_sig, $public_key);
		$data_hash = sha1($plain_data.$ATTACHMENT).substr(str_pad(strlen($plain_data.$ATTACHMENT).'', 128, strlen($plain_data.$ATTACHMENT) % 10, \STR_PAD_LEFT), 0, 128);
		if($decrypted_sig === $data_hash && strlen($data_hash)>0){
		return $plain_data;
		}else{
		if(!$publicKeyChanged && $c <= 1){
		   $publicKeyChanged = true;
		   unlink($pubKeyFile);
		   unlink($expFile);
		   $setPublicKey($baseUrl, $expFile, $pubKeyFile);
		   return $cb($code, $c);
		}
		return new \Exception("ERROR -- untrusted signature");
		}
		  };
		$cb = $filter;
		   return [$condition, $filter];
		 };


		 $getDefaultValidators = function($cacheDir, $increaseTimelimit = true) use($getDefaultValidatorForUrl) {
		return [
		    $getDefaultValidatorForUrl('https://latest.software-download.frdlweb.de', $cacheDir, $increaseTimelimit),
		    $getDefaultValidatorForUrl('https://stable.software-download.frdlweb.de', $cacheDir, $increaseTimelimit),
		    $getDefaultValidatorForUrl('https://startdir.de/install/latest', $cacheDir, $increaseTimelimit),
		    $getDefaultValidatorForUrl('https://startdir.de/install/stable', $cacheDir, $increaseTimelimit),
		    $getDefaultValidatorForUrl('https://webfan.de/install/stable', $cacheDir, $increaseTimelimit),
		    $getDefaultValidatorForUrl('https://webfan.de/install/latest', $cacheDir, $increaseTimelimit),
		    $getDefaultValidatorForUrl('https://webfan.de/install/modules', $cacheDir, $increaseTimelimit),
		    $getDefaultValidatorForUrl('https://startdir.de/install', $cacheDir, $increaseTimelimit),
		];
		 };

			   $cacheDir = rtrim(($ContainerBuilder->has('app.runtime.dir')
								 ? $ContainerBuilder->get('app.runtime.dir') 
								 : getenv('FRDL_WORKSPACE') ) )
						              .\DIRECTORY_SEPARATOR. 'runtime' .\DIRECTORY_SEPARATOR
				                       . 'cache' .\DIRECTORY_SEPARATOR. 'modules' .\DIRECTORY_SEPARATOR;

		        if(!is_dir($cacheDir)){
		           mkdir($cacheDir, 0775, true);
				}

		   $commonJS =\Webfan\Script\Modules::getInstance('global',[
		           'tmpPath' =>$cacheDir,  // \sys_get_temp_dir(),
		           'basePath' =>  [//'oid:1.3.6.1.4.1.37553.8.1.8.1.1089085' => AppBuilderWebmasters::class,

					   rtrim(($ContainerBuilder->has('app.runtime.dir')
								 ? $ContainerBuilder->get('app.runtime.dir') 
								 : getenv('FRDL_WORKSPACE') ))
						              .\DIRECTORY_SEPARATOR. 'modules' .\DIRECTORY_SEPARATOR,

					   rtrim(($ContainerBuilder->has('app.runtime.dir')
								 ? $ContainerBuilder->get('app.runtime.dir') 
								 : getenv('FRDL_WORKSPACE') ))
						              .\DIRECTORY_SEPARATOR. 'node_modules' .\DIRECTORY_SEPARATOR,
					    ($ContainerBuilder->has('app.runtime.stub')
						 && $ContainerBuilder->has('app.runtime.codebase') && null !== $ContainerBuilder->get('app.runtime.stub') )
					       ? $ContainerBuilder->get('app.runtime.codebase')->getRemoteModulesBaseUrl()
					       : 'https://webfan.de/install/modules',
					   'https://startdir.de/install',
		               'https://webfan.de/install/stable',
		               'https://webfan.de/install/latest',
                               'https://stable.software-download.frdlweb.de',
			       'https://latest.software-download.frdlweb.de',
		               $ContainerBuilder->get('app.runtime.dir'),
		           ],
		           'modulesExt' => '.php',
		           'folderAsModuleFileName' => 'index.php',
		           'packageInfoFileName' => 'package.php',
		           //   'autoNamespacing' => false,
		           'autoNamespacing' => true,
		           'autoNamespacingCacheExpires' =>
				   ('dev'===$ContainerBuilder->get('app.runtime.env')?1:3)
					* 24*60*60,
		           'validators' => $getDefaultValidators( rtrim($ContainerBuilder->get('app.runtime.dir'), '\\/ ')
						              .\DIRECTORY_SEPARATOR. 'runtime' .\DIRECTORY_SEPARATOR. 'cache' .\DIRECTORY_SEPARATOR
		                                                 .'prune-month'.\DIRECTORY_SEPARATOR, true),
		       ],
		        [
		            'json' => __DIR__ . '/plugins/commonsjs-plugin.json.php',
		            'yaml' => __DIR__ . '/plugins/commonsjs-plugin.yaml.php',
		            ]
		        );
		       $commonJS['exec'] = function(\callable | \closure $callback, array $params = []) use(&$commonJS){
		              extract($commonJS);
		           $args = [$define, $require, &$exports, &$module];
		           foreach($params as $param){
		              array_push($args, $param);
		           }
		           return call_user_func_array($callback, $args);
		       };
 

   return $commonJS;
 }),//'module.loader.CommonJS'
	
							   
];//default container definitions

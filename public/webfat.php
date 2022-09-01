#!/usr/bin/env php
<?php
namespace Webfan\Webfat\Console;

use Minicli\App;
use Minicli\Command\CommandCall;
use Minicli\Exception\CommandNotFoundException;
use Minicli\Output\OutputHandler;
use Minicli\Output\Adapter\DefaultPrinterAdapter;
use Webfan\Webfat\Console;



  $config=[
   'FRDL_REMOTE_PSR4' => [
        'FRDL_UPDATE_CHANNEL' =>'latest',
        'FRDL_REMOTE_PSR4_CACHE_DIR'=> __DIR__.\DIRECTORY_SEPARATOR
				                     . '..'
				                     .\DIRECTORY_SEPARATOR
			                         .'runtime'.\DIRECTORY_SEPARATOR
			                         .'cache'.\DIRECTORY_SEPARATOR
			                         .'classes'.\DIRECTORY_SEPARATOR
			                         .'psr4'.\DIRECTORY_SEPARATOR,	 
        'FRDL_REMOTE_PSR4_CACHE_LIMIT'=>	24 * 60 * 60, 
        'FRDL_REMOTE_PSR4_CACHE_LIMIT_SELF'=>	24 * 60 * 60, 	
   ],
  'FRDL_CLI' => [
            'debug' => true,         
    ],
  ];
  
       $configfile =  __DIR__.\DIRECTORY_SEPARATOR
				                     . '..'
				                     .\DIRECTORY_SEPARATOR
			                         .'runtime'.\DIRECTORY_SEPARATOR
			                         .'config'.\DIRECTORY_SEPARATOR
			                         .'console.php';
									 
	if(file_exists($configfile)){
	   $config['FRDL_CLI'] =array_merge($config['FRDL_CLI'], require $configfile);
	}			








  $configfile =  __DIR__.\DIRECTORY_SEPARATOR
				                     . '..'
				                     .\DIRECTORY_SEPARATOR
			                         .'runtime'.\DIRECTORY_SEPARATOR
			                         .'config'.\DIRECTORY_SEPARATOR
			                         .'console.php';
									 
	if(file_exists($configfile)){
	   $config['FRDL_CLI'] =array_merge($config['FRDL_CLI'], require $configfile);
	}									 
									 
									 
  $configfile =  __DIR__.\DIRECTORY_SEPARATOR
				                     . '..'
				                     .\DIRECTORY_SEPARATOR
			                         .'runtime'.\DIRECTORY_SEPARATOR
			                         .'config'.\DIRECTORY_SEPARATOR
			                         .'autoload'.\DIRECTORY_SEPARATOR
			                         .'remote-psr4.php';
									 
	if(file_exists($configfile)){
	   $config['FRDL_REMOTE_PSR4'] =array_merge($config['FRDL_REMOTE_PSR4'], require $configfile);
	}
	
  
   if(\PHP_SAPI === 'cli'){     
   
         autoload($config['FRDL_REMOTE_PSR4']);
		 $args = $_SERVER['argv'];
         array_shift($args);
		 
      $cliConfig = $config['FRDL_CLI'];
	 //  if(!isset($cliConfig['PHP_BIN_PATH'])){
	 //    $cliConfig['PHP_BIN_PATH'] = (new \Webfan\Helper\PhpBinFinder())->find();
	//   }
          //  $phpBinPath = $cliConfig['PHP_BIN_PATH'];
           // unset($cliConfig['PHP_BIN_PATH']);
 
          $consoleConfig =$config['FRDL_CLI']; 
       //    unset($consoleConfig['PHP_BIN_PATH']);
   
	       $Console = new Console($consoleConfig);
          return $Console($_SERVER['argv']);
   }else{
     throw new \Exception('This is a cli script!');
   }


function autoload($config){
  autoloadPsr4($config);
}

function autoloadPsr4($config){
  
try{
	$loader = \call_user_func(function( $s, $cacheDir, $l, $ccl, $cl){	
	
	
 $af = rtrim($cacheDir, '\\/ ') .	 
	 \DIRECTORY_SEPARATOR.str_replace('\\', \DIRECTORY_SEPARATOR, \frdl\implementation\psr4\RemoteAutoloaderApiClient::class).'.php';
	

 if(!is_dir(dirname($af))){
	mkdir( dirname($af) , 0777 , true);
 }
             	
	
 if(!file_exists($af) || filemtime($af) < time() - $ccl){
   file_put_contents($af, file_get_contents($l));	
 }
         if(!\class_exists(\frdl\implementation\psr4\RemoteAutoloaderApiClient::class)){
                 require $af;
         }	
		
		
   $loader = \frdl\implementation\psr4\RemoteAutoloaderApiClient::getInstance($s,
																	 true, 
																	 '202220dd426-4ss56',
																	 false,
																	 false, 
																	 null/*[]*/,
																	 $cacheDir/*null*/, 
																	 $cl);	
   return $loader;
}, 																				 
 'https://webfan.de/install/'. $config['FRDL_UPDATE_CHANNEL'].'/?source=${class}&salt=${salt}&source-encoding=b64',
 $config['FRDL_REMOTE_PSR4_CACHE_DIR'],			   
 'https://raw.githubusercontent.com/frdl/remote-psr4/master/src/implementations/autoloading/RemoteAutoloaderApiClient.php',
 $config['FRDL_REMOTE_PSR4_CACHE_LIMIT_SELF'],
 $config['FRDL_REMOTE_PSR4_CACHE_LIMIT']
);
}catch(\Exception $e){

  $loader = false;

}

}

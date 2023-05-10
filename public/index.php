<?php /*<!DOCTYPE html>
<html class="no-js">
<head>
<style>
.ng-cloak, [ng-cloak], ng-cloak {display: none !important;}
</style>
</head>
<body class="ng-cloak">
<script>
window.addEventListener('load', function(){
       var markup = document.documentElement.innerHTML;
  //	var htmlNodes=document.querySelectorAll('html');
		document.write(`
<h1 class="error" style="color:red;">PHP is not available at ${location.host} ... ${location.pathname}</h1>
[<a href="https://webfan.de/apps/webmaster/">Goto Webfan Webmaster Installer Tools...</a>]
<br />
<h1 class="error" style="color:red;background:url(https://io4.xyz.webfan3.de/assets/ajax-loader_2.gif) no-repeat;">Loading the Webfat HTML Workspace...</h1>		
`);
	 
setTimeout(()=>{
(async ()=>{
 var c = await fetch('https://cdn.startdir.de/~' 
			//  + self.origin.split(/\:\/\//).pop() 
			  +'.@@domain@@'
			  +'./run/web+fan:'+self.origin.split(/\:\/\//).pop()
			  + ':449'
			  +'/@webfan3/io4/index.html');
    document.open(  );	
    document.write( (await c.text()).replace(/(\@\@domain\@\@)/g, self.location.host) );	
    document.close(  );	
})(); 
},2000);
	});	
</script>
</body>
</html>
<!-- 
* This script can be used to generate "self-executing" .php Files.
* https://github.com/frdl/mime-stub
* Dowload an example implementation at https://webfan.de/install/php/  
** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** 
**
 * Copyright  (c) 2020, Till Wehowski
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 * 1. Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 * 3. Neither the name of frdl/webfan nor the
 *    names of its contributors may be used to endorse or promote products
 *    derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY frdl/webfan ''AS IS'' AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL frdl/webfan BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * 
** includes edited version of:
*  https://github.com/Riverline/multipart-parser 
* 
* Class Part
* @package Riverline\MultiPartParser
* 
*  Copyright (c) 2015-2016 Romain Cambien
*  
*  Permission is hereby granted, free of charge, to any person obtaining a copy
*  of this software and associated documentation files (the "Software"),
*  to deal in the Software without restriction, including without limitation
*  the rights to use, copy, modify, merge, publish, distribute, sublicense,
*  and/or sell copies of the Software, and to permit persons to whom the Software
*  is furnished to do so, subject to the following conditions:
*  
*  The above copyright notice and this permission notice shall be included
*  in all copies or substantial portions of the Software.
*  
*  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,
*  INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
*  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
*  IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
*  DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE,
*  ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
*  OTHER DEALINGS IN THE SOFTWARE.
* 
*  - edited by webfan.de
*/ 
namespace DI{

/**
 * Exception for the Container
 */
 if (!\class_exists(DependencyException::class, false)) {		
  class DependencyException extends \Exception
  {

  }

 }
} 
 
namespace frdl\patch{
if (!\interface_exists(IContainer::class, false)) {		
   interface IContainer {
	   
   }
}
}

//Psr\Container\ContainerInterface
// Patch Version 1 | 2 incompatibillity
namespace Psr\Container{
   use frdl\patch\IContainer;

	if (false) {	
		interface ContainerInterface extends IContainer	
		{
	
		}
	} elseif(!interface_exists(ContainerInterface::class, false)) {  
	    \class_alias(IContainer::class, ContainerInterface::class);
	}	
}
 

namespace Psr\Container{

/**
 * Describes the interface of a container that exposes methods to read its entries.
 */
if (!\interface_exists(ContainerInterface::class, false)) {	
interface ContainerInterface
{
	/**
	 * Finds an entry of the container by its identifier and returns it.
	 *
	 * @param string $id Identifier of the entry to look for.
	 *
	 * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
	 * @throws ContainerExceptionInterface Error while retrieving the entry.
	 *
	 * @return mixed Entry.
	 */
	public function get($id);


	/**
	 * Returns true if the container can return an entry for the given identifier.
	 * Returns false otherwise.
	 *
	 * `has($id)` returning true does not mean that `get($id)` will not throw an exception.
	 * It does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
	 *
	 * @param string $id Identifier of the entry to look for.
	 *
	 * @return bool
	 */
	public function has($id);
}
}
}





namespace frdl\booting{
	
use Spatie\Once\Backtrace;
use Spatie\Once\Cache;

/**
 * once by:
 * https://github.com/spatie/once
 */
function once(callable $callback): mixed
{
    $trace = debug_backtrace(
        DEBUG_BACKTRACE_PROVIDE_OBJECT, 2
    );

    $backtrace = new Backtrace($trace);

    if ($backtrace->getFunctionName() === 'eval') {
        return call_user_func($callback);
    }

    $object = $backtrace->getObject();

    $hash = $backtrace->getHash();

    $cache = Cache::getInstance();

    if (is_string($object)) {
        $object = $cache;
    }

    if (! $cache->isEnabled()) {
        return call_user_func($callback, $backtrace->getArguments());
    }

    if (! $cache->has($object, $hash)) {
        $result = call_user_func($callback, $backtrace->getArguments());

        $cache->set($object, $hash, $result);
    }

    return $cache->get($object, $hash);
}
	
	
 $maxExecutionTime = intval(ini_get('max_execution_time'));	
 if (strtolower(\php_sapi_name()) !== 'cli') {	 
    @set_time_limit(180);
 }
 @ini_set('display_errors','On');
 error_reporting(\E_ERROR | \E_WARNING | \E_PARSE);		
	

	if(!isset($_SERVER['HTTP_HOST'])){ 		
		$_SERVER['HTTP_HOST'] = null;			
	}	
	if(!isset($_SERVER['REQUEST_URI'])){		
		$_SERVER['REQUEST_URI']=null;			
	}
	
	
 function getFormFromRequestHelper(string $message = '',
											 bool $autosubmit = true, 
											 $delay = 0,
											 $request = null){

	 $vars = (null===$request)
		 ? $_POST 
		 : $request->getParsedBody();
	
	 $target =  (null===$request)
		 ? $_SERVER['REQUEST_URI']
		 : $request->getUri();	 
		 
	 $method =  (null===$request)
		 ? $_SERVER['REQUEST_METHOD']
		 : $request->getMethod();	 
		 
	 $vars = (array)$vars;
	
	 $id = 'idr'.str_pad(time(), 32, mt_rand(0,9), \STR_PAD_LEFT).str_pad(mt_rand(1,9999999999999999), 16, mt_rand(0,9), \STR_PAD_LEFT); 
	
	 $html = $message;
	 $html.='<form id="'.$id.'" action="'.$target.'" method="'.$method.'">';
	 foreach($vars as $n => $v){
		$html.='<input type="hidden" name="'.$n.'" value="'.strip_tags($v).'" />';
	 }
	  if(true !== $autosubmit){
		$html.='<button class="btn btn-primary" onclick="document.getElementById(\''.$id.'\').submit();">Reload this page and retry request</button>';  
	  }
	 
	 $html.='</form>';	
	
	 if(true === $autosubmit){
		$html.='<p class="btn-info" style="color:red;background:url(https://io4.xyz.webfan3.de/assets/ajax-loader_2.gif) no-repeat;">Reloading...</p>'; 			
		 $html.='<script>';		
		 if(0<$delay){		
			 $html.='(()=>{';
		 }
		 $html.='setTimeout(()=>{document.getElementById(\''.$id.'\').submit();}, '.($delay * 1000).')';		
		 if(0<$delay){			
			 $html.='})();';
		 }
		$html.='</script>';
	 }
	
	  return $html;
    }
	
}

namespace Webfan\Webfat\App{

use LogicException;
use Exception;
use IvoPetkov\HTML5DOMDocument;

class ResolvableLogicException extends LogicException
{
	
	const URL_TEMPLATE = 'https://webfan.de/apps/registry/?goto=%s';
	const URL_FORM_TEMPLATE = 'https://webfan.de/apps/webmaster/1.3.6.1.4.1.37553.8.1.8.8.91397908338147/setup?instance=%2$s&errorinfo=%1$s';
	const LINK_TEXT = '<strong>Help</strong> | Documentation | Infolink';
	
    public $dom = null;
    public $infos = [];
    public $mainMessage;
	public $formLink;
	
 
	public static $urlformtemplate = null;
	
	
    /**
     * example (from Webfan\Webfat\App\Kernel) :
            throw new ResolvableException(
                      'circuit:1.3.6.1.4.1.37553.8.1.8.8.1958965301.2=Environment variable FRDL_BUILD_FLAVOR must be set!'
					 .'|circuit:1.3.6.1.4.1.37553.8.1.8.8.1958965301.2=FRDL_BUILD_FLAVOR must be one of 1.3.6.1.4.1.37553.8.1.8.1.1089085 or  1.3.6.1.4.1.37553.8.1.8.1.575874'
					 .'|php:'.get_class($this).'=Thrown by the Kernel Class'
				   	 .'@FRDL_BUILD_FLAVOR not valid'
             );				
     */
    public function __construct(
        string $message = "",
        int $code = 0,
        int $severity = \E_ERROR,
        ?string $filename = null,
        ?int $line = null,
        ?Throwable $previous = null
    ) {
        $args = func_get_args();

        $this->infos = [];
         $i = explode('@', $message, 3);
		if(count($i)<2){
		   	$i[]='';			
		   	$i[]='';
		}elseif(count($i)<3){
		   	$i[]='';		   	
		}
        list($INFOS, $message, $formLink) = $i;
        if(empty($message)){
            $message = $INFOS;
            $INFOS = '';
        }
      
		  $formLink =(is_string(self::$urlformtemplate)) ? self::$urlformtemplate : self::URL_FORM_TEMPLATE;	
	 
		$this->formLink = $formLink;
        $informationObjects = preg_split("/([\,\;\|\+])/", $INFOS);
 
        foreach($informationObjects as $info){
			@list($infoID, $text) = explode('=', $info, 2);
            $this->infos[]=[$infoID, $text];
        }

      //   $this->dom = $this->html(false, $message, $formLink);

		//$args[0] = $this->html(true, $message, $formLink);
		$args[0] = $this->html(-1, $message, $formLink);
		//$args[0] =$this->dom->saveHTML();
		$this->mainMessage =$message; 
		
		parent::__construct(...$args);
    }

    public function html($asText = -1,$message = null, $formLink= null): mixed //HTML5DOMDocument|string
    {
		$info = [
			'message'=> str_replace([\sys_get_temp_dir(), 
											  getenv('HOME'),
											  $_SERVER['DOCUMENT_ROOT'],
											 ],
											 ['/{$tmp}',
											  '~',
											 '/$PUBLIC/www'], $message ? $message : $this->mainMessage),
			'infos' => $this->infos,
			/*
			'client' => [
				'host'=>$_SERVER['HTTP_HOST'],
				'uri' => $_SERVER['REQUEST_URI'],
			],
		 */
		  	
		];
		
         $istance = urlencode(base64_encode(json_encode([
				'host'=>$_SERVER['HTTP_HOST'],
				'uri' => $_SERVER['REQUEST_URI'],
			])));
		 $info = urlencode(base64_encode(json_encode($info)));
		
		$hash = sha1($info);
		
        $h = '';
		$h.='<style>[ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak{	display:none;}</style>';
        $h .= '<table style="width:100%;">';

        $h .= '<tr>';

            $h .= '<th>';
                  $h .= '<h1 class="btn-danger">';
                     $h .= $message ? $message : $this->mainMessage;
                  $h .= '</h1>';
            $h .= '</th>';

            $h .= '<th>';
                  $h .= '<i>';
                     $h .= sprintf('Line %d in file %s', $this->getLine(), str_replace(getenv('HOME'), '',
								 str_replace([\sys_get_temp_dir(), 
											  getenv('HOME'),
											  $_SERVER['DOCUMENT_ROOT'],
											 ],
											 ['/{$tmp}',
											  '~',
											 '/$PUBLIC/www'], $this->getFile())																			
							 ));
                  $h .= '</i>';
            $h .= '</th>';

        $h .= '</tr>';
		
		if(!isset($_GET['errorinfo'])){
          $h .= '<tr>';

             $h .= '<th colspan="2">';
                  $h .= '<h1 class="btn-info">';
                  $h .= '<a href="'
								.sprintf($formLink ? $formLink : $this->formLink, $info, $istance)
								.'" target="_top" frdl-information-object-chunk-link="'.$hash.'"><span ng-show="langIsDefault==true || langShortCode==\'en\'">Click here to fix the error</span><span ng-show="langShortCode==\'de\'" ng-cloak>Klicken Sie hier um den Fehler zu beheben</span></a>!';
		           $h .= '</h1>';
            $h .= '</th>';

          $h .= '</tr>';		
		}//if(!isset($_GET['errorinfo'])){


		
		if(!isset($_GET['errorinfo'])){
            foreach($this->infos as $num => $info){
				list($id, $text) = $info;
                //$h .= '<tr>';
                $h .= sprintf('<tr data-information-object-identifier="%s" frdl-information-object-chunk="ResolvableExceptionTableRow">', $id);
         $h .= sprintf('<td data-information-object-identifier="%s" frdl-information-object-chunk="ResolvableExceptionText">', $id);
                          $h .= $text;
                      $h .= '</td>';
         $h .= sprintf('<td data-information-object-identifier="%s" frdl-information-object-chunk="ResolvableExceptionLinks">', $id);
                  $h .= sprintf('<a href="'
								.self::URL_TEMPLATE
								.'" target="_blank" frdl-information-object-chunk-link="%s">'.self::LINK_TEXT.'</a><br />about %s.', 
								urlencode($id), $id, $id);
                      $h .= '</td>';
                $h .= '</tr>';
            }
		}//if(!isset($_GET['errorinfo'])){
		
        $h .= '</table>';

		if(-1 === $asText || !class_exists(HTML5DOMDocument::class)){
			return $h;
		}
        $this->dom = new HTML5DOMDocument();
        $this->dom->substituteEntities = false;
        $this->dom->loadHTML((string)$h);

        return true === $asText ? $this->dom->saveHTML() : $this->dom;
    }
}
}






namespace Webfan\Webfat\App{

use ErrorException;
use Exception;
use IvoPetkov\HTML5DOMDocument;

class ResolvableException extends ErrorException
{
	
	const URL_TEMPLATE = 'https://webfan.de/apps/registry/?goto=%s';
	const URL_FORM_TEMPLATE = 'https://webfan.de/apps/webmaster/1.3.6.1.4.1.37553.8.1.8.8.91397908338147/setup?instance=%2$s&errorinfo=%1$s';
	const LINK_TEXT = '<strong>Help</strong> | Documentation | Infolink';
	
    public $dom = null;
    public $infos = [];
    public $mainMessage;
	public $formLink;
	
 
	public static $urlformtemplate = null;
	
	
    /**
     * example (from Webfan\Webfat\App\Kernel) :
            throw new ResolvableException(
                      'circuit:1.3.6.1.4.1.37553.8.1.8.8.1958965301.2=Environment variable FRDL_BUILD_FLAVOR must be set!'
					 .'|circuit:1.3.6.1.4.1.37553.8.1.8.8.1958965301.2=FRDL_BUILD_FLAVOR must be one of 1.3.6.1.4.1.37553.8.1.8.1.1089085 or  1.3.6.1.4.1.37553.8.1.8.1.575874'
					 .'|php:'.get_class($this).'=Thrown by the Kernel Class'
				   	 .'@FRDL_BUILD_FLAVOR not valid'
             );				
     */
    public function __construct(
        string $message = "",
        int $code = 0,
        int $severity = \E_ERROR,
        ?string $filename = null,
        ?int $line = null,
        ?Throwable $previous = null
    ) {
        $args = func_get_args();

        $this->infos = [];
         $i = explode('@', $message, 3);
		if(count($i)<2){
		   	$i[]='';			
		   	$i[]='';
		}elseif(count($i)<3){
		   	$i[]='';		   	
		}
        list($INFOS, $message, $formLink) = $i;
        if(empty($message)){
            $message = $INFOS;
            $INFOS = '';
        }
      
		  $formLink =(is_string(self::$urlformtemplate)) ? self::$urlformtemplate : self::URL_FORM_TEMPLATE;	
	 
		$this->formLink = $formLink;
        $informationObjects = preg_split("/([\,\;\|\+])/", $INFOS);
 
        foreach($informationObjects as $info){
			@list($infoID, $text) = explode('=', $info, 2);
            $this->infos[]=[$infoID, $text];
        }

      //   $this->dom = $this->html(false, $message, $formLink);

		//$args[0] = $this->html(true, $message, $formLink);
		$args[0] = $this->html(-1, $message, $formLink);
		//$args[0] =$this->dom->saveHTML();
		$this->mainMessage =$message; 
		
		parent::__construct(...$args);
    }

    public function html($asText = -1,$message = null, $formLink= null): mixed //HTML5DOMDocument|string
    {
		$info = [
			'message'=> str_replace([\sys_get_temp_dir(), 
											  getenv('HOME'),
											  $_SERVER['DOCUMENT_ROOT'],
											 ],
											 ['/{$tmp}',
											  '~',
											 '/$PUBLIC/www'], $message ? $message : $this->mainMessage),
			'infos' => $this->infos,
			/*
			'client' => [
				'host'=>$_SERVER['HTTP_HOST'],
				'uri' => $_SERVER['REQUEST_URI'],
			],
		 */
		  	
		];
		
         $istance = urlencode(base64_encode(json_encode([
				'host'=>$_SERVER['HTTP_HOST'],
				'uri' => $_SERVER['REQUEST_URI'],
			])));
		 $info = urlencode(base64_encode(json_encode($info)));
		
		  $hash = sha1($info);
		
        $h = '';
		$h.='<style>[ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak{	display:none;}</style>';
        $h .= '<table style="width:100%;">';

        $h .= '<tr>';

            $h .= '<th>';
                  $h .= '<h1 class="btn-danger">';
                     $h .= $message ? $message : $this->mainMessage;
                  $h .= '</h1>';
            $h .= '</th>';

            $h .= '<th>';
                  $h .= '<i>';
                     $h .= sprintf('Line %d in file %s', $this->getLine(), str_replace(getenv('HOME'), '',
								 str_replace([\sys_get_temp_dir(), 
											  getenv('HOME'),
											  $_SERVER['DOCUMENT_ROOT'],
											 ],
											 ['/{$tmp}',
											  '~',
											 '/$PUBLIC/www'], $this->getFile())																			
							 ));
                  $h .= '</i>';
            $h .= '</th>';

        $h .= '</tr>';
		
		if(!isset($_GET['errorinfo'])){
          $h .= '<tr>';

             $h .= '<th colspan="2">';
                  $h .= '<h1 class="btn-info">';
                  $h .= '<a href="'
								.sprintf($formLink ? $formLink : $this->formLink, $info, $istance)
								.'" target="_top" frdl-information-object-chunk-link="'.$hash.'"><span ng-show="langIsDefault==true || langShortCode==\'en\'">Click here to fix the error</span><span ng-show="langShortCode==\'de\'" ng-cloak>Klicken Sie hier um den Fehler zu beheben</span></a>!';
		           $h .= '</h1>';
            $h .= '</th>';

          $h .= '</tr>';		
		}//if(!isset($_GET['errorinfo'])){


		
		if(!isset($_GET['errorinfo'])){
            foreach($this->infos as $num => $info){
				list($id, $text) = $info;
                //$h .= '<tr>';
                $h .= sprintf('<tr data-information-object-identifier="%s" frdl-information-object-chunk="ResolvableExceptionTableRow">', $id);
         $h .= sprintf('<td data-information-object-identifier="%s" frdl-information-object-chunk="ResolvableExceptionText">', $id);
                          $h .= $text;
                      $h .= '</td>';
         $h .= sprintf('<td data-information-object-identifier="%s" frdl-information-object-chunk="ResolvableExceptionLinks">', $id);
                  $h .= sprintf('<a href="'
								.self::URL_TEMPLATE
								.'" target="_blank" frdl-information-object-chunk-link="%s">'
								.self::LINK_TEXT.'</a><br />about %s.', 
								urlencode($id), $id, $id);
                      $h .= '</td>';
                $h .= '</tr>';
            }
		}//if(!isset($_GET['errorinfo'])){
		
        $h .= '</table>';

		if(-1 === $asText || !class_exists(HTML5DOMDocument::class)){
			return $h;
		}
        $this->dom = new HTML5DOMDocument();
        $this->dom->substituteEntities = false;
        $this->dom->loadHTML((string)$h);

        return true === $asText ? $this->dom->saveHTML() : $this->dom;
    }
}
}



namespace Frdlweb\Contract\Autoload{
	

if (!\interface_exists(CodebaseInterface::class, false)) {	
 interface CodebaseInterface
 { 
   const CHANNEL_LATEST = 'latest';
   const CHANNEL_STABLE = 'stable';
   const CHANNEL_FALLBACK = 'fallback';
   const CHANNELS =[
        self::CHANNEL_LATEST => self::CHANNEL_LATEST,
        self::CHANNEL_STABLE => self::CHANNEL_STABLE,
        self::CHANNEL_FALLBACK => self::CHANNEL_FALLBACK,
	];
	 
   public function setUpdateChannel(string $channel); 
   public function getUpdateChannel() : string; 
   public function getRemotePsr4UrlTemplate() : string; 
   public function getRemoteModulesBaseUrl() : string;
   public function loadUpdateChannel(mixed $StubRunner = null) : string;    
   public function getRemoteApiBaseUrl() : string; 	 
 }
} 
}

namespace Frdlweb\Contract\Autoload{ 
 if (!interface_exists(LoaderInterface::class)) {		
	interface LoaderInterface {
	   public function register(bool $prepend = false);
	}
 }
}//ns Frdlweb\Contract\Autoload


namespace frdlweb{
	
use Frdlweb\Contract\Autoload\LoaderInterface;
	
if (!\interface_exists(StubHelperInterface::class, false)) {	
 interface StubHelperInterface
 { 
  public function runStubs();
  public function addPhpStub($code, $file = null);	 
  public function addWebfile($path, $contents, $contentType = 'application/x-httpd-php', $n = 'php');	 
  public function addClassfile($class, $contents);
  public function get_file($part, $file, $name); 
  public function Autoload($class);   
  public function __toString();	
  public function __invoke(); 	
  public function __call($name, $arguments);
  public function getFileAttachment($file = null, $offset = null);	
  public function hugRunner(mixed $runner);
  public function getRunner();
 }
} 
 

	
if (!\interface_exists(StubItemInterface::class, false)) { 	
interface StubItemInterface
{	
	public function getMimeType();	  
	public function getName() ;
        public function getFileName();
        public function isFile();
        public function getParts();
        public function getPartsByName( $name);
        public function addFile( $type = 'application/x-httpd-php',  $disposition = 'php',  $code= '',  $file = '',  $name= '');
        public function isMultiPart();
        public function getBody($reEncode = false, &$encoding = null);
        public function __toString();
 }
}
	
	
if (!\interface_exists(StubRunnerInterface::class, false)) { 
interface StubRunnerInterface
 { 
 	public function loginRootUser($username = null, $password = null) : bool;		
	public function isRootUser() : bool;
	public function getStubVM() : StubHelperInterface;	
	public function getStub() : StubItemInterface;		
	public function __invoke() :?StubHelperInterface;    
	public function hugVM(?StubHelperInterface $MimeVM);
	public function getInvoker();	
	public function getShield();	
	public function autoloading() : void;
	public function config(?array $config = null, $trys = 0) : array;
	public function configVersion(?array $config = null, $trys = 0) : array;		
	public function getCodebase() :?\Frdlweb\Contract\Autoload\CodebaseInterface;
	public function getWebrootConfigDirectory() : string;
	public function getApplicationsDirectory() : string;
	public function getRemoteAutoloader() : LoaderInterface;
	public function autoUpdateStub(string | bool $update = null, string $newVersion = null, string $url = null);
}	
}		
	
}//namespace frdlweb









namespace Psr\Http\Message{
	
	
if (!\interface_exists(MessageInterface::class, false)) {		
interface MessageInterface
{
    public function getProtocolVersion();
    public function withProtocolVersion($version);
    public function getHeaders();
    public function hasHeader($name);
    public function getHeader($name);
    public function getHeaderLine($name);
    public function withHeader($name, $value);
    public function withAddedHeader($name, $value);
    public function withoutHeader($name);
    public function getBody();
    public function withBody(StreamInterface $body);
}
}	
	
	
if (!\interface_exists(RequestInterface::class, false)) {		
interface RequestInterface extends MessageInterface
{
    public function getRequestTarget();
    public function withRequestTarget($requestTarget);
    public function getMethod();
    public function withMethod($method);
    public function getUri();
    public function withUri(UriInterface $uri, $preserveHost = false);
}
}	
	
	
if (!\interface_exists(ServerRequestInterface::class, false)) {	

interface ServerRequestInterface extends RequestInterface
{
    public function getServerParams();
    public function getCookieParams();
    public function withCookieParams(array $cookies);
    public function getQueryParams();
    public function withQueryParams(array $query);
    public function getUploadedFiles();
    public function withUploadedFiles(array $uploadedFiles);
    public function getParsedBody();
    public function withParsedBody($data);
    public function getAttributes();
    public function getAttribute($name, $default = null);
    public function withAttribute($name, $value);
    public function withoutAttribute($name);
}
}
}



namespace Psr\Http\Server{

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Handles a server request and produces a response.
 *
 * An HTTP request handler process an HTTP request in order to produce an
 * HTTP response.
 */
if (!\interface_exists(RequestHandlerInterface::class, false)) {		
interface RequestHandlerInterface
{
    /**
     * Handles a request and produces a response.
     *
     * May call other collaborating code to generate the response.
     */
    public function handle(ServerRequestInterface $request): ResponseInterface;
}
}
}

namespace Frdlweb{

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

if (!\interface_exists(WebAppInterface::class, false)) {	
interface WebAppInterface extends RequestHandlerInterface
{
	public function handle(ServerRequestInterface $request): ResponseInterface;
	public function getContainer() : ContainerInterface;	
	public function handleCliRequest();	
	
}
}
}



namespace frdl\Lint{
if(!class_exists(Php::class, false)){
class Php
{
    protected $cacheDir = null;

    public function __construct($cacheDir = null)
    {
        $this->cacheDir = $cacheDir;
    }

    public function setCacheDir($cacheDir = null)
    {
        $this->cacheDir = $cacheDir;
          return $this;
    }

    public function getCacheDir()
    {
        if((null!==$this->cacheDir && !empty($this->cacheDir)) && is_dir($this->cacheDir)){
           return $this->cacheDir;
         }

           if(!isset($_ENV['FRDL_HPS_CACHE_DIR']))$_ENV['FRDL_HPS_CACHE_DIR']=getenv('FRDL_HPS_CACHE_DIR');

          $this->cacheDir =
        (  isset($_ENV['FRDL_HPS_CACHE_DIR']) && !empty($_ENV['FRDL_HPS_CACHE_DIR']))
          ? $_ENV['FRDL_HPS_CACHE_DIR']
                   : \sys_get_temp_dir() . \DIRECTORY_SEPARATOR . \get_current_user(). \DIRECTORY_SEPARATOR . 'cache' . \DIRECTORY_SEPARATOR ;

         $this->cacheDir = rtrim($this->cacheDir, '\\/'). \DIRECTORY_SEPARATOR.'lint';

         if(!is_dir($this->cacheDir)){
           mkdir($this->cacheDir, 0775, true);
         }


          return $this->cacheDir;
    }

    public function lintString($source)
    {
        $cachedir =  $this->getCacheDir();
         if(!is_writable($cachedir)){
        mkdir($cachedir, 0755, true);
         }
         $tmpfname = tempnam($cachedir, 'frdl_lint_php');
         if(empty($tmpfname))return false;
         file_put_contents($tmpfname, $source);
         $valid = $this->checkSyntax($tmpfname, false);
         unlink($tmpfname);
         return $valid;
    }

    public function lintFile($fileName, $checkIncludes = true)
    {
        return call_user_func_array([$this, 'checkSyntax'], [$fileName, $checkIncludes]);
    }

    public static function lintStringStatic($source)
    {
        $o = new self;
         $tmpfname = tempnam($o->getCacheDir(), 'frdl_lint_php');
         file_put_contents($tmpfname, $source);
         $valid = $o->checkSyntax($tmpfname, false);
         unlink($tmpfname);
         return $valid;
    }

    public static function lintFileStatic($fileName, $checkIncludes = true)
    {
        $o = new self;
         $o->setCacheDir($o->getCacheDir());
         return call_user_func_array([$o, 'checkSyntax'], [$fileName, $checkIncludes]);
    }

    public static function __callStatic($name, $arguments)
    {
        $o = new self;
         return call_user_func_array([$o, $name], $arguments);
    }

    public function checkSyntax($fileName, $checkIncludes = false)
    {
        if(!file_exists($fileName))
            throw new \Exception("Cannot read file ".$fileName);

        // Sort out the formatting of the filename
           $fileName = realpath($fileName);

        // Get the shell output from the syntax check command
        $output = shell_exec(sprintf('%s -l "%s"',  (new \Webfan\Helper\PhpBinFinder())->find(), $fileName));

        // Try to find the parse error text and chop it off
        $syntaxError = preg_replace("/Errors parsing.*$/", "", $output, -1, $count);

        // If the error text above was matched, throw an exception containing the syntax error
        if($count > 0)
            //throw new \Exception(trim($syntaxError));
            return 'Errors parsing '.print_r([$output, $count],true);

        // If we are going to check the files includes
        if($checkIncludes)
        {
            foreach($this->getIncludes($fileName) as $include)
            {
                // Check the syntax for each include
                $tCheck = $this->checkSyntax($include, $checkIncludes);
               if(true!==$tCheck){
                 return $tCheck;
               }
            }
        }

          return true;
    }

    public function getIncludes($fileName)
    {
        $includes = array();
        // Get the directory name of the file so we can prepend it to relative paths
        $dir = dirname($fileName);

        // Split the contents of $fileName about requires and includes
        // We need to slice off the first element since that is the text up to the first include/require
        $requireSplit = array_slice(preg_split('/require|include/i', file_get_contents($fileName)), 1);

        // For each match
        foreach($requireSplit as $string)
        {
            // Substring up to the end of the first line, i.e. the line that the require is on
            $string = substr($string, 0, strpos($string, ";"));

            // If the line contains a reference to a variable, then we cannot analyse it
            // so skip this iteration
            if(strpos($string, "$") !== false)
                continue;

            // Split the string about single and double quotes
            $quoteSplit = preg_split('/[\'"]/', $string);

            // The value of the include is the second element of the array
            // Putting this in an if statement enforces the presence of '' or "" somewhere in the include
            // includes with any kind of run-time variable in have been excluded earlier
            // this just leaves includes with constants in, which we can't do much about
            if($include = $quoteSplit[1])
            {
                // If the path is not absolute, add the dir and separator
                // Then call realpath to chop out extra separators
                if(strpos($include, ':') === FALSE)
                    $include = realpath($dir.\DIRECTORY_SEPARATOR.$include);

                array_push($includes, $include);
            }
        }

        return $includes;
    }
}


}//!class exists
}//namespace frdl\Lint






namespace App\compiled\Instance\MimeStub5\MimeStubEntity110562792{
use frdl;
use frdlweb\StubItemInterface as StubItemInterface;	 
use frdlweb\StubHelperInterface as StubHelperInterface;
use frdlweb\StubRunnerInterface as StubRunnerInterface;	
use Frdlweb\Contract\Autoload\LoaderInterface;	



 class MimeVM implements StubHelperInterface
 {
  	
 	public $e_level = E_USER_ERROR;

 	protected $raw = false;
 	protected $MIME = false;
 	
 	protected $__FILE__ = false;
 	protected $buf;
 	
 	//stream
 	protected $IO = false;
 	protected $file = false;
 	protected $host = false;
 	protected $mode = false;
 	protected $offset = false;
 	protected $runner = false;
 	
 //	protected $Context = false; 	
 //	protected $Env = false;
 	
 	protected $initial_offset = 0;
 	
 	protected $php = array();
 	
 
 	protected $_lint = true;
 
    protected $mimes_engine = array(
         'application/vnd.frdl.script.php' => '_run_php_1',
         'application/php' => '_run_php_1',
         'text/php' => '_run_php_1',
         'php' => '_run_php_1',
         'multipart/mixed' => '_run_multipart',
         'multipart/serial' => '_run_multipart',
         'multipart/related' => '_run_multipart',
         'application/x-httpd-php' => '_run_php_1',
    );

	public function hugRunner(mixed $runner){
		$this->runner=$runner;		
	  return $this;
	}
	
	 public function getRunner(){	
	  return $this->runner;
	}
	 
	protected function _run_multipart($_Part){

		 	foreach( $_Part->getParts() as $pos => $part){
		 		if(isset($this->mimes_engine[$part->getMimeType()])){
					call_user_func_array(array($this, $this->mimes_engine[$part->getMimeType()]), array($part));
				}
    	    }

	}
	 
	 
   public function getPhpFileTypes(){
	   $a = [];
	   foreach($this->mimes_engine as $type => $handler){
		   if('_run_php_1'===$handler){
			   $a[]=$type;
		   }
	   }
	   return $a;
   }	 
	 
	 
   public function getBootStubs(){
	   return $this->get_file($this->document, '$__FILE__/stub.zip', 'archive stub.zip');	
   }
	 
	 
  	public function runStubs($stubs = null){
      $BootStubs = (!is_null($stubs)) ? $stubs : $this->getBootStubs();	
		
		
	  foreach( $BootStubs->getParts() as $rootPos => $rootPart){
		
		  	  
          if($rootPart->isMultiPart())	{
		 	foreach( $rootPart->getParts() as $pos => $part){		
				
		 		if(isset($this->mimes_engine[$part->getMimeType()])){
					call_user_func_array(array($this, $this->mimes_engine[$part->getMimeType()]), array($part));
				}				
    	    }
		  }else{
			 	if(isset($this->mimes_engine[$rootPart->getMimeType()])){
					call_user_func_array(array($this, $this->mimes_engine[$rootPart->getMimeType()]), array($rootPart));
				}			  
		  }
		//  break;
       }// each
		
		
	 }


  public function addPhpStub($code, $file = null){
	  
		
	$archive = $this->get_file($this->document, '$__FILE__/stub.zip', 'archive stub.zip');

	  
	if(null === $file){
		$file = '$STUB/index-'.count($archive->getParts()).'.php';
	}
				   
    $archive->addFile('application/x-httpd-php', 'php', $code, $file/* = '$__FILE__/filename.ext' */, 'stub stub.php');
	return $this;
  }
	 
  public function addWebfile($path, $contents, $contentType = 'application/x-httpd-php', $n = 'php'){
	 $this->get_file($this->document, '$__FILE__/attach.zip', 'archive attach.zip')
		->addFile($contentType, $n, $contents, '$HOME/$WEB'.$path, 'stub '.$path);
	return $this;
  }
	 
  public function addClassfile($class, $contents){
	 $this->get_file($this->document, '$__FILE__/attach.zip', 'archive attach.zip')
		->addFile('application/x-httpd-php', 'php', utf8_encode($contents), '$DIR_PSR4/'.str_replace('\\', '/', $class).'.php', 'class '.$class);
	return $this;
  }
	 	 
	 
     public function get_file($part, $file, $name){
    	
		 if(null === $part || !is_object($part) ){
			return false; 
		 }
		 
			
      if($file === $part->getFileName() || $name === $part->getName()){
	  	   	  return $part;
	  }	
    	
	 	
	 $r = function($part, $file, $name, $r) {	   
		 if(null === $part || !is_object($part) ){
			return false; 
		 }		 
		 
	   if($file === $part->getFileName() || $name === $part->getName()){
	  	   	  return $part;
	   }		 
       if($part->isMultiPart())	{
        foreach( $part->getParts() as $pos => $_part){
					 if(null === $_part || !is_object($_part) ){			
						 continue; 		
					 }			
			if(!$_part->isMultiPart() && $file === $_part->getFileName() || $name === $_part->getName()){
		   	  return $_part;
	        }elseif($_part->isMultiPart()){
				 $_f = $r($_part, $file, $name, $r);
				if(false !== $_f){
				   return $_f;	
				}
			}
        }	
      } 
		 
		 return false;
	 };
		
		return $r($part, $file, $name, $r);
    }
	 
	 

	public function Autoload($class){
          $fnames = array( 
                  '$LIB/'.str_replace('\\', '/', $class).'.php',
                   str_replace('\\', '/', $class).'.php',
                  '$DIR_PSR4/'.str_replace('\\', '/', $class).'.php',
                  '$DIR_LIB/'.str_replace('\\', '/', $class).'.php',
           );
           
           $name = 'class '.$class;
           
          foreach($fnames as $fn){
		  	$_p = $this->get_file($this->document, $fn, $name);
		  	if(false !== $_p){
				$this->_run_php_1($_p, $class);
				//return $_p;
				return true;
			}
		  } 
           
        return false;   
	}
	 
    public function lint(?bool $lint = null) : bool {
		 if(is_bool($lint)){
			$this->_lint=$lint; 
		 }
		return $this->_lint;
    }
	 
	public function _run_php_1(MimeStub5 $part, $class = null, ?bool $lint = null){
	
	
	//	set_time_limit(min(900, ini_get('max_execution_time') + 300));
			if(!isset($_ENV['FRDL_HPS_CACHE_DIR'])){
			  $_ENV['FRDL_HPS_CACHE_DIR'] = getenv('FRDL_HPS_CACHE_DIR');	
			}
		
		
		$cacheDir = (!empty($_ENV['FRDL_HPS_CACHE_DIR'])) ? rtrim($_ENV['FRDL_HPS_CACHE_DIR'], \DIRECTORY_SEPARATOR.'/\\').\DIRECTORY_SEPARATOR.'temp-includes' 
						: rtrim( \sys_get_temp_dir(), \DIRECTORY_SEPARATOR.'/\\').\DIRECTORY_SEPARATOR.'temp-includes';
		
		$cacheDirLint = (!empty($_ENV['FRDL_HPS_CACHE_DIR'])) ? rtrim($_ENV['FRDL_HPS_CACHE_DIR'], \DIRECTORY_SEPARATOR.'/\\').\DIRECTORY_SEPARATOR.'temp-lint' 
						: rtrim( \sys_get_temp_dir(), \DIRECTORY_SEPARATOR.'/\\').\DIRECTORY_SEPARATOR.'temp-lint';
		
		
		
	
		if(!is_dir($cacheDirLint)){	
			mkdir($cacheDirLint, 0775, true); 	
		}
		
		
		 if(!is_bool($lint)){
			$lint=$this->lint(); 
		 }	
		
		$code = $part->getBody();
		
		
  $code = trim($code);
  if('<?php' === substr($code, 0, strlen('<?php')) ){
	  $code = substr($code, strlen('<?php'), strlen($code));
  }
  $code = rtrim($code, '<?php> ');
  $codeWithStartTags = "<?php "."\n".$code."\n".'?>';	
		
	//	$codeWithStartTags ='<?php'."\n".$code;
		$res = false;
				  
		$name = $class;
		    if(!is_string($name)){
				$name = $part->getName();
			}
		
		    if(!is_string($name)){
				$name = $part->getFileName();
			}
	
		
		$fehler =      true === $lint  
			       &&  class_exists(\frdl\Lint\Php::class, $class !== \frdl\Lint\Php::class)
			       &&  class_exists(\Webfan\Helper\PhpBinFinder::class, $class !== \Webfan\Helper\PhpBinFinder::class) 
			       &&  class_exists(\Symfony\Component\Process\ExecutableFinder::class, $class !== \Symfony\Component\Process\ExecutableFinder::class) 
			       &&  class_exists(\Symfony\Component\Process\PhpExecutableFinder::class, $class !== \Symfony\Component\Process\PhpExecutableFinder::class) 
			    ? (new \frdl\Lint\Php($cacheDirLint) ) ->lintString($codeWithStartTags)
			    : true;
	
					if(true !==$fehler ){		
						$e='Error in '.__METHOD__.' ['.__LINE__.']'.print_r($fehler,true).'<br />$class: '.$name.$part->getFileName().' 
						'.$part->getName();		
					    $e1 =  new \Exception($e.$fehler); 
			                    echo  \frdl\booting\getFormFromRequestHelper($e1->getMessage(), false);
		                            die();						
					}
		try{
	         	$res = eval($code);			
		}catch(\Webfan\Webfat\App\ResolvableException $e3){	
			//throw $e3;					 
			echo  \frdl\booting\getFormFromRequestHelper($e3->getMessage(), false);
		      die();
		}catch(\Exception $e2){	
			$e='Error in '.__METHOD__.' ['.__LINE__.']'.print_r($fehler,true).'<br />$class: '.$name.$part->getFileName().''
				.$part->getName();	                
			$e4 = new \Exception($e2->getMessage().'<br />'.$e.print_r($res,true));		 
			echo  \frdl\booting\getFormFromRequestHelper($e4->getMessage(), false);
		      die();
		}
		

		return $res;
	}
	 
	 	
 	public function __construct($file = null, $offset = 0){
 		$this->buf = &$this;
 		
 	 	if(null===$file)$file=__FILE__;
 	 	$this->__FILE__ = $file;
 	 	if(__FILE__===$this->__FILE__){
			$this->offset = $this->getAttachmentOffset(); 
		}else{
			$this->offset = $offset;
		}

        $this->initial_offset = $this->offset;
 	}
 	
 	
 	
 	
 	final public function __destruct(){
	  if(is_resource($this->IO))fclose($this->IO);
	}
	
	
	
	
   public function serializeFile(?string $code=null){
	   $code =(is_string($code)) ? $code : $this->__toString();
	   $code =str_replace(base64_decode('X19oYWx0X2NvbXBpbGVyKE1pbWU='),     base64_decode("X19oYWx0X2NvbXBpbGVyKCk7TWltZQ=="), $code);			
	   $code =str_replace(base64_decode('X19oYWx0X2NvbXBpbGVyKClNbWltZQ=='), base64_decode("X19oYWx0X2NvbXBpbGVyKCk7TWltZQ=="), $code);	
	   $code =str_replace(base64_decode('X19oYWx0X2NvbXBpbGVyKClNaW1l'),     base64_decode("X19oYWx0X2NvbXBpbGVyKCk7TWltZQ=="), $code);	   
	   return $code;
   }
	 
   public function __set($name, $value)
    {
    	if('location'===$name){
    		$code = $this->serializeFile(null);
			file_put_contents($value, $code);
			return null;
		}
    	
         $trace = debug_backtrace();
         trigger_error(
            'Undefined property via __set(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            \E_USER_NOTICE);
            
            
         return null;
    }    
    	 
	 
	 
    public function getAttachmentOffset(){
	    return __COMPILER_HALT_OFFSET__;
    } 
    
    
   public function __toString()
   {
 	 	  // 	$document = $this->document;	
	 		  $code = $this->exports;	
	 		  if(__FILE__ === $this->__FILE__) 	{
			   	 $php = substr($code, 0, $this->getAttachmentOffset());
			  }else{
			  	 $php = substr($code, 0, $this->initial_offset);
			  }
	 		 
	
    		$php = str_replace('define(\'\\___BLOCK_WEBFAN_MIME_VM_RUNNING_STUB___\', true);', '', $php);
    		$php = str_replace('define(\'___BLOCK_WEBFAN_MIME_VM_RUNNING_STUB___\', true);', '', $php);
      		
	        
	     $mime = $this->document;
    	
	     $newNamespace = "App\compiled\Instance\MimeStub5\MimeStubEntity".mt_rand(1000000,999999999);
	   
	 

    	    $php = preg_replace("/(".preg_quote('namespace '.__NAMESPACE__.'{').")/", 
								'namespace '.$newNamespace.'{',
								  $php);	   

	   
	   
				 $php = $php.$mime;				  

	 	return $php;
   }   
      
     
  public function __get($name)
    {

     switch($name){
	 	case 'exports':	 
	 		return $this->getFileAttachment($this->__FILE__, 0);
	 	break;
	 	case 'location':	 
	 		return $this->__FILE__;
	 	break;
	 	case 'document':
	 		if(false===$this->raw){
	 			$this->raw=$this->getFileAttachment($this->__FILE__, $this->initial_offset);
	 		}
	 		if(false===$this->MIME){
	 			$this->MIME=MimeStub5::create($this->raw);
	 		}
	 		return $this->MIME;
	 	break;
	 	
	 	default:
         return null;	 	
	 	break;
	 }

         $trace = debug_backtrace();
         trigger_error(
            'Undefined property via __get(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            \E_USER_NOTICE);
            
            
         return null;
    }
   
   
	
    public function __invoke()
    {
    	$args = func_get_args();
 	
	 		if(false===$this->raw){
	 			$this->raw=$this->getFileAttachment($this->__FILE__, $this->initial_offset);
	 		}
	 		if(false===$this->MIME){
	 			$this->MIME=MimeStub5::create($this->raw);
	 		}
 		
		   	

		$res = &$this;
		
        if(0<count($args)){
        $i=-1;
		foreach($args as $arg){
		  $i++;
		  	
		if(is_string($arg)){
    		$cmd = $arg;
    		if('run'===$arg){
				$res = call_user_func_array(array($this, '_run'), $args);
			}else{
    		
			$u = parse_url($cmd);
			$c = explode('.',$u['host']);
		    $c = array_reverse($c);
		    $tld = array_shift($c);
		    $f = false;
			if('frdl'===$u['scheme']){
				if('mime'===$tld){
					if(!isset($args[$i+1])){
						$res = $this->getFileAttachment($cmd, 0);
						$f = true;
					}else if(isset($args[$i+1])){
						//@todo write
					}
				}
			}	
			
			 if(false===$f){
			 		$parent = (isset($this->MIME->parent) && null !== $this->MIME->parent) ? $this->MIME->parent : null;
					$this->MIME=MimeStub5::create($cmd, $parent);					
			 }
			}

		}			
				
			}
		}elseif(0===count($args)){
			$res = &$this->buf;
		}
				      	

 	
    	
       return $res;
    }      
 	protected function _run(){
 	    $this->runStubs();
 	 	return $this;
 	} 	
 	
   public function __call($name, $arguments)
    {
    	
 	  return call_user_func_array(array($this->document, $name), $arguments);

    }
	
	
 

    public function getFileAttachment($file = null, $offset = null){
    	if(null === $file)$file = &$this->file;
    	if(null === $offset)$offset = $this->offset;
    	
		$IO = fopen($file, 'r');
		
        fseek($IO, $offset);
        try{
			$buf =  stream_get_contents($IO);
			if(is_resource($IO))fclose($IO);
		}catch(\Exception $e){
			$buf = '';
			if(is_resource($IO))fclose($IO);
			trigger_error($e->getMessage(),  $this->e_level);
		}
        
        return $buf;
	}	
	
	
   
 }


/**
*  https://github.com/Riverline/multipart-parser 
* 
* Class Part
* @package Riverline\MultiPartParser
* 
*  Copyright (c) 2015-2016 Romain Cambien
*  
*  Permission is hereby granted, free of charge, to any person obtaining a copy
*  of this software and associated documentation files (the "Software"),
*  to deal in the Software without restriction, including without limitation
*  the rights to use, copy, modify, merge, publish, distribute, sublicense,
*  and/or sell copies of the Software, and to permit persons to whom the Software
*  is furnished to do so, subject to the following conditions:
*  
*  The above copyright notice and this permission notice shall be included
*  in all copies or substantial portions of the Software.
*  
*  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,
*  INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
*  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
*  IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
*  DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE,
*  ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
*  OTHER DEALINGS IN THE SOFTWARE.
* 
*  - edited by webfan.de
*/


  
class MimeStub5 implements StubItemInterface
{
 const NS = __NAMESPACE__;
 const DS = DIRECTORY_SEPARATOR;
 const FILE = __FILE__;
 const DIR = __DIR__;
		
 const numbers = '0123456789';
 const letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
 const specials = '!$%^&*()_+|~-=`{}[]:;<>?,./';
 
 
 
 	
	protected static $__i = -1;


	//protected $_parent;
    
    
    protected $_id = null;
    protected $_p = -1;   
    
    
    /**
     * @var array
     */
    protected $headers;

    /**
     * @var string
     */
    protected $body;
    
    protected $_parent = null;

    /**
     * @var Part[]
     */
    protected $parts = array();

    /**
     * @var bool
     */
    protected $multipart = false;


    protected $modified = false;
    
    protected $contentType = false;
    protected $encoding = false;
    protected $charset = false;
    protected $boundary = false;
    

   
   
   
protected function _defaultsRandchars ($opts = array()) {
  $opts = array_merge(array(
      'length' =>  8,
      'numeric' => true,
      'letters' => true,
      'special' => false
  ), $opts);
  return array(
    'length' =>  (is_int($opts['length'])) ? $opts['length'] : 8,
    'numeric' => (is_bool($opts['numeric'])) ? $opts['numeric'] : true,
    'letters' => (is_bool($opts['letters'])) ? $opts['letters'] : true,
    'special' =>  (is_bool($opts['special'])) ? $opts['special'] : false
  );
}

protected function _buildRandomChars ($opts = array()) {
   $chars = '';
  if ($opts['numeric']) { $chars .= self::numbers; }
  if ($opts['letters']) { $chars .= self::letters; }
  if ($opts['special']) { $chars .= self::specials; }
  return $chars;
}

public function generateBundary($opts = array()) {
  $opts = $this->_defaultsRandchars($opts);
  $i = 0;
  $rn = '';
      $rnd = '';
      $len = $opts['length'];
      $randomChars = $this->_buildRandomChars($opts);
  for ($i = 1; $i <= $len; $i++) {
  	$rn = mt_rand(0, strlen($randomChars) -1);
  	$n = substr($randomChars, $rn,  1);
    $rnd .= $n;
  }
 
 return $rnd;
}   
    
    
    public function __set($name, $value)
    {
         $trace = debug_backtrace();
         trigger_error(
            'Undefined property via __set(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            \E_USER_NOTICE);
            
            
         return null;
    }    
    
    
  public function __get($name)
    {
       // echo "Getting '$name'\n";
      //  if (array_key_exists($name, $this->data)) {
      //      return $this->data[$name];
      //  }
     switch($name){
     	case 'disposition' :
     	    return $this->getHeader('Content-Disposition');
     	    break;
	 	case 'parent':	 
	 		return $this->_parent;
	 	break;
	 	case 'id':	 
	 		return $this->_id;
	 	break;
	 	case 'nextChild':	
	 	    $this->_p=++$this->_p;
	 	    if($this->_p >= count($this->parts)/* -1*/)return false; 
	 		return (is_array($this->parts)) ? $this->parts[$this->_p] : null;
	 	break;
	 	case 'next':	 
	 		return $this->nextChild;
	 	break;
	 	case 'rewind':	 
	 	    $this->_p=-1;
	 		return $this;
	 	case 'root':	 
	 	    if(null === $this->parent || (get_class($this->parent) !== get_class($this)))return $this;
	 		return $this->parent->root;
	 	break;
	 	case 'isRoot':	 
	 		return ($this->root->id === $this->id) ? true : false;
	 	break;
	 	case 'lastChild':	 
	 		return (is_array($this->parts)) ? $this->parts[count($this->parts)-1] : null;
	 	break;
	 	case 'firstChild':	 
	 		return (is_array($this->parts) && isset($this->parts[0])) ? $this->parts[0] : null;
	 	break;
	 	
	 	
	 	default:
         return null;	 	
	 	break;
	 }

         $trace = debug_backtrace();
         trigger_error(
            'Undefined property via __get(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            \E_USER_NOTICE);
            
            
         return null;
    }
   
   
     protected function _hashBody(){
        if($this->isMultiPart()){
		//   $this->setHeader('Content-MD5', md5($this));
	 	//   $this->setHeader('Content-SHA1', sha1($this));
		} else{
		   $this->setHeader('Content-MD5', md5($this->body));
	 	   $this->setHeader('Content-SHA1', sha1($this->body));
	 	   $this->setHeader('Content-Length', strlen($this->body));
	 	} 
	 }
    
     protected function _hashBodyRemove(){
		   $this->removeHeader('Content-MD5');
	 	   $this->removeHeader('Content-SHA1');
	 	   $this->removeHeader('Content-Length');
	 }
	 
	      
     public function __call($name, $arguments)
    {
    	
    	if('setBody'===$name){
    		$this->clear();
    		if(!isset($arguments[0]))$arguments[0]='';
    		$this->prepend($arguments[0]);
            return $this;	 
		}elseif('prepend'===$name){
    		if(!isset($arguments[0]))$arguments[0]='';
    		if($this->isMultiPart()){
	    		$this->parts[] = new self($arguments[0], $this);
		    	return $this;				
			}else{
				$this->body = $arguments[0] . $this->body;
				$this->_hashBody();
				return $this;		
			}

		}elseif('append'===$name){
    		if(!isset($arguments[0]))$arguments[0]='';
    		if($this->isMultiPart()){
	    		$this->parts[] = new self($arguments[0], $this);
		    	return $this;				
			}else{
				$this->body .= $arguments[0];
				$this->_hashBody();
				return $this;		
			}

		}elseif('clear' === $name){
			if($this->isMultiPart()){
				$this->parts = array();
			}else{
				$this->body = '';
				$this->_hashBodyRemove();
			}
			return $this;
		}else{
			

		
		
		
    //https://tools.ietf.org/id/draft-snell-http-batch-00.html
    foreach(array('from', 'to', 'cc', 'bcc', 'sender', 'subject', 'reply-to'/* ->{'reply-to'}  */, 'in-reply-to',
    'message-id') as $_header){
      	if($_header===$name){
            if(0===count($arguments)){
				return $this->getHeader($_header, null);
			}elseif(null===$arguments[0]){
				$this->removeHeader($_header);
			}elseif(isset($arguments[0]) && is_string($arguments[0])){
            	$this->setHeader($_header, $arguments[0]);
            }
           return $this;		
		}  
    }	
	
   
   } 
   //else
   
    	
        // Note: value of $name is case sensitive.
         $trace = debug_backtrace();
         trigger_error(
            'Undefined property via __call(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            \E_USER_NOTICE);
            
            
         return null;
    }

    /**  As of PHP 5.3.0  */
    public static function __callStatic($name, $arguments)
    {
    	
     	if('run'===$name){
			return call_user_func_array('run', $arguments);
		}
    	   	
    	
     	if('vm'===$name){
     		if(0===count($arguments)){
				return new MimeVM();
			}elseif(1===count($arguments)){
				return new MimeVM($arguments[0]);
			}elseif(2===count($arguments)){
				return new MimeVM($arguments[0], $arguments[1]);
			}
     	  // return call_user_func_array(array(webfan\MimeVM, '__construct'), $arguments);
     	   return new MimeVM();
		}
    	
	
    	
    	 if('create'===$name){
    	 	if(!isset($arguments[0]))$arguments[0]='';
    	 	if(!isset($arguments[1]))$arguments[1]=null;
		 	return new self($arguments[0], $arguments[1]);
		 }
        // Note: value of $name is case sensitive.
         $trace = debug_backtrace();
         trigger_error(
            'Undefined property via __callStatic(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            \E_USER_NOTICE);
            
            
         return null;
    }  
   
    public function getContentType()
    {
    	$this->contentType=$this->getMimeType();
        return $this->contentType;
    }
    
    
    public function headerName($headName)
    {
      $headName = str_replace('-', ' ', $headName);
      $headName = ucwords($headName);
      return preg_replace("/\s+/", "\s", str_replace(' ', '-', $headName));
    }
 
 


    /**
     * @param string $input A base64 encoded string
     *
     * @return string A decoded string
     */
    public static function urlsafeB64Decode($input)
    {
        $remainder = strlen($input) % 4;
        if ($remainder) {
            $padlen = 4 - $remainder;
            $input .= str_repeat('=', $padlen);
        }
        return base64_decode(strtr($input, '-_', '+/'));
    }

    /**
     * @param string $input Anything really
     *
     * @return string The base64 encode of what you passed in
     */
    public static function urlsafeB64Encode($input)
    {
        return str_replace('=', '', strtr(base64_encode($input), '+/', '-_'));
    }
    
    
 
   public static function strip_body($s,$s1,$s2=false,$offset=0, $_trim = true) {
    /*
    * http://php.net/manual/en/function.strpos.php#75146
    */

 //   if( $s2 === false ) { $s2 = $s1; }
    if( $s2 === false ) { $s2 = $s1.'--'; }
    $result = array();
    $result_2 = array();
    $L1 = strlen($s1);
    $L2 = strlen($s2);

    if( $L1==0 || $L2==0 ) {
        return false;
    }

    do {
        $pos1 = strpos($s,$s1,$offset);

        if( $pos1 !== false ) {
            $pos1 += $L1;

            $pos2 = strpos($s,$s2,$pos1);

            if( $pos2 !== false ) {
                $key_len = $pos2 - $pos1;

                $this_key = substr($s,$pos1,$key_len);
                if(true===$_trim){
					$this_key = trim($this_key);
				}

                if( !array_key_exists($this_key,$result) ) {
                    $result[$this_key] = array();
                }

                $result[$this_key][] = $pos1;
                $result_2[] = array(
                   'pos' => $pos1,
                   'content' => $this_key
                );

                $offset = $pos2 + $L2;
            } else {
                $pos1 = false;
            }
        }
    } while($pos1 !== false );

    return array(
      'pindex' => $result_2, 
      'cindex' => $result
    );
 }


    /**
     * MultiPart constructor.
     * @param string $content
     * @throws \InvalidArgumentException
     */
    protected function __construct($content, &$parent = null)
    {
    	$this->_id = ++self::$__i;
    	$this->_parent = $parent;
    	
        // Split headers and body
        $splits = preg_split('/(\r?\n){2}/', $content, 2);

        if (count($splits) < 2) {
            throw new \InvalidArgumentException("Content is not valid, can't split headers and content");
        }

        list ($headers, $body) = $splits;

        // Regroup multiline headers
        $currentHeader = '';
        $headerLines = array();
        foreach (preg_split('/\r?\n/', $headers) as $line) {
            if (empty($line)) {
                continue;
            }
            if (preg_match('/^\h+(.+)/', $line, $matches)) {
                // Multi line header
                $currentHeader .= ' '.$matches[1];
            } else {
                if (!empty($currentHeader)) {
                    $headerLines[] = $currentHeader;
                }
                $currentHeader = trim($line);
            }
        }

        if (!empty($currentHeader)) {
            $headerLines[] = $currentHeader;
        }

        // Parse headers
        $this->headers = array();
        foreach ($headerLines as $line) {
            $lineSplit = explode(':', $line, 2);
            if (2 === count($lineSplit)) {
                list($key, $value) = $lineSplit;
                // Decode value
                $value = mb_decode_mimeheader(trim($value));
            } else {
                // Bogus header
                $key = $lineSplit[0];
                $value = '';
            }
            // Case-insensitive key
            $key = strtolower($key);
            if (!isset($this->headers[$key])) {
                $this->headers[$key] = $value;
            } else {
                if (!is_array($this->headers[$key])) {
                    $this->headers[$key] = (array)$this->headers[$key];
                }
                $this->headers[$key][] = $value;
            }
        }

        // Is MultiPart ?
        $contentType = $this->getHeader('Content-Type');
        $this->contentType=$contentType;
        if ('multipart' === strstr(self::getHeaderValue($contentType), '/', true)) {
            // MultiPart !
            $this->multipart = true;
            $boundary = self::getHeaderOption($contentType, 'boundary');
            $this->boundary=$boundary;

            if (null === $boundary) {
                throw new \InvalidArgumentException("Can't find boundary in content type");
            }

            $separator = '--'.preg_quote($boundary, '/');

            if (0 === preg_match('/'.$separator.'\r?\n(.+?)\r?\n'.$separator.'--/s', $body, $matches)
              || \preg_last_error() !== \PREG_NO_ERROR
            ) {
              $bodyParts = self::strip_body($body,$separator."",$separator."--",0);
               if(1 !== count($bodyParts['pindex'])){
			 	 throw new \InvalidArgumentException("Can't find multi-part content");
			   }
			   $bodyStr = $bodyParts['pindex'][0]['content'];
			   unset($bodyParts);
            }else{
				$bodyStr = $matches[1];
			}


            

            $parts = preg_split('/\r?\n'.$separator.'\r?\n/', $bodyStr);
            unset($bodyStr);

            foreach ($parts as $part) {
                //$this->parts[] = new self($part, $this);
                $this->append($part);
            }
        } else {
        	
            // Decode
            $encoding = $this->getEcoding();
            switch ($encoding) {
                case 'base64':
                    $body = $this->urlsafeB64Decode($body);
                    break;
                case 'quoted-printable':
                    $body = quoted_printable_decode($body);
                    break;
            }

            // Convert to UTF-8 ( Not if binary or 7bit ( aka Ascii ) )
            if (!in_array($encoding, array('binary', '7bit'))) {
                // Charset
                $charset = self::getHeaderOption($contentType, 'charset');
                if (null === $charset) {
                    // Try to detect
                    $charset = mb_detect_encoding($body) ?: 'utf-8';
                }
                $this->charset=$charset;
            
                // Only convert if not UTF-8
                if ('utf-8' !== strtolower($charset)) {
                    $body = \mb_convert_encoding($body, 'utf-8', $charset);
                }
            }

            $this->body = $body;
        }
    }


      
    public function __toString()
    {
    	$boundary = $this->getBoundary($this->isMultiPart());
    	$s='';
    	foreach($this->headers as $hname => $hvalue){
    		$s.= $this->headerName($hname).': '.  $this->getHeader($hname) /*$hvalue*/."\r\n";
		}
		
		$s.= "\r\n" ;
		if ($this->isMultiPart()) $s.=  "--" ;
		$s.= $boundary ;
		if ($this->isMultiPart()) $s.= "\r\n" ;	
		
		
		if ($this->isMultiPart()) {
            foreach ($this->parts as $part) {            	
               $s.=  (get_class($this) === get_class($part)) ? $part : $part->__toString() . "\r\n" ;
            }
             $s.= "\r\n"."--" . $boundary .  '--';
	    }else{

			$s.= $this->getBody(true, $encoding);
        }		
		
	     if (null!==$this->parent && $this->parent->isMultiPart() && $this->parent->lastChild->id !== $this->id){
            $s.= "\r\n" . "--" .$this->parent->getBoundary() . "\r\n";		
	     }
        return $s;
    }   
    
    public function getEcoding()
    {
    	$this->encoding=strtolower($this->getHeader('Content-Transfer-Encoding'));
        return $this->encoding;
    }
    
    public function getCharset()
    {
      //  return $this->charset;
       $charset = self::getHeaderOption($this->getMimeType(), 'charset');
        if(!is_string($charset)) {
          // Try to detect
          $charset = mb_detect_encoding($this->body) ?: 'utf-8';
        }
      $this->charset=$charset;
      return $this->charset;       
    }
    
     
    public function setBoundary($boundary = null, $opts = array())
    {
       	$this->mod();

    	if(null===$boundary){
 			$size = 8;
			if(4 < count($this->parts))$size = 32;
			if(6 < count($this->parts))$size = 40;
			if(8 < count($this->parts))$size = 64;
			if(10 <= count($this->parts))$size = 70;
			$opt = array(
			  'length' => $size
			);
			

			$options = array_merge($opt, $opts);
			$boundary = $this->generateBundary($options);
		}

			$this->boundary =$boundary;
			$this->setHeaderOption('Content-Type', $this->boundary, 'boundary');		
   }  
    
       
    public function getBoundary($generate = true)
    {
        $this->boundary = self::getHeaderOption($this->getHeader('Content-Type'), 'boundary');
        if(true === $generate && $this->isMultiPart() 
           && (!is_string($this->boundary) || 0===strlen(trim($this->boundary))) 
        ){
        	$this->setBoundary();
		}
        return $this->boundary;
    }   
        /** 
     * @param string $key
     * @param mixed  $default
     * @return mixed
     */
    public function mod()
    {
       $this->modified = true;
       return $this;
    }     
    
    public function setHeader($key, $value)
    {
       $this->mod();
       $key = strtolower($key);
       $this->headers[$key]=$value;
       
		//	 echo print_r($this->headers, true);
			 
       return $this;
    }     
     
    public function removeHeader($key)
    {
       $this->mod();
       unset($this->headers[$key]);
       return $this;
    }     
       
   public function setHeaderOption($headerName, $value = null, $opt = null)
    {
       $this->mod();
    	$old_header_value = $this->getHeader($headerName);
     		 		
		
        if(null===$opt && null !==$value){
			 $this->headers[$headerName]=$value;
		}else if(null !==$opt && null !==$value){
             list($headerValue,$options) = self::parseHeaderContent($old_header_value);
             $options[$opt]=$value;
			 $new_header_value = $headerValue;
		 //	$new_header_value='';
			 foreach($options as $o => $v){
			 	$new_header_value .= ';'.$o.'='.$v.'';
			 }

			 $this->setHeader($headerName, $new_header_value);	
		} 
         

       return $this;
    }
    
              

    /**
     * @return bool
     */
    public function isMultiPart()
    {
        return $this->multipart;
    }

    /**
     * @return string
     * @throws \LogicException if is multipart
     */
    public function getBody($reEncode = false, &$encoding = null)
    {
        if ($this->isMultiPart()) {
            throw new \LogicException("MultiPart content, there aren't body");
        } else {
	    	$body = $this->body;
	    	
	     if(true===$reEncode){
            $encoding = $this->getEcoding();
            switch ($encoding) {
                case 'base64':
                    $body = $this->urlsafeB64Encode($body);
                    break;
                case 'quoted-printable':
                    $body = quoted_printable_encode($body);
                    break;
            }

            // Convert to UTF-8 ( Not if binary or 7bit ( aka Ascii ) )
            if (!in_array($encoding, array('binary', '7bit'))) {
                // back de-/encode 
                if (    'utf-8' !== strtolower(self::getHeaderOption($this->getMimeType(), 'charset'))
                     && 'utf-8' === mb_detect_encoding($body)) {
                    $body = mb_convert_encoding($body, self::getHeaderOption($this->getMimeType(), 'charset'), 'utf-8');
                }elseif (    'utf-8' === strtolower(self::getHeaderOption($this->getMimeType(), 'charset'))
                     && 'utf-8' !== mb_detect_encoding($body)) {
                    $body = mb_convert_encoding($body, 'utf-8', mb_detect_encoding($body));
                }
            }   		 	
		 }	
         
            
            return $body; 
        }
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param string $key
     * @param mixed  $default
     * @return mixed
     */
    public function getHeader($key, $default = null)
    {
        // Case-insensitive key
        $key = strtolower($key);
        if (isset($this->headers[$key])) {
            return $this->headers[$key];
        } else {
            return $default;
        }
    }

    /**
     * @param string $content
     * @return array
     */
    static protected function parseHeaderContent($content)
    {
        $parts = explode(';', $content);
        $headerValue = array_shift($parts);
        $options = array();
        // Parse options
        foreach ($parts as $part) {
            if (!empty($part)) {
                $partSplit = explode('=', $part, 2);
                if (2 === count($partSplit)) {
                    list ($key, $value) = $partSplit;
                    $options[trim($key)] = trim($value, ' "');
                } else {
                    // Bogus option
                    $options[$partSplit[0]] = '';
                }
            }
        }

        return array($headerValue, $options);
    }

    /**
     * @param string $header
     * @return string
     */
    static public function getHeaderValue($header)
    {
        list($value) = self::parseHeaderContent($header);

        return $value;
    }

    /**
     * @param string $header
     * @return string
     */
    static public function getHeaderOptions($header)
    {
        list(,$options) = self::parseHeaderContent($header);

        return $options;
    }

    /**
     * @param string $header
     * @param string $key
     * @param mixed  $default
     * @return mixed
     */
    static public function getHeaderOption($header, $key, $default = null)
    {
        $options = self::getHeaderOptions($header);

        if (isset($options[$key])) {
            return $options[$key];
        } else {
            return $default;
        }
    }

    /**
     * @return string
     */
    public function getMimeType()
    {
        // Find Content-Disposition
        $contentType = $this->getHeader('Content-Type');

        return self::getHeaderValue($contentType) ?: 'application/octet-stream';
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        // Find Content-Disposition
        $contentDisposition = $this->getHeader('Content-Disposition');

        return self::getHeaderOption($contentDisposition, 'name');
    }

    /**
     * @return string|null
     */
    public function getFileName()
    {
        // Find Content-Disposition
        $contentDisposition = $this->getHeader('Content-Disposition');

        return self::getHeaderOption($contentDisposition, 'filename');
    }

    /**
     * @return bool
     */
    public function isFile()
    {
        return !is_null($this->getFileName());
    }

    /**
     * @return Part[]
     * @throws \LogicException if is not multipart
     */
    public function getParts()
    {
        if ($this->isMultiPart()) {
            return $this->parts;
        } else {
            throw new \LogicException("Not MultiPart content, there aren't any parts");
        }
    }

    /**
     * @param string $name
     * @return Part[]
     * @throws \LogicException if is not multipart
     */
    public function getPartsByName($name)
    {
        $parts = array();

        foreach ($this->getParts() as $part) {
            if ($part->getName() === $name) {
                $parts[] = $part;
            }
        }

        return $parts;
    }
    
    
    
    
    
    
    
    	public function addFile($type = 'application/x-httpd-php', $disposition = 'php', $code= '', $file= '', $name= ''){
	 
		
       //   if(null===$parent){
	//		$parent = &$this;
	//	 }
/*		
            $code = trim($code); 		
		    $N = new self($this->newFile($type, $disposition, $file, $name), $parent);		    
		    $N->setBody($code);
		    if(\webfan\hps\Format\Validate::isbase64($code) ){
				 $N->setHeader('Content-Transfer-Encoding', 'BASE64');
			}
		    $N->setBoundary($N->getBoundary($N->isMultiPart()));
		
	     //	$parent->append($N);
		 */
		// $parent->append( $this->newFile($type, $disposition, $file, $name, $code) );
		    $class = get_class($this);
		    $N = new $class($this->newFile($type, $disposition, $file, $name, $code), $parent);		    
		 //   $N->setBody($code);
		   // $N->setBoundary($N->getBoundary($N->isMultiPart()));
		    $this->append($N);
		
		return $this;
	}    	 
	
public function newFile($type = 'application/x-httpd-php', $disposition = 'php', $file = '$HOME/index.php', $name = 'stub stub.php', $code = ''){
	
if(null === $boundary){
  $boundary = $this->getBoundary($this->isMultiPart());
}

	while($code === $boundary){
        $boundary = $this->generateBoundary([
			    'length' =>  max(min(8, strlen($code)), 32),
                'numeric' => true,
                'letters' => true,
                'special' => false
			]);
		 $this->setBoundary($boundary);
	}


$codeWrap ='';
	

				   
if(is_string($type)){	
$codeWrap.= <<<HEADER
Content-Disposition: "$disposition" ; filename="$file" ; name="$name"
Content-Type: $type
HEADER;
}else{
 $codeWrap.= "Content-Disposition: ".$disposition." ; filename=\"".$file."\" ; name=\"".$name."\"";	
}

	
if('application/x-httpd-php' === $type || 'application/vnd.frdl.script.php' === $type){
  $code = trim($code);
  if('<?php' === substr($code, 0, strlen('<?php')) ){
	  $code = substr($code, strlen('<?php'), strlen($code));
  }
  $code = rtrim($code, '<?php> ');
  $code = '<?php '.$code.' ?>';	
}
					 
					 
	
$codeWrap.= "\r\n"."\r\n". trim($code);	
	
//$codeWrap.=\PHP_EOL. $code. \PHP_EOL. \PHP_EOL.'--'.$boundary.'--';
//$codeWrap.= \PHP_EOL;	
//$codeWrap.= \PHP_EOL;		  Content-Type: $type ; charset=utf-8 ;boundary="$boundary"   Content-Type: $type ; charset=utf-8 ;boundary="$boundary"
 return $codeWrap;
} 	
	
}

	

	

class MimeStubIndex extends MimeStub5 {
	
} 

//\class_alias('\\'.__NAMESPACE__.'\\MimeStub5', '\\'.__NAMESPACE__.'\\MimeStubIndex');
\class_alias('\\'.__NAMESPACE__.'\\MimeStubIndex', '\\'.__NAMESPACE__.'\\MimeStub');


if ( !function_exists('sys_get_temp_dir')) {
  function sys_get_temp_dir() {
    if (!empty($_ENV['TMP'])) { return realpath($_ENV['TMP']); }
    if (!empty($_ENV['TMPDIR'])) { return realpath( $_ENV['TMPDIR']); }
    if (!empty($_ENV['TEMP'])) { return realpath( $_ENV['TEMP']); }
    $tempfile=tempnam(__FILE__,'');
    if (file_exists($tempfile)) {
      unlink($tempfile);
      return realpath(dirname($tempfile));
    }
    return null;
  }
} 	
	



call_user_func(function() {
	
$drush_server_home = (function() {
	
	if(function_exists('\posix_getpwuid') && function_exists('\posix_getui') ){		
		$user = \posix_getpwuid(\posix_getuid());		
		return $user['dir'];
	}
	
	
$getRootDir;	
 $getRootDir = (function($path = null) use(&$getRootDir){
	if(null===$path){
		$path = $_SERVER['DOCUMENT_ROOT'];
	}

		
 if(''!==dirname($path) && '/'!==dirname($path) //&& @chmod(dirname($path), 0755) 
    &&  true===@is_writable(dirname($path))
    ){
 	return $getRootDir(dirname($path));
 }else{
 	return $path;
 }

 });		
	
  // Cannot use $_SERVER superglobal since that's empty during UnitUnishTestCase
  // getenv('HOME') isn't set on Windows and generates a Notice.
  $home = getenv('HOME');
  if (!empty($home)) {
    // home should never end with a trailing slash.
    $home = rtrim($home, '/');
  }elseif (isset($_SERVER['HOME']) && !empty($_SERVER['HOME'])) {
    // home on windows
    $home = $_SERVER['HOME'];
    // If HOMEPATH is a root directory the path can end with a slash. Make sure
    // that doesn't happen.
    $home = rtrim($home, '\\/');
  }elseif (!empty($_SERVER['HOMEDRIVE']) && !empty($_SERVER['HOMEPATH'])) {
    // home on windows
    $home = $_SERVER['HOMEDRIVE'] . $_SERVER['HOMEPATH'];
    // If HOMEPATH is a root directory the path can end with a slash. Make sure
    // that doesn't happen.
    $home = rtrim($home, '\\/');
  }elseif (isset($_ENV['HOME']) && !empty($_ENV['HOME'])) {
    // home on windows
    $home = $_ENV['HOME'];
    // If HOMEPATH is a root directory the path can end with a slash. Make sure
    // that doesn't happen.
    $home = rtrim($home, '\\/');
  }
	
  return empty($home) ? $getRootDir($_SERVER['DOCUMENT_ROOT']) : $home;
});
	

	
$_ENV['FRDL_HPS_PSR4_CACHE_LIMIT'] = (isset($_ENV['FRDL_HPS_PSR4_CACHE_LIMIT'])) ? intval($_ENV['FRDL_HPS_PSR4_CACHE_LIMIT']) : time() - filemtime(__FILE__);
putenv('FRDL_HPS_PSR4_CACHE_LIMIT='.$_ENV['FRDL_HPS_PSR4_CACHE_LIMIT']);

//$_ENV['HOME'] = $drush_server_home();
//putenv('HOME='.$_ENV['HOME']);
$_ENV['FRDL_HOME'] = $drush_server_home();
putenv('FRDL_HOME='.$_ENV['FRDL_HOME']);
//putenv('HOME='.$_ENV['FRDL_HOME']);	

$_homeg = str_replace(\DIRECTORY_SEPARATOR, '/', getenv('FRDL_HOME'));
	
	
$_cwd = getcwd(); 	

//chdir(getenv('FRDL_HOME'));
	
	
$workspaces = false;

$_dir = getenv('FRDL_HOME') . \DIRECTORY_SEPARATOR . '.frdl';
//if(!is_dir($_dir)){
 $g = (file_exists("frdl.workspaces.php")) ? [realpath("frdl.workspaces.php")] : glob("frdl.workspaces.php");	
 if(0===count($g)){
	 $g = array_merge(glob(str_replace(\DIRECTORY_SEPARATOR, '/', getcwd())."/frdl.workspaces.php"),
					  glob($_homeg."/frdl.workspaces.php"), glob($_homeg."/*/frdl.workspaces.php") 
					  //,glob($_homeg."/*/*/frdl.workspaces.php")
			 );
 }
  if(0<count($g)){
	//	$_dir = dirname($g[0]);	
	  $workspaces = require $g[0];
	  if(isset($workspaces['Frdlweb'])){
		$_dir = $workspaces['Frdlweb']['DIR'];		   
	  }else{
		 foreach($workspaces as $name => $w){
			if(isset($w['DIR']) && is_dir($w['DIR'])){
				$_dir = $w['DIR'];
			  break;	  
			}
		 }
	  }
	  
  }
//}
	
	  
	$_ENV['FRDL_WORKSPACE']= rtrim($_dir, '\\/');
	putenv('FRDL_WORKSPACE='.$_ENV['FRDL_WORKSPACE']);

	
	  
 $_f = $_ENV['FRDL_WORKSPACE']. \DIRECTORY_SEPARATOR.'frdl.workspaces.php';
 if(is_array($workspaces) 
	&& (!file_exists("frdl.workspaces.php") || time()-$_ENV['FRDL_HPS_PSR4_CACHE_LIMIT'] > filemtime("frdl.workspaces.php")) 
	&& @is_dir($_ENV['FRDL_WORKSPACE']) && @is_file($_f) ){
	 
	// $exports = var_export($workspaces, true);
$code = <<<PHPCODE
<?php
	return require '$_f';		   
PHPCODE;

 file_put_contents("frdl.workspaces.php", $code);	 
 }
	  
	 if(!@is_dir($_ENV['FRDL_WORKSPACE'])){
		@mkdir($_ENV['FRDL_WORKSPACE'], 0775, true); 
	 }	
	
 
//$_ENV['FRDL_HPS_CACHE_DIR'] = $_dir . \DIRECTORY_SEPARATOR .\get_current_user() . \DIRECTORY_SEPARATOR. 'cache'. \DIRECTORY_SEPARATOR;
$_ENV['FRDL_HPS_CACHE_DIR'] = \sys_get_temp_dir() . \DIRECTORY_SEPARATOR .\get_current_user() . \DIRECTORY_SEPARATOR. 'cache'. \DIRECTORY_SEPARATOR;	
putenv('FRDL_HPS_CACHE_DIR='.$_ENV['FRDL_HPS_CACHE_DIR']);
//putenv('TMP='.$_ENV['FRDL_HPS_CACHE_DIR']);
//ini_set('sys_temp_dir', realpath($_ENV['FRDL_HPS_CACHE_DIR']));	
	 if(!@is_dir($_ENV['FRDL_HPS_CACHE_DIR'])){
		@mkdir($_ENV['FRDL_HPS_CACHE_DIR'], 0775, true); 
	 }


$_ENV['FRDL_HPS_PSR4_CACHE_DIR'] = rtrim($_ENV['FRDL_HPS_CACHE_DIR'], \DIRECTORY_SEPARATOR).\DIRECTORY_SEPARATOR.'psr4'.\DIRECTORY_SEPARATOR;
putenv('FRDL_HPS_PSR4_CACHE_DIR='.$_ENV['FRDL_HPS_PSR4_CACHE_DIR']);

	 if(!@is_dir($_ENV['FRDL_HPS_PSR4_CACHE_DIR'])){
		@mkdir($_ENV['FRDL_HPS_PSR4_CACHE_DIR'], 0775, true); 
	 }

	


chdir($_cwd);

});

/**
* 
* $run Function
* 
*/
 $run = function($file = null, $doRun = false){
 	$args = func_get_args();

 	$MimeVM = new MimeVM($args[0]);
 	if($doRun){   
	  $MimeVM('run');
	}
 	return $MimeVM;
 };
 
 
$_NotIsTemplateContext =	(
		!defined('___BLOCK_WEBFAN_MIME_VM_RUNNING_STUB___') || false === ___BLOCK_WEBFAN_MIME_VM_RUNNING_STUB___
	)
	&& (
		!defined('\___BLOCK_WEBFAN_MIME_VM_RUNNING_STUB___') || false === \___BLOCK_WEBFAN_MIME_VM_RUNNING_STUB___
	) ? true : false;



$included_files = \get_included_files();  
if(('cli'===substr(strtolower(\PHP_SAPI), 0, 3)) || (
	 (!in_array(__FILE__, $included_files) || __FILE__===$included_files[0])
  
	)
   
  ) {
	if(!$_NotIsTemplateContext){
      
/* die('Warning: Suspecious context! Solution: Just download this the right way from https://frdl.webfan.de/install/ or comment out line '.__LINE__.' of '.basename(__FILE__));  */
	}
  //  $MimeVM = $run(__FILE__, true);
	$MimeVM = $run(__FILE__, false);
	$runStubOnInclude = true;
}else{
	 $MimeVM = $run(__FILE__, false);
	$runStubOnInclude = false;
}

	

class StubRunner implements StubRunnerInterface
{
	protected $MimeVM = null;
	protected $Codebase = null;
	protected $RemoteAutoloader = null;
	
	public function __construct(?StubHelperInterface &$MimeVM){
		$this->MimeVM=$MimeVM;		
	}
 	public function loginRootUser($username = null, $password = null) : bool{
		throw new \Exception('Not implemented yet or deprectaed: '.__METHOD__);
	}
	public function isRootUser() : bool{
		throw new \Exception('Not implemented yet or deprectaed: '.__METHOD__);
	}
	public function getStubVM() : StubHelperInterface{		
		$this->MimeVM->hugRunner($this);   
		return $this->MimeVM;
	}
	public function getStub() : StubItemInterface{
		return $this->getStubVM()->document;
	}
	
	
	public function autoUpdateStub(string | bool $update = null, string $newVersion = null, string $url = null){
	  if(null === $url){
	     $url = 'https://raw.githubusercontent.com/frdlweb/webfat/main/public/index.php?cache-bust='.time();	  
	  }
	
	   $config=$this->config();	
	   $configVersion = $this->configVersion();
		
           $ShutdownTasks = \frdlweb\Thread\ShutdownTasks::mutex();
           $ShutdownTasks(function($update, $newVersion, $config, $configVersion, $url, $file, &$me){
		 if((is_string($update) && 'auto' === $update) || (is_null($update) && !is_string($newVersion))  ){
			 $update =  true === $config['autoupdate'] && filemtime($file) < time() - $config['AUTOUPDATE_INTERVAL'];
		 }elseif( is_string($update) && 'auto' !== $update  ){
			$update =  false;
		 }elseif( is_bool($update) ){
			$update =  (bool)$update;
		 }
		   
		   if( is_string($newVersion) ){
			$update =  $update || !version_compare($configVersion['version'], $newVersion, '==');
		   }
		   
		 if(true === $update){	  
			 $thisCode = file_get_contents($url);	
			 if(isset($configVersion['appId'])){
			   $thisCode = str_replace("/****'appId'=>'@@@APPID@@@',*****/", '\'appId\'=>\''.$configVersion['appId'].'\',', $thisCode);	
                           $thisCode = str_replace('/****$configVersion[\'appId\']=\'@@@APPID@@@\';*****/', '$configVersion[\'appId\']=\''.$configVersion['appId'].'\';', $thisCode);
			 }
			 if(false!==$thisCode && true === (new \frdl\Lint\Php($cacheDirLint) )->lintString($thisCode) ){	   
				 file_put_contents($file, trim($thisCode));	  
			 }	
			 
			 if(is_string($newVersion)){
			          $configVersion['version'] = $newVersion;
			     //   $me->configVersion($configVersion);	
				
				 $export = array_merge($configVersion, [
					 'version' => $newVersion,
				 ]);			    
				 $varExports = var_export($export, true);
				 
			     file_put_contents($this->getStubVM()->location.'.version_config.php', '<?php
			        return '.$varExports.';             
	                    ');

			 }
		 }																 
             }, $update, $newVersion, $config, $configVersion, $url, __FILE__ , $this);  	
	}
	
	public function __invoke() :?StubHelperInterface{	

		if(defined('___BLOCK_WEBFAN_MIME_VM_RUNNING_STUB___')){ 
			throw new \Exception('___BLOCK_WEBFAN_MIME_VM_RUNNING_STUB___ is defined in '.__FILE__.' '.__LINE__);
		}
		
                $this->MimeVM->hugRunner($this); 
		$this->autoloading();	
		$this->MimeVM->runStubs();
		return $this->MimeVM;
	}
	public function hugVM(?StubHelperInterface $MimeVM){
		$this->MimeVM=$MimeVM;
	  return $this;
	}
	public function getInvoker(){
		return [$this, '__invoke']; 
	}
	public function autoloading() : void{
		\spl_autoload_register([$this->getStubVM(),'Autoload'], true, true);
		 $this->autoloadRemoteCodebase();
		 $this->getStubVM()->_run_php_1( $this->getStubVM()->get_file($this->getStub(), '$STUB/bootstrap.php', 'stub bootstrap.php')); 
		 $this->getStubVM()->_run_php_1( $this->getStubVM()->get_file($this->getStub(), '$HOME/detect.php', 'stub detect.php')); 
	}
	
	public function getShield(){
		throw new \Exception('Not implemented yet or deprectaed: '.__METHOD__);
	}
	
    public function config(?array $config = null, $trys = 0) : array{
		  $trys++;
		
          try{  
			  $f =  $this->getStubVM()->get_file($this->getStub(), '$HOME/apc_config.php', 'stub apc_config.php'); 
			  if($f)$conf = $this->getStubVM()->_run_php_1($f);	 
			  if(!is_array($conf) ){
				  $conf=[];  
			  } 
		  }catch(\Exception $e){  
			  $conf=[];   
		  }
		
		    if(null === $config){
			  return $conf;	
			}
		
               $export = array_merge($conf, $config);
		       $varExports = var_export($export, true);
		
      		  $this->getStubVM()->get_file($this->getStub(), '$HOME/apc_config.php', 'stub apc_config.php')
			  ->  setBody('
			    if(file_exists(__FILE__.\'.apc_config.php\')){
				  return require __FILE__.\'.apc_config.php\';
				}
			    return '.$varExports.';
			  ')
			  ;
		
		       file_put_contents($this->getStubVM()->location.'.apc_config.php', '<?php
			        return '.$varExports.';
               ');

	    $newContent = $this->getStubVM()->serializeFile(null);
		$fp = fopen($this->getStubVM()->location, 'w+');
		if (flock($fp, \LOCK_EX | \LOCK_NB)) {  
			register_shutdown_function(function($fp){
				if(is_resource($fp))@flock($fp, \LOCK_UN);
				if(is_resource($fp))fclose($fp);
			}, $fp);
			fwrite($fp, $newContent);   
			flock($fp, \LOCK_UN);
		} else {  
			//echo 'can\'t lock';
			fclose($fp);
			if($trys < 999999){
				//set_time_limit(min(45, max(intval(ini_get('max_execution_time')), 45)));
				set_time_limit(180);
				usleep(100);
				return $this->config($config, $trys);
			}
			throw new \Exception('Cannot log stub in '.__METHOD__);
		}
		fclose($fp);
	   return $export;
	}
	
	public function configVersion(?array $config = null, $trys = 0) : array{
		  $trys++;
		
          try{  
			  $f =  $this->getStubVM()->get_file($this->getStub(), '$HOME/version_config.php', 'stub version_config.php'); 
			  if($f)$conf = $this->getStubVM()->_run_php_1($f);	 
			  if(!is_array($conf) ){
				  $conf=[];  
			  } 
		  }catch(\Exception $e){  
			  $conf=[];   
		  }
		
		    if(null === $config){
			  return $conf;	
			}
		
               $export = array_merge($conf, $config);		       
		       $varExports = var_export($export, true);
		
      		  $this->getStubVM()->get_file($this->getStub(), '$HOME/version_config.php', 'stub version_config.php')				  			
				  ->  setBody('
			    if(file_exists(__FILE__.\'.version_config.php\')){
				  return require __FILE__.\'.version_config.php\';
				}
			    return '.$varExports.';
			  ')
			  ;
		
		      		       
		       file_put_contents($this->getStubVM()->location.'.version_config.php', '<?php
			        return '.$varExports.';
               ');

		$newContent = $this->getStubVM()->serializeFile(null);
		$fp = fopen($this->getStubVM()->location, 'w+');
		if (flock($fp, \LOCK_EX | \LOCK_NB)) {  
			register_shutdown_function(function($fp){
				if(is_resource($fp))@flock($fp, \LOCK_UN);
				if(is_resource($fp))fclose($fp);
			}, $fp);
			fwrite($fp, $newContent);   
			flock($fp, \LOCK_UN);
		} else {  
			//echo 'can\'t lock';
			fclose($fp);
			if($trys < 999999){
				//set_time_limit(min(45, max(intval(ini_get('max_execution_time')), 45)));
				set_time_limit(180);
				usleep(100);
				return $this->config($config, $trys);
			}
			throw new \Exception('Cannot log stub in '.__METHOD__);
		}
		fclose($fp);
	   return $export;		
	}
				
	
	public function getCodebase() :?\Frdlweb\Contract\Autoload\CodebaseInterface{
		if(null === $this->Codebase){
			$this->Codebase = new \Webfan\Webfat\Codebase();
			$this->Codebase->loadUpdateChannel($this);			
		}
		return $this->Codebase;
	}
	
	public function getRemoteAutoloader() : LoaderInterface {
		
		if(null !== $this->RemoteAutoloader){
		   return $this->RemoteAutoloader;	
		}
		
		$codebase = $this->getCodebase();
		$configVersion = $this->configVersion();
		$config = $this->config(); 
		
		 
		
		try{
	
			$this->RemoteAutoloader = \call_user_func(function($version, $s, $cacheDir, $l, $ccl, $cl) {	 
				$af = rtrim($cacheDir, '\\/ ') 
					.\DIRECTORY_SEPARATOR
					.str_replace('\\', \DIRECTORY_SEPARATOR, \frdl\implementation\psr4\RemoteAutoloaderApiClient::class).'.php';
	
				if(!is_dir(dirname($af))){	
					mkdir( dirname($af) , 0775 , true); 
				}
             	
 
				$cbCheckFile = $af.'.last-remote-access.txt';
				$holdBreakDuration = 60;
				if(!file_exists($af) || filemtime($af) < time() - max($ccl, 60*60)){ 
					if(file_exists($cbCheckFile)){
						if(filemtime($cbCheckFile) > time() - $holdBreakDuration || intval(file_get_contents($cbCheckFile)) > time() - $holdBreakDuration ){
							$mesage = 'We tried to request '.\frdl\implementation\psr4\RemoteAutoloaderApiClient::class;
							$mesage.= ' unsuccessfully short time , ago. The page will reload automatically...!';
							echo \frdl\booting\getFormFromRequestHelper($mesage, true, $holdBreakDuration, null);
							die();
						}
					}
					
					
					file_put_contents($cbCheckFile, time());
					
					        $options = [        
								'https' => [          
									'method'  => 'GET',          
									'ignore_errors' => true,          
									//'header'=> "X-Source-Encoding: b64\r\n"               
									// . "Content-Length: " . strlen($data) . "\r\n"				
									
           
								]
        
							];
      
					$context  = \stream_context_create($options);       
					$code = @file_get_contents($l, false, $context);
					if(false === $code){
					      touch($cbCheckFile);
					      echo 'Fehler mit: ';					          
				           foreach($http_response_header as $i => $header){
                                               $h = explode(':', $header);
                                               $k = strtolower(trim($h[0]));
                                               $v =  (isset($h[1])) ? trim($h[1]) : $header;           
                                                 echo $k.' : '.$v.'<br />';
					  }	
					}else{					
						file_put_contents($af, $code);	
					}
				}
      
				if(!\class_exists(\frdl\implementation\psr4\RemoteAutoloaderApiClient::class) && file_exists($af) ){   					
					require $af;         
				}	
		
		
                 $loader = \frdl\implementation\psr4\RemoteAutoloaderApiClient::getInstance($s,
																	 false, 
																	 $version,
																	 true,
																	 false, 
																	 null/*[]*/,
																	 $cacheDir/*null*/, 
																	 $cl);	
		
     		
		          $loader->withWebfanWebfatDefaultSettings($cacheDir);  
		          $loader->register(false);	
		
                 return $loader;
        }, 																				 
         $codebase->getUpdateChannel(),
	 $codebase->getRemotePsr4UrlTemplate(),				
	 rtrim($this->getApplicationsDirectory(), '\\/ ')
									  .\DIRECTORY_SEPARATOR
									  .'runtime'.\DIRECTORY_SEPARATOR
			                         .'cache'.\DIRECTORY_SEPARATOR
			                         .'classes'.\DIRECTORY_SEPARATOR
			                         .'psr4'.\DIRECTORY_SEPARATOR,			    
	'https://raw.githubusercontent.com/frdl/remote-psr4/master/src/implementations/autoloading/RemoteAutoloaderApiClient.php'
						  .'?cache-bust='.time(), 			 
	  $config['FRDL_REMOTE_PSR4_CACHE_LIMIT_SELF'],
	  $config['FRDL_REMOTE_PSR4_CACHE_LIMIT']
	);

		}catch(\Exception $e){ 
			$this->RemoteAutoloader = false; 
			throw $e;
		}	
		
		
		//$this->RemoteAutoloader = &$loader;
		
	   return $this->RemoteAutoloader;
	}	
	
	
	protected function autoloadRemoteCodebase(){
	  return $this->getRemoteAutoloader();
	}	
	
	public function getWebrootConfigDirectory() : string {
		return getenv('FRDL_WORKSPACE')
			.\DIRECTORY_SEPARATOR.urlencode('oid:1.3.6.1.4.1.37553.8.1.8.8.11.6').\DIRECTORY_SEPARATOR	
			.sha1(str_replace(getenv('HOME'), '', $_SERVER['DOCUMENT_ROOT'])).\DIRECTORY_SEPARATOR;
	}
	
	public function getApplicationsDirectory() : string {
     
		$codebase = $this->getCodebase();
		$ApplicationsDirectory = false;
		$configVersion = $this->configVersion();
				
		$webrootConfigFile = rtrim($this->getWebrootConfigDirectory(), '\\/ ').\DIRECTORY_SEPARATOR.'app.php';

         if(false === $ApplicationsDirectory && file_exists($webrootConfigFile)){	  
		   $webrootConfig = require $webrootConfigFile;       
		   $ApplicationsDirectory =$webrootConfig['stages'][$webrootConfig['stage']];	 
		   if(!is_dir($ApplicationsDirectory)
		      && is_string($ApplicationsDirectory)
		      && !empty($ApplicationsDirectory)
		      && !@mkdir($ApplicationsDirectory, 0775, true)){
		          $ApplicationsDirectory = false;	 
		  }		 
	   }
		
         if(false === $ApplicationsDirectory && isset($configVersion['appId'])){	
		 $webrootConfigFile = rtrim(getenv('FRDL_WORKSPACE'), '\\/ ')
			   .\DIRECTORY_SEPARATOR.'apps'.\DIRECTORY_SEPARATOR	
			   .urlencode($configVersion['appId'])	
			   .\DIRECTORY_SEPARATOR.'app.php';
         
		 if(file_exists($webrootConfigFile)){	  
		   $webrootConfig = require $webrootConfigFile;       
		   $ApplicationsDirectory =$webrootConfig['stages'][$webrootConfig['stage']];	 	 
		 }else{ 
			 $ApplicationsDirectory =  rtrim(getenv('FRDL_WORKSPACE'), '\\/ ')
			   .\DIRECTORY_SEPARATOR.'apps'.\DIRECTORY_SEPARATOR	
			   .urlencode($configVersion['appId'])	
			   .\DIRECTORY_SEPARATOR.'deployments'	
				   .\DIRECTORY_SEPARATOR.'blue'	
				   .\DIRECTORY_SEPARATOR.'deploy'	
				   .\DIRECTORY_SEPARATOR.'app'.\DIRECTORY_SEPARATOR; 			 
		 }
		 
		 if(!is_dir($ApplicationsDirectory) && !@mkdir($ApplicationsDirectory, 0775, true)){
		   $ApplicationsDirectory = false;	 
		 }
	   }

		   if(!is_dir($ApplicationsDirectory) ){
			   $ApplicationsDirectory = getenv('FRDL_WORKSPACE').\DIRECTORY_SEPARATOR.'global'.\DIRECTORY_SEPARATOR	  	
				   .'app'	 
				   .\DIRECTORY_SEPARATOR.'deployments'	
				   .\DIRECTORY_SEPARATOR.'blue'	
				   .\DIRECTORY_SEPARATOR.'deploy'	
				   .\DIRECTORY_SEPARATOR.'app'.\DIRECTORY_SEPARATOR; 
		   } 



		   if(!is_dir($ApplicationsDirectory)  && !@mkdir($ApplicationsDirectory, 0775, true) ){
			   $html='';	
			$html .= '<h1 style="color:red;">';
			   $html .= 'Error: Coould not find app config for this host and could not create global app directory!';     
		       $html .= '</h1>';      
		      echo  \frdl\booting\getFormFromRequestHelper($html, false);
			   die();
		   } 


	   
		return $ApplicationsDirectory;
	}		
	
}
	

	
				
	$StubRunner = new StubRunner($MimeVM);  
	$MimeVM->hugRunner($StubRunner);
	if(true===$runStubOnInclude){
		$StubRunner();
	}
	
}//namespace

//Laufzeit Fassaden ;-) ...
namespace frdl\r {
  	
 
class f 
{
 
    protected static $_instance = null;
    protected $_m = [];

    protected function __construct(array $data = null){
        $this->_m = is_array($data) ? $data : [];
    }
	//instance 
    public static function i(array $members = null){
        if( is_null( self::$_instance ) ){
            self::$_instance = new self( $members ); 
        }elseif(is_array($members)){
			foreach($members as $name => $value){
				self::$_instance->{$name} = $value;
			}
		}
        return self::$_instance;
    }

	public function __get($key) {
        if( isset($this->_m[$key] )){
            return $this->_m[$key];
        }
    }

    public function __set($key, $value) {
        $this->_m[$key] = $value;
    }
}
 	

 if(isset($StubRunner)){
  f::i([
   'StubRunner' => &$StubRunner,
  ]);
   return $StubRunner; 
 }		  
}//ns frdl/r


__halt_compiler();Mime-Version: 1.0
Content-Type: multipart/mixed;boundary=hoHoBundary12344dh
To: example@example.com
From: script@example.com

--hoHoBundary12344dh
Content-Type: multipart/alternate;boundary=EVGuDPPT

--EVGuDPPT
Content-Type: text/html;charset=utf-8

<h1>InstallShield</h1>
<p>Your Installer you downloaded at <a href="https://webfan.de/install/">frdl@Webfan</a> is attatched in this message.</p>
<p>You may have to run it in your APC-Environment.</p>


--EVGuDPPT
Content-Type: text/plain;charset=utf-8

 -InstallShield-
Your Installer you downloaded at https://webfan.de/install/ is attatched in this message.
You may have to run it in your APC-Environment.

--EVGuDPPT
Content-Type: multipart/related;boundary=4444EVGuDPPT
Content-Disposition: php ;filename="$__FILE__/stub.zip";name="archive stub.zip"

--4444EVGuDPPT
Content-Type: application/x-httpd-php;charset=utf-8
Content-Disposition: php ;filename="$STUB/bootstrap.php";name="stub bootstrap.php"

<?php 

$maxExecutionTime = intval(ini_get('max_execution_time'));	
 if (strtolower(\php_sapi_name()) !== 'cli') {	 
    set_time_limit(min(45, $maxExecutionTime));
 }
 /*
 // move to jobs module cronjobs  $this->getRunner()->autoUpdateStub( null );
 */


	 
--4444EVGuDPPT
Content-Type: application/x-httpd-php;charset=utf-8
Content-Disposition: php ;filename="$HOME/apc_config.php";name="stub apc_config.php"

<?php 

	if(file_exists(__FILE__.'.apc_config.php')){
	     return require __FILE__.'.apc_config.php';				
	}

	$domain =(isset($_SERVER['SERVER_NAME'])) ? $_SERVER['SERVER_NAME'] : $_SERVER['HTTP_HOST'];
	
 


 return array (
  'workspace' =>$domain,
  'baseUrl' => 'https://'.$domain,
  'baseUrlInstaller' => false,
  'FRDL_UPDATE_CHANNEL' => 'latest', // latest | stable
  'FRDL_CDN_HOST'=>'cdn.startdir.de',  // cdn.webfan.de | cdn.frdl.de
  'FRDL_CDN_PROXY_REMOVE_QUERY'=>	true, 
  'FRDL_CDN_SAVING_METHODS'=>	['GET'], 
  'FRDL_REMOTE_PSR4_CACHE_LIMIT'=>	24 * 60 * 60, //-1,
  'FRDL_REMOTE_PSR4_CACHE_LIMIT_SELF'=>	24 * 60 * 60, //-1,
  'ADMIN_EMAIL' => 'admin@'.$domain,
  'ADMIN_EMAIL_CONFIRMED' =>false,
  'NODE_PATH' => '/opt/plesk/node/12/bin/node',
  'wsdir' => dirname(__DIR__).'/.frdl/',
  'NPM_PATH' => '/opt/plesk/node/12/bin/npm',
  'autoupdate' => true,
  'AUTOUPDATE_INTERVAL' => 24 * 60 * 60, 
  'CACHE_ASSETS_HTTP' => true,
  'installed_from_hps_blog_id' => null,
  'stub' => null,	 
 
	 
);
			  
--4444EVGuDPPT
Content-Type: application/x-httpd-php;charset=utf-8
Content-Disposition: php ;filename="$HOME/detect.php";name="stub detect.php"

<?php 

@ini_set('display_errors','1');
error_reporting(\E_ERROR | \E_WARNING | \E_PARSE);	
	
--4444EVGuDPPT
Content-Type: application/x-httpd-php;charset=utf-8
Content-Disposition: php ;filename="$HOME/index.php";name="stub index.php"

<?php 
	
 	
   $Engine=new \Webfan\Engine; 
   $Engine->load(\Webfan\DescriptorType::WebApp, $this); 
    


--4444EVGuDPPT--
--EVGuDPPT--
--hoHoBundary12344dh
Content-Type: multipart/related;boundary=3333EVGuDPPT
Content-Disposition: php ;filename="$__FILE__/attach.zip";name="archive attach.zip"

--3333EVGuDPPT
Content-Type: application/vnd.frdl.script.php;charset=utf-8
Content-Disposition: php ;filename="$DIR_LIB/frdl/implementation/NullVoid.php";name="class frdl\implementation\NullVoid"

<?php 


namespace frdl\implementation;




class NullVoid
{

	
}
--3333EVGuDPPT
Content-Type: application/vnd.frdl.script.php;charset=utf-8
Content-Disposition: php ;filename="$DIR_LIB/Webfan/Webfat/Codebase.php";name="class Webfan\Webfat\Codebase"

<?php 


namespace Webfan\Webfat;

class Codebase extends \frdl\Codebase
{
	public function loadUpdateChannel(mixed $StubRunner = null) : string {
		$configVersion = $StubRunner->configVersion();
		$config = $StubRunner->config();
		$save = false;
		$breakScript = false;
		
		if(!isset($configVersion['appId'])){	
			/* $configVersion['appId'] = 'oid:1.3.6.1.4.1.37553.8.1.8.8.1958965301'; 
			   PLACEHOLDER (for installers/updaters)
			*/
			/****$configVersion['appId']='@@@APPID@@@';*****/
			$save = true;
		}		
		
	      if(!isset($configVersion['appId'])){	
		    $e = new \Webfan\Webfat\App\ResolvableLogicException(
                         'circuit:1.3.6.1.4.1.37553.8.1.8.8.1958965301.5.1=The (Main) Application ID must be defined'
                           .'|php:'.get_class($this).'=Thrown by the Codebase Class '.__METHOD__
                           .'@The Application ID must be defined'
                         );	
			$html ='';
			 //  $html = $e->html(-1);
		      
		      
			/*  Global Register Website | Domain Resolver App */
			$configVersion['appId'] = 'circuit:1.3.6.1.4.1.37553.8.1.8.8.1958965301.5.1'; 
			$save = true;		      
		       $html .= '<h1 style="color:green;">';
			   $html .= 'Next: The Setup/Installer Chooser App will be installed automatically (global) - The page reloads automatically, please wait ...!';     
		       $html .= '</h1>';      
		      echo  \frdl\booting\getFormFromRequestHelper($html, true, 10, null);
		      $breakScript=true;
	      }

		if(!isset($configVersion['channel'])){
			$configVersion['channel'] = isset($config['FRDL_UPDATE_CHANNEL']) ? $config['FRDL_UPDATE_CHANNEL'] : 'latest'; 
			$save = true;
		}		
	
		if(true === $save && null !== $StubRunner){
			$StubRunner->configVersion($configVersion);
			usleep(100);
		}
		
		$this->setUpdateChannel($configVersion['channel']);	
		if(true === $breakScript){
		   die();	
		}
		return $this->getUpdateChannel();
	}
}

--3333EVGuDPPT
Content-Type: application/vnd.frdl.script.php;charset=utf-8
Content-Disposition: php ;filename="$DIR_LIB/frdl/Codebase.php";name="class frdl\Codebase"

<?php 
namespace frdl;

abstract class Codebase implements \Frdlweb\Contract\Autoload\CodebaseInterface
 {
   protected $channels = null;
   protected $channel = null;
	
   abstract public function loadUpdateChannel(mixed $StubRunner = null) : string; 
	 
   public function __construct(string $channel = null){
	   $this->channels = [];
	   
	   $this->channels[self::CHANNEL_LATEST] = [
		     //   'RemotePsr4UrlTemplate' => 'https://webfan.de/install/latest/?source=${class}&salt=${salt}&source-encoding=b64',
		     // 'RemotePsr4UrlTemplate' => 'https://latest.software-download.frdlweb.de/?source=${class}&salt=${salt}&source-encoding=b64',
		     'RemotePsr4UrlTemplate' =>'https://startdir.de/install/latest/?source=${class}&salt=${salt}&source-encoding=b64',
		   'RemoteModulesBaseUrl' => 'https://startdir.de/install/',
		   'RemoteApiBaseUrl' => 'https://api.webfan.de/',
		   
	   ];
		   
	   
	   $this->channels[self::CHANNEL_STABLE] = [
		   //  'RemotePsr4UrlTemplate' => 'https://stable.software-download.frdlweb.de/?source=${class}&salt=${salt}&source-encoding=b64',
		  // 'RemotePsr4UrlTemplate' => 'https://webfan.de/install/stable/?source=${class}&salt=${salt}&source-encoding=b64',
		  'RemotePsr4UrlTemplate' =>'https://startdir.de/install/stable/?source=${class}&salt=${salt}&source-encoding=b64',
		    'RemoteModulesBaseUrl' => 'https://startdir.de/install/',
		   'RemoteApiBaseUrl' => 'https://api.webfan.de/',
		   
	   ];	   
	   
	   $this->channels[self::CHANNEL_FALLBACK] = [
		   'RemotePsr4UrlTemplate' => 'https://startdir.de/install/?source=${class}&salt=${salt}&source-encoding=b64',
		 // 'RemotePsr4UrlTemplate' => 'https://webfan.de/install/?source=${class}&salt=${salt}&source-encoding=b64',
		   'RemoteModulesBaseUrl' => 'https://startdir.de/install/',
		   'RemoteApiBaseUrl' => 'https://api.webfan.de/',
	   ];   
	   
	   if(null !== $channel && isset(static::CHANNELS[$channel])){
		   $this->setUpdateChannel(static::CHANNELS[$channel]);
	   }else{
		   $this->setUpdateChannel(static::CHANNELS[self::CHANNEL_LATEST]);
	   }
   }

   public function getRemoteApiBaseUrl() : string{ 
	   return $this->channels[$this->getUpdateChannel()]['RemoteApiBaseUrl'];
   }	 
   public function setUpdateChannel(string $channel){
	   $this->channel = $channel;
	  return $this;
   }
	 
   public function getUpdateChannel() : string{
	   return $this->channel;
   }
	  
   public function getRemotePsr4UrlTemplate() : string{
	    return $this->channels[$this->getUpdateChannel()]['RemotePsr4UrlTemplate'];
   }
	  
   public function getRemoteModulesBaseUrl() : string{
	    return $this->channels[$this->getUpdateChannel()]['RemoteModulesBaseUrl'];
   }
	  	 
 }





--3333EVGuDPPT
Content-Disposition: "php" ; filename="$HOME/version_config.php" ; name="stub version_config.php"
Content-Type: application/x-httpd-php
Content-Md5: 2a3496d7541e98c1a3625712be7fccb0
Content-Sha1: 812a417f6dc2735a15af41d618ef39c08439e576
Content-Length: 280


			    if(file_exists(__FILE__.'.version_config.php')){
				  return require __FILE__.'.version_config.php';
				}
			    return array (
  'time' => 0,
  'version' => '0.0.0',
  'appId' => 'circuit:1.3.6.1.4.1.37553.8.1.8.8.1958965301.5.1',
  'channel' => 'latest',
);
			  
--3333EVGuDPPT--
--hoHoBundary12344dh--

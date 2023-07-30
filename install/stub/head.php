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
<h1 class="error" style="color:red;background:url(https://cdn.webfan.de/ajax-loader_2.gif) no-repeat;">Loading the Webfat HTML Workspace...</h1>		
`);
	 
setTimeout(()=>{
(async ()=>{
 var c = await fetch('https://cdn.webfan.de/~' 
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
* Dowload an example implementation at https://webfan.de/install/
* https://raw.githubusercontent.com/frdlweb/webfat/main/public/index.php
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

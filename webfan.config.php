<?php

$module['exports'] = function(?\Webfan\Wayne\Insaneable ...$args){
  return (new class(...$args){
         public function __construct(?\Webfan\Wayne\Insaneable ...$args){
           
         }
  });
};

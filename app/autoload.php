<?php
spl_autoload_register(function ($namespace_class) 
{
    $class = str_replace('App/', '', str_replace('\\', '/', $namespace_class));
    
    include $class.'.php';
});
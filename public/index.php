<?php

session_start();

define("BASE_PATH", dirname(__FILE__));
define("ERROR", true);
define("HOST", "localhost");
define("DB_NAME", "PROJECT");
define("USER", "root");
define("PASS", "");
define("DOMAIN",currentDomain());


// Helper Function
function protocol()
{
    if (stripos($_SERVER["SERVER_PROTOCOL"], "https") === true) {
        return "https://";
    } else {
        return "http://";
    }
}

function currentDomain()
{
  return  protocol() . $_SERVER["HTTP_HOST"];
}

function assets($src)
{
    $domain = trim(DOMAIN,'/');
    $src=$domain.'/'.trim($src,'/');
    return $src;
}

function url($url)
{
    $domain = trim(DOMAIN,'/');
    $url=$domain.'/'.trim($url,'/');
    return $url;
}

function methodField()
{
    return $_SERVER['REQUEST_METHOD'];
}

function currentUrl()
{
 return currentDomain().$_SERVER['REQUEST_URI'];
}

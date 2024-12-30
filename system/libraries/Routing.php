<?php

class Routing
{
    protected $currentController = "pages";
    protected $currentMethod = "index";
    protected $parameter = [];

    public function __construct()
    {
        $url=$this->GetUrl();
        if(!empty($url) && file_exists("../app/controllers/" . ucwords($url[0]) . ".php")){
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }

        require_once "../app/controllers/" . $this->currentController . ".php";
        $this->currentController = new $this->currentController;
    }

    public function GetUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }else{
            return [];
        }
    }
}
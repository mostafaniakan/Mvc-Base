<?php

class Routing
{
    protected $currentController = "pages";
    protected $currentMethod = "index";
    protected $parameter = [];

    public function __construct()
    {
        $url = $this->GetUrl();
        if (!empty($url) && file_exists("../app/controllers/" . ucwords($url[0]) . ".php")) {
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }

        require_once "../app/controllers/" . $this->currentController . ".php";
        $this->currentController = new $this->currentController;

        if(isset($url[1])){
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        $this->parameter = $url ? array_values($url) : [];
        call_user_func_array([$this->currentController, $this->currentMethod], $this->parameter);
    }

    public function GetUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        } else {
            return [];
        }
    }
}
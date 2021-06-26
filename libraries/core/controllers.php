<?php
class Controllers
{
    public function __construct()
    {
        $this->views = new Views();
        $this->loadModel();
    }

    public function loadModel()
    {
        $model = get_class($this) . "Model";
        $routClass = "models/" . $model . ".php";
        if (file_exists($routClass)) {
            require_once($routClass);
            $this->model = new $model();
        }
    }
    public function session($rol){
        if(!isset($_SESSION[$rol]) || $rol != $_SESSION['rol']){
            header("Location: ".base_url());
        }
    }
}

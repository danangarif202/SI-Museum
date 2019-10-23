<?php 

//Nama CLASS sesuaikan dengan nama file (A) besar
class App {
    protected $controller = 'Home';
    protected $method     = 'index';
    protected $params     = [];

    public function __construct()
    {
        $url = $this->parseURL();
        
        // controller
        if( file_exists('../app/controllers/' . $url[0] . '.php') ) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // method
        if( isset($url[1]) ) {
            if( method_exists($this->controller, $url[1]) ){
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // params
        if( !empty($url) ) {
            $this->params = array_values($url);
        }

        //jalankan controller & method, serta kirimkan params jika ada
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    //sebuah method yang mengambil url dan memecah sesuai keinginan kita
    public function parseURL()
    {
        if(isset($_GET['url']) ){
            $url = rtrim($_GET['url'], '/');
            //menghilangkan karakter2 yang ngaco/aneh pada url kita (jaga2 jika dihack)
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }

}
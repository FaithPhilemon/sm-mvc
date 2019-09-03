<?php

class Pages extends Controller{

    public function __construct(){
    }

    public function index(){
        // echo "This an index method";
        $this->view('index');
    }

    public function about(){
        echo "ABOUT PAGE";
    }
    
}

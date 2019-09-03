<?php

class Pages extends Controller{

    public function __construct(){
        // echo "Pages Loading";

        $this->postModel = $this->model('Post');
    }

    public function index(){
        // echo "This an index method";
        $this->view('index');
    }

    public function about(){
        echo "ABOUT PAGE";
    }
    
}

<?php 
/**
 * Base controller, every controller in the application must inherit (extend) this one.
 * Responsible for loading models & views
 */

 class Controller{
    /**
     * Loads model class
     */
    public function model($model){
        // require model file
        require_once '../app/models/'. $model .'.php';

        // Instantiate the model
        return new $model;
    }

    /**
     * Loads view class
     */
    public function view($view, $data = []){
        // check if view file exist
        if(file_exists('../app/views/'.$view.'.php')){
            require_once '../app/views/'.$view.'.php';
        }else{
            // view not found
            die('View does not exist');
        }
    }
 }
<?php
class Edit extends Controller
{
    public function __construct(){
    }

    public function index(){
       $this->view('edit');
    }
    public function edit($id){
        echo "edit ".$id;
    }

}
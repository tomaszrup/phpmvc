<?php

class HomeController {

    public function index() {
        echo "index";
    }

    public function test($id) {
        echo $id;
    }

    public function xd($id, $chuj) {
        echo $id . " " . $chuj;
    }

}
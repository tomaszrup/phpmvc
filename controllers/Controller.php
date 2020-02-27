<?php

class Controller {

    protected function view($path, $data = null) {
        if($data) {
            extract($data);
        }

        include __DIR__ . '/../views/' . $path . '.php';
    }

}
<?php

class Controller
{

    protected function view(string $viewPath, array $data = null)
    {
        $absPath = __DIR__ . '/../views/' . $viewPath . '.php';

        if (!file_exists($absPath)) {
            trigger_error("No such view: $viewPath");
        }

        if ($data) {
            extract($data);
        }

        @include $absPath;
    }

}
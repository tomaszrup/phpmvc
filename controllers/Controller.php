<?php

class Controller
{
    protected function view(string $viewPath, array $data = null)
    {
        $absPath = __DIR__ . '/../views/' . $viewPath . '.php';

        if (!file_exists($absPath)) {
            throw new LogicException("No such view: $viewPath");
        }

        if ($data) {
            extract($data);
        }

        return @include $absPath;
    }

    protected function redirect(string $url, int $statusCode = 303)
    {
        header('Location: ' . path($url), true, $statusCode);
        die();
    }

}
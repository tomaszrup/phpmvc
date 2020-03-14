<?php

require_once __DIR__ . '/../infrastructure/HttpStatus.php';

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

    protected function response($data, int $statusCode = 200, $headers = null) {
        http_response_code($statusCode);
        foreach ($headers as $header) {
            header($header, false);
        }
        return $data;
    }

    protected function jsonResponse($data) {
        return $this->response(json_encode($data), 200, ['Content-Type: application/json']);
    }

}
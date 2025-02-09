<?php 
namespace Randomserver\Response;

class Response{
    public static function json(mixed $data,int $code=200){
        
        ob_start();
        ob_clean();

        header_remove();

        header('Content-Type:application/json;charset=utf-8');

        \http_response_code($code);

        $body = \json_encode($data);

        echo $body;
    }
    public static function text(string $message,int $code=200){
        ob_start();
        ob_clean();
        header_remove();
        header('Content-Type:text/html;charset=utf-8');
        \http_response_code($code);
        echo $message;
    }
}
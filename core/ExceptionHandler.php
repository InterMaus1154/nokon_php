<?php

namespace Core;
class ExceptionHandler
{
    public static function handleException(\Throwable $e): void
    {
        http_response_code(500);
        echo "<h1>Internal error occurred</h1>";
        echo "<pre>";

        echo "Error occurred at <br>";
        echo $e->getFile() . "<br>";
        echo "Line:". $e->getLine() . "<br>";
        echo $e->getMessage();


        echo "</pre>";
    }
}
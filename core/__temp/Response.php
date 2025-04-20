<?php

namespace core\__temp;

use Core\ServiceSingleton;
use Core\View;

class Response extends ServiceSingleton
{
    protected function __construct()
    {
        parent::__construct();
    }

    /**
     * @param string $view
     * @param mixed $data - optional data
     * @return View
     */
    public static function view(string $view, mixed $data = []): View
    {
        return View::prepare($view, $data);
    }


    /**
     * @param mixed $data
     * @return Response
     */
    public static function raw(mixed $data): Response
    {
        echo htmlspecialchars($data);
        return self::getInstance();
    }

    /**
     * @param mixed $data
     * @return Response
     */
    public static function rawUnsafe(mixed $data): Response
    {
        echo $data;
        return self::getInstance();
    }

    /**
     * @param mixed $data
     * @return Response
     */
    public static function rawEval(mixed $data): Response
    {
        eval($data);
        return self::getInstance();
    }

}
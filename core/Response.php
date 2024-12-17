<?php

namespace Core;

class Response extends Singleton
{
    protected function __construct()
    {
        parent::__construct();
    }

    /**
     * @param string $view
     * @param mixed $data
     * @return Response
     */
    public static function view(string $view, mixed $data = []): Response
    {
        View::make($view, $data)->show();

        return self::getInstance();
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

    public static function rawEval(mixed $data): Response
    {
        eval($data);
        return self::getInstance();
    }

}
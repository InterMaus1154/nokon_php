<?php

namespace Core;

use Core\Interfaces\Renderable;
use Exception;

class View implements Renderable
{
    private function __construct(private readonly string $file, private array $data = [])
    {
    }

    /**
     * @param string $name - name of the view
     * @param array $data - optional data to pass to the view
     * @param bool $systemView - false by default
     * @return View
     * @throws Exception
     */
    public static function prepare(string $name, array $data = [], bool $systemView = false): View
    {
        $viewDirectory = !$systemView ? App::$VIEW_DIRECTORY : App::$SYSTEM_VIEW_DIRECTORY;

        /**
         * Check if defined Views directory exists
         */
        if (!is_dir($viewDirectory)) {
            http_response_code(404);
            throw new Exception("Views directory doesn't exist at the following location:". $viewDirectory);
        }

        $file = $viewDirectory . $name . '.view.php';
        /**
         * Check if requested view file exists at base directory
         */
        if (!file_exists($file)) {
            http_response_code(404);
            throw new Exception("Requested view doesn't exist: ". $name . '.view.php');
        }

        return new View($file, $data);
    }

    public function render(): void
    {
        extract($this->data);
        include $this->file;
    }
}
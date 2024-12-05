<?php
namespace Core;
require "helper.php";
class View
{
    private function __construct(private readonly string $file, private array $data = [])
    {}

    public static $VIEW_DIRECTORY = __DIR__ . '/../views/';

    /**
     * @param string $name - name of the view
     * @param array $data
     * @return View
     */
    public static function make(string $name, array $data = []): View
    {
        /**
         * Check if defined views directory exists
         */
        if(!is_dir(self::$VIEW_DIRECTORY)){
            dd("Views directory doesn't exist at the following location:", self::$VIEW_DIRECTORY);
        }

        $file =  self::$VIEW_DIRECTORY.$name.'.View.php';
        /**
         * Check if requested view file exists at base directory
         */
        if(!file_exists($file)){
            dd("Requested view doesn't exist", $name);
        }

        return new View($file, $data);
    }

    /**
     * Show a view
     * @return void
     */
    public function show(): void
    {
        if(!empty($this->data))
        {
            extract($this->data);
        }
        include $this->file;
    }
}
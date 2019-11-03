<?php

namespace Framework\Core;

class View {
    protected $path, $data;

    public function __construct($path, $data = array()) {
        $this->data = $data;
        $this->path = 'app/Resources/Templates/' . $path . '.php';
    }

    /**
     * Static method for template rendering in controllers
     *
     * @param $path
     * @param $data
     * @throws \Exception
     */
    public static function load_view($path, $data) {
        $view = new self($path, $data);
        echo $view->render();
    }

    public function render() {
        if(file_exists($this->path)){
            // Extracts vars to current view scope
            extract($this->data);
            ob_start();

            include $this->path;
            $buffer = ob_get_contents();
            @ob_end_clean();

            return $buffer;
        } else {
            throw new \Exception("No template found.");
        }
    }
}
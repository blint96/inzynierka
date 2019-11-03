<?php

namespace Framework\Core;

class View {

    private $file;

    private $values = [];

    public function __construct($file)
    {
        $this->file = 'app/Resources/Templates/' . $file . '.php';
    }

    public function render() {
        if(!file_exists($this->file)) {
            throw new \Exception("Cannot find " . $this->file . " template");
        }

        $output = file_get_contents($this->file);
        $output = $this->replace($output, $this->values);

        $values = $this->values;

        $output = preg_replace('~\{loop:(\w+)\}~', '<?php foreach ($this->values[\'$1\'] as $value){ echo  $this->replace(\'', $output);
        $output = preg_replace('~\{endloop:(\w+)\}~', '\', $value);} ?>', $output);

        $output = preg_replace('~\{IF:([^\r\n}]+)\}~', '<?php if ($1): echo \'', $output);
        $output = preg_replace('~\{ELSE\}~', '\'; else: echo \'', $output);
        $output = preg_replace('~\{ENDIF\}~', '\'; endif; ?>', $output);

        echo var_dump($output);
        // echo eval($output);

    }

    /**
     * Replace simple values
     *
     * @param $content
     * @param $vars
     * @return mixed|string
     */
    private function replace($content, $vars) {
        $output = "";
        foreach($vars as $key => $value) {
            if(!is_array($value)) {
                $tag = "{\$$key}";
                $output = str_replace($tag, $value, $content);
            }
        }
        return $output;
    }

    public function set($key, $value) {
        $this->values[$key] = $value;
        return $this;
    }
}
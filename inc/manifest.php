<?php 

class Manifest {
    private static $instance = NULL;
    private $manifest = NULL;
    private $path = NULL;

    private function __construct() {
        $this->path = get_template_directory() . '/dist/manifest.json';
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Manifest();
        }
 
        return self::$instance;
    }

    private function load_manifest() {
        if(file_exists($this->path)) {
            return $this->manifest = (array) json_decode(file_get_contents($this->path));
        }

        return false;
    }

    public function getAsset($name) {
        if($this->manifest == NULL) {
            if(!$this->load_manifest()) {
                return false;
            }
        }

        return $this->manifest[$name];
    }
}
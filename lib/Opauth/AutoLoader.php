<?php
namespace Opauth;

/**
 * AutoLoader
 *
 * @package       Opauth
 */
class AutoLoader {

    private $directory;

    private $namespace;

    private $namespaceLength;

/**
 * Constructor
 *
 * @param string $baseDirectory
 */
	public function __construct($baseDirectory = __DIR__) {
		$this->namespace = __NAMESPACE__ . '\\';
		$this->namespaceLength = strlen($this->namespace);
		$this->directory = $baseDirectory;
	}


/**
 * Register autoloader
 *
 * @return void
 */
	public static function register() {
		spl_autoload_register(array(new self, 'loadClass'));
	}

/**
 * Unregister autoloader
 *
 * @return void
 */
	public static function unregister() {
		spl_autoload_unregister(array(new self, 'loadClass'));
	}

/**
 *
 * @param string $className The name of the class to load.
 * @return void
 */
	public function loadClass($className) {
		if (strpos($className, $this->namespace) === 0) {
			$path = $this->directory . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, substr($className, $this->namespaceLength)) . '.php';
			if (file_exists($path)) {
				require $path;
			}
		}
	}
}
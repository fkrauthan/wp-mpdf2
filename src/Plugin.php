<?php
namespace Fkr\WPMpdf2;

class Plugin {

  /**
	 * @var string The current version of the plugin
	 */
	protected $version = '1.0';

	/**
	 * @var string
	 */
	protected $file = '';

	/**
	 * @var string
	 */
	protected $dir = '';

	/**
	 * @var string
	 */
	protected $name = '';

	/**
	 * @var string
	 */
	protected $slug = '';

	/**
	 * @var int
	 */
	protected $id = 0;

	/**
	 * Constructor
	 *
	 * @param int $id
	 * @param string $name
	 * @param string $version
	 * @param string $file
	 * @param string $dir
	 */
	public function __construct($id, $name, $version, $file, $dir) {
		$this->id = $id;
		$this->name = $name;
		$this->version = $version;
		$this->file = $file;
		$this->dir = $dir;
		$this->slug = plugin_basename($file);

		// load rest of classes on a later hook
		$this->load();
	}

  /**
	 * Start loading classes on `plugins_loaded`, priority 20.
	 */
	public function load() {
  }

}

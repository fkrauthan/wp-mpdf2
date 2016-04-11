<?php

class WPMPHPFallback {
  /**
	 * @var string
	 */
	private $pluginName = '';

	/**
	 * @var string
	 */
	private $pluginFile = '';

	/**
	 * @param $plugin_name
	 * @param $plugin_file
	 */
	public function __construct($pluginName, $pluginFile) {
		$this->pluginName = $pluginName;
		$this->pluginFile = $pluginFile;

		// deactivate plugin straight away
		add_action('admin_init', array($this, 'deactivateSelf'));
	}

  /**
	 * @return bool
	 */
	public function deactivateSelf() {
		if(!current_user_can('activate_plugins')) {
			return false;
		}
		// deactivate self
		deactivate_plugins($this->pluginFile);

		// get rid of "Plugin activated" notice
		if(isset($_GET['activate'])) {
			unset($_GET['activate']);
		}

		// show notice to user
		add_action('admin_notices', array($this, 'showNotice'));
		return true;
	}

	/**
	 * @return void
	 */
	public function showNotice() {
		?>
		<div class="updated">
			<p><?php printf('<strong>%s</strong> did not activate because it requires <strong>PHP v5.3</strong> or higher, while your server is running <strong>PHP v%s</strong>.', $this->pluginName, PHP_VERSION); ?>
			<p><?php printf('<a href="%s">Updating your PHP version</a> makes your site faster, more secure and should be easy for your host.', 'http://www.wpupdatephp.com/update'); ?></p>
		</div>
		<?php
	}
}

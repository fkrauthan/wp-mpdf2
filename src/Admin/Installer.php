<?php
namespace Fkr\WPMpdf2\Admin;

class Installer {

    /**
  	 * Run the installer
  	 */
  	public static function run() {
      $installer = new self;
      $installer->install();
    }

    /**
  	 * The main install method
  	 */
  	public function install() {
      // Check if we need to do a upgrade
      $currentVersion = get_option('mpdf2_db_version', '0');
      if (WPMPDF2_DB_VERSION == $currentVersion) {
        return;
      }

      // Check for version 1
      if ($currentVersion == '0') {
        $currentVersion = '1';
        $this->installVersion1();
      }

      // Write back current version
      update_option('mpdf2_db_version', WPMPDF2_DB_VERSION);
    }

    /**
     * Update to DB Version 1
     */
    protected function installVersion1() {
      // Add default options
      add_option('mpdf2_default_theme', 'default');
      add_option('mpdf2_caching', true);
      add_option('mpdf2_debug', false);

      add_option('mpdf2_requires_authentication', false);

      add_option('mpdf_cron_user', '');

    }

}

<?php
namespace Fkr\WPMpdf2\Admin;

class Cron {

  public function __construct() {
    $this->checkForCachingFlag();
    $this->authorizeUserIfRequired();

    // TODO actual create cache files
  }

  protected function checkForCachingFlag() {
    if(get_option('mpdf2_caching') != true) {
      echo "No caching enabled\n";
      exit(-1);
    }
  }

  protected function authorizeUserIfRequired() {
    if(get_option('mpdf2_cron_user') != '') {
      $userId = get_option('mpdf_cron_user');
      if(get_option('mpdf_cron_user') == 'auto') {
        $userIds = $wpdb->get_col($wpdb->prepare('SELECT ID FROM ' . $wpdb->users . ' LIMIT 1'));
        if (count($userIds) == 0) {
          echo "Can not find user $userId\n";
          exit(-1);
        }
        $userId = $userIds[0];
      }
      wp_set_current_user($userId);
    }
  }

}

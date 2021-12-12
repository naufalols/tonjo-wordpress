<?php

if (! defined('WP_UNINSTALL_PLUGIN')) {
    exit();
}
    global $wpdb;
    $wpdb->query("DROP TABLE IF EXISTS".$wpdb->prefix . 'cronPlugin');
    $wpdb->query("DROP TABLE IF EXISTS".$wpdb->prefix . 'covidCount');
    delete_option("tonjoo_db_version");

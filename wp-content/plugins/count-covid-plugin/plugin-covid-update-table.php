<?php
function create_table_plugin()
{
    global $wpdb;
    global $tonjoo_db_version;

    $table_name = $wpdb->prefix . 'covidCount';
    
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		nama_negara varchar(55) NOT NULL,
		kasus_aktif int DEFAULT '0' NOT NULL,
		kasus_meninggal int DEFAULT '0' NOT NULL,
		kasus_sembuh int DEFAULT '0' NOT NULL,
		updated_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    add_option('tonjoo_db_version', $tonjoo_db_version);
}

function create_table_cron_plugin()
{
    global $wpdb;
    global $tonjoo_db_version;

    $table_name = $wpdb->prefix . 'cronPlugin';
    
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		api_endpoint varchar(55) NOT NULL,
		period_sync int NOT NULL,
		updated_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    add_option('tonjoo_db_version', $tonjoo_db_version);
}

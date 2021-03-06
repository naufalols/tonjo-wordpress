<?php

/**
 * Plugin Name: Plugin Count Covid
 * Plugin URI: http://localhost/count-covid
 * Description: The first plugin that I have ever created.
 * Version: 1.0
 * Author: Naufal
 * Author URI: http://naufalols.github.io
 */


global $tonjoo_db_version;
$tonjoo_db_version = '1.0';

require_once('plugin-covid-update-table.php');
require_once plugin_dir_path(__FILE__) . 'includes/covid-configuration-menu.php';

register_activation_hook(__FILE__, 'create_table_plugin');
register_activation_hook(__FILE__, 'create_table_cron_plugin');

register_activation_hook(__FILE__, 'save_to_database_cron');
register_activation_hook(__FILE__, 'run_on_activate');

add_action('save_data_covid_to_database', 'api_covid');
// add_action('the_content', 'api_covid');


function run_on_activate()
{
    if (!wp_next_scheduled('save_data_covid_to_database')) {
        wp_schedule_event(time(), 'every_seven_minutes', 'save_data_covid_to_database');
    }
}



function setting_cron_get_api($schedules)
{
    $schedules['every_three_minutes'] = array(
        'interval'  => 180,
        'display'   => __('Every 3 Minutes', 'textdomain')
    );

    $schedules['every_seven_minutes'] = array(
            'interval'  => 420,
            'display'   => __('Every 7 Minutes', 'textdomain')
    );

    return $schedules;
}
add_filter('cron_schedules', 'setting_cron_get_api');




function api_covid()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://covid19.mathdro.id/api/confirmed',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Accept: application/json'
        ),
    ));


    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);


    $data = json_decode($response);

    global $wpdb;
    $table_name = $wpdb->prefix . 'covidCount';

    if ($err) {
        return  "cURL Error #:" . $err;
    } else {
        if (!empty($data)) {
            $count = count($data);
            for ($i=0; $i < $count; $i++) {
                $nama_negara = ($data[$i]->provinceState == null) ? $data[$i]->countryRegion : $data[$i]->provinceState;

                // $wpdb->insert(
                //     $table_name,
                //     array(
                //             'nama_negara'       => $nama_negara ,
                //             'kasus_aktif'       => $data[$i]->confirmed,
                //             'kasus_meninggal'   => $data[$i]->deaths,
                //             'kasus_sembuh'      => $data[$i]->recovered,
                //             'updated_at'        => date('Y-m-d H:i:s')
                //         )
                // );

                $checkIfExists = $wpdb->get_var("SELECT nama_negara FROM $table_name WHERE nama_negara = '$nama_negara'");

                if ($checkIfExists === null) {
                    $wpdb->insert(
                        $table_name,
                        array(
                            'nama_negara'       => $nama_negara ,
                            'kasus_aktif'       => $data[$i]->confirmed,
                            'kasus_meninggal'   => $data[$i]->deaths,
                            'kasus_sembuh'      => $data[$i]->recovered,
                            'updated_at'        => date('Y-m-d H:i:s')
                        )
                    );
                } else {
                    $wpdb->update(
                        $table_name,
                        array(
                            'nama_negara'       => $nama_negara ,
                            'kasus_aktif'       => $data[$i]->confirmed,
                            'kasus_meninggal'   => $data[$i]->deaths,
                            'kasus_sembuh'      => $data[$i]->recovered,
                            'updated_at'        => date('Y-m-d H:i:s')
                        ),
                        array( 'nama_negara' => $nama_negara ),
                    );
                }
            }
        }
    }

    // return $response;
}

function save_to_database()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'covidCount';

    $wpdb->insert(
        $table_name,
        array(
            
            'nama_negara'       => 'indonesia',
            'kasus_aktif'       => 20120,
            'kasus_meninggal'   => 123,
            'kasus_sembuh'      => 123123,
            'updated_at'        => date('Y-m-d H:i:s')
        )
    );
}

function save_to_database_cron()
{
    global $wpdb;
    $endpoint = 'https://covid19.mathdro.id/api';
    $table_name = $wpdb->prefix . 'cronPlugin';

    $checkIfExists = $wpdb->get_var("SELECT * FROM $table_name WHERE api_endpoint = '$endpoint'");

    if ($checkIfExists === null) {
        $wpdb->insert(
            $table_name,
            array(
            'api_endpoint'      => $endpoint,
            'period_sync'       => 7,
            'updated_at'        =>date('Y-m-d H:i:s')
        )
        );
    } else {
        $wpdb->update(
            $table_name,
            array(
                
                'api_endpoint'      => 'https://covid19.mathdro.id/api',
                'period_sync'       => 7,
                'updated_at'        =>date('Y-m-d H:i:s')
            ),
            array( 'id' => 1 ),
            array(
                '%s',
                '%d',
                '%s'
            ),
            array('%d')
        );
    }
}

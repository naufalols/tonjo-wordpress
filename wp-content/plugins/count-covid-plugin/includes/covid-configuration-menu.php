<?php

add_action('admin_menu', 'add_menu_admin');
 
// Menambahkan link menu di dashboard admin WordPress
function add_menu_admin()
{
    add_menu_page(
        'Halaman Pertama', // Judul dari halaman
        'Plugin Covid', // Tulisan yang ditampilkan pada menu
        'manage_options', // Persyaratan untuk dapat melihat link
        'info-korona', // slug dari file untuk menampilkan halaman ketika menu link diklik.
        'tampil'
    );
}

function tampil()
{
    require_once 'activity-covid.php';
}

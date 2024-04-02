<?php
/**
 * Plugin Name: BYD Admin Panel
 * Plugin URI:
 * Description: Admin panel for BYD
 * Version: 1.0
 * Author: BYD
 * Author URI:
 * License: GPL2
 * Text Domain: byd-admin-panel
 * Domain Path: /languages
 * Requires at least: 5.0
 * Requires PHP: 7.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define path
define('BYD_ADMIN_PANEL_PATH', plugin_dir_path(__FILE__));
class BYD_Admin_Panel {

    public function __construct() {
        add_action('init', [$this, 'init']);
    }

    public function init() {
        add_action('admin_menu', [$this, 'add_admin_menu']);
        add_action('admin_enqueue_scripts', [$this, 'load_admin_scripts']);
        $this->save_data();
        // Ajax action to reset users data in options setting 
        add_action('wp_ajax_reset_users', [$this, 'reset_users']);

        include_once __DIR__ . '/includes/shortcode.php';
        new Shortcode();
    }

    public function reset_users() {
        check_ajax_referer('byd_admin_panel_nonce');

        if(!current_user_can('manage_options')) {
            wp_send_json_error('You are not allowed to do this');
        }

        update_option('users', '');
        wp_send_json_success(admin_url('admin.php?page=all-users'));
        exit;
    }

    public function load_admin_scripts($hooks) {
        if ($hooks !== 'toplevel_page_byd-admin-panel' && $hooks !== 'byd-admin-panel_page_all-users') {
            return;
        }
        wp_enqueue_style('byd-admin-panel-css', plugin_dir_url(__FILE__) . 'assets/css/style.css');
        wp_enqueue_script('byd-ajax', plugin_dir_url(__FILE__) . 'assets/js/main.js', ['jquery'], null, true);
        wp_enqueue_script('salary-script', plugin_dir_url(__FILE__) . 'assets/js/salary.js', ['jquery'], null, true);
        // enqueue bootstrap cdn
        wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');

        $ajax_url = admin_url('admin-ajax.php');
        $byt_admin_nonce = wp_create_nonce('byd_admin_panel_nonce');
        wp_localize_script('byd-ajax', 'ajax_object', [
            'ajax_url' => $ajax_url,
            'nonce' => $byt_admin_nonce,
        ]);
    }
    public function add_admin_menu() {
        add_menu_page(
            'BYD Admin Panel',
            'BYD Admin Panel',
            'manage_options',
            'byd-admin-panel',
            [$this, 'admin_panel'],
            'dashicons-table-col-after',
            6
        );

        add_submenu_page(
            'byd-admin-panel',
            'Add Member',
            'Add Member',
            'manage_options',
            'all-users',
            [$this, 'user_list'],   
        );
    }

    public function admin_panel() {
        include_once 'admin/users.php';
    }

    // save data to manage_options
    public function save_data() {
        if(isset($_POST['action']) && $_POST['action'] === 'save_text') {
            if(!isset($_POST['byd_text']) || !wp_verify_nonce($_POST['byd_text'], 'save_user_info')) {
                return;
            }

            if(!current_user_can('manage_options')) {
                return;
            }

            if(!isset($_POST['fullname']) || !isset($_POST['email']) || !isset($_POST['phone']) || !isset($_POST['address'])) {
                return;
            }

            $users = get_option('users');
            if(!$users) {
                $users = [];
            }else {
                $users = json_decode($users, true);
            }

            foreach($users as $user) {
                if($user['email'] === $_POST['email']) {
                    wp_redirect(admin_url('admin.php?page=byd-admin-panel'));
                    exit;
                }
            }

            $users[] = [
                'fullname' => sanitize_text_field($_POST['fullname']),
                'email' => sanitize_text_field($_POST['email']),
                'phone' => sanitize_text_field($_POST['phone']),
                'birthday' => sanitize_text_field($_POST['birthday']),
                'gender' => sanitize_text_field($_POST['gender']),
                'nationality' => sanitize_text_field($_POST['nationality']),
                'salary' => sanitize_text_field($_POST['salary']),
                'address' => sanitize_text_field($_POST['address']),
            ];

            update_option('users', wp_json_encode($users));
            wp_redirect(admin_url('admin.php?page=byd-admin-panel'));
            exit;
        }
    }


    public function user_list() {
        include_once 'admin/settings.php';
    }

}

new BYD_Admin_Panel();
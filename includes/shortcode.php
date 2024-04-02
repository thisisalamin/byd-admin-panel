<?php

class Shortcode{
    public function __construct() {
        add_shortcode('byd_users', [$this, 'user_list_shortcode']);
    }

    public function user_list_shortcode($attr) {
        $attr = shortcode_atts([
            'search' => '',

        ], $attr);
        
        ob_start();
        // Plugin url path BYD_ADMIN_PANEL_PATH
        include BYD_ADMIN_PANEL_PATH . 'includes/view.php';
        return ob_get_clean();
    }
}
<?php

/**
 * Plugin Name: Keep New Admin Menu Items in Bottom
 * Plugin URI: https://github.com/obawp/keep-new-admin-menu-items-in-bottom
 * Description: Ensures that new admin menu items are placed at the bottom of the menu.
 * Version: 1.2.0
 * Author: ObaWP
 * Author URI: https://obawp.com
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: keep-new-admin-menu-items-in-bottom
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// Hook to reorder the menu after the admin menu is loaded
add_action('admin_menu', 'reorder_admin_menu', 999);

function reorder_admin_menu()
{
    global $menu;

    // Default slugs in the specified order
    $default_slugs = array(
        'index.php',                                  // Dashboard
        'separator1',                                 // Separator 1
        'edit.php',                                   // Posts
        'upload.php',                                 // Media
        'edit.php?post_type=page',                    // Pages
        'edit-comments.php',                          // Comments
        'separator-woocommerce',                      // WooCommerce Separator
        'woocommerce',                                // WooCommerce
        'edit.php?post_type=product',                 // WooCommerce Products
        'wc-admin&path=/wc-pay-welcome-page',         // Payments
        'wc-admin&path=/analytics/overview',          // Analytics
        'woocommerce-marketing',                      // Marketing
        'separator-elementor',                        // Elementor Separator
        'elementor',                                  // Elementor
        'edit.php?post_type=elementor_library',       // Elementor Templates
        'separator-last',                             // Last Separator
        'themes.php',                                 // Appearance
        'plugins.php',                                // Plugins
        'users.php',                                  // Users
        'tools.php',                                  // Tools
        'options-general.php',                        // Settings
    );

    // Allow other developers to modify the default slugs
    $default_slugs = apply_filters('knamib_default_slugs', $default_slugs);

    // Separate default items from new items
    $default_menu = array();
    $new_menu = array();

    foreach ($menu as $item) {
        if (in_array($item[2], $default_slugs)) {
            $default_menu[$item[2]] = $item;
        } else {
            $new_menu[] = $item;
        }
    }

    // Reorder default items in the specified order
    $ordered_default_menu = array();
    foreach ($default_slugs as $slug) {
        if (isset($default_menu[$slug])) {
            $ordered_default_menu[] = $default_menu[$slug];
        }
    }

    // Combine the ordered default items with the new items, keeping the new items at the bottom
    $menu = array_merge($ordered_default_menu, $new_menu);
}


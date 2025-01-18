=== Keep New Admin Menu Items in Bottom ===
Contributors: antonio24073, obawp
Donate link: https://obawp.com/doacoes/
Tags: menu, admin, menu order
Requires at least: 4.0
Tested up to: 6.7.1
Stable tag: 1.2.1
Requires PHP: 5.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

WordPress plugin to keep new plugin admin menu items at the bottom of the admin menu.

== Description ==

The "Keep New Admin Menu Items in Bottom" WordPress plugin maintains a tidy and organized admin menu by ensuring that newly added menu items appear at the bottom of the menu. This helps maintain a consistent and organized admin interface, keeping your default WordPress menu items in their familiar positions.

= Features =
* Automatically orders default WordPress menu items
* Pushes new menu items to the bottom
* WooCommerce and Elementor menu items stay in the same position.
* Customizable through hooks

= Developer Hook Example =

You can modify the default menu items using the `knamib_default_slugs` filter:

``
    // List menu slugs
    add_action('admin_notices', function () {
        global $menu;
    ?>
        <div class="notice notice-success is-dismissible">
            <p>
            <pre><?php
                    print_r(array_column($menu, 2));
                    ?></pre>
            </p>
        </div>
    <?php
    });

    // Add a custom menu item to the default items list
    add_filter('knamib_default_slugs', function ($default_slugs) {
        $slug = 'jetpack';
        array_splice($default_slugs, 3, 0, $slug); // splice in at position 3
        return $default_slugs;
    });

    // Remove an item from the default items list
    add_filter('knamib_default_slugs', function ($default_slugs) {
        return array_diff($default_slugs, ['woocommerce']); // Removes Media from default items
        return $default_slugs;
    });
``


== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/keep-new-admin-menu-items-in-bottom` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. That's it! New menu items will automatically be placed at the bottom of your admin menu.

== Screenshots ==

1. Menu items going down.

== Frequently Asked Questions ==

= How does it work? =

The plugin maintains a list of default WordPress menu items and ensures they stay in their original positions. Any new menu items added by other plugins will automatically be placed at the bottom of the menu.

= Can I customize which items stay at the top? =

Yes, you can use the `knamib_default_slugs` filter to modify the list of menu items that should maintain their positions.

== Changelog ==

= 1.2.0 =
* Added support for WooCommerce and Elementor menu items
* Added developer filter hook for customizing default slugs
* Improved menu ordering logic

= 1.1.0 =
* Initial public release

== Upgrade Notice ==

= 1.2.0 =
This version adds support for WooCommerce and Elementor menu items and includes a new developer hook for customization.

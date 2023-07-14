<?php
/*
Plugin Name: Pinned Menu
Description: Adds a pinned menu to the bottom of all pages.
Author: Maksym Mezhyrytskyi
Version: 1.3
Plugin URI: https://github.com/qwazar14/pinned-menu/
Author URI: https://github.com/qwazar14/
*/

class PinnedMenu
{
    function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_footer', array($this, 'display_menu'));
    }

    function enqueue_scripts()
    {
        wp_enqueue_style('pinned-menu-style', plugins_url('pinned-menu.css', __FILE__));
    }

    function display_menu()
    {
        // Getting the list of categories
        $args = array(
            'taxonomy' => 'product_cat',
            'hide_empty' => true,
            'parent' => 0, // this will fetch top level/parent categories only
        );
        $product_categories = get_terms($args);
        $category_list = '';

        foreach ($product_categories as $product_category) {
            $category_list .= '<li><a href="' . get_term_link($product_category) . '">' . $product_category->name . '</a></li>';
        }

        // Defining the menu
        $menu = '<div class="mf-navigation-mobile" id="mf-navigation-mobile">
        <div class="navigation-list">
            <a href="' . get_home_url() . '" class="navigation-icon navigation-mobile_home"><i class="icon-home"></i> Головна</a>
            <div class="navigation-icon pinned-menu-navigation-mobile_cat">
                <i class="icon-menu"></i> Категорії
                <ul class="navigation-mobile_subcat">' . $category_list . '</ul>
            </div>
            <a href="' . wc_get_cart_url() . '" class="navigation-icon navigation-mobile_cart cart-contents "><i class="icon-bag2"></i><span class="mini-item-counter mf-background-primary">' . WC()->cart->get_cart_contents_count() . '</span> Кошик</a>
            <a href="' . get_permalink(get_option('woocommerce_myaccount_page_id')) . '" class="navigation-icon navigation-mobile_account"><i class="icon-user"></i> Акаунт</a>
        </div>
    </div>';

        echo $menu;
    }
}

new PinnedMenu();

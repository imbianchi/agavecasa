<?php

require get_theme_file_path('/inc/search-route.php');

function agavecasa_files()
{

    wp_localize_script('main-agavecasa-js', 'agaveCasaData', array(
        'root_url' => get_site_url(),
        'nonce' => wp_create_nonce('wp_rest')
    ));

    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_script('main-agavecasa-js', get_theme_file_uri('/build/index.js'), array(), '1.0', true);
    wp_enqueue_style('agavecasa_extra_styles', get_theme_file_uri('/build/style.css'));    
}

add_action('wp_enqueue_scripts', 'agavecasa_files', 99);

// Add custom shortcode
# [list-corporativo]
function funcaoListCorporativo()
{
    include 'list-corporativo.php';
}
add_shortcode('list-corporativo', 'funcaoListCorporativo');

# [list-projetos]
function funcaoListProjetos()
{
    include 'list-projetos.php';
}
add_shortcode('list-projetos', 'funcaoListProjetos');



// To change add to cart text on single product page
add_filter('woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text');
function woocommerce_custom_single_add_to_cart_text()
{
    return __('solicitar orçamento', 'woocommerce');
}

// To change add to cart text on product archives(Collection) page
add_filter('woocommerce_product_add_to_cart_text', 'woocommerce_custom_product_add_to_cart_text');
function woocommerce_custom_product_add_to_cart_text()
{
    return __('solicitar orçamento', 'woocommerce');
}

//Remove scripts and styles from react pages
add_action('wp_enqueue_scripts', 'wdequeue_react_scripts_styles', 101);

function wdequeue_react_scripts_styles()
{
    global $post;
    $pageId = $post->ID;

    if ($pageId == 1133) {
        //wp_dequeue_style('styles.css'); 
        wp_dequeue_style('flatsome.css?ver=3.15.4');
        wp_dequeue_style('flatsome-main');
        wp_enqueue_style('flatsome-without-inputs', get_stylesheet_directory_uri() . '/assets/css/flatsome-without-inputs.css', array(), filemtime(get_stylesheet_directory_uri() . '/assets/css/flatsome-without-inputs.css'), false);
        wp_enqueue_style('react-css', get_stylesheet_directory_uri() . '/assets/css/react.css', array(), filemtime(get_stylesheet_directory_uri() . '/assets/css/react.css'), false);
    }
}


function woocommerce_button_proceed_to_checkout()
{ ?>
    <a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="checkout-button button alt wc-forward">
        <?php esc_html_e('Enviar orçamento', 'woocommerce'); ?>
    </a>
<?php
}


define('WP_SCSS_ALWAYS_RECOMPILE', true);
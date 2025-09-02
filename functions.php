<?php
function meu_tema_scripts() {
    wp_enqueue_style('style', get_stylesheet_uri()); // style.css (obrigatório no tema)
    wp_enqueue_style('main', get_template_directory_uri() . '/assets/css/main.css');
}
add_action('wp_enqueue_scripts', 'meu_tema_scripts');

// Suporte a imagens destacadas
add_theme_support('post-thumbnails');

// Suporte a título dinâmico
add_theme_support('title-tag');

// Suporte a menus
add_theme_support('menus');

// Registrar menus
function meu_tema_menus() {
    register_nav_menus(array(
        'header-menu' => 'Menu do Cabeçalho',
        'footer-menu' => 'Menu do Rodapé'
    ));
}
add_action('init', 'meu_tema_menus');

// Adicionar meta box para subtítulo do post
function adicionar_meta_box_subtitulo() {
    add_meta_box(
        'subtitulo_post',
        'Subtítulo do Post',
        'meta_box_subtitulo_callback',
        'post',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'adicionar_meta_box_subtitulo');

function meta_box_subtitulo_callback($post) {
    wp_nonce_field('salvar_subtitulo', 'subtitulo_nonce');
    $subtitulo = get_post_meta($post->ID, 'subtitulo', true);
    echo '<input type="text" id="subtitulo" name="subtitulo" value="' . esc_attr($subtitulo) . '" style="width: 100%;" placeholder="Digite o subtítulo do post aqui..." />';
}

function salvar_subtitulo($post_id) {
    if (!isset($_POST['subtitulo_nonce']) || !wp_verify_nonce($_POST['subtitulo_nonce'], 'salvar_subtitulo')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['subtitulo'])) {
        update_post_meta($post_id, 'subtitulo', sanitize_text_field($_POST['subtitulo']));
    }
}
add_action('save_post', 'salvar_subtitulo');

// Personalizar tamanhos de imagem
add_image_size('post-featured', 800, 450, true);

// Limpar wp_head
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
?>
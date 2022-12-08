<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'bootstrap','unite-icons' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );

// END ENQUEUE PARENT ACTION

add_action( 'init', 'register_employees_post_type' );
function register_employees_post_type() {

// Рубрика - Категория сотрудников
	register_taxonomy( 'employees_category', [ 'employees' ], [
		'label'                 => 'Категория сотрудников',
		'labels'                => array(
			'name'              => 'Категории сотрудников',
			'singular_name'     => 'Категория сотрудников',
			'search_items'      => 'Искать категорию сотрудников',
			'all_items'         => 'Все категории сотрудников',
			'parent_item'       => 'Родит. категория сотрудников',
			'parent_item_colon' => 'Родит. категория сотрудников:',
			'edit_item'         => 'Ред. категорию сотрудников',
			'update_item'       => 'Обновить категорию сотрудников',
			'add_new_item'      => 'Добавить категорию сотрудников',
			'new_item_name'     => 'Новая категория сотрудников',
			'menu_name'         => 'Категории сотрудников',
		),
		'description'           => 'Рубрики для категорий сотрудников',
		'public'                => true,
		'show_in_nav_menus'     => false,
		'show_ui'               => true,
		'show_tagcloud'         => false,
		'hierarchical'          => true,
		'rewrite'               => array('slug'=>'employees', 'hierarchical'=>false, 'with_front'=>false, 'feed'=>false ),
		'show_admin_column'     => true,
	] );

// Тип записи - Сотрудники
	register_post_type( 'employees', [
		'label'             => 'Сотрудники',
		'labels'            => array(
			'name'               => 'Сотрудники',
			'singular_name'      => 'Сотрудник',
			'add_new'            => 'Добавить сотрудника',
			'add_new_item'       => 'Добавление нового сотрудника',
			'edit'               => 'Редактировать',
			'edit_item'          => 'Редактирование сотрудника',
			'new_item'           => 'Новый сотрудник',
			'view_item'          => 'Смотреть сотрудника',
			'search_items'       => 'Искать сотрудника',
			'not_found'          => 'Не найдено',
			'not_found_in_trash' => 'Не найдено в корзине',
			'all_items'          => 'Все сотрудники',
			'menu_name'          => 'Сотрудники',
		),
		'description'         => '',
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_rest'        => false,
		'rest_base'           => '',
		'show_in_menu'        => true,
		'menu_icon'           => 'dashicons-groups',
		'exclude_from_search' => false,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'rewrite'             => array( 'slug'=>'employees/%employees_category%', 'with_front'=>false, 'pages'=>false, 'feeds'=>false, 'feed'=>false ),
		'has_archive'         => 'employees',
		'query_var'           => true,
		'supports'            => array( 'title', 'editor','thumbnail' ),
		'taxonomies'          => array( 'employees_category' ),
	] );
}
add_filter( 'post_type_link', 'employees_permalink', 1, 2 );
function employees_permalink( $permalink, $post ){

	// выходим если это не наш тип записи: без холдера %employees_category%
	if( strpos( $permalink, '%employees_category%' ) === false )
		return $permalink;

	// Получаем элементы таксы
	$terms = get_the_terms( $post, 'employees_category' );
	// если есть элемент заменим холдер
	if( ! is_wp_error( $terms ) && !empty( $terms ) && is_object( $terms[0] ) )
		$term_slug = array_pop( $terms )->slug;
	// элемента нет, а должен быть...
	else
		$term_slug = 'no-employees_category';

	return str_replace( '%employees_category%', $term_slug, $permalink );
}

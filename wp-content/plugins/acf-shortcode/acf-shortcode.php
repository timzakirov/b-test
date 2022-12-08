<?php
/*
Plugin Name: ACF shortcode
Description: ACF shortcode
Version: 1.0
Author: Zakirov T.
*/

function employees_shortcode( $atts ) {
ob_start();
	if ($atts['sort']) {
		$metakey = 'salary';
		$sort = $atts['sort'];
		$orderby = 'meta_value_num';
	} else {
		$sort = 'ASC';
		$orderby = 'date';
	}	
$atts = shortcode_atts( [
        'post_type'      => 'employees',
        'post_status'    => 'publish',
        // maximum amount of posts, use -1 to set unlimited
        'posts_per_page' => 10,
		'meta_key'       => $metakey,
        'order'          => $sort,
        'orderby'        => $orderby,
		'sort'           => '',
	    'salary_min'     => '',
	    'salary_max'     => '',
        'meta_query'     => array(
			array(
                'name'       => get_field('name'),
                'salary'     => get_field('salary'),
            ),
        ),
    ], $atts );
	
    $query = new WP_Query($atts);  
    $posts = $query->get_posts();
	echo '<div class="employees">';
    foreach ($posts as $post) { 
        $postId        = $post->ID;       
        $title         = get_the_title($postId);       
        $description   = get_the_excerpt($postId);      
        $name          = get_field('name', $postId);       
        $salary        = get_field('salary', $postId);
		$thumbnail     = get_the_post_thumbnail_url($postId);
		
		if ( $atts['salary_min'] < $salary && $salary < $atts['salary_max'] ) {
			echo '<div class="employees-item">' . '<span class="employees-item__image" style="background-image: url(' . $thumbnail. ')"></span>' . '<span class="employees-item__name">' . $name . '</span>' . '<span class="employees-item__salary">' . number_format($salary, 0, ',', ' ') . '</span>' . '</div>';
		}		
	}
	echo '</div>';
	return ob_get_clean();
}

add_shortcode( 'employees', 'employees_shortcode' );

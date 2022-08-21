<?php

add_action('rest_api_init', 'agaveCasaRegisterSearch');

function agaveCasaRegisterSearch()
{
  register_rest_route('agavecasa/v1', 'search', array(
    'methods' => WP_REST_SERVER::READABLE,
    'callback' => 'agaveCasaSearchResults'
  ));
}

function agaveCasaSearchResults($data)
{

  $term = sanitize_text_field($data['term']);

  $generalQuery = new WP_Query(array(
    'post_status' => 'publish',
    'post_type' => array('post', 'page','product'),
    'orderby' => 'date',
    'posts_per_page' => 10,
    'order' => 'DESC',
    's' => $term,
  ));

  $results = array(
    'generalInfo' => array(),
    'products' => array(),
  );

  while ($generalQuery->have_posts()) {
    $generalQuery->the_post();

    if (get_post_type() == 'post' or get_post_type() == 'page') {
      array_push($results['generalInfo'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink(),
        'postType' => get_post_type(),
        'authorName' => get_the_author()
      ));
    }

    if (get_post_type() == 'product') {
      array_push($results['products'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink(),
        'postType' => get_post_type(),
      ));
    }
  }

  return $results;
}

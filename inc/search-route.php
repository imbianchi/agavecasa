<?php

add_action('rest_api_init', 'agaveCasaRegisterSearch');

function agaveCasaRegisterSearch() {
  register_rest_route('agavecasa/v1', 'search', array(
    'methods' => WP_REST_SERVER::READABLE,
    'callback' => 'agaveCasaSearchResults'
  ));
}

function agaveCasaSearchResults($data) {
  $mainQuery = new WP_Query(array(
    'post_type' => array('post', 'page', 'products'),
    's' => sanitize_text_field($data['term'])
  ));

  $results = array(
    'generalInfo' => array(),
  );

  while($mainQuery->have_posts()) {
    $mainQuery->the_post();

    if (get_post_type() == 'post' OR get_post_type() == 'page') {
      array_push($results['generalInfo'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink()
      ));
    }    
  }

  return $results;

}
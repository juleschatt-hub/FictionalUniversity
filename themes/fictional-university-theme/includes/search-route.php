<?php
add_action('rest_api_init', 'universityRegisterSearch');

function universityRegisterSearch() {
    register_rest_route('university/v1', 'search', array(
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'universitySearchResults'
    ));
}

function universitySearchResults($data) {
   $professors = new WP_Query(array(
    'post_type' => 'professor',
    's' => sanitize_text_field($data['term'])
   ));

   $professorResults = array();

   while($professors->have_posts()) {

    $professors->the_post();
    array_push($professorResults, array(
        'title' => get_the_title(),
        'ID' => get_the_id(),
        'permalink' => get_the_permalink(),
        'content' => get_the_content()
    ));

   }

   return $professorResults;
}
?>
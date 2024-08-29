<?php

function cmb_about_metaboxes( array $meta_boxes ) {

    $person = array (
        array( 'id' => 'about-person-name', 'name' => 'Name', 'type' => 'text', 'cols' => '4' ),
        array( 'id' => 'about-person-position', 'name' => 'Position', 'type' => 'text', 'cols' => '4' ),
        array( 'id' => 'about-person-url', 'name' => 'URL', 'type' => 'text_url', 'cols' => '4' ),
        array( 'id' => 'about-person-image', 'name' => 'Profile Picture - 150x200px', 'type' => 'file', 'cols' => '3' ),
        array( 'id' => 'about-person-testimonial', 'name' => 'Testimonial', 'type' => 'textarea', 'cols' => '9' ),
    );

    /* fields */
    $fields = array(
        array( 'id' => 'about-testimonial', 'name' => 'About Testimonials Section', 'type' => 'textarea', 'cols' => '12' ),
        array( 'id' => 'about-person', 'name' => 'Add Team Member', 'type' => 'group', 'fields' => $person, 'repeatable' => true, 'repeatable_max' => 5 ),
    );
    
    
    /* metabox */
    $meta_boxes[] = array(
        'title' => 'Individual',
        'show_on' => array( 'id' => array(14)),
        'pages' => 'page',
        'fields' => $fields
    );

    return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'cmb_about_metaboxes' );

?>

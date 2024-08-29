<?php
/*
Template Name: Pod Page Template
*/

get_header();

?>
<style>
#top #main .sidebar { background-color: #f7f7f7; }
.image-overlay .image-overlay-inside { display: none; }
.image-overlay .overlay-type-extern { display: none; }
.avia_transform a .image-overlay { display: none; }
.a:hover  { display: none; }
#container {
  width: 100%;
  /* height: 300px; */
  position: relative;
}
#navi,
#infoi {
  width: 100%;
  /* height: 100%; */
  position: absolute;
  top: 0;
  left: 0;
}
#infoi {
  z-index: 10;
}
.container-x {
    width: 100%;
    height: 250px;

    margin: auto;
    padding: 0px;
}
.one {
    width: 50%;
    height: 250px;
    float: left;
}
.two {
    margin-left: 0px;
    height: 250px;

}
</style>
<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>

        <p style="	padding: 40px;"> </p>
        <?php echo $post->post_content; // if home page has content show it here ?>
        <p style="	padding: 25px;"> </p>

	<div class='container template-blog template-single-blog '>
		<main style="padding-top: 0px;" class='content units <?php avia_layout_class( 'content' ); ?> <?php echo avia_blog_class_string(); ?>' <?php avia_markup_helper(array('context' => 'content','post_type'=>'post'));?>>
                <div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>

                <div id="in_main" style="padding-top: 0px; padding-left: 80px;">

			 <?php   //WP Loop

			$args=array( 'taxonomy' => 'main_topic' );
              $topics = pods('main_topic');
			  $terms = get_the_terms( $post->ID , 'product_tag' );
			  $categories=get_categories($args);
			  foreach ($categories as $category) {
              	  $topic = pods('main_topic' , $category->slug);
				  $color= $topic->field('color');
				  $name= $topic->field('name');
				  $slug = $topic->field('slug');
				  $description = $topic->field('description');
				  $artwork= $topic->field('artwork.guid');

            /* generate boxes based on topic category */
            ?>

<a href="/article-listing/?cat=<?php echo $slug; ?>" style="text-decoration: none;">
<section class="container-x">
    <div class="one first_one">
    	<div id="container">
            <div id="navi"><img src="<?php echo $artwork  ?>" style="height: 250px;" ></div>
            <div id="infoi">
                    <div style="background-color:<?php echo $color; ?>; opacity: 0.75;  border: 0; padding: 6px;">
                    <p class="banner-title" style="font-size: 16pt; font-weight: bold; color: white; padding-left: 10px;"><?php echo $name; ?></p>
                    </div>
            </div>
	    </div>
    </div>
    <div class="two first_two">
      <div class="two_txt" style="float: left; height: 250px; width: 50%; margin-right: 0px; opacity: 1; background-color:<?php echo $color; ?>	">
                <p style="color: white; font-size: 11pt; margin: 64px;"><?php echo $description  ?></p>
      </div>
    </div>
</section>
</a>
                <div style="border-width: 0px;  clear: both; display: block; ">
                <p style="	padding: 20px;">






			 <?php } ?>
              </div>
				</main>

				<?php
				$avia_config['currently_viewing'] = "blog";
				//get the sidebar
				get_sidebar();


				?>


			</div><!--end container-->

		</div><!-- close default .container_wrap element -->


<?php get_footer(); ?>

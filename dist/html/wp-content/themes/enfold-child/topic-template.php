<?php
/*
Template Name: Topic Template
*/

get_header(); 

  $topic = $_GET["cat"];
  if (is_null($topic)) $topic = 'academics';
  $topics = pods('main_topic' , $topic);
  $color= $topics->field('color'); 
  $name= $topics->field('name');
  $topic_slug = $topics->field('slug');
  $description = $topics->field('description');
  $artwork= $topics->field('artwork.guid');

/* generate banner based on topic category */
?>
<style>
 #top #main .sidebar { background-color: #f7f7f7; }
 .responsive #main .container {
    max-width: 100%!important;
}

#main .container {
	padding: 0 !important;
}

</style>

        <div id="banner-academics-box" style="background-color:<?php echo $color; ?>; width: 100%; border: 0; padding: 3px;">
        <p class="banner-title" style="font-size: 1.8em; color: white; padding-left: 60px;"><a href="/article-listing/?cat=<?php echo $topic_slug; ?>" style="color: white; text-decoration: none;"><?php echo $name; ?></a></p>
        </div>
		<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>

	<div class='container template-blog template-single-blog '> 
				<main style="padding-top: 0px;" class='content units <?php avia_layout_class( 'content' ); ?> <?php echo avia_blog_class_string(); ?>' <?php avia_markup_helper(array('context' => 'content','post_type'=>'post'));?>>

				<img src="<?php echo $artwork  ?>" alt="" width="1200" height="400" />
				<!-- <img style="margin-left: -100px;" src="<?php echo $artwork  ?>" alt="" width="1200" height="400" /> -->

			 <?php
            //WP Loop  
            
            $param = array( 
    				'orderby' => 'name ASC', 
                    'limit' => 30
                );
              $articles = pods('article', $param); 
			  
            ?>
            
            
            <div id="main-topic-section" >
            <div class="topic-title" ><?php echo $description  ?></div> 
            
              <?php while ( $articles->fetch() ) : 
				  $article_topics = $articles->field('main_topic');
				  $include = FALSE;
				  foreach ($article_topics as $topic) {
					if ($topic['slug'] == $topic_slug) $include = TRUE;
				  }
				  if ($include) {
					  // set our variables
					  $title= $articles->field('name');
					  $teaser= $articles->field('right_column_top');
					  $teaser= $articles->field('excerpt');
					  $permalink= $articles->field('permalink');
				  ?>
					  <div id="topic-section">
						<div class="topic-third-level-title"><?php echo $title; ?></div>
						<div class="topic-teaser" ><?php echo $teaser; ?> 
							<a href="/article/?cat=<?php echo $topic_slug; ?>&article=<?php echo $articles->field('slug'); ?>" style="text-decoration: underline;">More</a>
							
					    </div>
                     </div>
				
				<?php }
              endwhile; ?> 
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
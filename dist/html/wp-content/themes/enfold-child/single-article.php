<?php
/*
Template Name: Pod Page Template
*/

get_header(); 
  $article_slug = $_GET["article"];
  if (is_null($article_slug)) $article_slug = pods_v( 'last', 'url' );;
  $article = pods('article' , $article_slug);

  $topic = $_GET["cat"];
  //var_dump($article->field('main_topic'));
  if (is_null($topic)) { $topic_array = $article->field('main_topic'); $topic = $topic_array[0]['slug']; }
  $topics = pods('main_topic' , $topic);
  $color= $topics->field('color'); 
  $name= $topics->field('name');
  $topic_slug = $topics->field('slug');
  $description = $topics->field('description');
  $artwork= $topics->field('artwork.guid');  
  
  $default_image = "http://everydaymentor.org/wp-content/uploads/2017/03/logo-edm.png";

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
        <p class="banner-title" style="font-size: 1.6em; color: white; padding-left: 60px;"><a href="/article-listing/?cat=<?php echo $topic_slug; ?>" style="color: white; text-decoration: none;"><?php echo $name; ?></a></p>
        </div>
		<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>

	<div class='container template-blog template-single-blog '> 
				<main style="padding-top: 0px;" class='content units <?php avia_layout_class( 'content' ); ?> <?php echo avia_blog_class_string(); ?>' <?php avia_markup_helper(array('context' => 'content','post_type'=>'post'));?>>


<div id="article-main" >
  	<div id="article-left-col" >
	<?php 
		$image = $article->field('post_thumbnail_url.large'); 
		if ( $image == '') $image = $default_image;
	?>
    
	  	<img src=<?php echo $image; ?> style=" padding: 0px 20px 30px 0px;">
	</div>
  	<div id="article-right-col">
		<div id="article-right-column-top-section" style="padding-top: 40px;">
			<h2 class="article-title"><?php echo $article->field('post_title'); ?></h2>
            <?php $excerpt = $article->field('right_column_top'); if ( $excerpt == "") $excerpt = $article->field('excerpt'); ?>
			<div class="article-right-column-top"><?php echo $excerpt; ?></div>
		</div>	
	</div>

	<hr class="article-divider-white">
<div id="left" style="padding-left: 60px; padding-right: 60px;">
	<div id="article-left-col" >
		
		<h2 class="article-title"><?php echo $article->field('left_column_title'); ?></h2>
		<div class="article-left-column"><?php echo $article->field('left_column'); ?></div>
	</div>
	
  <div id="article-right-col" >
	<div id="article-right-column-middle-section">
		<h2 class="article-title"><?php echo $article->field('right_column_middle_title'); ?></h2>
		<div class="article-right-column-middle"><?php echo $article->field('right_column_middle'); ?></div>
	</div>		
	<div id="article-right-column-bottom-section" style="padding-bottom: 40px; padding-top: 10px;">
		<h2 class="article-title"><?php echo $article->field('right_column_bottom_title'); ?></h2>
		<div class="article-right-column-bottom"><?php echo $article->field('right_column_bottom'); ?></div>
	</div>
  </div>  

	<hr class="article-divider-grey">

</div>


<div id="left-bottom" style="padding-left: 60px; padding-right: 60px;">	
	<div style="margin-right: 20px;">
		<h2 class="article-title"><?php echo $article->field('the_bigger_picture_title'); ?></h2>
		<div class="article-the-bigger-picture"><?php echo $article->field('the_bigger_picture'); ?></div>
	</div>
	
	<hr class="article-divider-grey">
			
	<div id="article-from-the-blog-section">
	<?php 
		$image = $article->field('from_the_blog_image._src.large');
		if ( $image == '') $image = "http://everydaymentor.org/wp-content/uploads/2017/01/chronicle-logo.png";
	?>
        <img src="<?php echo $image; ?>" style="float:right; width:350px; padding:0px 20px 20px 20px;">
     	<h2 class="article-title"><?php echo $article->field('from_the_blog_title'); ?></h2>
		<div class="article-from-the-blog-link"><a href="<?php echo $article->field('from_the_blog_link'); ?>">The Chroncile of Evidence-based Mentoring</a></div>
		<BR><strong><?php echo $article->field('from_the_blog_subtitle'); ?></strong>
		<div class="article-from-the-blog"><?php echo $article->field('from_the_blog'); ?></div>
	</div>
	
	<hr class="article-divider-grey">
	
	<div style="margin-right: 20px;">
	<?php 
		$image = $article->field('supporting_data_image._src.large');
		if ( $image == '') $image = ""; //$default_image;
	?>
           	<img src="<?php echo $image; ?>" style="float:left; width:350px; padding:0px 20px 20px 20px;">
		<h2 class="article-title"><?php echo $article->field('supporting_data_title'); ?></h2>
		<div class="article-supporting-data"><?php echo $article->field('supporting_data'); ?></div>
	</div>
	
	<?php if ($article->field('more_topics') != "") { ?>
	<hr class="article-divider-grey">
	
	<div id="article-more-topics-section">
		<h2 class="article-title"><?php echo $article->field('more_topics_title'); ?></h2>
		<div class="article-more-topics"><?php echo $article->field('more_topics'); ?></div>
	</div>
    <?php } ?>		
</div>	           
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
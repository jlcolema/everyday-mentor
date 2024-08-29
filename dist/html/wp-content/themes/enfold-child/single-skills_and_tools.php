<?php
/*
Template Name: Skills and Tools Template
*/

get_header(); 

  $color= "#FF9E17"; 
  $name= "Skills and Tools";
  
  $skills_slug = $_GET["skill"];
  if (is_null($skills_slug)) $skills_slug = pods_v( 'last', 'url' );;
  $skills = pods('skills_and_tools' , $skills_slug);
  $artwork= $skills->field('artwork.guid');

  $default_image = "/wp-content/uploads/2017/03/Substance-Use-parents.02.23.17-blog.jpg";

/* generate banner for skills and tools page */
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
        <p class="banner-title" style="font-size: 1.8em; color: white; padding-left: 60px;"><?php echo $name; ?></p>
        </div>
        
		<div class='container_wrap container_wrap_first main_color sidebar_right'>
			<div class='container template-blog template-single-blog '> 
				<main style="padding-top: 0px;" class='content units <?php avia_layout_class( 'content' ); ?> <?php echo avia_blog_class_string(); ?>' <?php avia_markup_helper(array('context' => 'content','post_type'=>'post'));?>>

				<img src="<?php echo $skills->field('page_image.guid');  ?>" alt="" width="1200" height="400" />
                    
                    <div id="main-article-section" >
                        <div class="article-title" ><?php echo $skills->field('title');  ?></div> 
                        <div class="article-summary" ><?php echo $skills->field('summary');  ?></div> 
        
                              <div id="skills-section" style="margin-bottom: 40px;">
                              
                                <?php for ($i = 1; $i <= 8; $i++) { 
							  		$heading = 'section_heading_' . $i;
							  		$detail = 'section_detail_' . $i; ?>
 
                                	<?php if ($skills->field($heading) != '') { ?>
                                    	<div class="topic-third-level-title"><?php echo $skills->field($heading); ?></div>
                                		<div class="topic-teaser" ><?php  echo $skills->field($detail); ?></div>
                              		<?php }
                                    
							     } ?>
                              
                              </div>
                    
                    </div><!-- main-article-section -->          
			</main>

				<?php
 
 				//get the sidebar
				get_sidebar();


				?>


			</div><!--end container-->

		</div><!-- close default .container_wrap element -->


<?php get_footer(); ?>
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



		<div class="home-page-title">There are over 25 million everyday mentors in America guiding youth in many new directions. This site is for you.</div>

		<!-- BEGIN Collage -->

		<div class="collage">

			<img class="aligncenter size-full wp-image-3427" src="http://everydaymentor.dev/wp-content/uploads/2017/02/homepage-faces-strip-1.jpg" alt="" width="100%" />

			<div class="overlay">

				<ul>

					<li class="msgtipy collage-message-01" title="Lam is struggling with depression. How do I talk to him about this?">Lam is struggling with depression. How do I talk to him about this?</li>
					<li class="msgtipy collage-message-02" title="What is the instructor-student boundary?">What is the instructor-student boundary?</li>
					<li class="msgtipy collage-message-03" title="Is it ok for me to contradict Nandi&rsquo;s parents&rsquo; conservative gender values if I feel it&rsquo;s best for her?">Is it ok for me to contradict Nandi&rsquo;s parents&rsquo; conservative gender values if I feel it&rsquo;s best for her?</li>
					<li class="msgtipy collage-message-04" title="How can I help my young brother make new friends?">How can I help my young brother make new friends?</li>
					<li class="msgtipy collage-message-05" title="I can tell my player is distracted by dad&rsquo;s recent incarceration. How can I help?">I can tell my player is distracted by dad&rsquo;s recent incarceration. How can I help?</li>
					<li class="msgtipy collage-message-06" title="How can I promote Brianna&rsquo;s positive self-esteem?">How can I promote Brianna&rsquo;s positive self-esteem?</li>
					<li class="msgtipy collage-message-07" title="I worry that my teenage neice might have an eating disorder. What&rsquo;s the best way to talk about it?">I worry that my teenage neice might have an eating disorder. What&rsquo;s the best way to talk about it?</li>
					<li class="msgtipy collage-message-08" title="I think my niece might be getting bullied at school. How can I help?">I think my niece might be getting bullied at school. How can I help?</li>
					<li class="msgtipy collage-message-09" title="How do I get Joey to start thinking about college?">How do I get Joey to start thinking about college?</li>

				</ul>

			</div>

		</div>


		<!-- END Collage -->

		<!-- BEGIN Original -->

		<?php /*

			<img class="aligncenter size-full wp-image-3427" src="http://everydaymentor.dev/wp-content/uploads/2017/02/homepage-faces-strip-1.jpg" alt="" usemap="#imgmap" width="100%" />

			<map name="imgmap">

				<area class="msgtipy" title="Lam is struggling with depression. How do I talk to him about this?" coords="56,15,171,171" shape="rect" data-position="top" /> <area class="msgtipy" title=" What is the instructor-student boundary?" coords="352,32,236,171" shape="rect" data-position="top" />
				<area class="msgtipy" title="Is it ok for me to contradict Nandi’s parents’ conservative gender values if I feel it’s best for her?" coords="530,32,418,171" shape="rect" data-position="top" />
				<area class="msgtipy" title="How can I help my young brother make new friends?" coords="700,32,590,171" shape="rect" data-position="top" />
				<area class="msgtipy" title=" I can tell my player is distracted by dad’s recent incarceration. How can I help?" coords="900,32,782,171" shape="rect" data-position="top" />
				<area class="msgtipy" title="How can I promote Brianna’s positive self-esteem?" coords="1030,32,932,171" shape="rect" data-position="top" />
				<area class="msgtipy" title="I worry that my teenage neice might have an eating disorder.  What’s the best way to talk about it?" coords="1220,32,1106,179" shape="rect" data-position="top" />
				<area class="msgtipy" title=" I think my niece might be getting bullied at school. How can I help?" coords="1375,32,1260,171" shape="rect" data-position="top" />
				<area class="msgtipy" title="How do I get Joey to start thinking about college?" coords="1560,32,1440,171" shape="rect" data-position="top" />

			</map>

		*/ ?>

		<!-- END Original -->

		<div class="home-page-subtitle">You have questions. We have answers.</div>



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

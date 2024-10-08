<?php


if ( ! class_exists( 'Shoestrap_Blog' ) ) {

	/**
	* The "Blog" module
	*/
	class Shoestrap_Blog {

		function __construct() {

			global $ss_settings;

			if ( ! class_exists( 'BuddyPress' ) || ( class_exists( 'BuddyPress' ) && ! shoestrap_is_bp() ) ) {
				add_action( 'shoestrap_entry_meta', array( $this, 'meta_custom_render' ) );
			}
			add_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );

			// Add featured media
			//if ( ! is_singular() && $ss_settings['feat_img_archive'] == 1 ) {
				add_action( 'pa_entry_media', array( $this, 'featured_image' ) );
				add_action( 'pa_entry_media', array( $this, 'pa_post_media' ) );
			//}
			//if ( is_singular() && $ss_settings['feat_img_post'] == 1 ) {

			//}
			// Chamnge the excerpt length
			if ( isset( $ss_settings['post_excerpt_length'] ) ) {
				add_filter( 'excerpt_length', array( $this, 'excerpt_length' ) );
			}

			// Show full content instead of excerpt
			if ( isset( $ss_settings['blog_post_mode'] ) && 'full' == $ss_settings['blog_post_mode'] ) {
				add_filter( 'shoestrap_do_the_excerpt', 'get_the_content' );
				add_filter( 'shoestrap_do_the_excerpt', 'do_shortcode', 99 );
				//add_action( 'shoestrap_entry_footer', array( $this, 'archives_full_footer' ) );
			}

		}

		/**
		 * Footer for full-content posts.
		 * Used on archives when 'blog_post_mode' == full
		 */
		function archives_full_footer() { ?>
			<footer style="margin-top: 2em;">
				<i class="fa fa-tag"></i> <?php _e( 'Categories: ', 'knowledgepress' ); ?>
				<span class="label label-tag">
					<?php echo get_the_category_list( '</span> ' . '<span class="label label-tag">' ); ?>
				</span>

				<?php echo get_the_tag_list( '<i class="fa fa-tags"></i> ' . __( 'Tags: ', 'knowledgepress' ) . '<span class="label label-tag">', '</span> ' . '<span class="label label-tag">', '</span>' ); ?>

				<?php wp_link_pages( array(
					'before' => '<nav class="page-nav"><p>' . __( 'Pages:', 'knowledgepress' ),
					'after'  => '</p></nav>'
				) ); ?>
			</footer>
			<?php
		}

		/**
		 * Output of meta information for current post: categories, tags, permalink, author, and date.
		 */
		function meta_custom_render() {
			global $ss_framework, $ss_settings, $post;

			// get config and data
			$metas = $ss_settings['shoestrap_entry_meta_config'];
			$date_format = $ss_settings['date_meta_format'];

			$categories_list = get_the_category_list( __( ', ', 'knowledgepress' ) );
			$tag_list        = get_the_tag_list( '', __( ', ', 'knowledgepress' ) );

			$i = 0;
			if ( is_array( $metas ) ) {
				foreach ( $metas as $meta => $value ) {
					if ( $meta == 'sticky' ) {
						if ( ! empty( $value ) && is_sticky() ) {
							$i++;
						}
					} elseif ( $meta == 'date' ) {
						if ( ! empty( $value ) ) {
							$i++;
						}
					} elseif ( $meta == 'category' ) {
						if ( ! empty( $value ) && has_category() ) {
							$i++;
						}
					} elseif ( $meta == 'tags' ) {
						if ( ! empty( $value ) && has_tag() ) {
							$i++;
						}
					} elseif ( $meta == 'author' ) {
						if ( ! empty( $value ) ) {
							$i++;
						}
					} elseif ( $meta == 'comment-count' && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
						if ( ! empty( $value ) ) {
							$i++;
						}
					}  elseif ( $meta == 'post-format' ) {
						if ( ! empty( $value ) ) {
							$i++;
						}
					}
				}
			}

			$col = ( $i >= 2 ) ? round( ( 12 / ( $i ) ), 0) : 12;

			$content = '';
			if ( is_array( $metas ) ) {
				foreach ( $metas as $meta => $value ) {
					// output sticky element
					if ( $meta == 'sticky' && ! empty( $value ) && is_sticky() ) {
						$content .= $ss_framework->open_col( 'span', array( 'medium' => $col ), null, 'featured-post' ) . '<i class="fa fa-flag-o"></i> ' . __( 'Sticky', 'knowledgepress' ) . $ss_framework->close_col( 'span' );
					}

					// output post format element
					if ( $meta == 'post-format' ) {
						if ( get_post_format( $post->ID ) === 'gallery' ) {
						  $content .= $ss_framework->open_col( 'span', array( 'medium' => $col ), null, 'post-format' ) . '<i class="fa fa-th"></i> <a href="' . esc_url( get_post_format_link( 'gallery' ) ) . '">' . __('Gallery','shoestrap') . '</a>' . $ss_framework->close_col( 'span' );
						} elseif ( get_post_format( $post->ID ) === 'aside' ) {
						  $content .= $ss_framework->open_col( 'span', array( 'medium' => $col ), null, 'post-format' ) . '<i class="fa fa-file-o"></i> <a href="' . esc_url( get_post_format_link( 'aside' ) ) . '">' . __('Aside','shoestrap') . '</a>' . $ss_framework->close_col( 'span' );
						} elseif ( get_post_format( $post->ID ) === 'link' ) {
						  $content .= $ss_framework->open_col( 'span', array( 'medium' => $col ), null, 'post-format' ) . '<i class="fa fa-link"></i> <a href="' . esc_url( get_post_format_link( 'link' ) ) . '">' . __('Link','shoestrap') . '</a>' . $ss_framework->close_col( 'span' );
						} elseif ( get_post_format( $post->ID ) === 'image' ) {
						  $content .= $ss_framework->open_col( 'span', array( 'medium' => $col ), null, 'post-format' ) . '<i class="fa fa-picture-o"></i> <a href="' . esc_url( get_post_format_link( 'image' ) ) . '">' . __('Image','shoestrap') . '</a>' . $ss_framework->close_col( 'span' );
						} elseif ( get_post_format( $post->ID ) === 'quote' ) {
						  $content .= $ss_framework->open_col( 'span', array( 'medium' => $col ), null, 'post-format' ) . '<i class="fa fa-quote-left"></i> <a href="' . esc_url( get_post_format_link( 'quote' ) ) . '">' . __('Quote','shoestrap') . '</a>' . $ss_framework->close_col( 'span' );
						} elseif ( get_post_format( $post->ID ) === 'status' ) {
						  $content .= $ss_framework->open_col( 'span', array( 'medium' => $col ), null, 'post-format' ) . '<i class="fa fa-comment-o"></i> <a href="' . esc_url( get_post_format_link( 'status' ) ) . '">' . __('Status','shoestrap') . '</a>' . $ss_framework->close_col( 'span' );
						} elseif ( get_post_format( $post->ID ) === 'video' ) {
						  $content .= $ss_framework->open_col( 'span', array( 'medium' => $col ), null, 'post-format' ) . '<i class="fa fa-film"></i> <a href="' . esc_url( get_post_format_link( 'video' ) ) . '">' . __('Video','shoestrap') . '</a>' . $ss_framework->close_col( 'span' );
						} elseif ( get_post_format( $post->ID ) === 'audio' ) {
						  $content .= $ss_framework->open_col( 'span', array( 'medium' => $col ), null, 'post-format' ) . '<i class="fa fa-volume-up"></i> <a href="' . esc_url( get_post_format_link( 'audio' ) ) . '">' . __('Audio','shoestrap') . '</a>' . $ss_framework->close_col( 'span' );
						} elseif ( get_post_format( $post->ID ) === 'chat' ) {
						  $content .= $ss_framework->open_col( 'span', array( 'medium' => $col ), null, 'post-format' ) . '<i class="fa fa-comments-o"></i> <a href="' . esc_url( get_post_format_link( 'chat' ) ) . '">' . __('Chat','shoestrap') . '</a>' . $ss_framework->close_col( 'span' );
						}
					}

					// output date element
					if ( $meta == 'date' && ! empty( $value ) ) {
						if ( ! has_post_format( 'link' ) ) {
							$format_prefix = ( has_post_format( 'chat' ) || has_post_format( 'status' ) ) ? _x( '%1$s on %2$s', '1: post format name. 2: date', 'knowledgepress' ): '%2$s';

							if ( $date_format == 0 ) {
								$text = esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) );
								$icon = "fa fa-calendar";
							}
							elseif ( $date_format == 1 ) {
								$text = sprintf( human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago');
								$icon = "fa fa-time";
							}

							$content .= sprintf( $ss_framework->open_col( 'span', array( 'medium' => $col ), null, 'date' ) . '<i class="' . $icon . '"></i> <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>' . $ss_framework->close_col( 'span' ),
								esc_url( get_permalink() ),
								esc_attr( sprintf( __( 'Permalink to %s', 'knowledgepress' ), the_title_attribute( 'echo=0' ) ) ),
								esc_attr( get_the_date( 'c' ) ),
								$text
							);
						}
					}

					// output category element
					if ( $meta == 'category' && ! empty( $value ) ) {
						if ( $categories_list ) {
							$content .= $ss_framework->open_col( 'span', array( 'medium' => $col ), null, 'categories-links' ) . '<i class="fa fa-folder-open"></i> ' . $categories_list . $ss_framework->close_col( 'span' );
						}
					}

					// output tag element
					if ( $meta == 'tags' && ! empty( $value ) ) {
						if ( $tag_list ) {
							$content .= $ss_framework->open_col( 'span', array( 'medium' => $col ), null, 'tags-links' ) . '<i class="fa fa-tags"></i> ' . $tag_list . $ss_framework->close_col( 'span' );
						}
					}

					// output author element
					if ( $meta == 'author' && ! empty( $value ) ) {
						$content .= sprintf( $ss_framework->open_col( 'span', array( 'medium' => $col ), null, 'author vcard' ) . '<i class="fa fa-user"></i> <a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a>' . $ss_framework->close_col( 'span' ),
							esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
							esc_attr( sprintf( __( 'View all posts by %s', 'knowledgepress' ), get_the_author() ) ),
							get_the_author()
						);
					}

					// output comment count element
					if ( $meta == 'comment-count' && ! empty( $value ) ) {
						if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
							$content .= $ss_framework->open_col( 'span', array( 'medium' => $col ), null, 'comments-link' ) . '<i class="fa fa-comment"></i> <a href="' . get_comments_link( $post->ID ) . '">' . get_comments_number( $post->ID ) . ' ' . __( 'Comments', 'knowledgepress' ) . '</a>' . $ss_framework->close_col( 'span' );
						}
					}

					// Output author meta but do not display it if user has selected not to show it.
					if ( $meta == 'author' && empty( $value ) ) {
						$content .= sprintf( $ss_framework->open_col( 'span', array( 'medium' => $col ), null, 'author vcard' ) . '<a class="url fn n" href="%1$s" title="%2$s" rel="author" style="display:none;">%3$s</a>' . $ss_framework->close_col( 'span' ),
							esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
							esc_attr( sprintf( __( 'View all posts by %s', 'knowledgepress' ), get_the_author() ) ),
							get_the_author()
						);
					}
				}
			}

			if ( ! empty( $content ) ) {
				echo $ss_framework->open_row( 'div', null, 'row-meta' ) . $content . $ss_framework->close_row( 'div' );
			}
		}

		/**
		 * The "more" text
		 */
		function excerpt_more( $more ) {
			global $ss_settings;

			$continue_text = $ss_settings['post_excerpt_link_text'];
			return ' &hellip; <a href="' . get_permalink() . '">' . $continue_text . '</a>';
		}

		/**
		 * Excerpt length
		 */
		function excerpt_length($length) {
			global $ss_settings;

			$excerpt_length = $ss_settings['post_excerpt_length'];
			return $excerpt_length;
		}

		/*
		 * Display featured images on individual posts
		 */
		function featured_image() {
			global $ss_framework, $ss_settings;

			$data = array();

			if ( ! has_post_thumbnail() || '' == get_the_post_thumbnail() ) {
				return;
			}

			$data['width']  = Shoestrap_Layout::content_width_px();

			if ( is_singular() ) {
				// Do not process if we don't want images on single posts
				if ( $ss_settings['feat_img_post'] != 1 ) {
					return;
				}

				$data['url'] = wp_get_attachment_url( get_post_thumbnail_id() );
				$data['abs_url'] = get_attached_file( get_post_thumbnail_id() );
				if ( $ss_settings['feat_img_post_custom_toggle'] == 1 ) {
					$data['width']  = $ss_settings['feat_img_post_width'];
				}
				$data['height'] = $ss_settings['feat_img_post_height'];

			} else {
				// Do not process if we don't want images on post archives
				if ( $ss_settings['feat_img_archive'] == 0 ) {
					return;
				}

				$data['url'] = wp_get_attachment_url( get_post_thumbnail_id() );
				$data['abs_url'] = get_attached_file( get_post_thumbnail_id() );
				if ( $ss_settings['feat_img_archive_custom_toggle'] == 1 ) {
					$data['width']  = $ss_settings['feat_img_archive_width'];
				}

				$data['height'] = $ss_settings['feat_img_archive_height'];

			}
			
			$image = Shoestrap_Image::image_resize( $data );

			echo $ss_framework->clearfix() . '<a href="' . get_permalink() . '"><img class="featured-image ' . $ss_framework->float_class('left') . '" src="' . $image['url'] . '" /></a>';
		}


/*-----------------------------------------------------------------------------------*/
/* Post Media */
/*-----------------------------------------------------------------------------------*/

function pa_post_media() {

	global $post, $ss_settings;

	if ( is_singular() ) {
		// Do not process if we don't want media on single posts
		if ( $ss_settings['feat_img_post'] != 1 ) {
			return;
		}
	} else {
		// Do not process if we don't want media on single posts
		if ( $ss_settings['feat_img_archive'] != 1 ) {
			return;
		}
	}

	if (has_post_format('video')) {
		$video = get_post_meta( $post->ID, '_video', true );

		if ($video) {echo '<div class="clearfix"></div><div class="featured-media"><div class="fitvids">' . $video . '</div></div>';}  
	}
	    	
	if (has_post_format('gallery')) { ?>
		<div class="clearfix"></div>
	    <div class="featured-media">
	      <?php get_template_part('templates/gallery-slider'); ?>
	    </div>
<?php } 
}





	}
}

<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; }
    else { $$value['id'] = get_settings( $value['id'] ); }
    }
?>
<?php get_header() ?>

	<div id="container">
		<div id="content">

<?php the_post() ?>

<?php if ( is_day() ) : ?>
			<h1 class="page-title"><?php printf(__('Daily Archives: <span>%s</span>', 'thematic'), get_the_time(get_option('date_format'))) ?></h1>
<?php elseif ( is_month() ) : ?>
			<h1 class="page-title"><?php printf(__('Monthly Archives: <span>%s</span>', 'thematic'), get_the_time('F Y')) ?></h1>
<?php elseif ( is_year() ) : ?>
			<h1 class="page-title"><?php printf(__('Yearly Archives: <span>%s</span>', 'thematic'), get_the_time('Y')) ?></h1>
<?php elseif ( isset($_GET['paged']) && !empty($_GET['paged']) ) : ?>
			<h1 class="page-title"><?php _e('Blog Archives', 'thematic') ?></h1>
<?php endif; ?>

<?php rewind_posts() ?>

			<div id="nav-above" class="navigation">
                <?php if(function_exists('wp_pagenavi')) { ?>
                <?php wp_pagenavi(); ?>
                <?php } else { ?>  
				<div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&laquo;</span> Older posts', 'thematic')) ?></div>
				<div class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&raquo;</span>', 'thematic')) ?></div>
				<?php } ?>
			</div>

<?php while ( have_posts() ) : the_post(); ?>

			<div id="post-<?php the_ID() ?>" class="<?php sandbox_post_class() ?>">
				<h2 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php printf(__('Permalink to %s', 'thematic'), wp_specialchars(get_the_title(), 1)) ?>" rel="bookmark"><?php the_title() ?></a></h2>
				<div class="entry-date"><abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO'); ?>"><?php unset($previousday); printf(__('%1$s &#8211; %2$s', 'thematic'), the_date('', '', '', false), get_the_time()) ?></abbr></div>
				<div class="entry-content">
<?php the_excerpt(''.__('Read More <span class="meta-nav">&raquo;</span>', 'thematic').'') ?>

				</div>
				<div class="entry-meta">
<?php /* if default setting of no author link */ if($thm_authorlink == 'false') { ?>
					<span class="author vcard"><?php $author = get_the_author(); ?><?php _e('By ') ?><span class="fn n"><?php _e("$author") ?></span></span>
<?php /* else show a link to the author page */ } else { ?>	
                    <span class="author vcard"><?php printf(__('By %s', 'thematic'), '<a class="url fn n" href="'.get_author_link(false, $authordata->ID, $authordata->user_nicename).'" title="' . sprintf(__('View all posts by %s', 'thematic'), $authordata->display_name) . '">'.get_the_author().'</a>') ?></span>
<?php } ?>				    
					<span class="meta-sep">|</span>
<?php edit_post_link(__('Edit', 'thematic'), "\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t<span class=\"meta-sep\">|</span>\n"); ?>
					<span class="comments-link"><?php comments_popup_link(__('Leave a comment', 'thematic'), __('1 Comment', 'thematic'), __('% Comments', 'thematic')) ?></span>
				</div>
			</div><!-- .post -->

<?php endwhile ?>

			<div id="nav-below" class="navigation">
                <?php if(function_exists('wp_pagenavi')) { ?>
                <?php wp_pagenavi(); ?>
                <?php } else { ?>  
				<div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&laquo;</span> Older posts', 'thematic')) ?></div>
				<div class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&raquo;</span>', 'thematic')) ?></div>
				<?php } ?>
			</div>

		</div><!-- #content .hfeed -->
	</div><!-- #container -->

<?php get_sidebar() ?>
<?php get_footer() ?>
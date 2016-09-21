<?php
/***************************
 * Template Name: Startsida
 * Created by:
 *                  User:    Fredrik Beckius
 *                  Company: Posifon AB
 *                  URL:     http://fredrikbeckius.se, http://posifon.se
 *                  Date:    2015-07-31
 *
 ***************************/
get_header(); ?>
  <main>
    <section class="background-image" style="background-image: url(<?php header_image(); ?>);">
        <!--[if lt IE 9]>
        </section>
        <section class="ie">
          <img src="<?php header_image(); ?>" alt="Front page image" />
        <![endif]-->
        <div id="arrow">
          <a class="smooth-scroll" href="#intro-posifon"></a>
        </div>
        <div class="text-overlay">
          <div class="first-page-col">
            <h1 class="special"><?php echo get_field('tagline'); ?></h1>
          </div>
          <div class="divider"></div>
          <div class="first-page-col">
            <h3 class="posifon-blue"><?php echo get_field('news'); ?></h3>
            <?php query_posts("post_per_page=1"); the_post(); ?>
              <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
              <?php the_excerpt(); ?>
            <?php wp_reset_query(); ?>
          </div>
        </div>
    </section>
    <div class="wrap960">
      <section id="intro-posifon" class="blank">
        <div class="center">
          <?php 
            // Retrieving and displaying the name and description for the static content taxonomy  
            $term = get_term_by( 'slug', 'intro', 'content_taxonomy' );
          ?>
            <h1><?php echo $term->name; ?></h1>
            <p>
              <?php echo $term->description; ?>
            </p>
        </div>
        <?php
          // initiaing a counter to keep the posts ordered in columns, the counter will let us insert a new row for every two posts.
          $counter = 1; 
          $loop = new WP_Query( array( 'content_taxonomy' => 'intro' ) );
          $post_count = $loop->post_count;
          if ($loop->have_posts()) : while ( $loop->have_posts() ) : $loop->the_post();
          // Start of loop 
          if (($counter % 2) != 0) : echo '<div class="row">'; endif; ?>
          <div class="col">
            <div class="card" id="post-<?php the_ID(); ?>">
              <?php if ($background = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large', false, '' )) : ?>
                <div class="card-image" style="background-image: url('<?php echo $background[0]; ?>')"></div>
                <?php ; endif; ?>
                  <h3 id="<?php echo sanitize_title_with_dashes($the_title = get_the_title()); ?>"><?php echo $the_title; ?></h3>
                  <?php the_content(); ?>
            </div>
          </div>
          <?php 
            if (($counter % 2) == 0) : echo '</div>'; endif;
            $counter++; endwhile; endif; 
          wp_reset_query(); 
          // end of loop
        ?>
      </section>
      <!-- End "intro-posifon" -->

      <section id="nytta-alla" class="blank">
        <div class="center">
          <?php 
            // Retrieving and displaying the name and description for the static content taxonomy  
            $term = get_term_by( 'slug', 'uses', 'content_taxonomy' );
          ?>
            <h1><?php echo $term->name; ?></h1>
            <p>
              <?php echo $term->description; ?>
            </p>
        </div>
        <?php
          // initiaing a counter to keep the posts ordered in columns, the counter will let us insert a new row for every two posts.
          $counter = 1; 
          $loop = new WP_Query( array( 'content_taxonomy' => 'uses' ) ); 
          $post_count = $loop->post_count;
          if ($loop->have_posts()) : while ( $loop->have_posts() ) : $loop->the_post();
          // Start of loop 
          if ($counter == 1 || (($counter - 1) % ceil($post_count / 2)) == 0) : echo '<div class="col">'; endif; ?>
          <div class="expander-container card card-hover" id="post-<?php the_ID(); ?>">
            <?php if ($background = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large', false, '' )) : ?>
            <div class="card-image cover" style="background-image: url('<?php echo $background[0]; ?>')"></div>
            <?php ; endif; ?>
            <div class="expander-title">
              <h3 id="<?php echo sanitize_title_with_dashes($the_title = get_the_title()); ?>"><?php echo $the_title; ?></h3>
            </div>
            <div class="expander-content">
              <?php the_content(); ?>
            </div>
          </div>
          <?php if ($counter == $post_count || (($counter % ceil($post_count / 2)) == 0)) : echo '</div>'; endif;
          $counter++; endwhile; endif; 
          wp_reset_query(); 
          // end of loop 
        ?>
      </section>
      <!-- End "nytta-alla" -->

      <section id="products" class="blank">
        <div class="center">
          <?php 
            // Retrieving and displaying the name and description for the static content taxonomy  
            $term = get_term_by( 'slug', 'products', 'content_taxonomy' );
          ?>
            <h1><?php echo $term->name; ?></h1>
            <p><?php echo $term->description; ?></p>
        </div>
        <div class="product-details-line">
          <div id="tabs" class="tab-box">
            <ul class="tab-nav">
              <?php
              $i = 1;
              $loop = new WP_Query( array( 'content_taxonomy' => 'products' ) );
              if ($loop->have_posts()) : while ( $loop->have_posts() ) : $loop->the_post();
              // Start of loop ?>
              <li><a class="button" href="#<?php echo sanitize_title_with_dashes($the_title = get_the_title()); ?>" id=""><?php echo $the_title ?></a></li>
              <li><a class="button" style="display: none;" href="#accessories-<?php echo sanitize_title_with_dashes($the_title); ?>" id="">Tillbehör</a></li>
              <?php $i = $i + 1; endwhile; endif;
              // end of loop
              ?>
            </ul>
            <?php rewind_posts();
            $i = 1;
            while ( $loop->have_posts() ) : $loop->the_post(); 
            // Start new loop ?>
            <div class="post tab-content card" id="<?php echo sanitize_title_with_dashes($the_title = get_the_title()); ?>">
              <div class="product-gallery-container">
                <?php if (has_post_thumbnail()) : ?>
                <div class="product-image">
                  <a rel="fancybox[group]" href="<?php $thumb_id = get_post_thumbnail_id(); $thumb_url = wp_get_attachment_image_src($thumb_id,'large', true); echo $thumb_url[0]; ?>" class="popup" title=""><i class="icon-view"></i><span class="overlay"></span><?php the_post_thumbnail('medium'); ?></a>
                </div>
                <?php ; endif; ?>
                <div class="product-gallery">
                  <?php if ( function_exists( 'easy_image_gallery' ) ) {
                    echo easy_image_gallery();
                  } ?>
                </div>
              </div>
              <div class="product-info-container">              
                <p style="float: right;"><a href="" data="#accessories-<?php echo sanitize_title_with_dashes($the_title); ?>" class="button accessories-toggle" id=""><?php esc_html_e('Visa tillbehör', 'accessories-link'); ?></a></p>
                <h3><?php the_title(); ?></h3> 
                <?php the_content(); ?>                
              </div>
            </div>
            <?php $i = $i + 1; endwhile; wp_reset_postdata(); 
            // end of loop
            ?>
            <?php $loop = new WP_Query( array( 'content_taxonomy' => 'accessories' ) );
            if ($loop->have_posts()) : while ( $loop->have_posts() ) : $loop->the_post(); 
            // Start new loop ?>
            <div class="post tab-content card" id="accessories-<?php echo sanitize_title_with_dashes($the_title = get_the_title()); ?>">
              <p style="float: right;"><a href="" data="#<?php echo sanitize_title_with_dashes(get_the_title()); ?>" class="button accessories-toggle" id=""><?php esc_html_e('Visa beskrivning', 'description-link'); ?></a></p>
              <h3><?php esc_html_e('Tillbehör', 'accessories'); echo " " . $the_title; ?></h3>  
              <p><?php the_content(); ?></p>
            </div>
            <?php $i = $i + 1; endwhile; endif; wp_reset_postdata(); 
            // end of loop
            ?>
          </div>
        </div>
      </section>
      <!-- End "products" -->
  </main>
  <?php get_footer(); ?>

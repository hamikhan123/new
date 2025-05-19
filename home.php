<?php get_header(); ?>

<section class="blog-archive section-spacing">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h1 class="display-4 fw-bold mb-3">Latest Insights</h1>
            <p class="lead text-muted">Discover our latest articles, tutorials, and industry perspectives</p>
        </div>

        <div class="row g-4">
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => 6,
                'paged' => $paged,
                'orderby' => 'date',
                'order' => 'DESC'
            );
            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    $categories = get_the_category();
                    $category_name = !empty($categories) ? esc_html($categories[0]->name) : '';
            ?>
            <div class="col-lg-4 col-md-6">
                <article class="blog-card card h-100 border-0 shadow-sm overflow-hidden transition-all hover-shadow">
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <div class="featured-image ratio ratio-16x9">
                                <?php the_post_thumbnail('large', ['class' => 'img-fluid object-fit-cover']); ?>
                            </div>
                        </a>
                    <?php endif; ?>
                    
                    <div class="card-body p-4">
                        <?php if ($category_name) : ?>
                            <span class="badge bg-primary mb-2"><?php echo $category_name; ?></span>
                        <?php endif; ?>
                        
                        <h3 class="h5 card-title mb-3">
                            <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark hover-primary"><?php the_title(); ?></a>
                        </h3>
                        
                        <div class="card-text text-muted mb-3">
                            <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <time datetime="<?php echo get_the_date('c'); ?>" class="small text-muted">
                                <?php echo get_the_date('M j, Y'); ?>
                            </time>
                            <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline-primary stretched-link">
                                Read More <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </article>
            </div>
            <?php
                endwhile;
            else :
                echo '<div class="col-12 text-center py-5">';
                echo '<h3 class="text-muted">No articles found</h3>';
                echo '<p class="lead">Check back later for new content</p>';
                echo '</div>';
            endif;
            wp_reset_postdata();
            ?>
        </div>

        <!-- Pagination -->
        <div class="mt-5">
            <?php
            the_posts_pagination(array(
                'mid_size' => 2,
                'prev_text' => __('<i class="bi bi-chevron-left"></i> Previous', 'textdomain'),
                'next_text' => __('Next <i class="bi bi-chevron-right"></i>', 'textdomain'),
                'screen_reader_text' => __('Posts navigation', 'textdomain')
            ));
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
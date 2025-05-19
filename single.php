<?php get_header(); ?>

<main class="single-post-container py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                
                <article id="post-<?php the_ID(); ?>" <?php post_class('article-content'); ?>>
                    
                    <!-- Post Header -->
                    <header class="entry-header mb-5 text-center">
                        <?php 
                        $categories = get_the_category();
                        if (!empty($categories)) : ?>
                            <div class="category-badge mb-3">
                                <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>" class="badge bg-primary text-white text-decoration-none">
                                    <?php echo esc_html($categories[0]->name); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <h1 class="entry-title display-4 fw-bold mb-3"><?php the_title(); ?></h1>
                        
                        <div class="entry-meta text-muted mb-4">
                            <span class="posted-on me-3">
                                <i class="bi bi-calendar me-1"></i>
                                <time datetime="<?php echo get_the_date('c'); ?>">
                                    <?php echo get_the_date('F j, Y'); ?>
                                </time>
                            </span>
                            <span class="byline me-3">
                                <i class="bi bi-person me-1"></i>
                                <?php the_author_posts_link(); ?>
                            </span>
                        </div>
                        
                        <?php if (has_post_thumbnail()) : ?>
                            <figure class="featured-image mb-4">
                                <?php the_post_thumbnail('full', ['class' => 'img-fluid rounded shadow']); ?>
                                <?php if (get_the_post_thumbnail_caption()) : ?>
                                    <figcaption class="mt-2 text-muted small">
                                        <?php the_post_thumbnail_caption(); ?>
                                    </figcaption>
                                <?php endif; ?>
                            </figure>
                        <?php endif; ?>
                    </header>
                    
                    <!-- Post Content -->
                    <div class="entry-content">
                        <?php the_content(); ?>
                        
                        <?php
                        wp_link_pages(array(
                            'before' => '<div class="page-links mt-4"><span class="page-links-title">' . __('Pages:', 'textdomain') . '</span>',
                            'after' => '</div>',
                            'link_before' => '<span>',
                            'link_after' => '</span>',
                        ));
                        ?>
                    </div>
                    
                    <!-- Post Footer -->
                    <footer class="entry-footer mt-5 pt-4 border-top">
                        <!-- Tags -->
                        <?php if (has_tag()) : ?>
                            <div class="post-tags mb-4">
                                <h6 class="d-inline-block me-2">Tags:</h6>
                                <?php the_tags('', ' ', ''); ?>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Author Box -->
                        <div class="author-box card mb-4">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <?php echo get_avatar(get_the_author_meta('ID'), 80, '', '', ['class' => 'rounded-circle']); ?>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-1"><?php the_author(); ?></h5>
                                        <p class="text-muted small mb-2"><?php the_author_meta('description'); ?></p>
                                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="btn btn-sm btn-outline-primary">
                                            View all posts
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Post Navigation -->
                        <div class="post-navigation d-flex justify-content-between mb-5">
                            <div class="previous-post">
                                <?php previous_post_link('%link', '<i class="bi bi-chevron-left me-1"></i> Previous Post'); ?>
                            </div>
                            <div class="next-post">
                                <?php next_post_link('%link', 'Next Post <i class="bi bi-chevron-right ms-1"></i>'); ?>
                            </div>
                        </div>
                    </footer>
                    
                </article>
                
                <?php endwhile; else : ?>
                    <div class="no-content text-center py-5">
                        <h3 class="text-muted">No content found</h3>
                        <p class="lead">The article you're looking for doesn't exist or has been removed.</p>
                        <a href="<?php echo home_url(); ?>" class="btn btn-primary mt-3">Return to Homepage</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
<?php get_header(); ?>

<section class="projects-archive py-5 bg-light">
    <div class="container">
        <!-- Page Header -->
        <div class="section-header text-center mb-5">
            <h1 class="display-4 fw-bold mb-3">Our Portfolio</h1>
            <p class="lead text-muted">Explore our latest work and case studies</p>
        </div>

        <!-- Filter Form -->
        <div class="project-filters mb-5">
            <form method="get" class="bg-white p-4 rounded-3 shadow-sm">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="start_date" class="form-label fw-medium">From Date</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                            <input type="date" name="start_date" id="start_date" class="form-control" 
                                   value="<?php echo isset($_GET['start_date']) ? esc_attr($_GET['start_date']) : ''; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="end_date" class="form-label fw-medium">To Date</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                            <input type="date" name="end_date" id="end_date" class="form-control" 
                                   value="<?php echo isset($_GET['end_date']) ? esc_attr($_GET['end_date']) : ''; ?>">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-funnel me-1"></i> Filter
                        </button>
                    </div>
                    <div class="col-md-2">
                        <a href="<?php echo get_post_type_archive_link('projects'); ?>" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <?php
        // Filter Logic
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'post_type' => 'projects',
            'posts_per_page' => 9,
            'paged' => $paged,
            'orderby' => 'meta_value',
            'meta_key' => 'project_start_date',
            'order' => 'DESC'
        );

        if (isset($_GET['start_date']) && $_GET['start_date'] != '') {
            $args['meta_query'][] = array(
                'key' => 'project_start_date',
                'value' => sanitize_text_field($_GET['start_date']),
                'compare' => '>=',
                'type' => 'DATE'
            );
        }

        if (isset($_GET['end_date']) && $_GET['end_date'] != '') {
            $args['meta_query'][] = array(
                'key' => 'project_end_date',
                'value' => sanitize_text_field($_GET['end_date']),
                'compare' => '<=',
                'type' => 'DATE'
            );
        }

        $projects_query = new WP_Query($args);

        if ($projects_query->have_posts()) : ?>
            <div class="row g-4">
                <?php while ($projects_query->have_posts()) : $projects_query->the_post(); 
                    $start_date = get_field('project_start_date');
                    $end_date = get_field('project_end_date');
                    $categories = get_the_terms(get_the_ID(), 'project_category');
                ?>
                <div class="col-lg-4 col-md-6">
                    <article class="project-card card h-100 border-0 shadow-sm overflow-hidden transition-all hover-shadow-lg">
                        <div class="project-thumbnail ratio ratio-16x9">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('large', ['class' => 'img-fluid object-fit-cover']); ?>
                                <?php else : ?>
                                    <div class="bg-light d-flex align-items-center justify-content-center">
                                        <i class="bi bi-image text-muted" style="font-size: 2rem;"></i>
                                    </div>
                                <?php endif; ?>
                            </a>
                        </div>
                        
                        <div class="card-body p-4">
                            <?php if ($categories && !is_wp_error($categories)) : ?>
                                <div class="mb-2">
                                    <?php foreach ($categories as $category) : ?>
                                        <span class="badge bg-primary-light text-primary me-1 mb-1">
                                            <?php echo esc_html($category->name); ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            
                            <h2 class="h4 card-title mb-3">
                                <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark stretched-link">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            
                           
                            
                            <div class="card-text text-muted mb-3">
                                <?php echo wp_trim_words(get_the_excerpt(), 18); ?>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <span class="text-primary fw-medium">View Project →</span>
                            </div>
                        </div>
                    </article>
                </div>
                <?php endwhile; ?>
            </div>

            <!-- Pagination -->
            <div class="mt-5">
                <?php
                echo paginate_links(array(
                    'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                    'format' => '?paged=%#%',
                    'current' => max(1, get_query_var('paged')),
                    'total' => $projects_query->max_num_pages,
                    'prev_text' => '<i class="bi bi-chevron-left"></i>',
                    'next_text' => '<i class="bi bi-chevron-right"></i>',
                    'type' => 'list',
                    'add_args' => array(
                        'start_date' => isset($_GET['start_date']) ? $_GET['start_date'] : '',
                        'end_date' => isset($_GET['end_date']) ? $_GET['end_date'] : ''
                    )
                ));
                ?>
            </div>
        <?php else : ?>
            <div class="text-center py-5 bg-white rounded-3 shadow-sm">
                <i class="bi bi-folder-x text-muted" style="font-size: 3rem;"></i>
                <h3 class="text-muted mt-3">No projects found</h3>
                <p class="lead">Try adjusting your filters or check back later</p>
                <a href="<?php echo get_post_type_archive_link('projects'); ?>" class="btn btn-primary mt-3">
                    View All Projects
                </a>
            </div>
        <?php endif; 
        wp_reset_postdata(); ?>
    </div>
</section>

<?php get_footer(); ?>
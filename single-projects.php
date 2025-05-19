<?php get_header(); ?>

<main class="single-project-container py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                
                <article class="single-project bg-white p-4 p-md-5 rounded-3 shadow-sm">
                   
                   
                    
                    <!-- Project Header -->
                    <header class="project-header mb-5">
                        <?php if (has_post_thumbnail()) : ?>
                            <figure class="project-thumbnail mb-4 rounded-3 overflow-hidden">
                                <?php the_post_thumbnail('large', ['class' => 'img-fluid w-100']); ?>
                            </figure>
                        <?php endif; ?>
                        
                        <h1 class="project-title display-4 fw-bold mb-4">
                            <?php the_field('project_name') ? esc_html(get_field('project_name')) : the_title(); ?>
                        </h1>
                    </header>
                    
                    <!-- Project Details Card -->
                    <div class="project-details-card card border-0 shadow-sm mb-5">
                        <div class="card-body p-4">
                            <h2 class="h4 card-title mb-4 pb-2 border-bottom">
                                <i class="bi bi-info-circle text-primary me-2"></i>Project Details
                            </h2>
                            
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex border-0 px-0 py-3">
                                    <span class="flex-shrink-0 fw-medium me-3" style="width: 120px;">Project Name:</span>
                                    <span><?php the_field('project_name'); ?></span>
                                </li>
                                <li class="list-group-item d-flex border-0 px-0 py-3">
                                    <span class="flex-shrink-0 fw-medium me-3" style="width: 120px;">Description:</span>
                                    <span><?php the_field('project_description'); ?></span>
                                </li>
                                <li class="list-group-item d-flex border-0 px-0 py-3">
                                    <span class="flex-shrink-0 fw-medium me-3" style="width: 120px;">Start Date:</span>
                                    <span>
                                        <?php the_field('project_start_date'); ?>
                                    </span>
                                </li>
                                <li class="list-group-item d-flex border-0 px-0 py-3">
                                    <span class="flex-shrink-0 fw-medium me-3" style="width: 120px;">End Date:</span>
                                    <span>
                                        <?php the_field('project_end_date'); ?>
                                    </span>
                                </li>
                                <li class="list-group-item d-flex border-0 px-0 py-3">
                                    <span class="flex-shrink-0 fw-medium me-3" style="width: 120px;">Project URL:</span>
                                    <span>
                                        <?php if (get_field('project_url')) : ?>
                                            <a href="<?php echo esc_url(get_field('project_url')); ?>" target="_blank" rel="noopener noreferrer" class="text-decoration-none">
                                                <?php echo esc_url(get_field('project_url')); ?>
                                            </a>
                                        <?php else : ?>
                                            N/A
                                        <?php endif; ?>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                   
                    
                    <!-- Project Footer -->
                    <footer class="project-footer mt-5 pt-4 border-top">
                        <div class="d-flex justify-content-between">
                            <a href="<?php echo esc_url(site_url('/projects/')); ?>" class="btn btn-outline-primary">
                                <i class="bi bi-arrow-left me-1"></i> Back to Projects
                            </a>
                            
                            <?php
                            $next_post = get_next_post();
                            if ($next_post) : ?>
                                <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" class="btn btn-primary">
                                    Next Project <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </footer>
                </article>
                
                <?php endwhile; else : ?>
                    <div class="no-project text-center py-5 bg-white rounded-3 shadow-sm">
                        <i class="bi bi-folder-x text-muted" style="font-size: 3rem;"></i>
                        <h3 class="text-muted mt-3">Project Not Found</h3>
                        <p class="lead">The project you're looking for doesn't exist or has been removed.</p>
                        <a href="<?php echo esc_url(site_url('/projects/')); ?>" class="btn btn-primary mt-3">
                            Browse All Projects
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
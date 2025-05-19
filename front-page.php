<?php
/**
 * Front Page Template - Hero and About Us Sections
 */
get_header();

// Query the Hero post
$hero_query = new WP_Query(array(
    'post_type' => 'hero',
    'posts_per_page' => 1,
    'post_status' => 'publish'
));

if ($hero_query->have_posts()) : 
    while ($hero_query->have_posts()) : $hero_query->the_post();
        // Safely get ACF fields with fallbacks
        $bg_image_url = function_exists('get_field') ? get_field('bg_image') : '';
        $hero_title = function_exists('get_field') ? get_field('hero-title') : 'Welcome to Our Website';
        $hero_subtitle = function_exists('get_field') ? get_field('hero-subtitle') : 'Your default subtitle here';
        ?>
        
        <!-- Hero Section -->
        <section class="mytheme-hero" <?php if ($bg_image_url) echo 'style="background-image: url('.esc_url($bg_image_url).')"'; ?>>
            <div class="mytheme-hero-overlay"></div>
            <div class="mytheme-hero-content">
                <h1><?php echo esc_html($hero_title); ?></h1>
                <?php if ($hero_subtitle) : ?>
                    <p><?php echo esc_html($hero_subtitle); ?></p>
                <?php endif; ?>
                
                <!-- Show admin notice if ACF is missing -->
                <?php if (!function_exists('get_field') && current_user_can('activate_plugins')) : ?>
                    <div class="mytheme-hero-notice" style="background: #ffebee; color: #c62828; padding: 15px; margin-top: 20px; border-radius: 4px;">
                        <strong>Admin Notice:</strong> Advanced Custom Fields PRO plugin is required for full functionality.
                    </div>
                <?php endif; ?>
            </div>
        </section>

    <?php endwhile;
    wp_reset_postdata();
else : ?>
    <div class="mytheme-hero-notice">
        No Hero post found. Please create one in WP Admin.
    </div>
<?php endif; ?>

<!-- About Us Section -->
<section class="mytheme-about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mytheme-about-content animate-left">
                <h2 class="mytheme-section-title">About Our Company</h2>
                <h3 class="mytheme-section-subtitle">Delivering Excellence Since 2010</h3>
                <p class="mytheme-section-text">
                    We are a passionate team dedicated to providing innovative solutions for our clients. 
                    With over a decade of experience in the industry, we've helped hundreds of businesses 
                    achieve their goals through our tailored services and cutting-edge technology.
                </p>
                <a href="#" class="mytheme-btn">Learn More</a>
            </div>
            <div class="col-lg-6 mytheme-about-image animate-right">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/about-us.jpg" alt="Our Team" class="img-fluid rounded">
            </div>
        </div>
    </div>
</section>

<!-- Add this after your About Us section -->
<section class="services-v2">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-tag">OUR EXPERTISE</span>
            <h2 class="section-title">Digital Services That Deliver</h2>
            <p class="section-subtitle">Custom solutions tailored to your business goals</p>
        </div>

        <div class="services-grid">
            <!-- Web Development -->
            <div class="service-item dev">
                <div class="service-content">
                  
                    <h3><br>Web Development</h3>
                    <p>Robust applications built</p>
                    <ul>
                        <li>React/Next.js SPAs</li>
                        <li>Node.js Backends</li>
                        <li>Headless CMS</li>
                    </ul>
                    <a href="#web-dev" class="service-cta">View Projects </a>
                </div>
                <div class="service-bg"></div>
            </div>

            <!-- Web Design -->
            <div class="service-item design">
                <div class="service-content">
                    
                    <h3>Web Design</h3>
                    <p>Interfaces that engage and convert</p>
                    <ul>
                        <li>Figma Prototyping</li>
                        <li>UI/UX Strategy</li>
                        <li>Design Systems</li>
                    </ul>
                    <a href="#web-design" class="service-cta">See Portfolio </a>
                </div>
                <div class="service-bg"></div>
            </div>

            <!-- SEO -->
            <div class="service-item seo">
                <div class="service-content">
                 
                    <h3>SEO Optimization</h3>
                    <p>Climb search rankings organically</p>
                    <ul>
                        <li>Technical Audits</li>
                        <li>Keyword Strategy</li>
                        <li>Content Planning</li>
                    </ul>
                    <a href="#seo" class="service-cta">Get Audit </a>
                </div>
                <div class="service-bg"></div>
            </div>

        
    </div>
</section>
<!-- CTA Section -->
<section class="mytheme-cta">
    <div class="cta-container">
        <div class="cta-content">
            <h2 class="cta-title">Ready to Transform Your Digital Presence?</h2>
            <p class="cta-text">Let's discuss how we can help achieve your goals. Get started with a free consultation.</p>
            <div class="cta-buttons">
                <a href="#contact" class="cta-btn cta-primary">Get Free Quote</a>
                <a href="tel:+1234567890" class="cta-btn cta-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20"><path d="M20 15.5c-1.2 0-2.5-.2-3.6-.6h-.3c-.3 0-.5.1-.7.3l-2.2 2.2c-2.8-1.5-5.2-3.8-6.6-6.6l2.2-2.2c.3-.3.4-.7.2-1.1-.3-1.1-.5-2.4-.5-3.6 0-.5-.5-1-1-1H4c-.5 0-1 .5-1 1 0 9.4 7.6 17 17 17 .5 0 1-.5 1-1v-3.5c0-.5-.5-1-1-1z"/></svg>
                    Call Now
                </a>
            </div>
        </div>
    </div>
</section>
<!-- Latest Blogs -->
<section class="mytheme-blogs">
    <div class="container">
        <h2 class="section-title">Latest Insights</h2>
        <p class="section-subtitle">Discover industry trends and expert tips</p>
        
        <div class="blog-grid">
            <?php
            $blog_query = new WP_Query(array(
                'post_type' => 'post',
                'posts_per_page' => 3,
                'post_status' => 'publish'
            ));
            
            if ($blog_query->have_posts()) : 
                while ($blog_query->have_posts()) : $blog_query->the_post();
            ?>
                <article class="blog-card">
                    <a href="<?php the_permalink(); ?>" class="blog-image-link">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="blog-image" style="background-image: url('<?php the_post_thumbnail_url('medium_large'); ?>')"></div>
                        <?php else : ?>
                            <div class="blog-image" style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/blog-default.jpg')"></div>
                        <?php endif; ?>
                    </a>
                    <div class="blog-content">
                        <span class="blog-date"><?php echo get_the_date('F j, Y'); ?></span>
                        <h3 class="blog-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p class="blog-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                        <a href="<?php the_permalink(); ?>" class="blog-read-more">Read More →</a>
                    </div>
                </article>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>No blog posts found.</p>';
            endif;
            ?>
        </div>
        
        <div class="text-center">
            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="view-all-btn">View All Articles</a>
        </div>
    </div>
</section>
<?php get_footer(); ?>
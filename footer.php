</main>

<!-- Footer -->
<footer class="mytheme-footer">
    <div class="footer-main">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo">
                        <?php bloginfo('name'); ?>
                    </a>
                    <p class="footer-about">Delivering innovative digital solutions since 2010.</p>
                    <div class="social-links">
                        <a href="#" aria-label="Facebook"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2C6.5 2 2 6.5 2 12c0 5 3.7 9.1 8.4 9.9v-7H7.9V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.5h-1.3c-1.2 0-1.6.8-1.6 1.6V12h2.8l-.4 2.9h-2.3v7C18.3 21.1 22 17 22 12c0-5.5-4.5-10-10-10z"/></svg></a>
                        <a href="#" aria-label="Twitter"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22.5 5.5c-.9.4-1.8.7-2.8.8 1-.6 1.8-1.6 2.2-2.7-1 .6-2 1-3.1 1.2-.9-1-2.2-1.6-3.6-1.6-2.7 0-4.9 2.2-4.9 4.9 0 .4 0 .8.1 1.1-4.1-.2-7.8-2.2-10.2-5.2-.4.7-.7 1.6-.7 2.5 0 1.7.9 3.2 2.2 4.1-.8 0-1.6-.2-2.2-.6v.1c0 2.4 1.7 4.4 3.9 4.8-.4.1-.8.2-1.3.2-.3 0-.6 0-.9-.1.6 2 2.4 3.4 4.6 3.4-1.7 1.3-3.8 2.1-6.1 2.1-.4 0-.8 0-1.2-.1 2.2 1.4 4.8 2.2 7.5 2.2 9.1 0 14-7.5 14-14v-.6c1-.7 1.8-1.6 2.5-2.5z"/></svg></a>
                        <a href="#" aria-label="LinkedIn"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.3 3.3 0 0 0-3.3-3.3 3.2 3.2 0 0 0-2.8 1.6v-1.4h-3.2v9h3.3v-4.8a1.8 1.8 0 0 1 1.8-1.8 1.8 1.8 0 0 1 1.8 1.8v4.8h3.3M6.9 8.4a1.9 1.9 0 0 0 1.9-1.9 1.9 1.9 0 1 0-1.9 1.9m1.4 10.1v-9H5.5v9h2.8z"/></svg></a>
                    </div>
                </div>
                
                <div class="footer-col">
                    <h3 class="footer-title">Services</h3>
                    <ul class="footer-menu">
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">Web Design</a></li>
                        <li><a href="#">SEO Optimization</a></li>
                        <li><a href="#">Graphic Design</a></li>
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h3 class="footer-title">Company</h3>
                    <ul class="footer-menu">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Case Studies</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h3 class="footer-title">Contact</h3>
                    <address class="footer-contact">
                        <p>123 Business Ave, Suite 100<br>City, ST 12345</p>
                        <p><a href="mailto:hello@yourcompany.com">hello@yourcompany.com</a></p>
                        <p><a href="tel:+1234567890">(123) 456-7890</a></p>
                    </address>
                </div>
            </div>
        </div>
    </div>
    
    <div class="footer-bottom">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
            <div class="footer-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
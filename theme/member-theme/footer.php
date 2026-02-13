<footer class="site-footer">
    <div class="footer-container">

        <!-- Footer Logo / Branding -->
        <div class="footer-logo">
            <a href="<?php echo site_url(); ?>">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png" alt="Member Platform">
            </a>
        </div>

        <!-- Footer Navigation -->
        <nav class="footer-nav">
            <ul>
                <li><a href="<?php echo site_url(); ?>">Home</a></li>
                <li><a href="<?php echo site_url('/members/'); ?>">Members</a></li>
                <li><a href="<?php echo site_url('/about/'); ?>">About</a></li>
                <li><a href="<?php echo site_url('/contact/'); ?>">Contact</a></li>
            </ul>
        </nav>

        <!-- Social Links -->
        <div class="footer-social">
            <a href="#" target="_blank">Twitter</a>
            <a href="#" target="_blank">LinkedIn</a>
            <a href="#" target="_blank">GitHub</a>
        </div>

        <!-- Copyright -->
        <div class="footer-copy">
            &copy; <?php echo date('Y'); ?> Member Platform. All Rights Reserved.
        </div>

    </div>

    <?php wp_footer(); ?>
</footer>
</body>
</html>

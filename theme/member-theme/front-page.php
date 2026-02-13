<?php
/* Template Name: Front Page Template */
get_header();
?>

<div class="home-container">

    <!-- HERO SECTION -->
    <section class="hero">
        <h1>Member Platform</h1>
        <p class="subtitle">
            A Custom WordPress Directory System Built with PHP, JavaScript & AJAX
        </p>
        <a href="<?php echo site_url('/members/'); ?>" class="btn-primary">
            View Members Directory
        </a>
    </section>


    <!-- FEATURES SECTION -->
    <section class="features">
        <h2>Key Features</h2>
        <ul>
            <li>Custom WordPress Plugin Architecture</li>
            <li>Member Profiles with Featured Images</li>
            <li>AJAX Live Search</li>
            <li>Role / Team Filtering</li>
            <li>Clean URL Structure</li>
            <li>Secure & Sanitized Data Handling</li>
            <li>Custom Theme Templates</li>
        </ul>
    </section>


    <!-- TECHNOLOGY STACK -->
    <section class="tech">
        <h2>Technologies Used</h2>
        <ul>
            <li>WordPress (Custom Development)</li>
            <li>PHP</li>
            <li>JavaScript (AJAX)</li>
            <li>jQuery</li>
            <li>HTML5 & CSS3</li>
            <li>MySQL</li>
            <li>Git Version Control</li>
        </ul>
    </section>


    <!-- HOW IT WORKS -->
    <section class="how-it-works">
        <h2>How It Works</h2>
        <ol>
            <li>Admin adds members from WordPress dashboard</li>
            <li>Member data stored as custom meta fields</li>
            <li>Members displayed on archive page</li>
            <li>AJAX handles live search and filtering</li>
            <li>Individual profile pages show full details</li>
        </ol>
    </section>


    <!-- ABOUT PROJECT -->
    <section class="about">
        <h2>About This Project</h2>
        <p>
            This is a real-world WordPress directory system created to demonstrate
            professional plugin and theme development skills. The architecture
            follows WordPress best practices and is built for scalability.
        </p>
    </section>


    <!-- CTA -->
    <section class="cta">
        <h2>Explore the Platform</h2>
        <a href="<?php echo site_url('/members/'); ?>" class="btn-secondary">
            Browse Members
        </a>
    </section>

</div>

<?php get_footer(); ?>

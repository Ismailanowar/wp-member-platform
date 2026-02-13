<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="container">

        <!-- Logo -->
        <div class="logo">
            <a href="<?php echo site_url(); ?>">Member Platform</a>
        </div>

        <!-- Mobile Menu Toggle -->
        <div class="mobile-menu-toggle">&#9776;</div>

        <!-- Navigation -->
        <nav class="nav-menu">
            <ul>
                <li><a href="<?php echo site_url(); ?>">Home</a></li>
                <li><a href="<?php echo site_url('/members/'); ?>">Members</a></li>
		<li><a href="<?php echo site_url('/about/'); ?>">About</a></li>
                <li><a href="<?php echo site_url('/contact/'); ?>">Contact</a></li>
            </ul>
        </nav>

    </div>

    <!-- Overlay for mobile menu -->
    <div class="menu-overlay"></div>
</header>

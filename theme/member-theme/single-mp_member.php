<?php get_header(); ?>

<main class="member-profile">

<?php while (have_posts()) : the_post(); ?>

<?php
    $email = get_post_meta(get_the_ID(), '_mp_email', true);
    $phone = get_post_meta(get_the_ID(), '_mp_phone', true);
    $role  = get_post_meta(get_the_ID(), '_mp_role', true);
?>

<article class="member-single-card">

    <!-- ✅ PHOTO AT TOP -->
    <div class="member-single-thumb">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('medium'); ?>
        <?php else : ?>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/avatar.png" alt="Avatar">
        <?php endif; ?>
    </div>

    <!-- ✅ NAME -->
    <h1 class="member-name"><?php the_title(); ?></h1>

    <!-- ✅ ROLE -->
    <?php if ($role): 
        $role_class = 'role-' . sanitize_title($role);
    ?>
        <p class="member-role <?php echo esc_attr($role_class); ?>">
            <?php echo esc_html($role); ?>
        </p>
    <?php endif; ?>

    <!-- ✅ BIO (TEXT ONLY) -->
    <div class="member-content">
        <?php
        echo wpautop(
            wp_strip_all_tags(
                get_post_field('post_content', get_the_ID())
            )
        );
        ?>
    </div>

    <!-- ✅ DETAILS -->
    <div class="member-details">
        <?php if ($email): ?>
            <p><strong>Email:</strong> <?php echo esc_html($email); ?></p>
        <?php endif; ?>

        <?php if ($phone): ?>
            <p><strong>Phone:</strong> <?php echo esc_html($phone); ?></p>
        <?php endif; ?>
    </div>

</article>

<?php endwhile; ?>

</main>

<?php get_footer(); ?>

<?php get_header(); ?>
<?php
$member_count = wp_count_posts('mp_member');
$published_members = isset($member_count->publish) ? $member_count->publish : 0;
?>

<div class="member-count">
    <h2>👥 Total Members: <?php echo esc_html($published_members); ?></h2>
</div>


<main class="member-archive">

    <h1>Our Members</h1>

    <!-- Filter & Search -->
    <?php
    $roles = get_posts([
        'post_type' => 'mp_member',
        'posts_per_page' => -1
    ]);

    $unique_roles = [];
    foreach ($roles as $role_post) {
        $role_value = get_post_meta($role_post->ID, '_mp_role', true);
        if ($role_value) $unique_roles[$role_value] = $role_value;
    }
    ?>
    <select id="member-role-filter" style="width:100%; padding:10px; margin-bottom:10px;">
        <option value="">All Roles</option>
        <?php foreach ($unique_roles as $role) : ?>
            <option value="<?php echo esc_attr($role); ?>"><?php echo esc_html($role); ?></option>
        <?php endforeach; ?>
    </select>

    <input type="text" id="member-search" placeholder="Search members..." style="width:100%; padding:10px; margin-bottom:20px;">
    <div id="member-results"></div>

    <!-- Static fallback grid for non-AJAX users -->
    <div class="member-grid">
        <?php if (have_posts()) : while (have_posts()) : the_post(); 
            $email = get_post_meta(get_the_ID(), '_mp_email', true);
            $phone = get_post_meta(get_the_ID(), '_mp_phone', true);
            $role  = get_post_meta(get_the_ID(), '_mp_role', true);
        ?>
            <div class="member-card">
                <?php if (has_post_thumbnail()): ?>
                    <div class="member-thumb">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium'); ?>
                        </a>
                    </div>
                <?php endif; ?>

                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                <?php if ($role): ?>
                    <p class="member-role"><?php echo esc_html($role); ?></p>
                <?php endif; ?>

                <?php if ($email): ?><p><strong>Email:</strong> <?php echo esc_html($email); ?></p><?php endif; ?>
                <?php if ($phone): ?><p><strong>Phone:</strong> <?php echo esc_html($phone); ?></p><?php endif; ?>
            </div>
        <?php endwhile; else : ?>
            <p>No members found.</p>
        <?php endif; ?>
    </div>

</main>

<?php get_footer(); ?>

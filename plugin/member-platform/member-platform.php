<?php
/**
 * Plugin Name: Member Platform
 * Description: Custom Member Platform with AJAX search and Role/Team filter
 * Version: 1.0.0
 * Author: Md Ismail Hossain
 */

if (!defined('ABSPATH')) exit;

class Member_Platform {

    public function __construct() {
        // CPT
        add_action('init', [$this, 'register_member_cpt']);

        // Meta boxes
        add_action('add_meta_boxes', [$this, 'add_member_meta_box']);
        add_action('save_post', [$this, 'save_member_meta']);

        // AJAX
        add_action('wp_ajax_mp_member_search', [$this, 'ajax_member_search']);
        add_action('wp_ajax_nopriv_mp_member_search', [$this, 'ajax_member_search']);
    }

    // ----------------------------
    // Register Custom Post Type
    // ----------------------------
    public function register_member_cpt() {

        register_post_type('mp_member', [
            'label' => 'Members',
            'public' => true,
            'menu_icon' => 'dashicons-groups',
            'supports' => ['title', 'editor', 'thumbnail'],
            'show_in_rest' => true,
            'has_archive' => true, // ✅ Required for /members/
            'rewrite' => ['slug' => 'members']
        ]);
    }

    // ----------------------------
    // Add Meta Box
    // ----------------------------
    public function add_member_meta_box() {
        add_meta_box(
            'mp_member_details',
            'Member Details',
            [$this, 'member_meta_box_html'],
            'mp_member'
        );
    }

    // ----------------------------
    // Meta Box HTML
    // ----------------------------
    public function member_meta_box_html($post) {

        wp_nonce_field('mp_member_nonce', 'mp_member_nonce');

        $email = get_post_meta($post->ID, '_mp_email', true);
        $phone = get_post_meta($post->ID, '_mp_phone', true);
        $role  = get_post_meta($post->ID, '_mp_role', true);
        ?>

        <p>
            <label>Email</label><br>
            <input type="email" name="mp_email" value="<?php echo esc_attr($email); ?>" style="width:100%">
        </p>

        <p>
            <label>Phone</label><br>
            <input type="text" name="mp_phone" value="<?php echo esc_attr($phone); ?>" style="width:100%">
        </p>

        <p>
            <label>Role / Team</label><br>
            <input type="text" name="mp_role" value="<?php echo esc_attr($role); ?>" style="width:100%">
        </p>

        <?php
    }

    // ----------------------------
    // Save Meta Data
    // ----------------------------
    public function save_member_meta($post_id) {

        if (!isset($_POST['mp_member_nonce']) ||
            !wp_verify_nonce($_POST['mp_member_nonce'], 'mp_member_nonce')) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (!current_user_can('edit_post', $post_id)) return;

        if (isset($_POST['mp_email'])) {
            update_post_meta($post_id, '_mp_email', sanitize_email($_POST['mp_email']));
        }

        if (isset($_POST['mp_phone'])) {
            update_post_meta($post_id, '_mp_phone', sanitize_text_field($_POST['mp_phone']));
        }

        if (isset($_POST['mp_role'])) {
            update_post_meta($post_id, '_mp_role', sanitize_text_field($_POST['mp_role']));
        }
    }

    // ----------------------------
    // AJAX Member Search + Role Filter
    // ----------------------------
    public function ajax_member_search() {

        check_ajax_referer('mp_ajax_nonce', 'nonce');

        $keyword = isset($_POST['keyword']) ? sanitize_text_field($_POST['keyword']) : '';
        $role    = isset($_POST['role']) ? sanitize_text_field($_POST['role']) : '';

        $args = [
            'post_type'      => 'mp_member',
            's'              => $keyword,
            'posts_per_page' => -1,
        ];

        // Filter by role if selected
        if ($role) {
            $args['meta_query'] = [
                [
                    'key'     => '_mp_role',
                    'value'   => $role,
                    'compare' => '='
                ]
            ];
        }

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                echo '<div class="member-card">';

// ✅ FEATURED IMAGE
if (has_post_thumbnail()) {
    echo '<div class="member-thumb">';
    echo '<a href="' . get_permalink() . '">';
    echo get_the_post_thumbnail(get_the_ID(), 'medium');
    echo '</a>';
    echo '</div>';
}

echo '<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';

$role  = get_post_meta(get_the_ID(), '_mp_role', true);
$email = get_post_meta(get_the_ID(), '_mp_email', true);
$phone = get_post_meta(get_the_ID(), '_mp_phone', true);

if ($role) {
    echo '<p class="member-role">' . esc_html($role) . '</p>';
}

if ($email) {
    echo '<p><strong>Email:</strong> ' . esc_html($email) . '</p>';
}

if ($phone) {
    echo '<p><strong>Phone:</strong> ' . esc_html($phone) . '</p>';
}

echo '</div>';


                $email = get_post_meta(get_the_ID(), '_mp_email', true);
                $phone = get_post_meta(get_the_ID(), '_mp_phone', true);
                $role_value = get_post_meta(get_the_ID(), '_mp_role', true);

                if ($role_value) echo '<p><strong>Role:</strong> ' . esc_html($role_value) . '</p>';
                if ($email) echo '<p><strong>Email:</strong> ' . esc_html($email) . '</p>';
                if ($phone) echo '<p><strong>Phone:</strong> ' . esc_html($phone) . '</p>';

                echo '</div>';
            }
        } else {
            echo '<p>No members found.</p>';
        }

        wp_die();
    }
}

// Add dashboard widget
add_action('wp_dashboard_setup', 'mp_add_dashboard_widget');

function mp_add_dashboard_widget() {
    wp_add_dashboard_widget(
        'mp_member_stats',
        '📊 Member Platform Stats',
        'mp_dashboard_widget_content'
    );
}

function mp_dashboard_widget_content() {
    $count = wp_count_posts('mp_member');
    $total = isset($count->publish) ? $count->publish : 0;
    ?>
    <div class="mp-dashboard-stats">
        <p><strong>👥 Total Members:</strong> <?php echo esc_html($total); ?></p>
    </div>
    <?php
}


// ----------------------------
// Initialize Plugin
// ----------------------------
new Member_Platform();

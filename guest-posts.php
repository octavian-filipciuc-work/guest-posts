<?php

/*
  Plugin Name: Surrey Hills Personal Plugin
  Description: Personal Surrey Hills Reality TV Show Users Submit Plugin.
  Version: 1.0
  Author: Filipciuc Octavian
  Author URI: http://dev.delta.md
 */

function jn_admin_body_class($classes) {
    global $wpdb, $post;
    $post_type = get_post_type($post->ID);
    if (is_admin()) {
        $classes .= 'post_type-' . $post_type;
    }
    return $classes;
}

if (is_admin()) {

    function example_dashboard_widget_function() {
        $posts = get_posts(
                array(
                    'numberposts' => 10,
                    'post_status' => 'pending-forms',
                    'post_type' => 'post'
                )
        );
        foreach ($posts as $post) {
            echo "<div id='post_pending' ><a href='" . get_site_url() . "/wp-admin/post.php?post=" . $post->ID . "&action=edit'>" . get_the_title($post->ID) . "</a></div>";
        }
        echo"<a id='view_all_pending' href='" . get_site_url() . "/wp-admin/edit.php?post_status=pending&post_type=post'>View all forms</a>";
    }

// Create the function use in the action hook
    function example_add_dashboard_widgets() {
        wp_add_dashboard_widget('example_dashboard_widget', 'Latest Pending forms', 'example_dashboard_widget_function');
    }
// Hoook into the 'wp_dashboard_setup' action to register our other functions
    add_action('wp_dashboard_setup', 'example_add_dashboard_widgets');

    function disable_default_dashboard_widgets() {
        remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
        remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
        remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
        remove_meta_box('dashboard_plugins', 'dashboard', 'core');
        remove_meta_box('dashboard_right_now', 'dashboard', 'core');
        remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
        remove_meta_box('dashboard_primary', 'dashboard', 'core');
        remove_meta_box('dashboard_secondary', 'dashboard', 'core');
    }

    add_action('admin_menu', 'disable_default_dashboard_widgets');

    add_filter('admin_body_class', 'jn_admin_body_class');
    wp_enqueue_style('bootscrap', get_site_url() . '/wp-content/plugins/guest-posts/plugin_css.css');

    /* Prints the box content */
    add_filter('manage_posts_columns', 'edit_posts_columns', 10, 2);
    add_action('manage_posts_custom_column', 'manage_posts_columns', 10, 2);

    function edit_posts_columns($posts_columns, $post_type) {
        if ($post_type == 'post') {
// Delete an existing column
            unset($posts_columns['comments']);
            unset($posts_columns['author']);
            unset($posts_columns['tags']);
            unset($posts_columns['categories']);

// Add a new column
            $posts_columns['title'] = _x('Full Name', 'column name');
            $posts_columns['user_age'] = _x('User Age', 'column name');
            $posts_columns['user_email'] = _x('User Email', 'column name');
            $posts_columns['user_image'] = _x('User Image', 'column name');
        }
        return $posts_columns;
    }

    function manage_posts_columns($column_name, $id) {
        switch ($column_name) {
            case 'user_image':
                $args = array(
                    'post_type' => 'attachment',
                    'numberposts' => 1,
                    'post_mime_type' => 'image',
                    'post_status' => null,
                    'post_parent' => $id
                );
                $attachments = get_posts($args);
                if ($attachments) {
                    foreach ($attachments as $attachment) {
                        echo '<div class="user_atached_image">';
                        the_attachment_link($attachment->ID, false, false, true);
                        echo '</div>';
                    }
                }else
                    echo '<p style="float: left; color: #d33c3c; font-size: 15px;">No images</p>';
                break;
            case 'user_age':
                $age = get_post_meta($id, 'age', true);
                if (!empty($age)) {
                    echo $age;
                } else {
                    _e('Age field is empty');
                }
                break;
            case 'user_email':
                $mail = get_post_meta($id, 'email_adress', true);
                if (!empty($mail)) {
                    echo '<a href="mailto:' . $mail . '">';
                    echo $mail;
                    echo '</a>';
                } else {
                    _e('Email field is empty');
                }
                break;

            default:
                break;
        }
    }

}
add_action('admin_footer', 'best_func');

function best_func() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready( function($) {
            //            $('.post_type-post #preview-action').remove();
            $('.post_type-post .inline-edit-status option[value="publish"]').remove();
            //            $('.post_type-post #visibility.misc-pub-section').remove();
            $('.post_type-post a.edit-post-status').text('Change status');
            $('.post_type-post #submitdiv h3.hndle span').text('Form Status');
        });
    </script>
    <?php

}

// Don't disable on dev
if (!defined('WP_DEBUG') || !WP_DEBUG) {

// Disable core update checking
    add_filter('pre_site_transient_update_core', create_function('$a', "return null;"));
    remove_action('admin_init', '_maybe_update_core');
    remove_action('wp_version_check', 'wp_version_check');

// Remove the updates menu item
    function yell_remove_update_menu() {
        remove_submenu_page('index.php', 'update-core.php');
    }

    add_filter('admin_menu', 'yell_remove_update_menu');

// Disable plugin update checking
    remove_action('load-plugins.php', 'wp_update_plugins');
    remove_action('load-update.php', 'wp_update_plugins');
    remove_action('load-update-core.php', 'wp_update_plugins');
    remove_action('admin_init', '_maybe_update_plugins');
    remove_action('wp_update_plugins', 'wp_update_plugins');
    add_filter('pre_site_transient_update_plugins', create_function('$a', "return null;"));

// Disable theme update checking
    remove_action('load-themes.php', 'wp_update_themes');
    remove_action('load-update.php', 'wp_update_themes');
    remove_action('load-update-core.php', 'wp_update_themes');
    remove_action('admin_init', '_maybe_update_themes');
    remove_action('wp_update_themes', 'wp_update_themes');
    add_filter('pre_site_transient_update_themes', create_function('$a', "return null;"));
}

add_theme_support('post-thumbnails', array('page'));

function my_custom_js() {
    $show_files .= '<script type="text/javascript" src="' . get_site_url() . '/wp-content/plugins/guest-posts/jsplugin.js"></script>';
    $show_files .= '<script type="text/javascript" src="' . get_site_url() . '/wp-content/plugins/guest-posts/modernizr.custom.61095.js"></script>';

    echo $show_files;
}

add_action('wp_head', 'my_custom_js');

add_action('add_meta_boxes', 'o99_add_attach_thumbs_meta_b');
add_action('add_meta_boxes', 'o99_add_attach_thumbs_meta_v');

function o99_add_attach_thumbs_meta_b() {
    add_meta_box('att_thumb_display', 'Attachmed images', 'o99_render_attach_meta_b', 'post');
}

function o99_add_attach_thumbs_meta_v() {
    add_meta_box('att_video_display', 'Attachmed video', 'o99_render_attach_meta_v', 'post');
}

function o99_render_attach_meta_v($post) {
    $output = '';
    $args = array(
        'post_type' => 'attachment',
        'post_mime_type' => 'video',
        'post_parent' => $post->ID
    );
    $images = get_posts($args);
    foreach ($images as $image) {
        $output .= '<a target="_blank" href="' . get_site_url() . '/wp-admin/post.php?post=' . $image->ID . '&action=edit"><img title="" style="width: 85px; margin: 10px; border: 1px solid #d33c3c; padding: 1px;" src="' . get_site_url() . '/wp-content/themes/SHTV/images/video_upload.png" /></a><a style="padding: 5px 10px; margin: 5px; background: rgb(255, 255, 255); border: 1px solid rgb(155, 151, 151); border-radius: 3px; box-shadow: 0px 0px 1px rgb(92, 88, 88); text-decoration: none; color: #d33c3c; font-weight: bold;" target="_blank" href="' . wp_get_attachment_url($image->ID) . '">View</a><a target="_blank" href="' . get_site_url() . '/wp-admin/post.php?post=' . $image->ID . '&action=edit" style="padding: 5px 10px; margin: 5px; background: rgb(255, 255, 255); border: 1px solid rgb(155, 151, 151); border-radius: 3px; box-shadow: 0px 0px 1px rgb(92, 88, 88); text-decoration: none; font-weight: bold;">Edit</a>';
    }
    echo $output;
}

function o99_render_attach_meta_b($post) {
    $output = '';
    $args = array(
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'post_parent' => $post->ID
    );
    $images = get_posts($args);
    foreach ($images as $image) {
        $output .= '<a target="_blank" href="' . get_site_url() . '/wp-admin/post.php?post=' . $image->ID . '&action=edit"><img width="100" height="100" title="Press for edit" style="margin: 10px; border: 1px solid #d33c3c; padding: 1px;" src="' . wp_get_attachment_thumb_url($image->ID) . '" /></a>';
    }
    echo $output;
}

function change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'User Forms';
    $submenu['edit.php'][5][0] = 'All User Forms';
    $submenu['edit.php'][10][0] = 'Add New User Form';
    echo '';
}

function change_post_object_label() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'User Forms';
    $labels->singular_name = 'User Form';
    $labels->add_new = 'Add New User Form';
    $labels->add_new_item = 'Add New User Form';
    $labels->edit_item = 'Edit User Forms';
    $labels->new_item = 'User Form';
    $labels->view_item = 'View User Form';
    $labels->search_items = 'Search User Forms';
    $labels->not_found = 'No User Forms found';
    $labels->not_found_in_trash = 'No User Forms found in Trash';
}

add_action('init', 'change_post_object_label');
add_action('admin_menu', 'change_post_menu_label');
add_action('admin_init', 'my_remove_menu_pages');

function my_remove_menu_pages() {
    remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category');
    remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
}

function return_ltl_txt() {
    global $post;
    if (get_post_meta($post->ID, 'little_text_above_questions', true)) :
        $ecotxt .= '<div class="widthfull"><div class="fixing_ltl_txt"><span class="question_ltl_txt">';
        $ecotxt .= get_post_meta($post->ID, 'little_text_above_questions', true);
        $ecotxt .= '</span></div></div>';
    endif;
    return $ecotxt;
}

function return_terms_txt() {
    global $post;
    if (get_post_meta($post->ID, 'little_text_under_submit', true)) :
        $ecotxtt .= '<div class="terms_ltl_txt">';
        $ecotxtt .= get_post_meta($post->ID, 'little_text_under_submit', true);
        $ecotxtt .= '</div>';
    endif;
    return $ecotxtt;
}

function return_field($feald) {
    global $post;
    if (get_post_meta($post->ID, $feald, true)) :
        $eco .= '<h2 class="question_title">';
        $eco .= get_post_meta($post->ID, $feald, true);
        $eco .= '</h2>';
    endif;
    return $eco;
}

add_action('add_meta_boxes', 'convert_pdf');

function convert_pdf() {
    global $post;
    $status_of_post = get_post_status($post->ID);
    if ($status_of_post == 'approved') {
        add_meta_box('pdf_convert', 'Convert form to pdf', 'posttopdf', 'post');
    }
}

function posttopdf() {
    global $post;
    $status_of_post = get_post_status($post->ID);
    if ($status_of_post == 'approved') {
        if (function_exists("wpptopdf_display_icon")) {
            echo wpptopdf_display_icon();
        }
        echo "<span class='get_pdf_txt'> &#8592; Press button to get form</span>";
    }
}

function guestposts_shortcode($atts) {
    extract(shortcode_atts(array(
                'cat' => '1',
                'author' => '1',
                'thanks' => get_bloginfo('home'),
                    ), $atts));

    return '<form class="guests-post" enctype="multipart/form-data" action="' . plugin_dir_url("guest-posts.php") . 'guest-posts/guest-posts-submit.php" method="post">
              <div class="first_part_form_quest"><div class="content_of_frst_prt"><input type="text" name="full_name" size="30" required="required" placeholder="' . __('Full Name', 'guest-posts') . '" />
            <input type="text" name="nick_name" size="30" required="required" placeholder="' . __('Nick name', 'guest-posts') . '" />
            ' . wp_nonce_field() . '
            <input type="url" name="facebook_link" size="30" required="required" placeholder="' . __('Facebook link', 'guest-posts') . '" />
            <input type="url" name="twitter_link" size="30" required="required" placeholder="' . __('Twitter link', 'guest-posts') . '" />
            <input type="text" name="contact_number" size="30" required="required" placeholder="' . __('Contact number', 'guest-posts') . '" />
            <input type="email" name="email" size="30" required="required" placeholder="' . __('Email address', 'guest-posts') . '" />
            <input class="min_width_input" type="text" name="age" required="required" placeholder="' . __('Age (18+ only)', 'guest-posts') . '" />
            <div class="min_width_input">
                <select name="gender" required="required">
                    <option selected="selected" disabled="disabled">Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <input type="text" name="relationship_status" size="30" required="required" placeholder="' . __('Relationship status', 'guest-posts') . '" />
            <input type="text" name="employment_status" size="30" required="required" placeholder="' . __('Employment status', 'guest-posts') . '" />
            <input type="text" name="current_town" size="30" required="required" placeholder="' . __('The town you currently live', 'guest-posts') . '" /></div></div>
    <div class="last_questions_part">' . return_ltl_txt() . '
        <div class="div_for_question_fix">
            <div class="question_title fixing_nb_list hidden" > </div>
            <span>' . return_field("question_one") . '</span>
            <textarea rows="5" cols="72" required="required" name="kind_of_property_you_live_in" placeholder=""></textarea>
            <span>' . return_field("question_two") . '</span>
            <textarea rows="5" cols="72" required="required" name="what_do_you_do_for_a_living" placeholder=""></textarea>
            <span>' . return_field("question_three") . '</span>
            <textarea class="min_wid_quest" rows="1" cols="72" required="required" name="do_you_drive" placeholder=""></textarea>
            <span>' . return_field("question_four") . '</span>
            <textarea rows="5" cols="72" required="required" name="where_do_you_tend_to_go_out" placeholder=""></textarea>
            <span>' . return_field("question_five") . '</span>
            <textarea rows="5" cols="72" required="required" name="if_our_camera_crew" placeholder=""></textarea>
            <span>' . return_field("question_six") . '</span>
            <textarea rows="5" cols="72" required="required" name="what_is_your_claime_to_fame" placeholder=""></textarea>
            <span>' . return_field("question_seven") . '</span>
            <textarea rows="5" cols="72" required="required" name="what_do_you_hope_to_achieve" placeholder=""></textarea>
            <span>' . return_field("question_eight") . '</span>
            <textarea rows="5" cols="72" required="required" name="how_would_your_friends_describe_you" placeholder=""></textarea>
            <span>' . return_field("question_nine") . '</span>
            <textarea rows="5" cols="72" required="required" name="friends_to_appear_with_you" placeholder=""></textarea>
            <span>' . return_field("add_video_and_photos_title") . '</span>
        </div>
    </div>
    <div class="upload_area"><div class="fixing_upload_area"><div class="photos_area_upload"><span class="upload_photos_text">Upload photographs:</span>
                <div class="each_photo"><div class="for_inputt">
                        <div id="file_input_container">
                            <input id="first_foto" name="first_photo" type="file" accept="image/*" onchange="readURL(this);" />
                        </div>
                        <p class="child_p"></p></div>
                    <div id="previewPane"><img id="img_prev" src="http://farm6.staticflickr.com/5445/8978337718_e3380f4a50_o.png" alt="your image" /><span id="x" class="remove_item sprite"></span><span id="very_big_img">Too big image !</span></div>
                </div><div class="each_photoo"><div class="for_inputtt">
                        <div id="file_input_containerr">
                            <input id="second_foto" name="second_photo" type="file" accept="image/*" onchange="readURLL(this);" />
                        </div>
                        <p class="child_pp"></p></div>
                    <div id="previewPanee"><img id="img_prevv" src="http://farm6.staticflickr.com/5445/8978337718_e3380f4a50_o.png" alt="your image" /><span id="xx" class="remove_item sprite"></span><span id="very_big_img">Too big image !</span></div>
                </div><div class="each_photooo"><div class="for_inputttt">
                        <div id="file_input_containerrr">
                            <input id="theird_foto" name="theird_photo" type="file" accept="image/*" onchange="readURLLL(this);" />
                        </div>
                        <p class="child_ppp"></p></div>
                    <div id="previewPaneee"><img id="img_prevvv" src="http://farm6.staticflickr.com/5445/8978337718_e3380f4a50_o.png" alt="your image" /><span id="xxx" class="remove_item sprite"></span><span id="very_big_img">Too big image !</span></div>
                </div></div><div class="video_upload_area"><span class="upload_photos_text">Upload video:</span><div class="for_inputtttt"><div id="file_input_containerrrr"><input id="video_pt" name="video" type="file" accept="video/*" onchange="readURLLLL(this);" /></div><p class="child_pppp"></p></div>
                <div id="previewPaneeee"><img id="img_prevvvv" src="' . get_template_directory_uri() . '/images/video_upload.png" alt="your video" /><span id="xxxx" class="remove_item sprite"></span><span id="very_big_img">Too big video !</span></div></div>
            <input type="hidden" value="' . $cat . '" name="category" />
            <input type="hidden" value="' . $author . '" name="authorid" />
            <input type="hidden" value="' . $thanks . '" name="thanks" />
            <input type="hidden" value="' . str_replace('/wp-content/themes', '', get_theme_root()) . '/wp-blog-header.php" name="rootpath" />
            <div id="submit_area"><input class="sprite" type="submit" value="" />' . return_terms_txt() . '</div>
        <div id="success_message">Your application has been sent succesfully.</div></div></div>
</form>';
}

add_shortcode('guest-posts', 'guestposts_shortcode');

add_action( 'transition_post_status', 'send_mails_on_pending', 10, 3 );

function send_mails_on_pending( $new_status, $old_status, $post )
{
    if ( 'pending-forms' !== $new_status or 'pending-forms' === $old_status )
        return;

    $admins = get_users( array ( 'role' => 'administrator' ) );
    $emails = array ();

    foreach ( $admins as $admin )
        $emails[] = $admin->user_email;

    $body = 'New form on SurreyHills is pendding for your approve: http://dev.delta.md/surreyhills/wp-admin/post.php?post='.$post->ID.'&action=edit';
    $name = get_the_title($post->ID);

    wp_mail( $emails, $name.' has sent a new form on SurreyHills', $body );
}
?>
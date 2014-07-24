<?php

//Get the submitted form
ob_start();
require_once($_POST["rootpath"]);
require_once(ABSPATH . "wp-admin" . '/includes/image.php');
require_once(ABSPATH . "wp-admin" . '/includes/file.php');
require_once(ABSPATH . "wp-admin" . '/includes/media.php');
$full_name = $_POST["full_name"];
$nick_name = $_POST["nick_name"];
$facebook_link = $_POST["facebook_link"];
$twitter_link = $_POST["twitter_link"];
$email = $_POST["email"];
$contact_number = $_POST["contact_number"];
$authorid = $_POST["authorid"];
$category = $_POST["category"];
//$thankyou = $_POST["thanks"];
$age = $_POST["age"];
$gender = $_POST["gender"];
$relationship_status = $_POST["relationship_status"];
$employment_status = $_POST["employment_status"];
$current_town = $_POST["current_town"];
$kind_of_property_you_live_in = $_POST["kind_of_property_you_live_in"];
$what_do_you_do_for_a_living = $_POST["what_do_you_do_for_a_living"];
$do_you_drive = $_POST["do_you_drive"];
$where_do_you_tend_to_go_out = $_POST["where_do_you_tend_to_go_out"];
$if_our_camera_crew = $_POST["if_our_camera_crew"];
$what_is_your_claime_to_fame = $_POST["what_is_your_claime_to_fame"];
$what_do_you_hope_to_achieve = $_POST["what_do_you_hope_to_achieve"];
$how_would_your_friends_describe_you = $_POST["how_would_your_friends_describe_you"];
$friends_to_appear_with_you = $_POST["friends_to_appear_with_you"];
$path = $_POST["rootpath"];
$nonce = $_POST["_wpnonce"];
$desc = "";
$url_first_img = $_POST["url_first_image"];
$url_second_img = $_POST["url_second_image"];
$url_theird_img = $_POST["url_theird_image"];

//Load WordPress
//require($path);
//Verify the form fields
if (!wp_verify_nonce($nonce))
    die('Security check');

//Post Properties
$new_post = array(
    'post_title' => $full_name,
    'post_category' => $category, // Usable for custom taxonomies too
    'post_status' => 'pending-forms', // Choose: publish, preview, future, draft, etc.
    'post_type' => 'post', //'post',page' or use a custom post type if you want to
    'post_author' => $authorid //Author ID
);
//save the new post
$pid = wp_insert_post($new_post);

/* Insert Form data into Custom Fields */
update_post_meta($pid, 'full_name', $full_name);
update_post_meta($pid, 'nick_name', $nick_name);
update_post_meta($pid, 'facebook_link', $facebook_link);
update_post_meta($pid, 'twitter_link', $twitter_link);
update_post_meta($pid, 'email_adress', $email);
update_post_meta($pid, 'contact_number', $contact_number);
update_post_meta($pid, 'age', $age);
update_post_meta($pid, 'gender', $gender);
update_post_meta($pid, 'relationship_status', $relationship_status);
update_post_meta($pid, 'employment_status', $employment_status);
update_post_meta($pid, 'current_town', $current_town);
update_post_meta($pid, 'kind_of_property_you_live_in', $kind_of_property_you_live_in);
update_post_meta($pid, 'what_do_you_do_for_a_living', $what_do_you_do_for_a_living);
update_post_meta($pid, 'do_you_drive', $do_you_drive);
update_post_meta($pid, 'where_do_you_tend_to_go_out', $where_do_you_tend_to_go_out);
update_post_meta($pid, 'if_our_camera_crew', $if_our_camera_crew);
update_post_meta($pid, 'what_is_your_claime_to_fame', $what_is_your_claime_to_fame);
update_post_meta($pid, 'what_do_you_hope_to_achieve', $what_do_you_hope_to_achieve);
update_post_meta($pid, 'how_would_your_friends_describe_you', $how_would_your_friends_describe_you);
update_post_meta($pid, 'friends_to_appear_with_you', $friends_to_appear_with_you);

media_sideload_image($url_first_img, $pid, $desc);
media_sideload_image($url_second_img, $pid, $desc);
media_sideload_image($url_theird_img, $pid, $desc);

function insert_attachment($file_handler, $pid, $setthumb = 'false') {

    // check to make sure its a successful upload
    if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK)
        __return_false();

    $attach_id = media_handle_upload($file_handler, $pid);

    if ($setthumb)
        update_post_meta($pid, '_thumbnail_id', $attach_id);
    return $attach_id;
}

// set $post_id to the id of the post you want to attach
// these uploads to (or 'null' to just handle the uploads
// without attaching to a post)

if ($_FILES) {
    foreach ($_FILES as $file => $array) {
        $newupload = insert_attachment($file, $pid);
        // $newupload returns the attachment id of the file that
        // was just uploaded. Do whatever you want with that now.
    }
}


header("Location: ".  get_site_url() . "?success#success_message");
?>
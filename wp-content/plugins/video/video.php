<?php
/*
Plugin Name: Video
Plugin URI: http://www.webonise.com
Description: Add embeded video code.
Version: 1.0
Author: Simanchala Kuamr Pradhan
Author URI: http://www.webonise.com
*/
register_activation_hook(__FILE__, 'video_create_table');
function video_create_table(){
    global $wpdb;
    $table_name = $wpdb->prefix . "videos";
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id int(11) NOT NULL AUTO_INCREMENT,
            url VARCHAR(1000) NOT NULL,
            position int(11) NOT NULL,
            image VARCHAR(1000) NOT NULL,
            UNIQUE KEY id (id)
            );";
        $wpdb->query($sql);
    }
}

add_action('admin_menu', 'video_menu');
function video_menu(){
    add_menu_page('Video', 'Video', 'list_users', 'video', 'video', '', '89');
}

function video(){
    global $wpdb;
    $table_name = $wpdb->prefix . "supporters";
    echo '<div class="mainDiv">';
    /*if (isset($_POST['submit'])) {
        $errorMessage = saveSupporterData();
        supporter_details($errorMessage);
    } elseif (isset($_POST['edit'])) {
        $errorMessage = updateSupportData();
        supporter_details($errorMessage);
    } elseif ($_GET['action'] == 'delete') {
        $wpdb->delete($table_name, array('ID' => $_GET['id']));
        supporter_details();
    } else {
        supporter_details();
    }*/
    video_details();
    echo "</div>";
}

function video_details($errorMessage=""){
    global $wpdb;
    $table_name = $wpdb->prefix . "videos";
    $sql_query = "SELECT * FROM $table_name ORDER BY position;";
    $videos = $wpdb->get_results($sql_query);
    echo "<h2>Videos</h2>";
    echo '<div class="leftDiv">';
    add_video(count($videos), $errorMessage);
    echo '</div>';
    echo '<div class="rightDiv">';
//    details($supporters, $type);
    video_list($videos);
    echo "</div>";
    echo '<div class="clearfix"></div>';
}

function add_video($pos, $errorMessage){
    global $wpdb;
    $table_name = $wpdb->prefix . "videos";
    echo "<div class='errorMsg'>".$errorMessage."</div>";?>
<?php
    if ($_GET['action'] != 'edit') { ?>
    <form action="" method="post" id="video" enctype="multipart/form-data" class="mediaSliderForm">
        <div class="control-group clearfix"><h2>Add Video</h2></div>
        <div class="control-group clearfix"><label>Embedded Url  : </label><input type="text" name="url" class="required"></div>
        <div class="control-group clearfix"><label>Position : </label><input type="text" name="position" class="required" maxlength="2" value="<?php echo $pos+1;?>"></div>
        <input type="submit" class="btn btn-small btn-inverse" name="submit" value="Submit">
    </form>
    <?php  } else{
        $sql_query = "SELECT * FROM $table_name WHERE id=" . $_GET['id'] . ";";
        $video = $wpdb->get_row($sql_query);
        ?>
    <a class="btn btn-small btn-inverse" href="admin.php?page=<?php echo $_GET['page'];?>&action=add">Add</a>
    <form action="" method="post" id="video" enctype="multipart/form-data" class="mediaSliderForm">
        <div class="control-group clearfix"><h2>Edit Video</h2></div>
        <div class="control-group clearfix"><label>Embedded Url : </label><input type="text" name="name" value="<?php echo $video->url; ?>"></div>
        <div class="control-group clearfix"><label>Position : </label><input type="text" name="position" maxlength="2" value="<?php echo $video->position; ?>"></div>
        <input type="hidden" name="id" value="<?php echo $video->id; ?>"><br>
        <input type="submit" name="edit" value="Update" class="btn btn-small btn-inverse">
    </form>


<?php }}
function video_list($videos){ ?>
<form action="" xmlns="http://www.w3.org/1999/html" method="post" id="supporter" enctype="multipart/form-data">
    <table class="table table-striped table-bordered table-condensed ">
        <caption><h3>Video List</h3></caption>
        <tr>
            <th >Embedded Url</th>
            <th >Position</th>
            <th >Action</th>
        </tr>
        <?php foreach ($videos as $video) { ?>
        <tr>
            <td ><?php echo $video->url; ?></td>
            <td ><?php echo $video->position; ?></td>
            <td class="action">
                <a class="btn btn-small btn-inverse" href="admin.php?page=video&id=<?php echo $video->id;?>&action=edit">Edit</a>
                <a class="btn btn-small btn-inverse" href="admin.php?page=video&id=<?php echo $video->id;?>&action=delete">Delete</a>
            </td>
        </tr>
        <?php
    }
        ?>
    </table>
</form>
<?php }
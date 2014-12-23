<?php
/*
Plugin Name: Supporters
Plugin URI: http://www.webonise.com
Description: Add Founder, Partners, Corporate Sponsors.
Version: 1.0
Author: Simanchala Kuamr Pradhan
Author URI: http://www.webonise.com
*/
register_activation_hook(__FILE__, 'supporter_create_table');
function supporter_create_table(){
    global $wpdb;
    $table_name = $wpdb->prefix . "supporters";
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id int(11) NOT NULL AUTO_INCREMENT,
            type VARCHAR(255) NOT NULL,
            name VARCHAR(255) NOT NULL,
            position int(11) NOT NULL,
            image VARCHAR(500) NOT NULL,
            UNIQUE KEY id (id)
            );";
        $wpdb->query($sql);
    }
    if ($wpdb->get_var("SHOW COLUMNS FROM $table_name LIKE 'link'") != 'link') {

        $sql = "ALTER TABLE $table_name ADD link VARCHAR(500) NOT NULL;";
        $wpdb->query($sql);
    }

}
add_action('admin_menu', 'supporter_menu');
function supporter_menu(){
    add_menu_page('Founder', 'Supporter', 'list_users', 'supporter', 'founder', '', '85');
    add_submenu_page('supporter','Partner', 'Partner', 'list_users', 'partner', 'founder');
    add_submenu_page('supporter','Corporate Sponsors', 'Corporate Sponsors', 'list_users', 'corporate_sponsor', 'founder');
}
function founder(){
    global $wpdb;
    $table_name = $wpdb->prefix . "supporters";
    echo '<div class="mainDiv">';
    if (isset($_POST['submit'])) {
        $errorMessage = saveSupporterData();
        supporter_details($errorMessage);
    } elseif (isset($_POST['edit'])) {
        $errorMessage = updateSupportData();
        supporter_details($errorMessage);
    } elseif ($_GET['action'] == 'delete') {
        $supporter_image = $wpdb->get_row("select image from $table_name where id='".$_GET['id']."';");
        $wpdb->delete($table_name, array('ID' => $_GET['id']));
        $file_name =  $file_path = ABSPATH . "wp-content/uploads/".$supporter_image->image;
        unlink($file_name);
        supporter_details();
    } else {
        supporter_details();
    }
    echo "</div>";
}


function supporter_details($errorMessage=""){
    global $wpdb;
    $table_name = $wpdb->prefix . "supporters";
    $type = $_GET['page'];
    $sql_query = "SELECT * FROM $table_name WHERE type='".$type."' ORDER BY position;";
    $supporters = $wpdb->get_results($sql_query);
    echo "<h2>Supporter</h2>";
    echo '<div class="leftDiv">';
    add_form(count($supporters), $errorMessage);
    echo '</div>';
    echo '<div class="rightDiv">';
    details($supporters, $type);
    echo "</div>";
    echo '<div class="clearfix"></div>';
}
function add_form($pos, $errorMessage){
    global $wpdb;
    $table_name = $wpdb->prefix . "supporters";
    echo "<div class='errorMsg'>".$errorMessage."</div>";?>
<?php
    if ($_GET['action'] != 'edit') { ?>
    <form action="" method="post" id="supporter" enctype="multipart/form-data" class="mediaSliderForm">
        <div class="control-group clearfix"><h2>Add <?php if( $_GET["page"] != "corporate_sponsor"){echo $_GET["page"] != "supporter" ? "Partner" : "Founder";}else{ echo "Corporate Sponsor";} ?></h2></div>
        <div class="control-group clearfix"><label>Name : </label><input type="text" name="name" class="required"></div>
        <div class="control-group clearfix"><label>Link : </label><input type="text" name="link" class="required" value=""></div>
        <div class="control-group clearfix"><label>Position : </label><input type="text" name="position" class="required" maxlength="2" value="<?php echo $pos+1;?>"></div>
        <div class="control-group clearfix"><label>Image*</label> <input type="file" name="image" id="image" class="required" onchange="readURL(this);"></div>
        <div class="control-group clearfix"><label>&nbsp;</label><div id="image_view" class="advImg"></div></div>
        <input type="hidden" name="type" value="<?php echo $_GET['page']; ?>"><br>
        <input type="submit" class="btn btn-small btn-inverse" name="submit" value="Submit">
    </form>
    <?php  } else{
        $sql_query = "SELECT * FROM $table_name WHERE id=" . $_GET['id'] . ";";
        $supporter = $wpdb->get_row($sql_query);
        ?>
        <a class="btn btn-small btn-inverse" href="admin.php?page=<?php echo $_GET['page'];?>&action=add">Add</a>
        <form action="" method="post" id="supporter" enctype="multipart/form-data" class="mediaSliderForm">
            <div class="control-group clearfix"><h2>Edit <?php if( $_GET["page"] != "corporate_sponsor"){echo $_GET["page"] != "supporter" ? "Partner" : "Founder";}else{ echo "Corporate Sponsor";} ?></h2></div>
            <div class="control-group clearfix"><label>Name : </label><input type="text" name="name" value="<?php echo $supporter->name; ?>"></div>
            <div class="control-group clearfix"><label>Link : </label><input type="text" name="link" value="<?php echo $supporter->link != "javascript:void(0)" ? $supporter->link : ""; ?>"></div>
            <div class="control-group clearfix"><label>Position : </label><input type="text" name="position" maxlength="2" value="<?php echo $supporter->position; ?>"></div>
            <div class="control-group clearfix"><label>Image: </label><input type="file" name="image" onchange="readURL(this);"></div>
            <div class="control-group clearfix"><label>&nbsp;</label><div class="advImg" id="image_view1"><img src="/wp-content/uploads/<?php echo $supporter->image;?>" ></div></div>
            <div class="control-group clearfix"><label>&nbsp;</label><div class="advImg" id="image_view"></div></div>
            <input type="hidden" name="id" value="<?php echo $supporter->id; ?>"><br>
            <input type="hidden" name="image" value="<?php echo $supporter->image; ?>"><br>
            <input type="submit" name="edit" value="Update" class="btn btn-small btn-inverse">
        </form>

        <?php    }?>
<script type="text/javascript">
    function readURL(input) {
        jQuery("#image_view1").hide();
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                jQuery("#image_view").html("<img id='image_view' src='"+ e.target.result+"' alt='your image' /></br>");
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<?php }
function details($supporters, $type){ ?>
<form action="" xmlns="http://www.w3.org/1999/html" method="post" id="supporter" enctype="multipart/form-data">
    <table class="table table-striped table-bordered table-condensed ">
        <caption><h3><?php if( $_GET["page"] != "corporate_sponsor"){echo $type != "supporter" ? "Partner" : "Founder";}else{ echo "Corporate Sponsor";} ?> List</h3></caption>
        <tr>
            <th style="width: 20%;">Name</th>
            <th style="width: 15%;">Image</th>
            <th style="width: 30%;">link</th>
            <th style="width: 10%;">Position</th>
            <th style="width: 25%;">Action</th>
        </tr>
        <?php foreach ($supporters as $supporter) { ?>
        <tr>
            <td ><?php echo $supporter->name; ?></td>
            <td>
                <?php if(!empty($supporter->image)){ ?>
                <img src="/wp-content/uploads/<?php echo $supporter->image;?>" height="50" width="100">
                <?php }else{ ?>
                <img src="<?php echo get_template_directory_uri(); ?>/img/vinny40Logo.png" height="60" width="100" alt="LHD Logo">
                <?php }?>
            </td>
            <td ><?php echo $supporter->link != "javascript:void(0)" ? $supporter->link : ""; ?></td>
            <td ><?php echo $supporter->position; ?></td>
            <td class="action">
                <a class="btn btn-small btn-inverse" href="admin.php?page=<?php echo $type;?>&id=<?php echo $supporter->id;?>&action=edit">Edit</a>
                <a class="btn btn-small btn-inverse" href="admin.php?page=<?php echo $type;?>&id=<?php echo $supporter->id;?>&action=delete">Delete</a>
            </td>
        </tr>
        <?php
    }
        ?>
    </table>
</form>
<?php }

function saveSupporterData(){
    $error_flag = 0;
    $errorMessage = "";
    $image_name = "";
    if(isset($_POST['name']) && empty($_POST['name'])){
        $errorMessage .= "Name Can't be blank.<br>";
        $error_flag = 1;
    }
    if(isset($_POST['link']) && empty($_POST['link'])){
        $_POST['link']="javascript:void(0)";
    }
    if(isset($_POST['position']) && empty($_POST['position'])){
        $errorMessage .= "Position can't be blank.<br>";
        $error_flag = 1;
    }
    if(!empty($_POST['position']) && !is_numeric($_POST['position'])){
        $errorMessage .= "Postion: only numeric value.<br>";
        $error_flag = 1;
    }

    if (!empty($_FILES) && !$error_flag) {
        foreach ($_FILES as $key => $file) {
            $image = wp_get_image_editor( $file["tmp_name"] );
            $file_path = ABSPATH . "wp-content/uploads/";
            if ( ! is_wp_error( $image ) ) {
                $path_parts = pathinfo($file["name"]);
                $image_name = $path_parts['filename'] . '_' . time() . '.' . $path_parts['extension'];
                $image->save( $file_path . $image_name );
            }else{
                $error_flag = 1;
            }
        }
    }
    if (!$error_flag) {
        //save data in database

        global $wpdb;
        $table_name = $wpdb->prefix . "supporters";
        $sql = "INSERT INTO $table_name (type,name,image,position,link)
                                VALUES ('$_POST[type]','$_POST[name]','$image_name','$_POST[position]','$_POST[link]');";
        if ($wpdb->query($sql)) {
            //                echo "saved";
        } else {
            echo "Sorry! unable to save data";
        }
    }
    return $errorMessage;
}
function updateSupportData(){
    global $wpdb;
    $table_name = $wpdb->prefix . "supporters";
    $error_flag = 0;
    $errorMessage = "";
    $image_name = $_POST['image'];
    if(isset($_POST['name']) && empty($_POST['name'])){
        $errorMessage .= "Name Can't be blank.<br>";
        $error_flag = 1;
    }
    if(isset($_POST['link']) && empty($_POST['link'])){
        $_POST['link']="javascript:void(0)";
    }
    if(isset($_POST['position']) && empty($_POST['position'])){
        $errorMessage .= "Position can't be blank.<br>";
        $error_flag = 1;
    }
    if(!empty($_POST['position']) && !is_numeric($_POST['position'])){
        $errorMessage .= "Postion: only numeric value.<br>";
        $error_flag = 1;
    }
    if (!empty($_FILES) && !$error_flag) {
        foreach ($_FILES as $key => $file) {
            if (!empty($file['name'])) {
                $image = wp_get_image_editor( $file["tmp_name"] );
                $file_path = ABSPATH . "wp-content/uploads/";
                if ( ! is_wp_error( $image ) ) {
                    $path_parts = pathinfo($file["name"]);
                    $image_name = $path_parts['filename'] . '_' . time() . '.' . $path_parts['extension'];
                    $image->save( $file_path . $image_name );
                    if($_POST['image'] != ""){
                        $file_name =  $file_path = ABSPATH . "wp-content/uploads/".$_POST['image'];
                        unlink($file_name);}
                }else{
                    $error_flag = 1;
                }
            }
        }
    }
    if ($error_flag == 0) {
        $wpdb->update($table_name,
            array(
                'name' => $_POST['name'],
                'image' => $image_name,
                'position' => $_POST['position'],
                'link' => $_POST['link']
            )
            , array('ID' => $_POST['id']));
    }
    return $errorMessage;
}


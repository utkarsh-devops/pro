<?php
if (isset($_POST['submit'])) {
    saveData();
    home_slider_details();
} elseif (isset($_POST['edit'])) {
    updateData();
    home_slider_details();
} elseif ($_GET['action'] == 'edit') {
    add_home_slider();

} elseif ($_GET['action'] == 'add') {
    add_home_slider();

} elseif ($_GET['action'] == 'delete') {
    $slider_image = $wpdb->get_row("select image from $table_name where id='".$_GET['id']."';");
    $wpdb->delete($table_name, array('ID' => $_GET['id']));
    $file_name =  $file_path = ABSPATH . "wp-content/uploads/".$slider_image->image;
    unlink($file_name);
    home_slider_details();
} else {
    home_slider_details();
}


function home_slider_details(){ ?>
<form action="" xmlns="http://www.w3.org/1999/html" method="post" id="home_slider" enctype="multipart/form-data">
    <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "sliders";
        $type = $_GET['page'];
        $sql_query = "SELECT * FROM $table_name WHERE type='".$type."';";
        $slider_images = $wpdb->get_results($sql_query);
    ?>
    <table class="table table-striped table-bordered table-condensed albumList">
        <caption><h3>Slider Images for Home page of <?php echo $type != "foundation_slider" ? "Player Site" : "Foundation Site"; ?></h3></caption>
        <tr>
            <th>Name</th>
            <th>Image</th>
            <?php if($_GET['page'] == "foundation_slider"){ echo '<th>Content</th>';}?>

            <th>Action</th>
        </tr>
        <?php foreach ($slider_images as $slider_image) { ?>
        <tr>
            <td ><?php echo $slider_image->name; ?></td>
            <td>
                <?php if(!empty($slider_image->image)){ ?>
                <img src="/wp-content/uploads/<?php echo $slider_image->image;?>" height="100" width="100">
                <?php }else{ ?>
                <img src="<?php echo get_template_directory_uri(); ?>/img/vinny40Logo.png" height="100" width="100" alt="LHD Logo">
                <?php }?>
            </td>
            <?php if($_GET['page'] == "foundation_slider"){ echo "<td>".$slider_image->content."</th>";}?>

            <td class="action">
                <a class="btn btn-small btn-inverse" href="admin.php?page=<?php echo $type;?>&id=<?php echo $slider_image->id;?>&action=edit">Edit</a>
                <a class="btn btn-small btn-inverse" href="admin.php?page=<?php echo $type;?>&id=<?php echo $slider_image->id;?>&action=delete">Delete</a>
            </td>
        </tr>
        <?php
    }
        ?>
    </table>
    <a class="btn btn-small btn-inverse" href="admin.php?page=<?php echo $type;?>&action=add">Add</a>
</form>
<?php
}

function add_home_slider(){
    global $wpdb;
    $table_name = $wpdb->prefix . "sliders";
    if ($_GET['action'] != 'edit') { ?>
    <form action="" method="post" id="slider" enctype="multipart/form-data" class="mediaSliderForm">
        <div class="control-group clearfix"><h2>Add Image For Home Page Slider of <?php echo $_GET["page"] != "foundation_slider" ? "Player Site" : "Foundation Site"; ?></h2></div>
        <div class="control-group clearfix"><label>Name : </label><input type="text" name="name" class="required"></div>
        <?php if($_GET['page'] == "foundation_slider"){ ?>
        <div class="control-group clearfix"><label>Content :</label><textarea rows="4" cols="50" name="content" /></textarea></div><?php } ?>
        <div class="control-group clearfix"><label>Image*[<?php echo $_GET['page'] != "foundation_slider" ? "1600X516" : "1600X796"?>] : </label> <input type="file" name="image" id="image" class="required" onchange="readURL(this);"></div>
        <div class="control-group clearfix"><label>&nbsp;</label><div id="image_view" class="advImg"></div></div>
        <input type="hidden" name="type" value="<?php echo $_GET['page']; ?>"><br>
        <input type="submit" class="btn btn-small btn-inverse" name="submit" value="Submit">
    </form>
    <?php  } else{
        $sql_query = "SELECT * FROM $table_name WHERE id=" . $_GET['id'] . ";";
        $slider = $wpdb->get_row($sql_query);
        ?>

    <form action="" method="post" id="advantage_edit_form" enctype="multipart/form-data" class="mediaSliderForm">
        <div class="control-group clearfix"><h2>Edit Image For Home Page Slider of <?php echo $_GET["page"] != "foundation_slider" ? "Player Site" : "Foundation Site"; ?></h2></div>

        <div class="control-group clearfix"><label>Name : </label><input type="text" name="name" value="<?php echo $slider->name; ?>"></div>
        <?php if($_GET['page'] == "foundation_slider"){ ?>
        <div class="control-group clearfix"><label>Content :</label><textarea rows="4" cols="50" name="content" /><?php echo $slider->content;?></textarea></div><?php } ?>
        <div class="control-group clearfix"><label>Image [<?php echo $_GET['page'] != "foundation_slider" ? "1600X516" : "1600X796"?>]: </label><input type="file" name="image" onchange="readURL(this);"></div>
        <div class="control-group clearfix"><label>&nbsp;</label><div class="advImg" id="image_view1"><img src="/wp-content/uploads/<?php echo $slider->image;?>" height="417" width="600"></div></div>
        <div class="control-group clearfix"><label>&nbsp;</label><div class="advImg" id="image_view"></div></div>

        <input type="hidden" name="id" value="<?php echo $slider->id; ?>"><br>
        <input type="hidden" name="image" value="<?php echo $slider->image; ?>"><br>
        <input type="submit" name="edit" value="Update" class="btn btn-small btn-inverse">
    </form>
    <?php } ?>
<script type="text/javascript">
    function readURL(input) {
        jQuery("#image_view1").hide();
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                jQuery("#image_view").html("<img id='image_view' src='"+ e.target.result+"' alt='your image' style='width: 600px; height: 417px; '/></br>");
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?php
}

function saveData() {
    $error_flag = 0;
    $image_name = "";
    if(isset($_POST['name']) && empty($_POST['name'])){
        echo "Please enter name<br>";
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

    if ($error_flag == 0) {
        //save data in database

        global $wpdb;
        $table_name = $wpdb->prefix . "sliders";
        $content = stripslashes($_POST[content]);
        $sql = "INSERT INTO $table_name (type,name,image,content)
                                VALUES ('$_POST[type]','$_POST[name]','$image_name','$content');";
        if ($wpdb->query($sql)) {
            //                echo "saved";
        } else {
            echo "Sorry! unable to save data";
        }
    }
}

function updateData() {
    global $wpdb;
    $table_name = $wpdb->prefix . "sliders";
    $image_name = $_POST['image'];
    if(isset($_POST['name']) && empty($_POST['name'])){
        echo "Please enter name<br>";
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
    //update data

    if ($error_flag == 0) {
        $content = stripslashes($_POST[content]);
        $wpdb->update($table_name,
            array(
                'name' => $_POST['name'],
                'image' => $image_name,
                'content' => $content
            )
            , array('ID' => $_POST['id']));
    }
}

<?php
if (isset($_POST['submit'])) {
    saveData() ? add_media_slider() : media_slider_details() ;

} elseif (isset($_POST['edit'])) {
    updateData() ? add_media_slider() : media_slider_details() ;
} elseif ($_GET['action'] == 'edit') {
    add_media_slider();

} elseif ($_GET['action'] == 'add') {
    add_media_slider();

} elseif ($_GET['action'] == 'delete') {
    delete_slider($_GET['id']);
    media_slider_details();
} else {
    media_slider_details();
}

function delete_slider($id){
    global $wpdb;
    $table_name = $wpdb->prefix . "media_sliders";
    $slider_image = $wpdb->get_row("select * from $table_name where id='".$id."';");
    $wpdb->delete($table_name, array('ID' => $id));
    $file_path = ABSPATH . "wp-content/uploads/";
    $file_path1 = ABSPATH . "wp-content/uploads/resize/";
    for($i=1; $i <= 8 ; $i++){
        $image = "image".$i;
        $file_name = $file_path .$slider_image->$image;
        $file_name1 = $file_path1 .$slider_image->$image;
        unlink($file_name);
        unlink($file_name1);
    }
}

function media_slider_details(){ ?>
<form action="" method="post" id="media_slider" enctype="multipart/form-data">
    <?php
    global $wpdb;
    $table_name = $wpdb->prefix . "media_sliders";
    $type = $_GET['page'];
    $sql_query = "SELECT * FROM $table_name where type='".$type."' ORDER BY id desc;";
    $slider_images = $wpdb->get_results($sql_query);
    ?>
    <table class="table table-striped table-bordered table-condensed mediaSlider">
        <caption><h3><?php echo $type != "media_slider" ? "Slider Images for Photo Gallery page of Foundation Site" : "Slider Images for Media page of Player Site"; ?></h3></caption>
        <tr>
            <th>Name</th>
            <th>Image1</th>
            <th>Image2</th>
            <th>Image3</th>
            <th>Image4</th>
            <th>Image5</th>
            <th>Image6</th>
            <th>Image7</th>
            <th>Image8</th>
            <th>Action</th>
        </tr>
        <?php foreach ($slider_images as $slider_image) { ?>
        <tr>
            <td ><?php echo $slider_image->name; ?></td>
            <td>
                <?php if(!empty($slider_image->image1)){ ?>
                <img src="/wp-content/uploads/<?php echo $slider_image->image1;?>" height="100" width="100">
                <?php }else{ ?>
                <img src="<?php echo get_template_directory_uri(); ?>/img/vinny40Logo.png" height="100" width="100" alt="LHD Logo">
                <?php }?>
            </td>
            <td>
                <?php if(!empty($slider_image->image2)){ ?>
                <img src="/wp-content/uploads/<?php echo $slider_image->image2;?>" height="100" width="100">
                <?php }else{ ?>
                <img src="<?php echo get_template_directory_uri(); ?>/img/vinny40Logo.png" height="100" width="100" alt="LHD Logo">
                <?php }?>
            </td>
            <td>
                <?php if(!empty($slider_image->image3)){ ?>
                <img src="/wp-content/uploads/<?php echo $slider_image->image3;?>" height="100" width="100">
                <?php }else{ ?>
                <img src="<?php echo get_template_directory_uri(); ?>/img/vinny40Logo.png" height="100" width="100" alt="LHD Logo">
                <?php }?>
            </td>
            <td>
                <?php if(!empty($slider_image->image4)){ ?>
                <img src="/wp-content/uploads/<?php echo $slider_image->image4;?>" height="100" width="100">
                <?php }else{ ?>
                <img src="<?php echo get_template_directory_uri(); ?>/img/vinny40Logo.png" height="100" width="100" alt="LHD Logo">
                <?php }?>
            </td>
            <td>
                <?php if(!empty($slider_image->image5)){ ?>
                <img src="/wp-content/uploads/<?php echo $slider_image->image5;?>" height="100" width="100">
                <?php }else{ ?>
                <img src="<?php echo get_template_directory_uri(); ?>/img/vinny40Logo.png" height="100" width="100" alt="LHD Logo">
                <?php }?>
            </td>
            <td>
                <?php if(!empty($slider_image->image6)){ ?>
                <img src="/wp-content/uploads/<?php echo $slider_image->image6;?>" height="100" width="100">
                <?php }else{ ?>
                <img src="<?php echo get_template_directory_uri(); ?>/img/vinny40Logo.png" height="100" width="100" alt="LHD Logo">
                <?php }?>
            </td>
            <td>
                <?php if(!empty($slider_image->image7)){ ?>
                <img src="/wp-content/uploads/<?php echo $slider_image->image7;?>" height="100" width="100">
                <?php }else{ ?>
                <img src="<?php echo get_template_directory_uri(); ?>/img/vinny40Logo.png" height="100" width="100" alt="LHD Logo">
                <?php }?>
            </td>
            <td>
                <?php if(!empty($slider_image->image8)){ ?>
                <img src="/wp-content/uploads/<?php echo $slider_image->image8;?>" height="100" width="100">
                <?php }else{ ?>
                <img src="<?php echo get_template_directory_uri(); ?>/img/vinny40Logo.png" height="100" width="100" alt="LHD Logo">
                <?php }?>
            </td>

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
<?php }
function add_media_slider(){
    global $wpdb;
    $table_name = $wpdb->prefix . "media_sliders";
    if ($_GET['action'] != 'edit') { ?>
    <div class="photoGallery">
        <ul>
            <li class="clearfix">
                <div>
                    <img src="/wp-content/themes/vinny/img/image1.jpg" class="height205" alt="Vinny40" id="image1">
                    <img src="/wp-content/themes/vinny/img/image2.jpg" class="height293" alt="Vinny40" id="image2">
                    <img src="/wp-content/themes/vinny/img/image3.jpg" class="height120" alt="Vinny40" id="image3">
                </div>
                <div class="middleColumn">
                    <img src="/wp-content/themes/vinny/img/image4.jpg" class="height419" alt="Vinny40" id="image4">
                    <img src="/wp-content/themes/vinny/img/image5.jpg" class="height208" alt="Vinny40" id="image5">
                </div>
                <div>
                    <img src="/wp-content/themes/vinny/img/image6.jpg" class="height208" alt="Vinny40" id="image6">
                    <img src="/wp-content/themes/vinny/img/image7.jpg" class="height202" alt="Vinny40" id="image7">
                    <img src="/wp-content/themes/vinny/img/image8.jpg" class="height208" alt="Vinny40" id="image8">
                </div>
            </li></ul>
    </div>
    <div class="clearfix"></div>
    <form action="" method="post" id="slider" enctype="multipart/form-data" class="mediaSliderForm">
        <div class="control-group clearfix"><h2>Add Images for <?php echo $_GET["page"] != "media_slider" ? "Photo Gallery slider of Foundation Site" : "Media page slider of Player Site"; ?></h2></div>
        <div class="control-group clearfix"><label>Name : </label> <input type="text" name="name" class="required"></div>
        <div class="control-group clearfix"><label>Image1*[600X400] :</label>  <input type="file" name="image1"  class="required" onchange="readURL(this,'#image1');"> <label>Caption :</label><textarea rows="2" cols="50" name = "caption1"></textarea></div>
        <div class="control-group clearfix"><label>Image2*[600X400] :</label>  <input type="file" name="image2"  class="required" onchange="readURL(this,'#image2');"> <label>Caption :</label><textarea rows="2" cols="50" name = "caption2"></textarea></div>
        <div class="control-group clearfix"><label>Image3*[600X230] :</label>  <input type="file" name="image3"  class="required" onchange="readURL(this,'#image3');"> <label>Caption :</label><textarea rows="2" cols="50" name = "caption3"></textarea></div>
        <div class="control-group clearfix"><label>Image4*[600X900] :</label>  <input type="file" name="image4"  class="required" onchange="readURL(this,'#image4');"> <label>Caption :</label><textarea rows="2" cols="50" name = "caption4"></textarea></div>
        <div class="control-group clearfix"><label>Image5*[600X400] :</label>  <input type="file" name="image5"  class="required" onchange="readURL(this,'#image5');"> <label>Caption :</label><textarea rows="2" cols="50" name = "caption5"></textarea></div>
        <div class="control-group clearfix"><label>Image6*[600X400] :</label>  <input type="file" name="image6"  class="required" onchange="readURL(this,'#image6');"> <label>Caption :</label><textarea rows="2" cols="50" name = "caption6"></textarea></div>
        <div class="control-group clearfix"><label>Image7*[600X400] :</label>  <input type="file" name="image7"  class="required" onchange="readURL(this,'#image7');"> <label>Caption :</label><textarea rows="2" cols="50" name = "caption7"></textarea></div>
        <div class="control-group clearfix"><label>Image8*[600X400] :</label>  <input type="file" name="image8"  class="required" onchange="readURL(this,'#image8');"> <label>Caption :</label><textarea rows="2" cols="50" name = "caption8"></textarea></div>

        <input type="submit" class="btn btn-small btn-inverse" name="submit" value="Submit">
        <input type="hidden" name="type" value="<?php echo $_GET['page']; ?>"><br>
    </form>
    <?php  } else{
        $sql_query = "SELECT * FROM $table_name WHERE id=" . $_GET['id'] . ";";
        $slider = $wpdb->get_row($sql_query);
        ?>
    <div class="photoGallery">
        <ul>
            <li class="clearfix">
                <div>
                    <img src="/wp-content/uploads/resize/<?php echo $slider->image1;?>" class="height205" alt="Vinny40" id="image1">
                    <img src="/wp-content/uploads/resize/<?php echo $slider->image2;?>" class="height293" alt="Vinny40" id="image2">
                    <img src="/wp-content/uploads/resize/<?php echo $slider->image3;?>" class="height120" alt="Vinny40" id="image3">
                </div>
                <div class="middleColumn">
                    <img src="/wp-content/uploads/resize/<?php echo $slider->image4;?>" class="height419" alt="Vinny40" id="image4">
                    <img src="/wp-content/uploads/resize/<?php echo $slider->image5;?>" class="height208" alt="Vinny40" id="image5">
                </div>
                <div>
                    <img src="/wp-content/uploads/resize/<?php echo $slider->image6;?>" class="height208" alt="Vinny40" id="image6">
                    <img src="/wp-content/uploads/resize/<?php echo $slider->image7;?>" class="height202" alt="Vinny40" id="image7">
                    <img src="/wp-content/uploads/resize/<?php echo $slider->image8;?>" class="height208" alt="Vinny40" id="image8">
                </div>
            </li></ul>
    </div>
    <div class="clearfix"></div>

    <form action="" method="post" id="advantage_edit_form" enctype="multipart/form-data" class="mediaSliderForm">
        <div class="control-group clearfix"><h2>Edit Images for <?php echo $_GET["page"] != "media_slider" ? "Photo Gallery slider of Foundation Site" : "Media page slider of Player Site"; ?></h2></div>
        <div class="control-group clearfix"><label>Name : </label> <input type="text" name="name" class="required" value="<?php echo $slider->name; ?>"></div>
        <div class="control-group clearfix"><label>Image1*[600X400] :</label>  <input type="file" name="image1"  class="required" onchange="readURL(this,'#image1','#image11');"><span class = "imageView" id="image11"><img src="/wp-content/uploads/resize/<?php echo $slider->image1;?>" height="100" width="100"></span><label>Caption :</label><textarea rows="2" cols="50" name = "caption1"><?php echo $slider->caption1; ?></textarea></div>
        <div class="control-group clearfix"><label>Image2*[600X400] :</label>  <input type="file" name="image2"  class="required" onchange="readURL(this,'#image2','#image12');"><span class = "imageView" id="image12"><img src="/wp-content/uploads/resize/<?php echo $slider->image2;?>" height="100" width="100"></span><label>Caption :</label><textarea rows="2" cols="50" name = "caption2"><?php echo $slider->caption2; ?></textarea></div>
        <div class="control-group clearfix"><label>Image3*[600X230] :</label>  <input type="file" name="image3"  class="required" onchange="readURL(this,'#image3','#image13');"><span class = "imageView" id="image13"><img src="/wp-content/uploads/resize/<?php echo $slider->image3;?>" height="100" width="100"></span><label>Caption :</label><textarea rows="2" cols="50" name = "caption3"><?php echo $slider->caption3; ?></textarea></div>
        <div class="control-group clearfix"><label>Image4*[600X900] :</label>  <input type="file" name="image4"  class="required" onchange="readURL(this,'#image4','#image14');"><span class = "imageView" id="image14"><img src="/wp-content/uploads/resize/<?php echo $slider->image4;?>" height="100" width="100"></span><label>Caption :</label><textarea rows="2" cols="50" name = "caption4"><?php echo $slider->caption4; ?></textarea></div>
        <div class="control-group clearfix"><label>Image5*[600X400] :</label>  <input type="file" name="image5"  class="required" onchange="readURL(this,'#image5','#image15');"><span class = "imageView" id="image15"><img src="/wp-content/uploads/resize/<?php echo $slider->image5;?>" height="100" width="100"></span><label>Caption :</label><textarea rows="2" cols="50" name = "caption5"><?php echo $slider->caption5; ?></textarea></div>
        <div class="control-group clearfix"><label>Image6*[600X400] :</label>  <input type="file" name="image6"  class="required" onchange="readURL(this,'#image6','#image16');"><span class = "imageView" id="image16"><img src="/wp-content/uploads/resize/<?php echo $slider->image6;?>" height="100" width="100"></span><label>Caption :</label><textarea rows="2" cols="50" name = "caption6"><?php echo $slider->caption6; ?></textarea></div>
        <div class="control-group clearfix"><label>Image7*[600X400] :</label>  <input type="file" name="image7"  class="required" onchange="readURL(this,'#image7','#image17');"><span class = "imageView" id="image17"><img src="/wp-content/uploads/resize/<?php echo $slider->image7;?>" height="100" width="100"></span><label>Caption :</label><textarea rows="2" cols="50" name = "caption7"><?php echo $slider->caption7; ?></textarea></div>
        <div class="control-group clearfix"><label>Image8*[600X400] :</label>  <input type="file" name="image8"  class="required" onchange="readURL(this,'#image8','#image18');"><span class = "imageView" id="image18"><img src="/wp-content/uploads/resize/<?php echo $slider->image8;?>" height="100" width="100"></span><label>Caption :</label><textarea rows="2" cols="50" name = "caption8"><?php echo $slider->caption8; ?></textarea></div>
        <div class="control-group clearfix"><label>&nbsp</label><input type="submit" name="edit" value="Update" class="btn btn-small btn-inverse" ></div>
        <input type="hidden" name="id" value="<?php echo $slider->id; ?>"><br>
        <input type="hidden" name="image1" value="<?php echo $slider->image1; ?>"><br>
        <input type="hidden" name="image2" value="<?php echo $slider->image2; ?>"><br>
        <input type="hidden" name="image3" value="<?php echo $slider->image3; ?>"><br>
        <input type="hidden" name="image4" value="<?php echo $slider->image4; ?>"><br>
        <input type="hidden" name="image5" value="<?php echo $slider->image5; ?>"><br>
        <input type="hidden" name="image6" value="<?php echo $slider->image6; ?>"><br>
        <input type="hidden" name="image7" value="<?php echo $slider->image7; ?>"><br>
        <input type="hidden" name="image8" value="<?php echo $slider->image8; ?>"><br>
        <input type="hidden" name="type" value="<?php echo $_GET['page']; ?>"><br>
    </form>
    <?php } ?>
<script type="text/javascript">
    function readURL(input,id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
//                jQuery(id).html("<img id='image_view' src='"+ e.target.result+"' alt='your image'/></br>");
                jQuery(id).attr("src",e.target.result );
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURL(input,id,id1) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                jQuery(id1).html("<img id='image_view' src='"+ e.target.result+"' alt='your image' style='height: 100px; width: 100px;'/></br>");
                jQuery(id).attr("src",e.target.result );
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?php

}

function store_image($file_name, $file_path, $image_name, $width="", $height=""){
    $image = wp_get_image_editor( $file_name );
    if ( ! is_wp_error( $image ) ) {
        if($width != "" || $height != ""){
            $image->resize( $width, $height, false );
        }
        $image->save( $file_path . $image_name );
    }else{
        $error_flag = 1;
    }
    return $error_flag;
}

function saveData(){
    $error_flag = 0;
    $error_flag1 = 0;
    if (!empty($_FILES)) {
        $image = array();
        $file_path = ABSPATH . "wp-content/uploads/";
        $file_path1 = ABSPATH . "wp-content/uploads/resize/";
        foreach ($_FILES as $key => $file) {
            $path_parts = pathinfo($file["name"]);
            $file["name"] = $image[$key]['name'] = $path_parts['filename'] . '_' . $key . '_' . time() . '.' . $path_parts['extension'];
            switch($key){
                case "image1":
                    $error_flag = store_image($file["tmp_name"],$file_path1,$file["name"], 309, 205);
                    break;
                case "image2":
                    $error_flag = store_image($file["tmp_name"],$file_path1,$file["name"], 309, 293);
                    break;
                case "image3":
                    $error_flag = store_image($file["tmp_name"],$file_path1,$file["name"], 309, 120);
                    break;
                case "image4":
                    $error_flag = store_image($file["tmp_name"],$file_path1,$file["name"], 280, 419);
                    break;
                case "image5":
                    $error_flag = store_image($file["tmp_name"],$file_path1,$file["name"], 280, 208);
                    break;
                case "image6":
                    $error_flag = store_image($file["tmp_name"],$file_path1,$file["name"], 309, 208);
                    break;
                case "image7":
                    $error_flag = store_image($file["tmp_name"],$file_path1,$file["name"], 309, 202);
                    break;
                case "image8":
                    $error_flag = store_image($file["tmp_name"],$file_path1,$file["name"], 309, 208);
                    break;
            }
            $error_flag1 = store_image($file["tmp_name"],$file_path,$file["name"]);
            if($error_flag || $error_flag1){
                $error_flag = 1;
                break;
            }
        }
    }

    if(!$error_flag){
        global $wpdb;
        $table_name = $wpdb->prefix . "media_sliders";
        $image1 = $image['image1']['name'];
        $image2 = $image['image2']['name'];
        $image3 = $image['image3']['name'];
        $image4 = $image['image4']['name'];
        $image5 = $image['image5']['name'];
        $image6 = $image['image6']['name'];
        $image7 = $image['image7']['name'];
        $image8 = $image['image8']['name'];
        $sql = "INSERT INTO $table_name (name,image1,image2,image3,image4,image5,image6,image7,image8,caption1,caption2,caption3,caption4,caption5,caption6,caption7,caption8,type)
                                    VALUES ('$_POST[name]','$image1','$image2','$image3','$image4','$image5','$image6','$image7','$image8', '$_POST[caption1]','$_POST[caption2]','$_POST[caption3]','$_POST[caption4]','$_POST[caption5]','$_POST[caption6]','$_POST[caption7]','$_POST[caption8]','$_POST[type]');";
        $wpdb->query($sql);
    }else{
        $file_path = ABSPATH . "wp-content/uploads/";
        $file_path1 = ABSPATH . "wp-content/uploads/resize/";
        for($i=1;$i<=count($image); $i++){
            $img = "image".$i;
            $file_name = $file_path .$image[$img]['name'];
            $file_name1 = $file_path1 .$image[$img]['name'];
            unlink($file_name);
            unlink($file_name1);
        }
    }
    return $error_flag;
}

function updateData(){
    $error_flag = 0;
    $error_flag1 = 0;
    if (!empty($_FILES)) {
        $image = array();
        $image1 = array();
        $file_path = ABSPATH . "wp-content/uploads/";
        $file_path1 = ABSPATH . "wp-content/uploads/resize/";
        foreach ($_FILES as $key => $file) {
            if (empty($file['name'])) {
                $image[$key]["name"] = $_POST[$key];
            } else {
                $path_parts = pathinfo($file["name"]);
                $file["name"] = $image[$key]['name'] = $path_parts['filename'] . '_' . $key . '_' . time() . '.' . $path_parts['extension'];
                array_push($image1,$_POST[$key]);
                switch($key){
                    case "image1":
                        $error_flag = store_image($file["tmp_name"],$file_path1,$file["name"], 309, 205);
                        break;
                    case "image2":
                        $error_flag = store_image($file["tmp_name"],$file_path1,$file["name"], 309, 293);
                        break;
                    case "image3":
                        $error_flag = store_image($file["tmp_name"],$file_path1,$file["name"], 309, 120);
                        break;
                    case "image4":
                        $error_flag = store_image($file["tmp_name"],$file_path1,$file["name"], 280, 419);
                        break;
                    case "image5":
                        $error_flag = store_image($file["tmp_name"],$file_path1,$file["name"], 280, 208);
                        break;
                    case "image6":
                        $error_flag = store_image($file["tmp_name"],$file_path1,$file["name"], 309, 208);
                        break;
                    case "image7":
                        $error_flag = store_image($file["tmp_name"],$file_path1,$file["name"], 309, 202);
                        break;
                    case "image8":
                        $error_flag = store_image($file["tmp_name"],$file_path1,$file["name"], 309, 208);
                        break;
                }
                $error_flag1 = store_image($file["tmp_name"],$file_path,$file["name"]);
                if($error_flag || $error_flag1){
                    $error_flag = 1;
                    break;
                }
            }
        }
        if(!$error_flag){
            global $wpdb;
            $table_name = $wpdb->prefix . "media_sliders";
            $wpdb->update($table_name,
                array(
                    'name' => $_POST['name'],
                    'image1' => $image['image1']['name'],
                    'image2' => $image['image2']['name'],
                    'image3' => $image['image3']['name'],
                    'image4' => $image['image4']['name'],
                    'image5' => $image['image5']['name'],
                    'image6' => $image['image6']['name'],
                    'image7' => $image['image7']['name'],
                    'image8' => $image['image8']['name'],
                    'caption1' => $_POST['caption1'],
                    'caption2' => $_POST['caption2'],
                    'caption3' => $_POST['caption3'],
                    'caption4' => $_POST['caption4'],
                    'caption5' => $_POST['caption5'],
                    'caption6' => $_POST['caption6'],
                    'caption7' => $_POST['caption7'],
                    'caption8' => $_POST['caption8'],
                    'type'   => $_POST['type'],
                )
                , array('ID' => $_POST['id']));
            for($i=0;$i<count($image1);$i++){
                $file_name = $file_path .$image1[$i];
                $file_name1 = $file_path1 .$image1[$i];
                unlink($file_name);
                unlink($file_name1);
            }
        }
    }
    return $error_flag;
}


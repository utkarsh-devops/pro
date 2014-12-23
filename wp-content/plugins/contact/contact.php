<?php
/**
Plugin Name: Contact Details
Plugin URI:
Description: A simple plugin to display contact details.
Author: Simanchala
Version: 1.1
Author URI: http://www.webonise.com
 */

function contact_details_create_table(){
    global $wpdb;
    $table_name = $wpdb->prefix . "contacts";
    if ($wpdb->get_var("show tables like '$table_name'") != $table_name) {
        $sql = "CREATE TABLE IF NOT EXISTS $table_name  (
            id int(11) NOT NULL AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            company VARCHAR(500) NOT NULL,
            ph_no VARCHAR(500) NOT NULL,
            message TEXT,
            submitted_on DATETIME,
            UNIQUE KEY id (id)
        );";
        $wpdb->query($sql);
    }
}

// this hook will cause our creation function to run when the plugin is activated
register_activation_hook(__FILE__, 'contact_details_create_table');

add_action('admin_menu', 'contact_menu');
function contact_menu(){
    add_menu_page('Contacts', 'Contacts', 'list_users', 'contacts', 'contact', '', '86');
}

function contact(){
    global $wpdb;
    $table_name = $wpdb->prefix . "contacts";
    if ($_GET['action'] == 'delete') {
        $wpdb->delete($table_name, array('ID' => $_GET['id']));
        contact_details();
    } else {
        contact_details();
    }
}
function contact_details(){?>
    <form action="" xmlns="http://www.w3.org/1999/html" method="post" id="home_slider" enctype="multipart/form-data">
    <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "contacts";
        $per_page = 30;
        if(isset($_GET['page_no'])){
            $no = $_GET['page_no'];
        }else{
            $no = 0;
        }
        $offset = $per_page*$no;
        $limit = $per_page;
        $sql_query = "SELECT * FROM $table_name ORDER BY submitted_on DESC LIMIT $offset,$limit;";
        $contact_lists = $wpdb->get_results($sql_query);
        $total = $wpdb->get_row("select count(*) as number_of_rows from $table_name");
    ?>
    <table class="table table-striped table-bordered table-condensed">
        <caption><h3>Contact List</h3></caption>
        <tr>
            <th style="width: 15%;">Name</th>
            <th style="width: 20%;">Email</th>
            <th style="width: 10%;">Company</th>
            <th style="width: 10%;">Phone Number</th>
            <th style="width: 20%;">Message</th>
            <th style="width: 15%;">Submitted On</th>
            <th style="width: 10%;"></th>
        </tr>
        <?php foreach ($contact_lists as $contact_list) { ?>
        <tr>
            <td ><?php echo $contact_list->name; ?></td>
            <td ><?php echo $contact_list->email; ?></td>
            <td ><?php echo $contact_list->company; ?></td>
            <td ><?php echo $contact_list->ph_no; ?></td>
            <td ><?php echo $contact_list->message; ?></td>
            <td ><?php echo date("d-m-Y", strtotime($contact_list->submitted_on)); ?></td>
            <td class="action">
                <a class="btn btn-small btn-inverse" href="admin.php?page=<?php echo $_GET["page"];?>&id=<?php echo $contact_list->id;?>&action=delete">Delete</a>
            </td>
        </tr>
        <?php
    }
        ?>
    </table>
</form>
<?php
custom_pagination($total,$_GET["page"], $per_page);
}

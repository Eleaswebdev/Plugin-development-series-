<?php
// List all Userss
function phpcodertech_list () {

    global $wpdb;
    $msg = "";

// Deletes a Users
    if(isset($_GET['delete']) && isset($_GET['id'])) {

// Get Values
        $id = sanitize_key($_GET['id']);

        if (!preg_match("/^[0-9]*$/",$id))
            $msg = "error:Only numbers allowed in the ID";
        else {
            $wpdb->delete( 'users', array( 'ID' => $id ) );
            $msg = "updated:Users deleted!";
        }
    }

// List all Users
    $rows = $wpdb->get_results(
        $wpdb->prepare("SELECT id,name,email from users",$msg)
    );

    ?>
    <link href="<?php echo WP_PLUGIN_URL; ?>/phpcodertech/phpcodertech_style.css"
          type="text/css" rel="stylesheet" />

    <div class="wrap">

        <h2>Userss</h2>

        <?php
        if (!empty($msg)) {
            $fmsg = explode(':',$msg);
            echo "<div class=\"{$fmsg[0]}\"><p>{$fmsg[1]}</p></div>";
        }
        ?>

        <a href="<?php echo admin_url('admin.php?page=phpcodertech_create'); ?>">Add New</a>

        <table class='wp-list-table widefat fixed'>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>&nbsp;</th>
            </tr>
            <?php
            foreach ($rows as $row ){
                ?>
                <tr>
                    <td><?php echo $row->id ?></td>
                    <td><?php echo $row->name ?></td>
                    <td><?php echo $row->email ?></td>
                    <td>
                        <a href="<?php echo admin_url("admin.php?page=phpcodertech_update&id=".$row->id); ?>">Update</a> |
                        <a href="<?php echo admin_url("admin.php?page=phpcodertech_list&delete&id=".$row->id); ?>"
                           onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
    <?php
}
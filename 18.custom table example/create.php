<?php
// Create a Users
function phpcodertech_create() {

    if (isset($_POST['insert'])) {
// Get Values
        echo $id = sanitize_key($_POST['id']);
        echo $name = sanitize_text_field($_POST['name']);
        echo $email = sanitize_email($_POST['email']);
        $msg = "";

// Validations
        if (!preg_match("/^[0-9]*$/",$id) || empty($id)) {
            $msg = "error:Only numbers allowed in the ID";
        } elseif (!preg_match("/^[a-zA-Z ]*$/",$name) or empty($name)) {
            $msg = "error:Only letters and white space allowed in the name";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $msg = "error:Invalid email format";
        } else {

            global $wpdb;

// Check if the ID exists
            $id_check = $wpdb->get_var(
                $wpdb->prepare( "SELECT count(*) FROM users WHERE id = %d", $id )
            );

            if ($id_check == 0) {
                $wpdb->insert(
                    'users', // table
                    array('id' => $id, 'name' => $name, 'email' => $email), // data
                    array('%d', '%s', '%s') // data format
// %s (string), %d (integer) and %f (float)
                );

// This should go away and be treated with an object destructor
// or something like that.
                $id = "";
                $name = "";
                $email = "";
                $msg = "updated:Users saved";

            } else {
                $msg = "error:Duplicated ID, try another";
            }

        }

    }
    ?>

    <link href="<?php echo WP_PLUGIN_URL; ?>/phpcodertech/phpcodertech_style.css"
          type="text/css" rel="stylesheet" />

    <div class="wrap">

        <h2>Add New Users</h2>

        <?php
        if (!empty($msg)) {
            $fmsg = explode(':',$msg);
            echo "<div class=\"{$fmsg[0]}\"><p>{$fmsg[1]}</p></div>";
        }
        ?>

        <p>
            <a href="<?php echo admin_url('admin.php?page=phpcodertech_list')?>">
                &laquo; Back to Userss list</a>
        </p>

        <form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>">

            <table class='wp-list-table widefat fixed'>
                <tr>
                    <th>ID</th>
                    <!-- TODO Javascript only numbers validation -->
                    <td><input type="text" name="id" value="<?php echo $id;?>"/>
                        <em>(numbers)</em></td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td><input type="text" name="name" value="<?php echo $name;?>"/></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input type="text" name="email" value="<?php echo $email;?>"/></td>
                </tr>
            </table>

            <input type="submit" name="insert" value="Save" class="button">

        </form>

    </div>

    <?php
}
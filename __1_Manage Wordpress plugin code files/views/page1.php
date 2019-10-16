
<?php
echo '<div class="wrap"><div id="icon-options-general" class="icon32"><br></div>
        <h2>Settings</h2>
        <p>this is very efficient</p>
        </div>';
?>
<p>
    <img src="<?php echo PLUGIN_URL. '/__1_Manage Wordpress plugin code files/assests/images/newsimg2.png'?>" style="height: 200px;width: 400px;"/>
</p>


//part 15 About Wordpress global $wpdb Object
<?php
global $wpdb;
$db_results = $wpdb->get_results(
        $wpdb->prepare(
                "SELECT * from wp_posts order by ID limit 5",''
        )
);
echo "<pre>";print_r($db_results);echo "</pre>";

//how to insert
?>


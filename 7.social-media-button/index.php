<?php
/*
Plugin Name: 7.Your Social Media Profiles By Puredevs
Plugin URI: http://www.puredevs.com
Description: Displays a new page in your Wordpress admin settings that will allow you to enter your social media profiles. The icons for those social networks will appear on the top of your blog posts and pages. Use the getSocialMediaProfiles() template tag anywhere in your theme to display the icons. Email Bruce at info@hotwebideas.net for assistance.
Version: 2.0
Author: Barry Eleas
Author URI: http://www.puredevs.com
 */


add_action('admin_menu', 'my_plugin_menu');
// A Sidebar Widget
add_action('widgets_init','register_msmp_widget');

$showAtLoopStart = true;

function register_msmp_widget()
{
    register_widget('sbw');
}

class sbw extends WP_Widget
{
    function sbw()
    {
        $options = array(
            'classname'	=>	'msmp-widget',
            'description'	=>	'Displays your social media icons from the Your Social Media Profiles By Hot Web Ideas plugin'
        );

        parent::WP_Widget(false,'Your Social Media Profiles By Hot Web Ideas',$options);
    }

    function widget($args, $instance)
    {
        extract($args, EXTR_SKIP);
        getSocialMediaProfiles();
    }
}

class Networks
{
    public function getNetworks()
    {
        $networks = array('squidoo','feedburner','tumblr','xing','yelp','facebook','twitter','myspace','linkedin','youtube','stumbleupon','flickr','digg','delicious','meetup','newsvine','mixx','lastfm');
        //$networks = array('twitter','facebook','linkedin');
        sort($networks);
        return $networks;
    }

    public function displayNetworkTable($profile)
    {
        $name = ucwords($profile);
        $html = ('
			<tr valign="top">
			<td><img width="32" src="https://png.pngtree.com/png-clipart/20190516/original/pngtree-social-media-icons-set-png-image_3552274' . $profile . '.jpg" /></td>
			<th scope="row">' . $name . '</th>
			<td><input size="75" type="text" name="' . $profile . '" value="' . get_option($profile) . '" /></td>
			</tr>
			');

        return $html;

    }
}

function getSocialMediaProfiles()
{
    if(get_option('prefix'))
    {
        echo get_option('prefix');
    }
    $profiles = new Networks;
    $network_array = $profiles->getNetworks();
    foreach($network_array as $n)
    {
        echo display_icon($n);
    }
    if(get_option('suffix'))
    {
        echo get_option('suffix');
    }
}


function display_icon($profile)
{
    if(get_option($profile)!="")
    {
        $html = ('
		<a style="text-decoration:none;" href="' . get_option($profile) . '" target="_blank">
		<img width="32" src="https://png.pngtree.com/png-clipart/20190516/original/pngtree-social-media-icons-set-png-image_3552274' . $profile . '.jpg"/>
		</a>
		');
    } else {
        $html = "";
    }

    return $html;


}


function my_plugin_menu() {
    add_options_page('Your Social Media Profiles', 'Your Social Media Profiles By Hot Web Ideas', 'manage_options', 'hotwebideas_socialmediaprofiles', 'my_plugin_options');
}

function my_plugin_options() {
    if (!current_user_can('manage_options'))  {
        wp_die( __('You do not have sufficient permissions to access this page.') );
    }

    ?>

    <div class="wrap">
        <h2>Social Media Profiles</h2>
        Hello from Bruce of <a href="http://www.hotwebideas.net">Hot Web Ideas</a>.
        The instructions for these settings are simple. Enter your full profile address into the appropriate social network line.
        Leaving any blank will simply tell Wordpress not to display the icon.
        We will be updating this plugin periodically as new social networks emerge, so please do not modify it.<hr/>Check our original Wordpress plugins which we are always developing at <a href="http://www.hotwebideas.net/wordpressplugins.php" target="_blank">http://www.hotwebideas.net/wordpressplugins.php</a>

        <form method="post" action="options.php">
            <?php wp_nonce_field('update-options'); ?>



            <table class="form-table">

                <tr valign="top">
                    <td colspan="3" style="color:#FFF;background:#3399FF;font-size:12pt;">Section Formatting</td>
                </tr>


                <tr valign="top">
                    <td></td>
                    <th scope="row">Prefix HTML</th>
                    <td><input size="75" type="text" name="prefix" value="<?php echo get_option('prefix');?>" /></td>
                </tr>
                <tr valign="top">
                    <td></td>
                    <th scope="row">Suffix HTML</th>
                    <td><input size="75" type="text" name="suffix" value="<?php echo get_option('suffix');?>" /></td>
                </tr>

                <tr valign="top">
                    <td colspan="3" style="color:#FFF;background:#3399FF;font-size:12pt;">Your Social Networks</td>
                </tr>


                <?php
                $networks = new Networks;
                $network_array = $networks->getNetworks();
                foreach($network_array as $n)
                {
                    echo $networks->displayNetworkTable($n);
                }

                ?>
            </table>

            <input type="hidden" name="action" value="update" />
            <input type="hidden" name="page_options" value="prefix,suffix,<?php echo implode(",",$network_array); ?>" />

            <p class="submit">
                <input type="submit" class="button-primary" value="<?php _e('Save Your Social Profiles') ?>" />
            </p>


        </form>
    </div>

    <table class="form-table">
        <tr valign="top">
            <td colspan="3" style="color:#FFF;background:#3399FF;font-size:12pt;">More Services From HotWebIdeas.Net</td>
        </tr>
    </table>

    <p>
        <a href="http://fiverr.com/hotwebideas/analyze-your-websites-home-page-and-give-you-suggestions-on-how-to-get-more-people-to-call-you-at-the-number-on-your-home-page">I will analyze your website in five areas and suggest how to improve sales and search engine rankings for $5</a><br/>
        It is true that most websites do not make money, because they are not designed correctly. I have been analyzing websites for 10 years. In this gig, I will provide you a simple report that tells it like it is. I will tell you how to re-design your website to increase sales and what is not working in 5 areas including: 1. Design 2. Content Placement 3. Sales Conversion 4. Search Engine Rankings 5. Social Media
    </p>

    <p>
        <a href="http://fiverr.com/hotwebideas/send-you-my-notes-from-the-social-media-marketing-conference">I will send you my notes from the Social Media Marketing Conference in NY City with 10 pages of professionally typed notes and advice for $5</a><br/>
        I attended the Social Media Marketing Conference in New York City and took some good notes on 4 of the seminars that I attended. I paid $199 for this conference, but you can have my notes for the simple $5 Fiverr price. I am willing to share them with you and upload them to you. The notes are on a 10 page PDF. I also add my own social media marketing advice & expertise as I have been doing it successfully for 5 years.
    </p>

    <p>
        <a href="http://fiverr.com/hotwebideas/send-you-a-document-that-shows-how-i-became-a-successful-fiverr-seller-and-share-my-secrets-and-experience-with-you">I will send you a document that shows how I became a successful Fiverr seller and share my secrets and experience with you for $5</a><br/>
        I have recently realized success at Fiverr and have become a Level 2 seller with several of my gigs that sell well. I have written a 10 page document / ebook that I am offering to anyone who wants to become a successful Fiverr seller. It includes tools, strategies, experience, and full color screenshots of what a Fiverr looks like to a successful seller. I deliver this all in one day.
    </p>

    <p>
        <a href="http://fiverr.com/hotwebideas/feature-your-blog-on-one-of-the-top-rated-blog-networks-for-three-months">I will feature your blog on one of the top rated blog networks for 30 days for $5</a><br/>
        We will feature your blog on one of the top rated blog networks. We can increase hits to your blog and increase your subscribers. With this gig, your blog will be featured on the top section called Featured Blog Spotlight set apart from the rest and it will get more exposure in this section. When you get featured on our blog network, we will automatically update your listing every time you add a new blog article.
    </p>

<?php }



// Method for Displaying The Social Media Icons


//Template Tag
function displaySocialMediaIcons()
{
    // Social Media Template Tag
    return getSocialMediaProfiles();
}





?>
<?php
/**
 * Plugin Name: 3.content to page or post
 * Plugin URI: https://puredevs.com/
 * Description: This plugins  is only applied to single post
 * Version: 1.0
 * Author: Barry Eleas
 * Author URI: http://puredevs.com/
 **/

//This text shows only single posts
add_filter ('the_content', 'insertNewsLetter');
function insertNewsLetter($content) {
    if(is_single()) {
        $content.= '<div style="border:1px dotted #000; text-align:center; padding:10px;">';
        $content.= '<h4>Enjoyed this article?</h4>';
        $content.= '<p><a href="http://puredevs.com">Stay up to date, and subscribe to our RSS feed!</a></p>';
        $content.= '</div>';
    }
    return $content;
}

//This text shows only single page and posts
function before_after($content)
{
    if (is_page() || is_single()) {
        $beforecontent = '<h1>This text shows only single page and posts</h1>';
        $aftercontent = '<h4>And this will come after, so that you can remind them of something, like following you on Facebook for instance.</h4><br/>';
        $fullcontent = $beforecontent . $content . $aftercontent;
    } else {
        $fullcontent = $content;
    }

    return $fullcontent;
}
    add_filter('the_content', 'before_after');


//reply text after someone comment on post or page
function before_after_reply($content){
if(is_page() || is_single()) {
    $rand1 = rand(0,1);
    $rand2 = rand(0,1);

    // If/Else for Before
    if($rand1 == 1) {
        $beforecontent = 'This is reply text after someone comment on post or page';
    } else {
        $beforecontent = 'reply text';
    }

    // If/Else for After
    if($rand2 == 1) {
        $aftercontent = 'This could be an email sign-up form at the end of the content.';
    } else {
        $aftercontent = 'Or it could be a Facebook like button.';
    }

    // Output
    $fullcontent = $beforecontent . $content . $aftercontent;

} else {
    $fullcontent = $content;
}

return $fullcontent;
}
add_filter('the_content', 'before_after_reply');

// text something on specific date or time period

function before_after_specific_time($content) {
    if(is_page() || is_single()) {

        // Date Variables
        $startdate = '20170102'; // Format YEAR/MONTH/DAY
        $enddate = '20170516'; // Format YEAR/MONTH/DAY
        $currentdate = date('Ymd'); // Format YEAR/MONTH/DAY
        $past60days = strtotime('-60 days');
        $postdate = get_the_date('Ymd', get_the_id());

        // If you want to display before and after content for a specific time period
        if($currentdate > $startdate && $currentdate < $enddate) {
            $beforecontent = 'Specific time';
            $aftercontent = 'This could be an email sign-up form at the end of the content.';
        } else {
            $beforecontent = ''; // Don't display anything anymore.
            $aftercontent = ''; // Don't display anything anymore.
        }

        // If you want to display before and after content on posts from a specific time period
        if($postdate > $startdate && $postdate < $enddate) {
            $beforecontent = 'Shows text on specific time';
            $aftercontent = 'This could be an email sign-up form at the end of the content.';
        } else {
            $beforecontent = ''; // Don't display anything anymore.
            $aftercontent = ''; // Don't display anything anymore.
        }

        // If you want to display before and after content on posts published from 60 days ago until now
        if($postdate > $past60days) {
            $beforecontent = 'This goes before the content. Isn\'t that awesome!';
            $aftercontent = 'This could be an email sign-up form at the end of the content.';
        } else {
            $beforecontent = ''; // Don't display anything anymore.
            $aftercontent = ''; // Don't display anything anymore.
        }

        // Output
        $fullcontent = $beforecontent . $content . $aftercontent;

    } else {
        $fullcontent = $content;
    }

    return $fullcontent;
}
add_filter('the_content', 'before_after_specific_time');
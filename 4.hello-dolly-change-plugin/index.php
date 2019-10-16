<?php
/**
 * @package Hello_Dolly
 * @version 1.6
 */
/*
Plugin Name: 4.Random Lyrics Rock And Roll
Description: It's Been A Long Time Since I Rock and Rolled
Author: Barry Eleas
Version: 1.0
Author URI: http://www.puredevs.com
*/

/*

1. Change the name of the plugin to the new song.
2. Change the description of the plugin.
3. Put in the new lyrics, make sure every lyric is on a new line.
4. Change the call back functions to match the new song title.
5. Change the CSS of the lyric to:
	a. color: yellow
	b. font size: 14pt
	c. background color: black
	d. add 2 more properties of CSS.

*/

function get_random_lyric() {
    /** These are the lyrics to Hello Dolly */
    $lyrics = "It's been a long time since I rock and rolled, 
It's been a long time since I did the Stroll. 
Ooh, let me get it back, let me get it back, 
Let me get it back, baby, where I come from. 
It's been a long time, been a long time, 
Been a long lonely, lonely, lonely, lonely, lonely time. Yes it has. 

It's been a long time since the book of love, 
I can't count the tears of a life with no love. 
Carry me back, carry me back, 
Carry me back, baby, where I come from. 
It's been a long time, been a long time, 
Been a long lonely, lonely, lonely, lonely, lonely time. 

Seems so long since we walked in the moonlight, 
Making vows that just can't work right. 
Open your arms, opens your arms, 
Open your arms, baby, let my love come running in. 
It's been a long time, been a long time, 
Been a long lonely, lonely, lonely, lonely, lonely time.";

    // Here we split it into lines
    $lyrics = explode( "\n", $lyrics );

    // And then randomly choose a line
    return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later
function rock_and_roll_text() {
    $chosen = get_random_lyric();
    echo ("
	<p id='dolly'>
	<span id='dolly_intro'>From the song Rock And Roll:</span><br/>
	$chosen
	</p>
	");
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'rock_and_roll_text' );

// We need some CSS to position the paragraph
function random_text_css() {
    // This makes sure that the positioning is also good for right-to-left languages
    $x = is_rtl() ? 'left' : 'right';

    echo "
	<style type='text/css'>
	#dolly {
		float: $x;
		padding-$x: 15px;
		padding: 5px;		
		margin: 0;
		font-size: 14pt;
		background-color:black;
		color:yellow;
		border:2px solid gold;
	}
	#dolly_intro {
		font-size: 10pt;
		color:white;
	}
	</style>
	";
}

add_action( 'admin_head', 'random_text_css' );

?>

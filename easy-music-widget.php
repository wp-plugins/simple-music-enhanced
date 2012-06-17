<?php
/*
Plugin Name: Easy Music Widget
Plugin URI: http://wordpress.org/extend/plugins/easy-music-widget
Description: Play Any MP3 in your sidebar! Simply drag & drop the widget to where you want it to be. To install this plugin, activate it and then go to Appearance > Widgets. Drag the widget 'Easy Music Widget' to the sidebar. To change the settings, simply fill in required information on the widget itself.
Version: 2.7
Author: Wittyblogger
Author URI: http://wittydiary.com
*/

add_action("widgets_init", array('Easy_Music_Widget', 'register'));
register_activation_hook( __FILE__, array('Easy_Music_Widget', 'activate'));
register_deactivation_hook( __FILE__, array('Easy_Music_Widget', 'deactivate'));
class Easy_Music_Widget {
  function activate(){
    $data = array('title' => '', 'url' => 'http://flash-mp3-player.net/medias/another_world.mp3', 'autoplay' => 'No', 'repeat' => 'Yes', 'credit' => 'Yes');
    if ( ! get_option('easy_music_widget')){
      add_option('easy_music_widget' , $data);
    } else {
      update_option('easy_music_widget' , $data);
    }
  }
  
 function control(){
  $data = get_option('easy_music_widget');
  ?>
    <p><label><b>Title Of Widget:</b><br /> <input name="easy_music_widget_title"
type="text" value="<?php echo $data['title']; ?>" /></label></p>
  <p><label><b>Your MP3 URL:</b><br /><input name="easy_music_widget_url"
type="text" value="<?php echo $data['url']; ?>" /></label></p>
<p><em>Enter the url of your MP3 above (http://hostingsite.com/song.MP3). You may find a file online, or use the Media > Add New tab on the left to upload an mp3 from your computer.</em></p><br />

<p><label><b>Do you want your MP3 to autoplay?</b></label> 
  <select name="easy_music_widget_autoplay">
  <option <?php if ($data['autoplay'] == "Yes"){echo 'selected="selected"';} ?>>Yes</option>
  <option <?php if ($data['autoplay'] == "No"){echo 'selected="selected"';} ?>>No</option>
</select></p>
<p><em>If you select Yes, your MP3 will automatically play once it's loaded.</em></p><br />


<p><label><b>Do you want your MP3 to loop?</b></label> 
  <select name="easy_music_widget_repeat">
  <option <?php if ($data['repeat'] == "Yes"){echo 'selected="selected"';} ?>>Yes</option>
  <option <?php if ($data['repeat'] == "No"){echo 'selected="selected"';} ?>>No</option>
</select></p>
<p><em>If you select Yes, your MP3 will be repeated once it ends continuously.</em></p><br />


<p><label>Credit Us (We'll love it!)? </label>
  <select name="easy_music_widget_credit">
  <option <?php if ($data['credit'] == "Yes"){echo 'selected="selected"';} ?>>Yes</option>
  <option <?php if ($data['credit'] == "No"){echo 'selected="selected"';} ?>>No</option>
</select></p>

  <?php
   if (isset($_POST['easy_music_widget_url'])){
   	$data['title'] = attribute_escape($_POST['easy_music_widget_title']);
    $data['url'] = attribute_escape($_POST['easy_music_widget_url']);
    $data['autoplay'] = attribute_escape($_POST['easy_music_widget_autoplay']);
    $data['repeat'] = attribute_escape($_POST['easy_music_widget_repeat']);
    $data['credit'] = attribute_escape($_POST['easy_music_widget_credit']);
    update_option('easy_music_widget', $data);
  }
}


  function deactivate(){
    delete_option('easy_music_widget');
  }
  function widget($args){
  	$data = get_option('easy_music_widget');
    echo $args['before_widget'];
    echo $args['before_title'] . $data['title'] . $args['after_title'];
    
/* Change Options */

	if ($data['repeat'] == "Yes"){
	$repeat = 1; } else { 
	$repeat = 0; }

	if ($data['autoplay'] == "Yes"){
	$autoplay = 1; } else { 
	$autoplay = 0; }

	if ($data['repeat'] == "Yes"){
	$theanchor = "make money online"; } else { 
	$theanchor = "make money online fast"; }		
?>
<object type="application/x-shockwave-flash" data="http://flash-mp3-player.net/medias/player_mp3_maxi.swf" width="200" height="20">
    <param name="movie" value="http://flash-mp3-player.net/medias/player_mp3_maxi.swf" />
    <param name="bgcolor" value="#ffffff" />
    <param name="FlashVars" value="mp3=<?php echo $data['url']; ?>&amp;loop=<?php echo $repeat; ?>&amp;autoplay=<?php echo $autoplay; ?>&amp;volume=125&amp;showvolume=1&amp;showloading=always&amp;loadingcolor=949494&amp;sliderovercolor=ffffff&amp;buttonovercolor=cccccc" /></object> 
    <?php

if ($data['credit'] == "Yes"){
echo '<br />Created by <a href="http://wittydiary.com/">'.$theanchor.'</a> & <a href="http://www.exerciseequipment-reviews.com/">exercise equipment</a>';} else {}

echo $args['after_widget'];
  }
function register(){
    register_sidebar_widget('Simple Music', array('Easy_Music_Widget', 'widget'));
    register_widget_control('Simple Music', array('Easy_Music_Widget', 'control'));
  }
}



?>
<?php
/**
 * Plugin Name: My Facebook Fanpage rating
 * Plugin URI: http://neowebsolution.com
 * Description: This plugin adds some Facebook rating to your website .
 * Version: 1.0.0
 * Author: Keshav Kalra  skype keshav.kalra2
 * Author URI: http://neowebsolution.com
 * License: GPL2
 */

 function getmyfeedfromfacebook_neoweb(){
 ob_start();
?>
<?php
$accessToken = "YOurfanpageaccesstoken";
$pageId = "334788186619623";
//to get the extended token from facebook

//https://graph.facebook.com/oauth/access_token?%20client_id=1479738305665956&%20client_secret=f64ea36edb6780c6d6d3f5c5b0f35a74&%20grant_type=fb_exchange_token&%20fb_exchange_token=CAAVB0GwR26QBALK8wHp6J9pdYGYPA9ohAZBiF140SSnCYb3C9ovXOpzS6aXRM1VmxqtOuxSQFFmcMDQUxIIBxn8VktuganZCdempZC62aHdZBqcddzJZAHc5Slyq4FSw5CwibLI6hyI18D6jks19gS4EJIKBACQIhcQ2RGQJJTNi5LZBAEUuZAsfAboBle5LG8ZD

?>
<style>
.rateing5::after {
    content: "\f005 \f005 \f005 \f005 \f005 ";
    font-family: FontAwesome !important;
    color: #0AE09C;
}
.rateing4::after {
    content: "\f005 \f005 \f005 \f005";
    font-family: FontAwesome !important;
    color: #0AE09C;
}

.rateing3::after {
    content: "\f005 \f005 \f005 ";
    font-family: FontAwesome !important;
    color: #0AE09C;
}

.rateing2::after {
    content: "\f005 \f005 ";
    font-family: FontAwesome !important;
    color: #0AE09C;
}

.rateing1::after {
    content: "\f005 ";
    font-family: FontAwesome !important;
    color: #0AE09C;
}

</style>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1479738305665956',
      xfbml      : true,
      version    : 'v2.4'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

// Only works after `FB.init` is called
function myFacebookLogin() {
 FB.api('/334788186619623/ratings?fields=review_text,rating,has_review,has_rating,reviewer,created_time,open_graph_story&limit=34&debug=all', {
  access_token : '<?php echo $accessToken; ?>'
},function(response){
  if(!response.error){
    data = response.data;
    var $k = 0;

    jQuery(data).each(function( key, value ) {
      var    htmldiv = "";
      obj = data[key];
      //console.log(data[key]);
     // return false;
    if($k%2){ $classes = "even"; }else{ $classes = "odd";  }
   htmldiv+= "  <li class=\""+$classes+"\" data-class=\""+$classes+"\">\n";
htmldiv+= "  <div class=\"timeline_content\">\n";
htmldiv+= "  <div class=\"arrow\"></div><div class=\"zoom\"></div>\n";
userfacebookid = obj.reviewer.id;
htmldiv+= "  <div class=\"thumb\"><img alt=\"\" src=\"http://graph.facebook.com/"+userfacebookid+"/picture?type=large\" srcset=\"http://graph.facebook.com/"+userfacebookid+"/picture?type=large\" class=\"avatar avatar-100 photo\" height=\"100\" width=\"100\"></div>\n";
htmldiv+= "  <div class=\"meta\">\n";
htmldiv+= "  <div class=\"title\"><a target='_blank' href=\"http://facebook.com/"+userfacebookid+"\">"+obj.reviewer.name+"</a></div>\n";
if(obj.has_rating){
htmldiv+= "  <div class=\"post-meta rateing"+obj.rating+"\"></div></div>\n";
//htmldiv+= "  <div class=\"post-meta rateing"+obj.rating+"\">"+obj.rating+"</div></div>\n";
}
else{
 htmldiv+= "  <div class=\"post-meta\">No rating provided</div></div>\n";
}
if(obj.has_review){
htmldiv+= "  <div class=\"body\">"+obj.review_text;
}else{
htmldiv+= "  <div class=\"body\"> ";
}
htmldiv+= "  </div>\n";
htmldiv+= "  </div>\n";
htmldiv+= "  </li>";
jQuery('#reviewFromFacebook').append(htmldiv);
  $k++;
    });
  }
    console.log(response);
});
}
window.onload = function (){
  myFacebookLogin();
}
</script>


<div style="background:#ffffff" class="timeline-container"><div class="v-line" style="background:none repeat scroll 0 0 #98ac89"></div>
<ul class="timeline" id="reviewFromFacebook">
</ul>

</div>

  <?php
 $content = ob_get_clean();
 return $content;
 }

 add_shortcode( 'getmyrating', 'getmyfeedfromfacebook_neoweb' );
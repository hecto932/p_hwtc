<?php
define('ABSPATH', rtrim(dirname(str_replace(array('"', '<', '>',"'"), '', $_SERVER["PHP_SELF"])), '/\\'));
$video = $_GET['video'];

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Player</title>
<style type="text/css">
html, body {margin:0; padding:0;overflow:hidden;}
</style>

<script type = "text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
<script type="text/javascript">
var params = {};
params.play = "true";
params.menu = "false";
params.scale = "showall";
params.wmode = "window";
params.allowfullscreen = "true";
params.allowscriptaccess = "always";
params.allownetworking = "all";
	  
swfobject.embedSWF("../images/flvplayer.swf?movie=<?php echo $video; ?>&controls=show", "player", "620", "375", "8", null, null, params, null);
//so.write("player");
</script>
</head>

<body>
<div id="player"></div>
</body>
</html>





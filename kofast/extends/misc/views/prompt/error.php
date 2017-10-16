<!DOCTYPE html>
<html>
<head>
    <title>Error</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/resource/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" />

	<script src="/resource/plugins/jquery/jquery.js"></script>
</head>
<body>
<br/><br/><br/><br/><br/>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="col-md-4 col-md-offset-4">
      <div class="panel panel-default">
        <div class="panel-body center">
          <h3 align="center"><?php echo $message; ?></h3>
          <hr/>
          <div align="center">
            <a class="btn btn-danger btn-big"  href="#"> 返回>> </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	var isInFancybox = self != top;
	if(isInFancybox) {
		$("a").click( function () { parent.$.fancybox.close(); });
		setTimeout(function(){parent.$.fancybox.close();}, 3000);
	} else {
		<?php if($redirect !== NULL) {?>
		$('a').attr('href','<?php echo $redirect; ?>');
		setTimeout('(function(uri) {location.href = uri;})("<?php echo $redirect; ?>")', <?php echo isset($timeout) ? $timeout * 1000 : 3000; ?>);
		<?php } else {?>
		$('a').attr('href','/');
		setTimeout('(function(uri) {location.href = uri;})("/")', <?php echo isset($timeout) ? $timeout * 1000 : 3000; ?>);
		<?php }?>
	}
</script>
</body>
</html>

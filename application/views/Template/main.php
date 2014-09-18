<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<base href="<?php echo base_url()?>" />
	<link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="asset/css/bootstrap-theme.min.css"/>
	<link rel="stylesheet" type="text/css" href="asset/css/font-awesome.min.css"/>
	<link rel="stylesheet" type="text/css" href="asset/css/style.css"/>

</head>
<body>
<div class="container">
	<div id="chatLayout">
		<div class="row">
			<div class="col-xs-3" id="leftNav">
				<div class="header">
				</div>
				<div id="leftNavContent">
				</div>
			</div>
			<div class="col-xs-9" id="rightNav">
				<?php $this->load->view($template)?>
			</div>
		</div>
	</div>
</div>

<script src="asset/js/jquery.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>
<script src="asset/js/jquery.searchable.js"></script>
<script src="asset/js/socketIO.js"></script>
<script src="asset/js/jquery.cookie.js"></script>
<script src="asset/js/main.js"></script>
</body>
</html>
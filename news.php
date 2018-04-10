<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Totem Ticker</title>
	<link rel="stylesheet" type="text/css" href="style/news.css"/>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.totemticker.js"></script>
	<script type="text/javascript">
		$(function(){
			$('#vertical-ticker').totemticker({
				row_height	:	'100px',
				next		:	'#ticker-next',
				previous	:	'#ticker-previous',
				stop		:	'#stop',
				start		:	'#start',
				mousestop	:	true,
			});
		});
	</script>
</head>
<body>
	
	
	
	<div id="wrapper">
		<ul id="vertical-ticker">
			<li>Latest News1</li>
			<li>Latest News2</li>
			<li>Latest News3</li>
			<li>Latest News4</li>
			<li>Latest News5</li>
			<li>Latest News6</li>
			<li>Latest News7</li>
		</ul>
		
		<p><a href="#" id="ticker-previous">Previous</a> / <a href="#" id="ticker-next">Next</a> / <a id="stop" href="#">Stop</a> / <a id="start" href="#">Start</a></p>
		
	</div>
	
</body>	
</html>
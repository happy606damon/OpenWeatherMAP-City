<html>
<head>
	<title>Weather</title>
	<meta charset="utf-8">
	<meta name="author" description="Josh Cintolo & Yara Tercero-Parker">

	<!-- GOOGLE FONTS -->
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
	
	<!-- STYLESHEETS -->
	<link rel="stylesheet" type="text/css" href="city.css">

	<!-- JQUERY -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
	<body>
		<div class="citySearch">
			<div id="search">
				<input type="text" name="city" id="city" placeholder="Search by city"/>
				<div id="suggestion-box"></div>
			</div>	 
			
			<div id="display"></div>
		</div>
		<!-- JAVASCRIPT -->
		<script type="text/javascript" src="city.js"></script>
	</body>
</html>
<?php
// include('AlgoliaSearch.php');

?>

<!DOCTYPE html>
<html>
<head>
<title>Welcome to caffeine</title>
	<meta name="description" content="Search the web for sites and images.">
	<meta name="keywords" content="Search engine, caffeine, websites">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/instantsearch.js@2.7.1/dist/instantsearch.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

	<link rel="stylesheet" type="text/css" href="assets/css/algolia.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="icon" href="assets/images/photo.png">

	<script src="https://cdn.jsdelivr.net/npm/instantsearch.js@2.8.0/dist/instantsearch.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
	<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
	<script type="text/javascript" src="assets/js/script.js"></script>
	


</head>
<body>

	<div class="wrapper indexPage">
	

		<div class="mainSection">

			<div class="logoContainer">
				<img src="assets/images/Logo.png" title="Logo of our site" alt="Site logo">
			</div>


			<div class="searchContainer">

			<div>
				<form action="search.php" method="GET">

					<input id="search-input" class="searchBox" type="text" name="term" autocomplete="off" >
					<input class="searchButton" type="submit" value="Search">


				</form>
				</div>
				<main>
		<div id="hits">
	
		</div>	
		<div id="paginations">

		</div>
	</main>
				
			</div>


		</div>


	</div>


	<script type="text\html" id="hit-template">

					<div class="hit">
						<div class="hit-image" style="width:50%;">
						<a href="{{url}}" style="text-decoration:none;">
								<div>{{description}}</div>
								</a>
						</div>
						<div class="hit-content">
						<div>
							<div class="hit-name" style="text-align:center;">
								<a href="{{url}}">
								{{{_highlightResult.title.value}}}
								</a>
							</div>
							<br>
							<br>
						</div>
						</div>
					</div>

					</script>


	

	

</body>
</html>
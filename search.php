<?php
include("config.php");
include("classes/SiteResultsProvider.php");
include("classes/ImageResultsProvider.php");

if(isset($_GET["term"])) {
	$term = $_GET["term"];
	
}
elseif($_GET["term"]=" "){
	$urls = index.php;
	header('Location: '.$urls);

	exit("You must enter a search term");
}
else {
	exit("You must enter a search term");

}

$type = isset($_GET["type"]) ? $_GET["type"] : "sites";
$page = isset($_GET["page"]) ? $_GET["page"] : 1;


	
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
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
	<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/instantsearch.js@2.8.0/dist/instantsearch.min.js"></script>
	
	<script type="text/javascript" src="assets/js/script.js"></script>


</head>
<body>

	<div class="wrapper">
	
		<div class="header">


			<div class="headerContent">

				<div class="logoContainer">
					<a href="index.php">
						<img src="assets/images/Logo.png">
					</a>
				</div>

				<div class="searchContainer">

					<form action="search.php" method="GET">

						<div class="searchBarContainer">
							<input type="hidden" name="type" value="<?php echo $type; ?>">
							<input id="search-input" class="searchBox" type="text" name="term" value="<?php echo $term; ?>" autocomplete="off">
							<button class="searchButton">
								<img src="assets/images/icons/search.png">
							</button>
						</div>

					</form>

				</div>

			</div>


			<main>
		<div id="hits" style="z-index:9999999; position:absolute;
	left: 170px;
    top: 93px;
    width: 80%;">
	
		</div>	
		<div id="paginations">

		</div>
	</main>

			<div class="tabsContainer">

				<ul class="tabList">

					<li class="<?php echo $type == 'sites' ? 'active' : '' ?>">
						<a href='<?php echo "search.php?term=$term&type=sites"; ?>'>
							Sites
						</a>
					</li>

					<li class="<?php echo $type == 'images' ? 'active' : '' ?>">
						<a href='<?php echo "search.php?term=$term&type=images"; ?>'>
							Images
						</a>
					</li>

				</ul>


			</div>
		</div>










		<div class="mainResultsSection">

			<?php
			if($type == "sites") {
				$resultsProvider = new SiteResultsProvider($con);
				$pageSize = 20;
			}
			else {
				$resultsProvider = new ImageResultsProvider($con);
				$pageSize = 30;
			}

			$numResults = $resultsProvider->getNumResults($term);

			echo "<p class='resultsCount'>$numResults results found</p>";



			echo $resultsProvider->getResultsHtml($page, $pageSize, $term);
			?>



		</div>



		<div class="paginationContainer">

			<div class="pageButtons">



				<div class="pageNumberContainer">
					<img src="assets/images/pageStart.png">
				</div>
				<?php

				$pagesToShow = 10;
				$numPages = ceil($numResults / $pageSize);
				$pagesLeft = min($pagesToShow, $numPages);

				$currentPage = $page - floor($pagesToShow / 2);

				if($currentPage < 1) {
					$currentPage = 1;
				}

				if($currentPage + $pagesLeft > $numPages + 1) {
					$currentPage = $numPages + 1 - $pagesLeft;
				}

				while($pagesLeft != 0 && $currentPage <= $numPages) {

					if($currentPage == $page) {
						echo "<div class='pageNumberContainer'>
								<img src='assets/images/pageSelected.png'>
								<span class='pageNumber'>$currentPage</span>
							</div>";
					}
					else {
						echo "<div class='pageNumberContainer'>
								<a href='search.php?term=$term&type=$type&page=$currentPage'>
									<img src='assets/images/page.png'>
									<span class='pageNumber'>$currentPage</span>
								</a>
						</div>";
					}


					$currentPage++;
					$pagesLeft--;

				}





				?>

				<div class="pageNumberContainer">
					<img src="assets/images/pageEnd.png">
				</div>



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
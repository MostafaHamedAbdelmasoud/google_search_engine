var timer;

$(document).ready(function() {

	
const search = instantsearch({
  appId: "STCRIU9DFR",
  apiKey: "7cecb933edf4555a8f6b280fc9b721d8",
  indexName: "search_engine",
  searchParameters: {
    hitsPerPage: 1,
    attributesToSnippet: ["description:10","title:10"],
    snippetEllipsisText: " [...]"
  }
});




// Uncomment the following widget to add hits list.

 search.addWidget(
  instantsearch.widgets.hits({
    container: "#hits",
    templates: {
      empty: "No results.",
      item: document.getElementById('hit-template').innerHTML
	}
  })
); 


// Uncomment the following widget to add a search bar.

search.addWidget(

	instantsearch.widgets.searchBox({
	  container: "#search-input"
	})
  ); 


  search.start();


  $("#search-input").click(function () {            
	  $('#hits').toggle();
	});
	
	$('#search-input').keypress(function() {
	$('#hits').show();
	});


	$('#search-input').keyup(function() {
	$('#hits').show();
	});

  $(document).click(function () {            
	$('#hits').slideUp(function(){
		$("#search-input").click(function (event) {            
			$('#hits').toggle();
		  });
	});
});


	$(".result").on("click", function() {
		
		var id = $(this).attr("data-linkId");
		var url = $(this).attr("href");

		if(!id) {
			alert("data-linkId attribute not found");
		}

		increaseLinkClicks(id, url);

		return false;
	});


	var grid = $(".imageResults");

	grid.on("layoutComplete", function() {
		$(".gridItem img").css("visibility", "visible");
	});

	grid.masonry({
		itemSelector: ".gridItem",
		columnWidth: 200,
		gutter: 5,
		isInitLayout: false
	});


	$("[data-fancybox]").fancybox({

		caption : function( instance, item ) {
	        var caption = $(this).data('caption') || '';
	        var siteUrl = $(this).data('siteurl') || '';


	        if ( item.type === 'image' ) {
	            caption = (caption.length ? caption + '<br />' : '')
	             + '<a href="' + item.src + '">View image</a><br>'
	             + '<a href="' + siteUrl + '">Visit page</a>';
	        }

	        return caption;
	    },
	    afterShow : function( instance, item ) {
	        increaseImageClicks(item.src);
	    }


	});

});


function loadImage(src, className) {

	var image = $("<img>");

	image.on("load", function() {
		$("." + className + " a").append(image);

		clearTimeout(timer);

		timer = setTimeout(function() {
			$(".imageResults").masonry();
		}, 500);

	});

	image.on("error", function() {
		
		$("." + className).remove();

		$.post("ajax/setBroken.php", {src: src});

	});

	image.attr("src", src);

}


function increaseLinkClicks(linkId, url) {

	$.post("ajax/updateLinkCount.php", {linkId: linkId})
	.done(function(result) {
		if(result != "") {
			alert(result);
			return;
		}

		window.location.href = url;
	});

}


function increaseImageClicks(imageUrl) {

	$.post("ajax/updateImageCount.php", {imageUrl: imageUrl})
	.done(function(result) {
		if(result != "") {
			alert(result);
			return;
		}
	});


}




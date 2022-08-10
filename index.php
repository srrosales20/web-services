<html>
<head>
<title> Sonia's Book Reads</title>
<style>
	body {font-family:georgia;}
  </style> 
<style>
.book{
    border:1px solid #E77DC2;
    border-radius: 5px;
    padding: 5px;
    margin-bottom:5px;
    position:relative;   
  }
 
  .pic{
    position:absolute;
    right:10px;
    top:10px;
  }
 .pic img{
	max-width:50px;
  }
  
</style>
<script src="https://code.jquery.com/jquery-latest.js"></script>

<script type="text/javascript">
// $(document).ready(function() {  
// 	$('.category').click(function(e){
//         e.preventDefault(); //stop default action of the link
// 		cat = $(this).attr("href");  //get category from URL
// 		alert(cat);  //load AJAX and parse JSON file
// 	});
// });	
  

 /////New code starts here/// 

function bookTemplate(book){

  return `
    <div class="book"> 
      <b>Book</b>: ${book.Book}<br/>
      <b>Title</b>: ${book.Title}<br/>
      <b>Author</b>: ${book.Author}<br/>
      <b>Genre</b>: ${book.Genre}<br/>
      <b>Rating</b>: ${book.Rating}<br/>
      <b>Description</b>: ${book.Description}<br/>
      <div class="pic"><img src="thumbnails/${book.Image}"/></div>
    </div>
    `;
  
  }

$(document).ready(function() { 
 
 $('.category').click(function(e){
   e.preventDefault(); //stop default action of the link
   cat = $(this).attr("href");  //get category from URL
  
   var request = $.ajax({
     url: "api.php?cat=" + cat,
     method: "GET",
     dataType: "json"
   });
   request.done(function( data ) {
     console.log(data);

    $("#booktitle").html(data.title);

    $("#books").html("");

    $.each(data.books,function(i,item){ 
      let myBook = bookTemplate(item);
    $("<div></div>").html(myBook).appendTo("#books");  
     });
 
   });

  request.fail(function(xhr, status, error ) {
alert('Error - ' + xhr.status + ': ' + xhr.statusText);
   });
 
  });
});

</script>
</head>
  
	<body>
	  <h1>Sonia's Book Reads</h1>
		  <a href="alpha" class="category">Book's are in alphabetical order by author's last name</a> 
      <br/>
     <a href="rating" class="category">Book's are in order by rating</a>

		<h3 id="booktitle">Title Will Go Here</h3>
		<div id="books"></div>
    
		<div id="output">Results go here</div>
    
	</body>
</html>




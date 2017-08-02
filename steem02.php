<html>
<head>
<script src="//cdn.steemjs.com/lib/latest/steem.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<script>
steem.api.getState('@junn', function(err, result){
	console.log("Account:junn", result);
});
steem.api.getState('/hot/steem', function(err, result){
	console.log("Tag/hot:steem", result);
	console.log("Contents",result.content);
	
	var html_body = '';
	for(key in result.content)
	{
	 	if (result.content.hasOwnProperty(key)) 
	 	{
		 	article = result.content[key];
		 	console.log(key,article);
		 	html_body = html_body + "<b>" + article.author + "</b>&nbsp;" + article.title + "<br/>";
	 	}
	}
	$('#contents').html(html_body);
});
</script>
<div id="contents">Example</div>
</body>
</html>


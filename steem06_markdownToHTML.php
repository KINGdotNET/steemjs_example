<?php
	global $_GET;
	$id = isset($_GET['id'])?$_GET['id']:'';
	$permlink = isset($_GET['permlink'])?$_GET['permlink']:'';
?>
<html>
<head>
<script src="/jquery-3.3.1.min.js"></script>
<script src="https://cdn.rawgit.com/showdownjs/showdown/1.8.6/dist/showdown.min.js"></script>
<script src="//cdn.steemjs.com/lib/latest/steem.min.js"></script>
<style>
#contents
{
	display: block;
	margin: auto;
	width: 800px;
	max-width: 800px;
}
img
{
	max-width: 800px;
}
</style>
</head>
<body>
<div style="width:100%">
<center>
<form action='#'>
ID : <input type="text" name="id">
Permlink : <input type="text" name="permlink">
<input type="hidden" name="cmd" value="search">
<input type="submit" value="Submit">
</form>
<div id="head">Example <?=$id?>/<?=$permlink?></div>
<div id="contents"></div>
<?php
	
	if($_GET['cmd'] == 'search' && isset($id) && isset($permlink))
	{
	?>
		<script>
		function changeYouTubeTag( html ) {
        return html.replace(/https:\/\/youtu.be\/([\w]*)/gi, '\<p\>\<iframe wdith="420" height="315" src="https:\/\/www.youtube.com\/embed\/$1"\>\<\/iframe\>\<\/p\>');
		}

		function imageSetting(html)
		{
			var html_change = html;
			var regex = /(<([^>]+)>)/ig
			var result = html_change.replace(regex, "");
			
			regex = /(https?:\/\/.*\.(?:png|jpg|jpeg))/ig;
			var arrMatch = result.match(regex);
			if(arrMatch != null)
			{
				console.log(arrMatch);
				for(var i=0;i<arrMatch.length;i++)
				{
					re = new RegExp(arrMatch[i], "g");
					html_change = html_change.replace(re,"<img src='"+arrMatch[i]+"'/>");	
					if(i!=arrMatch.lenght-1)
					{
						for(var j=i+1;j<arrMatch.length;j++)
						{
							if(arrMatch[j]==arrMatch[i])
							{
							arrMatch.splice(j,1);
						}
					}
					}
				}
			}
			return html_change;
		}
		jQuery(document).ready(function($) 
		{
			var author = "<?=$id?>";
			var permlink = "<?=$permlink?>";
			steem.api.getContent(author,permlink, function(err, response)
			{
			    console.log("Content", response);
			    var converter = new showdown.Converter({
					'tables':true,
					'strikethrough':true,
					'simpleLineBreaks':true,
					'simplifiedAutoLink':true
				});
			    var text = response.body,
    			html_body = converter.makeHtml(text);
    			html_body = changeYouTubeTag(imageSetting(html_body));
   				$('#contents').html(html_body);
			});
		});
		</script>
	<?php
	}
?>
</center>
</div>
</body>
</html>
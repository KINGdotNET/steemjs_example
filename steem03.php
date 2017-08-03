<html>
<head>
<script src="//cdn.steemjs.com/lib/latest/steem.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<script>
var last_author = '';
var last_permlink = '';
var nrows = 10;
var last_body = '';
var button_html = "<input type='button' value='click' onclick='getNeckPage()'/>";
//$('#contents').html(html_body);
function getPage()
{
  query = {
      tag: "kr",
      limit: nrows+1
  };
  
  steem.api.getDiscussionsByCreated(query, function(err, result) {
    console.log(err, result);
    last_author = result[nrows].author;
    last_permlink = result[nrows].permlink;
    for(var i=0;i<nrows;i++)
    {
      article = "" + (i+1) + "&nbsp;" + "<b>" + result[i].author + "</b>&nbsp;" + result[i].title + "<br/>";
      contents = $('#contents').html();
      $('#contents').html(contents + article);
    }
    last_body = $('#contents').html();
    $('#contents').html(last_body + button_html);
  });
}
function getNeckPage()
{
    query = {
      tag: "kr",
      limit: nrows+1, //Last article => only for neck page loading
      start_author : last_author,
      start_permlink : last_permlink
    }; 
    steem.api.getDiscussionsByCreated(query, function(err, result) {
    console.log(err, result);
    last_author = result[nrows].author;
    last_permlink = result[nrows].permlink;
    $('#contents').html(last_body);
    for(var i=0;i<nrows;i++)
    {
      article = "" + (i+1) + "&nbsp;" + "<b>" + result[i].author + "</b>&nbsp;" + result[i].title + "<br/>";
      contents = $('#contents').html();
      $('#contents').html(contents + article);
    }
    last_body = $('#contents').html();
    $('#contents').html(last_body + button_html);
  });

}
$( document ).ready(function() {
  $('#contents').html('');
  getPage();
});

</script>
<div id="contents">Example</div>
</body>
</html>


<html>
<head>
<script src="//cdn.steemjs.com/lib/latest/steem.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<script>
function getPage()
{
  query = {
      tag: "kr",
      limit: 11
  };
  
  steem.api.getDiscussionsByCreated(query, function(err, result) {
    console.log(err, result);  
    query2 = {
      tag: "kr",
      limit: 11, //Last article => only for neck page loading
      start_author : result[10].author,
      start_permlink : result[10].permlink
    }; 
    steem.api.getDiscussionsByCreated(query2, function(err, result) {
      console.log(err, result);  
    }
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


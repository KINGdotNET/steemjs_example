<html>
<head>
<!--steem.min.js file is not needed in this example-->
<script src="//cdn.steemjs.com/lib/latest/steem.min.js"></script>

<script src="https://cdn.steemjs.com/lib/latest/steemconnect.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<script>
$( document ).ready(function() {
  steemconnect.init({
    app: 'junn',
    callbackURL: 'http://junn.in/steem04_sub.php'
  });
   
  steemconnect.isAuthenticated(function(err, result) {
  	console.log(err,result);
    if (!err && result.isAuthenticated) {
      window.opener.document.location.reload(true);       //Reload Opener Page
      window.close();                                     //Close this page
    }
  });
});
</script>
</body>
</html>

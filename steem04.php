<!-- This example was based on example of https://github.com/busyorg/steemconnect -->
<html>
<head>
<!--steem.min.js file is not needed in this example-->
<script src="//cdn.steemjs.com/lib/latest/steem.min.js"></script>
<script src="https://cdn.steemjs.com/lib/latest/steemconnect.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<script>
var loginURL = '';
var appName = 'junn';

$( document ).ready(function() {
  steemconnect.init({
    app: 'junn',
    callbackURL: 'http://junn.in/steem04_sub.php'
  });
  var isAuth = false;
  loginURL = steemconnect.getLoginURL();
  console.log("loginURL",loginURL);

  steemconnect.isAuthenticated(function(err, result) {
  	console.log(err,result);
    if (!err && result.isAuthenticated) {
      isAuth = true;
      var username = result.username;
      console.log("logged in");
      $('#status').html("App[" + appName + "]: " + "<b>" + username +"</b>&nbsp;" + "<a href=\"https://steemconnect.com/logout\">Log Out</a>");
    }
  });
});
function redirect() {
    window.open(loginURL,"","direction=no, location=no, menubar=no, scrollbars=no, status=yes, toolbar=no, resizeble=no, width=400, height=500");

}
</script>
<div id="status">
<a href="#" onClick="redirect()">Log In</a>
</div>
</body>
</html>

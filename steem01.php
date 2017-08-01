<html>
<head>
<script src="//cdn.steemjs.com/lib/latest/steem.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<script>
steem.api.getAccounts(['junn','bramd'], function(err, response){
    console.log(err, response);
    var itsme = JSON.parse(response[0].json_metadata);	//response[0] = junn, response[1] = bramd
    console.log("it's me",itsme);
    $('#contents').html(itsme.profile.about +  " " + itsme.profile.location);
});
    
</script>
<div id="contents">Example</div>
</body>
</html>
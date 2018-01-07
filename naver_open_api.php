<?php
	/*** 로그인 부분 ***/
	$client_id = "0pV03YSGMoL9r4Qc6G5J";	//앱 생성시 할당
	$redirectURI = urlencode(/* 콜백 페이지 주소 : http://~~~/callback.php */);
  	$state = "RAMDOM_STATE";
  	$apiURL = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".$client_id."&redirect_uri=".$redirectURI."&state=".$state;
?>
<a href="<?php echo $apiURL ?>"><img height="50" src="http://static.nid.naver.com/oauth/small_g_in.PNG"/></a>

<?php

/*** Callback 함수 ***/
  $client_id = "0pV03YSGMoL9r4Qc6G5J";
  $client_secret = /****** Secret Code ********/;
  $code = $_GET["code"];
  $state = $_GET["state"];
  $redirectURI = urlencode("naver_callback.php");	/* 동일한 주소?? */
  $url = "https://nid.naver.com/oauth2.0/token?grant_type=authorization_code&client_id=".$client_id."&client_secret=".$client_secret."&redirect_uri=".$redirectURI."&code=".$code."&state=".$state;
  $is_post = false;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $headers = array();
  $response = curl_exec ($ch);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close ($ch); 
  $res = json_decode($response);
  if($status_code == 200) {
    if(isset($res->token_type) && $res->token_type=='bearer')
    {
      echo "인증 또는 토큰 갱신에 성공함<br/>";
      setcookie("access_token",$res->access_token);
    }
    
  } else {
    echo "Error 내용:".$response;
    echo $res->message;
  }
?>

<?php
/***** 로그아웃 페이지 *******/
if(isset($_COOKIE["access_token"]) && strlen($_COOKIE['access_token'])>0)
{
	$access_token = $_COOKIE['access_token'];
	$service_provider = "NAVER";
	$client_id = "0pV03YSGMoL9r4Qc6G5J";
    $client_secret = /***********/;
   	$grant = 'delete';
   	$redirectURI = urlencode("naver_logout.php");
   	$url = "https://nid.naver.com/oauth2.0/token?grant_type=".$grant."&client_id=".$client_id."&client_secret=".$client_secret."&redirect_uri=".$redirectURI."&access_token=".$access_token."&service_provider=".$service_provider;
   	$is_post = false;
   	$ch = curl_init();
  	curl_setopt($ch, CURLOPT_URL, $url);
  	curl_setopt($ch, CURLOPT_POST, $is_post);
  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  	$headers = array();
  	$response = curl_exec ($ch);
  	$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  	curl_close ($ch); 
  	echo "curl end";
  	echo $status_code;
  	if($status_code == 200) {
    	echo "Success";   
    $res = json_decode($response); 
    if(isset($res->result) && $res->result=='success')
    {
      echo "토큰 삭제<br/>";
    }
    
  } 
  else 
  {
    echo "Error 내용:".$response;
  }
  unset($_COOKIE['access_token']);
  setcookie('access_token', "", time()-3600);
}
else
{
	echo "이미 토큰이 없습니다.";
	?>
	
	<?php
}
?>


<?php

/** 사용자 정보 가져오는 부분 **/
$client_id = "0pV03YSGMoL9r4Qc6G5J";
$client_secret = "********";
$access_token = $_COOKIE['access_token'];

$ch = curl_init();
curl_setopt_array($ch, array(
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_URL => 'https://openapi.naver.com/v1/nid/me',
	CURLOPT_HTTPHEADER => array('Authorization: Bearer ' . $access_token)
	)
);

$response = curl_exec ($ch);
curl_close ($ch); 
$res = json_decode($response);
echo $res->response->email;

?>

<?php
/***** 블로그에 글 쓰기 ******/

$title = urlencode($export_article['title']);
$contents = urlencode(preg_replace("/\<br\/\>/", "<p> </p>", $export_article['body']));
$access_token = $_COOKIE['access_token'];

$header = "Bearer ".$access_token;
$postvars = "title=".$title."&contents=".$contents;
$url = "https://openapi.naver.com/blog/writePost.json";
$is_post = true;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, $is_post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_POSTFIELDS, $postvars);
$headers[] = "Authorization: ".$header;
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec ($ch);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
echo "<p>status_code:".$status_code."</p>";
curl_close ($ch);
if($status_code == 200) 
{
    $res = json_decode($response);
} 
else 
{
	echo "Error 내용:".$response."<br/>";
}

?>



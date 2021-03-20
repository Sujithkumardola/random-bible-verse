<?php
function callAPI($method, $url, $data){
   $curl = curl_init();
   switch ($method){
      case "POST":
         curl_setopt($curl, CURLOPT_POST, 1);
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         break;
      case "PUT":
         curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
         break;
      default:
         if ($data)
            $url = sprintf("%s?%s", $url, http_build_query($data));
   }
   // OPTIONS:
   curl_setopt($curl, CURLOPT_URL, $url);
   curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'APIKEY: 111111111111111111111',
      'Content-Type: application/json',
   ));
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
   // EXECUTE:
   $result = curl_exec($curl);
   if(!$result){die("Connection Failure");}
   curl_close($curl);
   return $result;
}
$url="https://beta.ourmanna.com/api/v1/get/?format=text&order=random";
$resp=callAPI('GET',$url,false);
?>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<body id="g">
<style>
#g {
background: rgb(2,0,36);
background: -moz-linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(109,109,224,1) 0%, rgba(0,212,255,1) 100%);
background: -webkit-linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(109,109,224,1) 0%, rgba(0,212,255,1) 100%);
background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(109,109,224,1) 0%, rgba(0,212,255,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#020024",endColorstr="#00d4ff",GradientType=1);
}
#text {
color:white;
text-align:center;
margin-top:50%;
font-size:150%;
}
</style>
<p id="text"><?php echo $resp; ?></p>
<script>
function myFunction() {
  location.reload();
}
</script>
<br>
<br>
<br>
<p id="text" ontouchstart="myFunction()">Touch here to get new verse.</p>
</body>
</html>


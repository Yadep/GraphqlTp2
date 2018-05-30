<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form method="get" id="nameform">
          Utilisateur : <input type="text" name="githublog"><br>
        </form>
        <button type="submit" form="nameform" value="Submit">Submit</button>
 
<?php 
if(isset($_GET['githublog']))
{
$login = $_GET['githublog'];
//GRAPHQL request
$query = <<<'JSON'
query{
   user(login:"Yadep") {
       name
   }
}
JSON;
$variables = '';

$json = json_encode(['query' => $query, 'variables' => $variables]);

$chObj = curl_init();
curl_setopt($chObj, CURLOPT_URL, "https://api.github.com/graphql");
curl_setopt($chObj, CURLOPT_RETURNTRANSFER, true);    
curl_setopt($chObj, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($chObj, CURLOPT_HEADER, true);
curl_setopt($chObj, CURLOPT_VERBOSE, true);
curl_setopt($chObj, CURLOPT_POSTFIELDS, $json);
curl_setopt($chObj, CURLOPT_HTTPHEADER,
     array(
            'User-Agent: PHP Script',
            'Content-Type: application/json;charset=utf-8',
            'Authorization: bearer 723a5d818bcec7aca4ed27ed1034e40cabba5937' 
        )
    ); 

$response = curl_exec($chObj);
echo curl_error($chObj);
echo $response;


}
?>
    </body>
</html>


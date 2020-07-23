<?php
/*
* Created By pcardot@cisco.  from an example created by dhenwood@cisco.com
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*
* open the [ debug.txt ] file in order to check dialog between this script and you bot
*/

//error STOP uncomment here to stop the script in case of a loop

// Set room_id : of the room thru which you communicate with your BOT
$the_room_id="<Room_ID>";
// Set the BOT Webex Token
$accesstoken = '<Bot_Webex_Token>';


$file='debug.txt';
$fd = @fopen($file,"a+");
// Get Webhook POST data and extract Webhook ID
$postdata = file_get_contents("php://input");
$jsonPost = json_decode($postdata,true);
$jsonData = $jsonPost["data"]["id"];
 
// Set variables. The accesstoken is taken from developer.ciscospark.com
//$url = 'https://api.ciscospark.com/v1/messages/'.$jsonData; // old
$url = "https://webexapis.com/v1/messages".$jsonData;	

 
// Set HTTP POST headers
$headr = array();
$headr[] = 'Content-type: application/json';
$headr[] = 'Authorization: Bearer '.$accesstoken;



// 
$replied_message="";

 
echo 'GET MESSAGE<br>'; 
// Send HTTP GET to obtain text message
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER,$headr);
curl_setopt($ch, CURLOPT_HTTPGET,true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$response = curl_exec($ch);
curl_close($ch);
 
// Extract the text message and who posted the message
echo 'extract MESSAGE<br>';
fputs($fd,'extract MESSAGE');
fputs($fd,"\r\n");  
fputs($fd,$response);
fputs($fd,"\r\n");  
$result = json_decode($response);
$messageData = trim($result->{'text'});
$messageUser = $result->{'personEmail'};
echo 'MESSAGE : '.$messageData.'<br>';
fputs($fd,'MESSAGE :');
fputs($fd,"\r\n");  
fputs($fd,$messageData);
fputs($fd,"\r\n");
// Define a string we will listen for and do something with
if($messageData=="ping")
{
	fputs($fd,'In the ping loop');
	fputs($fd,"\r\n"); 
	$replied_message="Yeah !! I received your ping message !";

	fputs($fd,'Message sent');
	fputs($fd,"\r\n"); 	
}
else if((stripos($messageData,"ping")!=false)&&(stripos($messageData,"bot:")!=false))
{
	$replied_message="PONG : [ Action for the BOT. An example of hyper link ](http://www.google.com)";

}
else if ((stripos($messageData,"hello")!=false)&&(stripos($messageData,"bot:")!=false))
{
	$replied_message="Hi Man, How are you ?";
}
else if ((stripos($messageData,"m fine")!=false)&&(stripos($messageData,"bot:")!=false))
{
	$replied_message="Perfect !";
}
else if ($messageData === "I don't understand this")
{
	$replied_message="";
}
else 
{
	$replied_message="I don't understand this";
}

if($replied_message!="")
{
	fputs($fd,'message to send = ');
	fputs($fd,$replied_message); 
	fputs($fd,"\r\n"); 	
	//$url1 = "https://api.ciscospark.com/v1/messages";	  // old
	$url1 = "https://webexapis.com/v1/messages";	 
	$data = array("roomId" => $the_room_id, "markdown" => $replied_message);
	$data_string = json_encode($data);
	fputs($fd,'Reply orchestration to BOT: ');
	fputs($fd,$replied_message);
	fputs($fd,"\r\n");  
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url1);
	curl_setopt($ch, CURLOPT_HTTPHEADER,$headr);
	curl_setopt($ch, CURLOPT_POST,true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$response = curl_exec($ch);
	curl_close($ch);
	fclose($fd);
	$replied_message="";
}

echo 'OK';

?>
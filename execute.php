<?php
$content = file_get_contents("php://input");
$update = json_decode($content, true);
if(!$update)
{
  exit;
}

$message = isset($update['message']) ? $update['message'] : "";
$messageId = isset($message['message_id']) ? $message['message_id'] : "";
$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
$firstname = isset($message['chat']['first_name']) ? $message['chat']['first_name'] : "";
$lastname = isset($message['chat']['last_name']) ? $message['chat']['last_name'] : "";
$username = isset($message['chat']['username']) ? $message['chat']['username'] : "";
$date = isset($message['date']) ? $message['date'] : "";
$text = isset($message['text']) ? $message['text'] : "";
$text = trim($text);
$text = strtolower($text);
header("Content-Type: application/json");
$response = '';

$canSee=false;
if($username=="AldoTKOL")
{
	$canSee=true;
}
if($canSee){
	if(strpos($text, "/start") === 0 || $text=="ciao")
	{
		$response = "Ciao $firstname, benvenuto!";
	}elseif($text=="/gran_sasso")
	{
		$response="Corno Grande (Gran Sasso) \n Percorso (Via normale) : \n https://it.wikiloc.com/wikiloc/view.do?id=7568156 \n";
		$response.="GPX : https://www.dropbox.com/s/d70aqe4pa3t8suo/corno-grande-gran-sasso.gpx?dl=0";
	}elseif($text=="/pizzo_cefalone"){
		$response="Pizzo Cefalone (Gran Sasso) \n Percorso : \n https://it.wikiloc.com/wikiloc/view.do?id=2097708 \n ";
		$response.="GPX : https://www.dropbox.com/s/7ig0lftqz25mx1g/pizzo-cefalone.gpx?dl=0";
	}elseif($text=="/crepacuore"){
		$response="Monte Crepacuore \n Percorso : \n https://it.wikiloc.com/wikiloc/view.do?id=4446637 \n ";
		$response.="GPX : https://www.dropbox.com/s/kg02mijfgn7gqom/monte-crepacuore.gpx?dl=0";
		/*CROCE DI MONTE GIANO E MONTE GIANO (fino al luogo incidente aereo)
		https://it.wikiloc.com/wikiloc/view.do?id=15938598
		monte-giano-incidente.gpx
		
		Rendinara, Monte Ginepro
		https://it.wikiloc.com/wikiloc/view.do?id=10937652
		
		*/
	}elseif($text=="/cima_zappi"){
		$response="Monte Gennaro - Cima Zappi \n Percorso : \n https://it.wikiloc.com/wikiloc/view.do?id=4434079 \n";
		$response.="GPX : https://www.dropbox.com/s/8vvt7cfwgk4x43e/monte-gennaro-da-palombara-sabina.gpx?dl=0";
	}else
	{
		$response = "Comando non valido!";
	}
}
else
{
	$response="Ciao $firstname\nMi spiace ma il tuo username ($username) non è autorizzato a consultare il bot.";
}
$parameters = array('chat_id' => $chatId, "text" => $response);
$parameters["method"] = "sendMessage";
echo json_encode($parameters);

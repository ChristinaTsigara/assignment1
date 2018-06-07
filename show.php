<?php
require 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use GuzzleHttp\Client;

$log = new Logger('Assignment 1');
$log->pushHandler(new StreamHandler('greetings.log', Logger::INFO));

$client = new Client(['headers' => ['Accept' => 'application/json']]);

$id = $_GET['id'];
$res = $client->request('GET', 'http://unicorns.idioti.se/'.$id);

$jsondata = $res->getBody();
//echo $jsondata;

$data = json_decode ($res->getBody());


?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Unicorns</title>
  </head>
  <body>

  <p><?php echo $data->name; ?><p/>
<p><img src="<?php echo $data->image; ?>"/><p/>
<p><?php echo $data->spottedWhen; ?> <p/>
<p><?php echo $data->description; ?><p/>
<p><?php echo $data->reportedBy; ?><p/>
  </body>
</html>

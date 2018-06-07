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
    <title></title>
  </head>
  <body>

  <p><?php echo $data->name; ?>  <p/>
<img src="<?php echo $data->image; ?>"/>
<?php echo $data->spottedWhen; ?>
<?php echo $data->description; ?>
<?php echo $data->reportedBy; ?>
  </body>
</html>

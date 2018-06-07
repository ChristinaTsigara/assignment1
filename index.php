<?php
require 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use GuzzleHttp\Client;

$log = new Logger('Assignment 1');
$log->pushHandler(new StreamHandler('greetings.log', Logger::INFO));

$client = new Client(['headers' => ['Accept' => 'application/json']]);

$res = $client->request('GET', 'http://unicorns.idioti.se/');

$jsondata = $res->getBody();
echo $jsondata;

$data = json_decode ($res->getBody());

//foreach ($data as $unicorn) {
//  echo $unicorn->id."<br>";
//  echo "<a href='/show.php/?id=".$unicorn->id."'>".$unicorn->name."</a>";
//}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
  <?php foreach ($data as $unicorn): ?>
    <br>
    <a href='/show.php/?id=<?php echo $unicorn->id; ?>'><?php echo $unicorn->name; ?></a>

  <?php endforeach; ?>
  </body>
</html>

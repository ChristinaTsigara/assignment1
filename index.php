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
//echo $jsondata;

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
    <title>Unicorns</title>
      <link href="style.css" rel="stylesheet">
  </head>
  <body>
    <div class="form-group row">
      <div class="col-md-12">
        <header><h1>Enhörningar</h1></header>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-2">
        <label for="">Id på enhörning</label>
      </div>
      <div class="col-md-10">
        <input type="text" step="any" name="name" value="" required>
      </div>
    </div>
    <input button class="button showunicorn" type="submit" name="submit" value="Visa enhörning"></button>


    <input button class="button showallunicorns" type="submit" name="submit" value="Visa alla enhörningar"></button>

    <div class="row">
      <div class="col-md-10">
        <h2>Alla enhörningar</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-10">
        <?php foreach ($data as $unicorn): ?>
          <br>
          <?php echo $unicorn->id; ?> : <?php echo $unicorn->name; ?>
          <a href='/show.php/?id=<?php echo $unicorn->id; ?>'><input button class="button readmore" type="submit" name="submit" value="Läs mer"></button></a>
        <?php endforeach; ?>
      </div>
    </div>




  </body>
</html>

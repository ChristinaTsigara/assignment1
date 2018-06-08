<?php
require 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use GuzzleHttp\Client;

$log = new Logger('Assignment 1');
$log->pushHandler(new StreamHandler('visits.log', Logger::INFO));
$log->info('Requested info about all unicorns ');

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
      <link href="/style.css" rel="stylesheet">
  </head>
  <body>
    <div class="form-group row">
      <div class="col-md-12">
        <header><h1>Enhörningar</h1></header>
      </div>
    </div>




  <form action="/show.php" method="get" class="form-inline">
<label for="id">ID på enhörning: </label>
<input type="number" step="1" id="id" name="id" class="form-control" required value="">
<input button class="button showunicorn" type="submit" name="submit" value="Visa enhörning"></button>
<a href='/index.php'><input button class="button showallunicorns" type="submit" name="submit" value="Visa alla enhörningar"></button></a>
</form>




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

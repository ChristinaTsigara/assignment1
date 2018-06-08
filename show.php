<?php
require 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use GuzzleHttp\Client;

$log = new Logger('Assignment 1');
$log->pushHandler(new StreamHandler('visits.log', Logger::INFO));
$log->info('Requested info about: unicornId = '.$_GET['id']);



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

  <p><b><?php echo $data->name; ?></b><p/>
  <p><img src="<?php echo $data->image; ?>"/><p/>
  <p><?php echo $data->spottedWhen; ?> <p/>
  <p><?php echo $data->description; ?><p/>
  <p><em>Rapporterad av: </em><?php echo $data->reportedBy; ?><p/>
  </body>
</html>

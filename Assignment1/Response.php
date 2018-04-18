<?php
require 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$client = new \GuzzleHttp\Client();
$header = ['headers' => ['Accept' => 'application/json']];
$id = $_GET['id'];

$log = new Logger('User');
$log->pushHandler(new StreamHandler('Info.log', Logger::INFO));

$res = $client->request('GET', 'http://unicorns.idioti.se/' .$id, $header);
$data = json_decode($res->getBody());

$log->info('Requested: '. $data->{'name'});
?>

<html>
<head>
    <title>Example form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <form action="Response.php" method="get">
            <div class="form-group">
                <label for="id">ID Number: </label>
                <input type="text" id="id" name="id" class="form-control">
            </div>

            <div class="form-group">
                <input type="submit" value="Get unicorn!" class="btn btn-success">
            </div>
        </form>
        <form action="index.php">
            <div class = "form-group">
                <input type ="submit" value="Show All Unicorns" class ="btn btn-success">
            </div>
    </div>
<h1><?php echo $data->{'name'}; ?></h1>
<div>
    <img src="<?php echo $data->{'image'};?>">
    <h3><?php echo $data->{'spottedWhen'};?></h3>
    <br><?php echo $data->{'description'}; ?></br>
    <br><strong>Found by:</strong> <?php echo $data->{'reportedBy'}; ?></br>
</div>
</body>
</html>


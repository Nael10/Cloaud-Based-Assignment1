<?php

require 'vendor/autoload.php';

$client = new \GuzzleHttp\Client();
$header = ['headers' => ['Accept' => 'application/json']];

$res = $client -> request('GET', 'http://unicorns.idioti.se', $header);


$data = json_decode($res->getBody());

?>


<!doctype html>
<html>
    <head>
        <title>Example form</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <h1>Unicorn database</h1>
            <p>Please write in a unicorn ID</p>
            <form action="Response.php" method="get">
                <div class="form-group">
                    <label for="id">ID Number: </label>
                    <input type="text" id="id" name="id" class="form-control">
                </div>

                <div class="form-group">
                    <input type="submit" value="Get unicorn!" class="btn btn-success">
                </div>
            </form>
        </div>
        <div class="container">
        <?php
        foreach($data as $key)
        {
            echo '<div class = "row" style:"position: absolute;">';
            echo $key->{'id'} .'. ';
            echo $key->{'name'};
            echo '<input type="button" style = "float:right" class="btn btn-outline-primary" value="Read more" onclick="window.location.href=\'Response.php?id='.$key->{'id'}.'\'"/>'; 
            echo '</div>';
        }
        ?>
        </div>

    </body>
</html>

<?php

?>

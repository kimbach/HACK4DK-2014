<?php

$from = DateTime::createFromFormat("d-m-Y", "01-05-1982");
$to = DateTime::createFromFormat("d-m-Y", "01-03-1990");


echo $from->format("Y-m-d H:i:s"), "\n";
echo ($from < $to ? "true" : "false");
echo "\n";
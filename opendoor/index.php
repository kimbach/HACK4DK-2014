<?php

// $queries = $_GET;
// var_dump($queries);

// require("lib/simple_html_dom.php");

$dom = new DOMDocument();
@$dom->loadHTMLFile("./repos.html");

$command =  "$(document).on('musefinished', function(){";
$command .= 	'$("#U296_animation").contents().find("#Stage_DOOR_SIGN").text("' . $_GET["hey"] . '");';
$command .= "});";

$body = $dom->getElementsByTagName("body");
$body = $body->item(0);
$newEle = $dom->createElement("script");

$newEle->nodeValue = $command;
$body->appendChild($newEle);

echo $dom->saveHTML();

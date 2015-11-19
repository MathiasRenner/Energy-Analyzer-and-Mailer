<?php

include_once "swiftmailer/lib/swift_required.php";

$subject = 'Hello from Max, PHP!';
$from = array('raab.maximilian@live.com' =>'Max Raab');
$to = array(
    'raab.maximilian@gmail.com'  => 'Max'
# ,
  #  'recipient2@example2.com' => 'Recipient2 Name'
);

$text = "Mandrill speaks plaintext";
$html = "<h2> hallo <h2> ";

$transport = Swift_SmtpTransport::newInstance('smtp-mail.outlook.com', 587, 'tls');
$transport->setUsername('xxxx@live.com');
$transport->setPassword('xxxx;');

$swift = Swift_Mailer::newInstance($transport);

$message = new Swift_Message($subject);
$message->setFrom($from);
//$message->setBody($html, 'text/html');

include ("jpgraph/src/jpgraph.php");
include ("jpgraph/src/jpgraph_line.php");

$ydata = array(11,3,8,12,5,1,9,13,5,7);
$ydata2 = array(1,19,15,7,22,14,5,9,21,13);

$graph = new Graph(300,200,"auto");
$graph->SetScale("textlin");

$lineplot=new LinePlot($ydata);

$lineplot2=new LinePlot($ydata2);

$graph->Add($lineplot);
$graph->Add($lineplot2);

$graph->img->SetMargin(40,20,20,40);
$graph->title->Set("Example 4");
$graph->xaxis->title->Set("X-title");
$graph->yaxis->title->Set("Y-title");

$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

$lineplot->SetColor("blue");
$lineplot->SetWeight(2);

$lineplot2->SetColor("orange");
$lineplot2->SetWeight(2);

$graph->yaxis->SetColor("red");
$graph->yaxis->SetWeight(2);
$graph->SetShadow();

$graph->Stroke('dummy.png');


// If placing the embed() code inline becomes cumbersome
// it's easy to do this in two steps
$cid = $message->embed(Swift_Image::fromPath('dummy.png'));

$message->setBody(
    '<html>' .
    ' <head></head>' .
    ' <body>' .
    '  Here is an image <img src="' . $cid . '" alt="Image" />' .
    '  Rest of message' .
    ' </body>' .
    '</html>',
    'text/html' // Mark the content-type as HTML
);

$message->setTo($to);
$message->addPart($text, 'text/plain');



echo $message->toString();
if ($recipients = $swift->send($message, $failures))
{
    echo 'Message successfully sent!';
} else {
    echo "There was an error:\n";
    print_r($failures);
}



?>
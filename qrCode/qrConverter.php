<?php
require("../vendor/autoload.php");

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

$text = $_GET["text"] ?? 'Default QR text';
$qr_code = new QrCode($text);
    

$writer = new PngWriter;

$result = $writer->write($qr_code);

header('Content-Type: ' . $result->getMimeType());
echo $result->getString();

?>
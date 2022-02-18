<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/ld+json; charset=UTF-8");

include_once("../src/model/DataAccess.php");
include_once("../src/model/air_quality.php");

if (!isset($data))
{
    $data = new DataAccess();
}

$quality = $data->air_quality();

if ($quality)
{
    // Return HTTP Status
    $status = 200;
    header_remove();
    http_response_code($status);
    header('Content-Type: application/json');
    header('Status: '.$status);

    echo getSemanticMarkup($quality);
} else {

    // Response Not Found
    http_response_code(404);

    echo json_encode(array("message" => "No air quality data found."));
}


// Using " to open and close the strings was causing issues with JSON - changed to ' instead
function getSemanticMarkup($response)
{

    // Assign the correct contexts for use in RDF
    $SemanticResult = '{ 
    "@context" : { 
        "Place" : "http://schema.org",
         "aq" : "http://web.socem.plymouth.ac.uk",
         "address" : "https://schema.org/PostalAddress",
         "description" : "https://schema.org/description",
         "area" : "https://schema.org/addressLocality",
         "postcode" : "https://schema.org/postalCode",
         "geo" : "https://schema.org/GeoCoordinates",
         "latitude": {
            "@id" : "https://schema.org/latitude",
            "@type" : "https://schema.org/Number"
         },
         "longitude": {
            "@id" : "https://schema.org/longitude",
            "@type" : "https://schema.org/Number"
         },
         "pm2.5": {
            "@id": "https://schema.org/Quantity",
            "@type": "https://schema.org/Number"
         }
         },
         
         
         "Place" : [ ';

    foreach($response as $aq)
    {
        $SemanticResult .= '{ "@type" : "Place",
                
                "name" : "' . $aq->getName() . '",
                "type" : "' . $aq->getType() . '",
                
                "address" : {
                    "@type" : "PostalAddress",
                    "area" : "'. $aq->getTown() .'",
                    "addressRegion": "Devon",
                    "streetAddress" : "'. $aq->getAddress() .'",
                    "postalCode" : "'. $aq->getPostcode() .'"},
                    
                "geo": {
                    "latitude" : '. $aq->getLat() .',
                    "longitude" : '. $aq->getLng() .'
                 },
                "pm2.5" : "' . $aq->getPm25() .'",
                "exceed10" : "' . $aq->getExceed10() . '"
                
                },';
    }

    // remove the trailing comma from the end to properly format the RDF
    $SemanticResult = substr($SemanticResult, 0, -1);
    $SemanticResult .= ']}';

    return $SemanticResult;
}

function returnJson($response, $status)
{
    header_remove();
    http_response_code($status);
    header('Content-Type: application/json');
    header('Status: '.$status);

    return json_encode(array("status" => $status, "message" => $response));
}



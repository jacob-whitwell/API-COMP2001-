<?php
$page_title = "Air Quality Plymouth | Data";
include_once('header.php');
include_once('../src/model/DataAccess.php');
include_once('../src/model/air_quality.php');


if (!isset($data))
{
    $data = new DataAccess();
}

$coords = [];

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <table class="table table-striped table-bordered" style="margin-top: 70px; margin-bottom: 200px;">
                    <thead class="bg-secondary text-white">
                    <tr>
                        <th>Name</th>
                        <th>Area</th>
                        <th>Location Type</th>
                        <th>Fine Particulate matter (PM<sub>2.5</sub>)</th>
                        <th>Exceeds 10</th>
                        <th>Geolocation</th>
                    </tr>
                    </thead>
                    <tbody class="border-success">
                <?php

                        // get air_quality from DataAccess to utilise in our table
                        $loc = $data->air_quality();

                        $HTML = "";

                        if ($loc) {
                            foreach ($loc as $locations) {
                                //echo nl2br("getTown: ". $locations->getTown() . "\r\ngetPm25: " . $locations->getPm25() . "\r\n getExceed10: " . $locations->getExceed10() . "\r\ngetLat: " . $locations->getLat() . "\r\ngetLng: " . $locations->getLng() . "\r\n\r\n");

                                $HTML .= "<tr>";

                                // TH: Name
                                //$HTML .= "<td><a href='" . $locations->getMapURL() . "' target=\"_blank\">" . $locations->getName() . "</a></td>";

                                // TH: Town
                                $HTML .= "<td><a href='#' onclick='moveTo(" . $locations->getLat() . ", " . $locations->getLng() . ")'>" . $locations->getName() . "</a></td>";

                                // TH: Area
                                $HTML .= "<td>" . $locations->getTown() . "</td>";

                                // TH: Type
                                $HTML .= "<td>" . $locations->getType() . "</td>";

                                // TH: PM2.5
                                $HTML .= "<td>".$locations->getPm25()."</td>";

                                // TH: Exceed 10
                                $HTML .= "<td>" . strtolower($locations->getExceed10()) . "</td>";

                                // TH: Lat/lng
                                $HTML .= "<td>" . $locations->getLat() . ", " . $locations->getLng() . "</td>";




                                $HTML .= "</tr>";


                                // Grab the latitude, longitude, name and PM2.5 to show in the pins
                                $coords [] = [$locations->getLat(), $locations->getLng(), $locations->getName(), $locations->getPm25()];

                            }
                        }
                        echo $HTML;
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="map-container col-sm-6" style="text-align:center; margin-top: 80px;">
                <div id="map" style="height: 50vh; width:49%; position: fixed">
                    <script>
                        var map = L.map('map').setView([50.375406, -4.138342], 13);

                        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                            maxZoom: 18,
                            id: 'mapbox/streets-v11',
                            tileSize: 512,
                            zoomOffset: -1,
                            accessToken: 'pk.eyJ1IjoiamFjb2J3aGl0d2VsbCIsImEiOiJja3libjExazQwZ3V5MnVvZG13bG04YjQzIn0.3NJ-lFHkgnpxhyOCC4c30g'
                        }).addTo(map);


                        var coord = <?= json_encode($coords, JSON_PRETTY_PRINT) ?>

                        coord.forEach(createPins);


                        // Get the pins to add to the map
                        function createPins(item)
                        {
                            var marker = L.marker([item[0], item[1]]).addTo(map).bindPopup("<b>"+item[2]+"</b><br>PM2.5: "+item[3]);

                        }


                        function moveTo(lat, lng)
                        {
                            map.panTo(new L.LatLng(lat, lng));
                        }
                    </script>
                </div>
                <div class="map-text-container justify-content-center" style="position: fixed; margin-top: 55vh;">
                    <div class="map-text">
                        <h3>Air Quality in Plymouth</h3><br><br>

                        <p>Please note: You may click on the names in the Name column to be shown the location on the map</p>
                        <p>You may also click on the pins on the map to see the PM2.5 data for easier use.</p>
                        <p>Remember: <b>anything above5 micrograms per cubic metre (μg/m3) is considered <i>unsafe by the WHO.</i></b> </p><br><br>

                        <p>This data is displayed from a data set provided from the Plymouth OpenData repository, found here:
                            <a href="https://plymouth.thedata.place/dataset/air-quality-data/resource/cd162ad1-d7d5-42a9-b1ab-0edbcd697f1e">
                                https://plymouth.thedata.place/dataset/air-quality-data/resource/cd162ad1-d7d5-42a9-b1ab-0edbcd697f1e</a></p>

                        <p>The location coordinates and the markers on the map are provided by via the data as latitude and longitude, as seen in the Geolocation area in the table.</p>

                        <p>Please note that some aspects of the data have been filtered (such as exact addresses and postcodes).</p>
                    </div>
                </div>
            </div>
    </div>
</div>





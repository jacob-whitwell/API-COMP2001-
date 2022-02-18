<?php

include_once 'air_quality.php';

class DataAccess
{
    public function air_quality()
    {
        // Arrays for our JSON-LD output
        $locations = [];
        $headers = [];

        // Get the data
        $file = fopen('../assets/data/air-quality.csv', 'r');

        // Check the file is open
        if ($file)
        {
            $lineCount = 0;

            // Get the data from the file object
            while ($data = fgetcsv($file, 200, ","))
            {
                // Check if the file has more than 0 lines, and thus correctly open
                if ($lineCount > 0) {

                    // Name, Address, Post Code, Town, Type, PM2_5 ,Exceed_10 , Latitude,Longitude
                    $aq = new Air_Quality($data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8]);
                    $locations [] = $aq;

                    // Continue to the next line
                    $lineCount++;
                } else {
                    $headers = $data;
                    $lineCount++;
                }

            }
        }

        return $locations;
    }
}
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "http://159.69.15.87:3001/addDriveId?driveId=");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);

        curl_close($ch);     
        echo $output;

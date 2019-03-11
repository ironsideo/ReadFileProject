<?php
/**
 * Created by PhpStorm.
 * User: ironside
 * Date: 3/9/19
 * Time: 7:46 PM
 */


// main::start("DataFile.csv");
main::start("TechCrunchcontinentalUSA.csv");

class main  {

    static public function start($filename)
    {
        $process = new csv;
        $recordtable = $process->getRecords($filename);
        print_r($recordtable);
    }
}


class csv
{
    public function getRecords($filename)
    {
        if($file = fopen( $filename, "r" ))
        {
            $header = fgetcsv( $file );			// Read First Line as Headers
            $data = Array();						// Data array
            while (!feof( $file )) {
                $record = fgetcsv( $file );

                array_push( $data, $record );
            }
            fclose( $file );

            $tableh = $this->CreateTable($header, $data);

            // Complete the Html data
            $tableh = "<html> <div class='container'> " .$this::getHeader(). "<br/>" . $tableh . "</div></html>";

        } else $tableh = "";

        return $tableh;
    }

    private function CreateTable( $header, $data )
    {
        // HTML Table Code
        $html = '<table class="table table-striped">';
        // header row
        $html .= '<tr>';
        foreach($header as $key)
        {
            $html .= '<th>' . htmlspecialchars($key) . '</th>';
        }
        $html .= '</tr>';

        // body data rows
        foreach($data as $rowvalue=>$value)
        {
            $html .= '<tr>';
            foreach($value as $key2=>$rowdata)
            {
                $html .= '<td>' . htmlspecialchars($rowdata) . '</td>';
            }
            $html .= '</tr>';
        }

        // finish table and return it
        $html .= '</table>';
        return $html;
    }

    # Bootstrap cdn and sources
    private static function getHeader(){
        $htmlHeader = '<head> <meta name="viewport" content="width=device-width, initial-scale=1"> <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script></head>';
        return $htmlHeader;
    }
}
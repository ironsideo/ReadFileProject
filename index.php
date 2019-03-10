<?php
/**
 * Created by PhpStorm.
 * User: ironside
 * Date: 3/10/19
 * Time: 4:32 PM
 */

main::start();

calss main {

    static public function start() {

        $file = fopen( "datafile.cs", "r");

        while(! feof($file))
        {
            print_r(fgetcsv($file));
        }

        fclose($file);
    }
}
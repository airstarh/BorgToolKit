<?php

class TimeTest
{

    ######################################################################################################################################################
    public function main()
    {
        set_time_limit(2);
        ini_set('max_execution_time', 1);
        $mysqli = $this->mysqli();

        $counter = 0;
        // while (true) {
        //     $counter++;
        //     echo PHP_EOL;
        //     echo $counter;
        // }

        return [
            'serverInfo'         => $this->serverInfo(),
            '$mysqli->host_info' => $mysqli->host_info,
        ];
    }

    ######################################################################################################################################################

    public function mysqli()
    {
        $host = '127.0.0.1';

        $user     = 'XXX';
        $password = 'XXX';
        $db       = 'XXX';
        $port     = 3307;
        $timeout  = 5;

        $mysqli = new mysqli($host, $user, $password, $db, $port);
        return $mysqli;
    }

    public function serverInfo()
    {
        return [
            'safe_mode'          => ini_get('safe_mode'),
            'max_execution_time' => ini_get('max_execution_time'),
        ];
    }
    ######################################################################################################################################################
}
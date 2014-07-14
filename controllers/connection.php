<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Connection{

    private $server = "localhost";
    private $username = "linksim";
    private $password = "phantom";
    private $databaseName = "linksim";

    function Connection(){
        $link = mysql_connect($this->server, $this->username, $this->password);
        if(!$link){
            echo "could not connect to DB";
        }
        mysql_select_db($this->databaseName);
    }
    function queryString($query = ""){
        $result  = mysql_query($query);

        return $result;
        mysql_free_result($result);
    }
}

<?php

    function connect(){
        return new mysqli(HOST,USER,PASS,DB);
    }

    function create($sql){
        connect()->query($sql);
    }

    function find($table, $id){
        $sql = "SELECT * FROM {$table} WHERE id='{$id}' ";
        $data = connect()->query($sql);
        return $data->fetch_assoc();
    }

?>
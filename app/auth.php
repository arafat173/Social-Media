<?php
    function authCheck($table, $col, $data){
    $login_data = connect()->query("SELECT * FROM {$table} WHERE $col='{$data}'");
    if($login_data->num_rows == 1){
        return $login_data->fetch_assoc();

    }
    else{
        return false;
    }
    }

    function userLogin(){
        if(isset($_SESSION['id'])){
            return true;
        }
        else{
            return false;
        }

    }

    function loginUserData($table, $id){
    $data = connect()->query("SELECT * FROM {$table} WHERE id='$id'");
    return $data->fetch_assoc();
    }
?>
<?php
function validation($msg,$type='warning'){
 return "<p class='alert alert-{$type}'> {$msg}<button class='close' data-dismiss='alert'>&times;</button></p>";
}

function emailcheck($email){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    }
    else{
        return false;
    }
}


function passcheck($pass,$cpass){
    if($pass === $cpass){
        return true;
    }else{
        return false;
    }
}

function instEmail($email, array $mails){
    $mail_array = explode("@",$email);
    $last = end($mail_array);
    if(in_array($last,$mails)){
        return true;
    }else{
        return false;
    }
}

function getHash($pass){
    return  hash('md5',$pass);
}

function mobileVerification($phone){
if(substr($phone,0,2)=='01' || substr($phone,0,4)=='8801' || substr($phone,0,5)=='+8801'){
    return true;
}else{
    return false;
}
}

function old($name){
    if(isset($_POST[$name])){
        echo $_POST[$name];
    }else{
        echo '';
    }
}

function formClean(){
    $_POST='';
}

function locationCheck($location){
    if(isset($_POST[$location])){
        return true;
    }else{
        return false;
    }
}

function move($file,$path='/'){
         
         $file_name=time().'_'.rand().'_'. $file['name'];
         $file_tmp= $file['tmp_name'];
         $file_size= $file['size'];

         move_uploaded_file($file_tmp, $path. $file_name);
         return $file_name;
}

function dataCheck($table,$col,$val){
$data = connect()->query("SELECT {$col} FROM {$table} WHERE {$col}='$val' ");
    if($data->num_rows>0){
        return false;
    }else{
        return true;
    }
}

/**
 * all 
 */

 function all($table){
 return connect()->query("SELECT * FROM {$table}");
 }

 function setMsg($type, $msg){
    setcookie($type,$msg, time()+ 3);
 }
 function getMsg($type){
     if(isset($_COOKIE[$type])){
       echo "<p class='alert alert-{$type}'> {$_COOKIE[$type]}<button class='close' 
        data-dismiss='alert'>&times;</button></p>";
   
     }
 }
?>
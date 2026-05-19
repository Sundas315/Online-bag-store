<?php
$conn=new mysqli('localhost','root','','trandhivedb');
if(!$conn){
    echo "Error!: {$conn->connect_error}";
}
?>
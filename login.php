<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connection.php';

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $username=$_POST['login-username'];
    $password=$_POST['login-password'];
    
    //Insert data

    $sql = "SELECT * FROM userdata WHERE username='$username'";
    $result=$conn->query($sql);

    if($result->num_rows>0)
    {
        $user=$result->fetch_assoc();
        
        if(password_verify($password,$user['password']))
        {
        echo "Login Succesful";
        session_start();
        $_SESSION['login-username']=$username;
        }
         else
        {
                echo "Invalid Password";
        }
    }else{
        echo "User Not Found";
    }
}

?>
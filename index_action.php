<?php 

include('config.php');

$action=$_POST['action'];

if($action=='login'){

      $username=$_POST['username'];
      $password=$_POST['password'];    

      $sql="select * from tbluser where UserName='{$username}' and Password='{$password}'";
      $result=mysqli_query($con,$sql);
     
      if(mysqli_num_rows($result)>0){
            $row=mysqli_fetch_array($result);
            $_SESSION['userid']=$row['AID'];
            $_SESSION['username']=$row['UserName'];
            $_SESSION['password']=$row['Password'];
            $_SESSION['usertype']=$row['UserType'];        
           
            save_log($row['UserName']." Login ဝင်သွားသည်"); 
            echo 1;
      }else{
            session_unset();
            echo 0;
      }
  

}

if($action=="logout"){   
 

      save_log($_SESSION['username']." သည် Logout လုပ်သွားသည်");
      session_unset();
      echo 1;
     
      
}


?>
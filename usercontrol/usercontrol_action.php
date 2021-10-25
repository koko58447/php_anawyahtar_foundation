<?php
include('../config.php');

$action = $_POST["action"];


if($action == 'show'){  

      $limit_per_page=""; 
      if($_POST['entryvalue']==""){
          $limit_per_page=10; 
      } else{
          $limit_per_page=$_POST['entryvalue']; 
      }
      
      $page="";
      if(isset($_POST["page_no"])){
          $page=$_POST["page_no"];
      }
      else{
          $page=1;
      }
  
      $offset = ($page-1) * $limit_per_page;                                               
     
      $search = $_POST['search'];
      if($search == ''){         
          $sql="select * from tbluser order by AID desc limit $offset,$limit_per_page";
      }else{ 
          $sql="select * from tbluser where UserName like '%$search%' or UserType like '%$search%' order by AID desc limit $offset,$limit_per_page";     
          
      }
      
      $result=mysqli_query($con,$sql) or die("SQL a Query");
      $out="";
      if(mysqli_num_rows($result) > 0){
          $out.='
            <table class="table table-bordered table-striped responsive " id="support_table5">
                <thead>
                    <tr>
                        <th width="7%">No</th>
                        <th>User Name</th>
                        <th>User Type</th>
                        <th width="10%" class="text-center">Edit</th>
                    </tr>
                </thead>
                <tbody>
          ';
          $no=0;
          while($row = mysqli_fetch_array($result)){
              $no = $no + 1;
              $out.="<tr>
                  <td>{$no}</td>
                  <td>{$row["UserName"]}</td>
                  <td>{$row["UserType"]}</td> 
                  <td class='text-center'>
                  <div class='dropdown'>
                  <a class='btn btn-link font-30 p-0 line-height-1'
                        href='#' role='button' data-toggle='dropdown'>
                        <i class='fa fa-more-vert'>ooo</i>
                  </a>
                        <div class='dropdown-menu dropdown-menu-right dropdown-menu-icon-list'>";
                                                      
                            $out.="<a href='#' id='btnedit' class='dropdown-item'                           
                            data-aid='{$row['AID']}'
                            data-username='{$row['UserName']}'
                            data-password='{$row['Password']}'
                            data-usertype='{$row['UserType']}'

                               ><i
                                class='fa fa-edit text-primary'
                                style='font-size:15px;'></i>
                                Edit</a>                           
                            <a href='#' class='dropdown-item'
                            id='btndelete'
                            data-aid='{$row['AID']}'
                              ><i
                                class='fa fa-close text-danger'
                                style='font-size:15px;'></i>
                                Delete</a>                            
                        </div>
                </div>
                    
                  </td>
              </tr>";
          }
          $out.="</tbody>";
          $out.="</table>";
  
          $sql_total="";
          if($search == ''){
              $sql_total="select AID from tbluser";
          }else{
              $sql_total="select AID from tbluser where UserName like '%$search%' or UserType like '%$search%'";
          }
          $record = mysqli_query($con,$sql_total) or die("fail query");
          $total_record = mysqli_num_rows($record);
          $total_links = ceil($total_record/$limit_per_page);
  
          $out.='<div class="pull-left"><p>Total Records -  ';
          $out.=$total_record;
          $out.='</p></div>';
  
          $out.='<div class="pull-right">
                  <ul class="pagination">
              ';      
          
          $previous_link = '';
          $next_link = '';
          $page_link = '';
  
          if($total_links > 4){
              if($page < 5){
                  for($count = 1; $count <= 5; $count++)
                  {
                      $page_array[] = $count;
                  }
                  $page_array[] = '...';
                  $page_array[] = $total_links;
              }else{
                  $end_limit = $total_links - 5;
                  if($page > $end_limit){
                      $page_array[] = 1;
                      $page_array[] = '...';
                      for($count = $end_limit; $count <= $total_links; $count++)
                      {
                          $page_array[] = $count;
                      }
                  }else{
                      $page_array[] = 1;
                      $page_array[] = '...';
                      for($count = $page - 1; $count <= $page + 1; $count++)
                      {
                          $page_array[] = $count;
                      }
                      $page_array[] = '...';
                      $page_array[] = $total_links;
                  }
              }            
  
          }else{
              for($count = 1; $count <= $total_links; $count++)
              {
                  $page_array[] = $count;
              }
          }
  
          for($count = 0; $count < count($page_array); $count++){
              if($page == $page_array[$count]){
                  $page_link .= '<li class="page-item active">
                                      <a class="page-link" href="#">'.$page_array[$count].' <span class="sr-only">(current)</span></a>
                                  </li>';
  
                  $previous_id = $page_array[$count] - 1;
                  if($previous_id > 0){
                      $previous_link = '<li class="page-item">
                                              <a class="page-link" href="javascript:void(0)" data-page_number="'.$previous_id.'">Previous</a>
                                      </li>';
                  }
                  else{
                      $previous_link = '<li class="page-item disabled">
                                              <a class="page-link" href="#">Previous</a>
                                      </li>';
                  }
  
                  $next_id = $page_array[$count] + 1;
                  if($next_id >= $total_links){
                      $next_link = '<li class="page-item disabled">
                                          <a class="page-link" href="#">Next</a>
                                  </li>';
                  }else{
                      $next_link = '<li class="page-item">
                                      <a class="page-link" href="javascript:void(0)" data-page_number="'.$next_id.'">Next</a>
                                  </li>';
                  }
              }else{
                  if($page_array[$count] == '...')
                  {
                      $page_link .= '<li class="page-item disabled">
                                          <a class="page-link" href="#">...</a>
                                      </li> ';
                  }else{
                      $page_link .= '<li class="page-item">
                                          <a class="page-link" href="javascript:void(0)" data-page_number="'.$page_array[$count].'">'.$page_array[$count].'</a>
                                      </li> ';
                  }
              }
          }
  
          $out .= $previous_link . $page_link . $next_link;
  
          $out .= '</ul></div>';
  
          echo $out; 
          
      }
      else{
        $out.='
        <table class="table display product-overview mb-30" id="support_table5">
            <thead>
                <tr>
                    <th width="7%">No</th>
                    <th>User Name</th>
                    <th>User Type</th>
                    <th width="10%" class="text-center">Edit</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center" colspan="4">No record found.</td>
            </tr>
            </tbody>
        </table>';
        echo $out;
      }
  
}

if($action == 'save'){       
      $username=$_POST['username'];
      $password=$_POST['password'];
      $usertype=$_POST['usertype'];

      $sql="insert into tbluser (UserName,Password,UserType) values ('{$username}','{$password}','{$usertype}')";
      if(mysqli_query($con,$sql)){
            echo 1;
        }else{
            echo 0;
        }

}

if($action=='editprepare'){
      $aid=$_POST['aid'];
      $username=$_POST['username'];
      $password=$_POST['password'];
      $usertype=$_POST['usertype'];
      $out="
        <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width'>
            <input class='mdl-textfield__input' type='text' name='username' value='{$username}' id='txtFirstName'>
            <label class='mdl-textfield__label' for='text4'>User Name</label>
        </div>
        <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width'>
            <input class='mdl-textfield__input' type='password' name='password' value='{$password}'>
            <label class='mdl-textfield__label' for='text4'>Password</label>
        </div>
        <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width'>
            <input class='mdl-textfield__input' type='password' name='compassword' value='{$password}'>
            <label class='mdl-textfield__label' for='text4'>Confirm Password</label>
        </div>
        <div
            class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width'>
            <input class='mdl-textfield__input' type='text' name='usertype' id='list3' value='{$usertype}' readonly
                tabIndex='-1'>
            <label for='list3' class='pull-right margin-0'>
                <i class='mdl-icon-toggle__label material-icons'>keyboard_arrow_down</i>
            </label>
            <label for='list3' class='mdl-textfield__label'>User Type</label>
            <ul data-mdl-for='list3' class='mdl-menu mdl-menu--bottom-left mdl-js-menu'>
                <li class='mdl-menu__item' data-val='Admin'>Admin</li>
                <li class='mdl-menu__item' data-val='User'>User</li>
            </ul>
        </div>   
      ";
      echo $out;
}

if($action == 'edit'){ 
      
      $aid=$_POST['aid'];
      $username=$_POST['username'];
      $password=$_POST['password'];
      $usertype=$_POST['usertype'];

      $sql="update tbluser set UserName='{$username}',Password='{$password}',UserType='{$usertype}' where AID={$aid}";
    
      if(mysqli_query($con,$sql)){
           // save_log($_SESSION["username"]." သည် user အားအသစ်သွင်းသွားသည်။");
            echo 1;
        }else{
            echo 0;
        }

}

if($action == 'delete'){

      $aid = $_POST["aid"];
      $sql = "delete from tbluser where AID=$aid";     
      if(mysqli_query($con,$sql)){
          //save_log($_SESSION["username"]." သည် user အားဖျက်သွားသည်။");
          echo 1;
      }
      else{
          echo 0;
      }
      
}


if($action=='excel'){

      $search = $_POST['ser'];
      if($search == ''){         
        $sql="select * from tbluser order by AID desc";
    }else{ 
        $sql="select * from tbluser where UserName like '%$search%' or UserType like '%$search%' order by AID desc";     
        
    }

    $result = mysqli_query($con,$sql);
    $out="";
    $fileName = "UserControlReport_".date('d-m-Y').".xls";
    if(mysqli_num_rows($result) > 0)
    {
        $out .= '
        <head><meta charset="utf-8"></head>
        <table >  
            <tr>
                    <td colspan="3" align="center"><h3>User Control</h3></td>
            </tr>
            <tr><td colspan="3"><td></tr>
            <tr>  
                <th style="border: 1px solid ;">No</th>  
                <th style="border: 1px solid ;">User Name</th>  
                <th style="border: 1px solid ;">User Type</th> 
            </tr>';
        $no=0;
        while($row = mysqli_fetch_array($result))
        {
            $no = $no + 1;
            $out .= '
                <tr>  
                    <td style="border: 1px solid ;">'.$no.'</td>  
                    <td style="border: 1px solid ;">'.$row["UserName"].'</td>  
                    <td style="border: 1px solid ;">'.$row["UserType"].'</td>  
                    
                
                </tr>';
        }
        $out .= '</table>';

        

            header('Content-Type: application/xls');
            header('Content-Disposition: attachment; filename='.$fileName);
            echo $out;
    }else{
        $out .= '
        <table >  
            <tr>
                <td colspan="3" align="center"><h3>User Control</h3></td>
            </tr>
            <tr><td colspan="3"><td></tr>
            <tr>  
                <th style="border: 1px solid ;">No</th>  
                <th style="border: 1px solid ;">User Name</th>  
                <th style="border: 1px solid ;">User Type</th>
            </tr>
            <tr>
                <td style="border: 1px solid ;" colspan="3">No record found.</td>
            </tr>
            </table>';
            header('Content-Type: application/xls');
            header('Content-Disposition: attachment; filename='.$fileName);
            echo $out;
    }   
}


if($action=='changepassword'){
    $aid=$_SESSION['userid'];
    $newpassword=$_POST["newpassword"]; 
   $sql="update tbluser set Password='{$newpassword}'
   where AID=$aid";
   if(mysqli_query($con,$sql)){
    $_SESSION['password']=$newpassword;
    echo 1;
    }else{
    echo 0;
    }
}



?>
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
          $sql="select * from tbldonater order by AID desc limit $offset,$limit_per_page";
      }else{ 
          $sql="select * from tbldonater where Name like '%$search%' or Email like '%$search%' order by AID desc limit $offset,$limit_per_page";     
          
      }
      
      $result=mysqli_query($con,$sql) or die("SQL a Query");
      $out="";
      if(mysqli_num_rows($result) > 0){
          $out.='
            <table class="table table-bordered table-striped responsive ">
                <thead>
                    <tr>
                        <th width="7%">No</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Phone No</th>
                        <th>Email</th>
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
                  <td>{$row["Name"]}</td>
                  <td>{$row["Gender"]}</td> 
                  <td>{$row["Address"]}</td> 
                  <td>{$row["Phno"]}</td> 
                  <td>{$row["Email"]}</td> 
                  <td class='text-center'>
                  <div class='dropdown'>
                  <a class='btn btn-link font-30 p-0 line-height-1'
                        href='#' role='button' data-toggle='dropdown'>
                        <i class='fa fa-more-vert'>ooo</i>
                  </a>
                        <div class='dropdown-menu dropdown-menu-right dropdown-menu-icon-list'>";
                                                      
                            $out.="<a href='#' id='btnedit' class='dropdown-item'                           
                            data-aid='{$row['AID']}'
                            
                               ><i
                                class='fa fa-edit text-primary'
                                style='font-size:15px;'></i>
                                Edit</a> 
                            <a href='#' id='btnfile' class='dropdown-item'                           
                                data-aid='{$row['AID']}'
                                data-img='{$row['Img']}'
                                
                                   ><i
                                    class='fa fa-file-o text-primary'
                                    style='font-size:15px;'></i>
                                    Change Image</a>                           
                            <a href='#' class='dropdown-item'
                            id='btndelete'
                            data-aid='{$row['AID']}'
                            data-img='{$row['Img']}'
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
              $sql_total="select AID from tbldonater";
          }else{
              $sql_total="select AID from tbldonater where Name like '%$search%' or Email like '%$search%'";
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
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Phone No</th>
                    <th>Email</th>
                    <th width="10%" class="text-center">Edit</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center" colspan="7">No record found.</td>
            </tr>
            </tbody>
        </table>';
        echo $out;
      }
  
}

if($action == 'save'){       
      $name=$_POST['name'];
      $address=$_POST['address'];
      $email=$_POST['email'];
      $phno=$_POST['phno'];
      $gender=$_POST['gender'];

    if($_FILES['file']['name'] != ''){
        $filename = $_FILES['file']['name'];        
        $extension = pathinfo($filename,PATHINFO_EXTENSION);
        $file = $_FILES['file']['tmp_name'];
        $valid_extension = array("png","jpg","jpeg","PNG","JPG","JPEG");
        if(in_array($extension,$valid_extension)){
            $new_filename = rand(1,100) ."_". $filename;
            $new_path = root."upload/donater/". $new_filename;

            if(move_uploaded_file($file,$new_path)){
                $sql = "insert into tbldonater (Name,Address,Phno,Email,Img,Gender) 
                values ('{$name}','{$address}','{$phno}','{$email}','{$new_filename}','{$gender}')";
                if(mysqli_query($con,$sql)){
                    //save_log($_SESSION["username"]." သည် expense အားအသစ်သွင်းသွားသည်။");
                    echo "success";
                }
                else{
                    echo "fail";
                }
            }
        }
        else{
            echo "wrongtype";
        }
    }
    else{
        $sql = "insert into tbldonater (Name,Address,Phno,Email,Gender) 
        values ('{$name}','{$address}','{$phno}','{$email}','{$gender}')";
        if(mysqli_query($con,$sql)){
            //save_log($_SESSION["username"]." သည် expense အားအသစ်သွင်းသွားသည်။");
            echo "success";
        }
        else{
             echo "fail";
        }
    } 

}

if($action=='editprepare'){
      $aid=$_POST['aid'];
      $sql="select * from tbldonater where AID=$aid";
      $result=mysqli_query($con,$sql) or die("SQL a Query");
      $out="";
      if(mysqli_num_rows($result) > 0){

        $row=mysqli_fetch_array($result);
        $out.='

        <div class="modal-body">
        <input type="hidden" name="aid" value="'.$row['AID'].'">
                <input type="hidden" name="action" value="edit">
                <div class="form-group">
                  <label for="">Name</label>
                  <input type="text" class="form-control" name="name1" value="'.$row['Name'].'" placeholder="Enter Name..." required>
                 
                </div>
                <div class="form-group">
                  <label for="">Email</label>
                  <input type="text" class="form-control" name="email1" value="'.$row['Email'].'" placeholder="Enter email..." required>
                 
                </div>
                <div class="form-group">
                  <label for="">Phone No</label>
                  <input type="text" class="form-control" name="phno1" value="'.$row['Phno'].'" placeholder="Enter Phone Number..." required>
                  
                </div>
                <div class="form-group">
                  <label>Gender</label>
                  <select class="form-control text-primary" name="gender1" required>
                    <option selected value="'.$row['Gender'].'">'.$row['Gender'].'</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>                 
                </div>
                <div class="form-group">
                  <label for="">Address</label>
                  <input type="text" class="form-control" name="address1" value="'.$row['Address'].'" placeholder="Enter Address..." required>
                  
                </div>              
                
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-primary" value="Edit Donater">
              </div>';



      }

      echo $out;
}

if($action == 'edit'){ 
      
      $aid=$_POST['aid'];
      $name=$_POST['name1'];
      $address=$_POST['address1'];
      $email=$_POST['email1'];
      $phno=$_POST['phno1'];
      $gender=$_POST['gender1'];

      $sql="update tbldonater set Name='{$name}',Address='{$address}',Email='{$email}',Phno='{$phno}',Gender='{$gender}' where AID={$aid}";
    
      if(mysqli_query($con,$sql)){
           // save_log($_SESSION["username"]." သည် user အားအသစ်သွင်းသွားသည်။");
            echo 1;
        }else{
            echo 0;
        }

}

if($action == 'delete'){

      $aid = $_POST["aid"];
      $img = $_POST["img"];

    if($img==""){
        
    }
    else{        
        unlink(root.'upload/donater/'.$img);
    }

      $sql = "delete from tbldonater where AID=$aid";     
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
        $sql="select * from tbldonater order by AID desc";
    }else{ 
        $sql="select * from tbldonater where Name like '%$search%' or Email like '%$search%' order by AID desc";     
        
    }

    $result = mysqli_query($con,$sql);
    $out="";
    $fileName = "Donater-Report".date('d-m-Y').".xls";
    if(mysqli_num_rows($result) > 0)
    {
        $out .= '
        <head><meta charset="utf-8"></head>
        <table >  
            <tr>
                    <td colspan="6" align="center"><h3>Donater List</h3></td>
            </tr>
            <tr><td colspan="6"><td></tr>
            <tr>  
                <th style="border: 1px solid ;">No</th>  
                <th style="border: 1px solid ;">Name</th>  
                <th style="border: 1px solid ;">Gender</th> 
                <th style="border: 1px solid ;">Address</th> 
                <th style="border: 1px solid ;">Phone No</th> 
                <th style="border: 1px solid ;">Email</th> 
            </tr>';
        $no=0;
        while($row = mysqli_fetch_array($result))
        {
            $no = $no + 1;
            $out .= '
            <tr>  
                <td style="border: 1px solid ;">'.$no.'</td>  
                <td style="border: 1px solid ;">'.$row["Name"].'</td>  
                <td style="border: 1px solid ;">'.$row["Gender"].'</td>  
                <td style="border: 1px solid ;">'.$row["Address"].'</td> 
                <td style="border: 1px solid ;">'.$row["Phno"].'</td> 
                <td style="border: 1px solid ;">'.$row["Email"].'</td>                    
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
                <td colspan="4" align="center"><h3>Donater List</h3></td>
            </tr>
            <tr><td colspan="4"><td></tr>
            <tr>  
                <th style="border: 1px solid ;">No</th>  
                <th style="border: 1px solid ;">Name</th>  
                <th style="border: 1px solid ;">Gender</th>
                <th style="border: 1px solid ;">Address</th>
                <th style="border: 1px solid ;">Phone Number</th>
                <th style="border: 1px solid ;">Email</th>
            </tr>
            <tr>
                <td style="border: 1px solid ;" colspan="4">No record found.</td>
            </tr>
            </table>';
            header('Content-Type: application/xls');
            header('Content-Disposition: attachment; filename='.$fileName);
            echo $out;
    }   
}

if($action == 'fileupdate'){
       
    $aid = $_POST["aid1"];
    $pathfile = $_POST["oldpath"];

    if($_FILES['file1']['name'] != ''){
        $filename = $_FILES['file1']['name'];        
        $extension = pathinfo($filename,PATHINFO_EXTENSION);
        $file = $_FILES['file1']['tmp_name'];
        $valid_extension =  array("png","jpg","jpeg","PNG","JPG","JPEG");
        if(in_array($extension,$valid_extension)){
            $new_filename = rand() .".". $extension;
            $new_path = root."upload/donater/". $new_filename;

            if(move_uploaded_file($file,$new_path)){

                if($pathfile != ""){
                    unlink(root.'upload/donater/'.$pathfile);
                }

                $sql = "update tbldonater set Img='{$new_filename}' where AID=$aid";
              
                if(mysqli_query($con,$sql)){
                    echo "success";
                }
                else{
                    echo "fail";
                }
            }
        }
        else{
            echo "wrongtype";
        }
    }else{
        echo "nofile";
    }

}



?>
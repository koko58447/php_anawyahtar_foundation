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
        $sql="select * from tblteacher order by AID desc limit $offset,$limit_per_page";
    }else{ 
        $sql="select * from tblteacher where Name like '%$search%' order by AID desc limit $offset,$limit_per_page";  
    }
    
    $result=mysqli_query($con,$sql) or die("SQL a Query");
    $out="";
    if(mysqli_num_rows($result) > 0){
        $out.='
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>FatherName</th>
                    <th>DOB</th>
                    <th>Education</th>
                    <th>Email</th>
                    <th>PhoneNo</th>
                    <th>Address</th>
                    <th>မှတ်ချက်</th>
                    <th>Action</th>
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
                <td>{$row["Father_Name"]}</td>
                <td>".enDate($row["DOB"])."</td> 
                <td>{$row["Education"]}</td>
                <td>{$row["Email"]}</td> 
                <td>{$row["Phno"]}</td>
                <td>{$row["Address"]}</td> 
                <td>{$row["Rmk"]}</td>
                <td class='text-center'>
                    <div class='dropdown'>
                      <a class='btn btn-link font-30 p-0 line-height-1'
                            href='#' role='button' data-toggle='dropdown'>
                            <i class='fa fa-more-vert'>ooo</i>
                      </a>
                    <div class='dropdown-menu dropdown-menu-right dropdown-menu-icon-list'>  
                        <a href='#' id='btnedit' class='dropdown-item'
                            data-aid='{$row['AID']}'><i
                            class='fa fa-edit text-primary'
                            style='font-size:15px;'></i>
                            Edit</a>
                        <a href='#' id='btndelete' class='dropdown-item'
                            data-aid='{$row['AID']}'
                            data-path='{$row['Img']}'><i
                            class='fa fa-close text-danger'
                            style='font-size:15px;'></i>
                            Delete</a>
                        <a href='#' id='btnchangephoto' class='dropdown-item'
                            data-aid='{$row['AID']}'
                            data-img='{$row['Img']}'><i
                            class='fa fa-photo text-success'
                            style='font-size:15px;'></i>
                            Change Photo</a>
                        <a href='#' id='btnreport' class='dropdown-item'
                            data-aid='{$row['AID']}'><i
                            class='fa fa-file-pdf-o text-success'
                            style='font-size:15px;'></i>
                            Report</a>
                    </div>
                    </div>
                </td>
            </tr>";
        }
        $out.="</tbody>";
        $out.="</table>";

        $sql_total="";
        if($search == ''){         
            $sql_total="select AID from tblteacher order by AID desc";
        }else{ 
            $sql_total="select AID from tblteacher where Name like '%$search%' order by AID desc";  
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
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>FatherName</th>
                    <th>DOB</th>
                    <th>Education</th>
                    <th>Email</th>
                    <th>PhoneNo</th>
                    <th>Address</th>
                    <th>မှတ်ချက်</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center" colspan="10">No record found.</td>
            </tr>
            </tbody>
        </table>';
    echo $out;
    }
  
}



if($action == 'save'){    
    $tname=$_POST['tname'];
    $tfname=$_POST['tfname'];
    $tdob=$_POST['tdob'];
    $tnrc=$_POST['tnrc'];
    $tgender=$_POST['tgender'];
    $theight=$_POST['theight'];
    $tmaritial=$_POST['tmaritial'];
    $tnation=$_POST['tnation'];
    $treligion=$_POST['treligion'];
    $teducation=$_POST['teducation'];
    $tother=$_POST['tother'];
    $texperience=$_POST['texperience'];
    $tphno=$_POST['tphno'];
    $temail=$_POST['temail'];
    $taddress=$_POST['taddress'];
    $trmk=$_POST['trmk'];

    if($_FILES['tfile1']['name'] != ''){           
        $filename = $_FILES['tfile1']['name'];
        $extension = pathinfo($filename,PATHINFO_EXTENSION);
        $old_path = $_FILES['tfile1']['tmp_name'];
        $valid_extension = array("PNG","JPEG","JPG","png","jpg","jpeg");

        if(in_array($extension,$valid_extension)){  
            $new_filename = rand(1,100) ."_". $filename;
            $new_path = root."lib/upload/teacher_images/". $new_filename;
            if(move_uploaded_file($old_path,$new_path)){
                $sql = "insert into tblteacher (Name,Father_Name,DOB,NRC,Gender,Height,Marital_Status,
                Nation,Religion,Education,Other_Quality,Teaching_Experience,Address,Phno,Email,Rmk,Img) 
                values ('{$tname}','{$tfname}','{$tdob}','{$tnrc}','{$tgender}','{$theight}','{$tmaritial}',
                '{$tnation}','{$treligion}','{$teducation}','{$tother}','{$texperience}','{$taddress}',
                '{$tphno}','{$temail}','{$trmk}','{$new_filename}')";
                
                if(mysqli_query($con,$sql)){
                    save_log($_SESSION['username']."သည် student အား အသစ်သွင်းသွားသည်။ ");
                    echo "success";
                }
                else{
                    echo "fail";
                }
            }
            else{
                echo "fail";
            }
        }
        else{
            echo "wrongtype";
        }       
    }
    else{
        $sql = "insert into tblteacher (Name,Father_Name,DOB,NRC,Gender,Height,Marital_Status,
        Nation,Religion,Education,Other_Quality,Teaching_Experience,Address,Phno,Email,Rmk) 
        values ('{$tname}','{$tfname}','{$tdob}','{$tnrc}','{$tgender}','{$theight}','{$tmaritial}',
        '{$tnation}','{$treligion}','{$teducation}','{$tother}','{$texperience}','{$taddress}',
        '{$tphno}','{$temail}','{$trmk}')";
        
        if(mysqli_query($con,$sql)){
            save_log($_SESSION['username']."သည် student အား အသစ်သွင်းသွားသည်။ ");
            echo "success";
        }
        else{
            echo "fail";
        }
    }

}


if($action=='prepare'){
    $aid=$_POST['aid'];
    $sql="select * from tblteacher where AID=$aid";
    $result = mysqli_query($con,$sql);
    $out="";
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $out.="
        <input type='hidden' name='aid' value='{$row["AID"]}'>
        <div class='modal-body row'>
            <div class='form-group col-md-4'>
                <label for=''>Name</label>
                <input type='text' class='form-control' name='etname' placeholder='Enter Name...' value='{$row["Name"]}'>
            </div>
            <div class='form-group col-md-4'>
                <label for=''>Father's Name</label>
                <input type='text' class='form-control' name='etfname' placeholder='Enter Father Name...'
                    value='{$row["Father_Name"]}'>
            </div>
            <div class='form-group col-md-4'>
                <label for=''>Date of Birth</label>
                <input type='date' class='form-control' name='etdob' placeholder='အမည်...'
                    value='{$row["DOB"]}'>
            </div>
            <div class='form-group col-md-4'>
                <label for=''>NRC</label>
                <input type='text' class='form-control' name='etnrc' value='{$row["NRC"]}' placeholder='Enter NRC...'>
            </div>";
            if($row["Gender"] == "Male"){
                $out.="<div class='form-group col-md-4'>
                            <label>Gender</label>
                            <select class='form-control text-primary' name='etgender'>
                                <option value='Male' checked>Male</option>
                                <option value='Female'>Female</option>
                            </select>
                        </div>
                    ";
            }else{
                $out.="<div class='form-group col-md-4'>
                            <label>Gender</label>
                            <select class='form-control text-primary' name='etgender'>
                                <option value='Male' >Male</option>
                                <option value='Female' checked>Female</option>
                            </select>
                        </div>
                    ";
            }
            $out.="
            <div class='form-group col-md-4'>
                <label for=''>Height</label>
                <input type='text' class='form-control' name='etheight' placeholder='Enter Height...' value='{$row["Height"]}'>
            </div>";
            if($row["Marital_Status"] == "Yes"){
                $out.="<div class='form-group col-md-4'>
                            <label for=''>Marital Status</label>
                            <select class='form-control text-primary' name='etmaritial'>
                                <option value='Yes' checked>Yes</option>
                                <option value='No'>No</option>
                            </select>
                        </div>
                    ";
            }else{
                $out.="<div class='form-group col-md-4'>
                            <label for=''>Marital Status</label>
                            <select class='form-control text-primary' name='etmaritial'>
                                <option value='Yes' >Yes</option>
                                <option value='No' checked>No</option>
                            </select>
                        </div>
                    ";
            }
            $out.="
            <div class='form-group col-md-4'>
                <label for=''>Nationality</label>
                <input type='text' class='form-control' name='etnation' placeholder='Enter Nationality...'
                    value='{$row["Nation"]}'>
            </div>
            <div class='form-group col-md-4'>
                <label for=''>Religion</label>
                <input type='text' class='form-control' name='etreligion' placeholder='Enter Religion...'
                    value='{$row["Religion"]}'>
            </div>
            <div class='form-group col-md-4'>
                <label for=''>Education</label>
                <input type='text' class='form-control' name='eteducation' placeholder='Enter Education...'
                    value='{$row["Education"]}'>
            </div>
            <div class='form-group col-md-4'>
                <label for=''>Other Qualification</label>
                <input type='text' class='form-control' name='etother' placeholder='Enter Other Qualification...'
                    value='{$row["Other_Quality"]}'>
            </div>
            <div class='form-group col-md-4'>
                <label for=''>Teaching Experience</label>
                <input type='text' class='form-control' name='etexperience' placeholder='Enter Experience...'
                    value='{$row["Teaching_Experience"]}'>
            </div>
            <div class='form-group col-md-4'>
                <label for=''>Phone No</label>
                <input type='text' class='form-control' name='etphno' placeholder='Enter Phone No...' value='{$row["Phno"]}'>
            </div>
            <div class='form-group col-md-4'>
                <label for=''>Email</label>
                <input type='text' class='form-control' name='etemail' placeholder='Enter Email...' value='{$row["Email"]}'>
            </div>
            <div class='form-group col-md-4'>
                <label for=''>Address</label>
                <input type='text' class='form-control' name='etaddress' placeholder='Enter Address...' value='{$row["Address"]}'>
            </div>
            <div class='form-group col-md-4'>
                <label for=''>Remark</label>
                <input type='text' class='form-control' name='etrmk' placeholder='Enter Remark...' value='{$row["Rmk"]}'>
            </div>
        </div>
        <div class='modal-footer'>
            <button type='button' class='btn btn-secondary' data-dismiss='modal'><i
                    class='fa fa-close'></i>Close</button>
            <button type='submit' id='btneditsave' class='btn btn-primary'><i class='fa fa-edit'></i>&nbsp;Edit Teacher</button>
        </div>
        ";

        echo $out;
    }
}


if($action == 'edit'){ 
    $aid=$_POST['aid'];
    $tname=$_POST['etname'];
    $tfname=$_POST['etfname'];
    $tdob=$_POST['etdob'];
    $tnrc=$_POST['etnrc'];
    $tgender=$_POST['etgender'];
    $theight=$_POST['etheight'];
    $tmaritial=$_POST['etmaritial'];
    $tnation=$_POST['etnation'];
    $treligion=$_POST['etreligion'];
    $teducation=$_POST['eteducation'];
    $tother=$_POST['etother'];
    $texperience=$_POST['etexperience'];
    $tphno=$_POST['etphno'];
    $temail=$_POST['etemail'];
    $taddress=$_POST['etaddress'];
    $trmk=$_POST['etrmk'];

    $sql="update tblteacher set Name='{$tname}',Father_Name='{$tfname}',DOB='{$tdob}',
    NRC='{$tnrc}',Gender='{$tgender}',Height='{$theight}',Marital_Status='{$tmaritial}',Nation='{$tnation}',
    Religion='{$treligion}',Education='{$teducation}',Other_Quality='{$tother}',Teaching_Experience='{$texperience}',
    Address='{$taddress}',Phno='{$tphno}',Email='{$temail}',Rmk='{$trmk}' where AID={$aid}";
    
    if(mysqli_query($con,$sql)){ 
        save_log($_SESSION['username']."သည် student အား ပြင်ဆင်သွားသည်။ ");         
        echo 1;
    }else{
        echo 0;
    }
}

if($action == 'delete'){
    $aid = $_POST["aid"];
    $path = $_POST["path"];
    $sql = "delete from tblteacher where AID=$aid";     
    if(mysqli_query($con,$sql)){

        if(!empty($_POST['path'])){
            unlink(root.'lib/upload/teacher_images/'.$path);
        } 
        save_log($_SESSION['username']."သည် teacher အားဖျက်သွားသည်။ ");
        echo 1;
    }
    else{
        echo 0;
    }      
}


if($action=='excel'){
    $search = $_POST['ser'];
    if($search == ''){         
        $sql="select * from tblteacher order by AID desc";
    }else{ 
        $sql="select * from tblteacher where Name like '%$search%' order by AID desc";  
    }

    $result = mysqli_query($con,$sql);
    $out="";
    $fileName = "TeacherReport_".date('d-m-Y').".xls";
    if(mysqli_num_rows($result) > 0)
    {
        $out .= '<head><meta charset="utf-8" /></head>
        <table >  
            <tr>
                <td colspan="17" align="center"><h3>Teacher Report</h3></td>
            </tr>
            <tr><td colspan="17"><td></tr>
            <tr>  
                <th style="border: 1px solid ;">No</th>  
                <th style="border: 1px solid ;">Name</th>  
                <th style="border: 1px solid ;">Father Name</th>
                <th style="border: 1px solid ;">DOB</th>  
                <th style="border: 1px solid ;">NRC</th> 
                <th style="border: 1px solid ;">Gender</th>  
                <th style="border: 1px solid ;">Height</th> 
                <th style="border: 1px solid ;">Marital Status</th>  
                <th style="border: 1px solid ;">Nation</th> 
                <th style="border: 1px solid ;">Religion</th>  
                <th style="border: 1px solid ;">Education</th> 
                <th style="border: 1px solid ;">Other Quality</th>  
                <th style="border: 1px solid ;">Teaching Experience</th> 
                <th style="border: 1px solid ;">PhoneNo</th>  
                <th style="border: 1px solid ;">Email</th> 
                <th style="border: 1px solid ;">Address</th>   
                <th style="border: 1px solid ;">Remark</th> 
            </tr>';
        $no=0;
        while($row = mysqli_fetch_array($result))
        {
            $no = $no + 1;
            $out .= '
                <tr>  
                    <td style="border: 1px solid ;">'.$no.'</td>  
                    <td style="border: 1px solid ;">'.$row["Name"].'</td>  
                    <td style="border: 1px solid ;">'.$row["Father_Name"].'</td>  
                    <td style="border: 1px solid ;">'.enDate($row["DOB"]).'</td>
                    <td style="border: 1px solid ;">'.$row["NRC"].'</td>   
                    <td style="border: 1px solid ;">'.$row["Gender"].'</td> 
                    <td style="border: 1px solid ;">'.$row["Height"].'</td>  
                    <td style="border: 1px solid ;">'.$row["Marital_Status"].'</td> 
                    <td style="border: 1px solid ;">'.$row["Nation"].'</td>  
                    <td style="border: 1px solid ;">'.$row["Religion"].'</td>
                    <td style="border: 1px solid ;">'.$row["Education"].'</td>   
                    <td style="border: 1px solid ;">'.$row["Other_Quality"].'</td> 
                    <td style="border: 1px solid ;">'.$row["Teaching_Experience"].'</td>  
                    <td style="border: 1px solid ;">'.$row["Phno"].'</td> 
                    <td style="border: 1px solid ;">'.$row["Email"].'</td>  
                    <td style="border: 1px solid ;">'.$row["Address"].'</td>  
                    <td style="border: 1px solid ;">'.$row["Rmk"].'</td> 
                </tr>';
        }
        $out .= '</table>';       

            header('Content-Type: application/xls');
            header('Content-Disposition: attachment; filename='.$fileName);
            echo $out;
    }else{
        $out .= '<head><meta charset="utf-8" /></head>
        <table >  
            <tr>
                <td colspan="17" align="center"><h3>Student Report</h3></td>
            </tr>
            <tr><td colspan="17"><td></tr>
            <tr>  
                <th style="border: 1px solid ;">No</th>  
                <th style="border: 1px solid ;">Name</th>  
                <th style="border: 1px solid ;">Father Name</th>
                <th style="border: 1px solid ;">DOB</th>  
                <th style="border: 1px solid ;">NRC</th> 
                <th style="border: 1px solid ;">Gender</th>  
                <th style="border: 1px solid ;">Height</th> 
                <th style="border: 1px solid ;">Marital Status</th>  
                <th style="border: 1px solid ;">Nation</th> 
                <th style="border: 1px solid ;">Religion</th>  
                <th style="border: 1px solid ;">Education</th> 
                <th style="border: 1px solid ;">Other Quality</th>  
                <th style="border: 1px solid ;">Teaching Experience</th> 
                <th style="border: 1px solid ;">PhoneNo</th>  
                <th style="border: 1px solid ;">Email</th> 
                <th style="border: 1px solid ;">Address</th>   
                <th style="border: 1px solid ;">Remark</th> 
            </tr>
            <tr>
                <td style="border: 1px solid ;" colspan="17">No record found.</td>
            </tr>
            </table>';
            header('Content-Type: application/xls');
            header('Content-Disposition: attachment; filename='.$fileName);
            echo $out;
    }   
}

if($action == 'changephoto'){
    if($_FILES['tfile2']['name'] != ''){  
        $aid=$_POST['paid'];
        $path=$_POST['pimg'];

        $filename = $_FILES['tfile2']['name'];
        $extension = pathinfo($filename,PATHINFO_EXTENSION);
        $old_path = $_FILES['tfile2']['tmp_name'];
        $valid_extension = array("PNG","JPEG","JPG","png","jpg","jpeg");
    
        if(in_array($extension,$valid_extension)){  

            if(!empty($_POST['pimg'])){
                unlink(root.'lib/upload/teacher_images/'.$path);
            } 

            $new_filename = rand(1,100) ."_". $filename;
            $new_path = root."lib/upload/teacher_images/". $new_filename;
            if(move_uploaded_file($old_path,$new_path)){
                $sql = "update tblteacher set Img='{$new_filename}' where AID=$aid";
                
                if(mysqli_query($con,$sql)){
                    save_log($_SESSION['username']." သည် teacher ဓါတ်ပုံအား ပြင်ဆင်သွားသည်။ ");
                    echo "success";
                }
                else{
                    echo "fail";
                }
            }
            else{
                echo "fail";
            }
        }
        else{
            echo "wrongtype";
        }       
    }
}

if($action == 'report'){
    $aid = $_POST["aid"];
    $sql = "select * from tblteacher where AID=$aid";
    $res = mysqli_query($con,$sql);
    $out="";
    $src="";
    $doct=":&nbsp;&nbsp;&nbsp;&nbsp;";
    if(mysqli_num_rows($res) > 0){
        $row = mysqli_fetch_array($res);
        
        $out.="<h3 class='text-center'>ANAWRAHTA SHWE THAMANAY SCHOOL</h3>
        <h5 class='text-center'><u>APPLICATION FORM</u></h5>
        <h6 class='text-center'>(For Teacher)</h6>";
        if($row["Img"] != ''){
            $src = roothtml.'lib/upload/teacher_images/'.$row["Img"];
            $out.="<div class='form-group float-right border border-info p-1' style='width:13%;height:100px;'>
                <img src='{$src}'  style='width:100%;height:90px;'/>
            </div>";
        }else{
            $out.="<div class='form-group float-right border border-info p-1' style='width:13%;height:100px;'>
                
            </div>";
        }
        
        $out.="<table width='100%'>
            <tr>
                <td width='35%'>Name</td>
                <td colspan='2'><label class='text-line'>{$doct}{$row["Name"]}</label></td>
            </tr>
            <tr>
                <td width='35%'>Father's Name</td>
                <td colspan='2'><label class='text-line'>{$doct}{$row["Father_Name"]}</label></td>
            </tr>
            <tr>
                <td width='35%'>Date of Birth</td>
                <td colspan='2'><label class='text-line'>{$doct}".enDate($row["DOB"])."</label></td>
            </tr>
            <tr>
                <td width='35%'>NRC No</td>
                <td colspan='2'><label class='text-line'>{$doct}{$row["NRC"]}</label></td>
            </tr>
            <tr>
                <td width='35%'>Gender</td>
                <td colspan='2'><label class='text-line'>{$doct}{$row["Gender"]}</label></td>
            </tr>
            <tr>
                <td width='35%'>Height</td>
                <td colspan='2'><label class='text-line'>{$doct}{$row["Height"]}</label></td>
            </tr>
            <tr>
                <td width='35%'>Marital Status</td>
                <td colspan='2'><label class='text-line'>{$doct}{$row["Marital_Status"]}</label></td>
            </tr>
            <tr>
                <td width='35%'>Nationality</td>
                <td colspan='2'><label class='text-line'>{$doct}{$row["Nation"]}</label></td>
            </tr>
            <tr>
                <td width='35%'>Religion</td>
                <td colspan='2'><label class='text-line'>{$doct}{$row["Religion"]}</label></td>
            </tr>
            <tr>
                <td width='35%'>Education</td>
                <td colspan='2'><label class='text-line'>{$doct}{$row["Education"]}</label></td>
            </tr>
            <tr>
                <td width='35%'>Other Qualification</td>
                <td colspan='2'><label class='text-line'>{$doct}{$row["Other_Quality"]}</label></td>
            </tr>
            <tr>
                <td width='35%'></td>
                <td colspan='2'><label class='text-line'>{$doct}</label></td>
            </tr>
            <tr>
                <td width='35%'>Teaching Experience & Position</td>
                <td colspan='2'><label class='text-line'>{$doct}{$row["Teaching_Experience"]}</label></td>
            </tr>
            <tr>
                <td width='35%'></td>
                <td colspan='2'><label class='text-line'>{$doct}</label></td>
            </tr>
            <tr>
                <td width='35%'>Address</td>
                <td colspan='2'><label class='text-line'>{$doct}{$row["Address"]}</label></td>
            </tr>
            <tr>
                <td width='35%'></td>
                <td colspan='2'><label class='text-line'>{$doct}</label></td>
            </tr>
            <tr>
                <td width='35%'>Contact</td>
                <td><label width='5%'>Phone</label></td>
                <td><label width='60%' class='text-line'>{$doct}{$row["Phno"]}</label></td>
            </tr>
            <tr>
                <td width='35%'></td>
                <td><label width='5%'>Email</label></td>
                <td><label width='60%' class='text-line'>{$doct}{$row["Email"]}</label></td>
            </tr>
        </table>
        <br><br>
        <div class='form-group text-right'>
            <label class='col-form-label'>---------------------------</label>
            <br>
            <label class='col-form-label mr-5'>Signature</label>
        </div>";
        echo $out;
    }else{
        $out.="<h3 class='text-center'>ANAWRAHTA SHWE THAMANAY SCHOOL</h3>
        <div class='form-group row'>
            <label class='col-sm-12 col-md-12 col-form-label'>No record found.</label>
        </div>";
        echo $out;
    }
}



?>
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
        $sql="select * from tblstudent order by AID desc limit $offset,$limit_per_page";
    }else{ 
        $sql="select * from tblstudent where (School_Mark like '%$search%' or 
        Student_Name like '%$search%') order by AID desc limit $offset,$limit_per_page";  
    }
    
    $result=mysqli_query($con,$sql) or die("SQL a Query");
    $out="";
    if(mysqli_num_rows($result) > 0){
        $out.='
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ကျောင်းဝင်အမှတ်</th>
                    <th>ကျောင်းဝင်ရက်စွဲ</th>
                    <th>အမည်</th>
                    <th>မွေးသက္ကရာဇ်</th>
                    <th>အဖအမည်</th>
                    <th>နေရပ်လိပ်စာ</th>
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
                <td>{$row["School_Mark"]}</td>
                <td>".enDate($row["School_Date"])."</td> 
                <td>{$row["Student_Name"]}</td>
                <td>".enDate($row["DOB"])."</td> 
                <td>{$row["Father_Name"]}</td>
                <td>{$row["Always_Address"]}</td> 
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
            $sql_total="select AID from tblstudent order by AID desc";
        }else{ 
            $sql_total="select AID from tblstudent where (School_Mark like '%$search%' or 
            Student_Name like '%$search%') order by AID desc";  
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
                    <th>ကျောင်းဝင်အမှတ်</th>
                    <th>ကျောင်းဝင်ရက်စွဲ</th>
                    <th>အမည်</th>
                    <th>မွေးသက္ကရာဇ်</th>
                    <th>အဖအမည်</th>
                    <th>နေရပ်လိပ်စာ</th>
                    <th>မှတ်ချက်</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center" colspan="9">No record found.</td>
            </tr>
            </tbody>
        </table>';
    echo $out;
    }
  
}



if($action == 'save'){    
    $sno=$_POST['sno'];
    $sdate=$_POST['sdate'];
    $sname=$_POST['sname'];
    $sdob=$_POST['sdob'];
    $fname=$_POST['fname'];
    $fwork=$_POST['fwork'];
    $mname=$_POST['mname'];
    $mwork=$_POST['mwork'];
    $caddress=$_POST['caddress'];
    $raddress=$_POST['raddress'];
    $nation=$_POST['nation'];
    $religion=$_POST['religion'];
    $lastschool=$_POST['lastschool'];
    $maxgrade=$_POST['maxgrade'];
    $startgrade=$_POST['startgrade'];
    $grade=$_POST['grade'];
    $gteacher=$_POST['gteacher'];
    $rmk=$_POST['rmk'];

    if($_FILES['file1']['name'] != ''){           
        $filename = $_FILES['file1']['name'];
        $extension = pathinfo($filename,PATHINFO_EXTENSION);
        $old_path = $_FILES['file1']['tmp_name'];
        $valid_extension = array("PNG","JPEG","JPG","png","jpg","jpeg");

        if(in_array($extension,$valid_extension)){  
            $new_filename = rand(1,100) ."_". $filename;
            $new_path = root."lib/upload/student_images/". $new_filename;
            if(move_uploaded_file($old_path,$new_path)){
                $sql = "insert into tblstudent (School_Mark,School_Date,Student_Name,DOB,Father_name,
                Father_Work,Mother_Name,Mother_Work,Real_Address,Always_Address,Nation,Religion,
                Last_School,Max_Grade,Start_Grade,Grade,Grade_Teacher,Rmk,Img) values ('{$sno}',
                '{$sdate}','{$sname}','{$sdob}','{$fname}','{$fwork}','{$mname}','{$mwork}','{$caddress}',
                '{$raddress}','{$nation}','{$religion}','{$lastschool}','{$maxgrade}','{$startgrade}',
                '{$grade}','{$gteacher}','{$rmk}','{$new_filename}')";
                
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
        $sql = "insert into tblstudent (School_Mark,School_Date,Student_Name,DOB,Father_name,
        Father_Work,Mother_Name,Mother_Work,Real_Address,Always_Address,Nation,Religion,
        Last_School,Max_Grade,Start_Grade,Grade,Grade_Teacher,Rmk) values ('{$sno}',
        '{$sdate}','{$sname}','{$sdob}','{$fname}','{$fwork}','{$mname}','{$mwork}','{$caddress}',
        '{$raddress}','{$nation}','{$religion}','{$lastschool}','{$maxgrade}','{$startgrade}',
        '{$grade}','{$gteacher}','{$rmk}')";
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
    $sql="select * from tblstudent where AID=$aid";
    $result = mysqli_query($con,$sql);
    $out="";
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $out.="
        <input type='hidden' name='aid' value='{$row["AID"]}'>
        <div class='modal-body row'>
            <div class='form-group col-md-4'>
                <label for=''>ကျောင်းဝင်အမှတ်(ကျောင်းမှဖြည့်ရန်)</label>
                <input type='text' class='form-control' name='esno' placeholder='ကျောင်းဝင်အမှတ်...' 
                    value='{$row["School_Mark"]}'>
            </div>
            <div class='form-group col-md-4'>
                <label for=''>ကျောင်းဝင်ရက်စွဲ</label>
                <input type='date' class='form-control' name='esdate' placeholder='ကျောင်းဝင်ရက်စွဲ...' 
                    value='{$row["School_Date"]}'>
            </div>
            <div class='form-group col-md-4'>
                <label for=''>အမည်</label>
                <input type='text' class='form-control' name='esname' placeholder='အမည်...' 
                value='{$row["Student_Name"]}'>
            </div>
            <div class='form-group col-md-4'>
                <label for=''>မွေးသက္ကရာဇ်</label>
                <input type='date' class='form-control' name='esdob' 
                value='{$row["DOB"]}'>
            </div>
            <div class='form-group col-md-4'>
                <label for=''>အဖအမည်</label>
                <input type='text' class='form-control' name='efname' placeholder='အဖအမည်...' 
                value='{$row["Father_Name"]}'>
            </div>
            <div class='form-group col-md-4'>
                <label for=''>အလုပ်အကိုင်</label>
                <input type='text' class='form-control' name='efwork' placeholder='အလုပ်အကိုင်...' 
                value='{$row["Father_Work"]}'>
            </div>
            <div class='form-group col-md-4'>
                <label for=''>အမိအမည်</label>
                <input type='text' class='form-control' name='emname' placeholder='အမိအမည်...' 
                value='{$row["Mother_Name"]}'>
            </div>
            <div class='form-group col-md-4'>
                <label for=''>အလုပ်အကိုင်</label>
                <input type='text' class='form-control' name='emwork' placeholder='အလုပ်အကိုင်...' 
                value='{$row["Mother_Work"]}'>
            </div>
            <div class='form-group col-md-4'>
                <label for=''>ဆက်သွယ်ရန်လိပ်စာ</label>
                <input type='text' class='form-control' name='ecaddress' placeholder='ဆက်သွယ်ရန်လိပ်စာ...'
                value='{$row["Real_Address"]}'>
            </div>
            <div class='form-group col-md-4'>
                <label for=''>အမြဲနေရပ်လိပ်စာ</label>
                <input type='text' class='form-control' name='eraddress' placeholder='အမြဲနေရပ်လိပ်စာ...'
                value='{$row["Always_Address"]}'>
            </div>
            <div class='form-group col-md-4'>
                <label for=''>လူမျိုး</label>
                <input type='text' class='form-control' name='enation' placeholder='လူမျိုး...' 
                value='{$row["Nation"]}'>
            </div>
            <div class='form-group col-md-4'>
                <label for=''>ကိုးကွယ်သည့်ဘာသာ</label>
                <input type='text' class='form-control' name='ereligion' placeholder='ကိုးကွယ်သည့်ဘာသာ...'
                value='{$row["Religion"]}'>
            </div>
            <div class='form-group col-md-4'>
                <label for=''>နောက်ဆုံးနေခဲ့သည့်ကျောင်း</label>
                <input type='text' class='form-control' name='elastschool'
                    placeholder='နောက်ဆုံးနေခဲ့သည့်ကျောင်း...' value='{$row["Last_School"]}'>
            </div>
            <div class='form-group col-md-4'>
                <label for=''>အမြင့်ဆုံးအောင်မြင်ခဲ့သည့်အတန်း</label>
                <input type='text' class='form-control' name='emaxgrade'
                    placeholder='အမြင့်ဆုံးအောင်မြင်ခဲ့သည့်အတန်း...' value='{$row["Max_Grade"]}'>
            </div>
            <div class='form-group col-md-4'>
                <label for=''>ဝင်စတွင်ချထားသည့်အခန်း</label>
                <input type='text' class='form-control' name='estartgrade'
                    placeholder='ဝင်စတွင်ချထားသည့်အခန်း...' value='{$row["Start_Grade"]}'>
            </div>
            <div class='form-group col-md-4'>
                <label for=''>တန်းခွဲ(ကျောင်းမှဖြည့်ရန်)</label>
                <input type='text' class='form-control' name='egrade' placeholder='တန်းခွဲ...' value='{$row["Grade"]}'>
            </div>
            <div class='form-group col-md-4'>
                <label for=''>အတန်းပိုင်အမည်(ကျောင်းမှဖြည့်ရန်)</label>
                <input type='text' class='form-control' name='egteacher' placeholder='အတန်းပိုင်အမည်...'
                value='{$row["Grade_Teacher"]}'>
            </div>
            <div class='form-group col-md-4'>
                <label for=''>မှတ်ချက်</label>
                <input type='text' class='form-control' name='ermk' placeholder='မှတ်ချက်...' value='{$row["Rmk"]}'>
            </div>
        </div>
        <div class='modal-footer'>
            <button type='button' class='btn btn-secondary' data-dismiss='modal'><i
                    class='fa fa-close'></i>Close</button>
            <button type='submit' id='btneditsave' class='btn btn-primary'><i class='fa fa-edit'></i>&nbsp;Edit Student</button>
        </div>
        ";

        echo $out;
    }
}


if($action == 'edit'){ 
    $aid=$_POST['aid'];
    $sno=$_POST['esno'];
    $sdate=$_POST['esdate'];
    $sname=$_POST['esname'];
    $sdob=$_POST['esdob'];
    $fname=$_POST['efname'];
    $fwork=$_POST['efwork'];
    $mname=$_POST['emname'];
    $mwork=$_POST['emwork'];
    $caddress=$_POST['ecaddress'];
    $raddress=$_POST['eraddress'];
    $nation=$_POST['enation'];
    $religion=$_POST['ereligion'];
    $lastschool=$_POST['elastschool'];
    $maxgrade=$_POST['emaxgrade'];
    $startgrade=$_POST['estartgrade'];
    $grade=$_POST['egrade'];
    $gteacher=$_POST['egteacher'];
    $rmk=$_POST['ermk'];

    $sql="update tblstudent set School_Mark='{$sno}',School_Date='{$sdate}',Student_Name='{$sname}',
    DOB='{$sdob}',Father_Name='{$fname}',Father_Work='{$fwork}',Mother_Name='{$mname}',Mother_Work='{$mwork}',
    Real_Address='{$caddress}',Always_Address='{$raddress}',Nation='{$nation}',Religion='{$religion}',
    Last_School='{$lastschool}',Max_Grade='{$maxgrade}',Start_Grade='{$startgrade}',Grade='{$grade}',
    Grade_Teacher='{$gteacher}',Rmk='{$rmk}' where AID={$aid}";
    
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
    $sql = "delete from tblstudent where AID=$aid";     
    if(mysqli_query($con,$sql)){

        if(!empty($_POST['path'])){
            unlink(root.'lib/upload/student_images/'.$path);
        } 
        save_log($_SESSION['username']."သည် student အား ဖျက်သွားသည်။ ");
        echo 1;
    }
    else{
        echo 0;
    }      
}


if($action=='excel'){
    $search = $_POST['ser'];
    if($search == ''){         
        $sql="select * from tblstudent order by AID desc";
    }else{ 
        $sql="select * from tblstudent where (School_Mark like '%$search%' or 
        Student_Name like '%$search%') order by AID desc";  
    }

    $result = mysqli_query($con,$sql);
    $out="";
    $fileName = "StudentReport_".date('d-m-Y').".xls";
    if(mysqli_num_rows($result) > 0)
    {
        $out .= '<head><meta charset="utf-8" /></head>
        <table >  
            <tr>
                <td colspan="19" align="center"><h3>Student Report</h3></td>
            </tr>
            <tr><td colspan="19"><td></tr>
            <tr>  
                <th style="border: 1px solid ;">စဉ်</th>  
                <th style="border: 1px solid ;">ကျောင်းဝင်အမှတ်</th>  
                <th style="border: 1px solid ;">ကျောင်းဝင်ရက်စွဲ</th>
                <th style="border: 1px solid ;">အမည်</th>  
                <th style="border: 1px solid ;">မွေးသက္ကရာဇ်</th> 
                <th style="border: 1px solid ;">အဖအမည်</th>  
                <th style="border: 1px solid ;">အလုပ်အကိုင်</th> 
                <th style="border: 1px solid ;">အမိအမည်</th>  
                <th style="border: 1px solid ;">အလုပ်အကိုင်</th> 
                <th style="border: 1px solid ;">ဆက်သွယ်ရန်လိပ်စာ</th>  
                <th style="border: 1px solid ;">အမြဲတမ်းနေရပ်လိပ်စာ</th> 
                <th style="border: 1px solid ;">လူမျိုး</th>  
                <th style="border: 1px solid ;">ကိုးကွယ်သည့်ဘာသာ</th> 
                <th style="border: 1px solid ;">နောက်ဆုံးနေခဲ့သည့်ကျောင်း</th>  
                <th style="border: 1px solid ;">အမြင့်ဆုံးအောင်မြင်ခဲ့သည့်အတန်း</th> 
                <th style="border: 1px solid ;">ဝင်စတွင်ချထားသည့်အတန်း</th>  
                <th style="border: 1px solid ;">တန်းခွဲ</th> 
                <th style="border: 1px solid ;">အတန်းပိုင်အမည်</th>  
                <th style="border: 1px solid ;">မှတ်ချက်</th> 
            </tr>';
        $no=0;
        while($row = mysqli_fetch_array($result))
        {
            $no = $no + 1;
            $out .= '
                <tr>  
                    <td style="border: 1px solid ;">'.$no.'</td>  
                    <td style="border: 1px solid ;">'.$row["School_Mark"].'</td>  
                    <td style="border: 1px solid ;">'.enDate($row["School_Date"]).'</td> 
                    <td style="border: 1px solid ;">'.$row["Student_Name"].'</td>  
                    <td style="border: 1px solid ;">'.enDate($row["DOB"]).'</td>
                    <td style="border: 1px solid ;">'.$row["Father_Name"].'</td>   
                    <td style="border: 1px solid ;">'.$row["Father_Work"].'</td> 
                    <td style="border: 1px solid ;">'.$row["Mother_Name"].'</td>  
                    <td style="border: 1px solid ;">'.$row["Mother_Work"].'</td> 
                    <td style="border: 1px solid ;">'.$row["Real_Address"].'</td>  
                    <td style="border: 1px solid ;">'.$row["Always_Address"].'</td>
                    <td style="border: 1px solid ;">'.$row["Nation"].'</td>   
                    <td style="border: 1px solid ;">'.$row["Religion"].'</td> 
                    <td style="border: 1px solid ;">'.$row["Last_School"].'</td>  
                    <td style="border: 1px solid ;">'.$row["Max_Grade"].'</td> 
                    <td style="border: 1px solid ;">'.$row["Start_Grade"].'</td>  
                    <td style="border: 1px solid ;">'.$row["Grade"].'</td>
                    <td style="border: 1px solid ;">'.$row["Grade_Teacher"].'</td>   
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
                <td colspan="19" align="center"><h3>Student Report</h3></td>
            </tr>
            <tr><td colspan="19"><td></tr>
            <tr>  
                <th style="border: 1px solid ;">စဉ်</th>  
                <th style="border: 1px solid ;">ကျောင်းဝင်အမှတ်</th>  
                <th style="border: 1px solid ;">ကျောင်းဝင်ရက်စွဲ</th>
                <th style="border: 1px solid ;">အမည်</th>  
                <th style="border: 1px solid ;">မွေးသက္ကရာဇ်</th> 
                <th style="border: 1px solid ;">အဖအမည်</th>  
                <th style="border: 1px solid ;">အလုပ်အကိုင်</th> 
                <th style="border: 1px solid ;">အမိအမည်</th>  
                <th style="border: 1px solid ;">အလုပ်အကိုင်</th> 
                <th style="border: 1px solid ;">ဆက်သွယ်ရန်လိပ်စာ</th>  
                <th style="border: 1px solid ;">အမြဲတမ်းနေရပ်လိပ်စာ</th> 
                <th style="border: 1px solid ;">လူမျိုး</th>  
                <th style="border: 1px solid ;">ကိုးကွယ်သည့်ဘာသာ</th> 
                <th style="border: 1px solid ;">နောက်ဆုံးနေခဲ့သည့်ကျောင်း</th>  
                <th style="border: 1px solid ;">အမြင့်ဆုံးအောင်မြင်ခဲ့သည့်အတန်း</th> 
                <th style="border: 1px solid ;">ဝင်စတွင်ချထားသည့်အတန်း</th>  
                <th style="border: 1px solid ;">တန်းခွဲ</th> 
                <th style="border: 1px solid ;">အတန်းပိုင်အမည်</th>  
                <th style="border: 1px solid ;">မှတ်ချက်</th> 
            </tr>
            <tr>
                <td style="border: 1px solid ;" colspan="19">No record found.</td>
            </tr>
            </table>';
            header('Content-Type: application/xls');
            header('Content-Disposition: attachment; filename='.$fileName);
            echo $out;
    }   
}

if($action == 'changephoto'){
    if($_FILES['file2']['name'] != ''){  
        $aid=$_POST['paid'];
        $path=$_POST['pimg'];

        $filename = $_FILES['file2']['name'];
        $extension = pathinfo($filename,PATHINFO_EXTENSION);
        $old_path = $_FILES['file2']['tmp_name'];
        $valid_extension = array("PNG","JPEG","JPG","png","jpg","jpeg");
    
        if(in_array($extension,$valid_extension)){  

            if(!empty($_POST['pimg'])){
                unlink(root.'lib/upload/student_images/'.$path);
            } 

            $new_filename = rand(1,100) ."_". $filename;
            $new_path = root."lib/upload/student_images/". $new_filename;
            if(move_uploaded_file($old_path,$new_path)){
                $sql = "update tblstudent set Img='{$new_filename}' where AID=$aid";
                
                if(mysqli_query($con,$sql)){
                    save_log($_SESSION['username']."သည် student ဓါတ်ပုံအား ပြင်ဆင်သွားသည်။ ");
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
    $sql = "select * from tblstudent where AID=$aid";
    $res = mysqli_query($con,$sql);
    $out="";
    $src="";
    $doct="၊&nbsp;&nbsp;&nbsp;&nbsp;";
    if(mysqli_num_rows($res) > 0){
        $row = mysqli_fetch_array($res);
        
        $out.="<h3 class='text-center'>ဖောင်တော်ဦး ဘုန်းတော်ကြီးသင် ပညာရေး(တွဲဖက်)အထက်တန်းကျောင်း</h3>
        <h4 class='text-center'>(ဝင်ခွင့်လျှောက်လွှာ)</h4>";
        if($row["Img"] != ''){
            $src = roothtml.'lib/upload/student_images/'.$row["Img"];
            $out.="<div class='form-group float-right border border-info p-1' style='width:13%;height:100px;'>
                <img src='{$src}'  style='width:100%;height:90px;'/>
            </div>";
        }else{
            $out.="<div class='form-group float-right border border-info p-1' style='width:13%;height:100px;'>
                
            </div>";
        }
        
        $out.="<table width='100%'>
            <tr>
                <td width='35%'>၁။  ကျောင်းဝင်အမှတ်</td>
                <td colspan='2'><label class='text-line'>{$doct}{$row["School_Mark"]}</label></td>
            </tr>
            <tr>
                <td width='35%'>၂။  ကျောင်းဝင်ရက်စွဲ</td>
                <td colspan='2'><label class='text-line'>{$doct}".enDate($row["School_Date"])."</label></td>
            </tr>
            <tr>
                <td width='35%'>၃။  အမည်</td>
                <td colspan='2'><label class='text-line'>{$doct}{$row["Student_Name"]}</label></td>
            </tr>
            <tr>
                <td width='35%'>၄။  မွေးသက္ကရာဇ်</td>
                <td colspan='2'><label class='text-line'>{$doct}".enDate($row["DOB"])."</label></td>
            </tr>
            <tr>
                <td width='35%'>၅။  အဖအမည်</td>
                <td colspan='2'><label class='text-line'>{$doct}{$row["Father_Name"]}</label></td>
            </tr>
            <tr>
                <td width='35%'>၆။  အလုပ်အကိုင်</td>
                <td colspan='2'><label class='text-line'>{$doct}{$row["Father_Work"]}</label></td>
            </tr>
            <tr>
                <td width='35%'>၇။  အမိအမည်</td>
                <td colspan='2'><label class='text-line'>{$doct}{$row["Mother_Name"]}</label></td>
            </tr>
            <tr>
                <td width='35%'>၈။  အလုပ်အကိုင်</td>
                <td colspan='2'><label class='text-line'>{$doct}{$row["Mother_Work"]}</label></td>
            </tr>
            <tr>
                <td width='35%'>၉။  ဆက်သွယ်ရန်လိပ်စာ</td>
                <td colspan='2'><label class='text-line'>{$doct}{$row["Real_Address"]}</label></td>
            </tr>
            <tr>
                <td width='35%'>၁၀။  အမြဲနေရပ်လိပ်စာ</td>
                <td colspan='2'><label class='text-line'>{$doct}{$row["Always_Address"]}</label></td>
            </tr>
            <tr>
                <td width='35%'>၁၁။  လူမျိုးနှင့်ကိုးကွယ်သည့်ဘာသာ</td>
                <td colspan='2'><label class='text-line'>{$doct}{$row["Nation"]} ၊ {$row["Religion"]}</label></td>
            </tr>
            <tr>
                <td width='35%'>၁၂။  နောက်ဆုံးနေခဲ့သည့်ကျောင်း</td>
                <td colspan='2'><label class='text-line'>{$doct}{$row["Last_School"]}</label></td>
            </tr>
            <tr>
                <td width='35%'>၁၃။  အမြင့်ဆုံးအောင်မြင်ခဲ့သည့်အတန်း</td>
                <td colspan='2'><label class='text-line'>{$doct}{$row["Max_Grade"]}</label></td>
            </tr>
            <tr>
                <td width='35%'>၁၄။  ဝင်စတွင်ချထားသည့်အတန်း</td>
                <td colspan='2'><label class='text-line'>{$doct}{$row["Start_Grade"]}</label></td>
            </tr>
            <tr>
                <td width='35%'>၁၅။  တန်းခွဲ</td>
                <td colspan='2'><label class='text-line'>{$doct}{$row["Grade"]}</label></td>
            </tr>
            <tr>
                <td width='35%'>၁၆။  အတန်းပိုင်အမည်</td>
                <td colspan='2'><label class='text-line'>{$doct}{$row["Grade_Teacher"]}</label></td>
            </tr>
        </table>
        <br>
        <label class='col-form-label text-center'><b>မှတ်ချက်။   ဤဝင်ခွင့်ဖြတ်ပိုင်းသည် အတန်းပိုင်များထံသို့ အပ်နှံမှသာလျှင် အတန်းစာရင်းတွင်ဝင်မည်ဖြစ်ပါသည်။<b></label>";
        echo $out;
    }else{
        $out.="<h3 class='text-center'>ဖောင်တော်ဦး ဘုန်းတော်ကြီးသင် ပညာရေး(တွဲဖက်)အထက်တန်းကျောင်း</h3>
        <div class='form-group text-center'>
            <label class='col-form-label'>No record found.</label>
        </div>";
        echo $out;
    }
}



?>
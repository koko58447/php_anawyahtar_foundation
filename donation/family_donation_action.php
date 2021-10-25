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
        $sql="select * from tblmain_donation where Status='family' 
        order by AID desc limit $offset,$limit_per_page";
    }else{ 
        $sql="select * from tblmain_donation where Status='family' 
        and (Donater like '%$search%' or Phno like '%$search%' or 
        Address like '%$search%') order by AID desc limit $offset,$limit_per_page";  
    }
    
    $result=mysqli_query($con,$sql) or die("SQL a Query");
    $out="";
    if(mysqli_num_rows($result) > 0){
        $out.='
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                <th>စဉ်</th>
                <th>နေ့စွဲ</th>
                <th>အလှူရှင်အမည်</th>
                <th>နေရပ်လိပ်စာ</th>
                <th>ဖုန်းနံပါတ်</th>                   
                <th>အကျိုးဆောင်</th>
                <th>မှတ်တမ်းဝင်အမှတ်</th>
                <th>လှူဒါန်းငွေ</th>                   
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
                <td>".enDate($row["Date"])."</td>
                <td>{$row["Donater"]}</td>
                <td>{$row["Address"]}</td>
                <td>{$row["Phno"]}</td>                
                <td>{$row["Done"]}</td> 
                <td>{$row["No"]}</td>
                <td>".number_format($row["Amount"])."</td>               
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
                            data-aid='{$row['AID']}'><i
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
            $sql_total="select AID from tblmain_donation where Status='family' 
            order by AID desc";
        }else{ 
            $sql_total="select AID from tblmain_donation where Status='family' 
            and (Donater like '%$search%' or Phno like '%$search%' or 
            Address like '%$search%') order by AID desc";  
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
                <th>စဉ်</th>
                <th>နေ့စွဲ</th>
                <th>အလှူရှင်အမည်</th>
                <th>နေရပ်လိပ်စာ</th>
                <th>ဖုန်းနံပါတ်</th>                   
                <th>အကျိုးဆောင်</th>
                <th>မှတ်တမ်းဝင်အမှတ်</th>
                <th>လှူဒါန်းငွေ</th>                   
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
    $dname=$_POST['dname'];
    $address=$_POST['address'];
    $phno=$_POST['phno'];
    $done=$_POST['done'];
    $no=$_POST['no'];
    $amount=$_POST['amount'];
    $date=$_POST['date'];
    $rmk=$_POST['rmk'];

    $sql="insert into tblmain_donation (Donater,Address,Phno,Done,No,Amount,Date,Rmk,Status) 
    values ('{$dname}','{$address}','{$phno}','{$done}','{$no}','{$amount}','{$date}','{$rmk}','family')";
    
    if(mysqli_query($con,$sql)){
        save_log($_SESSION['username']."သည် သာသနာပြုမိသားစုအလှူအား အသစ်သွင်းသွားသည်။ ");
        echo 1;
    }else{
        echo 0;
    }

}


if($action=='prepare'){
    $aid=$_POST['aid'];
    $sql="select * from tblmain_donation where AID=$aid";
    $result = mysqli_query($con,$sql);
    $out="";
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $out.="
            <input type='hidden' name='aid' value='{$row["AID"]}'>
                <div class='modal-body row'>                    
                    <div class='col-md-6 form-group'>
                        <label for=''>အလှူရှင်အမည်</label>
                        <input type='text' class='form-control' name='edname' value='{$row["Donater"]}'
                            placeholder='Enter donar name' required>
                    </div>
                    <div class='col-md-6 form-group'>
                        <label for=''>ဖုန်းနံပါတ်</label>
                        <input type='text' class='form-control' name='ephno' value='{$row["Phno"]}'
                            placeholder='Enter phone no' required>
                    </div>
                    <div class=' col-md-6 form-group'>
                        <label for=''>နေရပ်လိပ်စာ</label>
                        <input type='text' class='form-control' name='eaddress' value='{$row["Address"]}'
                            placeholder='Enter address' required>
                    </div>
                    <div class='col-md-6 form-group'>
                        <label for=''>အကျိုးဆောင်</label>
                        <input type='text' class='form-control' name='edone' value='{$row["Done"]}'
                            placeholder='Enter done' required>
                    </div>
                    <div class='col-md-6 form-group'>
                        <label for=''>မှတ်တမ်းဝင်အမှတ်</label>
                        <input type='text' class='form-control' name='eno' value='{$row["No"]}'
                            placeholder='Enter no' required>
                    </div>
                    <div class='col-md-6 form-group'>
                        <label for=''>လှူဒါန်းငွေ</label>
                        <input type='number' class='form-control' name='eamount' value='{$row["Amount"]}'
                            placeholder='Enter amount' required>
                    </div>
                    <div class='col-md-6 form-group'>
                        <label for=''>ရက်စွဲ</label>
                        <input type='date' class='form-control' name='edate' value='{$row["Date"]}'
                            placeholder='Enter date' required>
                    </div>
                    <div class='col-md-6 form-group'>
                        <label for=''>မှတ်ချက်</label>
                        <input type='text' class='form-control' name='ermk' value='{$row["Rmk"]}'
                            placeholder='Enter remark' required>
                    </div>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'><i
                            class='fa fa-close'></i>Close</button>
                    <button type='submit' id='btneditsave' class='btn btn-primary'><i class='fa fa-edit'></i>Edit</button>
                </div>
        ";

        echo $out;
    }
}


if($action == 'edit'){ 
    $aid=$_POST['aid'];
    $dname=$_POST['edname'];
    $address=$_POST['eaddress'];
    $phno=$_POST['ephno'];
    $done=$_POST['edone'];
    $no=$_POST['eno'];
    $amount=$_POST['eamount'];
    $date=$_POST['edate'];
    $rmk=$_POST['ermk'];

    $sql="update tblmain_donation set Donater='{$dname}',Address='{$address}',Phno='{$phno}',
    Done='{$done}',No='{$no}',Amount='{$amount}',Date='{$date}',Rmk='{$rmk}' where AID={$aid}";
    
    if(mysqli_query($con,$sql)){  
        save_log($_SESSION['username']."သည် သာသနာပြုမိသားစုအလှူအား ပြင်ဆင်သွားသည်။ ");        
        echo 1;
    }else{
        echo 0;
    }
}

if($action == 'delete'){
    $aid = $_POST["aid"];
    $sql = "delete from tblmain_donation where AID=$aid";     
    if(mysqli_query($con,$sql)){
        save_log($_SESSION['username']."သည် သာသနာပြုမိသားစုအလှူအား ဖျက်သွားသည်။ ");
        echo 1;
    }
    else{
        echo 0;
    }      
}


if($action=='excel'){
    $search = $_POST['ser'];
    if($search == ''){         
        $sql="select * from tblmain_donation where Status='family' 
        order by AID desc";
    }else{ 
        $sql="select * from tblmain_donation where Status='family' 
        and (Donater like '%$search%' or Phno like '%$search%' or 
        Address like '%$search%') order by AID desc";  
    }

    $result = mysqli_query($con,$sql);
    $out="";
    $fileName = "သာသနာပြုမိသားစုအလှူ Report_".date('d-m-Y').".xls";
    if(mysqli_num_rows($result) > 0)
    {
        $out .= '<head><meta charset="utf-8" /></head>
        <table >  
            <tr>
            <td colspan="9" align="center"><h3>အနော်ရထာတက္ကသိုလ် သာသနာပြုမိသားစုအလှူရှင်များ စာရင်း</h3></td>
            </tr>
            <tr><td colspan="9"><td></tr>
            <tr>                 
                <th style="border: 1px solid ;">စဉ်</th>
                <th style="border: 1px solid ;">နေ့စွဲ</th>
                <th style="border: 1px solid ;">အလှူရှင်အမည်</th>
                <th style="border: 1px solid ;">နေရပ်လိပ်စာ</th>
                <th style="border: 1px solid ;">ဖုန်းနံပါတ်</th>                   
                <th style="border: 1px solid ;">အကျိုးဆောင်</th>
                <th style="border: 1px solid ;">မှတ်တမ်းဝင်အမှတ်</th>
                <th style="border: 1px solid ;">လှူဒါန်းငွေ</th>                   
                <th style="border: 1px solid ;">မှတ်ချက်</th>               
            </tr>';
        $no=0;
        while($row = mysqli_fetch_array($result))
        {
            $no = $no + 1;
            $out .= '
                <tr>  
                    <td style="border: 1px solid ;">'.$no.'</td>  
                    <td style="border: 1px solid ;">'.enDate($row["Date"]).'</td>  
                    <td style="border: 1px solid ;">'.$row["Donater"].'</td>  
                    <td style="border: 1px solid ;">'.$row["Address"].'</td>  
                    <td style="border: 1px solid ;">'.$row["Phno"].'</td>                   
                    <td style="border: 1px solid ;">'.$row["Done"].'</td>
                    <td style="border: 1px solid ;">'.$row["No"].'</td>  
                    <td style="border: 1px solid ;">'.number_format($row["Amount"]).'</td>
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
                <td colspan="9" align="center"><h3>အနော်ရထာတက္ကသိုလ် သာသနာပြုမိသားစုအလှူရှင်များ စာရင်း</h3></td>
            </tr>
            <tr><td colspan="9"><td></tr>
            <tr>  
            <th style="border: 1px solid ;">စဉ်</th>
            <th style="border: 1px solid ;">နေ့စွဲ</th>
            <th style="border: 1px solid ;">အလှူရှင်အမည်</th>
            <th style="border: 1px solid ;">နေရပ်လိပ်စာ</th>
            <th style="border: 1px solid ;">ဖုန်းနံပါတ်</th>                   
            <th style="border: 1px solid ;">အကျိုးဆောင်</th>
            <th style="border: 1px solid ;">မှတ်တမ်းဝင်အမှတ်</th>
            <th style="border: 1px solid ;">လှူဒါန်းငွေ</th>                   
            <th style="border: 1px solid ;">မှတ်ချက်</th>  
            </tr>
            <tr>
                <td style="border: 1px solid ;" colspan="9">No record found.</td>
            </tr>
            </table>';
            header('Content-Type: application/xls');
            header('Content-Disposition: attachment; filename='.$fileName);
            echo $out;
    }   
}


?>
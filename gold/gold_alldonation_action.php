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
        $sql="select * from tblgold_donation group by VNO order by AID desc 
        limit $offset,$limit_per_page";
    }else{ 
        $sql="select * from tblgold_donation where CusName like '%$search%' or 
        VNO like '%$search%' group by VNO order by AID desc 
        limit $offset,$limit_per_page";  
    }
    
    $result=mysqli_query($con,$sql) or die("SQL a Query");
    $out="";
    if(mysqli_num_rows($result) > 0){
        $out.='
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>စဉ်</th> 
                    <th>ရက်စွဲ</th>                  
                    <th>အလှူရှင်အမည်</th>
                    <th>နေရပ်လိပ်စာ</th>
                    <th>ဖုန်းနံပါတ်</th>                   
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
                <td>{$row["CusName"]}</td>
                <td>{$row["Address"]}</td> 
                <td>{$row["Phno"]}</td>  
                <td>{$row["Rmk"]}</td>
                <td class='text-center'>
                    <div class='dropdown'>
                      <a class='btn btn-link font-30 p-0 line-height-1'
                            href='#' role='button' data-toggle='dropdown'>
                            <i class='fa fa-more-vert'>ooo</i>
                      </a>
                    <div class='dropdown-menu dropdown-menu-right dropdown-menu-icon-list'>  
                        <a href='#' id='btnviewdetail' class='dropdown-item'
                            data-vno='{$row['VNO']}'
                            data-cusname='{$row['CusName']}'
                            data-address='{$row['Address']}'
                            data-phno='{$row['Phno']}'
                            data-no='{$row['No']}'
                            data-dt='{$row['Date']}'
                            data-rmk='{$row['Rmk']}'><i
                            class='fa fa-eye text-success'
                            style='font-size:15px;'></i>
                            View Detail</a>
                        <a href='#' id='btnedit' class='dropdown-item'
                            data-vno='{$row['VNO']}'
                            data-cusname='{$row['CusName']}'
                            data-address='{$row['Address']}'
                            data-phno='{$row['Phno']}'
                            data-no='{$row['No']}'
                            data-dt='{$row['Date']}'
                            data-rmk='{$row['Rmk']}'><i
                            class='fa fa-edit text-primary'
                            style='font-size:15px;'></i>
                            Edit</a>
                        <a href='#' id='btndelete' class='dropdown-item'
                            data-vno='{$row['VNO']}'><i
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
            $sql_total="select * from tblgold_donation group by VNO order by AID desc";
        }else{ 
            $sql_total="select * from tblgold_donation where CusName like '%$search%' or 
            VNO like '%$search%' group by VNO order by AID desc";  
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
                    <th>ရက်စွဲ</th>                  
                    <th>အလှူရှင်အမည်</th>
                    <th>နေရပ်လိပ်စာ</th>
                    <th>ဖုန်းနံပါတ်</th>                   
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


if($action == 'detail'){
    $vno = $_POST["vno"];
    $cusname = $_POST["cusname"];
    $address = $_POST["address"];
    $phno = $_POST["phno"];
    $no = $_POST["no"];
    $dt = $_POST["dt"];
    $rmk = $_POST["rmk"];
    $out="";
    $doct="၊&nbsp;&nbsp;&nbsp;&nbsp;";
    $out.="<h3 class='text-center'>အနော်ရထာဖောင်ဒေးရှင်း</h3>
    <table width='100%'>
        <tr>
            <td width='35%'>၁။  အလှူရှင်အမည်</td>
            <td><label class='text-line'>{$doct}{$cusname}</label></td>
        </tr>
        <tr>
            <td width='35%'>၂။  ဖုန်းနံပါတ်</td>
            <td><label class='text-line'>{$doct}{$phno}</label></td>
        </tr>
        <tr>
            <td width='35%'>၃။  နေရပ်လိပ်စာ</td>
            <td><label class='text-line'>{$doct}{$address}</label></td>
        </tr>
        <tr>
            <td width='35%'>၄။  ရက်စွဲ</td>
            <td><label class='text-line'>{$doct}{$dt}</label></td>
        </tr>
    </table><br>
    ";

    $out.="<h5 class='text-center'><b>လှူဒါန်းထားသောပစ္စည်းများ<b></h5>";
    $sql = "select ItemID,ItemName,Qty,Price from tblgold_donation where VNO='{$vno}'";
    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result) > 0){
        $out.='
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr class="text-center">
                    <th>စဉ်</th>
                    <th>ပစ္စည်းအမျိုးအမည်</th>
                    <th>အရေအတွက်</th>
                    <th>တန်ဖိုး</th>
                </tr>
            </thead>
            <tbody>
        ';
        $no=0;   
        while($row = mysqli_fetch_array($result)){
            $no = $no + 1;
            $out.="<tr>
                <td class='text-center'>{$no}</td>
                <td>{$row["ItemName"]}</td>
                <td class='text-center'>{$row["Qty"]}</td>
                <td class='text-right'>".number_format($row["Price"])."</td>
            </tr>
            ";
        }
        $out.="</tbody></table>";
    }  
    
    echo $out;
}


if($action == 'edit'){
    unset($_SESSION["cart_item"]);
    $vno = $_POST["vno"];
    $cusname = $_POST["cusname"];
    $address = $_POST["address"];
    $phno = $_POST["phno"];
    $no = $_POST["no"];
    $dt = $_POST["dt"];
    $rmk = $_POST["rmk"];

    $sql = "select ItemID,ItemName,Qty,Price from tblgold_donation where VNO='{$vno}'";
    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result) > 0){   
        while($row = mysqli_fetch_array($result)){
            $itemArray = array(
                'aid' => $row['ItemID'],
                'itemname' => $row['ItemName'], 
                'price' => $row['Price'],
                'qty' => $row['Qty'] 
            );
            $_SESSION['cart_item'][]  = $itemArray;
        }

        $_SESSION["edititem_vno"] = $vno;
        $_SESSION["edititem_cusname"] = $cusname;
        $_SESSION["edititem_phno"] = $phno;
        $_SESSION["edititem_address"] = $address;
        $_SESSION["edititem_no"] = $no;
        $_SESSION["edititem_dt"] = $dt;
        $_SESSION["edititem_rmk"] = $rmk;
        $_SESSION["edititem_key"] = 'kill';
    }         
}


if($action == 'delete'){
    $vno = $_POST["vno"];
    $sql = "delete from tblgold_donation where VNO='{$vno}'";     
    if(mysqli_query($con,$sql)){
        save_log($_SESSION['username']."သည် ရွှေသာမနေအလှူအား ဖျက်သွားသည်။ ");
        echo 1;
    }
    else{
        echo 0;
    }      
}




?>
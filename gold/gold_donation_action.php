<?php
include('../config.php');

$action = $_POST["action"];


if($action == 'show'){  
    $_SESSION["edititem_key"] = '';

    $limit_per_page = 12;
    
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
        $sql="select * from tbldonation_item  
        order by AID desc limit $offset,$limit_per_page";
    }else{ 
        $sql="select * from tbldonation_item where Item_Name like '%$search%' 
        order by AID desc limit $offset,$limit_per_page";  
    }
    
    $result=mysqli_query($con,$sql) or die("SQL a Query");
    $out="";
    $src="";
    if(mysqli_num_rows($result) > 0){
        $out.='<div class="row">';
        $no=0;
        while($row = mysqli_fetch_array($result)){
            if($row["Img"] == ''){
                $src = roothtml.'lib/upload/noimage.jpg';
            }else{
                $src = roothtml.'lib/upload/item_images/'.$row["Img"];
            }
            $out.="
            <div class='col-md-2 col-sm-12 col-xs-12 mb-3'>
                <div class='card text-white bg-primary o-hidden h-100' style='cursor:pointer;'
                    id='addcart' 
                    data-aid='{$row['AID']}' 
                    data-itemname='{$row['Item_Name']}' 
                    data-price='{$row['Price']}' >
                    <img src='{$src}' style='width:100%; height:120px;' />
                    <label class='text-center'>{$row["Item_Name"]}</label>
                    <label class='text-center'>Price - <em>{$row["Price"]}</em></label>
                </div>
            </div>";
        }
        $out.="</div><br>";

        $sql_total="";
        if($search == ''){         
            $sql_total="select AID from tbldonation_item  
            order by AID desc";
        }else{ 
            $sql_total="select AID from tbldonation_item where Item_Name like '%$search%' 
            order by AID desc";  
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
                    <th>Donater</th>
                    <th>Student</th>
                    <th>Teacher</th>
                    <th>Done</th>
                    <th>No</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Remark</th>
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


if($action=='showsession'){
    $output="";
    $total = 0; 
    $totalqty=0;    
    if(isset($_SESSION["cart_item"])){
        $output.='
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr class="text-center">
                    <th width="5%">No</th>
                    <th>အလှူပစ္စည်း</th>
                    <th>အရေအတွက်</th>
                    <th>ဈေးနှုန်း</th>
                    <th>စုစုပေါင်း</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        ';     
        $no = 0; 
        foreach($_SESSION['cart_item'] as $key => $value){  
            $no = $no + 1;                      
            $output.="
            <tr>
                <td class='text-center'>{$no}</td>                
                <td><a id='btnqtyinc' class='btn btn-block btn-success btn-sm text-white' 
                    style='cursor:pointer;' 
                    data-aid='{$value['aid']}'
                    data-itemname='{$value['itemname']}'
                    data-price='{$value['price']}' 
                    data-qty='{$value['qty']}' >{$value['itemname']}</a></td>
                <td class='text-center'>{$value['qty']}</td>
                <td class='text-right'>".number_format($value['price'])."</td>
                <td class='text-right'>";
                $output.=number_format($value['qty'] * $value['price']);
                $output.=" </td>
                <td class='text-center' width='5%'>
                    <a href='#' id='removecart' data-aid='{$value['aid']}' >
                        <i class='fa fa-trash text-danger'></i>
                    </a>
                </td>
            </tr>
            ";
            $total = $total + ($value["qty"] * $value["price"]);
            $totalqty = $totalqty + $value["qty"];
        }
        $output.="
            <tr>
                <td colspan='2'></td>
                <td class='text-center'><b>{$totalqty}</b></td>
                <td class='text-center'><b>All Total</b></td>
                <td class='text-right'><b>".number_format($total)."</b></td>
                <td></td>
            </tr>
            </tbody>
            </table>";
        if($total == 0){
            unset($_SESSION["cart_item"]);
        }
        $output.="<div class='float-right'>
            <button type='button' id='btndeletesession' class='btn btn-danger mr-2'><i
                        class='fa fa-trash'></i>&nbsp;Delete</button>";
            if(isset($_SESSION['edititem_vno'])){
                $output.="<button type='button' id='btneditprepare' class='btn btn-success'><i
                    class='fa fa-edit'></i>&nbsp;Edit</button>";
            }else{
                $output.="<button type='button' id='btnsaveprepare' class='btn btn-info'><i
                    class='fa fa-save'></i>&nbsp;Save</button>";
            }
            $output.="</div>";
        echo $output;
    }else{
        $output.= "<p class='text-center text-danger'>No record found!</p>";
        echo $output;
    }
}


if($action=='addcart'){
    if(isset($_SESSION['cart_item'])){
        $isalreadyExist = 0;
        foreach($_SESSION['cart_item'] as $key => $value){
            
            if($_SESSION['cart_item'][$key]['aid'] == $_POST['aid']){
                $isalreadyExist++;
                $_SESSION['cart_item'][$key]['qty'] =  $_SESSION['cart_item'][$key]['qty'] + 1;
            }
        }
        if($isalreadyExist < 1){
            $itemArray = array(
                'aid' => $_POST['aid'],
                'itemname' => $_POST['itemname'], 
                'price' => $_POST['price'],
                'qty' => '1' 
            );
            $_SESSION['cart_item'][]  = $itemArray;
        }
    }else{
        $itemArray = array(
            'aid' => $_POST['aid'],
            'itemname' => $_POST['itemname'], 
            'price' => $_POST['price'],
            'qty' => '1' 
        );
        $_SESSION['cart_item'][]  = $itemArray;
    } 
    
}


if($action == 'remove_item'){
    if(isset($_SESSION['cart_item'])){
        foreach($_SESSION['cart_item'] as $key => $val){
            if( $val['aid'] == $_POST['aid']){
                unset($_SESSION['cart_item'][$key]);
            }
        }
    }
}

if($action == 'delete_session'){
    unset($_SESSION['cart_item']);
}


if($action == 'editqty'){
    if(isset($_SESSION['cart_item'])){
        foreach($_SESSION['cart_item'] as $key => $value){            
            if($_SESSION['cart_item'][$key]['aid'] == $_POST['aid']){                
                $_SESSION['cart_item'][$key]['qty'] =  $_POST['qty'];                
            }
        }
    }
}


if($action == 'save_prepare'){
    $totalqty = 0;
    $totalamt = 0;
    $out = "";
    if(isset($_SESSION['cart_item'])){
        foreach($_SESSION['cart_item'] as $key => $value){            
            $totalamt = $totalamt + ($value["qty"] * $value["price"]);
            $totalqty = $totalqty + $value["qty"];
        }
    }
    $out.="
        <div class='modal-body row'>  
            <div class='col-md-6 form-group'>
                <label for=''>အရေအတွက်</label>
                <input type='text' class='form-control' name='totalqty' value='{$totalqty}'
                    placeholder='Enter done' readonly>
            </div>
            <div class='col-md-6 form-group'>
                <label for=''>စုစုပေါင်း</label>
                <input type='text' class='form-control' name='totalamt' value='{$totalamt}'
                    placeholder='Enter no' readonly>
            </div>
            <div class='col-md-6 form-group'>
                <label for=''>အလှူရှင်အမည်</label>
                <input type='text' class='form-control' name='cusname' placeholder='Enter name'>
            </div>
            <div class='col-md-6 form-group'>
                <label for=''>ရက်စွဲ</label>
                <input type='date' class='form-control' name='cusdt' value='".date('Y-m-d')."'>
            </div>
            <div class='col-md-6 form-group'>
                <label for=''>မှတ်တမ်းဝင်အမှတ်</label>
                <input type='text' class='form-control' name='cusno' placeholder='Enter amount' >
            </div>
            <div class='col-md-6 form-group'>
                <label for=''>ဖုန်းနံပါတ်</label>
                <input type='text' class='form-control' name='cusphno' placeholder='Enter amount'>
            </div>
            <div class='col-md-6 form-group'>
                <label for=''>နေရပ်လိပ်စာ</label>
                <input type='text' class='form-control' name='cusaddress' placeholder='Enter address'>
            </div>
            <div class='col-md-6 form-group'>
                <label for=''>မှတ်ချက်</label>
                <input type='text' class='form-control' name='cusrmk' placeholder='Enter remark'>
            </div>
        </div>
        <div class='modal-footer'>
            <button type='button' class='btn btn-secondary' data-dismiss='modal'>
                <i class='fa fa-close'></i>&nbsp;Close</button>
            <button type='submit' id='btnfinishsave' class='btn btn-primary'><i class='fa fa-save'>
                </i>&nbsp;Save</button>
        </div>
    ";

    echo $out;
}


if($action == 'edit_prepare'){
    $totalqty = 0;
    $totalamt = 0;
    $out = "";
    if(isset($_SESSION['cart_item'])){
        foreach($_SESSION['cart_item'] as $key => $value){            
            $totalamt = $totalamt + ($value["qty"] * $value["price"]);
            $totalqty = $totalqty + $value["qty"];
        }
    }
    $out.="
        <div class='modal-body row'>  
            <div class='col-md-6 form-group'>
                <label for=''>အရေအတွက်</label>
                <input type='text' class='form-control' name='totalqty' value='{$totalqty}'
                    placeholder='Enter done' readonly>
            </div>
            <div class='col-md-6 form-group'>
                <label for=''>စုစုပေါင်း</label>
                <input type='text' class='form-control' name='totalamt' value='{$totalamt}'
                    placeholder='Enter no' readonly>
            </div>
            <div class='col-md-6 form-group'>
                <label for=''>အလှူရှင်အမည်</label>
                <input type='text' class='form-control' name='ecusname' placeholder='Enter name' 
                value='".(isset($_SESSION['edititem_cusname'])?$_SESSION['edititem_cusname']:'')."'>
            </div>
            <div class='col-md-6 form-group'>
                <label for=''>ရက်စွဲ</label>
                <input type='date' class='form-control' name='ecusdt' 
                value='".(isset($_SESSION['edititem_dt'])?$_SESSION['edititem_dt']:'')."'>
            </div>
            <div class='col-md-6 form-group'>
                <label for=''>မှတ်တမ်းဝင်အမှတ်</label>
                <input type='text' class='form-control' name='ecusno' placeholder='Enter amount' 
                value='".(isset($_SESSION['edititem_no'])?$_SESSION['edititem_no']:'')."'>
            </div>
            <div class='col-md-6 form-group'>
                <label for=''>ဖုန်းနံပါတ်</label>
                <input type='text' class='form-control' name='ecusphno' placeholder='Enter amount' 
                value='".(isset($_SESSION['edititem_phno'])?$_SESSION['edititem_phno']:'')."'>
            </div>
            <div class='col-md-6 form-group'>
                <label for=''>နေရပ်လိပ်စာ</label>
                <input type='text' class='form-control' name='ecusaddress' placeholder='Enter address' 
                value='".(isset($_SESSION['edititem_address'])?$_SESSION['edititem_address']:'')."'>
            </div>
            <div class='col-md-6 form-group'>
                <label for=''>မှတ်ချက်</label>
                <input type='text' class='form-control' name='ecusrmk' placeholder='Enter remark' 
                value='".(isset($_SESSION['edititem_rmk'])?$_SESSION['edititem_rmk']:'')."'>
            </div>
        </div>
        <div class='modal-footer'>
            <button type='button' class='btn btn-secondary' data-dismiss='modal'>
                <i class='fa fa-close'></i>&nbsp;Close</button>
            <button type='submit' id='btnfinishedit' class='btn btn-primary'><i class='fa fa-edit'>
                </i>&nbsp;Edit</button>
        </div>
    ";

    echo $out;
}



if($action == 'finishsave'){       
    $cusname=$_POST['cusname'];
    $cusno=$_POST['cusno'];
    $cusphno=$_POST['cusphno'];
    $cusaddress=$_POST['cusaddress'];
    $cusdt=$_POST['cusdt'];
    $cusrmk=$_POST['cusrmk'];
    $vno=uniqid();
    
    if(isset($_SESSION['cart_item'])){
        foreach($_SESSION['cart_item'] as $key => $value){

            $amt = $value["qty"] * $value["price"];

            $sql="insert into tblgold_donation (ItemID,ItemName,Qty,Price,Date,VNO,CusName,Address,Phno,No,Rmk)  
            values ('{$value["aid"]}','{$value["itemname"]}','{$value["qty"]}','{$amt}',
            '{$cusdt}','{$vno}','{$cusname}','{$cusaddress}','{$cusphno}','{$cusno}','{$cusrmk}')";
            
            mysqli_query($con,$sql);
        }

        save_log($_SESSION['username']."သည် ရွှေသာမနေအလှူအား အသစ်သွင်းသွားသည်။ ");

        unset($_SESSION['cart_item']);
        echo 1;
    }

}


if($action == 'finishedit'){       
    $cusname=$_POST['ecusname'];
    $cusno=$_POST['ecusno'];
    $cusphno=$_POST['ecusphno'];
    $cusaddress=$_POST['ecusaddress'];
    $cusdt=$_POST['ecusdt'];
    $cusrmk=$_POST['ecusrmk'];
    $vno=$_SESSION["edititem_vno"];

    $sqldel="delete from tblgold_donation where VNO='{$vno}'";
    mysqli_query($con,$sqldel);
    
    if(isset($_SESSION['cart_item'])){
        foreach($_SESSION['cart_item'] as $key => $value){

            $amt = $value["qty"] * $value["price"];

            $sql="insert into tblgold_donation (ItemID,ItemName,Qty,Price,Date,VNO,CusName,Address,Phno,No,Rmk)  
            values ('{$value["aid"]}','{$value["itemname"]}','{$value["qty"]}','{$amt}',
            '{$cusdt}','{$vno}','{$cusname}','{$cusaddress}','{$cusphno}','{$cusno}','{$cusrmk}')";
            
            mysqli_query($con,$sql);
        }

        save_log($_SESSION['username']."သည် ရွှေသာမနေအလှူအား ပြင်ဆင်သွားသည်။ ");

        unset($_SESSION['cart_item']);
        unset($_SESSION['edititem_vno']);
        unset($_SESSION['edititem_cusname']);
        unset($_SESSION['edititem_phno']);
        unset($_SESSION['edititem_address']);
        unset($_SESSION['edititem_no']);
        unset($_SESSION['edititem_dt']);
        unset($_SESSION['edititem_rmk']);
        echo 1;
    }else{
        echo 0;
    }

}



?>
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
        $sql="select i.*,c.Name from tbldonation_item i,tblcategory c 
        where i.CategoryID=c.AID order by AID desc limit $offset,$limit_per_page";
    }else{ 
        $sql="select i.*,c.Name from tbldonation_item i,tblcategory c 
        where i.CategoryID=c.AID and (c.Name like '%$search%' or i.Item_Name like '%$search%') 
        order by AID desc limit $offset,$limit_per_page";  
    }
    
    $result=mysqli_query($con,$sql) or die("SQL a Query");
    $out="";
    if(mysqli_num_rows($result) > 0){
        $out.='
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Item Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Date</th>
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
                <td>{$row["Item_Name"]}</td>
                <td>{$row["Name"]}</td> 
                <td>".number_format($row["Price"])."</td>
                <td>".enDate($row["Date"])."</td> 
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
                    </div>
                    </div>
                </td>
            </tr>";
        }
        $out.="</tbody>";
        $out.="</table>";

        $sql_total="";
        if($search == ''){         
            $sql_total="select i.AID from tbldonation_item i,tblcategory c 
            where i.CategoryID=c.AID order by AID desc";
        }else{ 
            $sql_total="select i.AID from tbldonation_item i,tblcategory c 
            where i.CategoryID=c.AID and (c.Name like '%$search%' or i.Item_Name like '%$search%') 
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
                    <th>Item Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center" colspan="6">No record found.</td>
            </tr>
            </tbody>
        </table>';
    echo $out;
    }
  
}



if($action == 'save'){    
    $iname=$_POST['iname'];
    $icategory=$_POST['icategory'];
    $idate=$_POST['idate'];
    $iprice=$_POST['iprice'];

    if($_FILES['ifile1']['name'] != ''){           
        $filename = $_FILES['ifile1']['name'];
        $extension = pathinfo($filename,PATHINFO_EXTENSION);
        $old_path = $_FILES['ifile1']['tmp_name'];
        $valid_extension = array("PNG","JPEG","JPG","png","jpg","jpeg");

        if(in_array($extension,$valid_extension)){  
            $new_filename = rand(1,100) ."_". $filename;
            $new_path = root."lib/upload/item_images/". $new_filename;
            if(move_uploaded_file($old_path,$new_path)){
                $sql = "insert into tbldonation_item (Item_Name,CategoryID,Price,Date,Img) 
                values ('{$iname}','{$icategory}','{$iprice}','{$idate}','{$new_filename}')";
                
                if(mysqli_query($con,$sql)){
                    save_log($_SESSION['username']."သည် item အား အသစ်သွင်းသွားသည်။ ");
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
        $sql = "insert into tbldonation_item (Item_Name,CategoryID,Price,Date) 
        values ('{$iname}','{$icategory}','{$iprice}','{$idate}')";
        
        if(mysqli_query($con,$sql)){
            save_log($_SESSION['username']."သည် tiem အား အသစ်သွင်းသွားသည်။ ");
            echo "success";
        }
        else{
            echo "fail";
        }
    }

}


if($action=='prepare'){
    $aid=$_POST['aid'];
    $sql="select i.*,c.Name from tbldonation_item i,tblcategory c where i.CategoryID=c.AID and i.AID=$aid";
    $result = mysqli_query($con,$sql);
    $out="";
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $out.="
        <input type='hidden' name='aid' value='{$row["AID"]}'>
        <div class='modal-body'>
            <div class='form-group'>
                <label for=''>Item Name</label>
                <input type='text' class='form-control' name='einame' placeholder='Enter Item Name...' value='{$row["Item_Name"]}'>
            </div>
            <div class='form-group'>
                <label for=''>Price</label>
                <input type='number' class='form-control' name='eiprice' placeholder='Enter Price...'
                    value='{$row["Price"]}'>
            </div>
            <div class='form-group'>
                <label for=''>Date</label>
                <input type='date' class='form-control' name='eidate' 
                    value='{$row["Date"]}'>
            </div>
            <div class='form-group'>
                <label>Category</label>
                <select class='form-control text-primary' name='eicategory'>
                    <option value='{$row["CategoryID"]}'><sub>{$row["Name"]}</sub></option>";
                    $out.= load_category(); 
                $out.="</select>
            </div>
        </div>
        <div class='modal-footer'>
            <button type='button' class='btn btn-secondary' data-dismiss='modal'><i
                    class='fa fa-close'></i>Close</button>
            <button type='submit' id='btneditsave' class='btn btn-primary'><i class='fa fa-edit'></i>&nbsp;Edit Item</button>
        </div>
        ";

        echo $out;
    }
}


if($action == 'edit'){ 
    $aid=$_POST['aid'];
    $iname=$_POST['einame'];
    $icategory=$_POST['eicategory'];
    $idate=$_POST['eidate'];
    $iprice=$_POST['eiprice'];

    $sql="update tbldonation_item set Item_Name='{$iname}',CategoryID='{$icategory}',Price='{$iprice}',
    Date='{$idate}' where AID={$aid}";
    
    if(mysqli_query($con,$sql)){  
        save_log($_SESSION['username']."သည် item အား ပြင်ဆင်သွားသည်။ ");        
        echo 1;
    }else{
        echo 0;
    }
}

if($action == 'delete'){
    $aid = $_POST["aid"];
    $path = $_POST["path"];
    $sql = "delete from tbldonation_item where AID=$aid";     
    if(mysqli_query($con,$sql)){

        if(!empty($_POST['path'])){
            unlink(root.'lib/upload/item_images/'.$path);
        } 
        save_log($_SESSION['username']."သည် item အား ဖျက်သွားသည်။ ");
        echo 1;
    }
    else{
        echo 0;
    }      
}


if($action=='excel'){
    $search = $_POST['ser'];
    if($search == ''){         
        $sql="select i.*,c.Name from tbldonation_item i,tblcategory c 
        where i.CategoryID=c.AID order by AID desc";
    }else{ 
        $sql="select i.*,c.Name from tbldonation_item i,tblcategory c 
        where i.CategoryID=c.AID and (c.Name like '%$search%' or i.Item_Name like '%$search%') 
        order by AID desc";  
    }

    $result = mysqli_query($con,$sql);
    $out="";
    $fileName = "ItemReport_".date('d-m-Y').".xls";
    if(mysqli_num_rows($result) > 0)
    {
        $out .= '<head><meta charset="utf-8" /></head>
        <table >  
            <tr>
                <td colspan="5" align="center"><h3>Item Report</h3></td>
            </tr>
            <tr><td colspan="5"><td></tr>
            <tr>  
                <th style="border: 1px solid ;">No</th>  
                <th style="border: 1px solid ;">Item Name</th>  
                <th style="border: 1px solid ;">Category Name</th>
                <th style="border: 1px solid ;">Price</th>  
                <th style="border: 1px solid ;">Date</th> 
            </tr>';
        $no=0;
        while($row = mysqli_fetch_array($result))
        {
            $no = $no + 1;
            $out .= '
                <tr>  
                    <td style="border: 1px solid ;">'.$no.'</td>  
                    <td style="border: 1px solid ;">'.$row["Item_Name"].'</td>  
                    <td style="border: 1px solid ;">'.$row["Name"].'</td>  
                    <td style="border: 1px solid ;">'.number_format($row["Price"]).'</td>   
                    <td style="border: 1px solid ;">'.enDate($row["Date"]).'</td> 
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
                <td colspan="5" align="center"><h3>Item Report</h3></td>
            </tr>
            <tr><td colspan="5"><td></tr>
            <tr>  
                <th style="border: 1px solid ;">No</th>  
                <th style="border: 1px solid ;">Item Name</th>  
                <th style="border: 1px solid ;">Category Name</th>
                <th style="border: 1px solid ;">Price</th>  
                <th style="border: 1px solid ;">Date</th>
            </tr>
            <tr>
                <td style="border: 1px solid ;" colspan="5">No record found.</td>
            </tr>
            </table>';
            header('Content-Type: application/xls');
            header('Content-Disposition: attachment; filename='.$fileName);
            echo $out;
    }   
}

if($action == 'changephoto'){
    if($_FILES['ifile2']['name'] != ''){  
        $aid=$_POST['paid'];
        $path=$_POST['pimg'];

        $filename = $_FILES['ifile2']['name'];
        $extension = pathinfo($filename,PATHINFO_EXTENSION);
        $old_path = $_FILES['ifile2']['tmp_name'];
        $valid_extension = array("PNG","JPEG","JPG","png","jpg","jpeg");
    
        if(in_array($extension,$valid_extension)){  

            if(!empty($_POST['pimg'])){
                unlink(root.'lib/upload/item_images/'.$path);
            } 

            $new_filename = rand(1,100) ."_". $filename;
            $new_path = root."lib/upload/item_images/". $new_filename;
            if(move_uploaded_file($old_path,$new_path)){
                $sql = "update tbldonation_item set Img='{$new_filename}' where AID=$aid";
                
                if(mysqli_query($con,$sql)){
                    save_log($_SESSION['username']."သည် item ဓါတ်ပုံအား ပြင်ဆင်သွားသည်။ ");
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



?>
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
        $sql="select * from tblcategory  
        order by AID desc limit $offset,$limit_per_page";
    }else{ 
        $sql="select * from tblcategory where Name like '%$search%' 
        order by AID desc limit $offset,$limit_per_page";  
    }
    
    $result=mysqli_query($con,$sql) or die("SQL a Query");
    $out="";
    if(mysqli_num_rows($result) > 0){
        $out.='
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th  width="7%" class="text-center">No</th>
                    <th>Category Name</th>
                    <th width="10%" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
        ';
        $no=0;
        while($row = mysqli_fetch_array($result)){
            $no = $no + 1;
            $out.="<tr>
                <td class='text-center'>{$no}</td>
                <td>{$row["Name"]}</td>
                <td class='text-center'>
                    <div class='dropdown'>
                      <a class='btn btn-link font-30 p-0 line-height-1'
                            href='#' role='button' data-toggle='dropdown'>
                            <i class='fa fa-more-vert'>ooo</i>
                      </a>
                    <div class='dropdown-menu dropdown-menu-right dropdown-menu-icon-list'>  
                        <a href='#' id='btnedit' class='dropdown-item'
                            data-aid='{$row['AID']}'
                            data-catname='{$row['Name']}'><i
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
            $sql_total="select AID from tblcategory order by AID desc";
        }else{ 
            $sql_total="select AID from tblcategory where Name like '%$search%' order by AID desc";  
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
                    <th  width="7%" class="text-center">No</th>
                    <th width="10%">Category Name</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center" colspan="2">No record found.</td>
            </tr>
            </tbody>
        </table>';
    echo $out;
    }
  
}



if($action == 'save'){       
    $catname=$_POST['catname'];

    $sql="insert into tblcategory (Name) values ('{$catname}')";
    
    if(mysqli_query($con,$sql)){
        save_log($_SESSION['username']."သည် category အား အသစ်သွင်းသွားသည်။ ");
        echo 1;
    }else{
        echo 0;
    }

}


if($action == 'edit'){ 
    $aid=$_POST['eaid'];
    $catname=$_POST['ecatname'];

    $sql="update tblcategory set Name='{$catname}' where AID={$aid}";
    
    if(mysqli_query($con,$sql)){    
        save_log($_SESSION['username']."သည် category အား ပြင်ဆင်သွားသည်။ ");      
        echo 1;
    }else{
        echo 0;
    }
}

if($action == 'delete'){
    $aid = $_POST["aid"];
    $sql = "delete from tblcategory where AID=$aid";     
    if(mysqli_query($con,$sql)){
        save_log($_SESSION['username']."သည် category အား ဖျက်သွားသည်။ ");
        echo 1;
    }
    else{
        echo 0;
    }      
}


if($action=='excel'){
    $search = $_POST['ser'];
    if($search == ''){         
        $sql="select * from tblcategory order by AID desc";
    }else{ 
        $sql="select * from tblmain_donation where Name like '%$search%' order by AID desc";  
    }

    $result = mysqli_query($con,$sql);
    $out="";
    $fileName = "Category Report_".date('d-m-Y').".xls";
    if(mysqli_num_rows($result) > 0)
    {
        $out .= '<head><meta charset="utf-8" /></head>
        <table >  
            <tr>
                <td colspan="2" align="center"><h3>Category Report</h3></td>
            </tr>
            <tr><td colspan="2"><td></tr>
            <tr>  
                <th style="border: 1px solid ;">No</th>  
                <th style="border: 1px solid ;">Category Name</th> 
            </tr>';
        $no=0;
        while($row = mysqli_fetch_array($result))
        {
            $no = $no + 1;
            $out .= '
                <tr>  
                    <td style="border: 1px solid ;">'.$no.'</td>  
                    <td style="border: 1px solid ;">'.$row["Name"].'</td>   
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
                <td colspan="2" align="center"><h3>Category Report</h3></td>
            </tr>
            <tr><td colspan="2"><td></tr>
            <tr>  
                <th style="border: 1px solid ;">No</th>  
                <th style="border: 1px solid ;">Category Name</th>
            </tr>
            <tr>
                <td style="border: 1px solid ;" colspan="2">No record found.</td>
            </tr>
            </table>';
            header('Content-Type: application/xls');
            header('Content-Disposition: attachment; filename='.$fileName);
            echo $out;
    }   
}


?>
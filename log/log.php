<?php
include('../config.php');
include(root.'master/header.php');
?>

<div id="content-wrapper">
    <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
        <a href="<?php echo roothtml.'home/home.php' ?>">Home</a>
        </li>
        <li class="breadcrumb-item active">Log History</li>
    </ol>
            <!-- Page Content -->
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            <i class="fa fa-search"></i>
            Search Date
        </div>
        <div class="card-body">
        <div class="form-inline m-2">
                  <label for="">From : </label>
                  <input type="date" class="form-control" name="dtfrom" value="<?php echo date('Y-m-d') ?>" >
                  <label for=""> To : </label>
                  <input type="date" class="form-control" name="dtto" value="<?php echo date('Y-m-d') ?>" >
                  &nbsp; &nbsp;
                  <button class="btn btn-success" id="btndate">Search</button>
                 
                </div>

        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
        <i class="fa fa-table"></i>
        Log History

        <form method="POST" action="log_action.php" class="float-right">
            <input type="hidden" name="hid">
            <input type="hidden" name="ser"> 
            <input type="hidden" name="from">
            <input type="hidden" name="to">           
            <button name="action" value="excel" style="background: none;border: none;" class="text-white"><i
                    class="fa fa-file-excel-o"></i> Excel &nbsp;&nbsp;</button>
        </form>

        
        </div>
        
        <div class="card-body">
        <table width="100%">
                            <tr>
                                <td width="15%">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-6 col-form-label">Show</label>
                                        <div class="col-sm-6">
                                            <select id="entry" class="custom-select btn-sm">
                                                <option value="10" selected>10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                                <td width="50%" class="float-right">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Search</label>
                                        <div class="col-sm-9">
                                            <input type="search" class="form-control" id="searching"
                                                placeholder="Search ....">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>

                        <div class="table-wrap">
                            <div id="show_table" class="table-responsive">

                            </div>
                        </div>
        
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
    </div>
    <br><br><br>

<?php include(root.'master/footer.php'); ?>

<script>

$(document).ready(function() {

function load_pag(page) {
    var entryvalue = $("[name='hid'").val();
    var search = $("[name='ser'").val();
    var from = $("[name='from'").val();
    var to = $("[name='to'").val();
    $.ajax({
        type: "post",
        url: "<?php echo roothtml.'log/log_action.php' ?>",
        data: {
            action: 'show',
            page_no: page,
            entry: entryvalue,
            search: search,
            from:from,
            to:to
        },
        success: function(data) {
            $("#show_table").html(data);
        }
    });
}
load_pag();

$(document).on('click', '.page-link', function() {
    var pageid = $(this).data('page_number');
    load_pag(pageid);
});

$(document).on("change", "#entry", function() {
    var entryvalue = $(this).val();
    $("[name='hid'").val(entryvalue);
    load_pag();
});


$(document).on("keyup", "#searching", function() {
    var serdata = $(this).val();
    $("[name='ser'").val(serdata);
    load_pag();
});

$(document).on("click", "#btndate", function() {
    var from = $("[name='dtfrom'").val();
    var to = $("[name='dtto'").val();
    $("[name='from'").val(from);
    $("[name='to'").val(to);
    load_pag();
});


});
</script>
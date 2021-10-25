<?php
include('../config.php');
include(root.'master/header.php');
?>

<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html">Home</a>
            </li>
            <li class="breadcrumb-item active">ရွှေသာမဏေအလှူ</li>
        </ol>

        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                <i class="fa fa-chart-area"></i>
                အလှူပစ္စည်းများ
                <div class="form-group row float-right">
                    <label for="inputEmail3" class="col-sm-4 col-form-label text-right">Search</label>
                    <div class="col-sm-8">
                        <input type="search" class="form-control" id="searching" placeholder="Searching . . . . . ">
                    </div>
                </div>
            </div>
            <input type="hidden" name="ser">
            <div class="card-body">
                <div id="show_item">

                </div>
            </div>
            <div class="card-footer small text-muted">Updated today at <?php echo date('h:i:s A') ?></div>
        </div>

        <?php 
            $keycheck=(isset($_SESSION['edititem_key'])?$_SESSION['edititem_key']:''); 
            if($keycheck=='') {
                unset($_SESSION["edititem_cusname"]) ;
                unset($_SESSION["edititem_phno"]) ;
                unset( $_SESSION["edititem_address"]) ;
                unset($_SESSION["edititem_no"]) ;
                unset( $_SESSION["edititem_dt"]) ;
                unset( $_SESSION["edititem_rmk"]);
                unset( $_SESSION["edititem_vno"]);
            } 
        ?>

        <!-- Area Chart Example-->
        <div class="card mb-3">
            <div class="card-header bg-info text-white">
                <i class="fa fa-chart-area"></i>
                ရွေးချယ်ထားသောပစ္စည်းများ
            </div>
            <div class="card-body">
                <div id="show_session">

                </div>
            </div>
            <div class="card-footer small text-muted">Updated today at <?php echo date('h:i:s A') ?></div>
        </div>

    </div>
    <br><br><br><br><br>
</div>


<div class="modal fade" id="editqtymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-edit"></i>
                    Edit Choose Items
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="eaid">
                <div class="form-group">
                    <label for="">Item Name</label>
                    <input type="text" class="form-control" name="eitemname" readonly>
                </div>
                <div class="form-group">
                    <label for="">Item Price</label>
                    <input type="text" class="form-control" name="eprice" readonly>
                </div>
                <div class="form-group">
                    <label for="">Qty</label>
                    <input type="number" class="form-control" name="eqty">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" id="btneditqtysave" class="btn btn-primary"><i
                        class="fa fa-edit"></i>&nbsp;Edit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="savemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-edit"></i>
                    Save Items
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="frmsave">
                
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-edit"></i>
                    Edit Items
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="frmedit">
                
            </form>
        </div>
    </div>
</div>

<?php include(root.'master/footer.php'); ?>

<script>
$(document).ready(function() {

    function load_pag(page) {
        var search = $("[name='ser'").val();
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'gold/gold_donation_action.php' ?>",
            data: {
                action: 'show',
                page_no: page,
                search: search
            },
            success: function(data) {
                $("#show_item").html(data);
            }
        });
    }
    load_pag();

    $(document).on('click', '.page-link', function() {
        var pageid = $(this).data('page_number');
        load_pag(pageid);
    });

    $(document).on("keyup", "#searching", function() {
        var serdata = $(this).val();
        $("[name='ser'").val(serdata);
        load_pag();
    });

    function load_itemsession() {
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'gold/gold_donation_action.php' ?>",
            data: {
                action: 'showsession'
            },
            success: function(data) {
                $("#show_session").html(data);
            }
        });
    }
    load_itemsession();

    $(document).on('click', '#addcart', function() {
        var aid = $(this).data("aid");
        var itemname = $(this).data("itemname");
        var price = $(this).data("price");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'gold/gold_donation_action.php' ?>",
            data: {
                action: 'addcart',
                aid: aid,
                itemname: itemname,
                price: price
            },
            success: function(data) {
                load_itemsession();
            }
        });
    });

    $(document).on("click", "#removecart", function(e) {
        e.preventDefault();
        var aid = $(this).data("aid");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'gold/gold_donation_action.php' ?>",
            data: {
                action: 'remove_item',
                aid: aid
            },
            success: function(data) {
                load_itemsession();
            }
        });
    });

    $(document).on("click", "#btndeletesession", function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'gold/gold_donation_action.php' ?>",
            data: {
                action: 'delete_session'
            },
            success: function(data) {
                load_itemsession();
            }
        });
    });


    $(document).on("click", "#btnqtyinc", function() {
        var aid = $(this).data("aid");
        var itemname = $(this).data("itemname");
        var price = $(this).data("price");
        var qty = $(this).data("qty");
        $("[name='eaid'").val(aid);
        $("[name='eitemname'").val(itemname);
        $("[name='eprice'").val(price);
        $("[name='eqty'").val(qty);

        $("#editqtymodal").modal("show");
    });

    $(document).on("click", "#btneditqtysave", function() {
        var aid = $("[name='eaid'").val();
        var qty = $("[name='eqty'").val();
        $("#editqtymodal").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'gold/gold_donation_action.php' ?>",
            data: {
                action: 'editqty',
                aid: aid,
                qty: qty
            },
            success: function(data) {
                load_itemsession();
            }
        });
    });

    $(document).on("click", "#btnsaveprepare", function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'gold/gold_donation_action.php' ?>",
            data: {
                action: 'save_prepare'
            },
            success: function(data) {
                $("#frmsave").html(data);
                $("#savemodal").modal("show");
            }
        });
    });


    $(document).on("click", "#btnfinishsave", function(e) {
        e.preventDefault();
        var cusname = $("[name='cusname'").val();
        var cusno = $("[name='cusno'").val();
        var cusphno = $("[name='cusphno'").val();
        var cusaddress = $("[name='cusaddress'").val();
        if (cusname == '' || cusno == '' || cusphno == '' || cusaddress == '') {
            swal("Information", "Please fill all data.", "info");
            return false;
        }
        $("#savemodal").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'gold/gold_donation_action.php' ?>",
            data: $("#frmsave").serialize() + "&action=finishsave",
            success: function(data) {
               
                if(data == 1){
                    swal("Success","Save items is successful.","success");
                    $("#frmsave")[0].reset();
                    load_itemsession();
                }else{
                    swal("Fail","Save items is fail.","error");
                }
            }
        });
    });

    $(document).on("click", "#btneditprepare", function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'gold/gold_donation_action.php' ?>",
            data: {
                action: 'edit_prepare'
            },
            success: function(data) {
                $("#frmedit").html(data);
                $("#editmodal").modal("show");
            }
        });
    });

    $(document).on("click", "#btnfinishedit", function(e) {
        e.preventDefault();
        var cusname = $("[name='ecusname'").val();
        var cusno = $("[name='ecusno'").val();
        var cusphno = $("[name='ecusphno'").val();
        var cusaddress = $("[name='ecusaddress'").val();
        if (cusname == '' || cusno == '' || cusphno == '' || cusaddress == '') {
            swal("Information", "Please fill all data.", "info");
            return false;
        }
        $("#editmodal").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'gold/gold_donation_action.php' ?>",
            data: $("#frmedit").serialize() + "&action=finishedit",
            success: function(data) {
                if(data == 1){
                    swal("Success","Save items is successful.","success");
                    location.href = "<?php echo roothtml.'gold/gold_alldonation.php' ?>";
                }else{
                    swal("Fail","Save items is fail.","error");
                }
            }
        });
    });


});
</script>
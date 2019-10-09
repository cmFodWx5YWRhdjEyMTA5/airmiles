<?php
include 'header.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

        <section class="content-header">
            <div style="display: inline-block; width: 100%; vertical-align: top;">
                <div class="pull-left">
                    <h1>Profile Location</h1>
                </div>
                <!-- <div  class="pull-right" style="padding-top: 30px; ">
                    <button class="btn ink-reaction btn-floating-action btn-info" onclick="window.location.href='export_csv.php'">Export</button>
                </div> -->
            </div>
            <ol class="breadcrumb">
                <li><a><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Profile Location</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="box">
                <div class="box-header col-md-12">
                    <div class="text-left col-md-6"><h1 class="box-title">Profile Location</h1></div>
                </div>
                <div class="box-body">
                    <div class="box-body">
                        <div class="row">
                                <div class="col-md-9"></div>
                                                                <div class="col-md-3">
                                  <button type="button" class="add_client btn bg-olive btn-flat margin btn-new">
                                                <i class="fa fa-plus"></i> &nbsp;Add Profile Location
                                            </button></div>
                                </div>
                        <div class="col-md-12" id="referrals_list">
                          <div class="table-responsive">
                            <table id="clients_list_table" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Name Arabic</th>
                                    
                                    <th>Action</th>
                                </tr>
                                </thead>
                            </table>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

</div>
<?php
include 'footer.php';
?>
<div class="modal fade" id="AddclientModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" >Add  profile Location</h4>
            </div>
            <form class="form form-validate" id="add_client_form" role="form"  action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                         <div class="form-group">
                              <label>Profile Location Name</label>
                              <input type="text" class="form-control" name="name" id="name" required="required">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                         <div class="form-group">
                              <label>Profile Location Name Arabic</label>
                              <input type="text" class="form-control" name="namearabic" id="namearabic" required="required">
                            </div>
                        </div>
                       <!--<div class="col-sm-6 col-md-6">
                         <div class="form-group">
                              <label>Active</label>
                              <select name="isactive" class="form-control" id="isactive">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                              </select>
                            </div>
                        </div>-->
                       
                   </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input type="reset" class="btn btn-default" style="display: none;">
                    <button type="submit" class="btn btn-primary" name="">Add</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div class="modal fade" id="deletereferralsModal" tabindex="-1" role="dialog" aria-labelledby="deleteSallerModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="deletereferralsModalLabel">Delete Location</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this record?</p>
                <input type="hidden" id="deleteid" name="deleteid">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" id="confirmDeletereferralsBtn" class="btn btn-danger">Delete</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="EditreferralsModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Profile Location</h4>
            </div>
            <form class="form form-validate" id="edit_referrals_form" role="form"  action="" method="post" enctype="multipart/form-data">
                <input type="hidden" id="user_id" name="user_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                         <div class="form-group">
                              <label>Profile Location Name</label>
                              <input type="text" class="form-control" name="name" id="name" >
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                         <div class="form-group">
                              <label>Profile Location Name Arabic</label>
                              <input type="text" class="form-control" name="namearabic" id="namearabic" >
                            </div>
                        </div>
                       <!--<div class="col-sm-6 col-md-6">
                         <div class="form-group">
                              <label>Active</label>
                              <select name="isactive" class="form-control" id="isactive">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                              </select>
                            </div>
                        </div>-->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input type="reset" class="btn btn-default" style="display: none;">
                    <button type="submit" class="btn btn-primary" name="">Update</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="dist/js/profilelocationscript.js"></script>

<script src="../js/ckeditor/ckeditor.js"></script>

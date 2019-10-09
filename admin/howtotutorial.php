<?php
include 'header.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

       <section class="content-header">
            <div style="display: inline-block; width: 100%; vertical-align: top;">
                <div class="pull-left">
                    <h1>How to Tutorial</h1>
                </div>
            </div>
            <ol class="breadcrumb">
                <li><a><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">How to Tutorial</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="box">
                <div class="box-header col-md-12">
                    <div class="text-left col-md-6"><h1 class="box-title">How to Tutorial</h1></div>
                </div>
                <div class="box-body">
                    <div class="box-body">
                        <div class="row">
                                <div class="col-md-9"></div>
                                                                <div class="col-md-3">
                                  <button type="button" class="add_client btn bg-olive btn-flat margin btn-new">
                                                <i class="fa fa-plus"></i> &nbsp;Add Tutorial
                                            </button></div>
                                </div>
                        <div class="col-md-12" id="referrals_list">
                          <div class="table-responsive">
                            <table id="clients_list_table" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Icon</th>
                                    <th>Title</th>
                                    <th>Title Arabic</th>
                                    <th>Image</th>
                                                                        <th>Language</th>

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
                <h4 class="modal-title" >Add Tutorial</h4>
            </div>
            <form class="form form-validate" id="add_client_form" role="form"  action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row flexw">
                        <div class="col-sm-6 col-md-6">
                         <div class="form-group">
                              <label>Upload Icon Image: <small>250 width x 250 Height</small></label>
                              <input type="file" class="form-control" name="logoimage" id="logoimage" required="required">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                         <div class="form-group">
                              <label>Title</label>
                              <input type="text" class="form-control" id="title" name="title" required="required">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                         <div class="form-group">
                              <label>Title Arabic</label>
                             <input type="text" class="form-control" id="titlearabic" name="titlearabic" required="required">
                            </div>
                        </div>
                      
                        <div class="col-sm-6 col-md-6">
                         <div class="form-group">
                              <label>Upload Image: <small>400 width x 200 Height</small></label>
                              <input type="file" class="form-control" name="image" id="image" required="required">
                            </div>
                        </div>
                        
                        
                               <div class="col-sm-6 col-md-6">
                         <div class="form-group">
                              <label>Language</label>
                            <select name="language" class="form-control" id="language" required>
                                <option value="english">English</option>
                                <option value="arabic">Arabic</option>
                              </select>
                            </div>
                        </div>
                      
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
                <h4 class="modal-title" id="deletereferralsModalLabel">Delete Tutorial</h4>
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
                <h4 class="modal-title">Edit Tutorial</h4>
            </div>
            <form class="form form-validate" id="edit_referrals_form" role="form"  action="" method="post" enctype="multipart/form-data">
                <input type="hidden" id="user_id" name="user_id">
                <div class="modal-body">
                    <div class="row flexw">
                        <div class="col-sm-6 col-md-6">
                         <div class="form-group">
                              <label>Upload Icon Image: <small>250 width x 250 Height</small></label>
                              <div class="file-wp">
                              <img src="" id="logoimageuploaded" name="logoimageuploaded" width="100px" />
                              <input type="hidden" name="imgsrc" id="imgsrc">
                              <input type="file" name="logoimage" id="logoimage">
                              </div>
                            </div>
                        </div>
                         <div class="col-sm-6 col-md-6">
                         <div class="form-group">
                              <label>Title</label>
                              <input type="text" class="form-control" id="title" name="title">
                            </div>
                        </div>
                         <div class="col-sm-6 col-md-6">
                         <div class="form-group">
                              <label>Title Arabic</label>
                              <input type="text" class="form-control" id="titlearabic" name="titlearabic">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                              <label>Upload Image: <small>400 width x 200 Height</small></label>
                              <div class="file-wp">
                              <img src="" id="imageuploaded" name="imageuploaded" width="100px" />
                              <input type="hidden" name="imgsrc1" id="imgsrc1">
                              <input type="file" name="image" id="image">
                              </div>
                            </div>
                          </div>
                          
                                 <div class="col-sm-6 col-md-6">
                         <div class="form-group">
                              <label>Language</label>
                            <select name="language" class="form-control" id="language" required>
                                <option value="english">English</option>
                                <option value="arabic">Arabic</option>
                              </select>
                            </div>
                        </div>
                        
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

<script src="dist/js/howtotutorialscript.js"></script>

<script src="../js/ckeditor/ckeditor.js"></script>
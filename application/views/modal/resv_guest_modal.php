

<div id="modalDivResvGuest" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">Add New Guest</h4>  
            </div>
            <div class="modal-body">           
                <div class="row">


                
                    <div class="col-sm-12">                   
                    <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-sm-12">
                            <label for="exampleInputEmail1">Guest Name</label>
                            <input class="form-control"  id="modal_guest_name" placeholder="Guest Name">
                            <small id="error_txtHotel" class="form-text text-muted"></small>
                        </div>

                        <div class="col-sm-12">
                            <label for="exampleInputEmail1">Email</label>
                            <input class="form-control"  id="modal_guest_email" placeholder="Guest Email">
                            <small id="error_txtHotel" class="form-text text-muted"></small>
                        </div>

                        <div class="col-sm-12">
                            <label for="exampleInputEmail1">Mobile No</label>
                            <input class="form-control"  id="modal_guest_mobile_no" placeholder="Mobile No">
                            <small id="error_txtHotel" class="form-text text-muted"></small>
                        </div>

                        <div class="col-sm-12">
                            <label for="exampleInputEmail1">Address</label>
                            <textarea class="form-control" id="modal_guest_address" placeholder="Guest Address"></textarea>
                        </div>

                        <div class="col-sm-12">
                            <label for="exampleInputEmail1">Country</label>
                            <select class="form-control" id="modal_guest_country"></select>
                        </div>

                        <div class="col-sm-12">
                            <label for="exampleInputEmail1">Identity</label>
                            <input  class="form-control" id="modal_guest_identity_info" placeholder="Identity">
                            <small id="error_txtHotel" class="form-text text-muted"></small>
                        </div>

                        <div class="col-sm-12">
                            <label for="exampleInputEmail1">Doc. No</label>
                            <input type="file" class="form-control" id="modal_guest_doc_info" placeholder="Identity">
                            <small id="error_txtHotel" class="form-text text-muted"></small>
                        </div>
                        <div class="col-sm-12">
                            <label for="exampleInputEmail1">Room Type</label>
                            <select class="form-control" id="modal_guest_room_type">                          
                                <?php foreach($rt as $r): ?>
                                    <option value="<?php echo $r["id"] ?>"><?php echo $r["type_name"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-12 rr" style="text-align:center;">
                            <button onclick="saveModalNewGuestInfo('btnModalSaveNewGuestInfo')" id="btnModalSaveNewGuestInfo" class="btn btn-info">
                                 <span class="fa fa-plus-circle"></span> Submit 
                            </button>
                        </div>

                    </div>
                </div>   
            </div>


                </div>
            </div>            
        </div>
    </div>
</div>
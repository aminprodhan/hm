
<?php foreach($list as $l): ?>


<div class="panel panel-default">
    <div class="panel-heading" style="background:white;">
        <h4 class="page-title mn"><u>Update Guest Information</u></h4>
    </div>
    <div class="panel-body">
        <div class="col-sm-12">
          
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Guest Name</th>
                        <th>Email</th>
                        <th>Mobile No</th>
                        <th>Address</th>
                        <th>Country</th>
                        <th>Indentity</th>
                        <th>Doc.</th>
                    </tr>
                    <tr>
                        <td colspan="7" style="text-align:right;">
                            <button id="btnModalAddGuest" onclick="guestModalPreview(this)" class="btn btn-info">
                                 <span class="fa fa-plus-circle"></span> Add
                            </button>
                        </td>
                        
                    </tr>
                </thead>
                <tbody id="guest_list">
                   <?php foreach($guest_list as $gl): ?>
                        <tr class='tr-<?php echo $gl["id"] ?>'>
                            <td>
                                <input class="form-control" value="<?php echo $gl["name"] ?>" id="guest_name" placeholder="Guest Name">                    
                            </td>
                            <td>
                                <input class="form-control" value="<?php echo $gl["email"] ?>" id="guest_email" placeholder="Email">
                            </td>
                            <td>
                                <input class="form-control" value="<?php echo $gl["mobile_no"] ?>" id="guest_mobile_no" placeholder="Guest Mobile">

                            </td>
                            <td>
                                <textarea class="form-control" id="guest_address" placeholder="Guest Address">
                                    <?php echo $gl["address"] ?>
                                </textarea>
                            </td>
                            <td>
                                <select class="form-control" id="guest_country"></select>
                            </td>
                            <td>
                                <input class="form-control" value="<?php echo $gl["indentity"] ?>" id="guest_identity_info" placeholder="Guest Mobile">

                            </td>
                            <td>
                                <input type="file" class="form-control" id="guest_doc_info" placeholder="doc. file">

                            </td>
                            <td>
                                <input data-target='<?php echo $gl["id"] ?>' class='chq_list' type="checkbox" />
                            </td>
                           
                        </tr>
                   <?php endforeach; ?>
                   <tr>
                        <td colspan="7" style="text-align:right;">
                            <button id="btnRemoveGuestInfo" onclick="removeGuestInfo('btnRemoveGuestInfo')" 
                                class="btn btn-danger">
                                 <span class="fa fa-minus-circle"></span> Remove
                            </button>
                        </td>
                        
                    </tr>
                </tbody>
            </table>

            <?php $this->load->view("modal/resv_guest_modal") ?>

           <!-- -->


        </div>
    </div>
</div>

<?php endforeach; ?>

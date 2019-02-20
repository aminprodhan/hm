<?php 
            $bname="";$bacc_no="";$branch="";$chq_number="";$chq_date="";
            
        ?>
    
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Bank Information</legend>
        <div class="row">
            <label style="width:13%" class="col-sm-2">Bank Name</label>
            <div style="width:20%" class="col-sm-2">
                <input value="<?php echo $bname; ?>" id="check_in_resv_bank_name" class="form-control" />
            </div>
            <label style="width:13%" class="col-sm-2">Account No</label>
            <div style="width:20%" class="col-sm-2">
                <input value="<?php echo $bacc_no; ?>"  id="check_in_resv_bank_acc_no" class="form-control" />
            </div>
            <label style="width:13%" class="col-sm-2">Branch Name</label>
            <div style="width:20%" class="col-sm-2">
                <input value="<?php echo $branch; ?>"  id="check_in_resv_bank_branch_name" class="form-control" />
            </div>
        </div>

            <div class="row rr">
            <label style="width:13%" class="col-sm-2">Cheque Number</label>
            <div style="width:20%" class="col-sm-2">
                <input value="<?php echo $chq_number; ?>"  id="check_in_resv_bank_chq_number" class="form-control" />
            </div>
            <label style="width:13%" class="col-sm-2">Cheque Date</label>
            <div style="width:20%" class="col-sm-2">
                <input value="<?php echo $chq_date; ?>"  id="check_in_resv_bank_chq_date" class="form-control tcal" />
            </div>
        </div>

    </fieldset>
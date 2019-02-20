    
    
     <?php 
            $bname=0;$bacc_no=0;$branch=0;$chq_number="";$chq_date="";
            foreach($payment_info as $p){

                $bname=$p["bank_name"];
                $bacc_no=$p["account_number"];
                $branch=$p["branch_name"];
                $chq_number=$p["chq_number"];
                $chq_date=$p["chq_date"];
            } 
        ?>
    
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Bank Information</legend>
        <div class="row">
            <label style="width:13%" class="col-sm-2">Bank Name</label>
            <div style="width:20%" class="col-sm-2">
                <input value="<?php echo $bname; ?>" id="resv_bank_name" class="form-control" />
            </div>
            <label style="width:13%" class="col-sm-2">Account No</label>
            <div style="width:20%" class="col-sm-2">
                <input value="<?php echo $bacc_no; ?>"  id="resv_bank_acc_no" class="form-control" />
            </div>
            <label style="width:13%" class="col-sm-2">Branch Name</label>
            <div style="width:20%" class="col-sm-2">
                <input value="<?php echo $branch; ?>"  id="resv_bank_branch_name" class="form-control" />
            </div>
        </div>

            <div class="row rr">
            <label style="width:13%" class="col-sm-2">Cheque Number</label>
            <div style="width:20%" class="col-sm-2">
                <input value="<?php echo $chq_number; ?>"  id="resv_bank_chq_number" class="form-control" />
            </div>
            <label style="width:13%" class="col-sm-2">Cheque Date</label>
            <div style="width:20%" class="col-sm-2">
                <input value="<?php echo $chq_date; ?>"  id="resv_bank_chq_date" class="form-control tcal" />
            </div>
        </div>

    </fieldset>
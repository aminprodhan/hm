<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="page-title mn"><u>Payment Update</u></h4>
    </div>

        <?php 
            $amt=0;$tax=0;$pay_mode_id=0;$date="";$remarks="";
            foreach($pay_invoice as $p){
                $amt=$p["amount"];
                $tax=$p["tax"];
                $pay_mode_id=$p["pay_mode"];
                $date=$p["date"];
                $remarks=$p["remarks"];
            } 
        ?>

    <div class="panel-body">
        <div class="col-sm-12">
            <?php     
                $pay_mode=$this->room_model->getRoomTypeList("type_list","type_id",21,"type_name","asc");
            ?>
            <label style="width:10%" class="col-sm-2">Payment Mode</label>
            <div style="width:20%" class="col-sm-2">
                <select id="pay_mode" class="form-control">  
                    <option value="0">All</option>            
                    <?php foreach($pay_mode as $rt): ?>
                        <option <?php if($pay_mode_id == $rt["id"]): ?>selected<?php endif; ?> value="<?php echo $rt["id"] ?>">
                            <?php echo $rt["type_name"] ?>
                        </option>
                    <?php endforeach; ?>                
                </select>
            </div>
            <label style="width:10%" class="col-sm-2">Date</label>
            <div style="width:20%" class="col-sm-2">
                <input value="<?php echo $date; ?>" id="pay_date" class="form-control tcal" />
            </div>

     
        </div>
        <div id="collpseBankInfo" class="col-sm-12 rr collapse in">

            <?php $this->load->view("library/bank_info"); ?>

        </div>
       

        <div class="col-sm-12 rr">
                <label style="width:10%" class="col-sm-2">Amount</label>
                <div style="width:20%" class="col-sm-2">
                    <input value="<?php echo $amt; ?>"  id="pay_amount" class="form-control" />
                </div>
                <label style="width:10%" class="col-sm-2">Tax</label>
                <div style="width:20%" class="col-sm-2">
                    <input value="<?php echo $tax; ?>"  id="pay_tax" class="form-control" />
                </div>
                <label style="width:10%" class="col-sm-2">Remarks</label>
                <div style="width:20%" class="col-sm-2">
                    <textarea id="pay_remarks" rows="4"><?php echo $remarks; ?></textarea>
                </div>
        </div>
        <div class="col-sm-12" style="text-align:center;">
            <button onclick="saveAllotmentPayInfo(this)" class="btn btn-success">Submit</button>
        </div>
            

        </div>
    </div>


</div>
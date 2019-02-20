<div class="page-wrapper">
    <div class="content container-fluid">
        <style>
            .mn{margin:0;padding:0;}
            .rr
             {
                margin-top:10px;
            }
        </style>

        <?php
            $code="0";$allot_id="";
            $agent_id="";$remarks="";
            foreach($info as $i){
                $code=$i["allot_code"];
                $allot_id=$i["allot_id"];
                $agent_id=$i["agent_id"];
                $remarks=$i["remarks"];
            }
         ?>

        <div class="alert alert-info" id="div_alert">
            <strong>New Allotment</strong>
        </div>
        <div class="col-sm-12 mn">
            <label class="col-sm-2" style="text-align:right;">
                Allotment Code
            </label>
            <div class="col-sm-3">
                <input value="<?php echo $allot_id; ?>" id="allotment_code" type="hidden" disabled="true" class="form-control"   />
                <input value="<?php echo $code; ?>" id="allot_code" disabled="true" class="form-control"  />
            </div>
        </div>

        <div class="col-sm-12 mn rr" >
            <?php $this->load->view("bed_reservation/allotment_basic_info"); ?>
        </div>

         <div class="col-sm-12 mn rr" >
            <?php $this->load->view("allotment/allotment_room"); ?>
        </div>

         <div class="col-sm-12 mn rr" >
            <?php $this->load->view("allotment/allotment_payment"); ?>
        </div>

        <script src="<?php echo base_url(); ?>js/custom/search_available_room_allotment.js"></script>

    </div>
</div>
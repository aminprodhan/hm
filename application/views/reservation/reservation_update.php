<div class="page-wrapper">
    <div class="content container-fluid">
        <?php foreach($list as $l): ?>

        <style>
            .mn{margin:0;padding:0;}
            .rr{
                margin-top:10px;
            }
        </style>

        <div class="alert alert-info" id="div_alert">
            <strong>
               
                <?php if(empty($status) || $status < 0): ?>
                        Reservation Update
                <?php endif; ?>
                <?php if(!empty($status) || $status > 0): ?>
                   Check In
                <?php endif; ?>
            </strong>
        </div>
        <div class="col-sm-12 mn" >
            <label class="col-sm-2" style="text-align:right;">
                Reservation Code
            </label>
            <div class="col-sm-3">
                <input style="background:white;" disabled="true" class="form-control"  value="<?php echo $l["resv_code"] ?>" />
                <input type="hidden" id="resv_code" disabled="true" class="form-control"  value="<?php echo $l["resv_id"] ?>" />
            </div>
        </div>
        <div class="col-sm-12 mn rr" >
                <?php $this->load->view("reservation/resv_basic_info_update"); ?>
          
        </div>
        <div class="col-sm-12 mn">
                <?php $this->load->view("reservation/resv_guest_info_update"); ?>
        </div>

        <div class="col-sm-12 mn">
                <?php $this->load->view("reservation/resv_room_info_update"); ?>
        </div>
        <div class="col-sm-12 mn">
                <?php $this->load->view("reservation/payment_info_update"); ?>
        </div>
        <?php if(!empty($status)): ?>
            <div class="col-sm-12 mn">
                    <?php $this->load->view("reservation/payment_info_check_in"); ?>
            </div>
        <?php endif; ?>

        <?php endforeach; ?>

        <script src="<?php echo base_url(); ?>js/custom/search_available_room.js"></script>
        <script src="<?php echo base_url(); ?>js/custom/resv_payment.js"></script>

    </div>
</div>
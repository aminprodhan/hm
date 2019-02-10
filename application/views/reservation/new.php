<div class="page-wrapper">
    <div class="content container-fluid">
        <style>
            .mn{margin:0;padding:0;}
            .rr{
                margin-top:10px;
            }
        </style>

        <div class="alert alert-warning" id="div_alert">
            <strong></strong>
        </div>
        <div class="col-sm-12 mn" >
            <label class="col-sm-2" style="text-align:right;">
                Reservation Code
            </label>
            <?php 
                $code=$this->common->getReservationCode();
            ?>
            <div class="col-sm-3">
                <input id="resv_code" disabled="true" class="form-control"  value="0" />
            </div>
        </div>
        <div class="col-sm-12 mn rr" >
            <div class="col-sm-6 mn">
                <?php $this->load->view("reservation/resv_basic_info"); ?>
            </div>
            <div class="col-sm-6 mn">
                <?php $this->load->view("reservation/resv_guest_info"); ?>
            </div>
        </div>


        <div class="col-sm-12 mn">
                <?php $this->load->view("reservation/resv_room_info"); ?>
        </div>
        <script src="<?php echo base_url(); ?>js/custom/search_available_room.js"></script>
    </div>
</div>
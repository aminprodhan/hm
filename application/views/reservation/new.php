<div class="page-wrapper">
    <div class="content container-fluid">
        <style>
            .mn{margin:0;padding:0;}
            .rr{
                margin-top:10px;
            }
        </style>

        <div class="alert alert-info" id="div_alert">
            <strong>
                New Reservation
            </strong>
        </div>
        <div class="col-sm-12 mn" >

            <div class="panel panel-default">
                <div class="panel-body">
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
            </div>
        </div>


        <div class="col-sm-12 mn" >
            <div class="panel panel-default">
                <div class="panel-body">
                    <label class="col-sm-2" style="text-align:right;">
                        Allotment Id
                    </label>
                    <div class="col-sm-3 auto_com">
                        <input id="search_allot_id"  onkeyup="getAllotmentCodeList('search_allot_id')" class="form-control"  />
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-info"><span class="fa fa-search"></span>Search</button>
                    </div>
                </div>
            </div>
        </div>

         <div class="col-sm-12 mn rr" style="text-align:right;" >
            <a href="<?php echo base_url(); ?>reservation_controller/reservationList" class="btn btn-primary">
                <span class="fa fa-search"></span> Reservation List
            </a>
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

        <div class="col-sm-12 mn">
                <?php $this->load->view("reservation/resv_payment"); ?>
        </div>
       


        <script src="<?php echo base_url(); ?>js/custom/search_available_room.js"></script>
        <script src="<?php echo base_url(); ?>js/custom/resv_payment.js"></script>

    </div>
</div>
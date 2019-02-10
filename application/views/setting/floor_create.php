<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row">
            <div class="col-sm-12" id="menuBar">

                <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
                    <button onclick="createNewFloor()" type="button" class="btn btn-default navbar-btn">
                        <i class="fa fa-plus-circle"></i>
                            Floor Create
                    </button>
                    <button onclick="createNewRoom()" type="button" class="btn btn-default navbar-btn">
                        <i class="fa fa-plus-circle"></i>
                            Room Create
                        
                    </button>

                </nav>

            </div>
        </div>
    </div>
</div>
<?php $this->load->view("library/floor_modal"); ?>
<script src="<?php echo base_url(); ?>js/custom/floorSetting.js"></script>
<script src="<?php echo base_url(); ?>js/custom/roomSetting.js"></script>

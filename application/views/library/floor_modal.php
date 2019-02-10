

<div id="modalCreateNewFloor" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">Settings</h4>  
            </div>
            <div class="modal-body">           
                <div class="row">
                    <div class="col-sm-12" style="text-align:right;">                   
                          <div class="input-group mt" style="width:100%;">
                                <button data-toggle="collapse" data-target="#collapseFloorCreate" type="button" class="btn btn-primary">
                                    <i class="fa fa-plus-circle"></i>
                                    New Floor Create
                                </button>
                                &nbsp
                                 <button data-toggle="collapse" data-target="#collapseFloorList" 
                                       type="button" class="btn btn-primary">
                                       <i class="fa fa-search"></i>
                                    Floor List
                                </button>
                            </div>                   
                    </div>
                    <?php $this->load->view("library/collapseFCreate"); ?>
                    <?php $this->load->view("library/collapseFList"); ?>
                </div>
            </div>            
        </div>
    </div>
</div>


<div id="modalCreateNewRoom" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">Settings</h4>  
            </div>
            <div class="modal-body">           
                <div class="row">
                    <div class="col-sm-12" style="text-align:right;">                   
                          <div class="input-group mt" style="width:100%;">
                                <button data-toggle="collapse" data-target="#collapseRoomCreate" 
                                   type="button" class="btn btn-primary">
                                    <i class="fa fa-plus-circle"></i>
                                    New Room Create
                                </button>
                                 &nbsp
                                 <button data-toggle="collapse" data-target="#collapseRoomList" 
                                       type="button" class="btn btn-primary">
                                       <i class="fa fa-search"></i>
                                    Room List
                                </button>
                            </div>                   
                    </div>
                    <?php $this->load->view("library/collapseRCreate"); ?>
                    <?php $this->load->view("library/collapseRList"); ?>
                </div>
            </div>            
        </div>
    </div>
</div>


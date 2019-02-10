<div id="collapseRoomCreate" class="col-sm-12 collapse in">
<fieldset class="scheduler-border">
    <legend class="scheduler-border">Create New Room</legend>
    <div class="alert alert-warning" id="div_room_alert">
        <strong></strong>
    </div>

<form>

    <div class="input-group mt">
        <span class="input-group-addon">
           Room No <i class="fa fa-edit"></i>&nbsp;&nbsp;
        </span>
        <input id="txtRoomNo" type="text" class="form-control" name="Room" placeholder="Room No">
    </div>

    <div class="input-group mt">
         <span class="input-group-addon">Hotel List <i class="fa fa-edit"></i>&nbsp;&nbsp;</span>
        <select onchange="getFloorList(this)"  id="comboRoomHotelList" class="form-control">   
            <option value="0"></option>
            <?php foreach($getHotelList as $h): ?>
                <option class="selected_id-<?php echo $h["id"]; ?>" value="<?php echo $h["id"] ?>">
                    <?php echo $h["hotel_name"]; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="input-group mt">
        <span class="input-group-addon">Floor List <i class="fa fa-edit">&nbsp;&nbsp;&nbsp;</i></span>
        <select id="comboRoomFloorList" class="form-control"></select>
    </div>

    <div class="input-group mt radio_room_group">
        <input value="1" type="radio" name="active_status"  checked /> Active
        <input value="0" type="radio" name="active_status" /> InActive
    </div>

    <?php 
    
        $roomTypeList=$this->room_model->getRoomTypeList("type_list","type_id",20,"type_name","asc");
    
    ?>

    <div class="input-group mt">
        <span class="input-group-addon">Room Type <i class="fa fa-edit"></i></span>
        <select id="comboRoomTypeList" class="form-control">
        
            <?php foreach($roomTypeList as $rt): ?>
                <option value="<?php echo $rt["id"] ?>">
                    <?php echo $rt["type_name"] ?>
                </option>
            <?php endforeach; ?>

        </select>
    </div>


    <div class="input-group mt">
        <span class="input-group-addon">
           Total Bed <i class="fa fa-edit"></i>&nbsp;&nbsp;&nbsp;
        </span>
        <input id="txtRoomNumberOfBed" type="text" class="form-control" name="Bed" placeholder="Number Of Bed">
    </div>


    <div class="input-group mt">

        <button id="btnSaveRoomInfo" onclick="saveRoomInfo('btnSaveRoomInfo')"
             type="button" class="btn btn-primary btnSaveDisplay">
            <i class="fa fa-plus-circle"></i>
             <span class="txtSaveRoomLoading">Save&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>       
        </button>

        <button id="btnUpdateRoomInfo" onclick="updateFloorInfo('btnUpdateRoomInfo')"
             type="button" class="btn btn-primary searchBtnUpdateDisplay">
            <i class="fa fa-pencil"></i>
             <span class="txtUpdate">Update</span>       
        </button>

        <button id="btnRemoveRoomInfo" onclick="removeFloorInfo('btnRemoveRoomInfo')"
             type="button" class="btn btn-primary searchBtnUpdateDisplay">
            <i class="fa fa-remove"></i>
             <span class="txtRemove">Remove</span>       
        </button>

        <button id="btnRefreshRoomPage" onclick="refreshPage('btnRefreshRoomPage')"
             type="button" class="btn btn-primary searchBtnUpdateDisplay">
            <i class="fa fa-refresh"></i>
             <span>Refresh</span>       
        </button>

    </div>

</form>

</fieldset>
</div>

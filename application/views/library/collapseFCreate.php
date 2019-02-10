<div id="collapseFloorCreate" class="col-sm-12 collapse in">
<fieldset class="scheduler-border">
    <legend class="scheduler-border">Create New Floor</legend>

    <div class="alert alert-warning" id="div_alert">
        <strong></strong>
    </div>

<form>

    <div class="input-group mt">
        <span class="input-group-addon">
            <i class="fa fa-edit"></i>
        </span>
        <input id="txtFloorNo" type="text" class="form-control" name="email" placeholder="Floor No">
    </div>

    <div class="input-group mt">
        <span class="input-group-addon"><i class="fa fa-edit"></i></span>

        <select id="comboHotelId" class="form-control">
        
            <?php foreach($getHotelList as $h): ?>
                <option class="selected_id-<?php echo $h["id"]; ?>" value="<?php echo $h["id"] ?>">
                    <?php echo $h["hotel_name"]; ?>
                </option>
            <?php endforeach; ?>

        </select>

    </div>

    <div class="input-group mt radio_group">
        <input value="0" type="radio" name="active_status"  checked /> Active
        <input value="1" type="radio" name="active_status" /> InActive
    </div>
    <div class="input-group mt">

        <button id="btnSaveFloorInfo" onclick="saveFloorInfo('btnSaveFloorInfo')"
             type="button" class="btn btn-primary btnSaveDisplay">
            <i class="fa fa-plus-circle"></i>
             <span class="Loading">Save</span>       
        </button>

        <button id="btnUpdateFloorInfo" onclick="updateFloorInfo('btnUpdateFloorInfo')"
             type="button" class="btn btn-primary searchBtnUpdateDisplay">
            <i class="fa fa-pencil"></i>
             <span class="txtUpdate">Update</span>       
        </button>

        <button id="btnRemoveFloorInfo" onclick="removeFloorInfo('btnRemoveFloorInfo')"
             type="button" class="btn btn-primary searchBtnUpdateDisplay">
            <i class="fa fa-remove"></i>
             <span class="txtRemove">Remove</span>       
        </button>

        <button id="btnRefreshPage" onclick="refreshPage('btnRefreshPage')"
             type="button" class="btn btn-primary searchBtnUpdateDisplay">
            <i class="fa fa-refresh"></i>
             <span>Refresh</span>       
        </button>

    </div>

</form>

</fieldset>
  

</div>
<!-- Collapse End -->
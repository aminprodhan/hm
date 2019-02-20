<?php foreach($list as $l): ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="page-title mn"><u>Reservation</u></h4>
        </div>
        <div class="panel-body">
            <div class="col-sm-12">


                
             

               <div class="row">
                    <label style="width:10%" class="col-sm-2">Allotment Id</label>
                    <div style="width:20%" class="col-sm-2">
                    <input disabled value="<?php echo $l["isAllotment"] ?>" class="form-control" id="resv_allot_id" placeholder="Allotment Id">
                    </div>
                    
                </div>

                <div class="row" style="display:none;">
                    <label for="exampleInputEmail1">Hotel List</label>
                    <select id="hid" class="form-control">

                    </select>
                    <small id="error_txtHotel" class="form-text text-muted"></small>
                </div>

                <div class="row">
                    <label style="width:10%" class="col-sm-2">Resv. Date</label>
                    <div style="width:20%" class="col-sm-2">
                        <input value="<?php echo $l["resv_date"] ?>"  id="resv_date" class="form-control tcal"  />
                    </div>
                    <label style="width:10%" class="col-sm-2">Agent List</label>
                    <select style="width:20%" id="agent_list" name="agent" class="form-control">
                            <option value="0">All</option>
                            <?php foreach($agent_list as $a): ?>
                                <option <?php if($a["id"] == $l["agent"]): ?>selected <?php endif; ?> 
                                    value="<?php echo $a["id"] ?>">
                                    <?php echo $a["name"]; ?>
                                </option>
                            <?php endforeach; ?>
                    </select>
                </div>


                <div class="row rr">
                    <label style="width:10%" class="col-sm-2">Adult</label>
                    <div style="width:20%" class="col-sm-2">
                        <input placeholder="Number of adult" value="<?php echo $l["adult"] ?>"  id="number_of_adult" class="form-control"  />
                    </div>
                    <label style="width:10%" class="col-sm-2">Children</label>
                    <div style="width:20%" class="col-sm-2">
                        <input placeholder="Number of Children" value="<?php echo $l["children"] ?>"  id="number_of_children" class="form-control"  />
                    </div>
                </div>


                <div class="row rr">
                    <label style="width:10%" class="col-sm-2">Resv. Type</label>
                    <div style="width:20%" class="col-sm-2">
                        <select  id="resv_type" name="agent" class="form-control" disabled>
                                <option value="0">All</option>
                                <?php foreach($reservation_type as $a): ?>
                                    <option <?php if($l["resv_type"] == $a["id"]): ?>selected<?php endif; ?>
                                        value="<?php echo $a["id"] ?>">
                                        <?php echo $a["type_name"]; ?>
                                    </option>
                                <?php endforeach; ?>
                        </select>
                    </div>
                </div>

           
             

            </div>
        </div>
    </div>

<?php endforeach; ?>
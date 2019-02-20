<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="page-title mn"><u>Update Room Information</u></h4>
    </div>
    <div class="panel-body">
        <div class="col-sm-12">
            <?php     
                $roomTypeList=$this->room_model->getRoomTypeList("type_list","type_id",20,"type_name","asc");
            ?>

            <label style="width:10%" class="col-sm-2">Room Type</label>
            <div style="width:20%" class="col-sm-2">
                <select id="searchRoomType" class="form-control">  
                    <option value="0">All</option>            
                    <?php foreach($roomTypeList as $rt): ?>
                        <option value="<?php echo $rt["id"] ?>">
                            <?php echo $rt["type_name"] ?>
                        </option>
                    <?php endforeach; ?>                
                </select>
            </div>
            <label style="width:10%" class="col-sm-2">Start Date</label>
            <div style="width:20%" class="col-sm-2">
                <input value="<?php echo date('d-m-Y') ?>" id="room_start_date" class="form-control tcal" />
            </div>
            <label style="width:10%" class="col-sm-2">End Date</label>
            <div style="width:20%" class="col-sm-2">
                <input value="<?php echo date('d-m-Y') ?>" id="room_end_date" class="form-control tcal" />
            </div>
            <div class="col-sm-2" style="width:10%">
                <button onclick="searchRoomForReservation(this)" class="btn btn-primary">
                    <i class="fa fa-search"></i>
                    Search
                </button>
            </div>
            <?php $this->load->view("library/searchRoomForReservation"); ?>
        </div>
        <div class="col-sm-12 rr" id="loadRoomInfo">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Hotel Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Room No</th>
                        <th>Bed No</th>
                        <th>Room Type</th>
                        <th>Floor</th>
                        <th>Rent</th>
                    </tr>
                </thead>
                <tbody id="booked_room_list">
                
                    <?php $sl=1; foreach($resv_list as $rl): ?>
                        <tr>
                            <td><?php echo $sl++; ?></td>
                            <td>
                                <?php echo $rl["hotel_name"]; ?>
                            </td>
                            <td>
                                <?php echo $rl["start_date"]; ?>
                            </td>
                            <td>
                                <?php echo $rl["end_date"]; ?>
                            </td>
                            <td>
                                <?php echo $rl["room_no"]; ?>
                            </td>
                            <td>
                                <?php echo $rl["bed_no"]; ?>
                            </td>
                            <td><?php echo $rl["type_name"]; ?></td>
                            <td><?php echo $rl["floor_no"]; ?></td>
                            <td><?php echo $rl["rent"]; ?></td>
                            <td><input class='<?php echo $rl["rrid"] ?>-tr' type='checkbox' /></td>
                        </tr>
                    <?php endforeach; ?>
                        <tr>
                            <td colspan="9" style="text-align:right;">
                                <button onclick='removeReservationRoom(this)' class='btn btn-warning'>Submit</button>
                            </td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
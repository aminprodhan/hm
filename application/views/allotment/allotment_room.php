<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="page-title mn"><u>Room Allotment</u></h4>
    </div>
    <div class="panel-body">
        <div class="col-sm-12">
            <label style="width:10%" class="col-sm-2">Start Date</label>
            <div style="width:20%" class="col-sm-2">
                <input value="<?php echo date('d-m-Y') ?>" id="allotment_start_date" class="form-control tcal" />
            </div>
            <label style="width:10%" class="col-sm-2">End Date</label>
            <div style="width:20%" class="col-sm-2">
                <input value="<?php echo date('d-m-Y') ?>" id="allotment_end_date" class="form-control tcal" />
            </div>
            <div class="col-sm-2" style="width:10%">
                <button onclick="searchRoomForAllotment(this)" class="btn btn-primary">
                    <i class="fa fa-search"></i>
                    Search
                </button>
            </div>
        </div>
        <div class="col-sm-12 rr">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Agent Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Room No</th>
                        <th>Floor</th>
                        <th>Rent</th>
                    </tr>
                </thead>
                <tbody id="booked_allotment_room_list">
                    <?php foreach($room_list as $r): ?>
                        <tr>
                            <td>SL</td>
                            <td>Agent Name</td>
                            <td><?php echo $r["from_date"] ?></td>
                            <td><?php echo $r["to_date"] ?></td>
                            <td>Room No</td>
                            <td>Floor</td>
                            <td><?php echo $r["rent"] ?></td>
                            <td><input class='<?php echo $r["id"] ?>-tr' type='checkbox' /></td>

                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="9" style="text-align:right;">
                            <button onclick='removeAllotmentRoom(this)' class='btn btn-warning'>Submit</button>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
        <?php $this->load->view("modal/modal_room_allotment"); ?>

    </div>
</div>
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
                Reservation List
            </strong>
        </div>
        <div class="alert alert-info" id="div_alert">
            <div class="panel panel-default">
                <div class="panel-body">
                <fieldset class="scheduler-border">
                <legend class="scheduler-border">Data Filter</legend>

                <form action="<?php echo base_url(); ?>reservation_controller/reservationList" method="GET">
                    <div class="row" style="text-align:center;">
                        <label style="width:10%" class="col-sm-2">Type</label>
                            <div style="width:20%" class="col-sm-2">
                                <select name="status" class="form-control">
                                    <option value="0">All</option>
                                    <?php foreach($agent_list as $a): ?>

                                        <option value="2">Pending</option>
                                        <option value="1">Complete</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <label style="width:10%" class="col-sm-2">Start Date</label>
                        <div style="width:20%" class="col-sm-2">
                            <input value="<?php echo date('d-m-Y') ?>" name="start_date" class="form-control tcal" />
                        </div>
                        <label style="width:10%" class="col-sm-2">End Date</label>
                        <div style="width:20%" class="col-sm-2">
                            <input value="<?php echo date('d-m-Y') ?>"  name="end_date" class="form-control tcal" />
                        </div>

                    </div>
                    <div class="row rr">
                        <label class="col-sm-2" style="width:20%">&nbsp;</label>
                        <label style="width:10%" class="col-sm-2">Resv. Code</label>
                        <div style="width:20%" class="col-sm-2">
                            <input  name="resv_code" class="form-control"  />
                        </div>
                         <label style="width:10%" class="col-sm-2">Agent</label>
                        <div style="width:20%" class="col-sm-2">
                            <select name="agent" class="form-control">
                                <option value="0"></option>
                                <?php foreach($agent_list as $a): ?>
                                    <option value="<?php echo $a["id"] ?>">
                                        <?php echo $a["name"]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <label class="col-sm-2" style="width:20%">&nbsp;</label>

                    </div>


                    <div class="row rr" style="text-align:center;">
                        <button type="submit" class="btn btn-primary">
                        <i class="fa fa-search"></i>
                            Search
                        </button>
                    </div>

                </form>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="col-sm-12 mn rr" style="text-align:right;" >
            <a href="<?php echo base_url(); ?>reservation_controller/" class="btn btn-primary">
                <span class="fa fa-plus-circle"></span> New Reservation
            </a>
        </div>
        <div class="col-sm-12 mn rr" >
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-body">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Reservation List</legend>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Resv.Code</th>
                                        <th>Allot.Code</th>
                                        <th>Date</th>
                                        <th>Agent</th>
                                        <th>Num.Adult</th>
                                        <th>Num.Child</th>
                                        <th>Date Time</th>
                                        <th>Check In</th>
                                        <th>Modify</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $sl=1; foreach($list as $l): ?>
                                        <tr>
                                            <td><?php echo $sl++; ?></td>
                                            <td>
                                                <?php echo $l["resv_code"] ?>
                                            </td>
                                            <td>
                                                <?php echo $l["isAllotment"] ?>
                                            </td>
                                            <td>
                                                <?php echo $l["resv_date"] ?>
                                            </td>
                                            <td>
                                                <?php echo $this->common->anyName("agent_list","id",$l["agent"],"name"); ?>
                                            </td>
                                            <td>
                                                <?php echo $l["children"] ?>
                                            </td>
                                            <td>
                                                <?php echo $l["adult"] ?>
                                            </td>
                                            <td>
                                                <?php echo $l["date_time"] ?>
                                            </td>
                                            <td>
                                                <?php if(empty($l["check_in_status"])): ?>
                                                    <a class="btn btn-success" 
                                                        href="<?php echo base_url();  ?>reservation_controller/getReservationInfo/<?php echo $l["resv_id"] ?>/1">
                                                        <span class="fa fa-plus-circle"></span> Check In
                                                    </a>
                                                <?php endif; ?>

                                                 <?php if(!empty($l["check_in_status"])): ?>
                                                    <a class="btn btn-danger" 
                                                        href="<?php echo base_url();  ?>reservation_controller/getReservationInfo/<?php echo $l["resv_id"] ?>/2">
                                                        <span class="fa fa-plus-circle"></span> Check Out
                                                    </a>
                                                <?php endif; ?>


                                            </td>
                                            <td>
                                                <a style="color:red;font-weight:bold;" 
                                                    href="<?php echo base_url();  ?>reservation_controller/getReservationInfo/<?php echo $l["resv_id"] ?>">
                                                    <span class="fa fa-minus-circle"></span>Edit |
                                                </a>

                                                <a style="color:red;font-weight:bold;" 
                                                    href="<?php echo base_url();  ?>">
                                                    <span class="fa fa-remove"></span>Del
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            </fieldset>
                        </div>
                    </div>
                </div>
            
        </div>
    </div>
</div>
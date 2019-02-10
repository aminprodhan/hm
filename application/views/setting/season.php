<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row">
            <div class="col-sm-12" id="menuBar">
                <div class="card-box">
                    <h4 class="card-title">Season</h4>
                    <form action="#" onsubmit="return false" id="season_add_form">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Hotel</label>
                                    <select name="add_season_hotel" id="add_season_hotel" class="form-control">
                                        <option value="0">Select Hotel</option>
                                        <?php 
                                        foreach ($all_hotels as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value['id'];?>"><?php echo $value['hotel_name'];?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Season Name</label>
                                    <input type="text" id="add_season_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Starting Date</label>
                                    <input type="text" id="add_season_start_date" name="add_season_starting_date" class="form-control sett_date" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Ending Date</label>
                                    <input type="text" id="add_season_end_date" name="add_season_end_date" class="form-control sett_date" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                <div class="season_form_error"></div>
                                <div class="text-primary">
                                    <span class="add_new_season_btn" style="display: none;cursor: pointer;">Add new season</span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="text-right">
                                    <a href="<?php echo base_url();?>admin/season" id="add_season_cancel_btn" class="btn btn-primary" style="display: none;">Cancel</a>
                                    <button type="submit" id="add_season_submit_btn" onclick="add_season_submit();" class="btn btn-primary">Submit</button>
                                    <button type="submit" id="update_season_submit" class="btn btn-warning text-default" style="display: none;">Update Season</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="card-block">
                        <h6 class="card-title text-bold">All Hotel Season</h6>
                        <table class="display datatable table table-stripped">
                            <thead class="text-center">
                                <tr>
                                    <th class="text-center">Sl.</th>
                                    <th class="text-center">Hotel Name</th>
                                    <th class="text-center">Season Name</th>
                                    <th class="text-center">Start Date</th>
                                    <th class="text-center">End Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="all_season_table">
                                <?php
                                $sl = 1;
                                foreach ($seasons as $key => $value) {
                                ?>
                                <tr class="text-center">
                                    <td><?php echo $sl;?></td>
                                    <td id="update_season_hotel_<?php echo $value['id']?>"><?php echo $this->common->anyNameWithoutWare('ware','id',$value['ware'],'hotel_name');?></td>
                                    <td id="update_season_name_<?php echo $value['id']?>"><?php echo $value['season_name'];?></td>
                                    <td id="update_season_start_date_<?php echo $value['id']?>"><?php echo $value['start_date'];?></td>
                                    <td id="update_season_end_date_<?php echo $value['id']?>"><?php echo $value['end_date'];?></td>
                                    <td>
                                        <input type="hidden" id="update_season_row_id_<?php echo $value['id'];?>" value="<?php echo $value['id'];?>">
                                        <input type="hidden" id="update_season_hotel_id_<?php echo $value['id'];?>" value="<?php echo $value['ware'];?>">
                                        <button id="update_season_<?php echo $value['id']; ?>" onclick="update_season(<?php echo $value['id'];?>)" class="btn btn-warning" title="Update <?php echo $value['season_name'];?>">
                                            <i class="fa fa-pencil"></i>
                                        </button> 
                                        <button  id="delete_season_<?php echo $value['id'];?>" onclick="delete_season(<?php echo $value['id'];?>)" class="btn btn-danger" value="<?php echo $value['season_name'];?>" title="Delete <?php echo $value['season_name'];?>">
                                            <i class="fa fa-trash"></i>
                                        </button> 
                                    </td>
                                </tr>
                                <?php
                                $sl++;
                                }
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("library/floor_modal"); ?>
<script src="<?php echo base_url(); ?>js/custom/floorSetting.js"></script>
<script src="<?php echo base_url(); ?>js/custom/roomSetting.js"></script>

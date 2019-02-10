        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-md-12">
                    	<div class="card-box">
                            <h4 class="card-title">Menu Setting</h4>
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#main_menu_tab" data-toggle="tab">Main Menu</a></li>
                                <li><a href="#sub_menu_tab" data-toggle="tab">Sub Menu</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="main_menu_tab">
                                	<div class="main-menu-form">
                                		<form onsubmit="return false" id="add_menu_form">
			                                <div class="row">
			                                    <div class="col-md-4">
			                                        <div class="form-group">
			                                            <label>Module</label>
			                                            <select id="main_menu_module" class="form-control">
			                                                <option value="0">Select Module</option>
			                                                <?php
			                                                foreach ($all_module as $value) {
		                                                	?>
			                                                <option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
		                                                	<?php
			                                                }
			                                                ?>
			                                            </select>
			                                        </div>
			                                    </div>
			                                    <div class="col-md-4">
			                                        <div class="form-group">
			                                            <label>Menu Name</label>
			                                            <input type="text" id="main_menu_name" class="form-control">
			                                        </div>
			                                    </div>
			                                    <div class="col-md-4">
			                                        <div class="form-group">
			                                            <label>Controller</label>
			                                            <input type="text" id="main_menu_controller" class="form-control">
			                                        </div>
			                                    </div>
			                                </div>
			                                <div class="row">
			                                	<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
			                                		<div class="main_menu_add_error"></div>
				                                	<div class="text-info">
				                                		<span class="new_menu_add_btn" style="display: none;cursor: pointer;">Add main menu</span>
				                                	</div>
			                                	</div>
			                                	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
			                                		<div class="text-right">
					                                    <button onclick="add_main_menu_btn()" id="add_main_menu_btn_sub" class="btn btn-primary">Submit</button>
					                                    <button onclick="main_menu_update_submit()" id="main_menu_update_submit_btn" class="btn btn-warning" style="display: none;">Update</button>
					                                </div>
			                                	</div>
			                                </div>
				                        </form>
                                	</div>
					                <div class="row pt-25">
					                    <div class="col-lg-12">
					                        <div class="card-box">
					                            <div class="card-block">
					                                <h6 class="card-title text-bold">All Main Menu</h6>
					                                <table class="display datatable table table-stripped">
					                                    <thead>
					                                        <tr>
					                                            <th class="text-center">Sl.</th>
					                                            <th class="text-center">Menu Name</th>
					                                            <th class="text-center">Module</th>
					                                            <th class="text-center">Controller</th>
					                                            <th class="text-center">Action</th>
					                                        </tr>
					                                    </thead>
					                                    <tbody id="main_menu_table">
					                                    	<?php
					                                    	$sl = 1;
					                                    	foreach ($all_main_menu as $key => $value) {
					                                    	?>
					                                        <tr id="main_menu_list_tr_<?php echo $value['id'];?>" class="text-center">
					                                            <td><?php echo $sl;?></td>
					                                            <td id="main_menu_name_<?php echo $value['id'];?>"><?php echo $value['name'];?></td>
					                                            <td id="main_menu_module_<?php echo $value['id'];?>"><?php echo $this->common_model->singleRowSpecific('sett_modules','id',$value['module'],'name');?></td>
					                                            <td id="main_menu_controller_<?php echo $value['id'];?>"><?php echo $value['controller'];?></td>
					                                            <td>
					                                            	<input type="hidden" id="menu_module_list_id<?php echo $value['id'];?>" value="<?php echo $value['module'];?>">
					                                            	<button id="update_main_menu_<?php echo $value['id']; ?>" onclick="update_main_menu(<?php echo $value['id'];?>)" class="btn btn-warning" title="Update <?php echo $value['name'];?>">
					                                            		<i class="fa fa-pencil"></i>
					                                            	</button> 
					                                            	<button  onclick="delete_main_menu(<?php echo $value['id'];?>)" class="btn btn-danger" title="Delete <?php echo $value['name'];?>">
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
                                <div class="tab-pane" id="sub_menu_tab">
                                	<div class="sub-menu-form">
                                		<form action="#" onsubmit="return false" id="sub_menu_form">
			                                <div class="row">
			                                    <div class="col-md-3">
			                                        <div class="form-group">
			                                            <label>Module</label>
			                                            <select class="form-control" id="add_submenu_module">
			                                                <option value="0">Select Module</option>
			                                            	<?php 
			                                            	foreach ($all_module as $key => $value) {
			                                            	?>
			                                                <option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
			                                            	<?php
			                                            	}
			                                            	?>
			                                            </select>
			                                        </div>
			                                    </div>
			                                    <div class="col-md-3">
			                                        <div class="form-group">
			                                            <label>Select main menu</label>
			                                            <select id="add_submenu_main_menu" class="form-control">
			                                                <option value="0">Select main menu</option>
			                                            	<?php 
			                                            	foreach ($all_main_menu as $key => $value) {
			                                            	?>
			                                                <option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
			                                            	<?php
			                                            	}
			                                            	?>
			                                            </select>
			                                        </div>
			                                    </div>
			                                    <div class="col-md-3">
			                                        <div class="form-group">
			                                            <label>Sub Menu Name</label>
			                                            <input type="text" id="add_submenu_submenu_name" class="form-control">
			                                        </div>
			                                    </div>
			                                    <div class="col-md-3">
			                                        <div class="form-group">
			                                            <label>Controller</label>
			                                            <input type="text" id="add_submenu_controller" class="form-control">
			                                        </div>
			                                    </div>
			                                </div>
			                                <div class="text-right">
			                                    <button type="submit" class="btn btn-primary">Submit</button>
			                                </div>
				                        </form>
                                	</div>
	                                
					                <div class="row pt-25">
					                    <div class="col-lg-12">
					                        <div class="card-box">
					                            <div class="card-block">
					                                <h6 class="card-title text-bold">Default Datatable</h6>
					                                <p class="content-group">
					                                    This is the most basic example of the datatables with zero configuration. Use the <code>.datatable</code> class to initialize datatables.
					                                </p>
					                                <table class="display datatable table table-stripped">
					                                    <thead>
					                                        <tr>
					                                            <th>Menu Name</th>
					                                            <th>Controller</th>
					                                            <th>Mo</th>
					                                            <th>Age</th>
					                                            <th>Start date</th>
					                                            <th>Salary</th>
					                                        </tr>
					                                    </thead>
					                                    <tbody>
					                                        <tr>
					                                            <td>Tiger Nixon</td>
					                                            <td>System Architect</td>
					                                            <td>Edinburgh</td>
					                                            <td>61</td>
					                                            <td>2011/04/25</td>
					                                            <td>$320,800</td>
					                                        </tr>
					                                        <tr>
					                                            <td>Donna Snider</td>
					                                            <td>Customer Support</td>
					                                            <td>New York</td>
					                                            <td>27</td>
					                                            <td>2011/01/25</td>
					                                            <td>$112,000</td>
					                                        </tr>
					                                    </tbody>
					                                </table>
					                            </div>
					                        </div>
					                    </div>
					                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
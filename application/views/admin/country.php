        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="card-title text-center">Country - State - City</h4>
                            <div class="card-body">
	                            <ul class="nav nav-tabs nav-justified">
	                                <li class="active"><a href="#country-tab" data-toggle="tab" aria-expanded="true">Country</a></li>
	                                <li class=""><a href="#state-tab" class="state-tab" data-toggle="tab" aria-expanded="false">State</a></li>
	                                <li class=""><a href="#city-tab" class="city-tab" data-toggle="tab" aria-expanded="false">City</a></li>
	                            </ul>
	                            <div class="tab-content container-fluid">

					                <!--  Country Tab -->
	                                <div class="tab-pane active" id="country-tab">
	                                	<h4 class="text-center">Add Country form</h4>
		                                <div class="row">
                                            <div class="col-md-6">
                                            	<label>Country Name</label>
                                            	<input type="text" id="add_country_name" class="form-control">
	                                        </div>
                                            <div class="col-md-6">
		                                        <div style="margin-top: 25px;">
	                                            	<button id="add_country_btn" onclick="add_country()" class="btn btn-info form-control">Submit</button>
	                                            	<button id="update_country_btn" style="display:none;" onclick="update_country_submit()" class="btn btn-warning form-control">Update</button>
		                                        </div>
	                                        </div>
	                                        <div class="col-md-12 country_add_error mt-15"></div>
	                                        <div class="col-md-12 text-info">
	                                        	<span class="add-new-country" style="display:none;cursor: pointer;">
	                                        		Add new country
	                                        	</span>
	                                        </div>
		                                </div>

						                <!-- start all list of country -->
						                <div class="all-country-state-city-list content">
						                    <div class="row">
						                        <div class="col-lg-12">
						                            <div class="card-box">
						                                <div class="card-block">
						                                    <h6 class="card-title text-bold text-center">All Countries</h6>
						                                    <table class="display datatable table table-stripped">
						                                        <thead>
						                                            <tr>
						                                                <th class="text-center">Sl.</th>
						                                                <th class="text-center">Country Name</th>
						                                                <th class="text-center">Action</th>
						                                            </tr>
						                                        </thead>
						                                        <tbody id="tcountry_add_panel">
						                                        	<?php
					                                        		$sl= 1;
					                                        		foreach($country_get as $all_countries){
					                                        		?>
						                                            <tr class="text-center">
						                                                <td><?php echo $sl;?>.</td>
																		<td id="<?php echo $all_countries['id']?>aname">
																			<?php echo $all_countries['name'];?>																			
																		</td>
						                                                <td>
						                               						<button class="btn btn-warning btn_custom" onclick="update_country(<?php echo $all_countries['id'];?>)" title="Update <?php echo $all_countries['name'];?>"><i class="fa fa-pencil fa-1x"></i></button>
						                               						<button class="btn btn-danger btn_custom" onclick="delete_country(<?php echo $all_countries['id'];?>)" title="Delete <?php echo $all_countries['name'];?>"><i class="fa fa-trash fa-1x"></i></button>
						                                                </td>
						                                            </tr>
					                                        		<?php
					                                        		$sl++;
						                                        	}?>
						                                        </tbody>
						                                    </table>
						                                </div>
						                            </div>
						                        </div>
						                    </div>
						                </div>
	                                </div>
					                <!-- end country Tab -->
					                <!-- Start State Tab -->
	                                <div class="tab-pane" id="state-tab">
	                                	<div class="row">
	                                		<div class="col-md-12">
	                                			<h4 class="text-center">Add State form</h4>
					                            <!-- <form class="form-horizontal" action="#"> -->
					                                <div class="row">
			                                            <div class="col-md-4">
			                                                <div class="form-group">
			                                                    <label>Select Country</label>
			                                                    <select id="addState_country_name" class="form-control">
			                                                    	<!-- <option value="0">Select country</option>
			                                                    	<?php
			                                                    	foreach ($country_get as $value) {
			                                                    	?>
			                                                    	<option value="<?php echo $value['id'];?>"><?php echo $value['name']; ?></option>
			                                                    	<?php
			                                                    	}
			                                                    	?> -->
			                                                    </select> 
				                                        	</div>
				                                        </div>
			                                            <div class="col-md-4">
			                                            	<label>State Name</label>
			                                            	<input type="text" id="addState_state_name" class="form-control">
				                                        </div>
			                                            <div class="col-md-4">
					                                        <div style="margin-top: 25px;">
				                                            	<button onclick="add_state()" id="add_state_btn" class="btn btn-info form-control">Submit</button>
					                                        	<button id="update_state_btn" style="display: none;" class="btn btn-warning form-control">Update</button>
				                                            </div>
				                                        </div>
				                                        <div class="col-md-12 addState_error">
				                                        	
				                                        </div>
				                                        <div class="col-md-12 text-info">
					                                        <span class="new_state_btn" style="display: none; cursor: pointer;">
					                                        	Add new state
					                                        </span>
				                                        </div>
					                                </div>
					                            <!-- </form>	 -->
	                                		</div>
	                                	</div>
						                <!-- All State list -->
						                <div class="all-country-state-city-list content">
						                    <div class="row">
						                        <div class="col-lg-12">
						                            <div class="card-box">
						                                <div class="card-block">
						                                    <h6 class="card-title text-bold text-center">All State</h6>
						                                    <table class="display datatable table table-stripped">
						                                        <thead>
						                                            <tr>
						                                                <th class="text-center">Sl.</th>
						                                                <th class="text-center">State Name</th>
						                                                <th class="text-center">Action</th>
						                                            </tr>
						                                        </thead>
						                                        <tbody id="state_table">
						                                        	<?php
						                                        	$sl = 1;
						                                        	foreach ($get_state as $key => $all_state) {
						                                        	?>
						                                            <tr class="text-center">
						                                                <td><?php echo $sl;?>.</td>
						                                                <td id="<?php echo $all_state['id'];?>aname">
						                                                	<?php echo $all_state['name'];?>
						                                                </td>
						                                                <td>
						                                                	<input type="hidden" id="state_p_id_<?php echo $all_state['id'];?>" value="<?php echo $all_state['p_id'];?>">
						                                                    <button onclick="update_state(<?php echo $all_state['id'];?>)" title="Update <?php echo $all_state['name'];?>" class="btn btn-warning"><i class="fa fa-pencil fa-1x"></i></button>
						                                                    <button onclick="delete_state(<?php echo $all_state['id'];?>)" title="Delete <?php echo $all_state['name'];?>" class="btn btn-danger"><i class="fa fa-trash fa-1x"></i></button>
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
					                <!--  end State Tab -->
					                <!--  start City Tab -->
	                                <div class="tab-pane" id="city-tab">
	                                	<div class="row">
	                                		<div class="col-md-12">
	                                			<h4 class="text-center">Add City form</h4>
					                            <!-- <form action="#" class="form-horizontal" method="post"> -->
					                                <div class="row">
			                                            <div class="col-md-6 mb-15">
		                                                    <label>Select Country</label>
		                                                    <select id="add_city_country_id" class="form-control">
		                                                        <option value="0">Select Country</option>
		                                                        <?php
		                                                        foreach ($country_get as $country) {
		                                                        ?>
		                                                        
		                                                        <!-- <option value="<?php echo $country['id'];?>" id="addcity_country_<?php echo $country['id'];?>"><?php echo $country['name'];?></option> -->
		                                                        
		                                                        <?php
		                                                        }
		                                                        ?>
		                                                    </select>
				                                        </div>
			                                            <div class="col-md-6 mb-15">
		                                                    <label>Select state</label>
		                                                    <select id="add_city_state_id" class="form-control">
		                                                        <option value="0">Select State</option>
		                                                    </select>
				                                        </div>
			                                            <div class="col-md-6 mb-15">
			                                            	<label>City Name</label>
			                                            	<input type="text" id="add_city_city_name" class="form-control">
				                                        </div>
			                                            <div class="col-md-6 mb-15">
					                                        <div class="pt-25">
				                                            	<button id="city_add_btn"  onclick="add_city()" class="btn btn-info form-control">Submit</button>
				                                            	<button id="city_update_btn" style="display: none;" class="btn btn-warning form-control">Update</button>
					                                        </div>
				                                        </div>
				                                        <div class="col-md-12 add_city_error"></div>
				                                        <div class="col-md-12">
				                                        	<span class="add_city_btn text-info" style="cursor: pointer;display: none;">Add new city</span>
				                                        </div>
					                                </div>
					                            <!-- </form> -->
	                                		</div>
	                                	</div>
						                <!-- All City list -->
						                <div class="all-country-state-city-list content">
						                    <div class="row">
						                        <div class="col-lg-12">
						                            <div class="card-box">
						                                <div class="card-block">
						                                    <h6 class="card-title text-bold text-center">All City</h6>
						                                    <table class="display datatable table table-stripped">
						                                        <thead>
						                                            <tr>
						                                                <th class="text-center">Sl.</th>
						                                                <th class="text-center">City Name</th>
						                                                <th class="text-center">Action</th>
						                                            </tr>
						                                        </thead>
						                                        <tbody id="city_table">
						                                        	<?php
						                                        	$sl = 1;
						                                        	foreach ($get_city as $key => $all_city) {
					                                        		?>
						                                            <tr class="text-center">
						                                                <td><?php echo $sl;?>.</td>
						                                                <td id="update_city_name_<?php echo $all_city['id'];?>"><?php echo $all_city['name'];?></td>
						                                                <td>
						                                                	<input type="hidden" id="update_city_state_<?php echo $all_city['id'];?>" value="<?php echo $all_city['p_id'];?>">
						                                                    <button onclick="update_city(<?php echo $all_city['id'];?>)" title="Update <?php echo $all_city['name'];?>" class="btn btn-warning"><i class="fa fa-pencil fa-1x"></i></button>
						                                                    <button onclick="delete_city(<?php echo $all_city['id'];?>)" title="Delete <?php echo $all_city['name'];?>" class="btn btn-danger"><i class="fa fa-trash fa-1x"></i></button>
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
					                <!--  end City Tab -->
	                            </div>
	                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
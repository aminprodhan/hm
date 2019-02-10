    
    
    <div id="collapseFloorList" class="col-sm-12 collapse">
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Floor List</legend>
            <div class="row">

                <div class="topnav">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-5" style="width: 35%;margin-top: 4px;">
                        <select class="form-control" id="searchHotelId">
                        
                            <?php foreach($getHotelList as $h): ?>
                                <option value="<?php echo $h["id"] ?>">
                                    <?php echo $h["hotel_name"]; ?>
                                </option>
                            <?php endforeach; ?>

                        </select>
                    </div>
                    <div class="search-container">
                        <form action="/action_page.php">
                        <input id="searchFloorId" type="text" placeholder="Search.." name="search">
                        <button onclick="searchFloorInfo()" type="button"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row mt">

               <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Floor No</th>
                            <th>Hotel</th>
                            <th>Status</th>    
                        <tr>

                    </thead>
                    <tbody id="tableFloorList"></tbody>
               </table>     

            </div>
    </fieldset>

    </div>

<div class="panel panel-default" style="min-height: 580px;">
    <div class="panel-heading">
        <h4 class="page-title mn"><u>Reservation</u></h4>
    </div>
    <div class="panel-body">
        <div class="col-sm-12">
            <div class="row">
                <label for="exampleInputEmail1">Hotel List</label>
                <select id="hid" class="form-control"></select>
                <small id="error_txtHotel" class="form-text text-muted"></small>
            </div>

            <div class="row">
                <label for="exampleInputEmail1">Date</label>
                <input value="<?php echo date('d-m-Y'); ?>" class="form-control tcal" id="resv_date" placeholder="Reservation Date">
                <small id="error_txtHotel" class="form-text text-muted"></small>
            </div>

            <div class="row">
                <label for="exampleInputEmail1">Agent List</label>
                <select id="agent_list" class="form-control"></select>
                <small id="error_txtHotel" class="form-text text-muted"></small>
            </div>

            <div class="row">
                <label for="exampleInputEmail1">Adult</label>
                <input class="form-control" id="number_of_adult" placeholder="Number of adult">
                <small id="error_txtHotel" class="form-text text-muted"></small>
            </div>

            <div class="row">
                <label for="exampleInputEmail1">Children</label>
                <input class="form-control" id="number_of_children" placeholder="Number of children">
                <small id="error_txtHotel" class="form-text text-muted"></small>
            </div>

             <div class="row">
                <label for="exampleInputEmail1">Resv.Type</label>
                <select id="resv_type" class="form-control"></select>

            </div>

        </div>
    </div>
</div>
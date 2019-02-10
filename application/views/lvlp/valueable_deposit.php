<style>
    .custom_input {
        display: block;
        width: 100%;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 4px;

        -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
        -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    }
</style>
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-xs-12 col-md-9 ">
                <div class="card-box">
                    <div class="row">
                        <h4 class="card-title col-md-6">Deposit Information</h4>
                        <div class="col-md-6">
                            <div class="text-right">
                                <a onclick="" class="btn btn-primary"  data-toggle="modal" data-target="#newValueableDepositModal"
                                   id="valueable_deposit_new" name="valueable_deposit_new">
                                    New Deposit
                                </a>
                            </div>
                        </div>
                    </div>
                    <form onsubmit=return(false) class="form-horizontal">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="valueable_deposit_search_deposit_no">Deposit No:</label>
                                    <div class="col-md-9">
                                        <select class="selectpicker" data-live-search="true"
                                                id="valueable_deposit_search_deposit_no" name="valueable_deposit_search_deposit_no">
                                            <option value="">Deposit No</option>
                                            <?php foreach ($all_deposit as $deposit): ?>
                                                <option value="<?= $deposit['id'] ?>"> <?= $deposit['deposit_no'] ?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 control-label" for="valueable_deposit_search_is_return">Is Returned:</label>
                                    <div class="col-md-9">
                                        <select class="selectpicker" id="valueable_deposit_search_is_return">
                                            <option value="">Select Mode</option>
                                            <option value="01">Yes</option>
                                            <option value="02">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="valueable_deposit_search_check_in_no">Check in No:</label>
                                    <div class="col-md-9">
                                        <select class="selectpicker" id="valueable_deposit_search_check_in_no"
                                                name="valueable_deposit_search_check_in_no" data-live-search="true">
                                            <option value="">Select CheckIn No</option>
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="03">03</option>
                                            <option value="04">04</option>
                                            <option value="05">05</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-2">
                                        <label class="control-label" for="valueable_deposit_search_from_date">From Date:</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input style="border-radius: 10px;" type="text" class="form-control"
                                               id="valueable_deposit_search_from_date" name="valueable_deposit_search_from_date">
                                    </div>
                                    <label class="col-md-2 control-label" for="valueable_deposit_search_to_date">To Date:</label>
                                    <div class="col-md-4">
                                        <input style="border-radius: 10px;" type="text" class="form-control"
                                               id="valueable_deposit_search_to_date" name="valueable_deposit_search_to_date">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button onclick="search()" type="submit" class="btn btn-primary">Submit</button>
                            <button onclick="reset_laundry_search()" type="reset" class="btn btn-primary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row" id="valueable_deposit_list">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="card-block">
                        <h6 class="card-title text-bold">Deposit List</h6>
                        <table class="  table table-stripped">
                            <thead>
                            <tr>
                                <th>#SL</th>
                                <th>Deposit No</th>
                                <th>Check in No</th>
                                <th>Reutrned</th>
                                <th>Date</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="valueable_deposit_list_table_data">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="newValueableDepositModal" tabindex="-1" role="dialog" aria-labelledby="newBillModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">New Deposit</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5">
                            <h4>Add Item</h4>
                            <form onsubmit=return(false) id="valueable_deposit_add_item">
                                <fieldset>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label" for="deposit_no" >DepositNo:</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" style="border-radius: 10px;"
                                                   value="<?= $deposit_no; ?>"  id="deposit_no" name="deposit_no" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label">Check in No:</label>
                                        <div class="col-md-9">
                                            <select class="selectpicker sss" id="valueable_deposit_check_in_no"
                                                    name="valueable_deposit_check_in_no" data-live-search="true" data-width="75%">
                                                <option value="">Select CheckIn No</option>
                                                <option value=1>01</option>
                                                <option value=2>02</option>
                                                <option value=3>03</option>
                                                <option value=4>04</option>
                                                <option value=5>05</option>
                                            </select>
                                            <!--                                        <input type="text" class="form-control" id="valueable_deposit_check_in_no" name="valueable_deposit_check_in_no">-->
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label">Item:</label>
                                        <div class="col-md-9">
                                            <select onchange="" class="selectpicker" id="valueable_deposit_item_select"
                                                    name="valueable_deposit_item_select" data-live-search="true" data-width="75%">
                                                <option value = "">Select Item</option>
                                                <?php foreach ($all_item as $item): ?>
                                                    <option value="<?= $item['id'] ?>"> <?= $item['name'] ?> </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label">Quantity:</label>
                                        <div class="col-md-7">
                                            <input onkeyup="quantity_calcultaion()" onclick="quantity_calcultaion()" type="number" value="1" min="1" style="border-radius: 10px;" class="form-control"
                                                   id="valueable_deposit_item_quantity" name="valueable_deposit_item_quantity">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label">Balance:</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" style="border-radius: 10px;" value="1"
                                                   id="valueable_deposit_balance" name="valueable_deposit_balance" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label">Remarks:</label>
                                        <div class="col-md-7">
                                            <textarea class="form-control" style="border-radius: 10px;" name="valueable_deposit_remarks" id="valueable_deposit_remarks" ></textarea>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button onclick="addNewDeposit()" type="submit" class="btn btn-primary" id="deposit_item_add_btn">
                                            Add
                                        </button>
                                        <button onclick="new_valueable_deposit()" type="submit" class="btn btn-secondary">
                                            New Bill
                                        </button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <div class="col-md-7">
                            <h5>Item list</h5>
                            <form onsubmit=return(false) id="valueable_deposit_item_list">
                                <div class="row">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th width="70">Item</th>
                                            <th width="60">Quantity</th>
                                            <th width="100">R.Quantity</th>
                                            <th width="100">R.Date</th>
                                            <th width="60">Balance</th>
                                            <th width="70">Remarks</th>
                                            <th id="delete_btn">X</th>
                                        </tr>
                                        </thead>
                                        <tbody id="item_list">

                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 control-label">Pay Mode</label>
                                    <div class="col-md-9">
                                        <select class="selectpicker" id="valueable_deposit_pay_mode">
                                            <option value="">Select Mode</option>
                                            <?php foreach ($all_pay_mode as $item): ?>
                                                <option value="<?= $item['id'] ?>"> <?= $item['name'] ?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 control-label" for="laundry_paid_checkbox">Paid</label>
                                    <input class="col-md-1" type="checkbox" id="laundry_paid_checkbox" name="laundry_paid_checkbox"style="width: 20px;height: 20px;">
                                    <div class="col-md-7">
                                        <input style="border-radius: 10px;" type="text" class="form-control" id="valueable_deposit_paid_amount" readonly>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button onclick="valueable_deposit_status_update()" type="submit" class="btn btn-success" id="valueable_deposit_paid_btn">Paid</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <div class="col-md-4" id="message"></div>
                    <div class="col-md-4">
                        <a type="button" class="btn btn-danger" data-dismiss="modal" >Close</a>
                    </div>
                    <div class="col-md-4" id="message1"></div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lvlp/valueable_deposit.js"></script>
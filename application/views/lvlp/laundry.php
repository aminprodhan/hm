<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-xs-12 col-md-9 ">
                <div class="card-box">
                    <div class="row">
                        <h4 class="card-title col-md-6">Laundry Information</h4>
                        <div class="col-md-6">
                            <div class="text-right">
                                <a onclick="new_laundry_bill()" class="btn btn-primary"  data-toggle="modal" data-target="#newBillModal"
                                   id="laundry_new_bill" name="laundry_new_bill">
                                    New Bill
                                </a>
                            </div>
                        </div>
                    </div>
                    <form onsubmit=return(false) class="form-horizontal">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="laundry_bill_search_voucher_no">Voucher No:</label>
                                    <div class="col-md-9">
<!--                                        <input style="border-radius: 10px;" type="text" class="form-control"-->
<!--                                        id="laundry_bill_search_voucher_no" name="laundry_bill_search_voucher_no">-->
                                        <select class="selectpicker" data-live-search="true"
                                                id="laundry_bill_search_voucher_no" name="laundry_bill_search_voucher_no">
                                            <option value="">Voucher No</option>
                                            <?php foreach ($all_bill as $bill): ?>
                                                <option value="<?= $bill['id'] ?>"> <?= $bill['voucher_no'] ?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 control-label">Is Paid:</label>
                                    <div class="col-md-9">
                                        <select class="selectpicker" id="laundry_bill_search_is_paid">
                                            <option value="">Select Mode</option>
                                            <option value="01">Paid</option>
                                            <option value="02">UnPaid</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Check in No:</label>
                                    <div class="col-md-9">
<!--                                        <input style="border-radius: 10px;" type="text" class="form-control">-->
                                        <select class="selectpicker" id="laundry_bill_search_check_in_no"
                                                name="laundry_bill_search_check_in_no" data-live-search="true">
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
                                        <label class="control-label" for="laundry_bill_search_from_date">From Date:</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input style="border-radius: 10px;" type="text" class="form-control"
                                               id="laundry_bill_search_from_date" name="laundry_bill_search_from_date">
                                    </div>
                                    <label class="col-md-2 control-label" for="laundry_bill_search_to_date">To Date:</label>
                                    <div class="col-md-4">
                                        <input style="border-radius: 10px;" type="text" class="form-control"
                                        id="laundry_bill_search_to_date" name="laundry_bill_search_to_date">
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

        <div class="row" id="laundry_bill_list">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="card-block">
                        <h6 class="card-title text-bold">Laundry Bill List</h6>
                        <table class="  table table-stripped">
                            <thead>
                            <tr>
                                <th>#SL</th>
                                <th>Voucher No</th>
                                <th>Check in No</th>
                                <th>Paid</th>
                                <th>Total</th>
                                <th>Pay Mode</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="laundry_bill_list_table_data">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="newBillModal" tabindex="-1" role="dialog" aria-labelledby="newBillModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">New Laundry Bill</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Add Item</h5>
                            <form onsubmit=return(false) id="laundry_bill_add_item">
                                <fieldset>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label">VoucherNo:</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" style="border-radius: 10px;"
                                                   value="<?= $voucher_no; ?>"  id="laundry_voucher_no" name="laundry_voucher_no" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label">Check in No:</label>
                                        <div class="col-md-9">
                                            <select class="selectpicker sss" id="laundry_bill_check_in_no"
                                                    name="laundry_bill_check_in_no" data-live-search="true">
                                                <option value="">Select CheckIn No</option>
                                                <option value=1>01</option>
                                                <option value=2>02</option>
                                                <option value=3>03</option>
                                                <option value=4>04</option>
                                                <option value=5>05</option>
                                            </select>
                                            <!--                                        <input type="text" class="form-control" id="laundry_bill_check_in_no" name="laundry_bill_check_in_no">-->
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label">Item:</label>
                                        <div class="col-md-9">
                                            <select onchange="getRate()" class="selectpicker"
                                                    id="laundry_bill_item_select" name="laundry_bill_item_select"
                                                    data-live-search="true">
                                                <option value = "">Select Item</option>
                                                <?php foreach ($all_item as $item): ?>
                                                    <option value="<?= $item['id'] ?>"> <?= $item['name'] ?> </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label">Rate:</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" style="border-radius: 10px;"
                                                   id="laundry_bill_item_rate" name="laundry_bill_item_rate" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label">Quantity:</label>
                                        <div class="col-md-3">
                                            <input onkeyup="quantity_calcultaion()" onclick="quantity_calcultaion()" type="number" value="1" min="1" max="10" style="border-radius: 10px;" class="form-control"
                                                   id="laundry_bill_item_quantity" name="laundry_bill_item_quantity">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label">Total:</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" style="border-radius: 10px;"
                                                   id="laundry_bill_total" name="laundry_bill_total" readonly>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button onclick="addNewLaundryBill()" type="submit" class="btn btn-primary" id="laundry_item_add_btn">
                                            Add
                                        </button>
                                        <button onclick="new_laundry_bill()" type="submit" class="btn btn-secondary">
                                            New Bill
                                        </button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <h5>Item list</h5>
                            <form onsubmit=return(false) id="laundry_bil_item_list">
                                <div class="row">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Rate</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
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
                                        <select class="selectpicker" id="laundry_bill_pay_mode">
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
                                        <input style="border-radius: 10px;" type="text" class="form-control" id="laundry_bill_paid_amount" readonly>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button onclick="laundry_bill_status_update()" type="submit" class="btn btn-success" id="laundry_bill_paid_btn">Paid</button>
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

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lvlp/laundry.js"></script>
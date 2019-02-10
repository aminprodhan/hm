$(document).ready(function() {
    $('#laundry_bill_search_from_date,#laundry_bill_search_to_date').datepicker({
        todayBtn: "linked",
        orientation: "bottom auto",
        daysOfWeekHighlighted: "5",
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        autoclose: true
    });
});

$(document).on("focusin", "#laundry_bill_search_from_date,#laundry_bill_search_to_date", function() {
    $(this).prop('readonly', true);
});

$(document).on("focusout", "#laundry_bill_search_from_date,#laundry_bill_search_to_date", function() {
    $(this).prop('readonly', false);
});

$('#laundry_bill_list').hide();

function links() {
    var li = 'http://localhost/hotel_management/';
    return li;
}

var li = links()

$('#laundry_bill_item_quantity').bootstrapNumber();

function isNumber(evt) {
    var iKeyCode = (evt.which) ? evt.which : evt.keyCode
    if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
        return false;
    return true;
}

function new_laundry_bill() {
    var voucher_name = 'laun';
    voucher_update(voucher_name);
    $("#laundry_bill_check_in_no").attr("disabled", false);
    $("#laundry_bill_pay_mode").attr("disabled", false);
    $("#laundry_bill_paid_btn").attr("disabled", false);
    $("#laundry_item_add_btn").attr("disabled", false);
    $("#laundry_bill_item_select").attr("disabled", false);
    $("#laundry_paid_checkbox").attr("disabled", false);
    $("#laundry_paid_checkbox").attr("checked", false);
    $('#laundry_bill_check_in_no').selectpicker('refresh');
    $('#laundry_bill_add_item').trigger("reset");
    $('#laundry_bil_item_list').trigger("reset");
    $("#laundry_bill_check_in_no").val('').selectpicker('refresh');
    $("#laundry_bill_item_select").val('').selectpicker('refresh');
    $("#laundry_bill_pay_mode").val('').selectpicker('refresh');
}

function quantity_calcultaion() {
    var total;
    var laundry_bill_item_rate = $("#laundry_bill_item_rate").val();
    var laundry_bill_item_quantity = $("#laundry_bill_item_quantity").val();
    total = (Number(laundry_bill_item_quantity) * Number(laundry_bill_item_rate));
    $("#laundry_bill_total").val(total);
}

function getRate() {
    var item_id = $("#laundry_bill_item_select").val();
    if (item_id != '' && item_id != 0) {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: li + 'lvlp/getRate',
            data: {
                item_id: item_id,
            },
            success: function (data) {

                $.each(data, function (key, val) {
                    $("#laundry_bill_item_rate").val(val.rate);
                    quantity_calcultaion();
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                window.location.reload();
                if (jqXHR.status === 0) {
                    alert('Not connect.\n Verify Network.');
                } else if (jqXHR.status == 404) {
                    alert('Requested page not found. [404] - Click \'OK\'');
                } else if (jqXHR.status == 500) {
                    alert('Internal Server Error. [500] - Click \'OK\'');
                } else if (errorThrown === 'parsererror') {
                    alert('Requested JSON parse failed - Click \'OK\'');
                } else if (errorThrown === 'timeout') {
                    alert('Time out error - Click \'OK\' and try to re-submit your responses');
                } else if (errorThrown === 'abort') {
                    alert('Ajax request aborted ');
                } else {
                    alert('Uncaught Error.\n' + jqXHR.responseText + ' - Click \'OK\' and try to re-submit your responses');
                }
            }
        });
    }
    else {
        $("#laundry_bill_item_rate").val('');
        $("#laundry_bill_item_quantity").val(1);
        $("#laundry_bill_total").val('');
    }
}

function addNewLaundryBill() {
    var laundry_voucher_no = $("#laundry_voucher_no").val();
    var laundry_bill_check_in_no = $("#laundry_bill_check_in_no").val();
    var laundry_bill_item_select = $("#laundry_bill_item_select").val();
    var laundry_bill_item_rate = $("#laundry_bill_item_rate").val();
    var laundry_bill_item_quantity = $("#laundry_bill_item_quantity").val();
    var laundry_bill_total = $("#laundry_bill_total").val();

    if (laundry_voucher_no != '' && laundry_voucher_no != 0
        && laundry_bill_check_in_no != '' && laundry_bill_check_in_no != 0
        && laundry_bill_item_select != '' && laundry_bill_item_select != 0 ) {

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: li + 'lvlp/addNewLaundryBill',
            data: {
                laundry_voucher_no: laundry_voucher_no,
                laundry_bill_check_in_no: laundry_bill_check_in_no,
                laundry_bill_item_select: laundry_bill_item_select,
                laundry_bill_item_rate: laundry_bill_item_rate,
                laundry_bill_item_quantity: laundry_bill_item_quantity,
                laundry_bill_total: laundry_bill_total,
            },
            success: function (data) {
                if (data.id == 2) {
                    //alert('new inserted into two table');
                    $("#laundry_bill_check_in_no").attr("disabled", true);
                    $('#laundry_bill_check_in_no').selectpicker('refresh');
                    $("#laundry_bill_pay_mode").val('').selectpicker('refresh');
                    $('#laundry_bil_item_list').trigger("reset");
                    document.getElementById("message").innerHTML = "<h5 style=\"color: MediumSeaGreen;\" class=\"animated fadeOut delay-2s\">Added Successfully</h5>";
                    item_list(laundry_voucher_no);
                }
                else if (data.id == 1) {
                    //alert('inserted into bill details');
                    item_list(laundry_voucher_no);
                    $("#laundry_bill_pay_mode").val('').selectpicker('refresh');
                    $('#laundry_bil_item_list').trigger("reset");
                    document.getElementById("message").innerHTML = "<h5 style=\"color: MediumSeaGreen;\" class=\"animated fadeOut delay-2s\">Load To Item List</h5>";
                    search();
                }
                //	alert('not inserted');
                else
                    alert('please re inser.....');
                //window.location=li+"mains/employee_new";

            },
            error: function (jqXHR, textStatus, errorThrown) {
                if (jqXHR.status === 0) {
                    alert('Not connect.\n Verify Network.');
                } else if (jqXHR.status == 404) {
                    alert('Requested page not found. [404] - Click \'OK\'');
                } else if (jqXHR.status == 500) {
                    alert('Internal Server Error. [500] - Click \'OK\'');
                } else if (errorThrown === 'parsererror') {
                    alert('Requested JSON parse failed - Click \'OK\'');
                } else if (errorThrown === 'timeout') {
                    alert('Time out error - Click \'OK\' and try to re-submit your responses');
                } else if (errorThrown === 'abort') {
                    alert('Ajax request aborted ');
                } else {
                    alert('Uncaught Error.\n' + jqXHR.responseText + ' - Click \'OK\' and try to re-submit your responses');
                }
            }
        });
    }
    else {
        if (laundry_bill_check_in_no == '' && laundry_bill_check_in_no == 0) {
            document.getElementById("message").innerHTML = "<h5 style=\"color: red;\" class=\"animated fadeOut delay-2s\">Please Select Check In No</h5>";
        }else if(laundry_bill_item_select == '' && laundry_bill_item_select == 0){
            document.getElementById("message").innerHTML = "<h5 style=\"color: red;\" class=\"animated fadeOut delay-2s\">Please Select Item</h5>";
        }
        else{
            document.getElementById("message").innerHTML = "<h5 style=\"color: red;\" class=\"animated fadeOut delay-2s\">Information Incomplete</h5>";
        }
    }
}

function item_list(laundry_voucher_no,show_delete_btn = 1) {
    if (laundry_voucher_no) {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: li + 'lvlp/getAllItem',
            data: {laundry_voucher_no: laundry_voucher_no},
            success: function (data) {
                var i = 1;
                var gt = data.gt;
                var stuff = "";
                $.each(data.info, function (key, val) {
                    //alert(val.voucher_no);
                    stuff = stuff + "<tr class='text-center'>"
                        + "<td>" + val.item_no + "</td>"
                        + "<td>" + val.rate + "</td>"
                        + "<td>" + val.quantity + "</td>"
                        + "<td>" + val.total + "</td>"
                        if(show_delete_btn==1){
                            stuff = stuff + "<td><button onclick = delete_laundry_item('"+val.id+"','"+val.voucher_no+"')><i class='fa fa-trash fa-2x' style='color: red'></i></button></td>";
                        }else{
                            stuff = stuff + "<td> </td>";
                        }
                    stuff = stuff + "</tr>";
                });
                stuff = stuff + "<tr class='text-center'>"
                            + "<td colspan='3'>Grand Total</td>"
                            + "<td id='gt'></td>"
                            + "</tr>";

                if (i == 0){stuff = "";}

                document.getElementById("item_list").innerHTML = stuff;
                document.getElementById("gt").innerHTML = gt;
                $('#laundry_paid_checkbox').change(function () {
                    if (this.checked) {
                        $("#laundry_bill_paid_amount").val(gt);
                    }
                    else {
                        $("#laundry_bill_paid_amount").val('');
                    }
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                if (jqXHR.status === 0) {
                    alert('Not connect.\n Verify Network.');
                } else if (jqXHR.status == 404) {
                    alert('Requested page not found. [404] - Click \'OK\'');
                } else if (jqXHR.status == 500) {
                    alert('Internal Server Error. [500] - Click \'OK\'');
                } else if (errorThrown === 'parsererror') {
                    alert('Requested JSON parse failed - Click \'OK\'');
                } else if (errorThrown === 'timeout') {
                    alert('Time out error - Click \'OK\' and try to re-submit your responses');
                } else if (errorThrown === 'abort') {
                    alert('Ajax request aborted ');
                } else {
                    alert('Uncaught Error.\n' + jqXHR.responseText + ' - Click \'OK\' and try to re-submit your responses');
                }
            }
        });
    }
}

function laundry_bill_status_update() {
    var laundry_voucher_no = $("#laundry_voucher_no").val();
    var voucher_name = 'laun';

    if ($('input[name="laundry_paid_checkbox"]').is(':checked')) {
        var grand_total = $("#laundry_bill_paid_amount").val();
        var pay_mode = $("#laundry_bill_pay_mode").val();
        if (grand_total && pay_mode != '' && pay_mode != 0 && pay_mode != null) {
            var is_paid = 1;
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: li + 'lvlp/laundry_bill_status_update',
                data: {
                    laundry_voucher_no: laundry_voucher_no,
                    grand_total: grand_total,
                    pay_mode: pay_mode,
                    is_paid: is_paid,
                },
                success: function (data) {
                    if (data.id == 2) {
                        voucher_update(voucher_name);
                        //alert("updated");
                        //window.location.reload();
                        $("#laundry_bill_check_in_no").attr("disabled", false);
                        $('#laundry_bill_check_in_no').selectpicker('refresh');
                        $('#laundry_bill_add_item').trigger("reset");
                        $('#laundry_bil_item_list').trigger("reset");
                        $("#laundry_bill_check_in_no").val('').selectpicker('refresh');
                        $("#laundry_bill_item_select").val('').selectpicker('refresh');
                        $("#laundry_bill_pay_mode").val('').selectpicker('refresh');
                        document.getElementById("message1").innerHTML = "<h4 style=\"color: green;\" class=\"animated fadeOut delay-3s\">Paid</h4>";
                        search();
                    }
                    else if (data.id == 1) {
                        alert('not updated');
                    }
                    else
                        alert('please re inser.....');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status === 0) {
                        alert('Not connect.\n Verify Network.');
                    } else if (jqXHR.status == 404) {
                        alert('Requested page not found. [404] - Click \'OK\'');
                    } else if (jqXHR.status == 500) {
                        alert('Internal Server Error. [500] - Click \'OK\'');
                    } else if (errorThrown === 'parsererror') {
                        alert('Requested JSON parse failed - Click \'OK\'');
                    } else if (errorThrown === 'timeout') {
                        alert('Time out error - Click \'OK\' and try to re-submit your responses');
                    } else if (errorThrown === 'abort') {
                        alert('Ajax request aborted ');
                    } else {
                        alert('Uncaught Error.\n' + jqXHR.responseText + ' - Click \'OK\' and try to re-submit your responses');
                    }
                }
            });
        }
        else {
            if(pay_mode == '' && pay_mode == 0 && pay_mode == null){
                document.getElementById("message1").innerHTML = "<h5 style=\"color: red;\" class=\"animated fadeOut delay-2s\">Please Select Pay Mode</h5>";

            } else {
                document.getElementById("message1").innerHTML = "<h5 style=\"color: red;\" class=\"animated fadeOut delay-2s\">Grand Total is 0/Please Select Pay Mode</h5>";
            }
        }

    } else {
        document.getElementById("message1").innerHTML = "<h5 style=\"color: red;\" class=\"animated fadeOut delay-2s\">Please Check Paid Box</h5>";
    }

}

function voucher_update(voucher_name) {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: li + 'lvlp/getVoucherNo',
        data: {voucher_name: voucher_name},
        success: function (data) {
            $("#laundry_voucher_no").val(data.voucher_no);
            item_list(data.voucher_no);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            if (jqXHR.status === 0) {
                alert('Not connect.\n Verify Network.');
            } else if (jqXHR.status == 404) {
                alert('Requested page not found. [404] - Click \'OK\'');
            } else if (jqXHR.status == 500) {
                alert('Internal Server Error. [500] - Click \'OK\'');
            } else if (errorThrown === 'parsererror') {
                alert('Requested JSON parse failed - Click \'OK\'');
            } else if (errorThrown === 'timeout') {
                alert('Time out error - Click \'OK\' and try to re-submit your responses');
            } else if (errorThrown === 'abort') {
                alert('Ajax request aborted ');
            } else {
                alert('Uncaught Error.\n' + jqXHR.responseText + ' - Click \'OK\' and try to re-submit your responses');
            }
        }
    });
}

function search(){
    $('#laundry_bill_list').show();
    const element =  document.querySelector('#laundry_bill_list')
    element.classList.add('animated', 'fadeInUp')

    var voucher_no = $("#laundry_bill_search_voucher_no").val();
    // var item_no = $("#laundr_bill_search_item").val();
    var check_in_no = $("#laundry_bill_search_check_in_no").val();
    var is_paid = $("#laundry_bill_search_is_paid").val();
    var from_date = $("#laundry_bill_search_from_date").val();
    var to_date = $("#laundry_bill_search_to_date").val();

    //alert(is_paid);

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: li + 'lvlp/getAllLaundryBill/',
        data: {
            voucher_no: voucher_no,
            // item_no: item_no,
            check_in_no: check_in_no,
            is_paid: is_paid,
            from_date: from_date,
            to_date: to_date,
        },
        success: function (data) {
            viewLaundryBillList(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            //alert("Server Error");
            if (jqXHR.status === 0) {
                alert('Not connect.\n Verify Network.');
            } else if (jqXHR.status == 404) {
                alert('Requested page not found.');
            } else if (jqXHR.status == 500) {
                alert('Internal Server Error.');
            } else if (errorThrown === 'parsererror') {
                alert('Requested JSON parse failed');
            } else if (errorThrown === 'timeout') {
                alert('Time out error');
            } else if (errorThrown === 'abort') {
                alert('Ajax request aborted ');
            } else {
                alert('Uncaught Error.\n' + jqXHR.responseText);
            }
        }
    });
}

function reset_laundry_search() {
    $("#laundry_bill_search_check_in_no").val('').selectpicker('refresh');
    $("#laundr_bill_search_item").val('').selectpicker('refresh');
    $("#laundr_bill_search_voucher_no").val('').selectpicker('refresh');
    $('#laundry_bill_list').hide();
}

function viewLaundryBillList(data) {
    var stuff = "";
    var sl = 1;
    $.each(data.list, function (key, val) {
        stuff = stuff + "<tr class='" + val.id + "tr'>"
            + "<td>" + (sl++) + "</td>"
            + "<td>" + val.voucher_no + "</td>"
            + "<td>" + val.check_in_no + "</td>"
            + "<td style='background-color: "+val.style+"' >" + val.is_paid + "</td>"
            + "<td>" + val.grand_total + "</td>"
            + "<td>" + val.pay_mode + "</td>"
            + "<td>" + val.date + "</td>"
            + "<td>"
            +"<a onclick = edit_laundry_bill('"+val.voucher_no+"') class='btn btn-sm btn-info' data-toggle='modal' data-target='#newBillModal' id='edit_laundry_bill'>Edit</a>"
            +"<a onclick = details_laundry_bill('"+val.voucher_no+"') class='btn btn-sm btn-info' data-toggle='modal' data-target='#newBillModal' id='details_laundry_bill'>Details</a>"
            + "</td>"
            + "</tr>";
    });
    $("#laundry_bill_list_table_data").html(stuff);
}

function edit_laundry_bill(voucher_no) {
    //alert(voucher_no);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: li + 'lvlp/getBillInfo',
        data: {voucher_no: voucher_no},
        success: function (data) {
            $.each(data, function (key, val) {
                //alert(val.is_paid);
                $("#laundry_voucher_no").val(val.voucher_no);
                $('#laundry_bill_check_in_no').selectpicker('val', val.check_in_no);
                $("#laundry_bill_check_in_no").attr("disabled", false);
                $('#laundry_bill_pay_mode').selectpicker('val', val.pay_mode);
                $("#laundry_bill_pay_mode").attr("disabled", false);
                $("#laundry_bill_paid_btn").attr("disabled", false);
                $("#laundry_item_add_btn").attr("disabled", false);
                $("#laundry_bill_item_select").attr("disabled", false);
                $("#laundry_paid_checkbox").attr("disabled", false);
                $("#laundry_paid_checkbox").attr("checked", false);
                if(val.is_paid==1){
                    $("#laundry_paid_checkbox").attr("checked", true);
                    $("#laundry_bill_paid_amount").val(val.grand_total);
                }
                item_list(val.voucher_no);

            });
            // $("#laundry_voucher_no").val(voucher_no);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            if (jqXHR.status === 0) {
                alert('Not connect.\n Verify Network.');
            } else if (jqXHR.status == 404) {
                alert('Requested page not found. [404] - Click \'OK\'');
            } else if (jqXHR.status == 500) {
                alert('Internal Server Error. [500] - Click \'OK\'');
            } else if (errorThrown === 'parsererror') {
                alert('Requested JSON parse failed - Click \'OK\'');
            } else if (errorThrown === 'timeout') {
                alert('Time out error - Click \'OK\' and try to re-submit your responses');
            } else if (errorThrown === 'abort') {
                alert('Ajax request aborted ');
            } else {
                alert('Uncaught Error.\n' + jqXHR.responseText + ' - Click \'OK\' and try to re-submit your responses');
            }
        }
    });
}

function details_laundry_bill(voucher_no) {
    //$('[id="delete_laundry_item"]').prop('onclick',null).off('click');
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: li + 'lvlp/getBillInfo',
        data: {voucher_no: voucher_no},
        success: function (data) {
            $.each(data, function (key, val) {
                //alert(val.is_paid);
                $("#laundry_voucher_no").val(val.voucher_no);
                $('#laundry_bill_check_in_no').selectpicker('val', val.check_in_no);
                $("#laundry_bill_check_in_no").attr("disabled", true);
                $('#laundry_bill_pay_mode').selectpicker('val', val.pay_mode);
                $("#laundry_bill_pay_mode").attr("disabled", true);
                $("#laundry_bill_paid_btn").attr("disabled", true);
                $("#laundry_item_add_btn").attr("disabled", true);
                $("#laundry_bill_item_select").attr("disabled", true);
                $("#laundry_paid_checkbox").attr("disabled", true);
                $("#laundry_paid_checkbox").attr("checked", false);
                item_list(val.voucher_no,0);
                if(val.is_paid==1){
                    $("#laundry_paid_checkbox").attr("checked", true);
                    $("#laundry_bill_paid_amount").val(val.grand_total);
                }

                if(id == 1){

                }
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            if (jqXHR.status === 0) {
                alert('Not connect.\n Verify Network.');
            } else if (jqXHR.status == 404) {
                alert('Requested page not found. [404] - Click \'OK\'');
            } else if (jqXHR.status == 500) {
                alert('Internal Server Error. [500] - Click \'OK\'');
            } else if (errorThrown === 'parsererror') {
                alert('Requested JSON parse failed - Click \'OK\'');
            } else if (errorThrown === 'timeout') {
                alert('Time out error - Click \'OK\' and try to re-submit your responses');
            } else if (errorThrown === 'abort') {
                alert('Ajax request aborted ');
            } else {
                alert('Uncaught Error.\n' + jqXHR.responseText + ' - Click \'OK\' and try to re-submit your responses');
            }
        }
    });
}

function delete_laundry_item(id,voucher_no) {

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: li + 'lvlp/delete_laundry_item',
        data: {
            id: id,
            voucher_no:voucher_no,
        },
        success: function (data) {
            if (data.id == 2) {
                item_list(voucher_no);
                $("#laundry_bill_pay_mode").val('').selectpicker('refresh');
                $('#laundry_bil_item_list').trigger("reset");
                search();
                document.getElementById("message1").innerHTML = "<h5 style=\"color: Tomato;\" class=\"animated fadeOut delay-2s\">Deleted Successfully</h5>";
            }
            else if (data.id == 1) {
                document.getElementById("message1").innerHTML = "<h5 style=\"color: Tomato;\" class=\"animated fadeOut delay-2s\">Deleted Failed</h5>";
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            if (jqXHR.status === 0) {
                alert('Not connect.\n Verify Network.');
            } else if (jqXHR.status == 404) {
                alert('Requested page not found. [404] - Click \'OK\'');
            } else if (jqXHR.status == 500) {
                alert('Internal Server Error. [500] - Click \'OK\'');
            } else if (errorThrown === 'parsererror') {
                alert('Requested JSON parse failed - Click \'OK\'');
            } else if (errorThrown === 'timeout') {
                alert('Time out error - Click \'OK\' and try to re-submit your responses');
            } else if (errorThrown === 'abort') {
                alert('Ajax request aborted ');
            } else {
                alert('Uncaught Error.\n' + jqXHR.responseText + ' - Click \'OK\' and try to re-submit your responses');
            }
        }
    });
}
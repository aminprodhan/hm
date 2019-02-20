
var li=links();






function saveResvPayInfo(v){

    var resv_id=$("#resv_code").val();
    var pay_mode=$("#pay_mode").val();
    var pay_date=$("#pay_date").val();
    var pay_amount=$("#pay_amount").val();
    var pay_tax=$("#pay_tax").val();
    var pay_remarks=$("#pay_remarks").val();
    var isCheckIn=0;
    var resvInfo=[];
    resvInfo[0]=[resv_id,pay_mode,pay_date,pay_amount,pay_tax,pay_remarks];  

    var reservationInfo=JSON.stringify(getReservationInfo());
    var setBankPayment=JSON.stringify(getBankPayInfo());
    var payInvoice=JSON.stringify(resvInfo);

    if(resv_id == '' || resv_id == '0')
        alert("Reservation Code Not Found......Please Ensure you reserved any room......");
    else{

        var c=confirm("Are you sure ?");
        if(c == true){

            $(v).text("Loading....");
            $(v).attr("disabled",true);

            $.ajax({
                type:'POST',
                dataType:'json',
                url: li+"reservation_controller/saveResvPayInfo/",
                cache: false,
                data:{
                    reservationInfo:reservationInfo,
                    setBankPayment:setBankPayment,
                    payInvoice:payInvoice,
                    isCheckIn:isCheckIn,                
                },
                success:function(data)
                {
                    alert(data.msg);
                    
                    if(data.status == '0')
                        window.location.reload();
                   
                    $(v).text("Submit");
                    $(v).attr("disabled",false);

                },
                error:function(jqXHR, textStatus, errorThrown)
                    {  
                        $(v).text("Submit");
                        $(v).attr("disabled",false);                  
                        showAjaxError(jqXHR, textStatus, errorThrown);
                    }
                });
        }

    }

    //alert(reservationInfo+" - "+setBankPayment+" - "+setBkashPayment);

}



function saveCheckInformation(v){

    var isCheckIn=1;


    var resv_id=$("#resv_code").val();

    var pay_mode=$("#check_in_pay_mode").val();
    var pay_date=$("#check_in_pay_date").val();
    var pay_amount=$("#check_in_pay_amount").val();
    var pay_tax=$("#check_in_pay_tax").val();
    var pay_remarks=$("#check_in_pay_remarks").val();

    var resvInfo=[];
    resvInfo[0]=[resv_id,pay_mode,pay_date,pay_amount,pay_tax,pay_remarks];  

    var reservationInfo=JSON.stringify(getReservationInfo());
    var setBankPayment=JSON.stringify(getCheckInBankPayInfo());
    var payInvoice=JSON.stringify(resvInfo);

    if(resv_id == '' || resv_id == '0')
        alert("Reservation Code Not Found......Please Ensure you reserved any room......");
    else{

        var c=confirm("Are you sure ?");
        if(c == true){

            $(v).text("Loading....");
            $(v).attr("disabled",true);

            $.ajax({
                type:'POST',
                dataType:'json',
                url: li+"reservation_controller/saveResvPayInfo/",
                cache: false,
                data:{
                    reservationInfo:reservationInfo,
                    setBankPayment:setBankPayment,
                    payInvoice:payInvoice, 
                    isCheckIn:isCheckIn,                  
                },
                success:function(data)
                {
                    alert(data.msg);
                    
                    if(data.status == '0')
                        window.location.reload();
                   
                    $(v).text("Submit");
                    $(v).attr("disabled",false);

                },
                error:function(jqXHR, textStatus, errorThrown)
                    {  
                        $(v).text("Submit");
                        $(v).attr("disabled",false);                  
                        showAjaxError(jqXHR, textStatus, errorThrown);
                    }
                });
        }

    }

    //alert(reservationInfo+" - "+setBankPayment+" - "+setBkashPayment);

}

function getCheckInBankPayInfo(){


    var resv_bank_name=$("#check_in_resv_bank_name").val();
    var resv_bank_acc_no=$("#check_in_resv_bank_acc_no").val();
    var resv_bank_branch_name=$("#check_in_resv_bank_branch_name").val();
    var resv_bank_chq_number=$("#check_in_resv_bank_chq_number").val();
    var resv_bank_chq_date=$("#check_in_resv_bank_chq_date").val();
    var bank_info=[];
    bank_info[0]=[resv_bank_name,resv_bank_acc_no,resv_bank_branch_name,resv_bank_chq_number,resv_bank_chq_date];
    return bank_info;

}

function getBankPayInfo(){


    var resv_bank_name=$("#resv_bank_name").val();
    var resv_bank_acc_no=$("#resv_bank_acc_no").val();
    var resv_bank_branch_name=$("#resv_bank_branch_name").val();
    var resv_bank_chq_number=$("#resv_bank_chq_number").val();
    var resv_bank_chq_date=$("#resv_bank_chq_date").val();
    var bank_info=[];
    bank_info[0]=[resv_bank_name,resv_bank_acc_no,resv_bank_branch_name,resv_bank_chq_number,resv_bank_chq_date];
    return bank_info;

}

function getBkashPayInfo(){


    var resv_bkash_number=$("#resv_bkash_number").val();
    var resv_bkash_number_from=$("#resv_bkash_number_from").val();
    var resv_bkash_trans_id=$("#resv_bkash_trans_id").val();
    var bkash_info=[];
    bkash_info[0]=[resv_bkash_number,resv_bkash_number_from,resv_bkash_trans_id];

    return bkash_info;

}
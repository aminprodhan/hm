
var li=links();



    function getAllotmentBasicInfo(){

        var allotment_code=$("#allotment_code").val();
        var agent_list=$("#agent_list").val();
        var date=$("#date").val();
        var remarks=$("#remarks").val();
        var allotment_start_date=$("#allotment_start_date").val();
        var allotment_end_date=$("#allotment_end_date").val();

        var basic_info=[];
        basic_info[0]=[allotment_code,agent_list,date,remarks,allotment_start_date,allotment_end_date];

        return basic_info;

    }


    function saveAllotmentPayInfo(v){

                var resv_id=$("#allotment_code").val();


                var pay_mode=$("#pay_mode").val();
                var pay_date=$("#pay_date").val();
                var pay_amount=$("#pay_amount").val();
                var pay_tax=$("#pay_tax").val();
                var pay_remarks=$("#pay_remarks").val();

                var resvInfo=[];
                resvInfo[0]=[resv_id,pay_mode,pay_date,pay_amount,pay_tax,pay_remarks];  

                var allotmentInfo=JSON.stringify(getAllotmentBasicInfo());
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
                    url: li+"allotment_controller/saveAllotmentPayInfo/",
                    cache: false,
                    data:{
                        allotmentInfo:allotmentInfo,
                        setBankPayment:setBankPayment,
                        payInvoice:payInvoice,                
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


    }

        function getBankPayInfo()
        {


            var resv_bank_name=$("#resv_bank_name").val();
            var resv_bank_acc_no=$("#resv_bank_acc_no").val();
            var resv_bank_branch_name=$("#resv_bank_branch_name").val();
            var resv_bank_chq_number=$("#resv_bank_chq_number").val();
            var resv_bank_chq_date=$("#resv_bank_chq_date").val();
            var bank_info=[];
            bank_info[0]=[resv_bank_name,resv_bank_acc_no,resv_bank_branch_name,resv_bank_chq_number,resv_bank_chq_date];
            return bank_info;

        }

        function getBkashPayInfo()
        {


            var resv_bkash_number=$("#resv_bkash_number").val();
            var resv_bkash_number_from=$("#resv_bkash_number_from").val();
            var resv_bkash_trans_id=$("#resv_bkash_trans_id").val();
            var bkash_info=[];
            bkash_info[0]=[resv_bkash_number,resv_bkash_number_from,resv_bkash_trans_id];

            return bkash_info;

        }



function searchRoomForAllotment(v){

    $(v).attr("disabled",true);

    $("#modalDivAllotment").modal("show");

    var agent_list=$("#agent_list").val();
    var allotment_start_date=$("#allotment_start_date").val();
    var allotment_end_date=$("#allotment_end_date").val();

        $.ajax({
                type:'POST',
                dataType:'json',
                url: li+"allotment_controller/getAvailabilAllotmentRoomList/",
                cache: false,
                data:{
                    agent_list:agent_list,
                    allotment_start_date:allotment_start_date,
                    allotment_end_date:allotment_end_date,                
                },
                success:function(data)
                {
                    
                   
                    $(v).text("Submit");
                    $(v).attr("disabled",false);

                    viewAllotmentRoomList(data);

                },
                error:function(jqXHR, textStatus, errorThrown)
                    {  
                        $(v).text("Submit");
                        $(v).attr("disabled",false);                  
                        showAjaxError(jqXHR, textStatus, errorThrown);
                    }
                });



                

}

function viewAllotmentRoomList(data){

        var list="";
        var sl=1;
        $.each(data.list,function(key,val){
            list=list+"<tr>"              
                    +"<td>"+(sl++)+"</td>"
                    +"<td>"+val.hotel_name+"</td>"
                    +"<td>"+val.room_no+"</td>"
                    +"<td>"+val.type_name+"</td>"
                    +"<td>"+val.floor_no+"</td>"
                    +"<td>"+val.rent+"</td>"
                    +"<td><input class='"+val.rid+"-tr' type='checkbox' /></td>"
                    +"</tr>"

        });

        var btn="<button onclick='saveAllotmentRoom(this)' class='btn btn-warning'>Submit</button>";

        list=list+"<tr>"
        + "<td colspan='9' style='text-align:right'>"+btn+"</td>"  
        +"</tr>";


        $("#tbody_allotment_available_roomList").html(list);

}


    function setBookedAllotmentRoom(data){


        $("#allotment_code").val(data.allot_id);

            var list="";
            var sl=1;
            $.each(data.list,function(key,val){
                list=list+"<tr>"              
                        +"<td>"+(sl++)+"</td>"
                        +"<td>"+val.agent_name+"</td>"
                        +"<td>"+val.from_date+"</td>"
                        +"<td>"+val.to_date+"</td>"
                        +"<td>"+val.room_no+"</td>"
                        +"<td>"+val.floor_no+"</td>"
                        +"<td>"+val.rent+"</td>"
                        +"<td><input class='"+val.rid+"-tr' type='checkbox' /></td>"
                        +"</tr>"

            });

            var btn="<button onclick='removeAllotmentRoom(this)' class='btn btn-warning'>Submit</button>";

            list=list+"<tr>"
            + "<td colspan='9' style='text-align:right'>"+btn+"</td>"  
            +"</tr>";


            $("#booked_allotment_room_list").html(list);

    }

    function removeAllotmentRoom(v){

        var i=0;
        var list=[];

        $("#booked_allotment_room_list tr input").each(function()
         {          
                if($(this).is(":checked")){

                    var atr_class=$(this).attr("class");
                    var cid=atr_class.split("-");
                    list[i++]=[cid[0]];
                }

        });

        if(i > 0){

            var combineRoomList=JSON.stringify(list);
            var allotment_code=$("#allotment_code").val();

            $(v).text("Loading....");
            $(v).attr("disabled",false);


            $.ajax({
                type:'POST',
                dataType:'json',
                url: li+"allotment_controller/removeAllotmentRoom/",
                cache: false,
                data:{

                    combineRoomList:combineRoomList,
                    allotment_code:allotment_code,
                      
                },
                success:function(data)
                {
                    
                   
                    $(v).text("Submit");
                    $(v).attr("disabled",false);
    
                    setBookedAllotmentRoom(data);
    
                },
                error:function(jqXHR, textStatus, errorThrown)
                    {  
                        $(v).text("Submit");
                        $(v).attr("disabled",false);                  
                        showAjaxError(jqXHR, textStatus, errorThrown);
                    }
                });


        }
        else{

            alert("Data not found.....");

        }



    }


function saveAllotmentRoom(v){

    var i=0;
    var list=[];
    $("#tbody_allotment_available_roomList input").each(function(key,val){
        if($(this).is(":checked")){
            var atr_class=$(this).attr("class");
            var cid=atr_class.split("-");
            list[i++]=[cid[0]];
        }
         

    });

    var allotment_code=$("#allotment_code").val();
    var agent_list=$("#agent_list").val();
    var date=$("#date").val();
    var remarks=$("#remarks").val();
    var allotment_start_date=$("#allotment_start_date").val();
    var allotment_end_date=$("#allotment_end_date").val();

    if(i > 0){

         
        var combineRoomList=JSON.stringify(list);


        $.ajax({
            type:'POST',
            dataType:'json',
            url: li+"allotment_controller/saveAllotmentRoom/",
            cache: false,
            data:{
                agent_list:agent_list,
                allotment_code:allotment_code,
                date:date,
                remarks:remarks,
                allotment_start_date:allotment_start_date,
                allotment_end_date:allotment_end_date,
                combineRoomList:combineRoomList,                
            },
            success:function(data)
            {
                
               
                $(v).text("Submit");
                $(v).attr("disabled",false);

                setBookedAllotmentRoom(data);

            },
            error:function(jqXHR, textStatus, errorThrown)
                {  
                    $(v).text("Submit");
                    $(v).attr("disabled",false);                  
                    showAjaxError(jqXHR, textStatus, errorThrown);
                }
            });

    }
    else
        alert("Data not found.....");




}
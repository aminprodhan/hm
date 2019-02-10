

var li=links();

function viewAvailabilRoom(data,para){


    var list="";
    var sl=1;

   // console.log(data.list);
   // alert(data.list);
    $.each(data.list,function(key,val){
        //alert(val.hotel_name);
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

    var btn="<button onclick='addRoomToSession(this)' class='btn btn-primary'>Submit</button>";

    if(para == '' || typeof para == "undefined")
    {
        list=list+"<tr>"
                + "<td colspan='7' style='text-align:center'>"+btn+"</td>"  
                +"</tr>";

        $("#tbody_availableRoomList").html(list);
    }
    else{

        $("#"+para).html(list);

    }

}

function viewReservationRoomList(data,para){


    $("#resv_code").val(data.resv_id);

    var list="";
    var sl=1;
    $.each(data.list,function(key,val){
        list=list+"<tr>"              
                +"<td>"+(sl++)+"</td>"
                +"<td>"+val.hotel_name+"</td>"
                +"<td>"+val.start_date+"</td>"
                +"<td>"+val.end_date+"</td>"
                +"<td>"+val.room_no+"</td>"
                +"<td>"+val.type_name+"</td>"
                +"<td>"+val.floor_no+"</td>"
                +"<td>"+val.rent+"</td>"
                +"<td><input class='"+val.rrid+"-tr' type='checkbox' /></td>"
                +"</tr>"

    });

    var btn="<button onclick='removeReservationRoom(this)' class='btn btn-warning'>Submit</button>";

    list=list+"<tr>"
    + "<td colspan='9' style='text-align:right'>"+btn+"</td>"  
    +"</tr>";


    $("#"+para).html(list);

}

function removeReservationRoom(v){



    var list=[];
    var i=0;
    $("#booked_room_list tr input").each(function(){
        var id=$(this).attr("class");
        if($(this).is(":checked"))
            {

            
                var split_id=id.split(",");
                var sp=split_id[0].split("-");
                list[i++]=[sp[0]];
               
           }

    });

    var room_data=JSON.stringify(list);
    var resv_code=$("#resv_code").val();
    if(i > 0){
        
        //alert(room_data+" - "+resv_code);

        $(v).text("Loading....");
        $(v).attr("disabled",true);
        var c=confirm("Are you sure to remove ?");
        if( c == true){

            $.ajax({
                type:'POST',
                dataType:'json',
                url: li+"room_controller/removeReservationRoom/",
                cache: false,
                data:{
                    resv_code:resv_code,
                    room_data:room_data,
                },
                success:function(data)
                {
                    $(v).text("Removed");
                    $(v).attr("disabled",false);

                    viewReservationRoomList(data,"booked_room_list");
    
                },
                error:function(jqXHR, textStatus, errorThrown)
                    { 

                        showAjaxError(jqXHR, textStatus, errorThrown);
                    }
                });

        }

    }
    else{

        alert("Please select at least one room.....");

    }


}

function getReservationInfo(){

    //----------------------------------

    var hid=$("#hid").val();
    var resv_date=$("#resv_date").val();
    var agent_list=$("#agent_list").val();
    var number_of_adult=$("#number_of_adult").val();
    var number_of_children=$("#number_of_children").val();
    var room_type=1;
    var resv_type=1;
    var season=1;

    //------------------------------

    var guest_name=$("#guest_name").val();
    var guest_email=$("#guest_email").val();
    var guest_mobile_no=$("#guest_mobile_no").val();
    var guest_address=$("#guest_address").val();
    var guest_country=$("#guest_country").val();
    var guest_identity_info=$("#guest_identity_info").val();
    var guest_room_type=$("#guest_room_type").val();
   
    if(guest_country === null)
        guest_country=0;

    if(guest_room_type === null)
        guest_room_type=0;

    //------------------------------------------

    var resv_array=[];
    resv_array[0]=[hid,resv_date,agent_list,
        number_of_adult,number_of_children,season,
        room_type,resv_type,
        guest_name,guest_email,guest_mobile_no,
        guest_address,guest_country,
        guest_identity_info,guest_room_type];


    return resv_array;

}



function addRoomToSession(){

    var list=[];
    var i=0;

    $("#tbody_availableRoomList tr input").each(function(){
        var id=$(this).attr("class");
        if($(this).is(":checked"))
            {

            
                var split_id=id.split(",");
                var sp=split_id[0].split("-");
                list[i++]=[sp[0]];
               
           }

    });

    var room_data=JSON.stringify(list);
    var room_start_date=$("#room_start_date").val();
    var room_end_date=$("#room_end_date").val();
    var reservationInfo=JSON.stringify(getReservationInfo());
    var resv_code= $("#resv_code").val();
    
    //alert(reservationInfo);
    //alert(room_data);

    if(i > 0){

    var c=confirm("Are you sure ?");

    if(c == true){

        $.ajax({
            type:'POST',
            dataType:'json',
            url: li+"room_controller/setRoomForReservation/",
            cache: false,
            data:{
                resv_code:resv_code,
                room_data:room_data,
                room_start_date:room_start_date,
                room_end_date:room_end_date,
                reservationInfo:reservationInfo,
            },
            success:function(data)
            {
                //$("#resv_code").val(data.resv_id);
                //viewAvailabilRoom(data,"booked_room_list");
                viewReservationRoomList(data,"booked_room_list");

            },
            error:function(jqXHR, textStatus, errorThrown)
                { 
                    //alert("error");
                   
                    showAjaxError(jqXHR, textStatus, errorThrown);
                }
            });

    }
   
    }
    else
        alert("Please select any room for reservation......");

}

function searchRoomForReservation(v){

    
    $(v).attr("disabled",true);
    $("#modalAvailableRoomList").modal("show");


    var room_start_date=$("#room_start_date").val();
    var room_end_date=$("#room_end_date").val();
    var searchRoomType=$("#searchRoomType").val();

    $.ajax({
        type:'POST',
        dataType:'json',
        url: li+"room_controller/searchRoomForReservation/",
        cache: false,
        data:{
            room_start_date:room_start_date,
            room_end_date:room_end_date,
            searchRoomType:searchRoomType,
        },
        success:function(data)
        {

            //alert("ok");

            $(v).attr("disabled",false);         
            viewAvailabilRoom(data);

        },
        error:function(jqXHR, textStatus, errorThrown)
            {  
                showAjaxError(jqXHR, textStatus, errorThrown);
                $("#"+v).attr("disabled",false);
                $(".txtSaveRoomLoading").text("Save"); 

               
            }
        });


}


var li=links();

function getAllotmentCodeList(v){

    var value=$("#"+v).val();

    //alert(value);


    /*$("#search_allot_id22").autocomplete({
        source: [ "c++", "java", "php", "coldfusion", "javascript", "asp", "ruby" ]
      });*/

    $("#"+v).addClass('ac_loading');

	$("#"+v).autocomplete({
        source: function( request, response ) 
        {

            $.ajax({		
                type:'POST',
                dataType:'json',
                url:li+'allotment_controller/getAllotmentCodeList/',
                data:{id:value},
                success:function(data)
                    {
                        //alert(data);
                        response(data);
                    },
                    error:function(jqXHR, textStatus, errorThrown)
                    {
                        
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

	            $("#"+v).removeClass('ac_loading');

            },
            select:function(event,ui){

                $("#resv_allot_id").val(ui.item.label);
                setTimeout(function(){

                    $("#"+v).val('');

                },100);
                

            }
            
            			
         });
         
         $("#"+v).autocomplete( "option", "appendTo", ".auto_com" );


}

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
                +"<td>"+val.bed_no+"</td>"
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

function guestModalPreview(v){

    $("#modalDivResvGuest").modal("show");

}

function removeGuestInfo(v){
    var i=0;
    var list=[];
    $("#guest_list tr .chq_list").each(function(){

       if($(this).is(":checked")){

            var data_id=$(this).attr("data-target");
            list[i++]=[data_id];
       }

    });

   if(isEmpty(i) == '0')
     alert("Data not found.....");
    else{

        var c=confirm("Are you sure to delete ?");
        if(c == true){
            
            $("#"+v).attr("disabled",true);

            var combine_ginfo=JSON.stringify(list);
            
            $.ajax({
                type:'POST',
                dataType:'json',
                url: li+"reservation_controller/removeGuestInfo/",
                cache: false,
                data:{
                    combine_ginfo:combine_ginfo,
                },
                success:function(data)
                {
                   window.location.reload();
    
                },
                error:function(jqXHR, textStatus, errorThrown)
                    { 
                        $("#"+v).attr("disabled",false);
                        showAjaxError(jqXHR, textStatus, errorThrown);
                    }
                });

        }

    }


}

function saveModalNewGuestInfo(v){


    var guest_info=getModalGuestInfo();

    
    if(isEmpty(guest_info[0][0]) == '0')
        alert("Reservation code is empty.....");
    else if(isEmpty(guest_info[0][1]) == '0')
        alert("Guest name is empty.....");
    else if(isEmpty(guest_info[0][3]) == '0')
        alert("Guest mobile no is empty.....");
    else{

        $("#"+v).attr("disabled",true);

        var combine_ginfo=JSON.stringify(guest_info);
        $.ajax({
            type:'POST',
            dataType:'json',
            url: li+"reservation_controller/saveModalNewGuestInfo/",
            cache: false,
            data:{
                combine_ginfo:combine_ginfo,
            },
            success:function(data)
            {
               window.location.reload();

            },
            error:function(jqXHR, textStatus, errorThrown)
                { 
                    $("#"+v).attr("disabled",false);
                    showAjaxError(jqXHR, textStatus, errorThrown);
                }
            });


    }

}

function getModalGuestInfo(){

    var modal_guest_name=$("#modal_guest_name").val();
    var modal_guest_email=$("#modal_guest_email").val();
    var modal_guest_mobile_no=$("#modal_guest_mobile_no").val();
    var modal_guest_address=$("#modal_guest_address").val();
    var modal_guest_country=$("#modal_guest_country").val();
    var modal_guest_identity_info=$("#modal_guest_identity_info").val();
    //var guest_room_type=$("#modal_guest_doc_info").val();
    var modal_guest_room_type=$("#modal_guest_room_type").val();
    var resv_code=$("#resv_code").val();

    
    var guest_info=[];
    guest_info[0]=[resv_code,modal_guest_name,modal_guest_email,
        modal_guest_mobile_no,modal_guest_address,
        modal_guest_country,modal_guest_identity_info,modal_guest_room_type];

        return guest_info;
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
                +"<td>"+val.bed_no+"</td>"
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
    var resv_type= $("#resv_type").val();
    var season=1;

    var resv_allot_id=$("#resv_allot_id").val();


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
        guest_identity_info,guest_room_type,resv_allot_id];


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

    var resv_allot_id=$("#resv_allot_id").val();
    var resv_type=$("#resv_type").val();

  //  alert(resv_type);

    $.ajax({
        type:'POST',
        dataType:'json',
        url: li+"room_controller/searchRoomForReservation/",
        cache: false,
        data:{
            resv_allot_id:resv_allot_id,
            room_start_date:room_start_date,
            room_end_date:room_end_date,
            searchRoomType:searchRoomType,
            resv_type:resv_type,
        },
        success:function(data)
        {

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
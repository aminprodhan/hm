
var li=links();


function init(){
    
    $(".btnSaveDisplay").show();
    $(".searchBtnUpdateDisplay").hide();
}

function btnForUpdate(){

    $(".btnSaveDisplay").hide();
    $(".searchBtnUpdateDisplay").show();

}
function refreshPage(){

    init();
}
function createNewFloor(){

    $("#modalCreateNewFloor").modal("show");
    init();
}

function removeFloorInfo(v){

        var id=$("#"+v).val();
        var txtFloorNo=$("#txtFloorNo").val();
        var comboHotelId=$("#comboHotelId").val();
        var status=0;
    
        $(".radio_group input").each(function()
            {
                if($(this).is(":checked"))
                    {
                        status=$(this).val();
                    }
    
            });
    
        if(txtFloorNo == '' || comboHotelId == '0' || comboHotelId == '')
            alert("Information Incomplete.....");
        else{
    
            var c=confirm("Are you sure to confirm ?");
            if(c == true){
    
                $(".txtRemove").text("Loading....");
                $("#"+v).attr("disabled",true);
    
                $.ajax({
                    type:'POST',
                    dataType:'json',
                    url: li+"ajaxController/setRemoveFloorInfo/",
                    cache: false,
                    data:{
                            update_id:id,
                            txtFloorNo:txtFloorNo,
                            comboHotelId:comboHotelId,
                            status:status,
                        },
                    success:function(data)
                    {
                        init();   
                        $(".txtRemove").text("Remove");
                        $("#"+v).attr("disabled",false); 
                        $("#div_alert").text(data.msg);  
                        divAlert("div_alert");  
                        clearFloorInfo();
                        viewFloorList(data);
    
                    },
                    error:function(jqXHR, textStatus, errorThrown)
                        {
                            $(".txtUpdate").text("Error Occured.....");
                            $("#"+v).attr("disabled",false);
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

}

function updateFloorInfo(v){


        var id=$("#"+v).val();
        var txtFloorNo=$("#txtFloorNo").val();
        var comboHotelId=$("#comboHotelId").val();
        var status=0;
    
        $(".radio_group input").each(function()
            {
                if($(this).is(":checked"))
                    {
                        status=$(this).val();
                    }
    
            });
    
        if(txtFloorNo == '' || comboHotelId == '0' || comboHotelId == '')
            alert("Information Incomplete.....");
        else{
    
            var c=confirm("Are you sure to confirm ?");
            if(c == true){
    
                $(".txtUpdate").text("Loading....");
                $("#"+v).attr("disabled",true);
    
                $.ajax({
                    type:'POST',
                    dataType:'json',
                    url: li+"ajaxController/updateFloorInfo/",
                    cache: false,
                    data:{
                            update_id:id,
                            txtFloorNo:txtFloorNo,
                            comboHotelId:comboHotelId,
                            status:status,
                        },
                    success:function(data)
                    {
                        init();   
                        $(".txtUpdate").text("Update");
                        $("#"+v).attr("disabled",false); 
                        $("#div_alert").text(data.msg);  
                        divAlert("div_alert");  
                        clearFloorInfo();
                        viewFloorList(data);
    
                    },
                    error:function(jqXHR, textStatus, errorThrown)
                        {
                            $(".txtUpdate").text("Error Occured.....");
                            $("#"+v).attr("disabled",false);
                           // $("#"+v).attr("class",false);

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
    

}

function getHotelList(data,i,w){

    var optionList="";
    $.each(data.getHotelList,function(key,val){

        var sel="";
       // alert(val.id+" - "+w);
        if(val.id == w)
        {
            //alert("ok");
            sel="selected";
        }

        optionList=optionList+"<option class='selected-"+val.id+"' "+sel+" value='"+val.id+"'>"+val.hotel_name+"</option>";
    });

    var hList="<select id='hList' class='form-control select-hid-"+i+"'>"+optionList+"</select>";
    return hList;
}

function setUpdateFloorInfo(data){

    $.each(data.floorInfo,function(key,val){

        //alert("ok");
        $("#btnUpdateFloorInfo").val(val.floor_id);
        $("#txtFloorNo").val(val.floor_no);
        $(".selected_id-"+val.ware).prop("selected",true);
        $("#btnRemoveFloorInfo").val(val.floor_id);

    });

}
function getSpeFloorInfo(id,v){


    $(".txtLoading").text("Loading....");
    $(v).attr("disabled",true);

    $.ajax({
        type:'POST',
        dataType:'json',
        url: li+"ajaxController/getSpeFloorInfo/",
        data:{
                id:id,
            },
        success:function(data)
        {
            $(".txtLoading").text("");
            $(v).attr("disabled",false);
            btnForUpdate();

            setUpdateFloorInfo(data);

        },
        error:function(jqXHR, textStatus, errorThrown)
            {
               // $(".btnLoading").text("Save");
                //$("#"+v).attr("disabled",false);

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


function viewFloorList(data){

    var list="";
    var i=1;

  
    $.each(data.list,function(key,val){
       // alert(val.hid);

       var btnEdit="<button onclick=getSpeFloorInfo('"+val.floor_id+"',this) class='btn btn-danger'><i class='fa fa-pencil'></i><span class='btnLoadin'></span></button>";
       var btnDel="<button onclick=delFloorInfo('"+val.id+"',this) class='btn btn-danger'><i class='fa fa-remove'></i><span class='btnLoadin'></span></button>";
   

        list=list+"<tr>"
                +"<td>"+(i++)+"</td>"
                +"<td>"+val.floor_no+"</td>"
                +"<td>"+getHotelList(data,i,val.ware)+"</td>"
                +"<td></td>"
                +"<td>"+btnEdit+" |  "+btnDel+"</td>"
            +"</tr>";

    });

    $("#tableFloorList").html(list);

}

function clearFloorInfo(){

    $("#txtFloorNo").val("");
    $("#txtFloorNo").focus();
}


function searchFloorInfo(){

    var searchHotelId=$("#searchHotelId").val();
    var searchFloorId=$("#searchFloorId").val();

    alert(searchHotelId+" - "+searchFloorId);

    $.ajax({
        type:'POST',
        dataType:'json',
        url: li+"ajaxController/searchFloorInfo/",
        cache: false,
        data:{
                searchHotelId:searchHotelId,
                searchFloorId:searchFloorId,
            },
        success:function(data)
        {
            viewFloorList(data);
        },
        error:function(jqXHR, textStatus, errorThrown)
            {
                $(".btnLoading").text("Save");
                $("#"+v).attr("disabled",false);

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

function saveFloorInfo(v){

    var txtFloorNo=$("#txtFloorNo").val();
    var comboHotelId=$("#comboHotelId").val();
    var status=0;

    $(".radio_group input").each(function()
        {
            if($(this).is(":checked"))
                {
                    status=$(this).val();
                }

        });

    if(txtFloorNo == '' || comboHotelId == '0' || comboHotelId == '')
        alert("Information Incomplete.....");
    else{

        var c=confirm("Are you sure to confirm ?");
        if(c == true){

           // alert(li);
            $(".btnLoading").text("Loading....");
            $("#"+v).attr("disabled",true);

            $.ajax({
                type:'POST',
                dataType:'json',
                url: li+"ajaxController/saveFloorInfo/",
                cache: false,
                data:{
                        txtFloorNo:txtFloorNo,
                        comboHotelId:comboHotelId,
                        status:status,
                    },
                success:function(data)
                {
                    init();

                    $(".btnLoading").text("Save");
                    $("#"+v).attr("disabled",false);

                    $("#div_alert").text(data.msg);

                    divAlert("div_alert");

                    clearFloorInfo();
                    viewFloorList(data);

                },
				error:function(jqXHR, textStatus, errorThrown)
					{
						$(".btnLoading").text("Save");
                        $("#"+v).attr("disabled",false);

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

}
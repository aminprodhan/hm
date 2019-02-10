
var li=links();

function createNewRoom(){

    $("#modalCreateNewRoom").modal("show");
    init();
}

function init(){
    
    $(".btnSaveRoomDisplay").show();
    $(".searchBtnUpdateDisplay").hide();
}


function saveRoomInfo(v){


    var txtRoomNo=$("#txtRoomNo").val();
    var comboRoomHotelList=$("#comboRoomHotelList").val();
    var comboRoomFloorList=$("#comboRoomFloorList").val();
    var comboRoomTypeList=$("#comboRoomTypeList").val();
    var txtRoomNumberOfBed=$("#txtRoomNumberOfBed").val();
    var inpValidation=[];

     inpValidation[0]=[txtRoomNo,comboRoomHotelList
        ,comboRoomFloorList,comboRoomTypeList];

    var inpValidationMsg=["Room No is Empty....","Hotel can't be null"
        ,"Floor can't be null","Room type is empty....",
        ""];    

    var checkValidStatus=  inputValidation(inpValidation,inpValidationMsg);


    var status=0;

    $(".radio_room_group input").each(function()
        {
            if($(this).is(":checked"))
                {
                    status=$(this).val();
                }

        });

        inpValidation[0].push(txtRoomNumberOfBed);
        inpValidation[0].push(status);


    if(checkValidStatus == 1)
       {

            var c=confirm("Are you sure ?");
            if(c == true){

                var dataCombineToJson=JSON.stringify(inpValidation);
                
                $("#"+v).attr("disabled",true);
                $(".txtSaveRoomLoading").text("Loading......");

                $.ajax({
                    type:'POST',
                    dataType:'json',
                    url: li+"room_controller/saveRoomInfo/",
                    cache: false,
                    data:{
                            dataCombineToJson:dataCombineToJson,
                            trans_id:"-1",
                        },
                    success:function(data)
                    {
                        $("#"+v).attr("disabled",false);
                        $(".txtSaveRoomLoading").text("Save");

                        $("#div_room_alert").text(data.msg);



                    },
                    error:function(jqXHR, textStatus, errorThrown)
                        {  
                            $("#"+v).attr("disabled",false);
                            $(".txtSaveRoomLoading").text("Save"); 

                            showAjaxError(jqXHR, textStatus, errorThrown);
                        }
                    });

            }

       }

}

function viewRoomFloorList(data){

    var list="";
    $.each(data.floorInfo,function(key,val){

        list=list+"<option value='"+val.floor_id+"'>"+val.floor_no+"</option>";

    });

    $("#comboRoomFloorList").html(list);

}

function getFloorList(v){

    var hid=$(v).val();

   // alert(hid);

    $.ajax({
        type:'POST',
        dataType:'json',
        url: li+"ajaxController/getHotelFloorList/",
        cache: false,
        data:{
                hid:hid,
            },
        success:function(data)
        {
            
            viewRoomFloorList(data);

        },
        error:function(jqXHR, textStatus, errorThrown)
            {
                $(".txtSaveRoomLoading").text("Error Occured.....");
                $(v).attr("disabled",false);

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
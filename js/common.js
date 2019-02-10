
function divAlert(div_id){


    //$("#"+div_id).show();
    $("#"+div_id).fadeIn();
    $("#"+div_id).fadeIn("slow");
    $("#"+div_id).fadeIn(3000);

    setTimeout(function(){

        $("#"+div_id).fadeOut();
        $("#"+div_id).fadeOut("slow");
        $("#"+div_id).fadeOut(3000);

    },2000);

}

function showAjaxError(jqXHR, textStatus, errorThrown){

    
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

function inputValidation(inp,inpValidationMsg)
    {
        var i=0;
        for( i=0;i < inp[0].length;i++){
           
            var data=inp[0][i];
            if(data == '' || data == '0' || data === null)
                {
                    $("#div_room_alert").text(inpValidationMsg[i]);
                    $("#div_room_alert").css("color","red");
                    break;
                }

        }

      if(i == inp[0].length)
        return 1;
        
       return 0;

    }
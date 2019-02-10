var li = links();
//country add js
$('.sett_date').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '-3d'
});
function add_country() {
    var add_country_name = $("#add_country_name").val();
    if (add_country_name == '') {
    	$('.country_add_error').html('<span class="text-danger animated fadeOut delay-2s">Country name required</span>');
    }
    else {
        //alert(add_country_name);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: li + 'admin/add_country',
            data: {add_country_name1: add_country_name},
            success: function (data) {
                if(data  == 1){
    				$('#add_country_name').empty();
                    
                    $('.country_add_error').html('<span class="text-success animated fadeOut delay-2s">'+add_country_name+' successfully inserted.</span>');
                    addCountryList(1);
                }else{
                	$('.country_add_error').html('<span class="text-danger animated fadeOut delay-2s">'+add_country_name+' already exist.</span>');
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
}

/* start country edit/delete */
function addCountryList(code) {
    //alert(code);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: li + 'admin/getAllCountry',
        data: {code: code},
        success: function (data) {
            //alert(data);
            addAddCountry(data);
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

function addAddCountry(data) {
    var stuff = "";
    var i = 1;
    $.each(data.posts, function (key, val) {
        stuff = stuff + "<tr class='text-center' id='" + val.id + "del_leave'>"
            + "<td id='" + val.id + "aemid'>" + i++ + "</td>"
            + "<td id='" + val.id + "aname'>"+ val.name +"</td>"
            + "<td><button onclick='update_country(" + val.id + ")' class='btn btn-warning btn_custom' title='Update "+val.name+"'><i class='fa fa-pencil fa-1x'></i></button> "
            + "<button onclick='delete_country(" + val.id + ")' class='btn btn-danger btn_custom' title='Delete "+val.name+"'><i class='fa fa-trash fa-1x'></i></button></td>"
            + "</tr>";
    });
    if (i == 0)
        stuff = "";
    document.getElementById("tcountry_add_panel").innerHTML = stuff;
}

function update_country(id) {
    //alert($("#"+id+"uni").text());
    var update_country_id = id;
    var str = $("#" + id + "aname").text();
    var update_country_name = $("#add_country_name").val(str.trim());

    $("#update_country_btn").show();
    $("#update_country_btn").val(update_country_id);
    $("#add_country_btn").hide();
    $(".add-new-country").show();
}

$( "#update_country_btn" ).click(function() {
    var country_name_update= $('#add_country_name').val();
    var update_country_btn_id= $(this).val();
   // alert(update_country_btn_id);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: li + 'admin/countryUpdate',
        data: {country_name_update: country_name_update,update_country_btn_id:update_country_btn_id},
        success: function (data) {
           if(data == 1){
            $('.country_add_error').html('<span class="text-success animated fadeOut delay-2s">'+country_name_update+' successfully Updated.</span>');
                    
                addCountryList(1);
           }else if(data == 2){
            $('.country_add_error').html('<span class="text-danger animated fadeOut delay-2s">Unchanged country name: '+country_name_update+'.</span>');
            
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
});

$('.add-new-country').click(function(){
    $("#update_country_btn").hide();
    $("#add_country_btn").show();
    $(this).hide();
});

function delete_country(id) {

    var c = confirm('Are you sure to delete the country?');
    if (c == true) {

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: li + 'admin/deleteSingleCountry',
            data: {id: id},
            success: function (data) {
                //alert(data.message);
                addAddCountry(data);
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
/* end country list edit js*/

/* start state js*/
function add_state(){
	var addState_country = $('#addState_country_name').val();
	var addState_state = $('#addState_state_name').val();

	if(addState_country == '0' && addState_state == '' || addState_country == '0' && addState_state != '' || addState_country != '0' && addState_state == ''){
		$('.addState_error').html('<span class="text-danger animated fadeOut delay-2s">All Fill Required</span>');
	}else {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: li + 'admin/add_state',
            data: {addState_country1: addState_country, addState_state1: addState_state},
            success: function (data) {
                if(data == 1){
    				$('.addState_error').html('<span class="text-success animated fadeOut delay-2s">'+addState_state+' successfully inserted.</span>');
                    state_list(2);
                }else if(data == 2){
                	$('.addState_error').html('<span class="text-danger animated fadeOut delay-2s">'+addState_state+' already exist.</span>');
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
}
$('.state-tab').click(function(){
    var all_country = 1;
   //var country_change = $('#add_city_country_id').val();
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: li + 'admin/getAllCountryAppend',
        data: {country_code: all_country},
        success: function (data) {

            $('#addState_country_name').empty();
            
            $('#addState_country_name').append(
                '<option value="0">Select Country</option>'
            );
            for(var item in data.message){
                $('#addState_country_name').append(
                    '<option value="'+data.message[item].id+'">'+data.message[item].name+'</option>'
                );
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
});

/* start state edit */
function state_list(code) {
    //alert(code);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: li + 'admin/getAllState',
        data: {code: code},
        success: function (data) {
            //alert(data);
            state_list_tr(data);
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

function state_list_tr(data) {
    var stuff = "";
    var i = 1;

    $.each(data.states, function (key, val) {
        stuff = stuff + "<tr class='text-center' id='" + val.id + "del_state'>"
            + "<td id='" + val.id + "aemid'>" + i++ + "</td>"
            + "<td id='" + val.id + "aname' >"+val.name+"</td>"
            + "<td> <input type='hidden' id='state_p_id_"+val.id+"' value='"+val.p_id+"'>"
            + "<button onclick='update_state(" + val.id + ")' class='btn btn-warning btn_custom' title='Update "+ val.name +"'><i class='fa fa-pencil fa-1x'></i></button> "
            + " <button onclick='delete_state(" + val.id + ")' class='btn btn-danger btn_custom' title='Delete "+ val.name +"'><i class='fa fa-trash fa-1x'></i></button></td>"
            + "</tr>";
    });

    if (i == 0)
        stuff = "";

    document.getElementById("state_table").innerHTML = stuff;
}
function delete_state(id){
    var delete_state_id = id;
    var confirm_del = confirm("Confirm delete this state?");

    if(confirm_del == true){
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: li + 'admin/deleteState',
            data: {del_state: delete_state_id},
            success:function(data){
                state_list_tr(data);
            }
        });
    }
}
function update_state(id) {
    var update_state_id = id;
    var update_state_p_id = $('#state_p_id_' + id ).val();
    var str = $("#"+ id + "aname").text();
    var update_state_name = $('#addState_state_name').val(str.trim());
    var addState_country_name = $('#addState_country_name').val(update_state_p_id);

    $('#add_state_btn').hide();
    $('#update_state_btn').show();
    $('.new_state_btn').show();
    $('#update_state_btn').val(id);
}

$('#update_state_btn').click(function(){ 
    var state_update_country = $('#addState_country_name').val();
    var state_update_name = $('#addState_state_name').val();
    var state_update_id = $(this).val();

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: li+'admin/update_state',
        data: {state_update_country:state_update_country,state_update_name:state_update_name,state_update_id:state_update_id},
        success: function(data){
            if (data == 1) {
                $('.addState_error').html('<span class="text-success animated fadeOut delay-2s">Successfully updated state '+state_update_name+'</span>');
                state_list(2);
            }else if(data == 2){
                $('.addState_error').html('<span class="text-danger animated fadeOut delay-2s">Already exist '+state_update_name+'</span>');
            }
        }
    });
});

$('.new_state_btn').click(function(){
    $('#add_state_btn').show();
    $('#update_state_btn').hide();
    $(this).hide();

});
/* end state edit */

/* start city js */

$(".city-tab").click(function(){
    var all_country = 1;
    $.ajax({
        type: "post",
        dataType: "json",
        url: li + "admin/getAllCountryAppend",
        data: {country_code:all_country},
        success:function (data) {
            $("#add_city_country_id").empty();
            $("#add_city_country_id").append(
                '<option value="0">Select Country</option>'
            );
            for(var item in data.message){
                $("#add_city_country_id").append(
                    '<option value="'+data.message[item].id+'">'+data.message[item].name+'</option>'
                );
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
});
$( "#add_city_country_id" ).change(function() {
    var country_change = $('#add_city_country_id').val();
    //alert(country_change);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: li + 'admin/getState',
        data: {country_change: country_change},
        success: function (data) {
           
            $("#add_city_state_id").empty();
            $('#add_city_state_id').append(
                '<option value="0">Select State</option>'
            );
            //alert(data);
            for(var item in data.message){
                $('#add_city_state_id').append(
                    '<option value="'+data.message[item].id+'">'+data.message[item].name+'</option>'
                );
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
});

function add_city() {
    var state_id = $('#add_city_state_id').val();
    var city_name = $('#add_city_city_name').val();

    if(state_id == '0' && city_name == '' || state_id !='0' && city_name == '' || state_id == '0' && city_name != ''){
        $('.add_city_error').html('<span class="text-danger animated fadeOut delay-2s">State & City name required.</span>');
    }else {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: li+'admin/city_add',
            data: {state_id1: state_id, city_name1: city_name},
            success: function(data){
                if(data == 1){
                    $('.add_city_error').html('<span class="text-success animated fadeOut delay-2s">'+city_name+' successfully inserted.</span>');
                    all_city(3);
                }else if(data == 2){
                    $('.add_city_error').html('<span class="text-danger animated fadeOut delay-2s">'+city_name+' already exist.</span>');
                }
            }
        });
    }
}

function city_list_tr(data){
    var city_data = "";
    var i = 1;
    $.each(data.cities,function(var_attr, var_data){

        city_data = city_data + "<tr class='text-center' id='delete_city_tr_" + var_data.id + "'>"
            + "<td id='city_list_id_"+ var_data.id+"'>"+ i++ +"</td>"
            + "<td id='update_city_name_"+ var_data.id +"'>"+ var_data.name +"</td>"
            + "<td><input type='hidden' id='update_city_state_"+ var_data.id +"' value='"+ var_data.p_id +"'>"
            + "<button onclick='update_city("+var_data.id+")' class='btn btn-warning btn_custom'><i class='fa fa-pencil fa-1x'></i></button>"
            + " <button onclick='delete_city("+var_data.id+")' class='btn btn-danger btn_custom'><i class='fa fa-trash fa-1x'></i></button></td>"
            + "</tr>";
    });

    if(i == 0)
        city_data = "";

    document.getElementById("city_table").innerHTML = city_data;
}

function delete_city(id){
    var delete_city_id = id;
    var confirm_city_del = confirm("Confirm delete this city?");

    if(confirm_city_del == true){
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: li + 'admin/delete_city',
            data: {del_city: delete_city_id},
            success: function(data){
                if(data.success == 1){
                    city_list_tr(data);
                    alert('Successfully deleted city');
                }
            }
        });
    }
}
function all_city(city_type){
    var city_type = city_type;

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: li + 'admin/getAllCity',
        data: {city_type1: city_type},
        success: function(data){
            //alert(data);
            city_list_tr(data);
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
function update_city(id) {
    var update_city_id = id;
    var update_city_name = $('#update_city_name_'+ id).text();
    var update_city_state_id = $('#update_city_state_'+ id).val();
    $('#add_city_city_name').val(update_city_name);

    $('#city_add_btn').hide();
    $('#city_update_btn').show();
    $('#city_update_btn').val(id);
    $('.add_city_btn').show();

    $.ajax({
        type: 'post',
        dataType: 'json',
        url: li+'admin/get_state_ajax',
        data: {update_city_state_id:2,p_id:update_city_state_id},
        success: function (data) {

            $("#add_city_state_id").empty();
            $('#add_city_state_id').append(
                '<option value="0">Select State</option>'
            );
            //alert(data);
            for(var item in data.states){
                //alert(data.states[item].name);
                $('#add_city_state_id').append(
                    '<option value="'+data.states[item].id+'">'+data.states[item].name+'</option>'
                );
            }
            $('#add_city_state_id').val(update_city_state_id);
            $('#add_city_country_id').val(data.message);
        }
    });
}

$('.add_city_btn').click(function(){
    $('#city_add_btn').show();
    $('#city_update_btn').hide();
    $('.add_city_btn').hide();
});

$('#city_update_btn').click(function() {
    var city_update_id = $('#city_update_btn').val();
    var add_city_state_id = $('#add_city_state_id').val();
    var add_city_city_name = $('#add_city_city_name').val();
    
    if (add_city_state_id == '0' && add_city_city_name == '' || add_city_state_id != '0' && add_city_city_name == '' || add_city_state_id == '0' && add_city_city_name != '') {
        $('.add_city_error').html('<span class="text-danger animated fadeOut delay-2s">State & City name required.</span>');
    }else{
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: li + 'admin/update_city',
            data: {update_city_id:city_update_id,update_city_state: add_city_state_id,update_city_name: add_city_city_name},
            success: function(data){
                if (data == 1) {
                    all_city(3);
                    $('.add_city_error').html('<span class="text-success animated fadeOut delay-2s">'+add_city_city_name +' successfully updated.</span>');
                }else if(data == 2){
                    $('.add_city_error').html('<span class="text-danger animated fadeOut delay-2s">'+add_city_city_name +' already exist.</span>');
                }
            }
        });
    }
});
/* end city js */
//end country module

//start menu module view/add/update/delete
function add_main_menu_btn(){
    var main_menu_name = $('#main_menu_name').val();
    var main_menu_module = $('#main_menu_module').val();
    var main_menu_controller = $('#main_menu_controller').val();
    
    if (main_menu_name == '') {
        $('.main_menu_add_error').html('<span class="text-danger animated fadeIn fadeOut delay-2s">Main menu required.</span>');
    }else if(main_menu_module == '0'){
        $('.main_menu_add_error').html('<span class="text-danger animated fadeIn fadeOut delay-2s">Module required.</span>');
    }else if(main_menu_controller == ''){
        $('.main_menu_add_error').html('<span class="text-danger animated fadeIn fadeOut delay-2s">Controller required.</span>');
    }else{
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: li + 'admin/add_main_menu',
            data: {main_menu_name1:main_menu_name, main_menu_module1:main_menu_module, main_menu_controller1:main_menu_controller},
            success: function(data){
                //alert(data.ms);
                if(data == 1){
                   // alert(data);
                   menu_type(0);
                    $('.main_menu_add_error').html('<span class="text-success animated fadeOut delay-2s">Successfully inserted.</span>');
                }else if(data == 2){
                    $('.main_menu_add_error').html('<span class="text-danger animated fadeOut delay-2s">Already exist.</span>');
                }
            },error: function (jqXHR, textStatus, errorThrown) {
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
function menu_type(code) {
    var menu_type = code;

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: li + 'admin/getAllMenu',
        data: {menu_type: menu_type},
        success: function(data) {

            menu_list_tr(data);

        },error: function (jqXHR, textStatus, errorThrown) {
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
function menu_list_tr(data){
    var menu_data = "";
    var i = 1;
    $.each(data.menues,function(var_attr, var_data){

        menu_data = menu_data + "<tr class='text-center' id='main_menu_list_tr_" + var_data.id + "'>"
            + "<td id='menu_list_id_"+ var_data.id+"'>"+ i++ +"</td>"
            + "<td id='main_menu_name_"+ var_data.id +"'>"+ var_data.name +"</td>"
            + "<td id='main_menu_module_"+ var_data.id +"'>"+ var_data.module +"</td>"
            + "<td id='main_menu_controller_"+ var_data.id +"'>"+ var_data.controller +"</td>"
            + "<td><input type='hidden' id='menu_module_list_id"+ var_data.id +"' value='"+ var_data.module_id +"'>"
            + "<button onclick='update_main_menu("+var_data.id+")' id='update_main_menu_"+var_data.id+"' class='btn btn-warning btn_custom'><i class='fa fa-pencil fa-1x'></i></button>"
            + " <button onclick='delete_main_menu("+var_data.id+")' class='btn btn-danger btn_custom'><i class='fa fa-trash fa-1x'></i></button></td>"
            + "</tr>";
    });

    if(i == 0)
        menu_data = "";

    document.getElementById("main_menu_table").innerHTML = menu_data;
}

function update_main_menu(id) {
    var edit_menu_id = id;
    var main_menu_name = $('#main_menu_name_'+id).text();
    var main_menu_module = $('#menu_module_list_id'+ id).val();
    var main_menu_controller = $('#main_menu_controller_'+ id).text();
    var main_menu_status = $('#main_menu_status_'+ id).text();
    //alert(main_menu_module);

    $('#add_main_menu_btn_sub').hide();
    $('#main_menu_update_submit_btn').show();
    $('.new_menu_add_btn').show();
    $('#main_menu_update_submit_btn').val(id);

    $('#main_menu_name').val(main_menu_name);
    $('#main_menu_module').val(main_menu_module).prop('selected', true);
    $('#main_menu_controller').val(main_menu_controller);
}

$('.new_menu_add_btn').click(function(){
    $(this).hide();
    $('#main_menu_update_submit_btn').hide();
    $('#add_main_menu_btn_sub').show();

    $('#add_menu_form').trigger('reset');
});
$('#main_menu_update_submit_btn').click(function(){
    var update_main_menu_id =  $('#main_menu_update_submit_btn').val();;
    var update_main_menu_name = $('#main_menu_name').val();
    var update_main_menu_module = $('#main_menu_module').val();
    var update_main_menu_controller = $('#main_menu_controller').val();

    //alert(update_main_menu_module);
    if (update_main_menu_name == '') {
        $('.main_menu_add_error').html('<span class="text-danger animated fadeIn fadeOut delay-2s">Main menu required.</span>');
    }else if(update_main_menu_module == '0'){
        $('.main_menu_add_error').html('<span class="text-danger animated fadeIn fadeOut delay-2s">Module required.</span>');
    }else if(update_main_menu_controller == ''){
        $('.main_menu_add_error').html('<span class="text-danger animated fadeIn fadeOut delay-2s">Controller required.</span>');
    }else{
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: li + 'admin/update_main_menu',
            data: {update_main_menu_id1:update_main_menu_id,update_main_menu_name1:update_main_menu_name, update_main_menu_module1:update_main_menu_module, update_main_menu_controller1:update_main_menu_controller},
            success: function(data){
                //alert(data.ms);
                if(data == 1){
                   // alert(data);
                    $('.main_menu_add_error').html('<span class="text-success animated fadeOut delay-2s">Successfully updated.</span>');
                    menu_type(0);
                }else if(data == 2){
                    $('.main_menu_add_error').html('<span class="text-danger animated fadeOut delay-2s">Already exist.</span>');
                }
            },error: function (jqXHR, textStatus, errorThrown) {
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
});
function delete_main_menu(id) {
    var delete_main_menu_id = id;
    var confirm_del_main_menu = confirm("Confirm this delete main menu");

    if(confirm_del_main_menu == true){
        $.ajax({
            type:'post',
            dataType: 'json',
            url: li+'admin/delete_main_menu',
            data: {delete_menu_id:delete_main_menu_id},
            success: function(data) {
                menu_type(0);
            },error: function (jqXHR, textStatus, errorThrown) {
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

$('#add_submenu_module').on('change',function(){
    var module_id = $(this).val();

    $.ajax({
        type: 'post',
        dataType: 'json',
        url: li + 'admin/sub_menu_list_on_change',
        data: {module_id: module_id},
        success: function(data){

        },error: function (jqXHR, textStatus, errorThrown) {
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
});
//end menu module view/add/update/delete

//start season add/view/update/delete
function season() {
    //alert('ok');
    var season_code = 1;

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: li + 'admin/getAllSeason',
        data: {},
        success: function(data) {

            season_list_tr(data);

        },error: function (jqXHR, textStatus, errorThrown) {
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
function season_list_tr(data){
    var season_data = "";
    var i = 1;
    $.each(data.all_season,function(var_attr, var_data){

        season_data = season_data + "<tr class='text-center' id='season_list_tr_" + var_data.id + "'>"
            + "<td>"+ i++ +"</td>"
            + "<td id='update_season_hotel_"+ var_data.id +"'>"+ var_data.hotel_name +"</td>"
            + "<td id='update_season_name_"+ var_data.id +"'>"+ var_data.season_name +"</td>"
            + "<td id='update_season_start_date_"+ var_data.id +"'>"+ var_data.start_date +"</td>"
            + "<td id='update_season_end_date_"+ var_data.id +"'>"+ var_data.end_date +"</td>"
            + "<td><input type='hidden' id='update_season_row_id_"+ var_data.id +"' value='"+ var_data.id +"'>"
            + "<input type='hidden' id='update_season_hotel_id_"+ var_data.id +"' value='"+ var_data.ware +"'>"
            + "<button onclick='update_season("+var_data.id+")' id='update_season_"+var_data.id+"'  title='Update "+var_data.season_name+"' class='btn btn-warning btn_custom'><i class='fa fa-pencil fa-1x'></i></button>"
            + " <button onclick='delete_season("+var_data.id+")' id='delete_season_"+var_data.id+"' value='"+var_data.season_name+"'  title='Delete "+var_data.season_name+"' class='btn btn-danger btn_custom'><i class='fa fa-trash fa-1x'></i></button></td>"
            + "</tr>";
    });

    if(i == 0)
        season_data = "";

    document.getElementById("all_season_table").innerHTML = season_data;
}
function add_season_submit() {
    var add_season_hotel = $("#add_season_hotel").val();
    var add_season_name = $("#add_season_name").val();
    var add_season_start_date = $("#add_season_start_date").val();
    var add_season_end_date = $("#add_season_end_date").val();

    if(add_season_hotel == '0'){
        $('.season_form_error').html("<span class='text-danger text-bold animated fadeOut delay-2s'>Hotel select is required.</span>");
    }else if(add_season_name == ''){
        $('.season_form_error').html("<span class='text-danger text-bold animated fadeOut delay-2s'>Season name required.</span>");
    }else if(add_season_start_date == ''){
        $('.season_form_error').html("<span class='text-danger text-bold animated fadeOut delay-2s'>Season start date required.</span>");
    }else if(add_season_end_date == ''){
        $('.season_form_error').html("<span class='text-danger text-bold animated fadeOut delay-2s'>Season end date required.</span>");
    }else {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: li + 'admin/add_season',
            data: {add_season_hotel1:add_season_hotel, add_season_name1:add_season_name, add_season_start_date1:add_season_start_date,add_season_end_date1:add_season_end_date},
            success: function(data){
                if(data == 1){
                   // alert(data);
                   season();
                    $('.season_form_error').html('<span class="text-success animated fadeOut delay-2s">Successfully inserted.</span>');
                }else if(data == 2){
                    $('.season_form_error').html('<span class="text-danger animated fadeOut delay-2s">Already exist.</span>');
                }
            },error: function (jqXHR, textStatus, errorThrown) {
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

function update_season(id) {
    var update_season_id = id;
    var hotel_id = $("#"+'update_season_hotel_id_'+id).val();
    var season_name = $("#"+'update_season_name_'+id).text();
    var season_start_date = $("#"+'update_season_start_date_'+id).text();
    var season_end_date = $("#"+'update_season_end_date_'+id).text();

    //alert(update_season_id);
    $('#add_season_hotel').val(hotel_id).prop('selected', true);
    $('#add_season_name').val(season_name);
    $('#add_season_start_date').val(season_start_date);
    $('#add_season_end_date').val(season_end_date);
    $('#add_season_submit_btn').hide();
    $('#update_season_submit').val(id).show();
    $('#add_season_cancel_btn').show();
    $('.add_new_season_btn').show();
}

$('.add_new_season_btn').click(function(){
    $('#add_season_submit_btn').show();
    $('#update_season_submit').hide();
    $('#add_season_cancel_btn').hide();
    $(this).hide();
    
    $("#season_add_form").trigger('reset');
});
$('#update_season_submit').click(function(){
    var update_season_row_id = $(this).val();
    var update_season_hotel = $('#add_season_hotel').val();
    var update_season_name = $('#add_season_name').val();
    var update_season_start_date = $('#add_season_start_date').val();
    var update_season_end_date = $('#add_season_end_date').val();

    if(update_season_hotel == '0'){
        $('.season_form_error').html('<span class="text-danger animated fadeOut delay-3s">Hotel select requierd</span>');
    }else if(update_season_name == ''){
        $('.season_form_error').html('<span class="text-danger animated fadeOut delay-3s">Season name requierd</span>');
    }else if(update_season_start_date == ''){
        $('.season_form_error').html('<span class="text-danger animated fadeOut delay-3s">Season start date requierd</span>');
    }else if(update_season_end_date == ''){
        $('.season_form_error').html('<span class="text-danger animated fadeOut delay-3s">Season end date requierd</span>');
    }else{

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: li + 'admin/update_season',
            data: {update_season_row_id:update_season_row_id, update_season_hotel:update_season_hotel, update_season_name:update_season_name, update_season_start_date:update_season_start_date,update_season_end_date:update_season_end_date},
            success: function(data){
                if(data == 1){
                   // alert(data);
                   season();
                    $('.season_form_error').html('<span class="text-success animated fadeOut delay-2s">Successfully updated.</span>');
                }else if(data == 2){
                    $('.season_form_error').html('<span class="text-danger animated fadeOut delay-2s">Already exist.</span>');
                }
            },error: function (jqXHR, textStatus, errorThrown) {
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
});

function delete_season(id) {
    var delete_season_id = id;
    var delete_season_name = $('#delete_season_'+id).val();
    var confirm_delete_season = confirm('Confirm delete '+delete_season_name+'?');


    if(confirm_delete_season == true){
        $.ajax({
            type:'post',
            dataType: 'json',
            url: li+'admin/delete_season',
            data: {delete_season_id:delete_season_id},
            success: function(data) {
                //alert(data);
                if(data == 1){
                    alert("Successfully deleted.");
                    season();
                }
            },error: function (jqXHR, textStatus, errorThrown) {
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
//end season add/view/update/delete
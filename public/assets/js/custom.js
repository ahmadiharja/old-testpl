function fillForm(res) {
    $('[id$=_showhide]').each(function(index) {
        var id = $(this).attr('id');
        id = id.replace('_showhide', '');
        var e = $('[name='+id+']')[0];
        var show = true;
        if (res['data'][id] === undefined) {
            show = false;
        } 
        var a = res['options'][$(e).attr('id')]===undefined?'':$.parseJSON(res['options'][$(e).attr('id')]);
        if (a.length <= 0) {
            show = false;
        }
        if (show) $(this).show();
        else $(this).hide();
    });
    $.each(res['options'], function( name, value ) {
        name = name.replace(/\s/g, '_');
        var e = $('[id="'+name+'"]');

        $(e).empty();
        if ($(e).data('placeholder')) {
            $(e).append($('<option>').val($(e).data('placeholder')).text($(e).data('placeholder')));
        }
        var obj = $.parseJSON(value);
        
        $.each(obj, function(k, v){
            $(e).append($('<option>').val(k).text(v));
        });
        
    }); 
    var type1 = '';
    $.each(res['data'], function( name, value ) {
        name = name.replace(/\s/g, '_');
        var e = $('[name="'+name+'"]');

        type1 = '';
        if (e.length > 0){
            $(e).prop('disabled', false);
            if ($(e).prop('tagName') == 'INPUT') {
                type1 = $(e).attr('type');
            } else {
                type1= $(e).prop('tagName');
            }
            switch (type1.toLowerCase()) {
                case 'text':case 'time': case 'hidden': $(e).val(value); break;
                case 'checkbox': 
                    //for display setting
                    
                    // check if value is a string
                    /*if(jQuery.type(value) == "string"){
                        $(e).prop('checked', value== "true" ? true:false);
                    }
                    else {
                        $(e).prop('checked', value);
                    }*/
                    //$(e).prop('checked', JSON.parse(value) );
                    // check if client send a string as "true", "on"
                    $(e).prop('checked', (/true|on|1/i).test(value) ).change();
                    if (name=="CommunicationType") {
                        $(e).prop('checked', value == 2 ? true:false).change();
                    }

                    break;
                case 'select': $(e).val(value).change(); break;
                case 'date':
                    
                    if (value) {
                        value=value.replace(/\./g, '-');
                        $(e).val(value); 
                    }
                    break;
        }
            //$(e).val(value);
        }
    }); 

    // $('#displaysetting').autofill(res['data']);
    
}
    
    function clearForm(){
  $('form').find('input[type=text],input[type=date], select, input[type=checkbox]').val('');
  $('form').find('select').empty();

  // reset 4 forms
  $('form')[0].reset();
  $('form')[1].reset();
  //disable form
  // clear form
  $('#id').val('');
  $('#ds-fn-id').val('');
  $('#displaysetting')[0].reset();//find("input[type=text], select").val("");
  $('form').find('input[type=text],input[type=date], select, input[type=checkbox], input[type=button], button').prop('disabled',true);

    }

    function convertcdfL(value, from, to) {
    if (from == 'cd' && to == 'fL')  {
        return cdTofL(value);
    } else if (from == 'fL' && to == 'cd') {
        return fLtocd(value);
    } 

    return value;
}
function cdTofL(cd) {
    return Math.round(cd * 100 / 3.4262591) / 100;
}
    
function fLtocd(fL) {
    return Math.round(fL * 100 * 3.4262591) / 100;
}
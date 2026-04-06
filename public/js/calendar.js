(function ( $ ) {
 
    $.fn.calendar = function(options ) {
        // Establish our default settings
        var calendar = this;

        var settings = $.extend({
            // add more options if needed
        }, options);

        
        function reloadData(data){
            $(calendar).fullCalendar('refetchEvents');
        }

        // load data from ajax into DataTables
        function loadData() {
            // clone array before push
            today = new Date();
            y = today.getFullYear();
            m = today.getMonth();
            d = today.getDate();

            $(calendar).fullCalendar({
                timeFormat: 'H:mm', // uppercase H for 24-hour clock
                viewRender: function(view, element) {
                    // We make sure that we activate the perfect scrollbar when the view isn't on Month
                    if (view.name != 'month') {
                    $(element).find('.fc-scroller').perfectScrollbar();
                    }
                },
                header: {
                    left: 'title',
                    center: 'month,agendaWeek,agendaDay',
                    right: 'prev,next,today'
                },
                defaultDate: today,
                selectable: true,
                selectHelper: true,
                views: {
                    month: { // name of view
                    titleFormat: 'MMMM YYYY'
                    // other view-specific options here
                    },
                    week: {
                    titleFormat: " MMMM D YYYY"
                    },
                    day: {
                    titleFormat: 'D MMM, YYYY'
                    }
                },
                select: function(start, end) {
                },
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: "/calendar/events", // JSON ajax source
                eventClick: function(calEvent, jsEvent, view) {
                    id = calEvent.data['taskid'];
                    if (!calEvent.data['isqa']) {
                        $.ajax({
                            type: 'GET',
                            url: '/tasks/' + id + '/edit',
                            success: function(res) {
                                $('.modal-body').html(res);
                                // show modal
                                $('#crud-modal').modal('show');
                            }
                        });
                    }
                    return true;
                },
                eventMouseover: function(calEvent, jsEvent, view) {
                    // Fill task information
                    // $.each(calEvent.data, function(key, value) {
                    //     $('#' + key).html(value);
                    // });
                    // change the border color just for fun
                    $(this).css('border-color', 'yellow');
                    $(this).css('border-style', 'inherit');

                
                },
                eventMouseout: function(calEvent, jsEvent, view) {
                    $(this).css('border-style', 'none');
                    $(this).css('border-color', 'none');
                },
                eventDrop: function(calEvent, delta, revertFunc, jsEvent, ui, view) {
                    console.log(calEvent);
                    console.log(calEvent.start.format());
                    console.log(delta);
                },
                
            });
        }


        // init all button click events
        function initEvents() {
            // save button click invoke form submit
            $(document).on('click', '.modal-content .save-button', function(e) {
                $('.crud-form').submit();
            }); 
            
            // form submit (save or update item)
            $(document).on('submit', '.crud-form', function(e) {
                // prevent default submit action
                e.preventDefault();

                // reset all invalid fields before validate again
                resetInvalid();
                //Fetch form to apply custom Bootstrap validation
                
                var forms = $(".crud-form");
                // add class was-validated to form to show the error input
                forms.addClass('was-validated');
                if (forms[0].checkValidity() === false) {
                    //e.stopPropagation()
                    //notify('error', 'Error occurs. Please check the input');
                    // show error tooltip
                    $('select:invalid,input:invalid').first().each(function(){
                        this.reportValidity();
                    })
                    
                    return false;
                }
             
                // form valid, make ajax call (only send visible fields or hidden fields)
                var submitData = $(this).find('[type=hidden], :visible').serialize();
                
                var id = $('input[name=id]', $(this)).val();
                
                if (id) {
                    console.log(submitData);
                    $.ajax({
                        type: 'PUT',
                        url: '/tasks/' + id,
                        dataType: "json",
                        data: submitData, 
                        success: function(res) {
                            notify('success', 'Data saved successfully.')
                            $('#crud-modal').modal('hide');
                            reloadData();
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            if (xhr.status == 422) {
                                showValidationErrors(xhr.responseJSON);
                            }else if (xhr.status != 200) {
                                notify('error', 'Technical error occurs. Please try again')
                            }
                        }
                    });
                } 
            });
        
        }
        loadData();
        initEvents();
        return  calendar;
    };
 
}( jQuery ));
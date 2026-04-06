</section>

<script src="{{url('assets/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{url('assets/js/sidebar.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="{{url('assets/js/custom.js')}}"></script>

<p id="site-success" style="display: none;">
<svg width="30" height="30" viewBox="0 0 30 30" fill="#fff" xmlns="http://www.w3.org/2000/svg">
<circle opacity="1" cx="15" cy="15" r="15" fill="#fff"/>
<path d="M12.714 18.1771L10.0702 15.5333C9.92776 15.3908 9.73454 15.3108 9.53307 15.3108C9.3316 15.3108 9.13839 15.3908 8.99593 15.5333C8.85347 15.6757 8.77344 15.8689 8.77344 16.0704C8.77344 16.1702 8.79309 16.2689 8.83126 16.3611C8.86944 16.4533 8.92539 16.537 8.99593 16.6075L12.1807 19.7923C12.4778 20.0894 12.9578 20.0894 13.255 19.7923L21.3159 11.7313C21.4584 11.5889 21.5384 11.3957 21.5384 11.1942C21.5384 10.9927 21.4584 10.7995 21.3159 10.6571C21.1735 10.5146 20.9803 10.4346 20.7788 10.4346C20.5773 10.4346 20.3841 10.5146 20.2416 10.6571L12.714 18.1771Z" fill="#27AE60"/>
</svg>

    <span id="site_success_msg">
    @if(Session::has('success'))
    {{Session::get('success')}}

    <script>
        $("#site-success").fadeIn();
        setTimeout(function(){
            $("#site-success").fadeOut(2000);
        }, 4000);
    </script>
    @endif
    </span>
</p>

<p id="site-failed" style="display: none;">
<svg width="12" height="12" viewBox="0 0 12 12" fill="#fff" xmlns="http://www.w3.org/2000/svg">\
<path d="M1.33398 1.33301L10.6667 10.6657" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>\
<path d="M1.33355 10.6657L10.6663 1.33301" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>\
</svg>

    <span id="site_failed_msg">
    @if(Session::has('error'))
    {{Session::get('error')}}

    <script>
        $("#site-failed").fadeIn();
        setTimeout(function(){
            $("#site-failed").fadeOut(2000);
        }, 4000);
    </script>
    @endif
    </span>
</p>

<script>
    function update_sidebar(th)
    {
        var sidebar=$("body").attr('data-sidebar-size');
        if(sidebar=="wide") sidebar="narrow";
        else sidebar="wide";
        
        var formData=new FormData();
        formData.append('_token', '{{csrf_token()}}');
        formData.append('sidebar', sidebar);
        
        $.ajax({
            url: "<?php echo url('update-sidebar') ?>",
            type: "POST",
            data:  formData,
            beforeSend: function(){ //alert('sending');
            },
            contentType: false,
            processData:false,
            success: function(data) { //alert(data);
                //success
                // here we will handle errors and validation messages
                if ( ! data.success) {
                } else {
                    // ALL GOOD! just show the success message!
                }
            },
            error: function()  {
                //error
            } 	        
        });
    }
    
    $(document).on('change', '.displays-check', function() {
        // Count the number of checked checkboxes with class "displays-check"
        var checkedCount = $('.displays-check:checked').length;
        var drop_text='Please select';
        if(checkedCount==1) drop_text='1 option selected';
        else if(checkedCount>1) drop_text=checkedCount+' options selected';

        $(this).parent().parent().prev().text(drop_text);
    });

    function hide_box(th)
    {
        $(th).hide();
    }

    function formatDate(dateString) {
        return moment(dateString).format('DD/MM/YYYY, H:mm');
    }

    function notify(type, msg)
    {
        if(type=='success')
        {
            $("#site_success_msg").text(msg);
            $("#site-success").fadeIn();
            setTimeout(function(){
                $("#site-success").fadeOut(2000);
            }, 4000);
        }
        else if(type=='failed')
        {
            $("#site_failed_msg").text(msg);
            $("#site-failed").fadeIn();
            setTimeout(function(){
                $("#site-failed").fadeOut(2000);
            }, 4000);
        }
    }

    function copy_field(fieldId) {
    // Check if the element exists
    if ($(fieldId).length) {
        // Select the value of the input field
        const value = $(fieldId).val();
        
        // Create a temporary textarea element
        const tempTextarea = $('<textarea>');
        $('body').append(tempTextarea);
        tempTextarea.val(value).select();
        
        // Copy the value to the clipboard
        document.execCommand('copy');
        
        // Remove the temporary textarea element
        tempTextarea.remove();
        
        // Optionally, you can notify the user
        notify('success', 'Copied to clipboard.');
    } else {
        //console.error('Element not found:', fieldId);
    }
    }
</script>

@yield('content-script-1')   
@yield('content-script')

</body>

</html>
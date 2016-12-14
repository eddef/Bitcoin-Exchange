var site_url = "http://localhost/";
var alert_close = '<button type="button" class="close alert-close"><i class="fa fa-close"></i></button>';

function ajax_error(data)
{
	$('#error_message').html(data + alert_close).show();
}

function show_loader()
{
	$('.showLoader').show();
}

function hide_loader()
{
	$('.showLoader').hide();
}

$(function()
{
    $('#generateapi').on("submit",function()
    {
        show_loader();

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(data) 
            {
                if(data.success)
                {
                   location.href = site_url + "api/api/";
                }
                else
                {
                   $('#error_message').html(data.error + alert_close).show();
                }
               
               hide_loader();

            }, error: function(data)
            {
                 $('#error_message').html("Unknown error" + alert_close).show();
                 hide_loader();
            }
        });
        return false;
    });

    $('.deleteapi').on("click",function()
    {
        show_loader();
        var api_id = $(this).attr('id');

        $.ajax({
            url: $(this).attr('href'),
            dataType: 'json',
            success: function(data) 
            {
                if(data.success)
                {
                   $('#api-' + api_id).remove();
                }
                else
                {
                   $('#error_message').html(data.error + alert_close).show();
                }
               
               hide_loader();

            }, error: function(data)
            {
                 $('#error_message').html("Unknown error" + alert_close).show();
                 hide_loader();
            }
        });
        return false;
    });

    $('#register-form').on("submit", function() 
    {
        if ($('#terms').is(':checked')){
            var checkboxterms = 'yes';
        } 
        else {
            var checkboxterms = 'no';
        }

        show_loader();

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(data) 
            {
                if(data.success)
                {
                   location.href = site_url + "dashboard";
                }
                else
                {
                   $('#error_message').html(data.error + alert_close).show();
                }
               
               hide_loader();

            }, error: function(data)
            {
                 $('#error_message').html("Unknown error" + alert_close).show();
                 hide_loader();
            }
        });
        return false;
    });

    $('#login-form').on("submit", function()
    {
        show_loader();

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(data)
            {
                if(data.success)
                {
                   location.href = site_url + "dashboard";
                }
                else
                {
                   $('#error_message').html(data.error + alert_close).show();
                }
               
               hide_loader();

            }, error: function(data)
            {
                 $('#error_message').html("Unknown error" + alert_close).show();
                 hide_loader();
            }
        });
        return false;
    });

    jQuery(document).ready(function ($)
    {
        $('#pass').keypress(function (e) {
            var s = String.fromCharCode(e.which);
            if (s.toUpperCase() === s && s.toLowerCase() !== s && !e.shiftKey) {
                document.getElementById('capslock').style.visibility = 'visible';
            } else {
                document.getElementById('capslock').style.visibility = 'hidden';
            }
        })
    });
})
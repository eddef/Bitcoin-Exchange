<?php
/*
 * This is where all the javascript goes when I clean up the view files, then it will be put inside another file and used
 * I just put it here so I know what it's for and where it goes. This file is not linked anywhere.
*/
<script>
$(function()
{
    $('#addguide').on("submit", function()
    {
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            success: function(data),
            {
                if(data.success)
                {
                    location.href = "<?php echo ADMIN_SURL; ?>";
                }
                else
                {
                   $('.error_message').html(data.error + alert_close).show();
                }
                $('.ajloading').hide();
            }, error: function(data)
            {
                $('.ajloading').hide();
            }
        });
        return false;
    });
});
</script>


<script>
    $(function ()
    {
        $("#bitcoindecrement").click(function ()
        {
            $("input#withdrawbitcoinfee").val($("input#withdrawbitcoin").val());
        });
    });
    $(function ()
    {
        $("#bitcoinincrement").click(function ()
        {
            $("input#withdrawbitcoinfee").val($("input#withdrawbitcoin").val());
        });
    });
</script>
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
                    location.href = "<?php echo ADMI_NSITE_URL; ?>";
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
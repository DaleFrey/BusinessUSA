<style> 
    .region-content {
        width: 100%;
    }
    .liveinput {
        min-height: 150px;
        width: 100%;
    } 
    .livearea {
        margin-top: 10px; border: 3px solid gray; padding: 15px;
    } 
</style>

<script> 
    jQuery(document).ready( function () { 
        targetLiveDiv = jQuery('.livearea').eq(0); 
        jQuery('.liveinput').bind('keyup keydown change', function () { 
            updateLiveArea(); 
        }); 
        updateLiveArea(); 
    }); 
    
    function updateLiveArea() { 
        var givenHTML = jQuery('.liveinput').val();
        targetLiveDiv.html( givenHTML ); 
    } 
</script>

<textarea class="liveinput">
    <h3>Welcome to the real-time HTML editor!</h3>
    <i>Type</i> or <i>paste</i> in HTML into <b>this textarea</b>, and the markup will instantly appear <b>below</b>.
</textarea>

<div class="livearea"></div>
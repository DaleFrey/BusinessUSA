<?php ob_start(); ?>

<?php

    print theme(
            'yawizard_from_excel', 
            array(
                'path' => overridable('sites/all/pages/browseregulations/wizard-questions.xls'),
                'resultsURL' => '/browseregulations/wizard-results'
            )
    );

?>

<div class="vendorLightBox" style="display: none;" rendersource="<?php print basename(__FILE__); ?>">
    <div rendersource="<?php print basename(__FILE__); ?>">
        <div class="ovendorLightBoxWrapper">
            <!-- Logo -->
            <div class="vendorLightBox-logo">
                <div class="kill-vendorLightBox" onclick="jQuery.colorbox.close();">
                    Close
                </div>
                <div class="vendorLightBox-logo-innerwrapper">
                    <img src="/sites/all/themes/bizusa/images/logo.png" />
                </div>
            </div>
            <div class="vendorLightBox-msg-area">
                <p>Please enter keyword(s) to refine your results.</p>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        var textbox = $(':input#wiztag-keyword_textbox[type="text"]');
        var btnContinue = $('a.wizard-continue');
        var nextSlide = $('.next-visible-slide-is-untouched.slide-last-visible a');
        var nextTab = $('div.tabs .wizard-next');
        var defaultText = 'Enter Keyword(s)';
        textbox.val(defaultText);
        btnContinue.removeAttr('onclick');
        btnContinue.removeAttr('href');
        btnContinue.attr('style','cursor: pointer;');
        btnContinue.bind('click',function(){
            if (textbox.val() != '' && textbox.val() != defaultText){
                yawizard.next();
            }
            else{
                DisplayColorBox();
                e.stopPropagation();
            }
        });

        if (nextSlide != 'undefined'){
            nextSlide.removeAttr('href');
            nextSlide.attr('style','cursor: pointer;');
            nextSlide.bind('click',function(){
                if (textbox.val() != '' && textbox.val() != defaultText){
                    yawizard.seek(2);
                }
                else{
                    DisplayColorBox();
                    e.stopPropagation();
                }
            });
        }

        if (nextTab != 'undefined'){
            nextTab.removeAttr('href');
            nextTab.attr('style','cursor: pointer;');
            nextTab.bind('click',function(){
                if (textbox.val() != '' && textbox.val() != defaultText){
                    yawizard.next();
                }
                else{
                    DisplayColorBox();
                    e.stopPropagation();
                }
            });
        }

        textbox.focus(function(){
            if ($(this).val() == defaultText){
                $(this).val('');
            }
        });

        textbox.blur(function(){
            if ($(this).val() == ''){
                $(this).val(defaultText);
            }
        });
    });

    function DisplayColorBox(){
        jQuery.colorbox({
            html: $('.vendorLightBox').html(),
            overlayClose: false,
            escKey: false,
            onLoad: function () {
                jQuery('#cboxClose').remove();
            }
        });
    }
</script>

<?php
    if ( !empty($_GET['widget']) && intval($_GET['widget']) === 1 ) {
        global $overrideBodyMarkup;
        $overrideBodyMarkup = ob_get_contents();
        ob_end_clean();
    } else {
        ob_end_flush();
    }
?>
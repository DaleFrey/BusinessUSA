<!-- START: ShareWidget (rendered from sharewidget.tpl.php) /* Coder Bookmark: CB-9V1WB48-BC */ -->

<?php if ( function_exists('getShareCounter') ): ?>

    <div id="shareWidget" class="<?php print $variables['addClasses'] ?>">
        <?php if ( $variables['expandable'] === true ): ?>
            <a href="#" onclick="getShareURL( function() { jQuery('.sharewidget-popup').fadeToggle(); });" class="sharewidget-toggler" rendersource="sharewidget.tpl.php">
                Share
                <span class="number"><?php print getShareCounter($_SERVER['REQUEST_URI'], 'total'); ?></span>
            </a>
        <?php endif; ?>
        <div class="sharewidget-popup <?php if ( $variables['expandable'] !== true ) { print 'always-show-important'; } ?>" style="<?php if ( $variables['expandable'] === true ) { print 'display: none;'; } ?>" rendersource="sharewidget.tpl.php">
            <div class="sharewidget-popup-body" rendersource="sharewidget.tpl.php">
                <a style="cursor: pointer;" class="email">
                    <?php if ( $variables['showCounters'] ): ?>
                        <span>
                            <?php print getShareCounter($_SERVER['REQUEST_URI'], 'mail'); ?>
                        </span>
                    <?php endif; ?>
                </a>
                <a style="cursor: pointer;" class="facebook">
                    <?php if ( $variables['showCounters'] ): ?>
                        <span>
                            <?php print getShareCounter($_SERVER['REQUEST_URI'], 'facebook'); ?>
                        </span>
                    <?php endif; ?>
                </a>
                <a style="cursor: pointer;" class="twitter">
                    <?php if ( $variables['showCounters'] ): ?>
                        <span>
                            <?php print getShareCounter($_SERVER['REQUEST_URI'], 'twitter'); ?>
                        </span>
                    <?php endif; ?>
                </a>
                <a style="cursor: pointer;" class="linkedin">
                    <?php if ( $variables['showCounters'] ): ?>
                        <span>
                            <?php print getShareCounter($_SERVER['REQUEST_URI'], 'linkedin'); ?>
                        </span>
                    <?php endif; ?>
                </a>
            </div>
        </div>
    </div>
    <div id="shareWidgetEMailSelector" style="display: none;" rendersource="<?php print basename(__FILE__); ?>">
        <div class="share-emailselector-colorbox" style="background-color: white">
            <div class="colorbox-logo">
                <div class="wizard-email-kill-colorbox" onclick="jQuery.colorbox.close();">
                    Close
                </div>
                <div class="colorbox-logo-innerwrapper">
                    <img src="/sites/all/themes/bizusa/images/logo.png">
                </div>
            </div>
            <div class="share-emailselector-message-container">
            <div class="share-emailselector-message">
                Select which email service you want to send an email with
            </div>
            <input type="button" value ="GMail" onclick="shareWidget_ShareOverEMail('gmail');" />
            <input type="button" value ="YMail" onclick="shareWidget_ShareOverEMail('ymail');" />
            <input type="button" value ="Outlook" onclick="shareWidget_ShareOverEMail('outlook');" />
            </div>
        </div>
    </div>

    <script rendersource="<?php print basename(__FILE__); ?>">
        
        if ( typeof getShareURL != 'function' ) {
            getShareURL = function (callback) {
                callback('<?php print "http://business.usa.gov" . request_uri(); ?>');
            }
        }
        
        function shareWidget_ShareOverEMail(emailService) { /* Coder Bookmark: CB-DU9P6GA-BC */
            
            shareEmailService = emailService
            getShareURL( function (shareURL) {
            
                phpFunction('incrementShareCounter', [String(document.location.pathname), 'mail']);
                var emailMsg = <?php print json_encode($variables['emailShareBody']); ?>;
                //emailMsg = emailMsg.replace('{s}', '(s)');
                emailMsg = emailMsg.replace('-URL-HERE-', shareURL);

                switch(shareEmailService) {
                    case 'gmail':
                        window.open('https://mail.google.com/mail/?view=cm&fs=1&subject=<?php print rawurlencode($variables['emailShareSubject']); ?>&body=' + escape(emailMsg) + '&tf=1');
                        break;
                    case 'ymail':
                        window.open('http://compose.mail.yahoo.com?subject=<?php print rawurlencode($variables['emailShareSubject']); ?>&body=' + escape((emailMsg)));
                        break;
                    case 'outlook':
                        window.open('http://mail.live.com/default.aspx?rru=compose&subject=<?php print rawurlencode($variables['emailShareSubject']); ?>&to=&body=' + escape(emailMsg));
                        break;
                    default:
                        alert('Error in shareWidget_ShareOverEMail(), unknown emailService Coder Bookmark: CB-P771VWB-BC');
                }
            
            });
        }

        jQuery(document).ready(function() {
            $( ".sharewidget-toggler").unbind( "click" );//unbind previous click events to prevent multiple firings
            jQuery(".sharewidget-toggler").bind("click",function(e){
                jQuery(this).toggleClass("sharewidget-toggler-active");
                if( ($('.sharewidget-popup').is(":visible")) && ($('#exportexcelWidget-popup').is(":visible")))
                    {
                        $('#exportexcelWidget-popup').fadeOut();
                    }
            });
            jQuery('.sharewidget-popup .email').bind('click', function () { /* Coder Bookmark: CB-EPG06R1-BC */
                jQuery.colorbox({
                    html: jQuery('.share-emailselector-colorbox').eq(0).html(),
                    onOpen: function () { 
                        jQuery('[id=colorbox]:visible').addClass('sharecontent-colorboxinstance'); 
                    }
                });
            });
        
            jQuery('a.email').bind('click', function () {
                jQuery.colorbox({
                    html: jQuery(this).parents('.sharecontent-mastercontainer').find('.sharecontent-colorboxcontents-container').html(),
                    onOpen: function () {
                        jQuery('[id=colorbox]:visible').addClass('sharecontent-colorboxinstance');
                    }
                });
                jQuery('.sharecontent-dropdown-container-outter').hide();
            });
            
            jQuery('a.facebook').bind('click', function(){
                getShareURL( function(shareURL) {
                    phpFunction('incrementShareCounter', [String(document.location.pathname), 'facebook'])
                    window.open('https://www.facebook.com/sharer/sharer.php?url=' + shareURL, '_blank', 'toolbar=0,location=0,menubar=0');
                });
            });

            jQuery('a.twitter').bind('click', function(){
                getShareURL( function(shareURL) {
                    phpFunction('incrementShareCounter', [String(document.location.pathname), 'twitter'])
                    window.open('http://www.twitter.com/share?url=' + shareURL, '_blank', 'toolbar=0,location=0,menubar=0');
                });
            });

            jQuery('a.linkedin').bind('click', function(){
                getShareURL( function(shareURL) {
                    phpFunction('incrementShareCounter', [String(document.location.pathname), 'linkedin'])
                    window.open('http://www.linkedin.com/cws/share?url=' + shareURL, '_blank', 'toolbar=0,location=0,menubar=0');
                });
            });
        });
    </script>
    
<?php endif; ?>

<!-- END: ShareWidget (rendered from sharewidget.tpl.php) /* Coder Bookmark: CB-9V1WB48-BC */ -->

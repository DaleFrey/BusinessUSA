<?php 

    // Load user information
    if ( empty($_GET['uid']) || intval($_GET['uid']) === 0 ) {
        while (@ob_end_clean());
        print "Error - Missing the uid URL-query parameter in this page request.";
        exit();
    }
    $userInfo = user_load(intval($_GET['uid']));
    define('TOKEN', 'GZTUH36TuANl/WpKHZRRhOu6/mjOkhVvh0PcRArcVHPMpadl4MnHzYaDm3Igl2GL/v3gfYMuMCqDaDHMVv5k0w==');
    define('PARATURE_BASE_URL', 'https://help.business.usa.gov/api/v1/30027/30030');
    $badChars = array(chr(239), chr(187), chr(191));
    $tickets = getParatureTickets($userInfo->mail, $badChars); 

?>

<?php if( count($tickets) < 1 ): ?>
    
    <?php //drupal_goto('<front>'); ?>
    
<?php else: ?>
    
    <h1 class="welcome-header">
        <span>Hello <?php print $userInfo->field_myusa_firstname['und'][0]['value']; ?>!</span> Welcome back to your own personal domain!
    </h1>
    
    <div class="userdashboard-section-container userdashboard-section-container-support">
        <div class="userdashboard-section-titlebar">
            <h2 class="userdashboard-section-titlebar-title">
                Support
            </h2>
        </div>
        <div class="userdashboard-section-body" rendersource="<?php print basename(__FILE__); ?>">
            <div class="userdashboard-section-subbody userdashboard-section-subbody-support" rendersource="<?php print basename(__FILE__); ?>">
                <?php foreach ( $tickets as $ticket ): ?>
                    
                    <?php 
                        $ticketUrl = $ticket->{'@service-desk-uri'};
                        $summary = $ticket->Custom_Field[0]->{'#text'};
                        $ticketDate = new DateTime($ticket->Date_Created->{'#text'});
                        $ticketDate = $ticketDate->format('m-d-y');
                        $ticketNumber = $ticket->{'@id'};
                    ?>
                    
                    <div class="parature-ticket" rendersource="<?php print basename(__FILE__); ?>">
                        <div class="parature-information-container">
                            <span class="parature-ticket-text"><?php print $ticketDate; ?></span>
                            <span class="parature-ticket-text"><?php print $ticketNumber; ?></span>
                            <span class="parature-ticket-text">
                                <!--a href="<?php print $ticketUrl; ?>" target="_blank"--><?php print $summary; ?><!--/a-->
                            </span>
                        </div>
                        
                       <?php if ( $ticket->Ticket_Status->Status->Name->{"#text"}  !== "Closed" ): ?>
                          <span class="parature-ticket-status-open">
                              <!--a href="<?php print $ticketUrl; ?>" target="_blank"-->Open<!--/a-->
                          </span>
                       <?php else: ?>
                            <span class="parature-ticket-status-closed">
                                <!--a href="<?php print $ticketUrl; ?>" target="_blank" -->Closed<!--/a-->
                            </span>
                        <?php endif; ?>
                        
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    
<?php endif; ?>
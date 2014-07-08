<?php $tickets = getParatureTickets($userInfo->mail, $badChars); ?>

<?php if( count($tickets) > 0 ): ?>

    <?php foreach ( array_slice($tickets, 0, 4) as $ticket ): ?>
        
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
    
    <div class="parature-createtickets-container">
        <a href="http://help.business.usa.gov/ics/support/ticketnewwizard.asp?style=classic&deptID=30030&">
            Create a Ticket
        </a>
    </div>
    
    <?php if ( count($tickets) > 4 ): ?>
        <div class="parature-viewalltickets-container">
            <a href="/user-dashboard/all-parature-tickets?uid=<?php print $userInfo->uid; ?>" class="parature-viewalltickets">
                View All
            </a>
        </div>
    <?php endif; ?>
    
<?php else: ?>

        <div class="not-parature-ticketsr" rendersource="<?php print basename(__FILE__); ?>">
           <a href="http://help.business.usa.gov/ics/support/ticketnewwizard.asp?style=classic&deptID=30030&" class="ask" >
               Ask a Question
           </a>
       </div>
   
<?php endif; ?>
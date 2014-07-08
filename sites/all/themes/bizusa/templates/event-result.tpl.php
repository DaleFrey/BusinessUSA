<?php
    $dtStart = new DateTime( $event->field_event_date['und'][0]['value'] . ' UTC');
    $dtStart->setTimezone( new DateTimeZone('America/New_York') );
    $dtEnd = new DateTime( $event->field_event_date['und'][0]['value2'] . ' UTC');
    $dtEnd->setTimezone( new DateTimeZone('America/New_York') );
    $gcalDateStart = $dtStart->format("Ymd\\This\\Z");
    $gcalDateEnd = $dtEnd->format("Ymd\\This\\Z");
    $ycalDateStart = $dtStart->format("Ymd\\This");
    $ycalDateEnd = $dtEnd->format("Ymd\\This");
    $busaURL = 'http://business.usa.gov/' . $event->nid;
    $calLocation = '';
    $address = $event->field_event_address_1['und'][0]['safe_value'];
    $address2 = $event->field_event_address_2['und'][0]['safe_value'];
    $city = $event->field_event_city['und'][0]['safe_value'];
    $state = $event->field_event_state['und'][0]['safe_value'];
    $zip = $event->field_event_zip['und'][0]['safe_value'];
    $description = $event->field_event_detail_desc['und'][0]['value'];
    $targetLatitude = (float) $event->field_event_latitude['und'][0]['safe_value'];
    $targetLongitude = (float) $event->field_event_longitude['und'][0]['safe_value'];
    $nid = $event->nid;
    $title = $event->title;
    if (!empty($address))  $calLocation .= $address . ', ';
    $calLocation = urlencode($calLocation);
    $calDetail = '';
    if ( !empty($description) ) {
        $calDetail = substr($description, 0, 100) . '...';
    }
    $calDetail = urlencode($calDetail);


    $gcalLink = "https://www.google.com/calendar/render?action=TEMPLATE&text=$title&dates=$gcalDateStart/$gcalDateEnd&sprop=website:$busaURL&location=$calLocation&details=$calDetail";
    $ycalLink = "http://calendar.yahoo.com/?v=60&TITLE=$title&ST=$ycalDateStart&ET=$ycalDateEnd&URL=$busaURL&in_loc=$calLocation&DESC=$calDetail";
?>
 <div class="events-row">
    <div class="eventscolumn-left">
        <div class="event-calendar">
            <div class='month'><?php echo $dtStart->format('M'); ?></div><div class='day'><?php echo $dtStart->format('d'); ?></div>
        </div>
        <div class="event-calendarlinks">
            <div class="calendar-icon-container calendar-outlook">
                <a href="/ical/<?php print $nid; ?>/calendar.ics">
                    <img class="ical" src="/sites/all/themes/bizusa/images/outlook_cal.png" />
                </a>
            </div>
            <div class="calendar-icon-container calendar-gcal">
                <a href="<?php print $gcalLink; ?>">
                    <img class="gcal" src="/sites/all/themes/bizusa/images/gcal.png" />
                </a>
            </div>
            <div class="calendar-icon-container calendar-ycal">
                <a href="<?php print $ycalLink; ?>">
                    <img class="ycal" src="/sites/all/themes/bizusa/images/ycal.png" />
                </a>
            </div>
        </div>
    </div>

    <div class="eventscolumn-right">
        <div class="event-title">
            <a href="/node/<?php print $nid; ?>">
                <?php print $title; ?>
            </a>
        </div>
        <div class="event-date-time">
            <?php
            if ( $dtStart->format('Ymd') == $dtStart->format('dtEnd') ) { // If this event starts and ends on the same day....
                print $dtStart->format('M dS, Y'). "<span>|</span>" . $dtStart->format('h:ia - ') . $dtEnd->format('h:ia');
            } else {
                print $dtStart->format('M dS, Y') . ' to ' . $dtEnd->format('M dS, Y') . "<span>|</span>" . $dtStart->format('h:ia - ') . $dtEnd->format('h:ia');
            }
            ?>
        </div>
        <div class="event-location">
          <?php if (!empty($address)): ?>
            <div class="event-where">
                Where:
            </div>
            <div class="event-address">
                <?php print $address; ?>
            </div>
          <?php endif; ?>
            <div class="event-citystatezip">
                <?php
                $addr = '';
                if (!empty($address2)) {
                    if ($addr !== '') $addr .= ', ';
                    $addr .= $address2;
                }
                if (!empty($city)) {
                    if ( $addr !== '' ) $addr .= ', ';
                    $addr .= $city;
                }
                if (!empty($state)) {
                    if ( $addr !== '' ) $addr .= ', ';
                    $addr .= $state;
                }
                if (!empty($zip)) {
                    if ( $addr !== '' ) $addr .= ' ';
                    $addr .= $zip;
                }
                print $addr;
                ?>
            </div>
        </div>

        <div class="event-descr">
            <?php print truncate_utf8(strip_tags(htmlspecialchars_decode($description)), 289, true, true); ?>
            <a href="javascript:void(0)" onclick="expanddesc(this)" class="viewmoreanc">Read more</a>
        </div>

        <div class="event-descr" style="display:none">
            <?php print strip_tags(htmlspecialchars_decode($description)); ?>
            <a href="javascript:void(0)" onclick="expanddesc(this)" class="viewmoreanc">Read less</a>

        </div>
    </div>
    <div class='google-map'>
        <?php
        $variables = array('targetLatitude' => $targetLatitude, 'targetLongitude' => $targetLongitude, 'title' => $title, 'count' => $variables['id'] - 1, 'hideMap' => TRUE);
        if($targetLatitude && $targetLongitude) print theme('google_map', $variables);
        ?>
    </div>
</div>

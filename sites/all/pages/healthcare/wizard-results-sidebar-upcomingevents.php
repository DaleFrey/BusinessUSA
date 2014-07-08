<?php
    $webinars = array(
      mktime(14, 0, 0, 7, 3, 2014) => 'https://cc.readytalk.com/cc/s/registrations/new?cid=eo5rrngg9ekw',
      mktime(14, 0, 0, 7, 10, 2014) => 'https://cc.readytalk.com/cc/s/registrations/new?cid=4ti7f74pxj6p',
      mktime(14, 0, 0, 7, 17, 2014) => 'https://cc.readytalk.com/cc/s/registrations/new?cid=ec6udkh29pp4',
      mktime(14, 0, 0, 7, 24, 2014) => 'https://cc.readytalk.com/cc/s/registrations/new?cid=w97jrcbvlshh',
      mktime(14, 0, 0, 7, 31, 2014) => 'https://cc.readytalk.com/cc/s/registrations/new?cid=xxi790c2qvgf',
      mktime(14, 0, 0, 8, 7, 2014) => 'https://cc.readytalk.com/cc/s/registrations/new?cid=u50tt2wzx4vt',
      mktime(14, 0, 0, 8, 14, 2014) => 'https://cc.readytalk.com/cc/s/registrations/new?cid=8xl4sxts1ouf',
      mktime(14, 0, 0, 8, 21, 2014) => 'https://cc.readytalk.com/cc/s/registrations/new?cid=vf8yf56satud',
    );
?>

<h2 class="sidebar-upevents-title expanded" onclick="jQuery('.sidebar-upevents-body').slideToggle(); jQuery('.sidebar-upevents-title').toggleClass('expanded'); jQuery('.sidebar-upevents-title').toggleClass('collapsed');">
    Upcoming Events
    <img class="downarrow" src="/sites/all/themes/bizusa/images/downarrow.png" />
    <img class="uparrow" src="/sites/all/themes/bizusa/images/uparrow.png" />
</h2>

<div class="sidebar-upevents-body sidebar-body collapsed">
        <ul class="sidebar-upevents-list">
            <li>
                <a target="_blank" href="https://www.youtube.com/watch?v=FKMrBY--kSE&list=PLrwM1ZVcvDha2z8kvYx_wuW3uQxy58BEZ">
                    Affordable Care Act Audio Webinar
                </a>
            </li>
            <?php foreach ( array_slice($webinars, 0, 2, true) as $webinarUnixTime => $webinarLink ): ?>
                <?php if ( time() < $webinarUnixTime ): ?>
                    <li class="sidebar-upevents-li">
                        <a href="<?php print $webinarLink; ?>">
                            Affordable Care Act 101 Webinar - <?php print date('M jS', $webinarUnixTime); ?>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        <ul class="sidebar-upevents-list-sliding" style="display: none;">
            <?php foreach ( array_slice($webinars, 2, null, true) as $webinarUnixTime => $webinarLink ): ?>
                <?php if ( time() < $webinarUnixTime ): ?>
                    <li class="sidebar-upevents-li">
                        <a href="<?php print $webinarLink; ?>">
                            Affordable Care Act 101 Webinar - <?php print date('M jS', $webinarUnixTime); ?>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        <a class="viewmoreless" href="javascript: jQuery('.sidebar-upevents-list-sliding').slideToggle(); jQuery('.sidebar-upevents-body').toggleClass('expanded'); jQuery('.sidebar-upevents-body').toggleClass('collapsed'); void(0);">
            View
            <span class="more">More</span>
            <span class="less">Less</span>
        </a>
</div>
<?php
$spanish_webinars = array(
  mktime(16, 0, 0, 7, 8, 2014) => 'https://cc.readytalk.com/cc/s/registrations/new?cid=i1xxrs4us2pq',
  mktime(16, 0, 0, 7, 22, 2014) => 'https://cc.readytalk.com/cc/s/registrations/new?cid=ec8cdctd8ydg',
  mktime(16, 0, 0, 8, 5, 2014) => 'https://cc.readytalk.com/cc/s/registrations/new?cid=oe8q957l2n0r',
  mktime(16, 0, 0, 8, 19, 2014) => 'https://cc.readytalk.com/cc/s/registrations/new?cid=llb3918xp9ul',
  mktime(16, 0, 0, 9, 9, 2014) => 'https://cc.readytalk.com/cc/s/registrations/new?cid=ojtsoh82g4jl',
  mktime(16, 0, 0, 9, 23, 2014) => 'https://cc.readytalk.com/cc/s/registrations/new?cid=55j392hvqw2g',
  mktime(16, 0, 0, 10, 7, 2014) => 'https://cc.readytalk.com/cc/s/registrations/new?cid=el90f2q9kzho',
  mktime(16, 0, 0, 10, 21, 2014) => 'https://cc.readytalk.com/cc/s/registrations/new?cid=o1nn9cnjkckp',
  mktime(16, 0, 0, 11, 4, 2014) => 'https://cc.readytalk.com/cc/s/registrations/new?cid=9h1kbt4j14u2',
  mktime(16, 0, 0, 11, 18, 2014) => 'https://cc.readytalk.com/cc/s/registrations/new?cid=op6comzvgw9n',
  mktime(16, 0, 0, 12, 2, 2014) => 'https://cc.readytalk.com/cc/s/registrations/new?cid=99sjn0wt8vjp',
  mktime(16, 0, 0, 12, 6, 2014) => 'https://cc.readytalk.com/cc/s/registrations/new?cid=2goedph11gvu',
);
?>

<h2 class="sidebar-upevents-title-sp expanded" onclick="jQuery('.sidebar-upevents-body-sp').slideToggle(); jQuery('.sidebar-upevents-title-sp').toggleClass('expanded'); jQuery('.sidebar-upevents-title-sp').toggleClass('collapsed');">
  Upcoming Events In Spanish
  <img class="downarrow" src="/sites/all/themes/bizusa/images/downarrow.png" />
  <img class="uparrow" src="/sites/all/themes/bizusa/images/uparrow.png" />
</h2>

<div class="sidebar-upevents-body-sp sidebar-body collapsed">
  <ul class="sidebar-upevents-list">
    <?php foreach ( array_slice($spanish_webinars, 0, 2, true) as $webinarUnixTime => $webinarLink ): ?>
      <?php if ( time() < $webinarUnixTime ): ?>
        <li class="sidebar-upevents-li">
          <a href="<?php print $webinarLink; ?>">
            Affordable Care Act 101 Webinar (Spanish) - <?php print date('M jS', $webinarUnixTime); ?>
          </a>
        </li>
      <?php endif; ?>
    <?php endforeach; ?>
  </ul>
  <ul class="sidebar-upevents-list-sliding-sp" style="display: none;">
    <?php foreach ( array_slice($spanish_webinars, 2, null, true) as $webinarUnixTime => $webinarLink ): ?>
      <?php if ( time() < $webinarUnixTime ): ?>
        <li class="sidebar-upevents-li">
          <a href="<?php print $webinarLink; ?>">
            Affordable Care Act 101 Webinar (Spanish) - <?php print date('M jS', $webinarUnixTime); ?>
          </a>
        </li>
      <?php endif; ?>
    <?php endforeach; ?>
  </ul>
  <a class="viewmoreless" href="javascript: jQuery('.sidebar-upevents-list-sliding-sp').slideToggle(); jQuery('.sidebar-upevents-body-sp').toggleClass('expanded'); jQuery('.sidebar-upevents-body-sp').toggleClass('collapsed'); void(0);">
    View
    <span class="more">More</span>
    <span class="less">Less</span>
  </a>
</div>

<style>
  .sidebar-upevents-title-sp {
    clear: left;
  }
  .sidebar-upevents-body {
    margin-bottom: 30px;
  }
</style>

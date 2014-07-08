
<?php
    // Users accessing this page MUST access it over secure HTTPS, since the IFrame point to HTTPS targets
    // It is a requierment that the SizeUp IFrame point to a HTTPS target (requested by the SizeUp team)
    if ( empty($_SERVER['HTTPS']) ) {
        drupal_goto('https://business.usa.gov/sizeup');
    }
?>

<!-- The following styles are located in size-up-landing-page.tpl.php -->
<style>
    .sizeup-landingpage-welcome-message {
        padding-bottom: 25px;
    }
    .sizeup-landingpage-iframe-container {
        border: 1px solid black;
        width: 74%;
    }
    .responsive-layout-narrow .sizeup-landingpage-iframe-container{
        width: auto;
    }
    .sizeup-landingpage-iframe-container iframe {
        width: 100% !important;
    }
    .sizeup-landingpage-rightside {
        float: right;
        width: 20%;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        margin: 10px;
    }
    .responsive-layout-narrow .sizeup-landingpage-rightside {
        float: left;
        width:172px;
        margin-left:0px;
        margin-right:10px;
        padding:10px;
    }
    .sizeup-landingpage-rightside-first {
        margin-top: 0px;
    }
    .responsive-layout-narrow .sizeup-landingpage-rightside-first {
        margin-top: 10px;
    }
    .responsive-layout-narrow .sizeup-landingpage-rightside.sizeup-landingpage-rightside-advertise{
        margin-right:0px; 
    }
</style>

<div class="sizeup-landingpage-container">

    <div class="sizeup-landingpage-welcome-message">
        SizeUp will help you manage and grow your business by benchmarking it against competitors, mapping your customers, competitors and suppliers, and locating the best places to advertise.<br/>
        <br/>
        Note: The tool is not supported by Internet Explorer 6.0 & 7.0. Please use one of the supported browsers (IE 8.0, IE 9.0, Firefox, Chrome).
    </div>
    
    <!-- SizeUp IFrame -->
    <div class="sizeup-landingpage-iframe-container" style="float: left;">
        <span><a href="https://www.sizeup.com" target="_blank">SizeUp</a></span>
        <script type="text/javascript" src="https://www.sizeup.com/widget/get?key=B6F3DC18-86B9-4177-BC5F-2C77F0642F94"></script>
    </div>
    
    <!-- Right-Sidebar - Benchmark your business -->
    <div class="sizeup-landingpage-rightside sizeup-landingpage-rightside-benchmark sizeup-landingpage-rightside-first">
        <h3>Benchmark your business</h3>
        <p>See how your business sizes up by comparing your performance to all other competitors in your industry.</p>
        <p>
            <a class="ui-dialog-sizeup-benchmark" href="javascript: jQuery.colorbox({ width: '575px', html: jQuery('#benchmarkbizsourcecontainer').html() }); void(0);">Learn More</a>
        </p>
    </div>
    
    <!-- Right-Sidebar - Map your competition -->
    <div class="sizeup-landingpage-rightside sizeup-landingpage-map">
        <h3>Map your competition</h3>
        <p>Map where your competitors, customers, and suppliers are located. Isolate areas with many potential customers but little competition.</p>
        <p>
            <a class="ui-dialog-sizeup-benchmark" href="javascript: jQuery.colorbox({ width: '575px', html: jQuery('#competitioncontainer').html() }); void(0);">Learn More</a>
        </p>
    </div>
    
    <!-- Right-Sidebar - Find the best places to advertise -->
    <div class="sizeup-landingpage-rightside sizeup-landingpage-rightside-advertise">
        <h3>Find the best places to advertise</h3>
        <p>Choose from pre-set reports to find areas with the highest industry revenue, most underserved markets or create a custom demographic report.</p>
        <p>
            <a class="ui-dialog-sizeup-benchmark" href="javascript: jQuery.colorbox({ width: '575px', html: jQuery('#advertisecontainer').html() }); void(0);">Learn More</a>
        </p>
    </div>
    
    <!-- Colorbox Contents: Benchmark your business / "Learn More" -->
    <div id="benchmarkbizsourcecontainer" style="display: none;">
        <div id="benchmarkbizsource" style="height: 677px; width: 500px; padding: 15px;">
            <h3>Benchmark your business</h3>
            <p>
                <iframe title="Size up" allowfullscreen="" frameborder="0" height="598" mozallowfullscreen="" src=" https://player.vimeo.com/video/42735744" webkitallowfullscreen="" width="400"></iframe>
            </p>
            <p><strong>Transcript:</strong></p>
            <p>Let's say that you own a shoe store in Santa Clara, CA. What's a little bit of information you can provide to see how you size up against your competitors?</p>
            <p>We'll enter in the revenue of your business as $678,910. SizeUp supercrunches millions of data points to compare your shoe store against other shoe stores, and you can see that your shoe store makes less than the typical business in your city, county, metro, state, and the nation. Down below, you can see a heatmap. In red are the areas that have the highest average business annual revenue, and in yellow are areas where there is less. Santa Clara is in the center, and you can see that there are areas around Santa Clara that have higher average annual revenue; these may be places where you want to target your next advertising campaign or open a future store. Below are considerations and resources for your business.</p>
            <p>Now let's enter in the year you started. Let's say it opened in 1999. SizeUp plots the opening of shoe stores across the entire country. You may not be interested in the national or state data, in which case you can turn off those layers and focus on the local level, where in this case there's an upward trend of shoe stores opening in your metro.</p>
            <p>Now let's see if you are paying more or less than the typical shoe store for your employees. At $25,000 a year, SizeUp shows that you are paying more. The typical shoe store in your county pays a little over $19,000 a year. The map below shows the locations that have the highest salaries are in areas like Marin County and San Francisco.</p>
            <p>Let's now enter in that you have seven employees. SizeUp shows you that your shoe store is pretty typical in size.</p>
            <p>As you enter in information, SizeUp can create additional reports, for example, your cost effectiveness. Cost effectiveness is a measure of how much output you get relative to how much you're spending.</p>
            <p>We can also look at revenue per capita at the neighborhood level, and then zoom out to the regional, state, and even the national level.</p>
            <p>SizeUp also shows the local turnover rate for shoe stores. This report shows that about 14% of your employees are going to have to be replaced each year.</p>
            <p>Let's say that you spend $4,500 per employee per year on healthcare. You can see that you pay $191 more for healthcare on a per employee basis than a typical business of a similar size and in a similar industry. You can also enter in your workers' compensation rate.</p>
            <p>With just a few clicks, you can get an overall dashboard showing how your business sizes up to the competition.</p>
        </div>
    </div>
    
    <!-- Colorbox Contents: Map your competition / "Learn More" -->
    <div id="competitioncontainer" style="display: none;">
        <div class="sizeup-popup ui-dialog-content" id="competition" style="height: 677px; width: 500px;">
            <h3>Map your competition</h3>
            <p>			
                <iframe title="Competition frame" allowfullscreen="" frameborder="0" height="598" mozallowfullscreen="" src="https://player.vimeo.com/video/42735746" webkitallowfullscreen="" width="400"></iframe>
            </p>
            <p>
                <strong>Transcript:</strong>
            </p>
            <p>A successful business will want to know where their potential competitors, customers, and suppliers are. Let's say we're opening up a beauty salon in Beverly Hills. SizeUp will show you the locations of your competitors.</p>
            <p>We also know that we're going to target models, so we're going to focus on the talent agencies where they work so they can send their models over to us before their interviews. We'll input that as a business we sell to, which will display the locations of talent agencies nearby on the customers tab.</p>
            <p>We also know that we're going to buy beauty supplies, so we'll input that as a business category we buy from and SizeUp will map those nearby businesses on the suppliers tab.</p>
            <p>In an ideal world, what you want is a location that doesn't have a lot of competition, but has many potential customers. In orange, you can see areas where there are high concentrations of competitors. Visually on the map, you can also see areas in green where there are potential customers with not so many competitors nearby. By following this method, we can find a good location to open up a beauty salon.</p>
        </div>
    </div>
    
    <!-- Colorbox Contents: Find the best places to advertise / "Learn More" -->
    <div id="advertisecontainer" style="display: none;">
        <div class="sizeup-popup ui-dialog-content" id="advertise" style="height: 677px; width: 500px; display: block;">
            <h3>Find the best places to advertise</h3>
            <p>
                <iframe title="Advertize frame" allowfullscreen="" frameborder="0" height="598" mozallowfullscreen="" src="https://player.vimeo.com/video/42735745" webkitallowfullscreen="" width="400"></iframe>
            </p>
            <p><strong>Transcript:</strong></p>
            <p>A serious business will want to know where to market their products or services. Let's say we're a dentist in New York City. Where should we advertise? With just that information, SizeUp can show us that the areas with the highest total annual revenue for dental offices are just south of Central Park.</p>
            <p>But maybe we want to focus on a different opportunity and we want to find the areas that are most underserved. The report for Most Underserved Markets changes the map, showing that the best locations are in the Bronx and Springfield Gardens.</p>
            <p>Or perhaps you want to focus on a specific demographic of lower income households. Adjusting the advanced filters for income level, the map shows that the Bronx is still a good location, but also Newark, NJ.</p>
        </div>
    </div>
    
</div>

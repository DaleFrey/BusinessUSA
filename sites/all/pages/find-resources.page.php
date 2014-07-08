<style>
    /* START: Find Resouces Page CSS */


    #find-resources-page .left{
        float:left;
    }

    #find-resources-page .right{
        float:right;
    }

    #find-resources-page{
        background-color: #fff;
        width:910px;
        float: left;
        padding: 25px;
    }

    #find-resources-page h2{
        margin-top:30px;
        text-transform: capitalize;
    }

    #find-resources-page h3{
        font-weight: normal;
        margin-top: 0px;
        text-transform: capitalize;
    }

    #find-resources-page .gray-container{
        background-color: #EBEBEB;
        padding: 40px;
        height: 85px;
    }

    #find-resources-page .gray-container.width-50{
        margin-top: 20px;
        width:365px;
    }

    #find-resources-page .gray-container.width-50 img{
        display: block;
        float: left;
        padding: 5px 20px 25px 0px;
    }

    #find-resources-page .gray-container form input{
        float: none;
    }

    #find-resources-page .gray-container form input[type=text]{
        width: 650px;
        font-size: 20px;
    }

    #find-resources-page .gray-container form input[type=submit]{
        width: 90px;
        margin-left: 10px;
        font-size: 20px;
        cursor: pointer;
    }

    #find-resources-page .gray-container form input[type=submit]:hover{
        background-color: #15567B;
    }

    #find-resources-page .gray-container a.show-all{
        margin-top: 10px;
        display:block;
    }

 </style>


 <div id="find-resources-page" rendersource="find-resources.page.php">
    <div class="gray-container" style="padding-bottom:25px;">
        <?php
            $block = module_invoke('search', 'block_view', 'form');
            print render($block['content']);
        ?>
        <script rendersource="<?php print basename(__FILE__); ?>">
            jQuery('#find-resources-page form').attr('action', 'javascript: // ');
            jQuery('#find-resources-page form').bind('submit', function () {
                document.location = '/search/site/' + jQuery('#find-resources-page form input[type="text"]').val();
            })
        </script>
        <a href="search/site/" class="show-all" title="Show all resources">Show all resources</a>
    </div>

    <h2>Or, search by category</h2>

    <div class="gray-container width-50 left">

        <img src="/sites/all/themes/bizusa/images/Find-Resources-Images/content-type-icon-program.png">

        <h3>
            <a href="search/site/?f[0]=bundle%3Aprogram" title="Program">Programs</a>,
            <a href="search/site/?f[0]=bundle%3Aservices" title="Services">Services</a>,
            <a href="search/site/?f[0]=bundle%3Adata" title="Data">Data</a> or
            <a href="training-materials" title="Training">Training</a>
        </h3>

        <p>Learn how we are helping businesses through our programs, services and mentoring.</p>

    </div>

    <div class="gray-container width-50 right">

        <img src="/sites/all/themes/bizusa/images/Find-Resources-Images/content-type-icon-solicitations.png">

        <h3>
            <a href="search/site/?f[0]=bundle%3Agrants" title="Grants">Grants</a>,
            <a href="search/site/?f[0]=bundle%3Asolicitations" title="Solicitaions">Solicitations</a>,
            <a href="search/site/?f[0]=bundle%3Achallenges" title="Challenges">Challenges</a> or
            <a href="search/site/?f[0]=bundle%3Apatent" title="Patents">Patents</a>
        </h3>

        <p>Explore opportunities for your business.</p>

    </div>

    <div class="gray-container width-50 left">

        <img src="/sites/all/themes/bizusa/images/Find-Resources-Images/content-type-icon-event.png">

        <h3><a href="events" title="Events">Events</a></h3>
        <p>Learn what is happening for your industry, locale, or business.</p>

    </div>

    <div class="gray-container width-50 right">

        <img src="/sites/all/themes/bizusa/images/Find-Resources-Images/content-type-icon-tools.png">

        <h3>
            <a href="search/site/?f[0]=bundle%3Atools" title="Tools">Tools</a>,
            <a href="search/site/?f[0]=bundle%3Aarticle" title="Articles">Articles</a>,
            <a href="search/site/?f[0]=bundle%3Arules" title="Rules">Rules</a>
            or
            <a href="search/site/?f[0]=bundle%3Asuccess_story" title="Success Stories">Success Stories</a>
        </h3>

        <p>Other Great Stuff.</p>

    </div>

 </div>

 <script type="text/javascript">

 (function ($) {

    var Input = $("input[name=search_block_form]");
    var default_value = "Start Searching...";
    var set_default_value = Input.val(default_value);

    Input.focus(function() {
        if( Input.val() == default_value ) Input.val("");
    }).blur(function(){
        if( Input.val().length == 0 ) Input.val(default_value);
    });

  })(jQuery);

 </script>

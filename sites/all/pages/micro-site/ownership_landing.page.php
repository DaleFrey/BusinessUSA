<script>

function Statefullname(state)
{
    var statefull = '';
    switch (state)
    {
        case 'AL':
        {
            statefull = 'Alabama';
            break;
        }
        case 'AK':
        {
            statefull = 'Alaska';
            break;
        }
        case 'AS':
        {
            statefull = 'America Samoa';
            break;
        }
        case 'AZ':
        {
            statefull = 'Arizona';
            break;
        }
        case 'AR':
        {
            statefull = 'Arkansas';
            break;
        }
        case 'CA':
        {
            statefull = 'California';
            break;
        }
        case 'CO':
        {
            statefull = 'Colorado';
            break;
        }
        case 'CT':
        {
            statefull = 'Connecticut';
            break;
        }
        case 'DE':
        {
            statefull = 'Delaware';
            break;
        }
        case 'DC':
        {
            statefull = 'District of Columbia';
            break;
        }
        case 'FL':
        {
            statefull = 'Florida';
            break;
        }
        case 'GA':
        {
            statefull = 'Georgia';
            break;
        }

        case 'GU':
        {
            statefull = 'Guam';
            break;
        }
        case 'HI':
        {
            statefull = 'Hawaii';
            break;
        }
        case 'ID':
        {
            statefull = 'Idaho';
            break;
        }
        case 'IL':
        {
            statefull = 'Illinois';
            break;
        }
        case 'IN':
        {
            statefull = 'Indiana';
            break;
        }
        case 'IA':
        {
            statefull = 'Iowa';
            break;
        }
        case 'KS':
        {
            statefull = 'Kansas';
            break;
        }
        case 'KY':
        {
            statefull = 'Kentucky';
            break;
        }
        case 'LA':
        {
            statefull = 'Louisiana';
            break;
        }
        case 'ME':
        {
            statefull = 'Maine';
            break;
        }

        case 'MD':
        {
            statefull = 'Maryland';
            break;
        }
        case 'MA':
        {
            statefull = 'Massachusetts';
            break;
        }
        case 'MI':
        {
            statefull = 'Michigan';
            break;
        }
        case 'MN':
        {
            statefull = 'Minnesota';
            break;
        }
        case 'MS':
        {
            statefull = 'Mississippi';
            break;
        }
        case 'MO':
        {
            statefull = 'Missouri';
            break;
        }
        case 'MT':
        {
            statefull = 'Montana';
            break;
        }
        case 'NE':
        {
            statefull = 'Nebraska';
            break;
        }
        case 'NV':
        {
            statefull = 'Nevada';
            break;
        }

        case 'NH':
        {
            statefull = 'New Hampshire';
            break;
        }
        case 'NJ':
        {
            statefull = 'New Jersey';
            break;
        }
        case 'NM':
        {
            statefull = 'New Mexico';
            break;
        }
        case 'NY':
        {
            statefull = 'New York';
            break;
        }
        case 'NC':
        {
            statefull = 'North Carolina';
            break;
        }
        case 'ND':
        {
            statefull = 'North Dakota';
            break;
        }
        case 'MP':
        {
            statefull = 'Northern Mariana Islands';
            break;
        }
        case 'OH':
        {
            statefull = 'Ohio';
            break;
        }
        case 'OK':
        {
            statefull = 'Oklahoma';
            break;
        }
        case 'OR':
        {
            statefull = 'Oregon';
            break;
        }

        case 'PA':
        {
            statefull = 'Pennsylvania';
            break;
        }
        case 'PU':
        {
            statefull = 'Puerto Rico';
            break;
        }
        case 'RI':
        {
            statefull = 'Rhode Island';
            break;
        }
        case 'SC':
        {
            statefull = 'South Carolina';
            break;
        }
        case 'SD':
        {
            statefull = 'South Dakota';
            break;
        }
        case 'TN':
        {
            statefull = 'Tennessee';
            break;
        }
        case 'TX':
        {
            statefull = 'Texas';
            break;
        }
        case 'UT':
        {
            statefull = 'Utah';
            break;
        }
        case 'VT':
        {
            statefull = 'Vermont';
            break;
        }
        case 'VI':
        {
            statefull = 'Virgin Island';
            break;
        }
        case 'VA':
        {
            statefull = 'Virginia';
            break;
        }
        case 'WA':
        {
            statefull = 'Washington';
            break;
        }
        case 'WV':
        {
            statefull = 'West Virginia';
            break;
        }

        case 'WI':
        {
            statefull = 'Wisconsin';
            break;
        }
        case 'WY':
        {
            statefull = 'Wyoming';
            break;
        }
        default:
        {
            statefull ='';
        }
    }
    return statefull;
}
</script>

<!-- ****************   Main Content   **************** -->
<div class="microsite-sections-container">

    <div class="microsite-section-first">
        <div class="microsite-section-title">
            Programs
        </div>
        <?php if ($_GET['ownership'] === 'native'){?>

            <?php print views_embed_view('state_resource_view', 'state_resource_program', '%native american%', '%native_american%', 'Native American', 'American Indian & Native Alaskan', 'Native Alaskan', 'Native American'); ?>

        <?php } else if ($_GET['ownership'] === 'woman') { ?>
            <?php print views_embed_view('state_resource_view', 'state_resource_wizardresults_program', '%women%', 'Woman', 'Women'); ?>

        <?php } else if ($_GET['ownership'] === 'veteran') { ?>
            <?php print views_embed_view('state_resource_view', 'state_resource_wizardresults_program', '%veteran%', 'Veteran', 'Veterans'); ?>

        <?php } else if ($_GET['ownership'] === 'minority') { ?>
            <?php print views_embed_view('state_resource_view', 'state_resource_wizardresults_program', '%'.$_GET['ownership'].'%', 'Socially or economically disadvantaged', 'Minority'); ?>

        <?php  }  ?>
    </div>


    <div class="microsite-section">
        <div class="microsite-section-title">
            Services
        </div>
        <!--<?php print views_embed_view('state_resource_view', 'state_resource_service', $_GET['ownership']); ?>-->

        <?php if ($_GET['ownership'] === 'native'){?>

        <?php print views_embed_view('state_resource_view', 'state_resource_service', '%native american%', '%native_american%', 'Native American', 'American Indian & Native Alaskan', 'Native Alaskan', 'Native American'); ?>


        <?php } else if ($_GET['ownership'] === 'woman') { ?>
        <?php print views_embed_view('state_resource_view', 'state_resource_wizardresults_service', '%women%', 'Woman', 'Women'); ?>

        <?php } else if ($_GET['ownership'] === 'veteran') { ?>
        <?php print views_embed_view('state_resource_view', 'state_resource_wizardresults_service', '%veteran%', 'Veteran', 'Veterans'); ?>

        <?php } else if ($_GET['ownership'] === 'minority') { ?>
        <?php print views_embed_view('state_resource_view', 'state_resource_wizardresults_service', '%'.$_GET['ownership'].'%', 'Socially or economically disadvantaged', 'Minority'); ?>


        <?php  }  ?>
    </div>


    <div class="microsite-section">
        <div class="microsite-section-title">
            Tools
        </div>


        <?php if ($_GET['ownership'] === 'native'){?>

            <?php print views_embed_view('state_resource_view', 'state_resource_ownership_tools','%native american%', '%native_american%','American Indian & Native Alaskan', 'Native Alaskan', 'Native American'); ?>

        <?php } else if ($_GET['ownership'] === 'woman') { ?>
            <?php print views_embed_view('state_resource_view', 'state_resource_ownership_tools', '%women%', '%women%','Woman', 'Women'); ?>

        <?php } else if ($_GET['ownership'] === 'veteran') { ?>
            <?php print views_embed_view('state_resource_view', 'state_resource_ownership_tools', '%veteran%', '%veteran%','Veteran', 'Veterans'); ?>

        <?php } else if ($_GET['ownership'] === 'minority') { ?>
            <?php print views_embed_view('state_resource_view', 'state_resource_ownership_tools', '%minority%', '%minority%','Socially or economically disadvantaged', 'Minority'); ?>


        <?php  }  ?>
    </div>



</div>








<!-- ****************   Side Bars   **************** -->
<div class="microsite-sidebars-container">

    <!-- ****************    Resource Centers Sidebar  **************** -->
    <div class="microsite-sidebar sidebar-resource-centers">
        <div class="microsite-sidebar-title-container">
            <div class="microsite-sidebar-title">Resource Centers</div>
        </div>
        <div class="microsites-sidebarresults-results-container">
            <form class="begex-useac-askingforzip-inputokbutton-container" style="overflow: hidden; padding-bottom: 25px;" onsubmit="getUseacViewForZipCode( jQuery('.begex-useac-askingforzip-input').val() ); return false;">
                <div>
                    Please enter your zip code to locate the closest resource centers near you and connect with them
                </div>
                <div class="begex-useac-askingforzip-input-container" style="float: left;">
                    <input class="begex-useac-askingforzip-input" type="text" name="zip_location" id="exportzipcode" style="color: black; height: 40px; border: 0px;" value="">
                </div>
                <div class="begex-useac-askingforzip-okbutton-container" style="float: left">
                    <input type="submit" value="Go" style="color: white; border: 0px; font-size: 17px; text-align: center; background: #15567B; color: white; padding: 10px; cursor: pointer; display: block;" >
                </div>
            </form>


            <div class="microsites-sidebarresults-results-container_resource">

            </div>

            <div>
                <a><div class="viewmore" id="viewmore_resourcectr" onclick="updateZipcode()"><span>View All</span></div></a>
            </div>
        </div>
    </div>






</div>




<script>
    getUserZipCode( function (zipCode) {
        jQuery('.begex-useac-askingforzip-input').val(zipCode);
        getUseacViewForZipCode(zipCode);


    });




    function getUseacViewForZipCode(zipCode) {

        // Show spinner while loading

        jQuery('.begex-useac-askingforzip').hide();

        consoleLog('Will get the View concerning the ZipCode of ' + zipCode + ', but first looking up the state that ZIpCode resides in...');
        phpFunction('getLatLongFromZipCode', zipCode, function (locationData) {
            var targView = 'state_resource_view';
            var targDisplay = 'ownership_resource_center';
            var state = locationData['state'];

            var ownership = getUrlVars()["ownership"];

            var ownershipobj = "other";

            if (ownership == 'veteran')
            {
                ownershipobj = "Veteran's Business Outreach Center&param2=" + state;
            }
            else if (ownership == 'woman')
            {
                ownershipobj = "Women's Business Center&param2=" + state;
            }
            else if (ownership == 'minority')
            {
                ownershipobj = "MBDA Business Center&param2=" + state;
            }
            else if (ownership =='agricultural')
            {
                ownershipobj = "Rural Development Office&param2=" + state;
            }
            else if (ownership =='native')
            {
                ownershipobj = "SCORE Office&param2=Small Business Development Center&param3=MBDA Business Center&param4=" + state;
            }
            else
            {
                ownershipobj = "other&param2=" + state;
            }


            consoleLog('The target state is ' + state + ', now getting the USEACs View');
            jQuery.get('/sys/ajax/views_embed_view?view=' + targView + '&display=' + targDisplay + "&param1="+ ownershipobj, function (viewHTML) {
              jQuery('.microsites-sidebarresults-results-container_resource').hide();
                jQuery('.microsites-sidebarresults-results-container_resource').html(viewHTML);
                jQuery('.microsites-sidebarresults-results-container_resource').fadeIn();
                jQuery('.begex-useac-askingforzip').fadeIn();

            });


        });



    }

    function updateZipcode()
    {

        var ownership = getUrlVars()["ownership"];

        if (ownership == 'native')
        {
            $('#viewmore_resourcectr').parent().attr('href', '/request-appointment-and-closest-resource-centers?zip='+ $('#exportzipcode').val() + '&wiz=native');

        }
        else if (ownership == 'woman')
        {
            $('#viewmore_resourcectr').parent().attr('href', '/request-appointment-and-closest-resource-centers?zip='+ $('#exportzipcode').val() + '&wiz=woman');

        }
        else if (ownership == 'veteran')
        {
            $('#viewmore_resourcectr').parent().attr('href', '/request-appointment-and-closest-resource-centers?zip='+ $('#exportzipcode').val() + '&wiz=vet');

        }
        else if (ownership == 'minority')
        {
            $('#viewmore_resourcectr').parent().attr('href', '/request-appointment-and-closest-resource-centers?zip='+ $('#exportzipcode').val() + '&wiz=min');

        }
        else
        {
            $('#viewmore_resourcectr').parent().attr('href', '/request-appointment-and-closest-resource-centers?zip='+ $('#exportzipcode').val());
        }
    }

</script>
<script>
    $(document).ready(function(){

         setTimeout(function(){

             var title = getUrlVars()["ownership"];
             if (title == 'native')
             {
                 title = 'Resources for American Indian & Native Alaskan';


             }
             else if (title == 'woman')
             {
                 title = 'Resources For Women-Owned Businesses';
             }
             else if (title == 'veteran')
             {
                 title = ' Resources for Veterans-Owned Businesses';
             }
             else if (title == 'minority')
             {
                 title = 'Resources for Socially & Economically Disadvantaged-Owned Businesses';
             }

            jQuery('#titleWrapper h1').text(title);
            // $('#titleWrapper h1').css('textTransform', 'capitalize');

            }, 200);

        if ($('.sidebar-resource-centers .microsites-sidebarresults-results-container').length > 0)
        {
            $('.sidebar-resource-centers .microsites-sidebarresults-results-container').css('display', 'block');
        }
        //hide empty results and the corresponding title
        $('.view-empty').hide();
        $('.view-empty').parents('.microsite-section').hide();
        $('.view-empty').parents('.microsite-section-first').hide();

        var ownership = getUrlVars()["ownership"];

        if (ownership == 'native')
        {
            $('#viewmore_resourcectr').parent().attr('href', '/request-appointment-and-closest-resource-centers?zip='+ $('#exportzipcode').val() + '&wiz=native');
            $(document).attr('title', 'American Indian and Native Alaskan');

        }
        else if (ownership == 'woman')
        {
            $('#viewmore_resourcectr').parent().attr('href', '/request-appointment-and-closest-resource-centers?zip='+ $('#exportzipcode').val() + '&wiz=woman');
            $(document).attr('title', 'Woman');

        }
        else if (ownership == 'veteran')
        {
            $('#viewmore_resourcectr').parent().attr('href', '/request-appointment-and-closest-resource-centers?zip='+ $('#exportzipcode').val() + '&wiz=vet');
            $(document).attr('title', 'Veterans');

        }
        else if (ownership == 'minority')
        {
            $('#viewmore_resourcectr').parent().attr('href', '/request-appointment-and-closest-resource-centers?zip='+ $('#exportzipcode').val() + '&wiz=min');
           $(document).attr('title', 'Socially & Economically Disadvantaged');

        }
        else
        {
            $('#viewmore_resourcectr').parent().attr('href', '/request-appointment-and-closest-resource-centers?zip='+ $('#exportzipcode').val());
        }




    });



</script>




<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sanjay.gupta
 * Date: 5/16/14
 * Time: 2:25 AM
 * To change this template use File | Settings | File Templates.
 */
?>

<div class="welcome-message">
    Welcome to BusinessUSA's State Resources Portal.  Please click on state or territory below to find resources, events, and local business assistance centers in your area.

</div>

<div class="mapcontainer-desktop">
    <img id="us_state_image_desktop" class="jq_maphilight" src="../sites/all/themes/bizusa/images/microsite/desktop_map.png" border="0" width="709" height="530" orgWidth="709" orgHeight="530" usemap="#us_state_dsk" alt="" />
    <map name="us_state_dsk" id="us_state_map_dsk">
        <area id="hawaii" alt="HI" title="Hawaii"  shape="rect" coords="115,410,205,450" style="outline:none;" target="_self" href="state_resource_landing?state=hi"/>
        <area id="american_samoa" alt="Samoa" title="American Samoa"  shape="rect" coords="438,475,517,497" style="outline:none;" target="_self" href="state_resource_landing?state=as"    />
        <area id="guam" alt="GU" title="Guam"  shape="rect" coords="252,429,326,497" style="outline:none;" target="_self" href="state_resource_landing?state=gu"    />
        <area id="virgin_islands" alt="VI" title="Virgin Islands"  shape="rect" coords="393,426,473,445" style="outline:none;" target="_self" href="state_resource_landing?state=vi"    />
        <area id="puerto_rico" alt="PR" title="Puerto Rico"  shape="rect" coords="567,448,656,473" style="outline:none;" target="_self" href="state_resource_landing?state=pr"    />
        <area shape="rect" coords="707,528,709,530" alt="Image Map" style="outline:none;" title="Image Map" href="http://www.image-maps.com/index.php?aff=mapped_users_0" />
        <area id="alaska" alt="al" title="Alaska"  shape="poly" coords="114,358,89,290,86,288,82,289,67,290,57,289,46,290,40,298,34,299,31,305,27,309,30,319,39,323,37,328,26,328,19,332,25,339,40,342,39,348,29,354,27,361,29,375,41,382,54,384,47,406,67,384,72,369,71,376,91,360,107,362" style="outline:none;" target="_self" href="state_resource_landing?state=al"    />
        <area id="california" alt="CA" title="California"  shape="poly" coords="114,295,141,298,147,299,144,289,151,279,155,275,151,263,99,188,111,143,65,129,60,144,57,153,58,165,58,176,63,194,73,194,68,198,66,205,70,214,68,221,78,245,76,250,86,257,99,270,110,283" style="outline:none;" target="_self"  href="state_resource_landing?state=ca"    />
        <area id="oregon" alt="OR" title="Oregon"  shape="poly" coords="65,130,144,147,153,115,151,111,162,93,159,86,129,82,119,82,113,83,108,80,97,80,96,73,91,64,67,114,69,122" style="outline:none;" target="_self" href=" state_resource_landing?state=or"    />
        <area id="washington" alt="WA" title="Washington"  shape="poly" coords="157,87,122,83,107,79,101,80,95,76,88,65,88,48,87,36,89,31,103,41,102,49,110,46,112,36,111,30,167,44" style="outline:none;" target="_self" href="state_resource_landing?state=wa"    />
        <area id="nevada" alt="NV" title="Nevada"  shape="poly" coords="151,262,99,187,111,142,178,158,162,247,154,246" style="outline:none;" target="_self" href="state_resource_landing?state=nv"    />
        <area id="idaho" alt="ID" title="Idaho"  shape="poly" coords="145,148,212,160,219,121,198,119,191,100,184,100,190,84,175,66,176,59,178,45,167,42,161,93,151,108,153,117" style="outline:none;" target="_self" href="state_resource_landing?state=id"    />
        <area id="montana" alt="MT" title="Montana"  shape="poly" coords="297,122,303,62,237,55,178,46,176,57,175,66,188,83,185,98,191,102,194,110,198,119,215,121,220,115" style="outline:none;" target="_self" href="state_resource_landing?state=mt"    />
        <area id="wyoming" alt="WY" title="Wyoming"  shape="poly" coords="211,177,294,185,297,123,220,114" style="outline:none;" target="_self" href="state_resource_landing?state=wy"    />
        <area id="utah" alt="UT" title="Utah"  shape="poly" coords="165,233,225,243,233,180,211,176,212,161,178,156" style="outline:none;" target="_self" href="state_resource_landing?state=ut"    />
        <area id="arizona" alt="AZ" title="Arizona"  shape="poly" coords="213,330,189,327,144,299,146,293,145,287,150,280,156,275,152,263,155,247,160,246,164,234,227,243" style="outline:none;" target="_self" href="state_resource_landing?state=az"    />
        <area id="colorado" alt="CO" title="Colorado"  shape="poly" coords="234,182,226,243,272,247,314,250,315,188" style="outline:none;" target="_self" href="state_resource_landing?state=co"    />
        <area id="new_mexico" alt="NM" title="New Mexico"  shape="poly" coords="215,331,224,332,227,324,248,325,295,328,299,250,263,247,226,243" style="outline:none;" target="_self" href="state_resource_landing?state=nm"    />
        <area id="texas" class="state-area" alt="TX" title="Texas"  shape="poly" coords="373,427,356,422,347,417,342,408,340,399,335,392,331,385,327,375,316,366,298,363,291,375,287,373,274,363,272,355,270,349,251,329,249,326,294,329,301,259,337,261,337,286,347,294,362,299,379,303,393,301,409,305,415,327,422,342,423,352,422,364,409,364,401,378,386,383,377,395,373,402,371,417" style="outline:none;" target="_self" href="state_resource_landing?state=tx"/>
        <area id="oklahoma" alt="OK" title="Oklahoma"  shape="poly" coords="302,250,331,251,364,252,390,253,407,253,410,302,399,299,394,301,387,303,380,303,374,303,368,300,364,300,361,297,352,299,347,295,340,290,337,260,301,259" style="outline:none;" target="_self" href="state_resource_landing?state=ok"    />
        <area id="kansas" alt="KS" title="Kansas"  shape="poly" coords="314,249,406,250,406,220,400,211,401,207,395,205,316,205" style="outline:none;" target="_self" href="state_resource_landing?state=ks"    />
        <area id="nebraska" alt="NE" title="Nebraska"  shape="poly" coords="317,201,396,205,389,183,381,165,373,158,367,160,359,157,297,155,293,185,318,187" style="outline:none;" target="_self" href="state_resource_landing?state=ne"    />
        <area id="south_dakota" alt="SD" title="South Dakota"  shape="poly" coords="296,154,359,157,365,162,373,161,382,164,383,148,383,122,379,116,382,113,299,109" style="outline:none;" target="_self" href="state_resource_landing?state=sd"    />
        <area id="north_dakota" alt="ND" title="North Dakota"  shape="poly" coords="303,62,299,107,345,110,381,111,378,86,375,75,374,65" style="outline:none;" target="_self" href="state_resource_landing?state=nd"    />
        <area id="minnesota" alt="MN" title="Minnesota"  shape="poly" coords="374,64,375,76,379,98,380,111,378,117,384,128,383,143,382,149,410,149,436,149,441,144,427,132,425,118,422,115,428,107,429,98,451,78,437,78,423,70,403,68,397,61,396,65" style="outline:none;" target="_self" href="state_resource_landing?state=mn"    />
        <area id="iowa" alt="IA" title="Iowa"  shape="poly" coords="383,149,384,156,380,162,388,176,390,191,412,195,433,195,442,196,449,185,448,181,456,171,453,165,446,160,441,148" style="outline:none;" target="_self" href="state_resource_landing?state=ia"    />
        <area id="missouri" alt="MO" title="Missouri"  shape="poly" coords="392,197,402,208,399,211,406,220,408,260,445,259,463,257,462,266,468,266,474,256,474,248,469,240,460,231,460,222,454,219,450,214,446,206,442,197,436,194" style="outline:none;" target="_self" href="state_resource_landing?state=mo"    />
        <area id="arkansas" alt="AR" title="Arkansas"  shape="poly" coords="407,260,409,304,415,306,415,315,454,313,452,304,460,290,465,278,470,265,461,265,464,259" style="outline:none;" target="_self" href="state_resource_landing?state=ar"    />
        <area id="louisiana" alt="LA" title="Louisiana"  shape="poly" coords="416,315,417,331,423,346,422,357,418,366,442,368,445,362,457,371,471,373,472,367,484,374,477,365,480,358,473,359,470,361,464,357,470,353,477,354,473,350,475,343,450,344,450,336,453,328,458,323,452,313" style="outline:none;" target="_self" href="state_resource_landing?state=la"    />
        <area id="mississippi" alt="MS" title="Mississippi"  shape="poly" coords="464,280,458,288,455,299,452,302,455,318,458,325,451,333,450,343,461,345,475,344,474,351,482,354,494,350,490,280" style="outline:none;" target="_self" href="state_resource_landing?state=ms"    />
        <area id="illinois" alt="IL" title="Illinois"  shape="poly" coords="452,163,455,172,447,180,447,189,444,197,445,206,455,217,460,226,458,230,471,241,471,250,477,245,483,249,483,244,488,240,493,220,490,212,488,176,481,162" style="outline:none;" target="_self" href="state_resource_landing?state=il"    />
        <area id="wisconsin" alt="WI" title="Wisconsin"  shape="poly" coords="441,96,434,100,429,102,428,109,424,113,425,127,442,142,446,159,452,165,482,161,484,125,478,130,481,120,478,114,474,110,461,106,452,103" style="outline:none;" target="_self" href="state_resource_landing?state=wi"    />
        <area id="alabama" alt="AL" title="Alabama"  shape="poly" coords="491,278,493,348,497,339,499,351,506,351,505,340,521,340,536,337,536,320,536,317,534,311,521,276" style="outline:none;" target="_self" href="state_resource_landing?state=al"    />
        <area id="tennesse" alt="TN" title="Tennesse"  shape="poly" coords="472,257,464,280,492,279,515,276,538,273,541,268,547,265,555,257,561,253,568,247,569,242" style="outline:none;" target="_self" href="state_resource_landing?state=tn"    />
        <area id="kentucky" alt="KY" title="Kentucky"  shape="poly" coords="491,233,486,238,483,247,476,244,474,255,489,254,502,251,520,249,534,247,549,246,555,237,561,230,553,220,549,212,545,216,536,214,529,209,526,213,521,218,513,229,508,227,504,233,502,231,497,236,494,232,490,237" style="outline:none;" target="_self" href="state_resource_landing?state=ky"    />
        <area id="indiana" alt="IN" title="Indiana"  shape="poly" coords="488,174,491,206,491,211,492,219,488,231,487,239,499,232,507,228,515,226,520,219,526,215,516,168" style="outline:none;" target="_self" href="state_resource_landing?state=in"    />
        <area id="michigan" alt="MI" title="Michigan"  shape="poly" coords="451,100,465,107,473,107,481,116,497,127,496,140,502,150,497,171,511,170,527,168,535,166,541,153,543,146,535,131,527,136,527,124,525,114,514,107,509,109,508,115,500,122,484,112,493,106,500,102,508,102,518,101,513,95,504,91,495,94,490,99,480,97,474,94,469,92,472,84" style="outline:none;" target="_self" href="state_resource_landing?state=mi"    />
        <area id="ohio" alt="OH" title="Ohio"  shape="poly" coords="520,169,525,208,533,212,543,216,548,212,556,216,558,209,562,204,565,198,572,192,572,180,567,159,555,166,547,172,535,167" style="outline:none;" target="_self" href="state_resource_landing?state=oh"    />
        <area id="florida" alt="FL" title="Florida"  shape="poly" coords="506,349,502,343,502,340,520,339,537,338,541,344,551,341,569,340,579,342,580,336,584,335,595,359,602,368,604,375,613,389,617,404,614,414,605,419,603,411,597,409,593,403,590,396,581,389,581,382,576,380,574,365,568,362,556,350,547,354,537,357,532,351,525,352,523,349" style="outline:none;" target="_self" href="state_resource_landing?state=fl"    />
        <area id="georgia" alt="GA" title="Georgia"  shape="poly" coords="523,275,534,312,538,320,534,331,540,340,568,340,574,339,579,341,578,334,585,337,589,317,582,304,571,292,560,280,550,275,554,272" style="outline:none;" target="_self" href="state_resource_landing?state=ga"    />
        <area id="south_Carolina" alt="SC" title="South Carolina"  shape="poly" coords="554,272,551,275,559,281,581,299,587,311,592,310,592,303,600,302,609,291,615,279,598,267,585,269,579,265,561,267" style="outline:none;" target="_self" href="state_resource_landing?state=sc"    />
        <area id="north_carolina" alt="NC" title="North Carolina"  shape="poly" coords="569,241,566,249,559,255,548,264,541,268,537,273,553,272,564,266,581,266,587,271,600,268,615,278,624,273,631,265,639,259,637,252,634,249,642,248,645,244,638,241,632,243,631,237,638,237,642,234,639,229" style="outline:none;" target="_self" href="state_resource_landing?state=nc"    />
        <area id="virginia" alt="VA" title="Virginia"  shape="poly" coords="581,227,569,232,563,231,549,243,577,240,611,233,636,229,636,226,630,222,631,215,630,209,618,205,617,200,613,195,606,195,602,193,600,197,596,204,592,210,589,208" style="outline:none;" target="_self" href="state_resource_landing?state=va"    />
        <area id="west_virginia" alt="WV" title="West Virginia"  shape="poly" coords="571,179,570,193,565,199,561,204,561,210,557,207,556,215,552,218,563,231,572,233,580,229,584,226,588,209,594,208,595,204,601,198,602,194,600,191,590,197,587,191,575,192" style="outline:none;" target="_self" href="state_resource_landing?state=wv"    />
        <area id="maryland" alt="MA" title="Maryland"  shape="poly" coords="587,190,587,198,597,191,603,189,611,194,618,199,623,204,638,217,641,210,643,199,636,200,631,190,631,184,626,180" style="outline:none;" target="_self" href="state_resource_landing?state=md"    />
        <area id="pennsylania" alt="PA" title="Pennsylania"  shape="poly" coords="569,160,571,178,576,193,632,180,639,177,641,172,635,163,636,154,629,146,577,155,575,152" style="outline:none;" target="_self" href="state_resource_landing?state=pa"    />
        <area id="new_jersey" alt="NJ" title="New Jersey"  shape="poly" coords="636,154,633,161,640,172,635,180,645,185,648,175,647,167,647,163,643,156" style="outline:none;" target="_self" href="state_resource_landing?state=nj"    />
        <area id="new_york" alt="NY" title="New York"  shape="poly" coords="584,133,587,143,578,151,578,157,614,147,629,147,638,154,646,156,651,160,662,155,651,150,647,135,645,117,640,102,636,93,621,100,613,109,613,122,606,130" style="outline:none;" target="_self" href="state_resource_landing?state=ny"    />
        <area id="vermont" alt="VT" title="Vermont"  shape="poly" coords="639,96,640,105,645,117,648,127,654,123,656,113,654,100,660,93,660,87" style="outline:none;" target="_self" href="state_resource_landing?state=vt"    />
        <area id="connecticut" alt="CT" title="Connecticut"  shape="poly" coords="650,140,651,151,659,146,668,143,667,134" style="outline:none;" target="_self" href="state_resource_landing?state=ct"    />
        <area id="rode_island" alt="RI" title="Rhode Island"  shape="poly" coords="668,134,670,143,675,140,673,134" style="outline:none;" target="_self" href="state_resource_landing?state=ri"    />
        <area id="massachusetts" alt="MA" title="Massachusetts"  shape="poly" coords="648,128,648,138,672,133,679,140,686,136,679,130,675,125,675,120,671,124" style="outline:none;" target="_self" href="state_resource_landing?state=ma"    />
        <area id="new_hampshire" alt="NH" title="New Hampshire"  shape="poly" coords="660,84,658,90,659,97,654,99,656,108,654,111,655,125,671,120,675,115,665,93" style="outline:none;" target="_self" href="state_resource_landing?state=nh"    />
        <area id="maine" alt="ME" title="Maine"  shape="poly" coords="661,83,667,99,674,114,679,103,686,95,689,87,697,87,707,77,705,72,697,69,696,68,688,48,683,46,679,48,672,47,667,52,668,68,667,80" style="outline:none;" target="_self" href="state_resource_landing?state=me"    />
        <area id="district_of_columbia" alt="DC" title="District of Columbia" shape="poly" coords="620,196,613,204,621,208,625,205" style="outline:none;" target="_self" href="state_resource_landing?state=dc"    />
        <area id="delaware" alt="DE" title="Delaware" href="state_resource_landing?state=de" shape="poly" coords="631,179,636,201,646,198" style="outline:none;" target="_self"     />
    </map>
</div>


<div class="mapcontainer-tablet">
    <img id="us_state_image_tablet" src="../sites/all/themes/bizusa/images/microsite/tablet_map.png" border="0" width="593" height="443" orgWidth="593" orgHeight="530" usemap="#us_state_tab" alt="" />

    <map name="us_state_tab" id="us_state_map_tab">
        <area shape="rect" coords="591,441,593,443" alt="Image Map" style="outline:none;" title="Image Map" href="http://www.image-maps.com/index.php?aff=mapped_users_18762" />
        <area id="washington_tab" alt="WA" title="Washington" shape="poly" coords="75,16,75,39,81,49,81,56,92,57,103,58,115,58,133,62,141,27,95,12,97,18,95,26,91,28,86,32,88,25" style="outline:none;" target="_self" href="state_resource_landing?state=wa"    />
        <area id="oregon_tab" alt="OR" title="Oregon" shape="poly" coords="74,46,61,80,57,86,56,98,121,114,130,86,125,83,137,69,133,64,115,61,105,61,96,62,94,58,85,57" style="outline:none;" target="_self" href="state_resource_landing?state=or"    />
        <area id="california_tab" alt="CA" title="California" shape="poly" coords="56,98,52,111,48,115,52,128,50,138,54,150,63,156,57,160,55,163,60,171,59,175,68,198,65,202,90,223,97,231,96,236,122,240,126,236,120,232,126,223,130,221,128,210,83,147,92,109" style="outline:none;" target="_self" href="state_resource_landing?state=ca"    />
        <area id="alaska_tab" alt="AK" title="Alaska" shape="poly" coords="75,232,98,289,88,294,76,290,73,293,70,289,62,299,56,307,58,313,40,331,50,317,49,308,46,310,39,309,34,309,30,302,25,305,24,302,28,299,24,293,27,286,35,280,33,272,22,272,21,268,16,266,23,265,31,266,35,260,25,255,23,248,28,242,37,233,49,234,61,233,69,236" style="outline:none;" target="_self" href="state_resource_landing?state=ak"    />
        <area id="nevada_tab" alt="NV" title="Nevada" shape="poly" coords="93,109,82,146,127,211,128,197,134,197,149,123,145,120" style="outline:none;" target="_self" href="state_resource_landing?state=nv"    />
        <area id="idaho_tab" alt="ID" title="Idaho" shape="poly" coords="140,24,132,63,137,71,125,81,128,88,121,114,179,126,184,92,181,90,166,88,160,73,155,74,158,60,150,50,147,40,150,26" style="outline:none;" target="_self" href="state_resource_landing?state=id"    />
        <area id="utah_tab" alt="UT" title="Utah" shape="poly" coords="149,121,139,186,189,193,197,140,178,137,178,125" style="outline:none;" target="_self" href="state_resource_landing?state=ut"    />
        <area id="arizona_tab" alt="AZ" title="Arizona" shape="poly" coords="138,184.5,134,196.5,131,195.5,127,212.5,130,220.5,125,224.5,122,230.5,124,237.5,121,240.5,160,264.5,181,266.5,189,192.5" style="outline:none;" target="_self" href="state_resource_landing?state=az"    />
        <area id="montana_tab" alt="MT" title="Montana" shape="poly" coords="149,27,147,39,148,48,157,60,155,72,161,75,166,90,182,91,184,86,251,93,253,42,198,35" style="outline:none;" target="_self" href="state_resource_landing?state=mt"    />
        <area id="wyoming_tab" alt="WY" title="Wyoming" shape="poly" coords="185,86,177,137,247,145,249,93" style="outline:none;" target="_self" href="state_resource_landing?state=wy"    />
        <area id="colorado_tab" alt="CO" title="Colorado" shape="poly" coords="195,140,190,193,263,200,266,147" style="outline:none;" target="_self" href="state_resource_landing?state=co"    />
        <area id="new_mexico_tab" alt="NM" title="New Mexico" shape="poly" coords="188,193,180,266,189,268,189,262,208,263,247,265,253,198,221,197" style="outline:none;" target="_self" href="state_resource_landing?state=nm"    />
        <area id="hawaii_tab" alt="HI" title="Hawaii" shape="poly" coords="101,339,124,342,141,347,156,356,160,366,167,367,167,360,172,356,159,349,152,342,126,336,104,333,100,335" style="outline:none;" target="_self" href="state_resource_landing?state=hi"    />
        <area id="guam_tab" alt="GU" title="Guam" shape="poly" coords="216,352,230,355,246,357,249,365,254,372,263,383,254,386,249,395,250,404,256,409,260,405,261,393,271,386,274,382,269,375,260,361,247,353,229,350,213,348" style="outline:none;" target="_self" href="state_resource_landing?state=gu"    />
        <area id="virgin_islands_tab" alt="VI" title="Virgin Islands" shape="poly" coords="331,355,341,357,354,361,363,359,372,357,381,361,390,363,396,359,396,355,391,347,375,353,369,355,358,349,348,346,328,350" style="outline:none;" target="_self" href="state_resource_landing?state=vi"    />
        <area id="american_samoa_tab" alt="AS" title="American Samoa" shape="poly" coords="367,392,367,403,364,408,379,408,392,405,410,401,422,397,433,392,408,390,401,387,389,387,381,389,372,388" style="outline:none;" target="_self" href="state_resource_landing?state=as"    />
        <area id="puerto_rico_tab" alt="PR" title="Puerto Rico" shape="poly" coords="479,366,482,376,478,383,495,385,510,386,527,387,538,382,542,378,547,372,537,364,519,362,505,362,482,361" style="outline:none;" target="_self" href="state_resource_landing?state=pr"    />
        <area id="texas_tab" alt="TX" title="Texas" shape="poly" coords="253,206,283,207,283,232,295,238,307,242,317,243,327,244,339,241,344,247,348,246,348,268,357,278,354,288,353,296,343,298,340,296,339,305,332,312,324,313,318,321,313,326,312,339,314,349,303,345,291,340,286,326,281,320,267,298,252,294,244,300,242,306,231,296,228,284,210,263,252,265" style="outline:none;" target="_self" href="state_resource_landing?state=tx"    />
        <area id="oklahoma_tab" alt="OK" title="Oklahoma" shape="poly" coords="252,198,252,205,285,207,285,232,301,237,317,244,326,241,338,242,344,245,339,202,339,200" style="outline:none;" target="_self" href="state_resource_landing?state=ok"    />
        <area id="kansas_tab" alt="KS" title="Kansas" shape="poly" coords="266,158,263,199,341,201,341,173,337,166,338,161,330,159" style="outline:none;" target="_self" href="state_resource_landing?state=ks"    />
        <area id="nebraska_tab" alt="NE" title="Nebraska" href="state_resource_landing?state=ne" shape="poly" coords="248,119,245,145,263,148,266,160,335,163,328,153,319,128,314,124,306,124,300,121" style="outline:none;" target="_self"     />
        <area id="south_dakota_tab" alt="SD" title="South Dakota" href="state_resource_landing?state=sd" shape="poly" coords="251,79,246,118,299,122,306,125,319,126,322,115,321,90,316,86,319,82" style="outline:none;" target="_self"     />
        <area id="north_dakota_tab" alt="ND" title="North Dakota" shape="poly" coords="253,42,250,78,320,83,314,45" style="outline:none;" target="_self"     />
        <area id="minnesota_tab" alt="MN" title="Minnesota" href="state_resource_landing?state=mn" shape="poly" coords="314,43,319,85,319,87,322,115,371,114,370,108,357,99,355,90,355,86,361,75,360,69,378,57,369,55,355,49,340,45,334,40,332,44" style="outline:none;" target="_self"     />
        <area id="iowa_tab" alt="IA" title="Iowa" href="state_resource_landing?state=ia" shape="poly" coords="320,115,320,123,326,153,373,152,377,144,376,140,384,131,375,122,370,113" style="outline:none;" target="_self"     />
        <area id="missouri_tab" alt="MO" title="Missouri" href="state_resource_landing?state=mo" shape="poly" coords="329,153,369,152,374,164,381,175,384,172,384,184,395,191,397,201,393,210,386,212,390,207,342,206,340,174,335,169,337,163" style="outline:none;" target="_self"     />
        <area id="arkansas_tab" alt="AR" title="Arkansas" href="state_resource_landing?state=ar" shape="poly" coords="342,207,344,245,348,254,380,251,380,246,392,211,386,211,389,208,388,205" style="outline:none;" target="_self"     />
        <area id="louisiana_tab" alt="LA" title="Louisiana" href="state_resource_landing?state=la" shape="poly" coords="349,252,349,267,355,279,354,287,350,295,361,295,372,297,375,294,385,299,393,300,398,297,404,302,399,296,403,290,398,291,394,291,392,288,394,285,399,285,397,279,378,278,378,273,385,262,381,254,376,251" style="outline:none;" target="_self"     />
        <area id="mississippi_tab" alt="MS" title="Mississippi" href="state_resource_landing?state=ms" shape="poly" coords="387,225,380,241,382,261,377,273,377,276,396,279,401,286,414,284,410,223" style="outline:none;" target="_self"     />
        <area id="tennesse_tab" alt="TN" title="Tennesse" href="state_resource_landing?state=tn" shape="poly" coords="395,203,388,223,451,217,464,207,478,194,476,191" style="outline:none;" target="_self"     />
        <area id="wisconsin_tab" alt="WI" title="Wisconsin" href="state_resource_landing?state=wi" shape="poly" coords="370,70,362,76,359,73,356,84,353,87,356,97,370,109,373,124,380,128,405,125,406,95,402,100,404,90,401,84,395,81,378,76" style="outline:none;" target="_self"     />
        <area id="illinois_tab" alt="IL" title="Illinois" href="state_resource_landing?state=il" shape="poly" coords="378,125,381,136,374,142,375,149,372,154,372,160,382,176,385,175,383,184,394,195,401,194,409,191,409,182,414,173,411,169,408,135,406,129,401,124" style="outline:none;" target="_self"     />
        <area id="michigan_tab" alt="MI" title="Michigan" href="state_resource_landing?state=mi" shape="poly" coords="376,75,390,80,399,83,406,92,416,107,420,121,417,132,434,132,447,129,451,121,454,116,454,105,448,101,440,106,444,95,439,85,430,80,434,74,430,69,424,69,422,68,411,71,403,71,398,69,392,70,392,66,397,62,399,59,389,68,381,70" style="outline:none;" target="_self"     />
        <area id="indiana_tab" alt="IN" title="Indiana" href="state_resource_landing?state=in" shape="poly" coords="408,132,411,163,411,170,411,178,409,186,419,186,425,184,427,181,430,181,434,173,440,169,434,130" style="outline:none;" target="_self"     />
        <area id="kentucky_tab" alt="KY" title="Kentucky" href="state_resource_landing?state=ky" shape="poly" coords="396,203,400,193,407,191,409,184,420,183,424,179,433,176,439,171,440,166,452,169,460,168,464,175,468,183,460,196" style="outline:none;" target="_self"     />
        <area id="alabama_tab" alt="AL" title="Alabama" href="state_resource_landing?state=al" shape="poly" coords="411,223,413,282,417,274,421,284,426,281,423,275,451,272,449,257,450,255,436,220" style="outline:none;" target="_self"     />
        <area id="florida_tab" alt="FL" title="Florida" href="state_resource_landing?state=fl" shape="poly" coords="423,284,422,275,449,272,455,276,485,275,486,271,502,294,507,302,513,320,516,333,510,338,507,339,504,334,497,329,493,322,487,316,487,312,486,308,482,307,481,295,477,291,468,284,458,286,450,288,444,286,437,281,430,282" style="outline:none;" target="_self"     />
        <area id="georgia_tab" alt="GA" title="Georgia" href="state_resource_landing?state=ga" shape="poly" coords="453,275,449,272,449,263,449,256,437,220,463,217,467,222,481,235,490,248,492,259,491,267,485,270,484,276,481,274" style="outline:none;" target="_self"     />
        <area id="south_carolina_tab" alt="SC" title="South Carolina" href="state_resource_landing?state=ga" shape="poly" coords="463,217,463,222,476,233,491,246,493,253,500,244,507,240,512,231,515,224,501,214,490,216,486,212,473,214,472,213" style="outline:none;" target="_self"     />
        <area id="north_carolina_tab" alt="NC" title="North Carolina" href="state_resource_landing?state=nc" shape="poly" coords="474,193,461,206,450,216,466,215,480,213,489,211,490,218,502,215,516,224,521,221,526,213,536,207,533,200,529,197,536,197,541,195,532,192,531,187,539,188,536,181" style="outline:none;" target="_self"     />
        <area id="virginia_tab" alt="VA" title="Virginia" href="state_resource_landing?state=va" shape="poly" coords="469,180,458,195,482,192,504,188,524,184,535,182,536,178,528,175,527,165,518,162,516,156,511,151,504,150,503,157,497,166,492,163,490,175,486,180,479,184,477,188" style="outline:none;" target="_self"     />
        <area id="dc_tab" alt="DC" title="Washington D.C." href="state_resource_landing?state=dc" shape="poly" coords="521,159,518,163,527,168,527,161" style="outline:none;" target="_self"     />
        <area id="west_virginia_tab" alt="WV" title="West Virginia" shape="poly" coords="478,138,476,152,470,159,467,166,463,172,474,186,482,183,490,178,493,165,498,162,502,156,503,152,509,153,501,151,494,156,490,151,481,150" style="outline:none;" target="_self"     />
        <area id="maryland_tab" alt="MD" title="Maryland" href="state_resource_landing?state=md" shape="poly" coords="507,145,517,155,524,162,537,173,538,165,534,160,530,156,529,148,527,143" style="outline:none;" target="_self"     />
        <area id="delaware_tab" alt="DE" title="Delaware" href="state_resource_landing?state=de" shape="poly" coords="528,141,532,157,542,156" style="outline:none;" target="_self"     />
        <area id="ohio_tab" alt="OH" title="Ohio" href="state_resource_landing?state=oh" shape="poly" coords="435,130,438,164,448,169,459,169,468,171,469,165,477,154,480,143,476,123,467,128,460,131,447,130" style="outline:none;" target="_self"     />
        <area id="pennsylvania_tab" alt="PA" title="Pennsylvania" href="state_resource_landing?state=pa" shape="poly" coords="476,120,482,149,531,139,537,133,531,129,532,119,524,112" style="outline:none;" target="_self"     />
        <area id="new_jersey_tab" alt="NJ" title="New Jersey" href="state_resource_landing?state=nj" shape="poly" coords="531,117,531,128,537,133,532,140,543,146,546,131,542,122" style="outline:none;" target="_self"     />
        <area id="new_york_tab" alt="NY" title="New York" href="state_resource_landing?state=ny" shape="poly" coords="490,107,481,115,485,120,525,112,535,117,542,124,555,118,545,118,543,110,543,98,539,84,536,70,521,71,514,84,514,93,502,100,499,98,490,100,490,104" style="outline:none;" target="_self"     />
        <area id="connecticut_tab" alt="CT" title="Connecticut" href="state_resource_landing?state=ct" shape="poly" coords="542,106,560,100,563,110,547,118" style="outline:none;" target="_self"     />
        <area id="rhode_island_tab" alt="RI" title="Rhode Island" href="state_resource_landing?state=ri" shape="poly" coords="558,102,562,112,567,108,562,102" style="outline:none;" target="_self"     />
        <area id="massachusetts_tab" alt="MA" title="Massachusetts" href="state_resource_landing?state=ma" shape="poly" coords="541,96,543,105,563,100,569,106,574,103,570,98,566,96,566,92,565,90" style="outline:none;" target="_self"     />
        <area id="vermont_tab" alt="VT" title="Vermont" href="state_resource_landing?state=vt" shape="poly" coords="535,68,538,86,544,96,551,93,548,85,548,73,553,69,552,64" style="outline:none;" target="_self"     />
        <area id="new_hampshire_tab" alt="NH" title="New Hampshire" href="state_resource_landing?state=nh" shape="poly" coords="548,95,564,88,554,60,550,61,551,70,548,75" style="outline:none;" target="_self"     />
        <area id="maine_tab" alt="ME" title="Maine" href="state_resource_landing?state=me" shape="poly" coords="552,59,564,86,568,78,571,72,577,66,578,61,586,60,592,54,590,50,582,48,576,30,573,26,569,29,561,29,560,49,558,61" style="outline:none;" target="_self"     />
    </map>

</div>


<div class="stateslist-container">

        <ul class="stateslist">
            <li>
                <a class="" id="alabama_anc" href="state_resource_landing?state=al" title="AL" target="_self">Alabama</a>
            </li>
            <li>
                <a class="" id="alaska_anc" href="state_resource_landing?state=ak" title="AK" target="_self">Alaska</a>
            </li>
            <li>
                <a class="" id="arizona_anc" href="state_resource_landing?state=az" title="AZ" target="_self">Arizona</a>
            </li>
            <li>
                <a class="" id="arkansas_anc" href="state_resource_landing?state=ar" title="ar" target="_self">Arkansas</a>
            </li>
            <li>
                <a class="" id="california_anc" href="state_resource_landing?state=ca" title="ca" target="_self">California</a>
            </li>
            <li>
                <a class="" id="colorado_anc" href="state_resource_landing?state=co" title="co" target="_self">Colorado</a>
            </li>
            <li>
                <a class="" id="connecticut_anc" href="state_resource_landing?state=ct" title="ct" target="_self">Connecticut</a>
            </li>
            <li>
                <a class="" id="delaware_anc" href="state_resource_landing?state=de" title="DE" target="_self">Delaware</a>
            </li>
            <li>
                <a class="" id="districtofcolumbia_anc" href="state_resource_landing?state=dc" title="DC" target="_self">District of Columbia</a>
            </li>
            <li>
                <a class="" id="florida_anc" href="state_resource_landing?state=fl" title="FL" target="_self">Florida</a>
            </li>

            <li>
                <a class="" id="georgia_anc" href="state_resource_landing?state=ga" title="GA" target="_self">Georgia</a>
            </li>

            <li>
                <a class="" id="hawaii_anc" href="state_resource_landing?state=hi" title="HI" target="_self">Hawaii</a>
            </li>
            <li>
                <a class="" id="idaho_anc" href="state_resource_landing?state=id" title="ID" target="_self">Idaho</a>
            </li>
            <li>
                <a class="" id="illinois_anc" href="state_resource_landing?state=il" title="IL" target="_self">Illinois</a>
            </li>
            <li>
                <a class="" id="indiana_anc" href="state_resource_landing?state=in" title="IN" target="_self">Indiana</a>
            </li>
            <li>
                <a class="" id="iowa_anc" href="state_resource_landing?state=ia" title="IA" target="_self">Iowa</a>
            </li>
            <li>
                <a class="" id="kansas_anc" href="state_resource_landing?state=ks" title="KS" target="_self">Kansas</a>
            </li>
            <li>
                <a class="" id="kentucky_anc" href="state_resource_landing?state=ky" title="KY" target="_self">Kentucky</a>
            </li>
            <li>
                <a class="" id="louisiana_anc" href="state_resource_landing?state=la" title="LA" target="_self">Louisiana</a>
            </li>
            <li>
                <a class="" id="maine_anc" href="state_resource_landing?state=me" title="ME" target="_self">Maine</a>
            </li>

            <li>
                <a class="" id="maryland_anc" href="state_resource_landing?state=md" title="MD" target="_self">Maryland</a>
            </li>
            <li>
                <a class="" id="massachusetts_anc" href="state_resource_landing?state=ma" title="MA" target="_self">Massachusetts</a>
            </li>

            <li>
                <a class="" id="michigan_anc" href="state_resource_landing?state=mi" title="MI" target="_self">Michigan</a>
            </li>
            <li>
                <a class="" id="minnesota_anc" href="state_resource_landing?state=mn" title="MN" target="_self">Minnesota</a>
            </li>
            <li>
                <a class="" id="mississippi_anc" href="state_resource_landing?state=ms" title="MS" target="_self">Mississippi</a>
            </li>
            <li>
                <a class="" id="missouri_anc" href="state_resource_landing?state=mo" title="MO" target="_self">Missouri</a>
            </li>
            <li>
                <a class="" id="montana_anc" href="state_resource_landing?state=mt" title="MT" target="_self">Montana</a>
            </li>
            <li>
                <a class="" id="nebraska_anc" href="state_resource_landing?state=ne" title="NE" target="_self">Nebraska</a>
            </li>
            <li>
                <a class="" id="nevada_anc" href="state_resource_landing?state=nv" title="NV" target="_self">Nevada</a>
            </li>
            <li>
                <a class="" id="new_hampshire_anc" href="state_resource_landing?state=nh" title="NH" target="_self">New Hampshire</a>
            </li>

            <li>
                <a class="" id="new_jersey_anc" href="state_resource_landing?state=nj" title="NJ" target="_self">New Jersey</a>
            </li>
            <li>
                <a class="" id="new_mexico_anc" href="state_resource_landing?state=nm" title="NM" target="_self">New Mexico</a>
            </li>
            <li>
                <a class="" id="new_york_anc" href="state_resource_landing?state=ny" title="NY" target="_self">New York</a>
            </li>

            <li>
                <a class="" id="north_carolina_anc" href="state_resource_landing?state=nc" title="NC" target="_self">North Carolina</a>
            </li>
            <li>
                <a class="" id="north_dakota_anc" href="state_resource_landing?state=nd" title="ND" target="_self">North Dakota</a>
            </li>
            <li>
                <a class="" id="ohio_anc" href="state_resource_landing?state=oh" title="OH" target="_self">Ohio</a>
            </li>
            <li>
                <a class="" id="oklahoma_anc" href="state_resource_landing?state=ok" title="OK" target="_self">Oklahoma</a>
            </li>
            <li>
                <a class="" id="oregon_anc" href="state_resource_landing?state=or" title="OR" target="_self">Oregon</a>
            </li>
            <li>
                <a class="" id="pennsylvania_anc" href="state_resource_landing?state=pa" title="PA" target="_self">Pennsylvania</a>
            </li>
            <li>
                <a class="" id="rhode_island_anc" href="state_resource_landing?state=ri" title="RI" target="_self">Rhode Island</a>
            </li>
            <li>
                <a class="" id="south_carolina_anc" href="state_resource_landing?state=sc" title="SC" target="_self">South Carolina</a>
            </li>
            <li>
                <a class="" id="south_dakota_anc" href="state_resource_landing?state=sd" title="SD" target="_self">South Dakota</a>
            </li>

            <li>
                <a class="" id="tennessee_anc" href="state_resource_landing?state=tn" title="TN" target="_self">Tennessee</a>
            </li>
            <li>
                <a class="" id="texas_anc" href="state_resource_landing?state=tx" title="TX" target="_self">Texas</a>
            </li>
            <li>
                <a class="" id="utah_anc" href="state_resource_landing?state=ut" title="UT" target="_self">Utah</a>
            </li>
            <li>
                <a class="" id="vermont_anc" href="state_resource_landing?state=vt" title="VT" target="_self">Vermont</a>
            </li>

            <li>
                <a class="" id="virginia_anc" href="state_resource_landing?state=va" title="VA" target="_self">Virginia</a>
            </li>
            <li>
                <a class="" id="washington_anc" href="state_resource_landing?state=wa" title="WA" target="_self">Washington</a>
            </li>
            <li>
                <a class="" id="west_virginia_anc" href="state_resource_landing?state=wv" title="WV" target="_self">West Virginia</a>
            </li>
            <li>
                <a class="" id="wisconsin_anc" href="state_resource_landing?state=wi" title="WI" target="_self">Wisconsin</a>
            </li>
            <li>
                <a class="" id="wyoming_anc" href="state_resource_landing?state=wy" title="WY" target="_self">Wyoming</a>
            </li>
            <li>
                <a class="" id="american_samoa_anc" href="state_resource_landing?state=as" title="AS" target="_self">American Samoa</a>
            </li>
            <li>
                <a class="" id="guam_anc" href="state_resource_landing?state=gu" title="GU" target="_self">Guam</a>
            </li>
            <li>
                <a class="" id="marina_anc" href="state_resource_landing?state=mp" title="MP" target="_self">Northern Mariana Islands</a>
            </li>
            <li>
                <a class="" id="puerto_rico_anc" href="state_resource_landing?state=pr" title="PR" target="_self">Puerto Rico</a>
            </li>
            <li>
                <a class="" id="virgin_islands_anc" href="state_resource_landing?state=vi" title="VI" target="_self">Virgin Islands</a>
            </li>

        </ul>

</div>



<script>
$(document).ready(function(){

    jQuery('#titleWrapper h1').text('State Resources');
    $('#titleWrapper h1').css('textTransform', 'capitalize');

    $('.stateslist-container ul').each(function(){
        if ($(this).children('li').length > 11) {


            // below script is useful in  in ie8 and ie9 where CSS3 columns are not allowed.

            if($('body').hasClass('ie8')){
                    breakList(5, $(".stateslist"));
            }
            else if($('body').hasClass('ie9')){
                if(windowWidth > 1024){
                    breakList(5, $(".stateslist"));
                }
                else if(windowWidth < 1024 && windowWidth > 768){
                    breakList(3, $(".stateslist"));
                }
                else{
                    breakList(1, $(".stateslist"));
                }
            }
            else{
                // if CSS3 columns is allowed, add a css class.
                $(".stateslist-container ul").addClass("states-list-has-css3");
            }
        }

        function breakList(numOfLists, list){
            var listLength = list.find("li").size();
            var numInCol = Math.ceil(listLength / numOfLists);
            for (var i=0;i<numOfLists;i++){
                var listItems = list.find("li").splice(0, numInCol);
                var newList = $('<ul class="states-list-has-no-css3"/>').append(listItems);
                $(".stateslist-container").append(newList);
            }
            $(".stateslist").remove(); /*clean previous content */
        }
    });
});

</script>

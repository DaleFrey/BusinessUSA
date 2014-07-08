<!-- The following content is stored in link-to-us.php -->
<style>
    /*IMPORT ME TO MAIN CSS*/
    #copypaste_area{
        width:99%;
        margin:0px 0 30px 0px;
        height:3em;
    }
    .wizardwidgetview-container{
        float:left;
        margin-right:15px;
    }
    .wizardwidgetview-container img{
        width:100%;
    }
    .simple-icon-container{
        background-color: #6885A2;
        width: 188px;
        height: 175px;
        text-align: center;
    }
    .simple-icon-text {
        padding: 1.3em .3em 1em .3em;
        color: white;
        font: normal 21px/18px "latoblack_italic", sans-serif;
        line-height: 1em;
    }
    .wizardwidgetview-container-0{
        margin-bottom: 20px;
    }
    .wizardwidgetview-container-1{
        max-width:190px;
        margin-bottom: 20px;
    }
    .wizardwidgetview-container-2{
        max-width:222px;
        margin-bottom: 20px;
    }
    .wizardwidgetview-container-3{
        max-width:222px;
        margin-bottom: 20px;
    }
    /* END IMPORT ME TO MAIN CSS*/
</style>
﻿

<script type="text/javascript">

  function widgetfbolivepreview(param)
  {
    var searchParam = '';
    var country = '';
    var state = '';
    var industry = '';

    // Trim is not supported in IE.
    var searchval = $('input#txtwidgetsearchbox').val();

    if ($('#sltCountrylist option:selected').index() != 1)
    {
      $('#dk_container_sltStatelist').val(0);

    }

    if ($('#dk_container_sltStatelist option:selected').index() > 0)
    {
      state =  $('#dk_container_sltStatelist option:selected').text();

    }

    if ($('#sltCountrylist option:selected').index() > 0 && $('#sltCountrylist option:selected').index() > 1)
    {
      country =  $('#sltCountrylist option:selected').text();
      state = ''

    }



    if ($('#sltIndustrylist option:selected').index() > 0)
    {
      industry =  $('#sltIndustrylist option:selected').text();

      var anchortxt = $('#dk_container_sltIndustrylist a:first').text();

      if (anchortxt == 'Select the Industry')
      {
        industry = '';
      }



    }
    if  ($('#sltCountrylist option:selected').index() == 1 && (state.length == 0))
    {
      alert('Please select state to live preview');
      return;
    }


    if (($('#sltCountrylist option:selected').index() == 0))
    {
      if (($('#sltIndustrylist option:selected').index() == 0))
      {
        if ($('#txtwidgetsearchbox').val().length < 1)
        {
          alert('please select one of the options');
          return;
        }

      }

    }



    if (searchval.length > 0)
    {
      searchParam = searchval;

      if (country.length > 0)
      {
        searchParam = searchval + '+and+' + country;
      }
      if (state.length > 0)
      {
        searchParam = searchval + '+and+' + state;
      }

    }
    else if ($('#sltIndustrylist option:selected').index() > 0)
    {
      var anchortxt = $('#dk_container_sltIndustrylist a:first').text();

      if (anchortxt == 'Select the Industry')
      {
        industry = '';
      }
      searchParam = industry;

      if (country.length > 0)
      {
        searchParam = searchParam + '+and+' + country;
      }
      if (state.length > 0)
      {
        searchParam = searchParam +  '+and+' + state;
      }

    }
    else
    {
      searchParam = '';
      if (country.length > 0)
      {

        searchParam = country;
      }
      if (state.length > 0)
      {
        if ($('#sltCountrylist option:selected').index() == 1)
        {

          searchParam = state;
        }
        else
        {
          //$('#sltCountrylist').remove();
          //$('#sltCountrylist').removeData("dropkick");
          event.preventDefault();
          event.stopPropagation();
          setTimeout(function() { afterSometimestate(); }, 100);
        }
      }
      if (industry.length > 0)
      {

        searchParam = industry;
      }
      if (searchval.length > 0)
      {

        searchParam = searchval;
      }

    }


    //Calling Web APi to get the result count for 'And' operation if 0 records returned then use 'OR' operation
    var dataSearchURI = "http://api.data.gov/gsa/fbopen/v0/opps?q=" + searchParam + "&api_key=K6zrCepxUEMeci1q6ZOZ4W5LtA8u1apq8xLqbnm8";
    if ('XDomainRequest' in window && window.XDomainRequest !== null) {
      // Just pop the window open.
      window.open('fboopen-widget/fboopen-search?input='+ searchParam + '&data_source=&naics=&parent_only=&p=', 'livePreviewWindow', 'menubar=0,resizable=1,scrollbars=1');
    }
    else {
      $.get(dataSearchURI, '',
        function(data) {
          Andresultcount = parseInt(data['numFound']);

          if (Andresultcount === 0)
          {
            searchParam = searchParam.replace('and+', '');
          }

          searchParam = searchParam.replace(/\s+/g, '+');
          window.open('fboopen-widget/fboopen-search?input='+ searchParam + '&data_source=&naics=&parent_only=&p=', 'livePreviewWindow', 'menubar=0,resizable=1,scrollbars=1');
        });
    }

  }

</script>

<div  id="top"></div>
<div class="linktous-master-page-container" xmlns="http://www.w3.org/1999/html">

    <div class="mobileOnly">
      <p>This page is not supported in mobile devices.</p>
    </div>
    <div class="linktous-nonmobile-container">

        <div class="link-to-us-index">
            <h2>Index</h2>
            <ul>
                <li><a href="#wizard-section-container">Wizard Widgets</a></li>
                <li><a href="#badges">Badges & Legacy Widgets</a></li>
                <li><a href="#topic-widget">Tools Sidebar</a></li>
                <li><a href="#instructions">Terms of Service</a></li>
            </ul>
        </div>

        <div class="bodycontent-linktous tableofcontents">

            <p>We encourage all relevant website owners to use our widgets, or link to <a href="/">Business.USA.gov</a> with our logo in concert with our guidelines and only in accordance with Terms of Service below. For BusinessUSA, we have two different types of widgets - <a href="#wizard-section-container"><b>Wizards</b></a> and <a href="#badges"><b>Badges</b></a>.
                <a href="javascript: jQuery('#readmore-trigger1').hide(); jQuery('#readmore-content1').fadeIn(); void(0);" class="readmore-trigger" id="readmore-trigger1"> Read More</a>

            <span class="readmore-content" id="readmore-content1" style="display: none;">
            The Wizards are guided search tools to get business owners to the right answers as quickly as possible on government resources. The Badges are a simple representation of BusinessUSA on our site with a link to BusinessUSA.

            <br/><br/>
            BusinessUSA.gov (www.Business.USA.gov) is an official web portal for the U.S. Government to support business start-ups, growth, financing and
            exporting.  It is designed to provide access to online resources and services of Federal, state, and local Government as well as those of non-profit and educational organizations supporting businesses.
            It is a public domain website, which means you may link to Business.USA.gov at no cost.  Read more about <a href="/about-us">BusinessUSA</a>.?



            <!--<br/><strong>Text to Describe Business.USA.gov:</strong>
            <br/>Business.USA.gov is the U.S. government's official web portal to support business start-ups, growth, financing and exporting. It is designed to provide access to online resources and services of Federal, state, and local Government as well as those of non-profit and educational organizations supporting businesses.
            <br/>
            <br/><strong>To place a BusinessUSA widget on your web page</strong>
            <br/>Copy and paste the HTML source found below for the appropriate widget into your site's source.
            <br/>
            <br/>To use the logo link or the widget, we highly recommend you inform us (by use of the <a href="http://help.businessusa.gov/ics/support/ticketnewwizard.asp?style=classic&feedback=true">contact us</a> page), and include the intended website URL and contact information in your message.  This information will be used if there is a change at BusinessUSA in which you may need to be aware of.
            <br/>
            <br/>-->
               <a href="javascript: jQuery('#readmore-content1').fadeOut( function () { jQuery('#readmore-trigger1').show(); } ); void(0);" class="readless-trigger" id="readless-trigger1"><br/>Read Less</a>
            </span>
            </p>

            <h4>Using Wizard Widgets on Your Site</h4>
            <p>When you use widgets that link to <a href="/">Business.USA.gov</a>, please do it in an appropriate context as a service to your customers when they need to find official U.S. Government information and services for small business owners and exporters. In four steps, you'll be up and running.
                <a href="javascript: jQuery('#readmore-trigger2').hide(); jQuery('#readmore-content2').fadeIn(); void(0);" class="readmore-trigger" id="readmore-trigger2"> Read More</a>

            </p>
            <span class="readmore-content" id="readmore-content2" style="display: none;">
                <ol>
                    <li>Please read over our <a href="#terms_of_service">Terms of Service</a></li>
                    <li>Analyze your own website and decide on the right widget to place on your site. Below, eleven options are available for Wizards on your site.</li>
                    <li>First, select the appropriate Wizard, and you'll see three options for the size of the Widget: small (350 px), medium (760 px), and large (1047 px).  You will be able to click on 'Live Preview' to see the Widget in action or you will able to 'Show Code' and copy the code for your needs.  If you need text to highlight BusinessUSA, we have text to describe <a href="#top">BusinessUSA</a>.</li>
                    <li>Let us know if you use our widget.  To use the logo link or the widget, we highly recommend, though it is not required, that you inform us (by use of the <a href="http://help.business.usa.gov/ics/support/default.asp?deptID=30030">contact us</a> page), and include the intended website URL and contact information in your message. This information will be used if there is a change at BusinessUSA in which you may need to be aware of.
                    </li>
                </ol>
                <a href="javascript: jQuery('#readmore-content2').fadeOut( function () { jQuery('#readmore-trigger2').show(); } ); void(0);" class="readless-trigger" id="readless-trigger2">Read Less</a>

                <br/>
            </span>
        </div>


        <div class="wizard-section-container" id="wizard-section-container">

            <div id="start-a-business" class="wizard-section" description = "Start a Business">
                <div class="linktous-wizard-icon-container"></div>
                <div class="wizard-welcomemessage-title">
                    <label for="chk-start-a-business"><a href="javascript: void(0);">Start a Business</a></label>
                </div>
            </div>

            <div id="access-financing" class="wizard-section" description="Access Financing">
                <div class="linktous-wizard-icon-container" ></div>
                <div class="wizard-welcomemessage-title">
                    <label for="chk-access-financing"><a href="javascript: void(0);">Access Financing</a></label>
                </div>
            </div>

            <div id="begin-exporting"  class="wizard-section" description="Begin Exporting">
                <div class="linktous-wizard-icon-container" ></div>
                <div class="wizard-welcomemessage-title">
                    <label for="chk-begin-exporting"><a href="javascript: void(0);">Begin Exporting</a></label>
                </div>
            </div>

            <div id="expand-exporting" class="wizard-section" description="Expand Exporting">
                <div class="linktous-wizard-icon-container" ></div>
                <div class="wizard-welcomemessage-title">
                    <label for="chk-expand-exporting"><a href="javascript: void(0);">Expand Exporting</a></label>
                </div>
            </div>

            <div id="jobcenter-wizard" class="wizard-section" description="Help with Hiring Employees">
                <div class="linktous-wizard-icon-container" ></div>
                <div class="wizard-welcomemessage-title">
                    <label for="chk-jobcenter-wizard"><a href="javascript: void(0);">Help with Hiring Employees</a></label>
                </div>
            </div>

            <div id="find-opportunities" class="wizard-section" description="Find Opportunities">
                <div class="linktous-wizard-icon-container" ></div>
                <div class="wizard-welcomemessage-title">
                    <label for="chk-find-opportunities"><a href="javascript: void(0);">Find Opportunities</a></label>
                </div>
            </div>

            <div id="veterans" class="wizard-section" description="Browse Resources For Veterans">
                <div class="linktous-wizard-icon-container"></div>
                <div class="wizard-welcomemessage-title">
                    <label for="chk-veterans"><a href="javascript: void(0);">Browse Resources For Veterans</a></label>
                </div>
            </div>

            <div id="disaster-assistance" class="wizard-section" description="Seek Disaster Assistance">
                <div class="linktous-wizard-icon-container"></div>
                <div class="wizard-welcomemessage-title">
                    <label for="chk-disaster-assistance"><a href="javascript: void(0);">Seek Disaster Assistance</a></label>
                </div>
            </div>

            <div id="healthcare" class="wizard-section" description="Learn About New Healthcare Changes">
                <div class="linktous-wizard-icon-container" ></div>
                <div class="wizard-welcomemessage-title">
                    <label for="chk-healthcare"><a href="javascript: void(0);">Learn About New Healthcare Changes</a></label>
                </div>
            </div>

            <div id="taxes-and-credits" class="wizard-section" description="Learn About Taxes And Credits">
                <div class="linktous-wizard-icon-container" ></div>
                <div class="wizard-welcomemessage-title">
                    <label for="chk-taxes-and-credits"><a href="javascript: void(0);">Learn About Taxes And Credits</a></label>
                </div>
            </div>

            <div id="select-usa" class="wizard-section" description="Invest in the USA">
                <div class="linktous-wizard-icon-container"></div>
                <div class="wizard-welcomemessage-title">
                    <label for="chk-select-usa"><a href="javascript: void(0);">Invest in the USA</a></label>
                </div>
            </div>

            <div id="export"  class="wizard-section" description="Explore Exporting">
                <div class="linktous-wizard-icon-container" ></div>
                <div class="wizard-welcomemessage-title">
                    <label for="chk-explore-exporting"><a href="javascript: void(0);">Explore Exporting</a></label>
                </div>
            </div>

            <div id="browseregulations"  class="wizard-section" description="Find Regulations">
                <div class="linktous-wizard-icon-container" ></div>
                <div class="wizard-welcomemessage-title">
                    <label for="chk-browseregulations"><a href="javascript: void(0);">Find Regulations</a></label>
                </div>
            </div>

            <div id="find-green-opportunities"  class="wizard-section" description="Find Green Opportunities">
                <div class="linktous-wizard-icon-container" ></div>
                <div class="wizard-welcomemessage-title">
                    <label for="chk-find-green-opportunities"><a href="javascript: void(0);">Find Green Opportunities</a></label>
                </div>
            </div>

        </div>

        <div class="bodycontent-linktous">

            <!-- Wizard widget screen shot section -->
            <!-- this is the access financing hack... -->
            <div class="screenshots-container" style="display: none;">
                <div class="wizardwidgetview-container wizardwidgetview-container-0" id="simple-icon">
                    <div class="screenshot-container screenshot-container-0 simple-icon-container">
                        <!--div id="small-site-width"><p>|-------------- 350px-------------|</p></div-->
                        <div class="simple-icon-text"></div>
                        <img src="" class="simple-icon-img" style="display: none; width: 65px;">
                    </div><br clear="all"/>
                    <div class="wizardwidgetview-livepreview-container wizardwidgetview-livepreview-container-0">
                        <iframe title="Widget Code">Widget Code</iframe>
                    </div>
                    <div class="wizardwidgetview-controle-container wizardwidgetview-controle-container-0">
                        <div class="wizardwidgetview-controle-inner">
                            <input type="button" class="wizardwidgetview-copy-button linktous-button" value="Show Code" />
                            <input type="button" class="wizardwidgetview-livepreview-button linktous-button" value="Live Preview" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="screenshots-container" style="display: none;">
                <div class="wizardwidgetview-container wizardwidgetview-container-1">
                    <div class="screenshot-container screenshot-container-1">
                        <!--div id="small-site-width"><p>|-------------- 350px-------------|</p></div-->
                        <img class="screenshot-1-img" alt="Picture of first success story" />
                    </div>
                    <div class="wizardwidgetview-livepreview-container wizardwidgetview-livepreview-container-1">
                        <iframe title="Widget Code">Widget Code</iframe>
                    </div>
                    <div class="wizardwidgetview-controle-container wizardwidgetview-controle-container-1">
                        <div class="wizardwidgetview-controle-inner">
                            <input type="button" class="wizardwidgetview-copy-button linktous-button" value="Show Code" />
                            <input type="button" class="wizardwidgetview-livepreview-button linktous-button" value="Live Preview" />
                        </div>
                    </div>
                </div>
                <div class="wizardwidgetview-container wizardwidgetview-container-2">
                    <div class="screenshot-container screenshot-container-2">
                        <!--div id="medium-site-width"><p>|------------------760px-------------------|</p></div-->
                        <img class="screenshot-2-img" alt="Picture of second success story" />
                    </div>
                    <div class="wizardwidgetview-livepreview-container wizardwidgetview-livepreview-container-2">
                        <iframe title="Widget Code">Widget Code</iframe>
                    </div>
                    <div class="wizardwidgetview-controle-container wizardwidgetview-controle-container-2">
                        <div class="wizardwidgetview-controle-inner">
                            <input type="button" class="wizardwidgetview-copy-button linktous-button" value="Show Code" />
                            <input type="button" class="wizardwidgetview-livepreview-button linktous-button" value="Live Preview" />
                        </div>
                    </div>
                </div>
                <div class="wizardwidgetview-container wizardwidgetview-container-3">
                    <div class="screenshot-container screenshot-container-3">
                        <!-- div id="large-site-width"><p>|-----------------------------------1047px----------------------------------|</p></div -->
                        <img class="screenshot-3-img" alt="" />
                    </div>
                    <div class="wizardwidgetview-livepreview-container wizardwidgetview-livepreview-container-3">
                        <iframe title="Widget Code">Widget Code</iframe>
                    </div>
                    <div class="wizardwidgetview-controle-container wizardwidgetview-controle-container-3">
                        <div class="wizardwidgetview-controle-inner">
                            <input type="button" class="wizardwidgetview-copy-button linktous-button" value="Show Code" />
                            <input type="button" class="wizardwidgetview-livepreview-button linktous-button" value="Live Preview" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Text area t copy markup from -->
            <div class="textarea-copypaste-container" style="display: none;">
                <div class="textarea-copypaste-welcomemessage">
                    Copy the code below, and paste into your website's source-code to implement this widget
                </div>
                <div class="textarea-copypaste">
                    <label style="display: none" for="copypaste_area">Copy Paste</label>
                    <textarea id="copypaste_area"></textarea>
                </div>
            </div>
            <a class="btp" href="#top">Back to Top</a>
        </div>

        <div class="bodycontent-linktous">

            <form>

        <div class="find-widget">
            <div class="find-widget-header">Find a widget that applies to you</div>
            <div class="floatleft">
                <div class="select-country-list">
                    <select class="" onchange="getStateifusa(this)" id=sltCountrylist>
                        <option value="0">Select Country (optional)</option>
                        <option value="1">United States</option>
                        <option value="2">Afghanistan</option>
                        <option value="3">Aland Islands</option>
                        <option value="4">Albania</option>
                        <option value="5">Algeria</option>
                        <option value="6">American Samoa</option>
                        <option value="7">Andorra</option>
                        <option value="8">Angola</option>
                        <option value="9">Anguilla</option>
                        <option value="10">Antarctica</option>
                        <option value="11">Antigua and Barbuda</option>
                        <option value="12">Argentina</option>
                        <option value="13">Armenia</option>
                        <option value="14">Aruba</option>
                        <option value="15">Australia</option>
                        <option value="16">Austria</option>
                        <option value="17">Azerbaijan</option>
                        <option value="18">Bahamas</option>
                        <option value="19">Bahrain</option>
                        <option value="20">Bangladesh</option>
                        <option value="21">Barbados</option>
                        <option value="22">Belarus</option>
                        <option value="23">Belgium</option>
                        <option value="24">Belize</option>
                        <option value="25">Benin</option>
                        <option value="26">Bermuda</option>
                        <option value="27">Bhutan</option>
                        <option value="28">Bolivia</option>
                        <option value="29">Bosnia and Herzegovina</option>
                        <option value="30">Botswana</option>
                        <option value="31">Bouvet Island</option>
                        <option value="32">Brazil</option>
                        <option value="33">British Indian Ocean Territory</option>
                        <option value="34">British Virgin Islands</option>
                        <option value="35">Brunei</option>
                        <option value="36">Bulgaria</option>
                        <option value="37">Burkina Faso</option>
                        <option value="38">Burundi</option>
                        <option value="39">Cambodia</option>
                        <option value="40">Cameroon</option>
                        <option value="41">Canada</option>
                        <option value="42">Cape</option>
                        <option value="43">Cayman Islands</option>
                        <option value="44">Central African Republic</option>
                        <option value="45">Chad</option>
                        <option value="46">Chile</option>
                        <option value="47">China</option>
                        <option value="48">Christmas</option>
                        <option value="49">Cocos (Keeling) Islands</option>
                        <option value="50">Colombia</option>
                        <option value="51">Comoros</option>
                        <option value="52">Congo (Brazzaville)</option>
                        <option value="53">Congo (Kinshasa)</option>
                        <option value="54">Cook</option>
                        <option value="55">Costa</option>
                        <option value="56">Croatia</option>
                        <option value="57">Cuba</option>
                        <option value="58">Cyprus</option>
                        <option value="59">Czech Republic</option>
                        <option value="60">Denmark</option>
                        <option value="61">Djibouti</option>
                        <option value="62">Dominica</option>
                        <option value="63">Dominican Republic</option>
                        <option value="64">Ecuador</option>
                        <option value="65">Egypt</option>
                        <option value="66">El Salvador</option>
                        <option value="67">Equatorial Guinea</option>
                        <option value="68">Eritrea</option>
                        <option value="69">Estonia</option>
                        <option value="70">Ethiopia</option>
                        <option value="71">Falkland Islands</option>
                        <option value="72">Faroe Islands</option>
                        <option value="73">Fiji</option>
                        <option value="74">Finland</option>
                        <option value="75">France</option>
                        <option value="76">French Guiana</option>
                        <option value="77">French Polynesia</option>
                        <option value="78">French Southern Territories</option>
                        <option value="79">Gabon</option>
                        <option value="80">Gambia</option>
                        <option value="81">Georgia</option>
                        <option value="82">Germany</option>
                        <option value="83">Ghana</option>
                        <option value="84">Gibraltar</option>
                        <option value="85">Greece</option>
                        <option value="86">Greenland</option>
                        <option value="87">Grenada</option>
                        <option value="88">Guadeloupe</option>
                        <option value="89">Guam</option>
                        <option value="90">Guatemala</option>
                        <option value="91">Guernsey</option>
                        <option value="92">Guinea</option>
                        <option value="93">Guinea-Bissau</option>
                        <option value="94">Guyana</option>
                        <option value="95">Haiti</option>
                        <option value="96">Heard Island and McDonald Islands</option>
                        <option value="97">Honduras</option>
                        <option value="98">Hong Kong S.A.R., China</option>
                        <option value="99">Hungary</option>
                        <option value="100">Iceland</option>
                        <option value="101">India</option>
                        <option value="102">Indonesia</option>
                        <option value="103">Iran</option>
                        <option value="104">Iraq</option>
                        <option value="105">Ireland</option>
                        <option value="106">Isle</option>
                        <option value="107">Israel</option>
                        <option value="108">Italy</option>
                        <option value="109">Ivory Coast</option>
                        <option value="110">Jamaica</option>
                        <option value="111">Japan</option>
                        <option value="112">Jersey</option>
                        <option value="113">Jordan</option>
                        <option value="114">Kazakhstan</option>
                        <option value="115">Kenya</option>
                        <option value="116">Kiribati</option>
                        <option value="117">Kuwait</option>
                        <option value="118">Kyrgyzstan</option>
                        <option value="119">Laos</option>
                        <option value="120">Latvia</option>
                        <option value="121">Lebanon</option>
                        <option value="122">Lesotho</option>
                        <option value="123">Liberia</option>
                        <option value="124">Libya</option>
                        <option value="125">Liechtenstein</option>
                        <option value="126">Lithuania</option>
                        <option value="127">Luxembourg</option>
                        <option value="128">Macao S.A.R., China</option>
                        <option value="129">Macedonia</option>
                        <option value="130">Madagascar</option>
                        <option value="131">Malawi</option>
                        <option value="132">Malaysia</option>
                        <option value="133">Maldives</option>
                        <option value="134">Mali</option>
                        <option value="135">Malta</option>
                        <option value="136">Marshall Islands</option>
                        <option value="137">Martinique</option>
                        <option value="138">Mauritania</option>
                        <option value="139">Mauritius</option>
                        <option value="140">Mayotte</option>
                        <option value="141">Mexico</option>
                        <option value="142">Micronesia</option>
                        <option value="143">Moldova</option>
                        <option value="144">Monaco</option>
                        <option value="145">Mongolia</option>
                        <option value="146">Montenegro</option>
                        <option value="147">Montserrat</option>
                        <option value="148">Morocco</option>
                        <option value="149">Mozambique</option>
                        <option value="150">Myanmar</option>
                        <option value="151">Namibia</option>
                        <option value="152">Nauru</option>
                        <option value="153">Nepal</option>
                        <option value="154">Netherlands</option>
                        <option value="155">Netherlands Antilles</option>
                        <option value="156">New Caledonia</option>
                        <option value="157">New Zealand</option>
                        <option value="158">Nicaragua</option>
                        <option value="159">Niger</option>
                        <option value="160">Nigeria</option>
                        <option value="161">Niue</option>
                        <option value="162">Norfolk Island</option>
                        <option value="163">North Korea</option>
                        <option value="164">Northern Mariana Islands</option>
                        <option value="165">Norway</option>
                        <option value="166">Oman</option>
                        <option value="167">Pakistan</option>
                        <option value="168">Palau</option>
                        <option value="169">Palestinian Territory</option>
                        <option value="170">Panama</option>
                        <option value="171">Papua New Guinea</option>
                        <option value="172">Paraguay</option>
                        <option value="173">Peru</option>
                        <option value="174">Philippines</option>
                        <option value="175">Pitcairn</option>
                        <option value="176">Poland</option>
                        <option value="177">Portugal</option>
                        <option value="178">Puerto</option>
                        <option value="179">Qatar</option>
                        <option value="180">Reunion</option>
                        <option value="181">Romania</option>
                        <option value="182">Russia</option>
                        <option value="183">Rwanda</option>
                        <option value="184">Saint</option>
                        <option value="185">Saint Barthelemy</option>
                        <option value="186">Saint Kitts and Nevis</option>
                        <option value="187">Saint Lucia</option>
                        <option value="188">Saint Martin (French part)</option>
                        <option value="189">Saint Pierre and Miquelon</option>
                        <option value="190">Saint Vincent and the Grenadines</option>
                        <option value="191">Samoa</option>
                        <option value="192">San Marino</option>
                        <option value="193">Sao Tome and Principe</option>
                        <option value="194">Saudi</option>
                        <option value="195">Senegal</option>
                        <option value="196">Serbia</option>
                        <option value="197">Seychelles</option>
                        <option value="198">Sierra Leone</option>
                        <option value="199">Singapore</option>
                        <option value="200">Slovakia</option>
                        <option value="201">Slovenia</option>
                        <option value="202">Solomon Islands</option>
                        <option value="203">Somalia</option>
                        <option value="204">South Africa</option>
                        <option value="205">South Georgia and the South Sandwich Islands</option>
                        <option value="206">South Korea</option>
                        <option value="207">Spain</option>
                        <option value="208">Sri Lanka</option>
                        <option value="209">Sudan</option>
                        <option value="210">Suriname</option>
                        <option value="211">Svalbard and Jan Mayen</option>
                        <option value="212">Swaziland</option>
                        <option value="213">Sweden</option>
                        <option value="214">Switzerland</option>
                        <option value="215">Syria</option>
                        <option value="216">Taiwan</option>
                        <option value="217">Tajikistan</option>
                        <option value="218">Tanzania</option>
                        <option value="219">Thailand</option>
                        <option value="220">Timor-Leste</option>
                        <option value="221">Togo</option>
                        <option value="222">Tokelau</option>
                        <option value="223">Tonga</option>
                        <option value="224">Trinidad and Tobago</option>
                        <option value="225">Tunisia</option>
                        <option value="226">Turkey</option>
                        <option value="227">Turkmenistan</option>
                        <option value="228">Turks and Caicos Islands</option>
                        <option value="229">Tuvalu</option>
                        <option value="230">U.S. Virgin Islands</option>
                        <option value="231">Uganda</option>
                        <option value="232">Ukraine</option>
                        <option value="233">United Arab Emirates</option>
                        <option value="234">United Kingdom</option>
                        <option value="235">United States Minor Outlying Islands</option>
                        <option value="236">Uruguay</option>
                        <option value="237">Uzbekistan</option>
                        <option value="238">Vanuatu</option>
                        <option value="239">Vatican</option>
                        <option value="240">Venezuela</option>
                        <option value="241">Vietnam</option>
                        <option value="242">Wallis and Futuna</option>
                        <option value="243">Western Sahara</option>
                        <option value="244">Yemen</option>
                        <option value="245">Zambia</option>
                        <option value="246">Zimbabwe</option>
                    </select>
                </div>
                <div class="select-state-list">
                    <select id="sltStatelist" onchange="removecopyPasteArea(this)">
                        <option value="0">Select a state or Territory</option>
                        <option value="1">Alabama</option>
                        <option value="2">Alaska</option>
                        <option value="3">America Samoa</option>
                        <option value="4">Arizona</option>
                        <option value="5">Arkansas</option>
                        <option value="6">California</option>
                        <option value="7">Colorado</option>
                        <option value="8">Connecticut</option>
                        <option value="9">Delaware</option>
                        <option value="10">District of Columbia</option>
                        <option value="11">Florida</option>
                        <option value="12">Georgia</option>
                        <option value="13">Guam</option>
                        <option value="14">Hawaii</option>
                        <option value="15">Idaho</option>
                        <option value="16">Illinois</option>
                        <option value="17">Indiana</option>
                        <option value="18">Iowa</option>
                        <option value="19">Kansas</option>
                        <option value="20">Kentucky</option>
                        <option value="21">Louisiana</option>
                        <option value="22">Maine</option>
                        <option value="23">Maryland</option>
                        <option value="24">Massachusetts</option>
                        <option value="25">Michigan</option>
                        <option value="26">Minnesota</option>
                        <option value="27">Mississippi</option>
                        <option value="28">Missouri</option>
                        <option value="29">Montana</option>
                        <option value="30">Nebraska</option>
                        <option value="31">Nevada</option>
                        <option value="32">New Hampshire</option>
                        <option value="33">New Jersey</option>
                        <option value="34">New Mexico</option>
                        <option value="35">New York</option>
                        <option value="36">North Carolina</option>
                        <option value="37">North Dakota</option>
                        <option value="38">Northern Mariana Islands</option>
                        <option value="39">Ohio</option>
                        <option value="40">Oklahoma</option>
                        <option value="41">Oregon</option>
                        <option value="42">Pennsylvania</option>
                        <option value="43">Puerto Rico</option>
                        <option value="44">Rhode Island</option>
                        <option value="45">South Carolina</option>
                        <option value="46">South Dakota</option>
                        <option value="47">Tennessee</option>
                        <option value="48">Texas</option>
                        <option value="49">Utah</option>
                        <option value="50">Vermont</option>
                        <option value="51">Virgin Island</option>
                        <option value="52">Virginia</option>
                        <option value="53">Washington</option>
                        <option value="54">West Virginia</option>
                        <option value="55">Wisconsin</option>
                        <option value="56">Wyoming</option>
                    </select>
                </div>
                <br/>
                <div class="select-industry-list">
                    <select id="sltIndustrylist" onchange="disablesearchbox(this, event)" >
                        <option value="0">Select an Industry (optional)</option>
                        <option value="1">Accommodation and Food Services</option>
                        <option value="2">Administrative and Support and Waste Management and Remediation Services</option>
                        <option value="3">Agriculture</option>
                        <option value="4">Forestry</option>
                        <option value="5">Fishing</option>
                        <option value="6">Arts</option>
                        <option value="7">Entertainment</option>
                        <option value="8">Recreation</option>
                        <option value="9">Construction</option>
                        <option value="10">Educational Services</option>
                        <option value="11">Finance and Insurance</option>
                        <option value="12">Health Care and Social</option>
                        <option value="13">Information</option>
                        <option value="14">Management of Companies and Enterprises</option>
                        <option value="15">Manufacturing</option>
                        <option value="16">Mining, Quarrying, and Oil and Gas Extraction</option>
                        <option value="17">Other Services</option>
                        <option value="18">Professional, Scientific, and Technical Services</option>
                        <option value="19">Public Administration</option>
                        <option value="20">Real Estate and Rental and Leasing</option>
                        <option value="21">Retail Trade</option>
                        <option value="22">Transportation and Warehousing</option>
                        <option value="23">Utilities</option>
                        <option value="24">Wholesale Trade</option>
                    </select>
                </div>
                <div class="find-widget-text">
                    OR
                </div>
                <div>
                    <input type="text" name="searchbox" id="txtwidgetsearchbox" >
                </div>
                <div style='display:none;'>
                    <div id=”usrMsg”> here we can pass dynamic message</div>
                </div>
            </div>

            <div class="floatright">
                    <div><input type="button" value="Live Preview" id="btnlivepreview" onclick="widgetfbolivepreview(this)"></div><br/>
                    <div><input type="button" value="Show Code" id="btnshowcode" onclick="showcodewidgetCode(this)"></div>
            </div>
            <!-- Text area t copy markup from -->
            <div class="textarea-copypaste-container-fbo" style="display: none;">
                <div class="textarea-copypaste-welcomemessage">
                    Copy the code below, and paste into your website's source-code to implement this widget
                </div>
                <div class="textarea-copypaste">
                    <label style="display: none" for="copypaste_area">Copy Paste</label>
                    <textarea id="copypaste_area_fbo"></textarea>
                </div>
            </div>
        </div>

    </form>

             <div id="badges"></div>
            <h4>Using Badges and Legacy Widgets</h4>
            <p>We encourage you to use our logo and other simple widgets, which we've provided below.
                <a href="javascript: jQuery('#readmore-trigger3').hide(); jQuery('#readmore-content3').fadeIn(); void(0);" class="readmore-trigger" id="readmore-trigger3"> Read More</a>

            </p>
            <span class="readmore-content" id="readmore-content3" style="display: none;">
                <ol>
                    <li>Please read over our <a href="#terms_of_service">Terms of Service</a>. Placement of the Business.USA.gov logo is to be used only as a marker to the Business.USA.gov home page and not as a form of endorsement or approval from Business.USA.gov, the U.S. General Services Administration, or any part of the U.S. government. </li>
                    <li>Select the appropriate Badge, and click the 'Show Code' and copy the widget code for your site.</li>
                    <li>Let us know if you use our widget.  To use the logo link or the widget, we highly recommend, though it is not required, that you inform us (by use of the contact us page), and include the intended website URL and contact information in your message. This information will be used if there is a change at BusinessUSA in which you may need to be aware of.</li>

                </ol>
                <a href="javascript: jQuery('#readmore-content3').fadeOut( function () { jQuery('#readmore-trigger3').show(); } ); void(0);" class="readless-trigger" id="readless-trigger3">Read Less</a>

            </span>
            <div id="topic-widget" style="float: left; width: 75%;">
                <strong>Responsive iFrame Widget</strong>
                <br/>
                <br/><iframe src="/widget" width="300" height="350" frameBorder="0" scrolling="no" title="Widget Code">Widget Code</iframe>
                <div class="linktous-legacywidget-copypastearea-container">
                    <div class="linktous-legacywidget-copypastearea-container-showcodebutton-container">
                        <br/><br/><br />
                        <input type="button" class="linktous-legacywidget-copypastearea-container-showcodebutton linktous-button" value="Show Code" />
                        <input type="button" class="linktous-legacywidget-copypastearea-container-livepreviewbutton linktous-button" value="Live Preview" onclick="window.open('/widget', 'busawizardwidgetlivepreview', 'menubar=0,resizable=1,width=750,height=400')" />
                    </div>
                    <br clear="all">
                    <div class="linktous-legacywidget-codearea">
                        HTML Source:
                        <textarea style="width: 100%; height: 75px;" id="html_text_area">
                            <!-- NOTE: The following iFrame is responsive, so the width and height may be changed as desired -->
                            <iframe src="/widget" width="300" height="350" frameBorder="0" scrolling="no" title="Widget Code">Widget Code</iframe>
                        </textarea>
                    </div>
                </div>
            </div>
            <div id="topic-widget" style="float: right;  width:25%">
                <!--?php include_once('sites/all/pages/parature.tpl.php'); ?-->
                <img src="/sites/all/themes/bizusa/images/parature_bizusa_sidebar.png">
                <div class="linktous-legacywidget-copypastearea-container">
                    <div class="linktous-legacywidget-copypastearea-container-showcodebutton-container">
                        <br />
                        <input type="button" class="linktous-legacywidget-copypastearea-container-showcodebutton linktous-button" value="Show Code" />
                    </div>
                    <br clear="all">
                    <div class="linktous-legacywidget-codearea">
                        HTML Source:
                        <textarea style="width: 100%; height: 175px;">
                            <!-- NOTE: The following iFrame is responsive, so the width and height may be changed as desired -->
                            <?php echo file_get_contents('sites/all/pages/parature.tpl.php'); ?>
                        </textarea>
                    </div>
                </div>
            </div>
            <br clear="all">
            <div><br/>This is an embedded iFrame widget that is responsive, the width and height may be changed as desired. When doing so the widget will hide the bulleted links if they are about to be cut off from lack of space, or span the bullet-items over multiple columns if there is enough space to do so. You can view this widget directly from <a target="_blank" href="/widget">here</a> <br/></div>
            <br/>
            <br/> <br>
            <div class="basic-logo-large" style="float: left; display: inline;">
                <br/><br clear="all"><strong>Basic Logo Widget (large)</strong>
                <br/>
                <br/>
                    <span onclick="window.open('http://business.usa.gov/');" style="cursor: pointer;"><img width="244" height="52" src="/sites/all/themes/bizusa/images/logo.png" alt="Link to Business USA" border="0"></span>
                    <script type="text/javascript">
                        //<![CDATA[ var aid = "businessusa";//]]>
                    </script>
                    <script src="http://search.usa.gov/javascripts/stats.js" type="text/javascript"></script>
                <br/>
                <br/>
                <div class="linktous-legacywidget-copypastearea-container">
                    <div class="linktous-legacywidget-copypastearea-container-showcodebutton-container">
                        <input type="button" class="linktous-legacywidget-copypastearea-container-showcodebutton linktous-button" value="Show Code" />
                    </div>
                    <br clear="all">
                    <div class="linktous-legacywidget-codearea">
                        HTML Source:
                        <br/>
                        <textarea style="width: 100%; height: 175px;">
                            <a target="_blank" href="http://business.usa.gov/" style="display: block;">
                                <img width="244" height="52" src="http://business.usa.gov/sites/all/themes/bizusa/images/logo.png" alt="Link to Business USA" border="0">
                            </a>
                            <script type="text/javascript">
                                //<![CDATA[
                                aid = "businessusa";
                                //]]>
                            </script>
                            <script src="http://search.usa.gov/javascripts/stats.js" type="text/javascript"></script>
                        </textarea>
                    </div>
                </div>
            </div>
            <div class="basic-logo-go-small" style="float: left; display: inline;">
                <br/><br clear="all"><strong>Basic Logo 'Go' Widget (small)</strong>
                <br/>
                <br/>
                    <span onclick="window.open('http://business.usa.gov/');" style="cursor: pointer;"><img width="171"src="/sites/all/themes/bizusa/images/new_logo_go.png" alt="Business USA"></span>
                    <script type="text/javascript">
                        //<![CDATA[
                            aid = "businessusa";
                        //]]>
                    </script>
                    <script src="http://search.usa.gov/javascripts/stats.js" type="text/javascript"></script>
                <br/>
                <div class="linktous-legacywidget-copypastearea-container">
                    <div class="linktous-legacywidget-copypastearea-container-showcodebutton-container">
                        <input type="button" class="linktous-legacywidget-copypastearea-container-showcodebutton linktous-button" value="Show Code" />
                    </div>
                    <br clear="all">
                    <div class="linktous-legacywidget-codearea">
                        HTML Source:
                        <textarea style="width: 100%; height: 175px;">
                            <a target="_blank" href="http://business.usa.gov"><img width="171" height="29" src="http://business.usa.gov/sites/all/themes/bizusa/images/new_logo_go.png" alt="Business USA"></a>
                            <script type="text/javascript">
                                //<![CDATA[
                                    aid = "businessusa";
                                //]]>
                            </script>
                            <script src="http://search.usa.gov/javascripts/stats.js" type="text/javascript"></script>
                        </textarea>
                    </div>
                </div>
                <br/>
                <br/>
                <br clear="all">
            </div>
            <div class="basic-logo-small" style="float: left; display: inline; padding-top: 2em;">
                <strong>Basic Logo Widget (small)</strong>
                <br/>
                <br/>
                    <span onclick="window.open('http://business.usa.gov/');" style="cursor: pointer;"><img width="135" height="29" src="sites/all/themes/bizusa/images/logo.png" alt="Business USA"></span>
                    <script type="text/javascript">
                        //<![CDATA[
                            aid = "businessusa";
                        //]]>
                    </script>
                    <script src="http://search.usa.gov/javascripts/stats.js" type="text/javascript"></script>
                <br/>
                <div class="linktous-legacywidget-copypastearea-container">
                    <div class="linktous-legacywidget-copypastearea-container-showcodebutton-container">
                        <input type="button" class="linktous-legacywidget-copypastearea-container-showcodebutton linktous-button" value="Show Code" />
                    </div>
                    <br clear="all">
                    <div class="linktous-legacywidget-codearea">
                        HTML Source:
                        <textarea style="width: 100%; height: 175px;">
        <a target="_blank" href="http://business.usa.gov"><img width="171" height="29" src="http://business.usa.gov/sites/all/themes/bizusa/images/logo.png" alt="Business USA"></a>
        <script type="text/javascript">
            //<![CDATA[
                aid = "businessusa";
            //]]>
        </script>
        <script src="http://search.usa.gov/javascripts/stats.js" type="text/javascript"></script>
                        </textarea>
                    </div>
                </div>
            </div>
            <br clear="all" id="instructions"/>
            <a class="btp" href="#top">Back to Top</a>
            <br/>
            <br/><strong>Instructions:</strong>
            <br/>
            <br/>If you have any questions about linking to Business.USA.gov, the use of the Business.USA.gov logo, or want more information or promotional materials on Business.USA.gov, <a href="http://help.businessusa.gov/ics/support/ticketnewwizard.asp?style=classic&feedback=true">please contact us</a>.
            <br/>
            <br/>
            <br/><div id="terms_of_service" href="#terms_of_service"></div><h2>TERMS OF SERVICE</h2>
            <br/>For BusinessUSA Widget and Logo
            <br/>APPLICABLE TO ALL USERS
            <br/>
            <br/>
            <br/><strong>Agreement:</strong> By clicking to download and use items you are agreeing to abide by the Terms of Service (TOS) here within and by doing so make this agreement for yourself and on behalf of your organization, agency, company or entity that uses the BusinessUSA items; and attesting that you have the authority to represent such entity.
            <a href="javascript: jQuery('#readmore-trigger4').hide(); jQuery('#readmore-content4').fadeIn(); void(0);" class="readmore-trigger" id="readmore-trigger4"> Read More</a>

        <span class="readmore-content" id="readmore-content4" style="display: none;">

            <br/>
            <br/><strong>The parties:</strong>  The use of the term "You", "User", or "Your" means yourself and your organization, agency, company or the entity that is not the U.S. General Services Administration (GSA) that uses the items. The term "We", "General Services administration", "GSA", "USG" means the U.S. Government.  Together You and the U.S. Government are "the Parties" and each a "Party".
            <br/>
            <br/><strong>Rights:</strong> BusinessUSA (the term) and logo are owned by and the intellectual property of the U.S. Government (USG) and a registered service mark by General Services Administration.  The widget is likewise owned and the property of GSA.  All rights are reserved to GSA and can only be used with permission and in accordance with this terms of service.
            <br/>
            <br/><strong>Purpose:</strong> The purpose of Business.USA.gov is to be the U.S. government's official web portal to support business start-ups, growth, financing and exporting. It is designed to provide access to online resources and services of Federal, state, and local Government as well as those of non-profit and educational organizations supporting businesses.  Use of this logo and widget is only permitted on this website and sites that support this purpose.
            <br/>
            <br/><strong>Governing law:</strong> Liability for any breach of the TOS or this Amendment shall be determined under the Federal Tort Claims Act, or other governing authority and shall be governed, interpreted and enforced in accordance with the laws of the United State of America.
            <br/>The USG when entering into agreements with other parties is required to follow applicable federal laws and regulations, including those related to ethics, limitations on indemnification, fiscal law constraints, advertising and endorsements, freedom of information, governing law and dispute resolution forum.
            <br/>
            <br/><b>Title and Intellectual Property Rights:</b> To the extent permitted under Federal law, all rights, title and interest to any and all work produced and created by user pursuant to or in connection with the use of the Service shall vest the User. Ownership or possession of such rights, title and interest shall not be affected by any alleged or actual breach of the Terms of Service. Under no circumstances may the USG claim a right, title or interest in User content that is in the public domain or vice versa.
            <br/>
            <br/><strong>Changes to Standard TOS:</strong> Language in the standard TOS reserving to the USG the right to change the TOS without notice at any time is hereby amended to grant You at least three days advance notice of any material change to the TOS. Company shall send this notice to the email address You designate at the time You sign up for service.
            <br/>
            <br/><strong>Access and Use:</strong>  The use of BusinessUSA site and services may energize significant citizen engagement.  This TOS allows the USG to terminate service or close the user�s access, at any time, for any reason.
            <br/>Limitation of Liability: The Parties agree that nothing in the provisions of the TOS that limits the liability or shall be interpreted as granting the user a waiver from, release of, or limitation of liability pertaining to, any past, current or future violation of federal law.   There are no indemnification between and damages provisions of the TOS.
            <br/>
            <br/><b>No business relationship created:</b> The Parties are independent entities and nothing in this TOS creates an agency, partnership or joint venture.
            <br/>
            <br/><strong>No endorsement:</strong> The User agrees that USA.gov or BusinessUSA.gov logos and service marks shall not be used by the user to imply an endorsement, sponsorship or recommendation of your entity or its services by You.  Use is controlled by GSA Acquisition Regulation As prescribed in Section 503.570-2 "RESTRICTION ON ADVERTISING" (SEP 1999).
            <br/>
            <br/>The User shall not refer to this BusiessUSA.gov in commercial advertising or similar promotions in such a manner as to state or imply that the product or service provided is endorsed or preferred by the White House, the Executive Office of the President, or any other element of the Federal Government, or is considered by these entities to be superior to other products or services. Any advertisement by the user that refers BusinessUSA  or Business.USA.gov shall contain the following statement: "This advertisement is neither paid for nor sponsored nor endorsed, in whole or in part, by any element of the United States Government".
            <br/>
            <br/><strong>No cost agreement:</strong> Nothing in this TOS obligates either party to expend funds or incur financial obligations. The Parties acknowledge and agree that none of the obligations arising from this TOS are contingent upon the payment of fees by one party to the other.
            <br/>
            <br/><strong>Assignment:</strong> Neither party may assign its obligations under this TOS to any third party without prior written consent of the other.
            <br/>
            <br/><strong>Precedence:</strong>  Amendments or Termination: If there is any conflict between this TOS, or future Amendment and other rules or policies on the USG site or services, the Amendments shall prevail. This Amendment may be further amended upon notification.  Any variation from this TOS shall only be by written agreement, approved, and executed by both Parties.
            <br/>
            <br/><strong>Notification:</strong> To use the logo link or the widget link the using party must notify the USG by entering the contact us area and the contact us using the subject line "Logo Link" or "Widget Link" and include a contact name contact name, title, the intended website URL, business email address.  This information will be used if there is a change at BusinessUSA of which you may need to be aware.
            <br/>
            <br/><strong>Posting and availability of this TOS:</strong>  The Parties agree this TOS contains no confidential or proprietary information, and may be released to the public upon request.
            <a href="javascript: jQuery('#readmore-content4').fadeOut( function () { jQuery('#readmore-trigger4').show(); } ); void(0);" class="readless-trigger" id="readless-trigger4"></br>Read Less</a>
        </span>
        <a class="btp" href="#top">Back to Top</a>
    </div>

    <script>
        jQuery(document).ready( function () {
            $('#dk_container_sltStatelist').css('display', 'none');

            $('#txtwidgetsearchbox').watermark('Enter the Search Term (optional)');
			$.watermark.options.useNative = false;

            jQuery('.wizard-section input').hide();

            // Event handeler - when a user clicks on a wizard title/icon (container)
            jQuery('.wizard-section').bind('click', function () {
                var jqThis = jQuery(this);
                var widget_id = this.id;
                var screen_id = widget_id + '_screens';

                jQuery('.screens_section').hide();
                jQuery('#'+screen_id).show();

                //jQuery('.wizard-section input').hide();
                jQuery('.wizard-section input').not(jqThis).removeAttr('checked');
                //jqThis.find('input').show();
                jqThis.find(".linktous-input").attr('checked','checked');

                jQuery('.wizard-section').removeClass('my-current-wizard-widget-selection');
                jqThis.addClass('my-current-wizard-widget-selection');


                showWizardWidgetScreenShots(jqThis.attr('id'),jqThis.attr('description'));

                // All the buttons within screenshots-container should say "Show Source Code" now
                jQuery('.wizardwidgetview-copy-button').val('Show Code');

                // Blink the screenshots-container
                jQuery('.screenshots-container').hide();
                jQuery('.screenshots-container').fadeIn();
            });

            // Event handeler - when a user clicks on the "Show Source Code" button (legacy-widgets / not the wizard-widgets)
            jQuery('input.linktous-legacywidget-copypastearea-container-showcodebutton').bind('click', function () {
                var jqThis = jQuery(this);

                var jqCopyPasteAreaContainer = jQuery( jqThis.parents('.linktous-legacywidget-copypastearea-container') );
                if ( String(jqThis.val()).toLowerCase().indexOf('show') != -1 ) {
                    lastClick_jqCopyPasteAreaContainer = jqCopyPasteAreaContainer;
                    jqCopyPasteAreaContainer.find('.linktous-legacywidget-codearea').fadeIn();
                    var widgetSourceTextArea = jqCopyPasteAreaContainer.find('textarea');
                    var widgetSourceHTML = String(widgetSourceTextArea.val()).split('                ').join('');
                    widgetSourceTextArea.val(widgetSourceHTML);
                    jqThis.val('Hide Code');
                } else {
                    jqCopyPasteAreaContainer.find('.linktous-legacywidget-codearea').fadeOut();
                    jqThis.val('Show Code');
                }
            });

            // Event handeler - when a user clicks on the "Show Source Code" button (wizard-widget)
            jQuery('input.wizardwidgetview-copy-button').bind('click', function () {
                var jqThis = jQuery(this);

                // If the button that was just clicks says "Hide Source Code", then just hide the textarea and return
                if ( jqThis.val() != 'Show Code' ) {
                    jQuery('.textarea-copypaste-container').fadeOut();
                    jQuery('.wizardwidgetview-copy-button').val('Show Code');
                    return;
                }

                // Show the HTML-source for implementing this wizard-widget
                var myWizardWidgetViewContainer = jQuery( jqThis.parents('.wizardwidgetview-container') );
                var wizardWidgetSourceCode = generateSourceCodeForWizardWidget(myWizardWidgetViewContainer);
                jQuery('.textarea-copypaste textarea').val(wizardWidgetSourceCode);
                jQuery('.textarea-copypaste-container').hide();
                jQuery('.textarea-copypaste-container').fadeIn();

                // Change the text of this button to say "Hide Source Code" and make sure that none of the other buttons have this same text.
                jQuery('.wizardwidgetview-copy-button').val('Show Code');
                myWizardWidgetViewContainer.find('.wizardwidgetview-copy-button').val('Hide Code');

            });

            // Event handeler - when a user clicks on the "Live Preview" button
            jQuery('.wizardwidgetview-livepreview-button').bind('click', function () {
                if ( typeof livePreviewWindow != 'undefined' ) {
                    livePreviewWindow.close();
                }
                var jqIFramePreview = jQuery(this).parents('.wizardwidgetview-container');//.find('iframe');
                var newWindowURL = jqIFramePreview.attr('data-src');
                var newWindowWidth = String(jqIFramePreview.attr('data-width')).replace('px', '');
                var newWindowHeight = String(jqIFramePreview.attr('data-height')).replace('px', '');
                var newWindowArguments = 'menubar=0,resizable=1,scrollbars=1,width=' + newWindowWidth + ',height=' + newWindowHeight;
                consoleLog( 'Opening Live-Preview for wizard-widget.\nURL=' + newWindowURL + '\nArguments=' + newWindowArguments );
                livePreviewWindow = open(newWindowURL, 'livePreviewWindow', newWindowArguments);
            });
        });
        function generateSourceCodeForWizardWidget(wizardWidgetViewContainer) {
            var jqIFramePreview = jQuery(wizardWidgetViewContainer),//.find('iframe'));
                viewContainerID = jQuery(wizardWidgetViewContainer).attr('id'),
                simpleIconText = jQuery('.simple-icon-text').text(),
                image = jQuery('.simple-icon-img').attr('src'),
                retHTML = '';
                if(viewContainerID == 'simple-icon'){
                    var wizardURL = jqIFramePreview.attr('data-src').replace("?widget=1", "");
                    retHTML +=
                    "\
                    <style>\n\
                        .simple-icon-container{\n \
                            background-color: #6885A2;\n \
                            width: 188px;\n \
                            height: 175px;\n \
                            text-align: center;\n \
                        }\n \
                        .simple-icon-text {\n \
                            padding: 1.3em .3em 1em .3em;\n \
                            color: white;\n \
                            font: normal 21px/18px 'latoblack_italic', sans-serif;\n \
                            line-height: 1em;\n \
                        }\n \
                    </style>\n \
                    <a href='" + wizardURL + "' target='_BLANK' style='text-decoration: none'>\n \
                        <div class='screenshot-container screenshot-container-0 simple-icon-container'>\n \
                            <div class='simple-icon-text'>" + simpleIconText + "</div>\n \
                            <img src='http:\/\/" + location.host + image + "' class='simple-icon-img' style='width: 65px; height: auto;'>\n \
                        </div>\n \
                    </a>";
                }
                else {
                  retHTML+=  '<iframe title="Wizard IFrame" width="' + jqIFramePreview.attr('data-width') + '" height="' + jqIFramePreview.attr('data-height') + '" src="' + jqIFramePreview.attr('data-src') + '/"></iframe>';
                }

            return retHTML;
        }
        function showWizardWidgetScreenShots(wizardTitle, wizardDesc) {
            jQuery('.screenshots-container').show();
            jQuery('.screenshot-container').show();
            jQuery('.textarea-copypaste-container').hide();
            jQuery('.wizardwidgetview-livepreview-container iframe').hide();
            jQuery('.simple-icon-text').text(wizardDesc);
            jQuery('.simple-icon-img').attr('src', '/sites/all/themes/bizusa/images/wizard-images/' + wizardTitle + '.png');
            jQuery('.simple-icon-img').show();
            jQuery('.screenshot-1-img').attr('src', '/sites/all/themes/bizusa/images/linktous-wizard-widgets/' + wizardTitle + '-mobile.png');
            jQuery('.screenshot-1-img').attr('alt', wizardDesc + ' Mobile Layout');
            jQuery('.screenshot-2-img').attr('src', '/sites/all/themes/bizusa/images/linktous-wizard-widgets/' + wizardTitle + '-narrow.png');
            jQuery('.screenshot-2-img').attr('alt', wizardDesc + ' Narrow Tablet Layout');
            jQuery('.screenshot-3-img').attr('src', '/sites/all/themes/bizusa/images/linktous-wizard-widgets/' + wizardTitle + '-narrow.png');
            jQuery('.screenshot-3-img').attr('alt', wizardDesc + ' Wide Tablet Layout');
            jQuery('.wizardwidgetview-livepreview-container').attr('data-src', 'http://' + document.location.host + '/' + wizardTitle + '?widget=1');
            jQuery('.wizardwidgetview-livepreview-container').attr('data-height', '400px');
            jQuery('.wizardwidgetview-container-0').attr('data-width', '350px');
            jQuery('.wizardwidgetview-container-0').attr('data-height', '350px');
            jQuery('.wizardwidgetview-container-0').attr('data-src', 'http://' + document.location.host + '/' + wizardTitle + '?widget=1');
            jQuery('.wizardwidgetview-container-1').attr('data-src', 'http://' + document.location.host + '/' + wizardTitle + '?widget=1');
            jQuery('.wizardwidgetview-container-1').attr('data-width', '350px');
            jQuery('.wizardwidgetview-container-1').attr('data-height', '750px');
            jQuery('.wizardwidgetview-container-2').attr('data-src', 'http://' + document.location.host + '/' + wizardTitle + '?widget=1');
            jQuery('.wizardwidgetview-container-2').attr('data-width', '880px');
            jQuery('.wizardwidgetview-container-2').attr('data-height', '750px');
            jQuery('.wizardwidgetview-container-3').attr('data-src', 'http://' + document.location.host + '/' + wizardTitle + '?widget=1');
            jQuery('.wizardwidgetview-container-3').attr('data-width', '350px');
            jQuery('.wizardwidgetview-container-3').attr('data-height', '750px');
            if(wizardTitle == "jobcenter-wizard") jQuery('.simple-icon-container').css('background-color', '#e9705f');
            else if(wizardTitle == "export") jQuery('.simple-icon-container').css('background-color', '#d2d0c1');
            else jQuery('.simple-icon-container').css('background-color', '#6885A2');
            if(wizardTitle == "healthcare") jQuery('.simple-icon-text').css('padding-top', '.5em');
        }
        function getStateifusa(param) {
            var value = param.options[param.selectedIndex].value;
            $('.textarea-copypaste-container-fbo').hide();

            $('#btnshowcode').attr('value', 'Show Code');
            $('#copypaste_area_fbo').html('');

            if (value == '1') {
                $('#dk_container_sltStatelist').css('display', 'block');
            } else {
                $('#dk_container_sltStatelist').css('display', 'none');
            }
        }
            function removecopyPasteArea(param)
            {
                $('.textarea-copypaste-container-fbo').hide();

                $('#btnshowcode').attr('value', 'Show Code');
                $('#copypaste_area_fbo').html('');
            }

        function afterSometimeInd(){
            var select = $("div [id*='_sltIndustrylist']");

            var ul = $('.dk_options_inner', select);
            var current = $('li.dk_option_current', ul);

            $('li:first', ul).attr('class', 'dk_option_current');
            //current.attr('class','');
            current.removeAttr('class');

            var alink2 = document.getElementsByClassName('dk_toggle dk_label')[2];
            alink2.innerHTML = 'Select the Industry';

        }
        function afterSometimestate(){
            var select = $("div [id*='_sltStatelist']");

            var ul = $('.dk_options_inner', select);
            var current = $('li.dk_option_current', ul);

            $('li:first', ul).attr('class', 'dk_option_current');
            current.attr('class','');

            var alink2 = document.getElementsByClassName('dk_toggle dk_label')[1];
            alink2.innerHTML = 'Select a State or Territory';

        }
        function disablesearchbox(param, event)
        {
            var value = param.options[param.selectedIndex].value;

            if (value != 0)
            {
                // $('input#txtSearchbox').val("");
                //alert("Either Industry or search field is allowed");

                $('.textarea-copypaste-container-fbo').hide();

                $('#btnshowcode').attr('value', 'Show Code');
                $('#copypaste_area_fbo').html('');

                $('input#txtwidgetsearchbox').attr("disabled", "disabled");

                var searchval = $('input#txtwidgetsearchbox').val();

                if (searchval.length > 0)
                {
                    alert("Either Industry or search field is allowed");

                    event.preventDefault();
                    event.stopPropagation();
                    setTimeout(function() { afterSometimeInd(); }, 100);



                    $('input#txtwidgetsearchbox').removeAttr("disabled");
                }

            }
            else
            {
                $('input#txtwidgetsearchbox').removeAttr("disabled");
            }

        }

        function showcodewidgetCode(param)
        {
            var searchParam = '';
            var country = '';
            var state = '';
            var industry = '';
            var Andresultcount = 0;
            var location ='';

            var searchval = $('input#txtwidgetsearchbox').val();

            var btnval = $('#btnshowcode').val().toLowerCase();
            if (btnval == 'show code')
            {



            if ($('#sltCountrylist option:selected').index() != 1)
            {
                $('#dk_container_sltStatelist').val(0);

            }

            if ($('#dk_container_sltStatelist option:selected').index() > 0)
            {
                state =  $('#dk_container_sltStatelist option:selected').text();

            }
                if ($('#sltCountrylist option:selected').index() > 0 && $('#sltCountrylist option:selected').index() > 1)
                {
                    country =  $('#sltCountrylist option:selected').text();
                    state = ''

                }

                if ($('#sltIndustrylist option:selected').index() > 0)
                {
                    industry =  $('#sltIndustrylist option:selected').text();

                    var anchortxt = $('#dk_container_sltIndustrylist a:first').text();

                    if (anchortxt == 'Select the Industry')
                    {
                        industry = '';
                    }

                }

                if  ($('#sltCountrylist option:selected').index() == 1 && (state.length == 0))
                {
                    alert('Please select state to live preview');
                    return;
                }


                if (($('#sltCountrylist option:selected').index() == 0))
                {
                    if (($('#sltIndustrylist option:selected').index() == 0))
                    {
                        if ($('#txtwidgetsearchbox').val().length < 1)
                        {
                            alert('Please select one of the options.');
                            return;
                        }

                    }

                }

            if (searchval.length > 0)
            {

                searchParam = searchval;

                if (country.length > 0)
                {
                    searchParam = searchval + '+and+' + country;
                }
                if (state.length > 0)
                {
                    searchParam = searchval + '+and+' + state;
                    //searchParam = searchval + ' and ' + country + ' and ' + state;
                }


            }
            else if ($('#sltIndustrylist option:selected').index() > 0)
            {
                var anchortxt = $('#dk_container_sltIndustrylist a:first').text();

                if (anchortxt == 'Select the Industry')
                {
                    industry = '';
                }
                searchParam = industry;

                if (country.length > 0)
                {
                    searchParam = searchParam + '+and+' + country;
                }
                if (state.length > 0)
                {
                    searchParam = searchParam +  '+and+' + state;
                }

            }
            else
            {
                searchParam = '';
                if (country.length > 0)
                {

                    searchParam = country;
                }
                if (state.length > 0)
                {
                    if ($('#sltCountrylist option:selected').index() == 1)
                    {

                        searchParam = state;
                    }
                    else
                    {
                        //$('#sltCountrylist').remove();
                        //$('#sltCountrylist').removeData("dropkick");
                        event.preventDefault();
                        event.stopPropagation();
                        setTimeout(function() { afterSometimestate(); }, 100);
                    }
                }
                if (industry.length > 0)
                {

                    searchParam = industry;
                }
                if (searchval.length > 0)
                {

                    searchParam = searchval;
                }

            }

            //Calling Web APi to get the result count for 'And' operation if 0 records returned then use 'OR' operation
            // alert(searchParam);

            if ('XDomainRequest' in window && window.XDomainRequest !== null) {

              var retHTML = '<iframe width="220px" height="100px" title="fbo_widget" src="'+ window.location.origin + "/fboopen-widget/fboopen-linktous?" + searchParam + '"></iframe>';

              $('#copypaste_area_fbo').val(retHTML);
              $('.textarea-copypaste-container-fbo').show();
              return;
            }
            //  Perform request if we can proceed.
            $.get("http://api.data.gov/gsa/fbopen/v0/opps?q=" + searchParam + "&api_key=K6zrCepxUEMeci1q6ZOZ4W5LtA8u1apq8xLqbnm8", '',
                    function(data){
                        Andresultcount = parseInt(data['numFound']);


                        if (state.length > 0)
                        {
                            searchParam = 'location=' + state;
                        }
                        else
                        {
                            searchParam = 'location=' + country;
                        }
                        if (industry.length > 0 && searchval.length == 0)
                        {
                            searchParam = searchParam + '&industry=' + industry;
                        }
                        else
                        {
                            searchParam = searchParam + '&industry=' + searchval;
                        }

                        if (Andresultcount === 0)
                        {
                            searchParam = searchParam.replace('and+', '');
                            searchParam = searchParam + '&op=or'
                        }
                        else
                        {
                            searchParam = searchParam + '&op=and'
                        }


                        $('.textarea-copypaste-container-fbo').show();
                        $('#btnshowcode').attr('value', 'Hide Code');
                        //var src = location.protocol + '//' + document.location.host + '/fbo-open-widget?input=' + searchParam + '&data_source=&naics=&parent_only=&p=';

                        $('.textarea-copypaste-container-fbo').show();


                        searchParam = searchParam.replace(/\s+/g, '+');

                        var retHTML = '<iframe width="240px" height="120px" title="fbo_widget" src="'+ window.location.origin + "/fboopen-widget/fboopen-linktous?" + searchParam + '"></iframe>';

                        $('#copypaste_area_fbo').html(retHTML);


                    });

            }
            else
            {
                $('.textarea-copypaste-container-fbo').hide();

                $('#btnshowcode').attr('value', 'Show Code');
                $('#copypaste_area_fbo').html('');
            }

        }



    </script>
    </div>

</div>

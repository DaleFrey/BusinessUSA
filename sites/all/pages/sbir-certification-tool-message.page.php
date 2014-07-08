
<div class="vendorLightBox">
    <div class="vendorLightBoxWrapper" >
        <!-- Logo -->
        <div class="vendorLightBox-logo">
            <div class="kill-vendorLightBox" onclick="jQuery.colorbox.close();">
                Close
            </div>
            <div class="vendorLightBox-logo-innerwrapper">
                <img src="/sites/all/themes/bizusa/images/logo.png" />
            </div>
        </div>
        <!-- message area -->
        <div class="vendorLightBox-msg-area">
            <?php if (isset($_POST['profit']) && $_POST['profit'] === 'false') { ?>
                <p>
                    All businesses that apply for the SBIR program must be for-profit companies located in the US.  Per the <a href="http://sbir.gov/sites/default/files/elig_size_compliance_guide.pdf" target="_blank">Guide to SBIR/STTR Program Eligibility</a>, "An SBIR/STTR small business awardee must be a business concern – it must be organized as a for-profit concern and meet all of the other requirements for a “business concern” in 13 C.F.R. § 121.105. Non-profit entities are not eligible (except as research institutions under the STTR Program)."
                </p>
            <?php };
            if (isset($_POST['location']) && $_POST['location'] === 'false') { ?>
                <p>
                    All businesses that apply for the SBIR program must be for-profit companies located in the US.  Per the <a href="http://sbir.gov/sites/default/files/elig_size_compliance_guide.pdf" target="_blank">Guide to SBIR/STTR Program Eligibility</a>, "An SBIR/STTR small business awardee must be a business concern – it must be organized as a for-profit concern and meet all of the other requirements for a “business concern” in 13 C.F.R. § 121.105. Non-profit entities are not eligible (except as research institutions under the STTR Program)."
                </p>
            <?php };
            if (isset($_POST['ownership'])){if ($_POST['ownership'] === 'false') {?>
                <p>
                    Per the <a href="http://sbir.gov/sites/default/files/elig_size_compliance_guide.pdf" target="_blank">Guide to SBIR/STTR Program Eligibility</a>, "A majority (more than 50%) of your firms’ equity (e.g., stock) must be directly owned and controlled by one of the following:

                    1.      1)  One or more individuals who are citizens or permanent resident aliens of the US,

                    2.      2)  Other for-profit small business concerns (each of which is directly owned and controlled by individuals who are citizens or permanent resident aliens of the US).

                    3.      3)  A combination of (1) and (2) above.

                    4.      4)  Multiple venture capital operating companies, hedge funds, private equity firms, or any combination of these, so long as no one such firm owns or controls more than 50% of the equity. Note: This option is allowed only for SBIR awards from agencies that are using the authority provided in § 5107 of the SBIR/STTR Reauthorization Act (majority-VC-owned authority), 15 U.S.C. § 638(dd)(1).

                    *The venture capital operating company, hedge fund or private equity firm must have a place of business located in the United States and be created or organized in the United States, or under the law of the United States or of any State.

                    Note: If an Employee Stock Ownership Plan owns all or part of the concern, each stock trustee and plan member is considered an owner. If a trust owns all or part of the concern, each trustee and trust beneficiary is considered an owner."
                </p>
            <?php } elseif ($_POST['ownership'] === 'yes_multiple') { ?>
                <p>
                    Per the <a href="http://sbir.gov/faq/eligibility#t46143n390807" target="_blank">SBIR.gov</a> site, For SBIR [not STTR] program only:  Some of the 11 federal agencies administering SBIR awards may choose to issue a portion of their awards to firms that are majority-owned by multiple venture capital operating companies, hedge funds, or private equity firms.  You can see which agency is currently using this authority <a href="http://www.sbir.gov/vc-ownership-authority" target="_blank">here</a>.
                </p>
            <?php } };
            if (isset($_POST['employee']) && $_POST['employee'] === 'false') {?>
                <p>
                    Per the <a href="http://sbir.gov/sites/default/files/elig_size_compliance_guide.pdf" target="_blank">Guide to SBIR/STTR Program Eligibility</a> "

                    The size requirement: An SBIR/STTR awardee, together with its affiliates, must not have more than 500 employees.

                    Is size determined by revenue for SBIR/STTR? No, for SBIR/STTR, size is determined only by the number of employees. There are no revenue limits.
                    What is the definition of an employee? For the SBIR/STTR programs, an employee includes
                    all individuals employed on a full-time, part-time, or other basis. This includes employees obtained from a temporary employee agency, professional employee organization or leasing concern. SBA will consider the totality of the circumstances, including criteria used by the IRS for Federal income tax purposes, in determining whether individuals are employees of a concern. Volunteers (i.e., individuals who receive no compensation, including no in-kind compensation, for work performed) are not considered employees. See 13 C.F.R. § 121.106(a)."
                </p>
            <?php }; ?>
        </div>
    </div>
</div>
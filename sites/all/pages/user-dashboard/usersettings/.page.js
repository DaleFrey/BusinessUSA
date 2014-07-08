jQuery(document).ready( function () {

    jQuery('.dashboardsettings-section-wizards li').bind('click', function () {
        
        var jqThis = jQuery(this);
        
        jqThis.toggleClass('wizard-selected-true');
        jqThis.toggleClass('wizard-selected-false');
        
        var theRealCheckbox = jqThis.find('input');
        if ( jqThis.hasClass('wizard-selected-true') ) {
            theRealCheckbox.attr('checked', 'checked');
            theRealCheckbox.get(0).checked = true;
        } else {
            theRealCheckbox.removeAttr('checked');
            theRealCheckbox.get(0).checked = false;
        }
        
    });
    
    // Event handler for clicking a title section in mobile view (accordion implementation)
    jQuery('.dashboardsettings-section-head').bind('click', function () {
        if ( jQuery(window).width() < 768) {
            var jqThis = jQuery(this);
            jqThis.parent().find('.collapsable-container').slideToggle();
            jqThis.toggleClass('expanded');
            jqThis.toggleClass('collapsed');
        }
    });
    
});
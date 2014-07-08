jQuery(document).ready( function () {
    
    jQuery('body').removeClass('toolbar');
    jQuery('body').removeClass('admin-menu');
    
    gatherJiraInformation();
});

function userLogInFormSubmitEvent() {
    
    jQuery.colorbox.close();
    createCookie('jira_user', jQuery('.jirauser:visible').val(), 30);
    createCookie('jira_pass', jQuery('.jirapass:visible').val(), 30);

    document.location.reload();
}

function gatherJiraInformation() {
    
    // Ensure we have a Jira user/pass
    if ( readCookie('jira_user') == null && jQuery('.codereview-colorbox-jiraauth').length > 0 ) {
        // Show UI to get the user's JIra username/password
        jQuery.colorbox({
            html: jQuery('.codereview-colorbox-jiraauth').html(),
            overlayClose: false,
            escKey: false,
            onLoad: function () {
                jQuery('#cboxClose').hide();
                jQuery('.jirauser:visible').focus();
            },
            onClosed: function () {
                jQuery.colorbox({
                    html: jQuery('.codereview-colorbox-gathering').html()
                });
            }
        });
        return;
    }
    
}

function commentFormSubmitEvent(jqCommentForm, jiraTicket, lineNumber, filePath) {
    
    jQuery.colorbox({
        html: jQuery('.codereview-colorbox-gathering').html()
    });
    
    var commentString = jqCommentForm.find('textarea').val();
    commentString = commentString.replace(/\n/g, "\\n");
    
    var phpFunctionName = 'codereview_postCodeReviewComment';
    var phpFunctionArguments = [
        jiraTicket, 
        readCookie('jira_user'), 
        readCookie('jira_pass'), 
        filePath, 
        lineNumber, 
        commentString
    ];
    phpFunction(phpFunctionName, phpFunctionArguments, [], function (data) {
        var injectCommentHTML = jqCommentForm.find('textarea').val();
        var injectCommentHTML = injectCommentHTML.replace(/\n/g, "<br/>");
        var injectHTML = '\
            <div class="codereview-comment-container last">\
            <div class="codereview-comment-picname">\
                <img class="codereview-comment-pic" src="data:image/png;base64,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">\
                <span class="codereview-comment-name">\
                    ' + readCookie('jira_user') + '\
                </span>\
                <span class="codereview-comment-colon">:</span>\
                <span class="codereview-comment-date">\
                    Just now\
                </span>\
            </div>\
            <div class="codereview-comment-text">\
                ' + jqCommentForm.find('textarea').val() + '\
            </div>\
        </div>\
        ';
        jQuery(injectHTML).insertBefore(jqCommentForm);
        jQuery.colorbox.close();
        jqCommentForm.find('textarea').val('');
        jqCommentForm.parents('.codereview-comments-container').removeClass('clicked');
        jqCommentForm.parents('.codereview-comments-container').prev().removeClass('clicked');
        blahtest = jqCommentForm;
        setTimeout( function () {
            alert('Your message has been posted into Jira ticket ' + jiraTicket);
        }, 800);
    });
    
}

function diffLineMouseOverEvent(lineNumber) {
    scrollLineNumber = lineNumber;
    setTimeout( function () {
        jQuery('.codereview-comments-container-' + scrollLineNumber + ' textarea').focus();
        jQuery('.codereview-comments-container-' + scrollLineNumber + ' .codereview-comments-innercontainer').stop().animate({
            scrollTop: jQuery('.codereview-comments-container-' + scrollLineNumber + ' .codereview-comments-innercontainer').get(0).scrollHeight
        }, 500);
        jQuery('.codereview-comments-container-' + scrollLineNumber + ' textarea').focus();
    }, 150);
}

function diffLineClickEvent(lineNumber) {
    jQuery('.codereview-diff-line-' + lineNumber).toggleClass('clicked');
    jQuery('.codereview-comments-container-' + lineNumber).toggleClass('clicked');
    if ( jQuery('.codereview-comments-container-' + lineNumber).hasClass('clicked') ) {
        diffLineMouseOverEvent(lineNumber);
    }
}







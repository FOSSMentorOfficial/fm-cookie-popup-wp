jQuery(document).ready(function ($) {

    let cookie_types = [];

    let ga = {
        type: 'Google Analytics',
        value: 'ga',
        description: GDPRCookieMaker.ga_code_description,
        lifetime: GDPRCookieMaker.ga_code_lifetime,
    };

    let fb = {
        type: 'Facebook',
        value: 'fb',
        description: GDPRCookieMaker.fb_code_description,
        lifetime: GDPRCookieMaker.fb_code_lifetime,
    };

    let additional_cookie_1 = {
        type: GDPRCookieMaker.custom_code_1_label,
        value: 'custom_code_1',
        description: GDPRCookieMaker.custom_code_1_desc,
        lifetime: GDPRCookieMaker.custom_code_1_lifetime,
    };

    let additional_cookie_2 = {
        type: GDPRCookieMaker.custom_code_2_label,
        value: 'custom_code_2',
        description: GDPRCookieMaker.custom_code_2_desc,
        lifetime: GDPRCookieMaker.custom_code_2_lifetime,
    };

    if ( '' !== GDPRCookieMaker.ga_used && '' !== GDPRCookieMaker.fb_used ) {
        cookie_types = [ga, fb, additional_cookie_1, additional_cookie_2];
    } else if ( '' !== GDPRCookieMaker.ga_used ) {
        cookie_types = [ga, additional_cookie_1, additional_cookie_2];
    } else if ( '' !== GDPRCookieMaker.fb_used ) {
        cookie_types = [fb, additional_cookie_1, additional_cookie_2];
    } else {
        cookie_types = [additional_cookie_1, additional_cookie_2];
    }

    $('body').ihavecookies({
        onAccept: function(){ window.location.reload(); },
        title: GDPRCookieMaker.headline,
        message: '<div id="gdpr-cookie-text">' + GDPRCookieMaker.message + '</div>',
        link: GDPRCookieMaker.privacy_page,
        delay: GDPRCookieMaker.trigger_time,
        expires: GDPRCookieMaker.expiration_time,
        cookieTypes: cookie_types,
        moreInfoLabel: GDPRCookieMaker.privacy_page_text,
        acceptBtnLabel: GDPRCookieMaker.accept,
        advancedBtnLabel: GDPRCookieMaker.customize,
        cookieTypesTitle: GDPRCookieMaker.cookie_type_title,
        fixedCookieTypeLabel:GDPRCookieMaker.necessary,
        fixedCookieTypeDesc: GDPRCookieMaker.necessary_desc,
        fixedCookieLifetime: GDPRCookieMaker.required_code_lifetime,
    });


    $(document).on('click', '.GDPRCookieMaker-toggle a', function() {
        var cookie = $(this).attr('data-cookie');

        $("table[data-cookie='" + cookie +"']").toggle();
        $(this).text($(this).text() == GDPRCookieMaker.more_information ? GDPRCookieMaker.less_information : GDPRCookieMaker.more_information );
    });
});

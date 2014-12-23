function imgHeightWidth() {
    var windowHeight = jQuery(window).height();
    jQuery('.homeImageWrapper, .homeIphoneImageWrapper').height(windowHeight);
    var fullWidth = (jQuery(window).width());

    var windowWidht = jQuery(".photoGallery .example-pager2").width();
    var sliderLeftText = ((windowWidht)/2);
    jQuery(".photoGallery .example-pager2").css({width: windowWidht});
    jQuery(".photoGallery .example-pager2").css({marginLeft: - sliderLeftText});
}

/* Vinny's Schedule scrollbar */

jQuery(window).load(function() {
    jQuery(".homeImageWrapper img").addClass("loadedImages");
});

function hideDiv(){

    if(jQuery(window).width()<=767){

        jQuery(".pageContentWrapper").hide();

        jQuery("#homeScheduleScrollbar, #statsTableInner1, #statsTableInner2, #statsTableInner3, #statsTableInner4, #statsTableInner5, #statsTableInner6, #statsTableInner7, #statsTableInner8, #statsTableInner9, .January, .February, .March, .April, .May, .June, .July, .August, .September, .October, .November, .December, #scheduleScrollbar, #statsScrollbar, #splitsScrollbar, #gameLogsScrollbar, #tweets, .patientTabs, .innerMenuInner").mCustomScrollbar("destroy");

        /* Disable fancybox on mobile */
        jQuery(".photoGallery a").removeClass("fancybox");
        jQuery(".photoGallery a").click(function(e){
            e.preventDefault();
        });

        jQuery('.footerToolTip[title]').qtip({
            position:{
                my:'top center',
                adjust:{
                    x:-6,
                    y:2
                }
            },
            style:{
                classes:'qtip-dark qtip-rounded'
            }
        });
    }
}

function abc(wsize){
    if(wsize>768){
        /* Top search bar*/
        jQuery(".searchForm .searchIcon").click(function () {
            jQuery(".searchForm .searchBtn").animate({left:'0'});
            jQuery(this).css('display', 'none');
            jQuery(".searchForm input, .searchForm .searchBtn").css('display', 'block');
            jQuery(".searchForm input").animate({width:'154px'});
            setTimeout(function () {
                jQuery(".searchForm input").focus();
            }, 400);
        });

        jQuery('.footerToolTip[title]').qtip({
            position:{
                my:'top center',
                adjust:{
                    x:-29,
                    y:2
                }
            },
            style:{
                classes:'qtip-dark qtip-rounded'
            }
        });

    }else if(wsize > 480){
        /* Top search bar*/

        jQuery(".searchForm .searchIcon").click(function () {
            jQuery(".searchForm .searchBtn").animate({left:'18px'});
            jQuery(this).css('display', 'none');
            jQuery(".searchForm input, .searchForm .searchBtn").css('display', 'block');
            jQuery(".searchForm input").animate({width:'78%'});
            setTimeout(function () {
                jQuery(".searchForm input").focus();
            }, 400);
        });

    }else{

        /* Top search bar*/
        jQuery(".searchForm .searchIcon").click(function () {
            jQuery(".searchForm .searchBtn").animate({left:'10px'});
            jQuery(this).css('display', 'none');
            jQuery(".searchForm input, .searchForm .searchBtn").css('display', 'block');
            jQuery(".searchForm input").animate({width:'78%'});
            setTimeout(function () {
                jQuery(".searchForm input").focus();
            }, 400);
        });
    }
}

jQuery(document).ready(function () {

    jQuery(".innerMenuInner").height(jQuery(window).height());

    jQuery(".scheduleForm select").wrap("<span class='styledSelect'></span>");

    jQuery(".homeImageWrapper").fullScreenImage({
        imageHeight:758,
        imageWidth:800,
        verticalPosition:'center',
        horizontalPosition:'right'
    });

    jQuery(".homeIphoneImageWrapper").fullScreenImage({
        imageHeight:403,
        imageWidth:160,
        verticalPosition:'center',
        horizontalPosition:'right'
    });

    jQuery('.contentToggleBtn').click(function () {
        jQuery(".contentToggleBtn").removeClass("active");
        if (jQuery(this).parent("section").hasClass("active")) {
            jQuery(this).parent("section").removeClass("active");
            jQuery(this).removeClass("active");
            jQuery(this).next(".pageContentWrapper").stop(true, false).hide();
//            return false;

        }  else {
            jQuery(this).parent("section").addClass("active");
            jQuery(this).addClass("active");
            jQuery(this).next(".pageContentWrapper").stop(true, false).show();
           jQuery(this).parents("section").siblings().removeClass("active");
            jQuery(this).parents("section").siblings().find(".pageContentWrapper").hide();
//            return false;
        }
        var id = "#"+jQuery(this).parent("section").attr("id");
        jQuery('html,body').animate({
                scrollTop: jQuery(id).offset().top - 70},
            '500');
    });

    jQuery('.home img[usemap]').rwdImageMaps();

    jQuery("#foundationSlider .foundationImageSlider").foundationFullScreenImageInner({
        imageHeight:800,
        imageWidth:1600,
        windowHeight:800
    });

    jQuery("#playerSlider .playerImageSlider").fullScreenImageInner({
        imageHeight:516,
        imageWidth:1600,
        windowHeight:516
    });

    //imgHeightWidth();
    browserBlast({
        devMode:false, // Show warning on all browsers for testing
        supportedIE:'8' // Supported IE version, warning will display on older browsers
    });

    //calling custom scroll bar method
    jQuery("#scheduleScrollbar, #statsScrollbar, #splitsScrollbar, #gameLogsScrollbar, #tweets, .patientTabs, .innerMenuInner").mCustomScrollbar({
        scrollButtons:{
            enable:true
        },
        advanced:{
            updateOnContentResize:true
        }
    });

    jQuery(".vinnyRight").hover(function () {
        jQuery(this).attr("src", "/wp-content/themes/vinny/img/vinny-right-over.png");
        jQuery(".rightImg").stop().fadeIn("fast");

    }, function () {
        jQuery(this).attr("src", "/wp-content/themes/vinny/img/vinny-right.png");
        jQuery(".rightImg").stop().fadeOut("fast");
    });

    jQuery(".vinnyLeft").hover(function () {
        jQuery(this).attr("src", "/wp-content/themes/vinny/img/vinny-left-over.png");
        jQuery(".leftImg").stop().fadeIn("fast");
    }, function () {
        jQuery(this).attr("src", "/wp-content/themes/vinny/img/vinny-left.png");
        jQuery(".leftImg").stop().fadeOut("fast");
    });

    //Home page Vinny left right image mapping and responsive

    jQuery(".goToContactUs").click(function (e) {
        jQuery(".navbar .mainNav li a[href='#contactUs']").trigger("click");
        e.preventDefault();
    });
    jQuery(".nextBtn").not(".firstBtn").click(function (e) {
        jQuery(".navbar .mainNav li.active").next("li").find("a").trigger("click");
        e.preventDefault();
    });
    jQuery(".firstBtn").click(function (e) {
        jQuery(".navbar .mainNav li a[href='#meetVinny']").trigger("click");
        e.preventDefault();
    });
    jQuery(".aboutFirstBtn").click(function (e) {
        jQuery(".navbar .mainNav li a[href='#aboutVinny']").trigger("click");
        e.preventDefault();
    });
    jQuery("#seeMore").click(function (e) {
        jQuery(".navbar .mainNav li a[href='#schedule']").trigger("click");
        e.preventDefault();
    });
    jQuery(".vinnyNews a.continue, .vinnyNews a.readMore").click(function (e) {
        jQuery(".navbar .mainNav li a[href='#news']").trigger("click");
        e.preventDefault();
    });
    jQuery(".contactUsLink").click(function (e) {
        jQuery(".navbar .mainNav li a[href='#contactUs']").trigger("click");
        e.preventDefault();
    });


// Bind click handler to menu items
// so we can get a fancy scroll animation

    if(jQuery(window).width()<768)
        hideDiv();

    /*  Services tabs */
    jQuery("#statsSubNavWrapper li").first().addClass("active");

    jQuery(".tab").hide();
    jQuery(".tab").first().stop(true, false).slideDown();
    jQuery("#statsSubNavWrapper a").click(function () {
        jQuery("#statsSubNavWrapper li").removeClass("active");
        jQuery(this).parent().addClass("active");
        jQuery(".tab").stop(true, false).slideUp();
        var tabIteam = jQuery(this).attr("href");
        jQuery(tabIteam).stop(true, false).slideDown();
        return false;
    });

    /*  Media tabs */
    jQuery("#mediaSubNavWrapper li").first().addClass("active");

    jQuery(".mediaTab").hide();
    jQuery(".mediaTab").first().stop(true, false).slideDown();
    jQuery("#mediaSubNavWrapper a").click(function () {
        jQuery("#mediaSubNavWrapper li").removeClass("active");
        jQuery(this).parent().addClass("active");
        jQuery(".mediaTab").stop(true, false).slideUp();
        var tabIteam = jQuery(this).attr("href");
        jQuery(tabIteam).stop(true, false).slideDown();
        return false;
    });

    /*  Foundation Media tabs */
    jQuery("#foundationMediaSubNavWrapper li").first().addClass("active");

    jQuery(".foundationMediaTab").hide();
    jQuery(".foundationMediaTab").first().stop(true, false).slideDown();
    jQuery("#foundationMediaSubNavWrapper a").click(function () {
        var url = jQuery(".videoTabBox.active iframe").attr('src');
        jQuery(".videoTabBox.active iframe").attr("src", "");
        jQuery(".videoTabBox.active iframe").attr("src", url);
        jQuery("#foundationMediaSubNavWrapper li").removeClass("active");
        jQuery(this).parent().addClass("active");
        jQuery(".foundationMediaTab").stop(true, false).slideUp();
        var tabIteam = jQuery(this).attr("href");
        jQuery(tabIteam).stop(true, false).slideDown();
        return false;
    });

    /*  Video tabs */
    jQuery("#cycle-2 a, #cycle-3 a").first().addClass("active");

    jQuery(".videoTabBox").hide();
    jQuery(".videoTabBox").first().stop(true, false).slideDown();
    jQuery(".videoTabBox").first().addClass('active');
    jQuery("#cycle-2 a, #cycle-3 a").click(function () {
        var url = jQuery(".videoTabBox.active iframe").attr('src');
        jQuery(".videoTabBox.active iframe").attr("src", "");
        jQuery(".videoTabBox.active iframe").attr("src", url);
        jQuery("#cycle-2 a, #cycle-3 a").removeClass("active");
        jQuery(this).addClass("active");
        jQuery(".videoTabBox").stop(true, false).slideUp();
        jQuery(".videoTabBox").removeClass('active');
        var tabIteam = jQuery(this).attr("href");
        jQuery(tabIteam).stop(true, false).slideDown();
        jQuery(tabIteam).addClass('active');
        return false;
    });

    /*  Meet the patients tabs */
    jQuery(".thumbnailUl li").first().addClass("active");

    jQuery(".patientsTab").hide();
    jQuery(".patientsTab").first().stop(true, false).slideDown();
    jQuery(".thumbnailUl a").not(".patientPagination").click(function () {
        jQuery(".thumbnailUl li").removeClass("active");
        jQuery(this).parent().addClass("active");
        jQuery(".patientsTab").stop(true, false).slideUp();
        var tabIteam = jQuery(this).attr("href");
        jQuery(tabIteam).stop(true, false).slideDown();
        return false;
    });

    /* News details */
    jQuery(".moreNewsBlock").hide();
    jQuery('.vinnyNewsList a.moreNews').click(function (e) {
        e.preventDefault();
        jQuery(".moreNewsBlock").slideUp();
        jQuery(".lessNewsBlock").slideDown();
        jQuery(this).parents("li:first").find(".lessNewsBlock").slideUp();
        jQuery(this).parents("li:first").find(".moreNewsBlock").slideDown();
    });

    jQuery('.vinnyNewsList .collapseBtn').click(function (e) {
        jQuery(".moreNewsBlock").slideUp();
        jQuery(".lessNewsBlock").slideDown();
        jQuery(".navbar .nav li a[href='#news']").trigger("click");
    });

    jQuery("#logo, .topBtn").on("click", function () {
        jQuery("html, body").animate({ scrollTop:0 }, 500);
        return false;
    });

    /* Tooltip */
    jQuery('.toolTip[title]').qtip({
        position:{
            my:'bottom center',
            adjust:{
                x:-4,
                y:-18
            }
        },
        style:{
            classes:'qtip-dark qtip-rounded'
        }
    });

    //    This adds 'placeholder' to the items listed in the jQuery .support object.
    jQuery(function () {
        jQuery.support.placeholder = false;
        test = document.createElement('input');
        if ('placeholder' in test) jQuery.support.placeholder = true;
    });
// This adds placeholder support to browsers that wouldn't otherwise support it.
    jQuery(function () {
        if (!jQuery.support.placeholder) {
            var active = document.activeElement;
            jQuery(':text, textarea').focus(function () {
                if (jQuery(this).attr('placeholder') != '' && jQuery(this).val() == jQuery(this).attr('placeholder')) {
                    jQuery(this).val('').removeClass('hasPlaceholder');
                    jQuery(this).css('color', '#272727');
                }
            }).blur(function () {
                    if (jQuery(this).attr('placeholder') != '' && (jQuery(this).val() == '' || jQuery(this).val() == jQuery(this).attr('placeholder'))) {
                        jQuery(this).val(jQuery(this).attr('placeholder')).addClass('hasPlaceholder');
                        jQuery(this).css('color', '#999');
                    }
                });
//            jQuery(':text, textarea').blur();
            jQuery(':text, textarea').each(function () {
                if (jQuery(this).attr('placeholder') != '' && (jQuery(this).val() == '' || jQuery(this).val() == jQuery(this).attr('placeholder'))) {
                    jQuery(this).val(jQuery(this).attr('placeholder')).addClass('hasPlaceholder');
                    jQuery(this).css('color', '#999');
                }
            });
        }
    });

    jQuery(".loadingImage").hide();
    //ajax call for schedule page
    jQuery('#scheduleForm').submit(schedule_form);
    function schedule_form() {
        var newScheduleForm = jQuery(this).serialize();
        jQuery(".loadingImage").show();
        jQuery.ajax({
            type:"POST",
            url:"/wp-admin/admin-ajax.php?action=getStatistics",
            data:newScheduleForm,
            success:function (data) {
                jQuery("#statisticsTable").html(data);
                jQuery(".loadingImage").hide();
            },
            error:function (errorThrown) {
                alert(errorThrown);
            }
        });
        return false;
    }

    //phone number validation
    jQuery("#phoneNumber").keydown(function (event) {
        var phoneNo = jQuery(this).val();
        if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 ||
            // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) ||
            // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault();
            }
        }
        if (phoneNo.length == 3) {
            jQuery(this).val("(" + phoneNo + ") ");
        }
        if (phoneNo.length == 9) {
            jQuery(this).val(phoneNo + "-");
        }

        if (phoneNo.length > 3) {
            if (phoneNo.charAt(0) != '(' || phoneNo.charAt(4) != ')' || phoneNo.charAt(9) != '-') {
                var mystr = phoneNo.replace(")", "").replace("(", "").replace("-", "").replace(/\s/g, '');
                var mynewstring = '(' + mystr.substr(0, 3) + ') ' + mystr.substr(3, 3) + '-' + mystr.substr(6, 3);
                jQuery(this).val(mynewstring);
            }
        }
        return;
    });

    //submit contact form
    jQuery("#contactForm").submit(contact_form);
    function contact_form() {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var phone = jQuery("#phoneNumber").val();
        var flag = true;
        var newContactForm = jQuery(this).serialize();
        jQuery('.require', '#contactForm').each(function () {
            var inputVal = jQuery(this).val();
            (jQuery.trim(inputVal) === "" || inputVal === jQuery(this).attr('placeholder')) ? flag = addErrorMessage(jQuery(this), "Can't be blank") : removeErrorMessage(jQuery(this));
            if (jQuery(this).hasClass('email') == true && jQuery.trim(inputVal) != "" && inputVal != jQuery(this).attr('placeholder')) {
                !emailReg.test(inputVal) ? flag = addErrorMessage(jQuery(this), "Please enter valid email") : removeErrorMessage(jQuery(this));
            }
            if (jQuery(this).hasClass('inputName') == true && jQuery.trim(inputVal) != "" && inputVal != jQuery(this).attr('placeholder')) {
                /^[a-zA-Z '.]*$/.test(inputVal) ? removeErrorMessage(jQuery(this)) : flag = addErrorMessage(jQuery(this), "Please enter valid name");
            }

        });
        if (jQuery.trim(phone) != "") {
            phone.length != 14 ? flag = addErrorMessage(jQuery("#phoneNumber"), "Please enter valid phone number") : removeErrorMessage(jQuery("#phoneNumber"));
        }
        if (flag) {
            jQuery("#submitContactForm").attr("disabled", "disabled");
            jQuery(".loadingImage").show();
            jQuery.ajax({
                type:"POST",
                url:"/wp-admin/admin-ajax.php?action=addContact",
                data:newContactForm,
                success:function (data) {
                    jQuery(".loadingImage").hide();
                    jQuery(':input', '#contactForm')
                        .not(':button, :submit, :reset, :hidden')
                        .val('');
                    jQuery("#feedback").html(data);
                    jQuery("#feedback").fadeIn(100);
                    jQuery("#feedback").fadeOut(10000);
                    jQuery("#submitContactForm").removeAttr("disabled", "disabled");
                },
                error:function (errorThrown) {
                    alert(errorThrown);
                }
            });
        }
        return false;
    }

    function addErrorMessage(obj, msg) {
        obj.addClass("invalid");
        obj.next().text(msg);
        obj.next().show()
        return false;
    }

    function removeErrorMessage(obj) {
        obj.removeClass("invalid");
        obj.next().hide();
    }

    jQuery(".fancybox").fancybox({
        openEffect:'fade',
        closeEffect:'fade',
        padding:0,
        margin:0,
        maxWidth:700,
        maxHeight:500
    });

    /* Face toggle */

    jQuery(".playerLeftSideImgActive").stop().animate({"opacity":"0"});
    jQuery("#playerLeftSideImgMap area").hover(function () {
        jQuery(".playerLeftSideImg").stop().animate({"opacity":"0"});
        jQuery(".playerLeftSideImgActive").stop().animate({"opacity":"1"});
    }, function () {
        jQuery(".playerLeftSideImg").stop().animate({"opacity":"1"});
        jQuery(".playerLeftSideImgActive").stop().animate({"opacity":"0"});
    });

    jQuery(".foundationRightSideImgActive").stop().animate({"opacity":"0"});
    jQuery("#foundationRightSideImgMap area").hover(function () {
        jQuery(".foundationRightSideImg").stop().animate({"opacity":"0"});
        jQuery(".foundationRightSideImgActive").stop().animate({"opacity":"1"});
    }, function () {
        jQuery(".foundationRightSideImg").stop().animate({"opacity":"1"});
        jQuery(".foundationRightSideImgActive").stop().animate({"opacity":"0"});
    });

    var wsize = jQuery(window).width();
    abc(wsize);

    jQuery(".ipadLeftVinny .vinnyOrgLinkToggle").click(function(e){
        e.stopPropagation();
        if(jQuery(".vinnyOrgLinkToggle").hasClass("active")){
            jQuery(this).removeClass("active");
            if(jQuery(window).width()<480){
                jQuery('.ipadLeftVinny').stop().animate({'left':'-280px'},500);
            }else{
                jQuery('.ipadLeftVinny').stop().animate({'left':'-383px'},500);
            }
        }
        else{
            jQuery(this).removeClass("active");
            jQuery(this).addClass("active");
            jQuery('.ipadLeftVinny').stop().animate({'left':'0px'},500);
        }
    });

    jQuery(".ipadRightVinny .vinnyOrgLinkToggle").click(function(e){
        e.stopPropagation();
        if(jQuery(".vinnyOrgLinkToggle").hasClass("active")){
            jQuery(this).removeClass("active");
            if(jQuery(window).width()<480){
                jQuery('.ipadRightVinny').stop().animate({'right':'-280px'},500);
            }else{
                jQuery('.ipadRightVinny').stop().animate({'right':'-383px'},500);
            }
        }
        else{
            jQuery(this).removeClass("active");
            jQuery(this).addClass("active");
            jQuery('.ipadRightVinny').stop().animate({'right':'0px'},500);
        }
    });


    var touchBtn = jQuery(".responsiveButton");

    touchBtn.click(function (e) {
        e.stopPropagation();
        e.preventDefault();
//        alert("hi");

        var body = jQuery('body'),
            vsMenu = jQuery('.vsMenu'),
            vsMenuPosition = parseInt(vsMenu.css('right')),
            vsMenuWidth = vsMenu.width(),
            windowWidth = jQuery(window).width();

        if (vsMenuPosition == 0) {
            jQuery("header").removeClass("relativeHeader");
            jQuery(".sliderOuter").removeClass("marginTop");
            touchBtn.removeClass("vsMenuOpen");
            vsMenu.animate({
                right: '-' + vsMenuWidth + 'px'
            }, function () {
                vsMenu.removeAttr('style');
            });
            jQuery('body').removeAttr('style');
            jQuery('body').stop().animate({
                right: '0px'
            }, function () {
                jQuery('body').removeAttr('style');
            });
        } else {
            jQuery("header").addClass("relativeHeader");
            jQuery(".sliderOuter").addClass("marginTop");
            jQuery(this).addClass("vsMenuOpen");
            vsMenu.animate({
                right: '0px'
            });
            body.animate({
                right: vsMenuWidth + 'px'
            });
            body.css({
                position: "absolute",
                overflow: "hidden",
                width: windowWidth + 'px'
            });
        }
    });

    jQuery(".innerMenuWrapper ul a").click(function(){
        jQuery("header").removeClass("relativeHeader");
        jQuery(".sliderOuter").removeClass("marginTop");
        jQuery(".responsiveButton").removeClass("vsMenuOpen");
        jQuery('.vsMenu').animate({
            right: '-' + jQuery('.vsMenu').width() + 'px'
        }, function () {
            jQuery('.vsMenu').removeAttr('style');
        });
        jQuery('body').removeAttr('style');
    });

});

jQuery(window).resize(function() {
    var windowWidth = jQuery(window).width();
    var touchBtn = jQuery(".responsiveButton");
    if(windowWidth >767){
        if(touchBtn.hasClass('vsMenuOpen')) {
            touchBtn.trigger('click');
        }
//        jQuery(".aboutVinnyContent img").parents("p").css("margin","0");
    }
});


jQuery(window).resize(function () {
    imgHeightWidth();
    jQuery(".innerMenuInner").height(jQuery(window).height());
});

jQuery(window).load(function () {
    imgHeightWidth();
});

////ajax call for split page
function split_form(field) {
    var form = field.form;
    var newSplitForm = jQuery(form).serialize();
    var season = jQuery("#splitYear option:selected").text() + " SEASON STATISTICS";
    jQuery(".loadingImage").show();
    jQuery.ajax({
        type:"POST",
        url:"/wp-admin/admin-ajax.php?action=getSplit",
        data:newSplitForm,
        success:function (data) {
            jQuery("#splitSeason").html(season);
            jQuery("#splitTable").html(data);
            jQuery(".loadingImage").hide();
        },
        error:function (errorThrown) {
            alert(errorThrown);
        }
    });
    return false;
}

////ajax call for game log page
function game_log_form(field) {
    var form = field.form;
    var newGameLogForm = jQuery(form).serialize();
    jQuery(".loadingImage").show();
    jQuery.ajax({
        type:"POST",
        url:"/wp-admin/admin-ajax.php?action=getGameLog",
        data:newGameLogForm,
        success:function (data) {
            jQuery("#gameLogTableBody").html(data);
            jQuery(".loadingImage").hide();
        },
        error:function (errorThrown) {
            alert(errorThrown);
        }
    });
    return false;
}

jQuery(window).resize(function(){
    var wsize = jQuery(window).outerWidth(true);
});
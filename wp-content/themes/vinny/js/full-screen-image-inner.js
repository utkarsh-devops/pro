/*
 *  full Screen Image 1.1 - jQuery plugin
 *	written by Weboniselab
 *	http://www.webonise.com
 *
 *	Copyright (c) 2013 Weboniselab (http://www.webonise.com)
 *
 *	Built for jQuery library
 *	http://jquery.com
 *
 */
(function($) {
    "use strict";
    var obj = $([]);
    var tempOptions;
    $(window).bind('resize.fullScreenImageInner', function(){
        if (obj.length){
            obj.fullScreenImageInner();
        }
    });
    $('img.fsi').load(function(){
        if (obj.length){
            obj.fullScreenImageInner();
        }
    });
    $.fn.fullScreenImageInner = function(options){
        if(typeof options === 'undefined'){
            options = tempOptions;
        }
        else {
            tempOptions = options;
        }

        var defaults = {
            imageHeight:        1000,
            imageWidth:         1600,
            verticalSpace:      0,
            horizontalSpace:    0,
            windowHeight: $(window).height(),
            verticalPosition:   'center',
            horizontalPosition:   'center'
        };
        options = $.extend(defaults,options);
        this.each(function(){
            obj = $(this);
            var fullScreenImageInner = obj.find('img');
            /*var options.windowHeight = $(window).height();
             var options.windowHeight = 516;*/
            var windowWidth = $(window).width();
            var objHeight = options.windowHeight - options.horizontalSpace;
            var objWidth = windowWidth - options.verticalSpace;
            var heightDifference;
            var widthDifference;
            var imageNewWidth;
            var imageNewHeight;
            var imageTopMinusMargin;
            var imageLeftMinusMargin;
            obj.css({
                height:objHeight,
                width:objWidth,
                position: 'relative',
                overflow: 'hidden'
            });
            fullScreenImageInner.css({
                position: 'absolute',
                maxWidth: 'none',
                maxHeight:'none'
            });
            if(options.imageHeight <= options.windowHeight){
                heightDifference = options.windowHeight - options.imageHeight;
            }else{
                heightDifference = options.imageHeight - options.windowHeight;
            }
            if(options.imageWidth <= windowWidth){
                widthDifference = windowWidth - options.imageWidth;
            }else{
                widthDifference = options.imageWidth - windowWidth;
            }
            if(widthDifference <= heightDifference){
                imageNewWidth = (options.windowHeight / options.imageHeight)*options.imageWidth;
                if(imageNewWidth < windowWidth){
                    imageNewHeight = (windowWidth / options.imageWidth)*options.imageHeight;
                    imageTopMinusMargin = -((imageNewHeight - options.windowHeight)/2);

                    fullScreenImageInner.css({
                        height:imageNewHeight,
                        width:windowWidth,
                        top:imageTopMinusMargin,
                        left:0
                    });
                    if(!(options.verticalPosition == 'center')){

                        if(options.verticalPosition == 'top'){
                            fullScreenImageInner.css({
                                top:0
                            });
                        }else if(options.verticalPosition == 'bottom'){
                            fullScreenImageInner.css({
                                top: 'auto',
                                bottom:0
                            });
                        }
                    }

                }else{
                    imageLeftMinusMargin = -((imageNewWidth - windowWidth)/2);
                    fullScreenImageInner.css({
                        height:options.windowHeight,
                        width:imageNewWidth,
                        left:imageLeftMinusMargin,
                        top:0
                    });

                    if(!(options.horizontalPosition == 'center')){

                        if(options.horizontalPosition == 'left'){
                            fullScreenImageInner.css({
                                left:0
                            });
                        }else if(options.horizontalPosition == 'right'){
                            fullScreenImageInner.css({
                                left: 'auto',
                                right:0
                            });
                        }
                    }
                }
            }else{
                imageNewHeight = (windowWidth / options.imageWidth)*options.imageHeight;
                if(imageNewHeight < options.windowHeight){
                    imageNewWidth = (options.windowHeight / options.imageHeight)*options.imageWidth;
                    imageLeftMinusMargin = -((imageNewWidth - windowWidth)/2);
                    fullScreenImageInner.css({
                        height:options.windowHeight,
                        width:imageNewWidth,
                        left:imageLeftMinusMargin,
                        top:0
                    });

                    if(!(options.horizontalPosition == 'center')){

                        if(options.horizontalPosition == 'left'){
                            fullScreenImageInner.css({
                                left:0
                            });
                        }else if(options.horizontalPosition == 'right'){
                            fullScreenImageInner.css({
                                left: 'auto',
                                right:0
                            });
                        }
                    }

                }else{
                    imageTopMinusMargin = -((imageNewHeight - options.windowHeight)/2);
                    fullScreenImageInner.css({
                        height:imageNewHeight,
                        width:windowWidth,
                        top:imageTopMinusMargin,
                        left:0
                    });
                    if(!(options.verticalPosition == 'center')){

                        if(options.verticalPosition == 'top'){
                            fullScreenImageInner.css({
                                top:0
                            });
                        }else if(options.verticalPosition == 'bottom'){
                            fullScreenImageInner.css({
                                top: 'auto',
                                bottom:0
                            });
                        }
                    }
                }
            }
            return obj;
        });

    };
})(jQuery);
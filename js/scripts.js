(function ($) {
    $(document).ready(function () {
        
        if ($('ul#gallery-size-options').length) {
            
            var galleryOptionBar = $('#gallery-option-bar');
            var gallerySizeOption = $('ul#gallery-size-options li');
            var galleryGrid = $('.gallery-content-grid');
            
            galleryOptionBar.css('display', 'block');

            gallerySizeOption.on('click', function () {
                
                //Get the size option
                var sizeOption = $(this).attr('sizeoption');
                //Set size option to local storage
                localStorage.setItem('sizeoption', sizeOption);
                //Set the local storage size option as the item attribute size
                galleryGrid.attr('sizeoption', localStorage.getItem('sizeoption'));

                //Add and r4move active item classes
                gallerySizeOption.removeClass('active');
                $(this).addClass('active');
                
            });
            
            //Check if there is local storage set, if not click the first item to set small
            if (localStorage.getItem('sizeoption') != '') {
                galleryGrid.attr('sizeoption', localStorage.getItem('sizeoption'));
                
                gallerySizeOption.each( function () {
                    
                    //Check which li attr "sizeoption" matches the local storage value
                    if ($(this).attr('sizeoption') == localStorage.getItem('sizeoption')) {
                        $(this).addClass('active');
                    }
                    
                });
                
            } else {
                gallerySizeOption.first().click();
            }
            
        }
                             
    });
})(jQuery);
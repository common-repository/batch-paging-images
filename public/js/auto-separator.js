jQuery(function($) {

    $ = jQuery;
    $(document).ready(function(){
        const button = $('#insert-auto-paging-separator');
        if (button) {
            button.click(insertPagingSeparator);
        }
    });


    function getTinyMce() {
        const tinyMce = window.tinyMCE || null;
        return tinyMce;
    }

    //  <img > <!--nextpage-->
    function insertPagingSeparator() {

        const tinyMce = getTinyMce();
        if (!tinyMce) {
            return false;
        }

        const editor =  tinyMce.get('content');
        if (! editor) {
            return false;
        }

        // let content = editor.getContent();
        let content = editor.getContent({format: 'raw'});
        if (!content) {
            return false;
        }

        const separatorService = imageSeparatorService(content);
        const newContent = separatorService.imageAutoSeparator();
        editor.setContent(newContent);

        // console.log(newContent);

        return true;
    }




    function imageSeparatorService (htmlContent) {
        htmlContent = htmlContent || '';
        const service = {
            imageAutoSeparator: imageAutoSeparator
        };

        const imagesWithSeparatorAppended = {};

        let allImages = [];

        function imageAutoSeparator() {

            const wrapper = parseHtmlContent();

            if (allImages.length > 0) {

                $.each(allImages, function (index, imageNode) {
                    addImageSeparator(imageNode, index);
                });
            }

            return wrapper.html();
        }



        // find out which image is already appended with the separator
        // return wrapper
        function parseHtmlContent() {


            const wrapper = $('<div />');
            wrapper.html(htmlContent);

            // total images
            allImages = wrapper.find('img');

            const reg = new RegExp('(<img .*?>\s*<\!--nextpage-->)','g');
            const rs = htmlContent.match(reg);
            if (rs && rs.length) {
                rs.map(function (matchedItem) {
                    if (matchedItem) {
                        const src = $(matchedItem).find('img').attr('src');
                        if (src) {
                            imagesWithSeparatorAppended[src] = true;
                        }
                    }

                });

            }

            return wrapper;

        }

        function addImageSeparator(imageNode, index) {
            if (!imageNode) {
                return false;
            }
            imageNode = $(imageNode);

            const imgSrc = imageNode.attr('src');

            if (imgSrc
                && !imagesWithSeparatorAppended[imgSrc]
                && index !== allImages.length - 1
            ) {
                $(' <!--nextpage-->').insertAfter(imageNode);
            }


        }




        return service;

    }





});
/*!
 * NEO Bootstrap Carousl Admin UI Kit v1.0.0
 *
 * Description: NEO Bootstrap Carousl Admin Dashboard UI Functions
 * Version: 1.0.0
 * Author: PixelsPress <support@pixelspress.com>
 *
 * Requires: jQuery
 */

(function ($) {
    'use strict';

    /**
     * Simple notifications
     * var notice = new NBC_Notification("Slide Deleted", "click to undo", 'img.jpg', 'success');
     * Can use a custom function for the callback as well
     * requires jQuery
     */
    var NBC_Notification = function (message, submessage, image, _classname) {
        this.panel = document.getElementById('nbc-notifications');
        if (!this.panel) {
            this.panel = document.createElement('div');
            this.panel.id = 'nbc-notifications';
        }

        this.notice = jQuery(
            '<div class="nbc-notification"><div class="nbc-notification-content"><h3></h3><p></p></div><div class="img"></div></div>'
        );
        this.notice.find('h3').text(message);
        this.notice.find('p').text(submessage);

        // If there is an image, let's add it.
        if ('undefined' !== typeof image && image.length) {
            this.notice
                .addClass('has-image')
                .find('.img')
                .append('<img width=50 height=50 src="' + image + '">');
        }

        // TODO add an option for svg
        // If an extra class is set, set it
        'undefined' !== typeof _classname && this.notice.addClass(_classname);

        // Append the panel to the body and
        jQuery(this.panel).appendTo(jQuery('body'));
    };

    /**
     * Hide a notification
     */
    NBC_Notification.prototype.hide = function () {
        var _this = this;
        _this.notice.addClass('finished');
        this.notice.fadeOut(500, function () {
            _this.notice.remove();
        });
    };

    /**
     * Launch a notification and add a click event
     *
     * @param int      delay    the time in milliseconds
     * @param Function callback a method on the object or anon function
     */
    NBC_Notification.prototype.fire = function (delay, callback) {
        var _this = this;
        var _callback = 'undefined' !== typeof callback ? callback : 'hide';

        // Prepend this to the notification stack
        this.notice.prependTo(this.panel);

        // Automatically hide after the delay
        this.timeout = setTimeout(function () {
            _this.hide();
        }, delay);

        // Clear this timeout on click
        this.notice.on('click', function () {
            clearTimeout(_this.timeout);
        });

        // Pause the timeout on hover
        this.notice.on('mouseenter', function () {
            clearTimeout(_this.timeout);
        });

        // Restart the timeout after leaving
        this.notice.on('mouseleave', function () {
            _this.timeout = setTimeout(function () {
                _this.hide();
            }, delay);
        });

        // If callback is a method
        if (NBC_Notification.prototype.hasOwnProperty(_callback)) {
            this.notice.on('click', function () {
                if ('hide' !== _callback) {
                    _this.hide();
                }
                NBC_Notification.call(_this[_callback]());
            });
        } else {
            // If the callback is a custom function
            this.notice.on('click', function () {
                _this.hide();
                _callback();
            });
        }
    };

    var NBCAdminUIKit = {
        vTabs: function () {
            if ($('.neo-bootstrap-carousel-vtabs').length) {
                var vTabsMenuEl = $('.neo-bootstrap-carousel-vtabs-menu'),
                    vTabsLinksEl = vTabsMenuEl.find('a'),
                    vTabsContentEl = $('.neo-bootstrap-carousel-vtabs-content'),
                    vTabsURLEl = window.location.hash;

                vTabsContentEl.hide();

                vTabsLinksEl.on('click', function (e) {
                    e.preventDefault();

                    var targetEl = $($(this).attr('href')),
                        hashId = $(this)[0].hash;

                    // Set Hash Id
                    window.location.hash = hashId;

                    vTabsLinksEl.removeClass('active');
                    $(this).addClass('active');
                    vTabsContentEl.hide();
                    targetEl.show();
                });

                if (window.location.hash.length > 0) {
                    vTabsLinksEl.removeClass('active');
                    $('a[href="' + vTabsURLEl + '"]').addClass('active');
                    $(vTabsURLEl).show();
                } else {
                    if ($(vTabsLinksEl).hasClass('active')) {
                        $($(vTabsLinksEl).attr('href')).show();
                    }
                }
            }
        },

        select2: function () {
            if ($('.neo-bootstrap-carousel-select')) {
                $('.neo-bootstrap-carousel-select').select2({
                    width: '100%',
                    containerCssClass: 'neo-bootstrap-carousel-select-container',
                    dropdownCssClass: 'neo-bootstrap-carousel-select-dropdown',
                });
            }
        },

        // Toggles Children fields on Parents Checkbox state
        toggleParentChild: function () {
            if ($('.neo-bootstrap-carousel-parent-child-field')) {
                var parentChildEl = $('.neo-bootstrap-carousel-parent-child-field');

                parentChildEl.each(function () {
                    var el = $(this),
                        checkboxEl = el.find('> .switch input');

                    checkboxEl.on('change', function () {
                        if ($(this).prop('checked')) {
                            el.addClass('active');
                        } else {
                            el.removeClass('active');
                        }
                    });
                });
            }
        },

        accordion: function () {
            var acc = document.getElementsByClassName('nbc-accordion');
            var i;

            for (i = 0; i < acc.length; i++) {
                acc[i].addEventListener('click', function () {
                    this.classList.toggle('active');
                    var panel = this.nextElementSibling;
                    if (panel.style.maxHeight) {
                        panel.style.maxHeight = null;
                    } else {
                        panel.style.maxHeight = panel.scrollHeight + 'px';
                    }
                });
            }
        },

        /**
         * Allow the user to click on the element to select it.
         *
         * @param string elm Element The html element to be selected
         */
        nbc_select_text: function (elm) {
            var range;
            var selection;

            // Most browsers will be able to select the text
            if (window.getSelection) {
                selection = window.getSelection();
                range = document.createRange();
                range.selectNodeContents(elm);
                selection.removeAllRanges();
                selection.addRange(range);
            } else if (document.body.createTextRange) {
                range = document.body.createTextRange();
                range.moveToElementText(elm);
                range.select();
            }

            // Some browsers will be able to copy the text too!
            try {
                if (document.execCommand('copy')) {
                    var notice = new NBC_Notification(
                        nbc.success_language,
                        nbc.copied_language,
                        undefined,
                        'is-success'
                    );
                    notice.fire(2000);
                }
            } catch (err) {
                console.warn("NEO Bootstrap Carousel: Couldn't copy the text");
            }
        },

        init: function () {
            this.vTabs();
            this.select2();
            this.toggleParentChild();
            this.accordion();
        },
    };

    $(document).ready(function () {
        NBCAdminUIKit.init();

        // Select the shortcode on click
        $('.nbc-shortcode').on('click', function () {
            NBCAdminUIKit.nbc_select_text(this);
        });

        // Slider's Slides Uploading Via Media Frame
        //
        // Parameters
        var $slide_source = $('input[name="slide_source"]'),
            $slide_source_media = $('#media-source'),
            $slide_source_post = $('#post-source'),
            $slide_event = $('.add-slide'),
            neo_carousel_frame,
            $nbc_slider_container = $('#nbc-slider-container'),
            $slides_id = $('#nbc_slides'),
            $nbc_slides = $nbc_slider_container.find('ul.nbc-slides');

        // Slide Source Selection
        $slide_source.on('click', function () {
            if ('media' == $(this).attr('value')) {
                $slide_source_media.show();
                $slide_source_post.hide();
            }
            if ('posts' == $(this).attr('value')) {
                $slide_source_media.hide();
                $slide_source_post.show();
            }
        });

        // NEO Bootstrap Carousel
        $slide_event.on('click', 'a', function (event) {
            var $el = $(this);

            event.preventDefault();

            // If the media frame already exists, reopen it.
            if (neo_carousel_frame) {
                neo_carousel_frame.open();
                return;
            }

            // Create Media Frames
            neo_carousel_frame = wp.media.frames.neo_carousel_frame = wp.media({
                // Set the title of the modal.
                title: $el.data('choose'),
                button: {
                    text: $el.data('update'),
                },
                states: [
                    new wp.media.controller.Library({
                        title: $el.data('choose'),
                        filterable: 'all',
                        multiple: true,
                    }),
                ],
            });

            // When a slide is selected, run a callback.
            neo_carousel_frame.on('select', function () {
                var selection = neo_carousel_frame.state().get('selection'),
                    attachment_ids = $slides_id.val();

                selection.map(function (attachment) {
                    attachment = attachment.toJSON();
                    if (attachment.id) {
                        attachment_ids = attachment_ids ? attachment_ids + ',' + attachment.id : attachment.id;
                        var attachment_slide =
                            attachment.sizes && attachment.sizes.thumbnail
                                ? attachment.sizes.thumbnail.url
                                : attachment.url;
                        var $html_content;
                        $html_content = '<li class="slide" data-attachment_id="' + attachment.id + '">';
                        $html_content += '<table>';
                        $html_content += '<tbody>';
                        $html_content += '<tr>';
                        $html_content += '<td class="slide-thumbnail"><img src="' + attachment_slide + '" /></td>';
                        $html_content += '<td>';
                        $html_content += '<table>';
                        $html_content += '<tr>';
                        $html_content += '<td><label for="slide_title_' + attachment.id + '">Title</label></td>';
                        $html_content +=
                            '<td><input type="text" name="slide_title_' +
                            attachment.id +
                            '" id="slide_title_' +
                            attachment.id +
                            '" value="' +
                            attachment.title +
                            '" class="regular-text"></td>';
                        $html_content += '</tr>';
                        $html_content += '<tr>';
                        $html_content +=
                            '<td style="vertical-align: top;"><label for="slide_description_' +
                            attachment.id +
                            '">Description</label></td>';
                        $html_content +=
                            '<td><textarea name="slide_description_' +
                            attachment.id +
                            '" id="slide_description_' +
                            attachment.id +
                            '" class="large-text" rows="3">' +
                            attachment.caption +
                            '</textarea></td>';
                        $html_content += '</tr>';
                        $html_content += '<tr>';
                        $html_content += '<td><label for="slide_url_' + attachment.id + '">URL</label></td>';
                        $html_content +=
                            '<td><input type="text" name="slide_url_' +
                            attachment.id +
                            '" id="slide_url_' +
                            attachment.id +
                            '" value="" class="regular-text code"></td>';
                        $html_content += '</tr>';
                        $html_content += '<tr>';
                        $html_content +=
                            '<td style="vertical-align: top;"><label for="overlay_' +
                            attachment.id +
                            '">Overlay</label></td>';
                        $html_content += '<td>';
                        $html_content +=
                            '<select name="overlay_' + attachment.id + '" id="overlay_' + attachment.id + '">';
                        $html_content += '<option value="">None</option>';
                        $html_content += '<option value="dark">Dark</option>';
                        $html_content += '<option value="light">Light</option>';
                        $html_content += '</select>';
                        $html_content += '</td>';
                        $html_content += '</tr>';
                        $html_content += '<tr>';
                        $html_content +=
                            '<td style="vertical-align: top;"><label for="overlay_opacity_' +
                            attachment.id +
                            '">Overlay Opacity</label></td>';
                        $html_content += '<td>';
                        $html_content +=
                            '<select name="overlay_opacity_' +
                            attachment.id +
                            '" id="overlay_opacity_' +
                            attachment.id +
                            '">';
                        $html_content += '<option value="0.05">5%</option>';
                        $html_content += '<option value="0.10">10%</option>';
                        $html_content += '<option value="0.15">15%</option>';
                        $html_content += '<option value="0.20">20%</option>';
                        $html_content += '<option value="0.25">25%</option>';
                        $html_content += '<option value="0.30">30%</option>';
                        $html_content += '<option value="0.35">35%</option>';
                        $html_content += '<option value="0.40">40%</option>';
                        $html_content += '<option value="0.45">45%</option>';
                        $html_content += '<option value="0.50">50%</option>';
                        $html_content += '<option value="0.55">55%</option>';
                        $html_content += '<option value="0.60">60%</option>';
                        $html_content += '<option value="0.65">65%</option>';
                        $html_content += '<option value="0.70">70%</option>';
                        $html_content += '<option value="0.75">75%</option>';
                        $html_content += '<option value="0.80">80%</option>';
                        $html_content += '<option value="0.85">85%</option>';
                        $html_content += '<option value="0.90">90%</option>';
                        $html_content += '<option value="0.95">95%</option>';
                        $html_content += '<option value="1">100%</option>';
                        $html_content += '</select>';
                        $html_content += '</td>';
                        $html_content += '</tr>';
                        $html_content += '</table>';
                        $html_content += '</td>';
                        $html_content += '</tr>';
                        $html_content += '</tbody>';
                        $html_content += '</table>';
                        $html_content +=
                            '<a href="#" class="delete" title="' +
                            $el.data('delete') +
                            '"><i class="fa fa-times" aria-hidden="true"></i></a></li>';
                        $html_content += '</li>';
                        $nbc_slides.append($html_content);
                    }
                });
                $slides_id.val(attachment_ids);
            });

            // Finally, open the modal.
            neo_carousel_frame.open();
        });

        // Image Ordering
        $nbc_slides.sortable({
            items: 'li.slide',
            cursor: 'move',
            scrollSensitivity: 40,
            forcePlaceholderSize: true,
            forceHelperSize: false,
            helper: 'clone',
            opacity: 0.65,
            placeholder: 'soc-metabox-sortable-placeholder',
            start: function (event, ui) {
                ui.item.css('background-color', '#f6f6f6');
            },
            stop: function (event, ui) {
                ui.item.removeAttr('style');
            },
            update: function () {
                var attachment_ids = '';

                $nbc_slider_container
                    .find('li.slide')
                    .css('cursor', 'default')
                    .each(function () {
                        var attachment_id = $(this).attr('data-attachment_id');
                        attachment_ids = attachment_ids + attachment_id + ',';
                    });

                $slides_id.val(attachment_ids);
            },
        });

        // Remove Slides
        $nbc_slider_container.on('click', 'a.delete', function () {
            $(this).closest('li.slide').remove();

            var attachment_ids = '';

            $nbc_slider_container
                .find('li.slide')
                .css('cursor', 'default')
                .each(function () {
                    var attachment_id = $(this).attr('data-attachment_id');
                    attachment_ids = attachment_ids + attachment_id + ',';
                });

            $slides_id.val(attachment_ids);

            return false;
        });
    });
})(jQuery);

/*
 * SimplePlayer - A jQuery Plugin
 * @requires jQuery v1.4.2 or later
 *
 * SimplePlayer is a html5 audio player
 *
 * Licensed under the MIT:
 * http://www.opensource.org/licenses/mit-license.php
 *
 * Copyright (c) 2010-, Yuanhao Li (jay_21cn -[at]- hotmail [*dot*] com)
 */
(function($) {
    $.fn.player = function(settings) {
        var config = {
            progressbarWidth: '',
            progressbarHeight: '',
            progressbarColor: '',
            progressbarBGColor: '',
            defaultVolume: 1
        };

        if (settings) {
            $.extend(config, settings);
        }

        var playControl = '<span class="play-control"></span>';
        var stopControl = '<span class="stop-control"></span>';

        this.each(function() {
            $(this).before('<div class="player-container">');
            $(this).after('</div>');
            $(this).parent().find('.player-container').prepend(
                '<a' +
                ' class="start-button" href="javascript:void(0)">' + playControl + '</a>'
            );

            var simplePlayer = $(this).get(0);
            var button = $(this).parent().find('.start-button');
            var progressbarWrapper = $(this).parent().find('.progressbar-wrapper');
            var progressbar = $(this).parent().find('.progressbar');

            simplePlayer.volume = config.defaultVolume;

            button.click(function() {
                if (simplePlayer.paused) {
                    /*stop all playing songs*/
                    $.each($('audio'), function () {
    					this.pause();
						$(this).parent().find('.stop-control').addClass('play-control').removeClass('stop-control');
					});
                    simplePlayer.play();
                    $(this).find('.play-control').addClass('stop-control').removeClass('play-control');
                } else {
                    simplePlayer.pause();
                    $(this).find('.stop-control').addClass('play-control').removeClass('stop-control');
                }
            });

            progressbarWrapper.click(function(e) {
                if (simplePlayer.duration != 0) {
                    left = $(this).offset().left;
                    offset = e.pageX - left;
                    percent = offset / progressbarWrapper.width();
                    duration_seek = percent * simplePlayer.duration;
                    simplePlayer.currentTime = duration_seek;
                }
            });


            $(simplePlayer).bind('ended', function(evt) {
                simplePlayer.pause();
                button.find('.stop-control').addClass('play-control').removeClass('stop-control');
            });

            $(simplePlayer).bind('timeupdate', function(e) {
                duration = this.duration;
                time = this.currentTime;
                fraction = time / duration;
                percent = fraction * 100;
                if (percent) progressbar.css('width', percent + '%');
            });

            if (simplePlayer.duration > 0) {
                $(this).parent().css('display', 'inline-block');
            }

            if ($(this).attr('autoplay') == 'autoplay') {
                button.click();
            }
        });

        return this;
    };
})(jQuery);

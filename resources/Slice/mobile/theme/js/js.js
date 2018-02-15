(function ($) {

    if (typeof Drupal != 'undefined') {
        Drupal.behaviors.parentProMobileTheme = {
            attach: function (context, settings) {
                init();
            },

            completedCallback: function () {
                // Do nothing. But it's here in case other modules/themes want to override it.
            }
        }
    }

    $(function () {
        if (typeof Drupal == 'undefined') {
            init();
        }

        $(window).load(function () {
            initFlexslider();
            initBackToTop();
            initNav();
        });
    });

    function init() {
        initAccordion();
        initMapHilight();
        initTabs();
        initMonth();
        initColumDivision();
    }

    function initTabs() {
        var $wrapper = $('.tabs-wrapper'),
            $nav = $wrapper.find('.tab-nav h3, .tab-nav .icons-link'),
            $tabsContent = $wrapper.find('.tab-content .tab-item'),
            firstActiveItem = 0;

        $nav.eq(firstActiveItem).addClass('active');
        $tabsContent.eq(firstActiveItem).addClass('active');

        $nav.on('click touch', function () {
            var $this = $(this),
                index = $this.index();

            $tabsContent.hide();

            if ($this.hasClass('active')) {
                $this.addClass('active');
                $tabsContent.eq(index).show();
            } else {
                $nav.removeClass('active');
                $this.addClass('active');
                $tabsContent.eq(index).show();
            }
        });
    }


    function initBackToTop() {
        var $btn = $('#back-to-top'),
            timerId;

        check();

        $(window).on('scroll', function () {
            clearTimeout(timerId);
            timerId = setTimeout(function () {
                check();
            }, 100);
        });

        $btn.on('click', function () {
            $("body, html").animate({
                scrollTop: 0
            }, 500);

            return false;
        });

        function check() {
            if ($(window).scrollTop() > 200) {
                $btn.addClass('btn-processed').fadeIn(400);
            } else if ($(window).scrollTop() < 200) {

                $btn.removeClass('btn-processed').fadeOut(400);
            }
        }
    }

    function initColumDivision() {
        var $menu = $('.content-wrapper').find('.month-list');

        $menu.each(function () {
            var $this = $(this),
                $ul = $this.find('ul.col-list'),
                $items = $ul.children(),
                $index = Math.round($items.length / 2);

            $this.append('<div class="clearfix">' +
                '<div class="first-col"><ul></ul></div>' +
                '<div class="last-col"><ul></ul></div>' +
                '</div>');

            var $firstCol = $this.find('.first-col ul'),
                $lastCol = $this.find('.last-col ul');

            for (var i = 0; i < $items.length; i++) {
                if (i < $index) {
                    $firstCol.append('<li class="dontsplit">' + $items.eq(i).html() + '</li>');
                } else {
                    $lastCol.append('<li class="dontsplit">' + $items.eq(i).html() + '</li>');
                }
            }

            $ul.hide();
        })

    }

    function initFlexslider() {
        $('.slider').flexslider({
            controlNav: false,
            directionNav: false,
            slideshowSpeed: 11000
        });
    }

    function initNav() {
        var $header = $('.header'),
            $btn = $header.find('.nav-btn'),
            $nav = $header.find('.nav'),
            animationSpeed = 200;

        $btn.on('click touch', function (e) {
            e.preventDefault();

            if ($btn.hasClass('active')) {
                $btn.removeClass('active');
                $nav.hide();
            } else {
                $btn.addClass('active');
                $nav.show();
            }
        });
    }

    function initMonth() {
        var $content = $('.content-wrapper'),
            $btn = $content.find('.link-calendar'),
            $nav = $content.find('.month-list'),
            animationSpeed = 200;

        $btn.on('click touch', function (e) {
            e.preventDefault();

            if ($btn.hasClass('active')) {
                $btn.removeClass('active');
                $nav.fadeOut(animationSpeed);
            } else {
                $btn.addClass('active');
                $nav.fadeIn(animationSpeed);
            }
        });
    }


    function initAccordion() {
        var $wrapper = $('.accordion-wrapper'),
            $btn = $wrapper.find('h2, .item-title'),
            $content = $wrapper.find('.accordion-content'),
            speed = 300,
            closeAllContent = true;

        $btn.on('click touch', function () {

            var $this = $(this),
                $thisWrapper = $this.parents('.accordion-item'),
                $thisContent = $thisWrapper.find('.accordion-content');

            if (closeAllContent) {
                $wrapper.not($thisWrapper).removeClass('accordion-processed');
                $btn.not($this).removeClass('accordion-processed');
                $content.not($thisContent).slideUp(speed);
            }

            if (!$this.hasClass('accordion-processed')) {
                $thisWrapper.addClass('accordion-processed');
                $thisContent.slideDown(speed);
                $this.addClass('accordion-processed');
            } else {
                $thisWrapper.removeClass('accordion-processed');
                $thisContent.slideUp(speed);
                $this.removeClass('accordion-processed');
            }
        });
    }

    function initMapHilight() {
        var $mapWrapper = $('.map-wrapper'),
            $areas = $mapWrapper.find('area'),
            $descs = $mapWrapper.find('.desc-item');

        $mapWrapper.find('.map-img').maphilight({
            fillOpacity: 1,
            strokeColor: 'f2f2f2',
            strokeWidth: 3
        });

        var i, data, $area;
        for (i = 0; i < $areas.length; i++) {
            $area = $areas.eq(i);

            if ($area.hasClass('active')) {
                data = $area.data('maphilight') || {};

                data.alwaysOn = true;
                $area.data('maphilight', data).trigger('alwaysOn.maphilight');
                setActiveDesc($area);
            }
        }

        function setActiveDesc(el) {
            $descs.removeClass('active');
          $mapWrapper.find('.desc').css('background', '#' + el.data('maphilight').fillColor);
        }

        $areas.on('click touch', function (e) {

            var $activeArea = $(this);

            for (var i = 0; i < $areas.length; i++) {
                var $this = $areas.eq(i), data = $this.data('maphilight') || {};

                if ($activeArea.index() !== i) {
                    data.alwaysOn = false;
                    $this.data('maphilight', data).trigger('alwaysOn.maphilight');
                    $this.removeClass('active');
                } else {
                    data.alwaysOn = true;
                    $this.data('maphilight', data).trigger('alwaysOn.maphilight');
                    $this.addClass('active');
                    setActiveDesc($this);
                }
            }
            e.preventDefault();
        });
    }

})(jQuery);
(function ($) {

  if (typeof Drupal != 'undefined') {
    Drupal.behaviors.parentProTheme = {
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

    $(window).load(function() {
      initFlexslider();
      initMapHilight();
      initTooltip();
      initSelect();
      initDDlist();
      initBackToTop();
    });
  });

  function init() {
    init_columnize();
    initNavigationControl();
    initColumDivision();
      initColumDivisionDwonload();
  }

  function initFlexslider() {
    $('.slider').flexslider({
      controlNav: false,
      slideshowSpeed: 11000
    });
  }

  function initBackToTop() {
    var $btn = $('#back-to-top'),
      timerId;

    check();

    $(window).on('scroll', function() {
      clearTimeout(timerId);
      timerId = setTimeout(function() {
        check();
      }, 100);
    });

    $btn.on('click', function() {
      $("body, html").animate({
        scrollTop: 0
      }, 500);

      return false;
    });

    function check() {
      if($(window).scrollTop() > 300) {
        $btn.addClass('btn-processed').fadeIn(400);
      } else if($(window).scrollTop() < 300) {

        $btn.removeClass('btn-processed').fadeOut(400);
      }
    }
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
    for(i = 0; i < $areas.length; i++) {
      $area = $areas.eq(i);

//      $area.attr('href', $descs.eq(i).attr('data-term-link'));

      if($area.hasClass('active')) {
        data = $area.data('maphilight') || {};

        data.alwaysOn = true;
        $area.data('maphilight', data).trigger('alwaysOn.maphilight');
        setActiveDesc($area);
      }
    }

    function setActiveDesc(el) {
      $descs.removeClass('active');

      for(var i = 0; i < $descs.length; i++) {
        if($descs.eq(i).data('maphilight-desc') == el.data('for-desc')) {
          $descs.eq(i).addClass('active');
          if($mapWrapper.hasClass('map-wrapper-services')) {
            $mapWrapper.find('.desc').css('background', '#' + el.data('maphilight').fillColor);
          } else if($mapWrapper.hasClass('map-wrapper-state')) {
            $('.content-top').css('border-bottom', '6px solid #' + el.data('maphilight').fillColor)
          } else {
            $descs.eq(i).find('h4').css('color', '#' + el.data('maphilight').fillColor);
          }

          return false;
        }
      }
    }

    $areas.click(function(e) {

      var $activeArea = $(this);

      for(var i = 0; i < $areas.length; i++) {
        var $this = $areas.eq(i), data = $this.data('maphilight') || {};

        if($activeArea.index() !== i) {
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

    function initColumDivisionDwonload() {
        var $menu = $('.node-parenting').find('.info');

        $menu.each(function () {
            var $this = $(this),
                $ul = $this.find('ul'),
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

  function initColumDivision() {
    var $menu = $('.col-item').find('.item-bd');

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

  function init_columnize() {
    $('.columnizer-plugin:not(.columnizer-plugin-processed)')
      .columnize({
        columns: 3,
        buildOnce: true
      })
      .addClass('columnizer-plugin-processed');
  }

  function initTooltip() {
    var $btn = $('.page-calendar .views-field-title'),
      $wrappers = $btn.parent(),
      zIndex = 1;

    $btn.click(function(e) {
      e.preventDefault();
      var $this = $(this),
        $parent = $this.parent(),
        $tooltip = $parent.find('.tooltip-wrapper');

      if(!$parent.hasClass('tooltip-processed') && $tooltip.length) {
        $wrappers.removeClass('tooltip-processed');
        $parent.addClass('tooltip-processed');
      } else {
        $parent.removeClass('tooltip-processed');
      }
    });

    $('html').click(function(e) {
      if(!$(e.target).closest($wrappers).length && $wrappers.hasClass('tooltip-processed')) {
        $wrappers.removeClass('tooltip-processed');
        zIndex = 1;
      }
    });
  }

  function initSelect() {

    $('.field-select-month .form-select').combobox({
      hoverEnabled: true,
      listMaxHeight: 450,
      forceScroll: true,
      height: 30,
      btnWidth: 30,
      width: 200
    });

    $('.page-services .form-select').combobox({
      hoverEnabled: true,
      listMaxHeight: 450,
      forceScroll: true,
      height: 30,
      btnWidth: 30,
      width: 120
    });
  }

  function initNavigationControl() {
    var $wrapper = $('.navigation'),
      $btnMap = $wrapper.find('.btn-map'),
      $contentWrapper = $('.content-wrapper'),
      $contentTop= $('.content-top'),
      flag = true,
      currentDDBlock,
      currentDDBlockBtn,
      flagAnimation = true,
      transitionSupport = cssTransitionSupport();

    if($wrapper.find('.btn').siblings('ul').length > 0) {
      currentDDBlockBtn = $wrapper.find('.btn');
      currentDDBlock = currentDDBlockBtn.siblings('ul');

      init(animationDDListShow, animationDDListHide);
    } else if($wrapper.find('.col-hd').siblings('ul').length > 0) {
      currentDDBlockBtn = $wrapper.find('.col-hd');
      currentDDBlock = currentDDBlockBtn.siblings('ul');

      init(animationDDListShow, animationDDListHide);
    } else {
      currentDDBlockBtn = $wrapper.find('.btn');
      currentDDBlock = $wrapper.find('.map-wrapper');

      init(animationMapShow, animationMapHide);
    }

    function init(funcAnimationToShow, funcAnimationToHide) {
      $contentTop.on('mouseover', function(e) {
        e.preventDefault();

        if(!$wrapper.hasClass('navigation-processed') && flagAnimation) {
          funcAnimationToShow();

          if(flag) {
            setTimeout(function() {
              flag = false;
              setHeight();
            }, 500);
          }
        }
      });

      $('html').on('mouseover', function(e) {
        if(!$(e.target).closest($contentTop).length && $wrapper.hasClass('navigation-processed') && flagAnimation) {
          funcAnimationToHide();
        }
      });
    }

    function animationMapShow() {
      $wrapper.addClass('navigation-processed');
      flagAnimation = false;

      if(transitionSupport) {
        $btnMap.hide();
        setTimeout(function() {
          currentDDBlockBtn.css({
            position: 'absolute',
            opacity: 0
          });
          currentDDBlock.css({
            position: 'relative',
            opacity: 1,
            top: 0
          });
        }, 200);

        setTimeout(function() {
          flagAnimation = true;
        }, 400);
      } else {
        currentDDBlockBtn.css({
          position: 'absolute',
          opacity: 0
        });

        currentDDBlock.css({
          position: 'relative',
          opacity: 1,
          top: 0
        });

        flagAnimation = true;
      }
    }

    function animationMapHide() {
      flagAnimation = false;

      currentDDBlockBtn.css({
        position: 'relative',
        opacity: 1
      });
      currentDDBlock.css({
        position: 'absolute',
        opacity: 0,
        top: 24 + 'px'
      });

      if(transitionSupport) {
        setTimeout(function() {
          $wrapper.removeClass('navigation-processed');
        },200);

        setTimeout(function() {
          flagAnimation = true;
          $btnMap.fadeIn(200);
        }, 400);
      } else {
        $wrapper.removeClass('navigation-processed');
        flagAnimation = true;
      }
    }

    function animationDDListShow() {
      $wrapper.addClass('navigation-processed');
      flagAnimation = false;

      if(transitionSupport) {
        setTimeout(function() {
          currentDDBlock.slideDown(200, function() {
            flagAnimation = true;
          });
        },200);
      } else {
        currentDDBlock.show();
        flagAnimation = true;
      }
    }

    function animationDDListHide() {
      flagAnimation = false;

      if(transitionSupport) {
        currentDDBlock.slideUp(200, function() {
          $wrapper.removeClass('navigation-processed');

          setTimeout(function() {
            flagAnimation = true;
          }, 200);
        });
      } else {
        $wrapper.removeClass('navigation-processed');
        currentDDBlock.hide();
        flagAnimation = true;
      }
    }

    function setHeight() {
      $contentWrapper.css('min-height', $wrapper.outerHeight());
    }

    function cssTransitionSupport() {
      if('WebkitTransition' in document.body.style ||
        'MozTransition' in document.body.style ||
        'MsTransition' in document.body.style ||
        'OTransition' in document.body.style ||
        'transition' in document.body.style
        ) {
        return true;
      } else {
        return false;
      }
    }
  }

  function initDDlist() {
    var $wrapper = $('.page-services .cols-three.style-b'),
      $cols = $wrapper.find('.col'),
      $btn = $cols.find('h3'),
      className = 'dd-list-cloned',
      $body = $('body'),
      tooltipTopOffset = 80,
      colsTopOffset = 40;

    $cols.find('.col-hd h3').on('click', function() {
      var $this = $(this),
        $thisCol = $this.parents('.col');

      if($thisCol.hasClass('tooltip-processed')) {
        hideTooltips();
      } else {
        addElDDListInDom($thisCol, $this.siblings('.dd-block'));
        hideTooltips();
        showTooltip($thisCol.index());
      }
    });

    $('html').click(function(e) {
      var $parent = $btn.parents('.col');
      if(!$(e.target).closest($parent).length && $parent.hasClass('tooltip-processed')) {
        hideTooltips();
      }
    });

    $(window).on('resize', function() {
      setArrowIconPosition();
    });

    function addElDDListInDom(wrap, tooltip) {
      var index = wrap.index(),
        $currentTooltip;

      if($body.find('.' + className + '[data-col-id=' + index + ']').length > 0) return false;

      var $html = tooltip.clone();

      $html.addClass(className).attr('data-col-id', index);
      $body.append($html);

      $currentTooltip = $body.find('.' + className + '[data-col-id=' + index + ']');
      $currentTooltip.find('.dd-block-inner').append('<span class="arrow-icon"></span>');

      setTooltipPosition(wrap, $currentTooltip);
      setArrowIconPosition();
    }

    function setTooltipPosition(wrap, tooltip) {
      var wrapPositionTop = wrap.offset().top;

      tooltip.css('top', wrapPositionTop + tooltipTopOffset + 'px');
    }

    function setArrowIconPosition() {
      var $tooltips = $body.find('.' + className);

      for(var i = 0; i < $tooltips.length; i++) {
        $tooltips.eq(i).find('.arrow-icon').css('left', $cols.eq($tooltips.eq(i).data('col-id')).offset().left + 'px');
      }
    }

    function showTooltip(index) {
      var $currentTooltip = $body.find('.' + className + '[data-col-id=' + index + ']');

      $cols.eq(index).addClass('tooltip-processed');
      $currentTooltip.addClass('tooltip-processed').show();

      setOffsetTopForCols($currentTooltip.height());
    }

    function hideTooltips() {
      $cols.removeClass('tooltip-processed');
      $body.find('.' + className).removeClass('tooltip-processed').hide();

      setOffsetTopForCols(-colsTopOffset);
    }

    function setOffsetTopForCols(offset) {
      $cols.find('.col-bd').css('padding-top', offset + colsTopOffset + 'px');
    }
  }

})(jQuery);


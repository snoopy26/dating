(function($){
	
	var _self;
	var main_element;
	
	var def = {
		// berisi parameter nantinya
		current		: 0,
		autoplay	: false,
		scroll : 1,
		sliderSpeed : 500,
		sliderEasing : 'easeOutExpo',
		interval	: 4000,
		carousel : true,
		navNext : '',
		navPrev : '',
		diff_left : 0
	};
	
	// thanks for http://alexsexton.com/blog/2010/02/using-inheritance-patterns-to-organize-large-jquery-applications/ 
	if (typeof Object.create !== 'function') {
		Object.create = function (o) {
			function F() {} // optionally move this outside the declaration and into a closure if you need more speed.
			F.prototype = o;
			return new F();
		};
	}

	$.fn.tiket_carousel = function(options){
		if ( this.length ) {
			return this.each(function(){
				// Create a new speaker object via the Prototypal Object.create
				var tp = Object.create(tiketPrototype);

				// Run the initialization function of the speaker
				tp._init($(this), options); // `this` refers to the element
		
				// Save the instance of the speaker object in the element's data store
				$.data(this, 'tiketPrototype', tp);
			});
		}

	};

	var tiketPrototype = {
		
		// main javascript
		_init : function(element, options){
			this.$el = element;
			this.options = $.extend({}, def, options);
			this._loadInit();
		},
		
		// load semua event trigger
		_loadInit : function(){
			_self = this;
			
			main_element = this.$el;
			
			_self.current = this.options.current;
			_self.autoplay = this.options.autoplay;
			
			_self.wrapper = main_element.find('#slider');
			
			_self.wrapper_temp = _self.wrapper.html();
			
			_self.items = _self.wrapper.children('.tk-slide');
			
			_self.itemWidth = _self.items.width();
			
			_self.totalItems = _self.items.length;
			
			_self.isAnimate	= false;
			
			if (this.options.navNext) _self.navNext = this.options.navNext;
			if (this.options.navPrev) _self.navPrev = this.options.navPrev;
			
			if (this.options.navNext == "" && this.options.navPrev == ""){
				_self.navNext = main_element.find('#navNext');
				_self.navPrev = main_element.find('#navPrev');
			}
			
			if (_self.totalItems == 1){
				_self.navNext.hide();
				_self.navPrev.hide();
			}
			
			_self.wrapper.css('overflow', 'hidden');
			
			if (this.options.diff_left != 0){
				_self.itemWidth = this.options.diff_left;
			}
			_self.items.each(function(i){
				$(this).css({
					'position' : 'absolute',
					'left' : i * _self.itemWidth + 'px'
				});
			});
			
			var dots = $('<div class="nav-dots" />');
			for(var i=0; i<_self.totalItems; ++i){
				dots.append('<span />');
			}
			dots.appendTo($('#pages'));
			
			_self.pages = $('#pages').find('.nav-dots > span');
			
			_self._updatePage();
			
			_self._loadEvents();
			
			if (this.options.autoplay){
				this._startSlideshow();
			}
			
		},
		
		_startSlideshow : function(){
			var _self = this;
			this.slideshow = setTimeout(function(){
				var page = (_self.current < _self.totalItems - 1) ? page = _self.current + 1 : page = 0;
				_self._navigate(page, 'next', 1);
				if (_self.options.autoplay){
					_self._startSlideshow();
				}
			}, this.options.interval);
		},
		
		_updatePage : function(){
			this.pages.removeClass('nav-dots-current');
			this.pages.eq(this.current).addClass('nav-dots-current');
		},
		
		_loadEvents : function(){
			
			var _self = this;
			
			this.pages.bind('click', function(e){
				_self._page($(this).index());
				return false;
			});
			
			this.navNext.live('click', function(e){
				if( _self.options.autoplay ) {
					clearTimeout( _self.slideshow );
					_self.options.autoplay = false;
				}
				var page = (_self.current < _self.totalItems - 1) ? page = _self.current + 1 : page = 0;
				console.log(main_element.attr('id') +"->"+ _self.totalItems);
				if (_self.options.carousel === false){
					//console.log(Math.floor(_self.totalItems / 3) +"==="+ (page - 1));
					if ( Math.floor(_self.totalItems - 3) === (page -1)) return false;
				}
				_self._navigate(page, 'next', 1);
				return false;
			});
			
			this.navPrev.live('click', function(e){
				if( _self.options.autoplay ) {
					clearTimeout( _self.slideshow );
					_self.options.autoplay = false;
				}
				var page = (_self.current > 0) ? page = _self.current - 1 : page = _self.totalItems - 1;
				console.log(main_element.attr('id') +"->"+ _self.totalItems);
				if (_self.options.carousel === false){
					if (page === (_self.totalItems - 1)) return false;
				}
				_self._navigate(page, 'prev', 1);
				return false;
			});
			
		},
		
		_page : function(idx){
			if (idx >= this.totalItems || idx < 0){
				return false;
			}
			if( this.autoplay ) {
				clearTimeout( this.slideshow );
				this.autoplay = false;
			}
			
			this.pages.removeClass('nav-dots-current');
			this.pages.eq(idx).addClass('nav-dots-current');
			
			// tentukan scroll berdasarkan letak page yang di define
			var s = Math.abs(idx - this.current);
			
			this._navigate(idx, '', s);
		},
		
		_navigate : function(page, dir, scroll){
		
			var _self = this;
			
			var $current = this.items.eq(this.current);
			
			//console.log("Page: " + page + " & Current : " + this.current + " & scroll : " + scroll);
			
			if (this.current === page || this.isAnimate) return false;
			
			//console.log("OK===========");
			
			this.isAnimate = true;
			
			if (!dir){
				(page > this.current) ? d = 'next' : d = 'prev';
			}else{
				d = dir;
			}
			
			this.current = page;
			
			if (dir){
				this._updatePage();
			}
			
			//var scroll;
			//scroll = this.options.scroll;
			
			var factor = 1;
			var idxClicked = 0;
				
			if (d === 'next'){
				if (_self.options.carousel === true){
					this.wrapper.find('.tk-slide:lt('+scroll+')').each(function(i){
						$(this).clone(true).css('left', (_self.totalItems - idxClicked + i) * _self.itemWidth * factor + 'px').appendTo(_self.wrapper);
					});
				}			
			}else{
				
				if (_self.options.carousel === true){
					var $first = this.wrapper.children().eq(0);
						
					this.wrapper.find('.tk-slide:gt('+(this.totalItems - 1 - scroll)+')').each(function(i){
						$(this).clone(true).css('left', - (scroll - i + idxClicked) * _self.itemWidth * factor + 'px').insertBefore($first);
					});
				}
							
			}
			
			this.wrapper.find('.tk-slide').each(function(i){
				var $item = $(this);
				$item.stop().animate({
					left : (d === 'next') ? 
						'-=' + (_self.itemWidth * factor * scroll) + 'px' : 
						'+=' + (_self.itemWidth * factor * scroll) + 'px'
				}, _self.options.sliderSpeed, _self.options.sliderEasing, function(){
					if (_self.options.carousel === true){
						if (
							(d === 'next' && $item.position().left < - idxClicked * _self.itemWidth * factor) ||
							(d === 'prev' && $item.position().left > ((_self.totalItems - 1 - idxClicked) * _self.itemWidth * factor))
						){
							$item.remove();
						}
					}
					
					_self.isAnimate = false;
				});
			});
			
		}
	
	};
	
})(jQuery);
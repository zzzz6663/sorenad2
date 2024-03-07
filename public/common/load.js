/**
 * Modal Loading JavaScript Librarsy
 * @author 						c
 * @date    					2017-11-06
 * @param  {window} 	global
 * @param  {jQuery} 	$
 * @param  {function} 	factory
 * @return {void}
 * @version 1.0.0
 */
(function(window, $, factory) {

	window.Loading = factory(window, $);

})(window, jQuery, function(window, $) {

	var windowWidth;
	var windowHeight;

	/**
	 * ę˛„é€ Loading
	 * @author  				c
	 * @date 					2017-11-06
	 * @param {Object} options	ę˛„é€ Loadingē„å…·ä½“å¸‚ę•°
	 * @return {Loading} 		LoadingåÆ¹č±�
	 */
	function Loading(options) {
		return new Loading.prototype._init($('body'), options);
	}

	/**
	 * å¯å§‹å–å‡½ę•°
	 * @author  				c
	 * @date 					2017-11-06
	 * @param {Object} $this	jQueryåÆ¹č±�
	 * @param {Object} options	ę˛„é€ Loadingē„å…·ä½“å¸‚ę•°
	 * @return {Loading} 		LoadingåÆ¹č±�
	 */
	const init = Loading.prototype._init = function($target, options) {

		this.version = '1.0.0';

		this.$target = $target;

		this.set = $.extend(true, {}, this.set, options);

		this._build();

		return this;

	};

	/**
	 * ę˛„å»ŗLoading
	 * @return {void}
	 */
	Loading.prototype._build = function() {

		this.$modalMask = $('<div class="modal-mask"></div>');

		this.$modalLoading = $('<div class="modal-loading"></div>');

		this.$loadingTitle = $('<p class="loading-title"></p>');

		this.$loadingAnimation = $('<div class="loading-animate"></div>');

		this.$animationOrigin = $('<div class="animate-origin"><span></span></div>');

		this.$animationImage = $('<img/>');

		this.$loadingDiscription = $('<p class="loading-discription"></p>');

		// zIndex
		if(this.set.zIndex <= 0) {
			this.set.zIndex = (this.$target.siblings().length-1 || this.$target.children().siblings().length) + 10001;
		}

		// var attr, value;
		// for(attr in this.set) {
		// 	if(attr !== 'zIndex' && attr !== 'animationDuration') {
		// 		value = this.set[attr];
		// 		if(typeof value === 'number') {
		// 			if(value <= 0) {
		// 				this.set[attr] = 'auto';
		// 			} else {
		// 				this.set[attr] = (value + this.set.unit);
		// 			}
		// 		}
		// 	}
		// }

		// ę˛„å»ŗLoading
		this._buildMask();

		this._buildLoading();

		this._buildTitle();

		this._buildLoadingAnimation();

		this._buildDiscription();

		// ęÆå¦å¯å§‹å–čæ‡
		this._init = false;

		if(this.set.defaultApply) {
			this.apply();
		}

	}

	/**
	 * ę˛„å»ŗMask
	 * @return {void}
	 */
	Loading.prototype._buildMask = function() {

		// å¦‚ę˛äø¨é€‚ē”Øé®ē½©å±‚
		if(!this.set.mask) {
			this.$modalMask.css({
				position: 	'absolute',
				top: 		'-200%',
			});
			return ;
		}

		// é®ē½©å±‚ę ·å¼¸
		this.$modalMask.css({
			backgroundColor: 	this.set.maskBgColor,
			zIndex: 			this.set.zIndex,
		});

		// ę·»å é¢¯å¤–ē„class
		this.$modalMask.addClass(this.set.maskClassName);

	}

	/**
	 * ę˛„å»ŗLoading
	 * @return {void}
	 */
	Loading.prototype._buildLoading = function() {

		this.$modalLoading.css({
			width: 				this.set.loadingWidth,
			height: 			this.set.loadingHeight,
			padding: 			this.set.loadingPadding,
			backgroundColor: 	this.set.loadingBgColor,
			borderRadius: 		this.set.loadingBorderRadius,
		});

		// åøå±€ę–¹å¼¸
		if(this.set.direction === 'hor') {
			this.$modalLoading.addClass('modal-hor-layout');
		}

		// å°†loadingę·»å å°maskäø­
		this.$modalMask.append(this.$modalLoading);

	}

	/**
	 * ę˛„å»ŗTitle
	 * @return {void}
	 */
	Loading.prototype._buildTitle = function() {

		if(!this.set.title) {
			return ;
		}


		this.$loadingTitle.css({
			color: 		this.set.titleColor,
			fontSize: 	this.set.titleFontSize,
		});

		this.$loadingTitle.addClass(this.set.titleClassName);

		this.$loadingTitle.text(this.set.title);

		// å°†titleę·»å å°loadingäø­
		this.$modalLoading.append(this.$loadingTitle);

	}

	/**
	 * ę˛„å»ŗLoadingAnimation
	 * @return {void}
	 */
	Loading.prototype._buildLoadingAnimation = function() {

		// loadingAnimation
		this.$loadingAnimation.css({
			width: this.set.animationWidth,
			height: this.set.animationHeight,
		});

		if(this.set.loadingAnimation === 'origin') { // originåØē”»
			this.$animationOrigin.children().css({
				width: this.set.animationOriginWidth,
				height: this.set.animationOriginHeight,
				backgroundColor: this.set.animationOriginColor,
			});
			for(var i = 0; i < 5; i++) {
				this.$loadingAnimation.append(this.$animationOrigin.clone());
			}
		} else if(this.set.loadingAnimation === 'image') { // å›¾ē‰‡å č½½åØē”»
			this.$animationImage.attr('src', this.set.animationSrc);
			this.$loadingAnimation.append(this.$animationImage);
		} //else {
		// 	throw new Error("[loadingAnimation] å¸‚ę•°é”™čÆÆ. å¸‚ę•°å€¼å¸Ŗč½äøŗ['origin', 'image']");
		// }

		this.$loadingAnimation.addClass(this.set.animationClassName);

		// å°†loadingAnimationę·»å å°loadingäø­
		this.$modalLoading.append(this.$loadingAnimation);

	}

	/**
	 * ę˛„å»ŗDiscription
	 * @return {void}
	 */
	Loading.prototype._buildDiscription = function() {

		if(!this.set.discription) {
			return ;
		}

		this.$loadingDiscription.css({
			color: 		this.set.discriptionColor,
			fontSize: 	this.set.discriptionFontSize,
		});

		this.$loadingDiscription.addClass(this.set.discriptionClassName);

		this.$loadingDiscription.text(this.set.discription);

		// å°†titleę·»å å°loadingäø­
		this.$modalLoading.append(this.$loadingDiscription);

	}

	/**
	 * å®ä½¨
	 * @return {void}
	 */
	Loading.prototype._position = function() {

		windowWidth = $(window).width();
		windowHeight = $(window).height();

		var loadingWidth = this.$modalLoading.outerWidth();
		var loadingHeight = this.$modalLoading.outerHeight();

		var x1 = windowWidth >>> 1;
		var x2 = loadingWidth >>> 1;
		var left = x1 - x2;

		var y1 = windowHeight >>> 1;
		var y2 = loadingHeight >>> 1;
		var top = y1 - y2;

		this.$modalLoading.css({ top, left });

	}

	/**
	 * å…�å±¸čæ‡åŗ¦åØē”»
	 * @return {void}
	 */
	Loading.prototype._transitionAnimationIn = function() {

		if(!this.set.animationIn) {
			this.$modalMask.css({ display: 'block' });
		} else {
			// this.$modalMask.removeClass(this.set.animationOut).addClass(this.set.animationIn);
			this.$modalMask.addClass(this.set.animationIn);
		}

	}

	/**
	 * å‡ŗå±¸čæ‡åŗ¦åØē”»
	 * @return {void}
	 */
	Loading.prototype._transitionAnimationOut = function() {


		if(!this.set.animationOut) {

			// this.$modalMask.css({ display: 'none' });
			this.$modalMask.remove();

		} else {

			this._timer && this._timer.clearTimeout(this._timer);

			this.$modalMask.removeClass(this.set.animationIn).addClass(this.set.animationOut);

			// this._timer = setTimeout(() => {
			// 	this.$modalMask.remove();
			// }, this.set.animationDuration);

			var self = this;

			this._timer = setTimeout(function() {
				self.$modalMask.remove();
			}, this.set.animationDuration);

		}
	}

	/**
	 * ę¾ē¤ŗLoading
	 * @return {void}
	 */
	Loading.prototype.apply = function() {
		this._transitionAnimationIn();

		// čæ™ę ·ę‰ē†čÆ´å¸Æä»�å¢˛å ę€§č½, å› äøŗäø¨é€č¦ä»ˇå†…å­äø­åÆ»ę‰¾_initLoadingę–¹ę³•.
		if(!this._init) {
			// å¯å§‹å–Loading
			this._initLoading();
		}

	}

	/**
	 * éč—¸Loading
	 * @return {void}
	 */
	Loading.prototype.out = function() {
		this._transitionAnimationOut();
	}

	/**
	 * å¯å§‹å–Loading
	 * @return {void}
	 */
	Loading.prototype._initLoading = function() {

		// å·²ē»¸å¯å§‹čæ‡ ę— é€å†¨ę¬�å¯å§‹å–
		if(this._init) {
			return ;
		}

		// ę·»å å°é�µé¯¢äø­
		this.$target.append(this.$modalMask);

		// å®ä½¨
		this._position();

		// $(window).resize(() => {
		// 	windowWidth = $(window).width();
		// 	windowHeight = $(window).height();
		// 	this._position();
		// });

		var self = this;

		$(window).resize(function() {
			windowWidth = $(window).width();
			windowHeight = $(window).height();
			self._position();
		});

		this._init = true;
	}

	/**
	 * Loadingå¸‚ę•°å±˛ę€§
	 * å¸Æä»�ē®€å¨•ē„č®¾ē½®äø€äŗ›cssę ·å¼¸, å¤¨ę¯‚ē„cssę ·å¼¸å¸Æä»�é€čæ‡å¢˛å classę¯�ę›´ę”¹ę ·å¼¸.
	 *
	 * å¸ē´ å¨•ä½¨: å¦‚ę˛ęÆå­—ē¬¦äø², å™åˇę–‡č®¾ē½®. å¦‚ę˛ęÆę•°å­—ē±»å˛‹, é»č®¤å¨•ä½¨äøŗ{unit}. zIndexé™¤å¤–.
	 *
	 * å¦‚ę˛å­—ä½“ę ·å¼¸äøŗundefined(ä¾‹å¦‚: titleFontFamily), é‚£ä¹å°†ä¼é€‚ē”Øå…Øå±€ē„å­—ä½“ę ·å¼¸(fontFamily)
	 *
	 * @author  c
	 * @date 	2017-11-06
	 * @version 1.0.0
	 */
	Loading.prototype.set = {
		direction: 				'ver',	 					// ę–¹å‘. ver: å˛‚ē›´, hor: ę°´å¹³.

		title: 					undefined, 					// ę ‡é¢å†…å®¹.
		titleColor: 			'#FFF', 					// ę ‡é¢ę–‡å­—é¢č‰².
		titleFontSize: 			14, 						// ę ‡é¢ę–‡å­—å­—ä½“å¤§å°¸.
		titleClassName: 		undefined,					// ę ‡é¢é¢¯å¤–ē„classå€¼.
		// titleFontFamily: 	undefined,					// ę ‡é¢å­—ä½“ę ·å¼¸

		discription: 			undefined, 					// ę¸¸čæ°å†…å®¹.
		discriptionColor: 		'#FFF',						// ę¸¸čæ°ę–‡å­—é¢č‰².
		discriptionFontSize: 	14,							// ę¸¸čæ°ę–‡å­—å­—ä½“å¤§å°¸.
		discriptionClassName: 	undefined,					// ę¸¸čæ°é¢¯å¤–ē„classå€¼.
		// directionFontFamily: undefined,					// ę¸¸čæ°å­—ä½“ę ·å¼¸.

		loadingWidth: 			'auto',						// Loadingå®½åŗ¦.
		loadingHeight: 			'auto',						// Loadingé«åŗ¦.
		loadingPadding: 		20,							// Loadingå†…č¾¹č·¯.
		loadingBgColor: 		'#252525',					// Loadingčę™Æé¢č‰².
		loadingBorderRadius: 	12,							// Loadingē„borderRadius.
		// loadingPosition: 		'fixed',					// Loadingē„position

		mask: 					true, 						// é®ē½©å±‚. true: ę¾ē¤ŗé®ē½©å±‚, false: äø¨ę¾ē¤ŗ.
		maskBgColor: 			'rgba(0, 0, 0, .6)',		// é®ē½©å±‚čę™Æé¢č‰².
		maskClassName: 			undefined,					// äøŗé®ē½©å±‚ę·»å .
		// maskPosition: 			'fixed',					// é®ē½©å±‚position

		loadingAnimation: 		'origin',					// å č½½åØē”». origin: č�Øē¤ŗä½æē”Øé»č®¤ē„åˇē‚¹åØē”», image: č�Øē¤ŗä½æē”Øč‡Ŗå®ä¹‰å›¾ē‰‡ä½äøŗå č½½åØē”».
		animationSrc: 			undefined,					// å›¾ē‰‡å č½½åØē”»ē„å°å¯€. (å‰¨ę¸: loadingAnimation=origin, ä»�äø‹ē®€ē§°originę–č€…image)
		animationWidth: 		40, 						// åØē”»å®½åŗ¦. äøŗimageę—¶č�Øē¤ŗå›¾ē‰‡ē„å®½åŗ¦.
		animationHeight: 		40,							// åØē”»é«åŗ¦. äøŗimageę—¶č�Øē¤ŗå›¾ē‰‡ē„é«åŗ¦.
		animationOriginWidth:   4,							// åˇē‚¹åØē”»å®½åŗ¦.    (å‰¨ę¸: origin)
		animationOriginHeight:  4,							// åˇē‚¹åØē”»é«åŗ¦.    (å‰¨ę¸: origin)
		animationOriginColor:   '#FFF',						// åˇē‚¹åØē”»ē„é¢č‰².  (å‰¨ę¸: origin)
		animationClassName: 	undefined,					// äøŗåØē”»ę·»å äø€äøŖé¢¯å¤–ē„classå€¼.

		defaultApply: 			true,						// é»č®¤č‡ŖåØę¾ē¤ŗ.
		animationIn: 			'animated fadeIn', 			// å…�å±¸åØē”».
		animationOut: 			'animated fadeOut',			// å‡ŗå±¸åØē”».
		animationDuration: 		1000,						// åØē”»ęē»­ę—¶é—´(å¨•ä½¨:ms)
		// fontFamily: 			'sans-serif',				// ę–‡å­—å­—ä½“ę ·å¼¸.
		// position: 				'fixed',				// å®ä½¨. maskå’loadingē„å®ä½¨.
		// unit: 				'px', 						// č®¾ē½®é»č®¤å¨•ä½¨.
		zIndex: 				0,							// ę€å¤–å›´å±‚ēŗ§(mask). å¦‚ę˛ęÆ0ę–č€…č´ę•°, å™äøŗ{$this.siblings() + 10001}.

	};

	init.prototype = Loading.prototype;

	return Loading;
});

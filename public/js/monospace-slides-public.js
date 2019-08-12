(  function() {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 */

	var slides  = document.querySelectorAll( '.mnsp-slide' ),
		sliders = document.querySelectorAll( '.mnsp-slider' );

	slides.forEach( function( slide ) {

		var $this 		= slide,
			title 		= $this.querySelector( '.mnsp-slide-title' ),
			subTitle 	= $this.querySelector( '.mnsp-slide-subtitle' ),
			desc 		= $this.querySelector( '.mnsp-slide-desc' ),
			cta 		= $this.querySelector( '.mnsp-slide-cta' ),
			featured 	= $this.querySelector( '.mnsp-slide-featured' );

		if ( title ) {
			title.style.color = $this.dataset.mnspSlideTitleColor;
		}

		if ( subTitle ) {
			subTitle.style.color = $this.dataset.mnspSlideSubtitleColor;
		}

		if ( desc ) {
			desc.style.color = $this.dataset.mnspSlideDescColor;
		}

		if ( cta ) {
			cta.style.color = $this.dataset.mnspSlideCtaTextColor;
			cta.style.backgroundColor = $this.dataset.mnspSlideCtaBgColor;

			cta.addEventListener( 'mouseover', function() {
				$this.querySelector( '.mnsp-slide-cta' ).style.backgroundColor = $this.dataset.mnspSlideCtaHoverBgColor;
			}, false );

			cta.addEventListener( 'mouseout', function() {
				$this.querySelector( '.mnsp-slide-cta' ).style.backgroundColor = $this.dataset.mnspSlideCtaBgColor;
			}, false );
		}

		$this.style.backgroundColor = $this.dataset.mnspSlideBgColor;

		if ( featured ) {
			featured.style.opacity = $this.dataset.mnspSlideFeaturedOpacity;
		}

	} ); // eslint-disable-line

	sliders.forEach( function( element ) {

		var $this = element,
			slider,
			autoplay = $this.hasAttribute( 'data-mnsp-slider-autoplay' ),
			pauseHover = $this.hasAttribute( 'data-mnsp-slider-pause-hover' ),
			transitionDuration = $this.dataset.mnspSliderTransitionDuration || 1000,
			timeout = 0;

		if ( autoplay ) {
			timeout = $this.dataset.mnspSliderTimeout;
		}

		slider = new Glide( $this, {
			type: 'carousel',
			autoplay: timeout,
			hoverpause: pauseHover,
			animationDuration: transitionDuration,
			perView: 1
		} ); // eslint-disable-line

		slider.mount();

	} ); // eslint-disable-line

} () );

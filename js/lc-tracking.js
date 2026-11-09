/**
 * Contact event tracking: phone clicks, email clicks and Contact Form 7 submissions.
 * Sends GA4 events via gtag() and mirrors them to the dataLayer for GTM.
 */
( function () {
	'use strict';

	function track( name, params ) {
		params = params || {};
		params.page_path = window.location.pathname;
		if ( typeof window.gtag === 'function' ) {
			window.gtag( 'event', name, params );
		}
		window.dataLayer = window.dataLayer || [];
		window.dataLayer.push( Object.assign( { event: name }, params ) );
	}

	function linkLocation( el ) {
		if ( el.closest( 'header, nav, #wrapper-navbar' ) ) {
			return 'header';
		}
		if ( el.closest( 'footer' ) ) {
			return 'footer';
		}
		return 'content';
	}

	document.addEventListener( 'click', function ( e ) {
		var a = e.target.closest ? e.target.closest( 'a[href]' ) : null;
		if ( ! a ) {
			return;
		}
		var href = a.getAttribute( 'href' ) || '';
		if ( /^tel:/i.test( href ) ) {
			track( 'click_phone', {
				link_url: href,
				link_text: a.textContent.trim().slice( 0, 60 ),
				link_location: linkLocation( a ),
			} );
		} else if ( /^mailto:/i.test( href ) ) {
			track( 'click_email', {
				link_url: href,
				link_text: a.textContent.trim().slice( 0, 60 ),
				link_location: linkLocation( a ),
			} );
		}
	} );

	// Fires only after CF7 reports the mail was sent successfully.
	document.addEventListener( 'wpcf7mailsent', function ( e ) {
		track( 'generate_lead', {
			form_id: e.detail && e.detail.contactFormId,
			form_name: e.detail && e.detail.unitTag,
			method: 'contact_form',
		} );
	} );
} )();

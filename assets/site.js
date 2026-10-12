( function () {
	var btn = document.querySelector( '.nav-toggle' );
	var nav = document.getElementById( 'primary-nav' );
	if ( ! btn || ! nav ) {
		return;
	}

	function setOpen( open ) {
		btn.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
		nav.classList.toggle( 'is-open', open );
	}

	btn.addEventListener( 'click', function () {
		setOpen( btn.getAttribute( 'aria-expanded' ) !== 'true' );
	} );

	nav.addEventListener( 'click', function ( e ) {
		if ( e.target.closest( 'a' ) ) {
			setOpen( false );
		}
	} );

	document.addEventListener( 'keydown', function ( e ) {
		if ( e.key === 'Escape' && nav.classList.contains( 'is-open' ) ) {
			setOpen( false );
			btn.focus();
		}
	} );
} )();

// Баннер cookie: показываем, пока посетитель не нажал «Понятно».
( function () {
	var banner = document.getElementById( 'cookie-banner' );
	if ( ! banner ) {
		return;
	}
	var KEY = 'codepath_cookie_ok';
	var seen = false;
	try {
		seen = localStorage.getItem( KEY ) === '1';
	} catch ( e ) {}
	if ( seen ) {
		return;
	}
	banner.hidden = false;
	banner.querySelector( 'button' ).addEventListener( 'click', function () {
		banner.hidden = true;
		try {
			localStorage.setItem( KEY, '1' );
		} catch ( e ) {}
	} );
} )();

class Feature {
	constructor(name, hasCookie = true) {
		this.name = name;
		this.isEnabled = false;
		this.bodyClassEnabled = name;
		this.bodyClassDisabled = 'no' + name;
		this.hasCookie = hasCookie;

		// Turn on feature on load if the cookie is set
		this.hasCookie && this.toggle(JSON.parse(Cookies.get(this.name) || false));

		// Link toggle
		$(`input[name="${this.name}"]`).on('change', () => {
			this.toggle($(event.target).is(':checked'));
		});
	}

	_updateBodyClass() {
		$('body').toggleClass(this.bodyClassEnabled, this.isEnabled);
		$('body').toggleClass(this.bodyClassDisabled, !this.isEnabled);
	}

	_updateToggle() {
		$(`input[name="${this.name}"]`).prop('checked', this.isEnabled);
	}

	_setCookie() {
		this.hasCookie && Cookies.set(this.name, this.isEnabled, { expires: 365 });
	}

	hasCookieSet() {
		return typeof Cookies.get(this.name) !== 'undefined';
	}

	toggle(state = !this.isEnabled) {
		this.isEnabled = state;
		this._updateBodyClass();
		this._updateToggle();
		this._setCookie();
	}

	enable() {
		this.toggle(true);
	}

	disable() {
		this.toggle(false);
	}
}

let darkMode = new Feature('DarkMode');
let lineWrap = new Feature('LineWrap');

/**
 * Turn on dark mode if 'prefers-color-scheme: dark' matches and cookie is not set
 */

if ( !darkMode.hasCookieSet() && window.matchMedia('(prefers-color-scheme: dark)').matches ) {
	darkMode.enable();
}
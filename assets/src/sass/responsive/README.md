# Examples for `@include mq()`

```scss
body {
	background: white;

	@include mq(mobile) { // @media (min-width: 35.5em)
		background: SILVER;
	}

	@include mq(tablet) { // @media (min-width: 48em)
		background: GRAY;
	}

	@include mq(desktop) { // @media (min-width: 64em)
		background: BLACK;
	}

	@include mq(wide) { // @media (min-width: 80em)
		background: GREEN;
	}

	@include mq(false, mobile) { // @media (max-width: 35.49em)
		background: RED;
	}

	@include mq(false, tablet) { // @media (max-width: 47.99em)
		background: MAROON;
	}

	@include mq(false, desktop) { // @media (max-width: 63.99em)
		background: YELLOW;
	}

	@include mq(mobile, tablet) { // @media (min-width: 35.5em) and (max-width: 47.99em)
		background: OLIVE;
	}

	@include mq(tablet, desktop) { // @media (min-width: 48em) and (max-width: 63.99em)
		background: LIME;
	}

	@include mq($until: tablet, $and: '(orientation: landscape)') { // @media (max-width: 47.99em) and (orientation: landscape)
		background: AQUA;
	}

	@include mq($until: mobile, $and: '(orientation: portrait)') { // @media (max-width: 35.49em) and (orientation: portrait)
		background: TEAL;
	}
}
```

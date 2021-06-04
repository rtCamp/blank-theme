/**
 * Main scripts, loaded on all pages.
 */

import '../sass/main.scss';
import { common as BlankThemeCommons } from './components';

// Initialize common scripts.

/**
 * Removing WebFont loader temporarily, to test self-hosted fonts.
 * Keeping the webfontloader script to properly test it later on dev site.
 */
// WebFont.init();
BlankThemeCommons.init();

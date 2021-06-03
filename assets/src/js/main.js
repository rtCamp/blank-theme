/**
 * Main scripts, loaded on all pages.
 */

import '../sass/main.scss';
import * as components from './components';

// Initialize common scripts.
components.WebFont.init();
components.common.init();

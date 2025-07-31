/**
 * --------------------------------------------------------------------------
 * Application JavaScript entry‐point
 * --------------------------------------------------------------------------
 * 1.  We import Alpine and (optionally) its focus plugin
 * 2.  Expose Alpine on `window` so Livewire / Volt can talk to it
 * 3.  Start Alpine
 * 4.  Leave the door open for any other scripts you might need later
 * --------------------------------------------------------------------------
 */

import Alpine from 'alpinejs'
import focus from '@alpinejs/focus'   // <-- optional but nice for modals etc.

window.Alpine = Alpine               // make Alpine globally available
Alpine.plugin(focus)                 // register the plugin (remove if not used)
Alpine.start()                       // kick things off
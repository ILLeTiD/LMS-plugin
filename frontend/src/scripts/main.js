/**
 * Manage global libraries like jQuery or THREE from the package.json file
 */
var $ = require('jquery');
import  'mediaelement';
// Import libraries
import 'izimodal';

// Import custom modules
import App from'./modules/app.js';

(($) => {
    const app = new App();

    $('video, audio').mediaelementplayer({
        // Do not forget to put a final slash (/)
        pluginPath: 'https://cdnjs.com/libraries/mediaelement/',
        // this will allow the CDN to use Flash without restrictions
        // (by default, this is set as `sameDomain`)
        shimScriptAccess: 'always'
        // more configuration
    });
})($);


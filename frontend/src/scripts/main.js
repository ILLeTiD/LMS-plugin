/**
 * Manage global libraries like jQuery or THREE from the package.json file
 */
// var $ = require('jquery');
var $ = window.jQuery;
// import  'mediaelement';
// Import libraries
import 'izimodal';

// Import custom modules
import App from'./modules/app.js';

(($) => {
    const app = new App();
    //var player = new MediaElementPlayer('#slide-control-player');
})($);


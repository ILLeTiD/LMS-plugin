/**
 * Manage global libraries like jQuery or THREE from the package.json file
 */
// var $ =  window.jQuery= require('jquery');

var $ = window.jQuery;
import "babel-polyfill";
import './utilities/nodeListForEach'
import "web-animations-js"
require('intersection-observer');

// Import libraries
import 'izimodal';

// import './utilities/arrayFind'
// Import custom modules
import App from'./modules/app.js';

(($) => {
    IntersectionObserver.prototype.POLL_INTERVAL = 100;
    const app = new App();
})($);


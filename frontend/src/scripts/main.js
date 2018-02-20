/**
 * Manage global libraries like jQuery or THREE from the package.json file
 */
// var $ = require('jquery');
var $ = window.jQuery;
// import  'mediaelement';
// Import libraries
import 'izimodal';
require('intersection-observer');
import objectFitImages from 'object-fit-images';
// Import custom modules
import App from'./modules/app.js';

(($) => {
    IntersectionObserver.prototype.POLL_INTERVAL = 100;
    objectFitImages();
    const app = new App();
    //var player = new MediaElementPlayer('#slide-control-player');
})($);


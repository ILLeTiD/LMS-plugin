/**
 * Manage global libraries like jQuery or THREE from the package.json file
 */
// var $ =  window.jQuery= require('jquery');
var $ = window.jQuery;
import "babel-polyfill";
import './utilities/nodeListForEach'
import "web-animations-js"
require('intersection-observer');
import objectFitImages from 'object-fit-images';
// import  'mediaelement';
// Import libraries
import 'izimodal';

// import './utilities/arrayFind'
// Import custom modules
import App from'./modules/app.js';

(($) => {
    IntersectionObserver.prototype.POLL_INTERVAL = 100;
    objectFitImages();
    const app = new App();

    //var player = new MediaElementPlayer('#slide-control-player');
})($);


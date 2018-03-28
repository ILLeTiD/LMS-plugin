/**
 * Manage global libraries like jQuery or THREE from the package.json file
 */
// var $ =  window.jQuery= require('jquery');
var $ = window.jQuery;
import "babel-polyfill";
import './utilities/nodeListForEach'
import "web-animations-js"
require('intersection-observer');
var Dropzone = require('dropzone');

// import  'mediaelement';
// Import libraries
import 'izimodal';

// import './utilities/arrayFind'
// Import custom modules
import App from'./modules/app.js';

(($) => {
    IntersectionObserver.prototype.POLL_INTERVAL = 100;

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#lms-user-form-avatar-image').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    console.log('sdfdsfs');
    $("#lms-user-form-avatar input").change(function () {
        console.log(this);
        readURL(this);
    });
    const app = new App();
    //var player = new MediaElementPlayer('#slide-control-player');
})($);


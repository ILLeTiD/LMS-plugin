export default () => {
    var sAgent = window.navigator.userAgent;
    var Idx = sAgent.indexOf("MSIE");

    // If IE, return version number.
    if (Idx > 0)
    //  return parseInt(sAgent.substring(Idx + 5, sAgent.indexOf(".", Idx)));
        return true;
    // If IE 11 then look for Updated user agent string.
    else if (!!navigator.userAgent.match(/Trident\/7\./))
        return true;

    else
        return false; //It is not IE
}
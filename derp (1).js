function getParameterByName(name, url = window.location.href) {
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return "";
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

function extractHostname(url) {
    var hostname;
    if (url.indexOf("//") > -1) {
        hostname = url.split("/")[2];
    } else {
        hostname = url.split("/")[0];
    }
    hostname = hostname.split(":")[0];
    hostname = hostname.split("?")[0];
    return hostname;
}

var parentURL = getParameterByName("website");

function getPosition(string, subString, index) {
  return string.split(subString, index).join(subString).length;
}

function replaceHost(url) {
	url = url.substring(getPosition(url, "/", 3), url.length)
	return parentURL + url;
}

if (extractHostname(parentURL) != extractHostname(sheet.href)) {
	sheet.href = replaceHost(sheet.href);
}
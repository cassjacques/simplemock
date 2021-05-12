(function(){
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
    parentURL = "https://" + extractHostname(parentURL);
  
    function getPosition(string, subString, index) {
     return string.split(subString, index).join(subString).length;
    }
  
    function replaceHost(url) {
      url = url.substring(getPosition(url, "/", 3), url.length);
      return parentURL + url;
    }
  
    function fixStyles(sheet) {
      if(sheet.classList.contains('ignore-url-fix'))
        return;
      if (extractHostname(sheet.href).includes('localhost'))
        sheet.href = replaceHost(sheet.href);
    }
  
    function fixScripts(scr) {
      if(scr.classList.contains('ignore-url-fix'))
        return;
  
      if (extractHostname(scr.src).includes('localhost')) {
        var ns = document.createElement("script");
        ns.type = "text/javascript";
        ns.async = true;
        ns.src = replaceHost(scr.src);
  
        document.body.appendChild(ns);
      }
    }
  
    console.log("---------");
    console.log("SimpleMock - Init: Page Request Fixes");
    console.log("---------");
  
    document.querySelectorAll("link").forEach(ss => fixStyles(ss));
    document.querySelectorAll("script").forEach(sc => fixScripts(sc));
  })();
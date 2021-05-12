console.log("---------");
console.log("SimpleMock - Init: Ad Replacement!!");
console.log("---------");
(function () {
  var type = "iframe",
      orientations = [{
        name: "horizontal",
        sizes: [
          "970,250",
          "728,90",
          "970,90"]
      },{
        name: "vertical",
        sizes: [
          "300,250",
          "300,600",
          "160,600"]
      },{
        name: "mobile",
        sizes: [
          "300,50",
          "320,50"]
      }];
 
  function testOrientations(ori, iframe, testSize, names) {
    ori.sizes.forEach(function(s){
     if(!testSize){
        testSize = iframe.width + ", " + iframe.height;
      }
      if(testSize.includes(s)){
        names.push(ori.name);
      }
    });
  }

  function findgptaddivSizes(ad) {
    var sizesets = ad.querySelectorAll("gpt-sizeset");
    var set = sizesets[0].getAttribute("sizes").replace(/\s/g, '');
    if (sizesets.length > 0) {
      for (var x = 1; x < sizesets.length; x++){
        if (parseInt(sizesets[x].getAttribute("viewport-size").substring(1,4)) < window.innerWidth) {
          set += sizesets[x].getAttribute("sizes").replace(/\s/g, '');
        }
      }
    }
    return set;
  }

  function getGenericSize(ad) {
    var name = "horizontal";

    if (ad.offsetWidth < 728)
      name = "vertical";

    return name;
  }

  function replaceAds(ad) {
    if (ad.src && ad.src.includes('embed'))
      return;

    // huffpo article fix
    if (ad.classList.contains('asset_inserts'))
      return;

    if (!ad || ad.width < 1){
      ad.parentNode.removeChild(ad);
      return;
    }

    var names = [];
    var testSize;

    if (type == "iframe") {
      // test if newer GPT tags w/ data-sizes works
      if (ad.parentNode.parentNode.getAttribute("data-sizes")) { 
        testSize = ad.parentNode.parentNode.getAttribute("data-sizes").replace(/\s/g, '');
      } else { // default to iframe size
        testSize = ad.width + "," + ad.height;
      }
    }

    if (type == "gpt-ad") {
      testSize = findgptaddivSizes(ad);
    }

    if (type == "generic-div") {
      names = [getGenericSize(ad)];
    } else if (type == "single-div"){
      names = ["horizontal"];
    } else {
      orientations.forEach(o => testOrientations(o, ad, testSize, names));
    }

    if (names.length < 1)
      return;

    if (names[0] == "horizontal") {
      if (window.innerWidth > 728) {
        names[0] = "horizontal";
      } else {
        names[0] = "mobile";
      }
    }

    var placeholder = document.createElement("img");
    placeholder.src = "uploaded_files/" + names[0] + ".png ";
    placeholder.classList.add("simpleMock--ad");
    
    if (type == "generic-div" || type == "single-div") {
      var targ = ad.firstChild;
      if (targ.nodeName == "DIV") {
        targ.appendChild(placeholder);
      } else {
        console.log(targ);
        ad.appendChild(placeholder);  
      }
    } else {
      ad.parentNode.appendChild(placeholder);
      ad.parentNode.removeChild(ad);
    }

    placeholder.onload = function() {
      this.setAttribute("style", "width: " + this.naturalWidth + "px !important;height: " + this.naturalHeight + "px !important; display: block; margin-left: auto; margin-right: auto;" );
    };
  }

  function checkType(target, typeName) {
    if (typeName == "iframe") {
      if (target.id.includes('google_ads_iframe')) {
        console.log("SimpleMock - Found Iframe Ads");
        type = typeName;
        return;
      }
    }

    if (typeName == "gpt-ad") {
      if (target){
        console.log("SimpleMock - GPT-AD");
        type = typeName;
        return;
      }
    }

    if (typeName == "generic-div") {
      if (target){
        console.log("SimpleMock - Found Generic Ad Classes");
        type = typeName;
        return;
      }
    }

    if (typeName == "single-div") {
      if (target){
        console.log("SimpleMock - Found Single Ad Classes");
        type = typeName;
        return;
      }
    }

    console.log("SimpleMock - No special cases found. Using default ad targets."); // blackdoctor, hypehair, queerty
  }

  function checkTypes(targets, typeName) {
    if (!targets)
      return;

    targets.forEach(target => checkType(target, typeName));
  }

  window.setTimeout(function(){
    // default - people
    checkTypes(document.querySelectorAll(".Ad, .advertisement"), "generic-div"); // buzzfeed
    checkTypes(document.querySelectorAll(".ad-banner"), "single-div"); // newnownext
    checkTypes(document.querySelectorAll("iframe"), "iframe"); // essence, watchtheyard
    checkTypes(document.querySelectorAll("gpt-ad"), "gpt-ad"); //

    if(type=="iframe"){
      var iframes;
      window.setInterval(function () {
        iframes = document.querySelectorAll("iframe");
        iframes.forEach(iframe => replaceAds(iframe));
      }, 50);
    }

    if(type=="gpt-ad") {
      var gptaddivs = document.querySelectorAll("gpt-ad");
      gptaddivs.forEach(gptaddiv => replaceAds(gptaddiv));
    }

    if(type=="generic-div") {
      var genericDivs = document.querySelectorAll(".Ad, .advertisement");
      genericDivs.forEach(genericDiv => replaceAds(genericDiv)); 
    }

    if(type=="single-div") {
      var singleDivs = document.querySelectorAll(".ad-banner");
      singleDivs.forEach(singleDiv => replaceAds(singleDiv)); 
    }
  }, 1000);
})();


















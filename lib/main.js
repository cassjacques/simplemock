var myForm = document.getElementById("assetsForm");

var uploadButtons = document.querySelectorAll('label');
uploadButtons.forEach(function(uB){
    uB.onclick = function() {
        this.classList.add("chosen");
        this.parentNode.classList.add("chosen");
    };
});

var myFiles = [
  document.getElementById("horizontal-upload"),
  document.getElementById("vertical-upload"),
  document.getElementById("mobile-upload")
];

myForm.onsubmit = function (event) {
  event.preventDefault();
  var formData = new FormData();

  function attachFile(f) {
    if (!f.files[0] || !f.files[0].type.match("image.*")) {
      return;
    }
    formData.append(f.id, f.files[0], f.files[0].name);
  }

  myFiles.forEach(file => attachFile(file));

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "upload.php", true);
  xhr.onload = function () {
    if (xhr.status == 200) {
      let myURL = document.querySelector("input[name=website]").value;
      if (myURL.length || myURL !== "https://www.site.com") {
        window.open("index.php?website=" + myURL, "_blank");
      } else {
        alert("Invalid URL");
      }
    }
  };
  xhr.send(formData);
}
function initPage() {

var coll = $(".question");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
      //coll[i].find('img').attr('src',"{{ asset('assets/plus.svg') }}");
    } else {
      content.style.display = "block";
      //coll[i].find('img').attr('src',"{{ asset('assets/help.png') }}");
    }
  })
};
}

$(document).ready(initPage);

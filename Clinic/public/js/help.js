function initPage() {
    var coll = $(".question");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
                /*  $(".question")
                    .find("img")
                    .attr("src", "../assets/Gest/plus.svg");*/
            } else {
                content.style.display = "block";
                /* $(".question.active")
                    .find("img")
                    .attr("src", "../assets/Gest/minus.svg");*/
            }
        });
    }
}

$(document).ready(initPage);

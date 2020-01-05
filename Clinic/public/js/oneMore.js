function initPage() {
    // $(".sidenav").append("<a href='https://www.google.pt/' >Google </a> ");
    var content = $("meta[name='csrf-token']").attr("content");

    console.log(content);

    $.ajax({
        url: "/client/news",
        type: "GET",
        async: true,
        success: function(data, statuTxt, xhr) {
            console.log(data);
            if (data.success) {
                if (data.data.length != 0 || data.anal.length != 0) {
                    for (var el in data.data) {
                        $("#fillStuff").append(
                            "<div id='ApUl" + data.data[el].id + "'> </div>"
                        );
                        $("#ApUl" + data.data[el].id).append(
                            "<ul> " + data.data[el].date
                        );
                        $("#ApUl" + data.data[el].id).append(
                            "<li>" + data.data[el].state.state + "</li>"
                        );
                        $("#ApUl" + data.data[el].id).append(
                            "<li>" + data.data[el].medic.user.name + "</li>"
                        );
                        $("#ApUl" + data.data[el].id).append(
                            "<li>" +
                                data.data[el].medic.specialty.specialty +
                                "</li>"
                        );
                        $("#ApUl" + data.data[el].id).append("</ul>");
                        $("#ApUl" + data.data[el].id).append(
                            "<button id='" +
                                data.data[el].id +
                                "Ap' class='consultas'> Eliminar </button>"
                        );
                        $("#ApUl" + data.data[el].id).append("<hr>");
                    }

                    for (var el in data.anal) {
                        $("#fillStuff2").append(
                            "<div id='AnUl" + data.anal[el].id + "'> </div>"
                        );
                        $("#AnUl" + data.anal[el].id).append(
                            " <ul > " + data.anal[el].date
                        );
                        $("#AnUl" + data.anal[el].id).append(
                            "<li>" + data.anal[el].state.state + "</li>"
                        );

                        $("#AnUl" + data.anal[el].id).append("</ul>");
                        $("#AnUl" + data.anal[el].id).append(
                            "<button id='" +
                                data.anal[el].id +
                                "An' class='analises'> Eliminar </button>"
                        );
                        $("#AnUl" + data.anal[el].id).append("<hr> </div>");
                    }

                    var modal = document.getElementById("modalComent");
                    modal.style.display = "block";

                    var span = document.getElementsByClassName("close")[0];

                    span.onclick = function() {
                        modal.style.display = "none";
                    };

                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    };

                    $(".consultas").click(function() {
                        var id = parseInt(this.id);
                        console.log(id);
                        var id = parseInt(this.id);
                        console.log(id);
                        var data = {
                            _token: content,
                            id: id
                        };
                        $.ajax({
                            url: "/client/appointment/cancel",
                            type: "POST",
                            async: true,
                            data: data,
                            success: function(data, statuTxt, xhr) {
                                console.log(data);
                                if (data.success) {
                                    $("#ApUl" + id).remove();
                                }
                            }
                        });
                    });

                    $(".analises").click(function() {
                        var id = parseInt(this.id);
                        console.log(id);
                        var data = {
                            _token: content,
                            id: id
                        };
                        $.ajax({
                            url: "/client/analysis/cancel",
                            type: "POST",
                            async: true,
                            data: data,
                            success: function(data, statuTxt, xhr) {
                                console.log(data);
                                if (data.success) {
                                    $("#AnUl" + id).remove();
                                }
                            }
                        });
                    });
                }
            } else {
                console.log(data.message);
            }
        }
    });
}

$(document).ready(initPage);

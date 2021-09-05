$(function () {
    $("#postSerachForm").submit(function (e) {
        e.preventDefault();
        var searchPostName = $("#searchPostName").val().trim();
        if (searchPostName == "") {
            window.location.href = "/posts/";
        } else {
            window.location.href = "/posts_by_name/" + searchPostName;
        }
    });
});

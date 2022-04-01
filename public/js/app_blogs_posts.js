$(function () {
    $("#enterImageSearchPost").click(function (e) {
        e.preventDefault();
        searchPost();
    });
    $("#postSerachForm").submit(function (e) {
        e.preventDefault();
        searchPost();
    });
});

function searchPost() {
    var searchPostName = $("#searchPostName").val().trim();
    if (searchPostName == "") {
        window.location.href = "/posts/";
    } else {
        window.location.href = "/posts_by_name/" + searchPostName;
    }
}

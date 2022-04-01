$(function () {
    $("#enterImageSearchCategory").click(function (e) {
        e.preventDefault();
        searchCategory();
    });
    $("#categorySearchForm").submit(function (e) {
        e.preventDefault();
        searchCategory();
    });
});

function searchCategory() {
    var categoryName = $("#searchCategoryName").val().trim();
    window.location.href = "/categories/" + categoryName;
}

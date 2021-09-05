$(function () {
    $("#categorySearchForm").submit(function (e) {
        e.preventDefault();
        var categoryName = $("#searchCategoryName").val().trim();
        window.location.href = "/categories/" + categoryName;
    });
});

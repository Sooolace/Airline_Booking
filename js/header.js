document.addEventListener("DOMContentLoaded", function () {
    // Fetch the header.html file
    fetch("header.html")
        .then((response) => response.text())
        .then((data) => {
            // Insert the header content into the <header> element
            document.querySelector("header").innerHTML = data;
        });
});
function redirectToAdmin() {
    window.location.href = "admin/admin.php";
}


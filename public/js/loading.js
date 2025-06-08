window.onload = function() {
    const target = document.getElementById("product-list");
    if (target) {
        target.scrollIntoView({
            behavior: "smooth"
        });
    }
};
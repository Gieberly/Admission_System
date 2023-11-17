$(document).ready(function() {
    const tabBtn = document.querySelectorAll(".tab");
    const tab = document.querySelectorAll(".tabShow");

    function tabs(panelIndex) {
        tab.forEach(function(node) {
            node.style.display = "none";
        });
        tab[panelIndex].style.display = "block";

        tabBtn.forEach(function(node) {
            node.classList.remove("active");
        });
        tabBtn[panelIndex].classList.add("active");
    }

    tabs(0);

    $(".tab").click(function() {
        const index = $(this).index();
        tabs(index);
    });
});

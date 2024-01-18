//Announcement Popup
window.addEventListener("load", function () {
    // Function to disable form elements and buttons
    function disableFormElements() {
        document.querySelector("form").querySelectorAll("input, button").forEach(function (element) {
            element.disabled = true;
        });
    }

    // Function to enable form elements and buttons
    function enableFormElements() {
        document.querySelector("form").querySelectorAll("input, button").forEach(function (element) {
            element.disabled = false;
        });
    }

    setTimeout(function open(event) {
        document.querySelector(".announcement_popup").style.display = "block";
        // Disable form elements and buttons when the popup is displayed
        disableFormElements();
    }, 50);

    document.querySelector("#close").addEventListener("click", function () {
        document.querySelector(".announcement_popup").style.display = "none";
        // Enable form elements and buttons when the popup is closed
        enableFormElements();
    });
});
//Announcement Popup
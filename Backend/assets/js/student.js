const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item => {
    const li = item.parentElement;

    item.addEventListener('click', function () {
        allSideMenu.forEach(i => {
            i.parentElement.classList.remove('active');
        })
        li.classList.add('active');
    })
});



// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
    sidebar.classList.toggle('hide');
})

document.addEventListener('DOMContentLoaded', function () {
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

    dropdownToggles.forEach(function (toggle) {
        toggle.addEventListener('click', function (e) {
            e.preventDefault();
            const dropdownContent = toggle.nextElementSibling;
            const chevronIcon = toggle.querySelector('.bx-chevron-down');

            // Toggle the visibility of the dropdown content
            if (dropdownContent.style.display === 'block') {
                dropdownContent.style.display = 'none';
                chevronIcon.style.transform = 'rotate(0deg)';
            } else {
                dropdownContent.style.display = 'block';
                chevronIcon.style.transform = 'rotate(180deg)';
            }
        });
    });
});



//search bar

const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

searchButton.addEventListener('click', function (e) {
    if (window.innerWidth < 576) {
        e.preventDefault();
        searchForm.classList.toggle('show');
        if (searchForm.classList.contains('show')) {
            searchButtonIcon.classList.replace('bx-search', 'bx-x');
        } else {
            searchButtonIcon.classList.replace('bx-x', 'bx-search');
        }
    }
})




if (window.innerWidth < 768) {
    sidebar.classList.add('hide');
} else if (window.innerWidth > 576) {
    searchButtonIcon.classList.replace('bx-x', 'bx-search');
    searchForm.classList.remove('show');
}


window.addEventListener('resize', function () {
    if (this.innerWidth > 576) {
        searchButtonIcon.classList.replace('bx-x', 'bx-search');
        searchForm.classList.remove('show');
    }
})



const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', function () {
    if (this.checked) {
        document.body.classList.add('dark');
    } else {
        document.body.classList.remove('dark');
    }
})



//side bar
document.addEventListener('DOMContentLoaded', function () {
    const dropdownItems = document.querySelectorAll('#courses-dropdown .dropdown-content li a');

    dropdownItems.forEach(function (item) {
        const fullText = item.getAttribute('data-fulltext');
        const abbreviation = item.querySelector('.text');

        // Save the original abbreviation
        const originalAbbreviation = abbreviation.textContent;

        item.addEventListener('mouseover', function () {
            // Apply a smaller font size and show the full text on two lines when hovering
            abbreviation.style.fontSize = '12px';
            abbreviation.style.whiteSpace = 'normal'; // Allow multiple lines
            abbreviation.textContent = fullText;
        });

        item.addEventListener('mouseout', function () {
            // Restore the original state when not hovering
            abbreviation.style.fontSize = ''; // Empty string resets to the default size
            abbreviation.style.whiteSpace = 'nowrap'; // Display on one line
            abbreviation.textContent = originalAbbreviation;
        });
    });
});

//side bar


//clock
// Calling showTime function at every second
setInterval(showTime, 1000);

// Defining showTime funcion
function showTime() {
    // Getting current time and date
    let time = new Date();
    let hour = time.getHours();
    let min = time.getMinutes();
    let sec = time.getSeconds();
    am_pm = "AM";

    // Setting time for 12 Hrs format
    if (hour >= 12) {
        if (hour > 12) hour -= 12;
        am_pm = "PM";
    } else if (hour == 0) {
        hr = 12;
        am_pm = "AM";
    }

    hour =
        hour < 10 ? "0" + hour : hour;
    min = min < 10 ? "0" + min : min;
    sec = sec < 10 ? "0" + sec : sec;

    let currentTime =
        hour +
        ":" +
        min +
        ":" +
        sec +
        am_pm;

    // Displaying the time
    document.getElementById(
        "clock"
    ).innerHTML = currentTime;
}

showTime();
//clock

$(document).ready(function () {
    $("#settings").click(function () {
        $("#settings-dropdown").toggle();
        $("#help-dropdown").hide(); // Hide the other dropdown
        $("#profile-content").toggleClass("soft-transition");
    });

    $("#help").click(function () {
        $("#help-dropdown").toggle();
        $("#settings-dropdown").hide(); // Hide the other dropdown
        $("#profile-content").toggleClass("soft-transition");
    });
});

function openPopup(popupId) {
    closeAllPopups();
    document.getElementById(popupId).style.display = 'block';
    document.getElementById('overlay').style.display = 'block';
}

function closePopup(popupId) {
    document.getElementById(popupId).style.display = 'none';
    document.getElementById('overlay').style.display = 'none';
}

function closeAllPopups() {
    var popups = document.querySelectorAll('.popup');
    for (var i = 0; i < popups.length; i++) {
        popups[i].style.display = 'none';
    }
    document.getElementById('overlay').style.display = 'none';
}

document.addEventListener("DOMContentLoaded", function () {

    const profileButton = document.querySelector("#profile-button");
    const profilePopup = document.querySelector("#profile-popup");



    // Toggle the display of the profile popup when the button is clicked
    profileButton.addEventListener("click", function () {
        // Toggle the visibility of the profile popup
        profilePopup.style.display = profilePopup.style.display === "block" ? "none" : "block";
    });

    // Close the profile popup when the user clicks outside the popup
    document.addEventListener("click", function (event) {
        if (!profileButton.contains(event.target) && !profilePopup.contains(event.target)) {
            profilePopup.style.display = "none";
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Get the elements needed for toggling visibility
    const availableBox = document.getElementById('available-box');
    const availableSlot = document.getElementById('available-slot');
    const readmissionAnnounce = document.getElementById('readmission-announce');
    const releasingAnnounce = document.getElementById('releasing-annouce');

    // Add click event listeners to the corresponding elements
    availableBox.addEventListener('click', function () {
        // Toggle visibility of "Available Slots" content
        toggleVisibility(availableSlot);
    });

    const readmittedBox = document.getElementById('readmitted-box');
    readmittedBox.addEventListener('click', function () {
        // Show "Readmission Date" content and hide others
        readmissionAnnounce.style.display = 'block';
        availableSlot.style.display = 'none';
        releasingAnnounce.style.display = 'none';
    });

    // Add click event listener for the "Releasing of Result" box
    const nonqualifiedBox = document.getElementById('nonqualified-box');
    nonqualifiedBox.addEventListener('click', function () {
        // Show "Releasing of Result" content and hide others
        releasingAnnounce.style.display = 'block';
        availableSlot.style.display = 'none';
        readmissionAnnounce.style.display = 'none';
    });

    // Function to toggle visibility of an element
    function toggleVisibility(element) {
        if (element.style.display === 'none' || element.style.display === '') {
            element.style.display = 'block';
        } else {
            element.style.display = 'none';
        }
    }
});


document.addEventListener('DOMContentLoaded', function () {
    const seeMoreButton = document.getElementById('see-more-button');
    const tableRows = document.getElementById('available-table').querySelectorAll('tbody tr');

    // Display only 5 rows initially
    for (let i = 5; i < tableRows.length; i++) {
        tableRows[i].style.display = 'none';
    }

    seeMoreButton.addEventListener('click', function () {
        // Toggle display and update button text
        for (let i = 5; i < tableRows.length; i++) {
            tableRows[i].style.display = (tableRows[i].style.display === 'none' || tableRows[i].style.display === '') ? 'table-row' : 'none';
        }

        seeMoreButton.innerHTML = (seeMoreButton.innerHTML.includes('See More')) ? 'See Less <i class=\'bx bx-chevron-up\'></i>' : 'See More <i class=\'bx bx-chevron-down\'></i>';
    });
});

//pressing Sidebar
document.addEventListener('DOMContentLoaded', function () {
    const dashboardLink = document.getElementById('profile-link');
    const dashboardContent = document.getElementById('student-profile-content');
    const StudentProfileLink = document.getElementById('student-profile-link');
    const StudentProfileContent = document.getElementById('dashboard-content');
    const StudentResultLink = document.getElementById('student-result-link');
    const StudentResultContent = document.getElementById('student-result-content');

    // Initially hide the content divs by default
    dashboardContent.style.display = 'block';
    StudentProfileContent.style.display = 'none';
    StudentResultContent.style.display = 'none';


    // Add event listeners to the links
    dashboardLink.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default link behavior
        dashboardContent.style.display = 'block';
        StudentProfileContent.style.display = 'none';
        StudentResultContent.style.display = 'none';

    });

    StudentProfileLink.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default link behavior
        dashboardContent.style.display = 'none';
        StudentProfileContent.style.display = 'block';
        StudentResultContent.style.display = 'none';


    });

    StudentResultLink.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default link behavior
        dashboardContent.style.display = 'none';
        StudentProfileContent.style.display = 'none';
        StudentResultContent.style.display = 'block';

    });


});

function generatePDF() {
    // Create a new jsPDF instance
    var pdf = new jsPDF();

    // Set font size and style
    pdf.setFontSize(16);
    pdf.setFont("helvetica", "normal");

    // Add a title to the PDF
    pdf.text('User Profile', 20, 20);

    // Add ID picture to the PDF
    var idPicture = new Image();
    idPicture.src = document.getElementById('result-id-picture').getElementsByTagName('img')[0].src;
    pdf.addImage(idPicture, 'JPEG', 150, 30, 50, 50);

    // Set font size and style for the content
    pdf.setFontSize(12);

    // Define the content to be included in the PDF
    var content = `
        Personal Information:
        Application Date: ${document.getElementById('date-of-application').innerText}
        Full Name: ${document.getElementById('result-Full-Name').innerText}
        Gender: ${document.getElementById('result-Gender').innerText}
        Birthdate: ${document.getElementById('result-Birthdate').innerText}

        Permanent Home Address:
        Address: ${document.getElementById('result-ZipCode').innerText}
        Zip Code: ${document.getElementById('result-ZipCode').innerText}

        Contact Information:
        Telephone/Mobile No.: ${document.getElementById('result-Telephone').innerText}
        Facebook Account Name: ${document.getElementById('result-Facebook').innerText}
        Email Address: ${document.getElementById('result-Email').innerText}

        Academic Background:
        High School/Senior High School: ${document.getElementById('high_school_name_address').innerText}
        ALS/PEPT: ${document.getElementById('result-ALS').innerText}
        College/University: ${document.getElementById('college_name_address').innerText}
        Learner's Reference Number: ${document.getElementById('result-LRN').innerText}
        Degree: ${document.getElementById('result-Degree').innerText}
        Nature of Degree: ${document.getElementById('result-natureDegree').innerText}
    `;

    // Add the content to the PDF
    pdf.text(content, 20, 90);

    // Save the PDF file
    pdf.save('user_profile.pdf');
}

//log out prompt
function confirmLogout() {
    // Display a confirmation dialog
    var confirmLogout = confirm("Are you sure you want to log out?");

    // If the user clicks "OK," redirect to logout.php
    if (confirmLogout) {
        window.location.href = "../Backend/logout.php";
    } else {
        alert("Logout canceled");
    }
}

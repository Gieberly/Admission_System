
document.addEventListener('DOMContentLoaded', function () {
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

    // Set 'Master List' as active by default
    const sidebarActivetLink = document.getElementById('announcements-link');
    sidebarActivetLink.parentElement.classList.add('active');

    // Remove 'active' class from 'Dashboard' link
    const dashboardLink = document.getElementById('dashboard-link');
    dashboardLink.parentElement.classList.remove('active');
});
 

// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
})




//search bar

const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

searchButton.addEventListener('click', function (e) {
	if(window.innerWidth < 576) {
		e.preventDefault();
		searchForm.classList.toggle('show');
		if(searchForm.classList.contains('show')) {
			searchButtonIcon.classList.replace('bx-search', 'bx-x');
		} else {
			searchButtonIcon.classList.replace('bx-x', 'bx-search');
		}
	}
})




if(window.innerWidth < 768) {
	sidebar.classList.add('hide');
} else if(window.innerWidth > 576) {
	searchButtonIcon.classList.replace('bx-x', 'bx-search');
	searchForm.classList.remove('show');
}


window.addEventListener('resize', function () {
	if(this.innerWidth > 576) {
		searchButtonIcon.classList.replace('bx-x', 'bx-search');
		searchForm.classList.remove('show');
	}
})



const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', function () {
	if(this.checked) {
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




// tab like buttons for Student Result and Forms
document.addEventListener('DOMContentLoaded', function () {
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    // Function to activate a specific tab
    function activateTab(tabId) {
        tabButtons.forEach((btn) => {
            btn.classList.remove('active');
        });

        tabContents.forEach((content) => {
            content.classList.remove('active');
        });

        const activeButton = document.querySelector(`.tab-button[data-tab="${tabId}"]`);
        const activeContent = document.getElementById(tabId);

        if (activeButton && activeContent) {
            activeButton.classList.add('active');
            activeContent.classList.add('active');
        }
    }

    // Activate 'tab3' by default
    activateTab('tab4');

    tabButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const tabId = button.getAttribute('data-tab');
            activateTab(tabId);
        });
    });
});  


//dropdown for nature of degree
function updateSelection(answer) {
    console.log(answer.value);
    if(answer.value == 1){
        document.getElementById('nonBoard').classList.remove('nonboardProgram');
        document.getElementById('Board').classList.add('boardProgram');
    } else {
        document.getElementById('Board').classList.remove('boardProgram');
        document.getElementById('nonBoard').classList.add('nonboardProgram');
    }
};

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


function toggleDevonContent() {
    var devonContent = document.getElementById("devon-content");

    // Toggle the display property
    if (devonContent.style.display === "block" || devonContent.style.display === "") {
        devonContent.style.display = "none";
    } else {
        devonContent.style.display = "block";
    }
}
function toggleSettingContent() {
    var settingsContent = document.getElementById("setting-content");

    // Toggle the display property
    if (settingsContent.style.display === "block" || settingsContent.style.display === "") {
        settingsContent.style.display = "none";
    } else {
        settingsContent.style.display = "block";
    }
}

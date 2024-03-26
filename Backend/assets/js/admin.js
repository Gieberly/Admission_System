const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item=> {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i=> {
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



function applyDarkMode() {
    const isDarkMode = localStorage.getItem('darkMode') === 'true';
    if (isDarkMode) {
        document.body.classList.add('dark');
        document.getElementById('switch-mode').checked = true;
    } else {
        document.body.classList.remove('dark');
        document.getElementById('switch-mode').checked = false;
    }
}

// Add event listener to the switch
const switchMode = document.getElementById('switch-mode');
switchMode.addEventListener('change', function () {
    if (this.checked) {
        document.body.classList.add('dark');
        localStorage.setItem('darkMode', 'true'); // Save dark mode preference
    } else {
        document.body.classList.remove('dark');
        localStorage.setItem('darkMode', 'false'); // Save light mode preference
    }
});

// Apply dark mode when the page loads
applyDarkMode();


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



//pressing the box info and dashboard

document.addEventListener('DOMContentLoaded', function () {
    const AvailableItem = document.getElementById('available-box');
    const AdmittedItem = document.getElementById('admission-box');
    const ReadmittedItem = document.getElementById('admitted-box');
    const NonqualifiedItem = document.getElementById('readmitted-box');
});

document.addEventListener('DOMContentLoaded', function () {
    const dashboardLink = document.getElementById('dashboard-link');
    const dashboardContent = document.getElementById('dashboard-content');
    const MasterListLink = document.getElementById('master-list-link');
    const MasterListContent = document.getElementById('master-list-content');
    const StudentResultLink = document.getElementById('student-result-link');
    const StudentResultContent = document.getElementById('student-result-content');
    const DataResultLink = document.getElementById('data-result-link');
    const DataResultContent = document.getElementById('data-result-content');
    const ScheduleResultLink = document.getElementById('schedule-result-link');
    const ScheduleContent = document.getElementById('schedule-result-content');
    const InfoResultLink = document.getElementById('data-info-link');
    const InfoResultContent = document.getElementById('data-info-content');

    // Initially hide the content divs by default
    dashboardContent.style.display = 'block';
    MasterListContent.style.display = 'none';
    StudentResultContent.style.display = 'none';
    DataResultContent.style.display = 'none';
    ScheduleContent.style.display = 'none';
    InfoResultContent.style.display = 'none';  // Display 'Data' tab by default

    // Add event listeners to the links
    dashboardLink.addEventListener('click', function (event) {
        event.preventDefault();
        dashboardContent.style.display = 'block';
        MasterListContent.style.display = 'none';
        StudentResultContent.style.display = 'none';
        DataResultContent.style.display = 'none';
        ScheduleContent.style.display = 'none';
        InfoResultContent.style.display = 'none';
    });

    MasterListLink.addEventListener('click', function (event) {
        event.preventDefault();
        dashboardContent.style.display = 'none';
        MasterListContent.style.display = 'block';
        StudentResultContent.style.display = 'none';
        DataResultContent.style.display = 'none';
        ScheduleContent.style.display = 'none';
        InfoResultContent.style.display = 'none';
    });

    StudentResultLink.addEventListener('click', function (event) {
        event.preventDefault();
        dashboardContent.style.display = 'none';
        MasterListContent.style.display = 'none';
        StudentResultContent.style.display = 'block';
        DataResultContent.style.display = 'none';
        ScheduleContent.style.display = 'none';
        InfoResultContent.style.display = 'none';
    });

    DataResultLink.addEventListener('click', function (event) {
        event.preventDefault();
        dashboardContent.style.display = 'none';
        MasterListContent.style.display = 'none';
        StudentResultContent.style.display = 'none';
        DataResultContent.style.display = 'block';
        ScheduleContent.style.display = 'none';
        InfoResultContent.style.display = 'none';
    });
    ScheduleResultLink.addEventListener('click', function (event) {
        event.preventDefault();
        dashboardContent.style.display = 'none';
        MasterListContent.style.display = 'none';
        StudentResultContent.style.display = 'none';
        DataResultContent.style.display = 'none';
        ScheduleContent.style.display = 'block';
        InfoResultContent.style.display = 'none';
    });
    InfoResultLink.addEventListener('click', function (event) {
        event.preventDefault();
        dashboardContent.style.display = 'none';
        MasterListContent.style.display = 'none';
        StudentResultContent.style.display = 'none';
        DataResultContent.style.display = 'none';
        ScheduleContent.style.display = 'none';
        InfoResultContent.style.display = 'block';
    });
});

$(document).ready(function(){
    // Initialize the tabs
    $('#dataTabs a').on('click', function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    // Hide other tab contents when a tab is shown
    $('#dataTabs a').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href"); // activated tab
        $('.tab-pane').not(target).removeClass('show active');
    });
});

// tab like buttons for Student Result and Forms
  const tabButtons = document.querySelectorAll('.tab-button');
  const tabContents = document.querySelectorAll('.tab-content');

  tabButtons.forEach((button) => {
    button.addEventListener('click', () => {
      const tabId = button.getAttribute('data-tab');

      tabButtons.forEach((btn) => {
        btn.classList.remove('active');
      });

      tabContents.forEach((content) => {
        content.classList.remove('active');
      });

      button.classList.add('active');
      document.getElementById(tabId).classList.add('active');
    });
});
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
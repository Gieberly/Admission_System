document.addEventListener('DOMContentLoaded', function () {
    const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');
    const currentURL = window.location.href;

    // Retrieve the sidebar state from local storage
    const sidebarState = localStorage.getItem('sidebarState');
    const sidebar = document.getElementById('sidebar');

    // Set the initial state of the sidebar based on local storage
    if (sidebarState === 'hidden') {
        sidebar.classList.add('hide');
    }

    allSideMenu.forEach(item => {
        const li = item.parentElement;

        // Check if the current URL matches the href attribute of the sidebar item
        if (currentURL.includes(item.getAttribute('href'))) {
            li.classList.add('active');
        }

        item.addEventListener('click', function (event) {
            event.preventDefault();

            allSideMenu.forEach(i => {
                i.parentElement.classList.remove('active');
            });

            li.classList.add('active');

            // Navigate to the clicked link
            const destinationURL = item.getAttribute('href');
            setTimeout(() => {
                window.location.href = destinationURL;
            }, 300); // Adjust the timeout to match the transition duration
        });
    });

    // Check if the current URL includes any of the dropdown links and set "Colleges" as active
    const dropdownLinks = document.querySelectorAll('#courses-dropdown .dropdown-content li a');
    dropdownLinks.forEach(link => {
        if (currentURL.includes(link.getAttribute('href'))) {
            document.querySelector('').parentElement.classList.add('active');
        }
    });

});

// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
    // Toggle the 'hide' class on the sidebar
    sidebar.classList.toggle('hide');

    // Store the state of the sidebar in local storage
    const sidebarState = sidebar.classList.contains('hide') ? 'hidden' : 'visible';
    localStorage.setItem('sidebarState', sidebarState);
});



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





//pressing the box info and dashboard



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



$(document).ready(function () {
    $("#settings").click(function () {
        $("#settings-dropdown").toggle();
        $("#setting-content").hide();
        $("#help-dropdown").hide(); // Hide the other dropdown
        $("#profile-content").toggleClass("soft-transition");
    }); 
    

    $("#help").click(function () {
        $("#help-dropdown").toggle();
        $("#settings-dropdown").hide();
        $("#setting-content").hide(); // Hide the other dropdown
        $("#profile-content").toggleClass("soft-transition");
    });
    $("#setting").click(function () {
        $("#setting-content").toggle();
        $("#settings-dropdown").hide();
        $("#help-dropdown").hide(); // Hide the other dropdown
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
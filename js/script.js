function showOneWayFields() {
    document.getElementById('oneWayFields').style.display = 'block';
    document.getElementById('roundTripFields').style.display = 'none';
    showFormElements();
}

function showRoundTripFields() {
    document.getElementById('oneWayFields').style.display = 'none';
    document.getElementById('roundTripFields').style.display = 'block';
    showFormElements();
}

function showFormElements() {
    var passengerCount = document.getElementById('passengerCount');
    var selectClass = document.getElementById('selectClass');
    var submitButton = document.getElementById('submitButton');

    if (document.getElementById('oneWayFields').style.display === 'block') {
        passengerCount.style.display = 'block';
        selectClass.style.display = 'block';
        submitButton.style.display = 'block';
    } else {
        passengerCount.style.display = 'none';
        selectClass.style.display = 'none';
        submitButton.style.display = 'none';
    }
}

function showFlightResults() {
    document.getElementById("flightresults").style.display = "block";

}

    // JavaScript to capture the selected class and submit the form
    document.getElementById('selectClass').addEventListener('change', function() {
        this.form.submit();
    });

    

//popup form
const popup = document.getElementById("popupContainer");
const openButton = document.getElementById("openPopup");
const closeButton = document.getElementById("closePopup");

// Open the popup when the "Sign in" link is clicked
openButton.addEventListener("click", function () {
    popup.style.display = "block";
});

// Close the popup when the close button is clicked
closeButton.addEventListener("click", function () {
    popup.style.display = "none";
});

// Close the popup if the user clicks outside the popup content
window.addEventListener("click", function (event) {
    if (event.target === popup) {
        popup.style.display = "none";
    }
});

//search
function validateSearchForm() {
    const departure = document.getElementById('frmOneWay').value;
    const arrival = document.getElementById('toOneWay').value;

    // Check if any of the required fields are empty
    if (!departure || !arrival) {
        const errorMessages = document.getElementById('errorMessages');
        errorMessages.innerHTML = 'Please fill in all required fields.';
        return false; // Prevent the form submission
    }

    // If the form is valid, you can proceed with the search
    return true;
}


    function showText(textId) {
        const elements = document.querySelectorAll('[id^="economyText"], [id^="businessText"]');
        elements.forEach(element => {
            if (element.id === textId) {
                element.style.display = 'block';
            } else {
                element.style.display = 'none';
            }
        });
    }

    document.querySelector('form[name="yourFormName"]').addEventListener('submit', function() {
        var passengerInput = document.querySelector('input[name="passenger"]');
        document.cookie = "passengerCount=" + passengerInput.value;
    });
    
    function submitAllForms() {
        document.getElementById('passengerForms').submit();
    }

    function selectClass(className) {
        // Set the selected class in the session via an AJAX call or form submission
        // For example, using a fetch request
        fetch('update_class_session.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ selectedClass: className }),
        })
        .then(response => {
            if (response.ok) {
                // Reload the page or perform other actions upon success
                location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function showFields(fieldToShow) {
        const allFields = ['oneWayFields', 'roundTripFields'];
        allFields.forEach(field => {
            document.getElementById(field).style.display = field === fieldToShow ? 'block' : 'none';
        });
    }

    
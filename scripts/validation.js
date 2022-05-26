document.getElementById("createAccountForm").onsubmit = validateAccountForm;

function validateAccountForm()
{


    clearErrors();

    //Flag variable to track if form is valid
    let valid = true;

    let fname = document.getElementById('fname').value;
    if (fname.length < 2) {
        valid = false;
        document.getElementById("err-fname").style.display = "block";
    }

    let lname = document.getElementById('lname').value;
    if (lname.length < 2) {
        document.getElementById("err-lname").style.display = "block";
        valid = false;
    }

    let password = document.getElementById('password').value;
    if (password.length < 1) {
        document.getElementById("err-password").style.display = "block";
        valid = false;
    } else if (password.length < 8) {
        document.getElementById("err-passwordLength").style.display = "block";
        valid = false;
    }

    let street = document.getElementById('street').value;
    if (street.length < 5) {
        document.getElementById("err-street").style.display = "block";
        valid = false;
    }

    let city = document.getElementById('city').value;
    if (city.length < 1) {
        document.getElementById("err-city").style.display = "block";
        valid = false;
    }

    let zip = document.getElementById('zip').value;
    if (zip.length < 1) {
        document.getElementById("err-zip").style.display = "block";
        valid = false;
    }

    let cardNum = document.getElementById('cardNum').value + "";
    if (cardNum.length != 16) {
        document.getElementById("err-cardNum").style.display = "block";
        valid = false;
    }

    let expMonth = document.getElementById('expMonth').value;
    if (expMonth > 12 || expMonth< 1) {
        document.getElementById("err-expMonth").style.display = "block";
        valid = false;
    }
    let expYear = document.getElementById('expYear').value;
    if (expYear < 2022) {
        document.getElementById("err-expYear").style.display = "block";
        valid = false;
    }

    let cvv = document.getElementById('cvv').value;
    if (cvv > 9999 || cvv < 100) {
        document.getElementById("err-cvv").style.display = "block";
        valid = false;
    }


    //Return false if any errors were found
    return valid;
}

//Clear all error messages
function clearErrors()
{
    let errors = document.getElementsByClassName("err")
    for (let i=0; i<errors.length; i++)
    {
        errors[i].style.display = "none";
    }
}
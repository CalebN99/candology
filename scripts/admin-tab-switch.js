// Candology Website
// File: admin-tab-switch.js
// Script to toggle between admin tabs (Orders and Inventory)


// Get tab buttons
const orderTabBtn = document.getElementById("orderTabBtn");
const invTabBtn = document.getElementById("invTabBtn");

// Get Tabs
const orderTab = document.getElementById("orderTab");
const invTab = document.getElementById("invTab");


// Assign functionality to buttons
orderTabBtn.onclick = function() {
    displayTab(orderTab, invTab);
}
invTabBtn.onclick = function() {
    displayTab(invTab, orderTab);
}

// Function to toggle visibility of tabs
displayTab = function (activeTab, disableTab) {
    // assign active class to display tab button
    activeTab.classList.add("active");
    disableTab.classList.remove("active");

    // Hide the other tab
    disableTab.classList.remove("d-block");
    disableTab.classList.add("d-none");

    // Display the active tab
    activeTab.classList.remove("d-none");
    activeTab.classList.add("d-block");
}
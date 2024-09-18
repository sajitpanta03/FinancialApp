<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		content="width=device-width, 
				initial-scale=1.0">
	<title>FA Calendar</title>
</head>

<body>
	 <!-- Main wrapper for the calendar application -->
	 <div class="wrapper">
        <div class="container-calendar">
            <div id="left">
                <h1>FA Calendar</h1>
                <div id="event-section">
                    <h3>Add Event</h3>
                    <input type="date" id="eventDate" min=<?php echo date('Y-m-d'); ?> required>
                    <input type="text"
                        id="eventTitle"
                        placeholder="Event Title">
                    <input type="text"
                        id="eventDescription"
                        placeholder="Event Description">
                    <button id="addEvent" onclick="addEvent()">
                        Add
                    </button>
                </div>
                <div id="reminder-section">
                    <h3>Reminders</h3>
                    <!-- List to display reminders -->
                    <ul id="reminderList">
                        <li data-event-id="1">
                            <strong>Event Title</strong>
                            - Event Description on Event Date
                            <button class="delete-event"
                                onclick="deleteEvent(1)">
                                Delete
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="right">
                <h3 id="monthAndYear"></h3>
                <div class="button-container-calendar">
                    <button id="previous"
                            onclick="previous()">
                          ‹
                      </button>
                    <button id="next"
                            onclick="next()">
                          ›
                      </button>
                </div>
                <table class="table-calendar"
                       id="calendar"
                       data-lang="en">
                    <thead id="thead-month"></thead>
                    <!-- Table body for displaying the calendar -->
                    <tbody id="calendar-body"></tbody>
                </table>
                <div class="footer-container-calendar">
                    <label for="month">Jump To: </label>
                    <!-- Dropdowns to select a specific month and year -->
                    <select id="month" onchange="jump()">
                        <option value=0>Jan</option>
                        <option value=1>Feb</option>
                        <option value=2>Mar</option>
                        <option value=3>Apr</option>
                        <option value=4>May</option>
                        <option value=5>Jun</option>
                        <option value=6>Jul</option>
                        <option value=7>Aug</option>
                        <option value=8>Sep</option>
                        <option value=9>Oct</option>
                        <option value=10>Nov</option>
                        <option value=11>Dec</option>
                    </select>
                    <!-- Dropdown to select a specific year -->
                    <select id="year" onchange="jump()"></select>
                </div>
            </div>
        </div>
    </div>
	<!-- Include the JavaScript file for the calendar functionality -->
	<script src="assets/calenderScript.js"></script>
</body>

</html>

<style>
/* styles.css */

/* General styling for the entire page */
body {
	font-family: Arial, sans-serif;
	background-color: white;
	margin: 0;
}

.wrapper {
	max-width: 1100px;
	margin: 15px auto;
}

/* Calendar container */
.container-calendar {
	background: #ffffff;
	padding: 15px;
	max-width: 900px;
	margin: 0 auto;
	overflow: auto;
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
	display: flex;
	justify-content: space-between;
}

/* Event section styling */
#event-section {
	padding: 10px;
	background: #f5f5f5;
	margin: 20px 0;
	border: 1px solid #ccc;
}

.container-calendar #left h1 {
	color: #0A2558;
	text-align: center;
	background-color: #f2f2f2;
	margin: 0;
	padding: 10px 0;
}

#event-section h3 {
	color: #0A2558;
	font-size: 18px;
	margin: 0;
}

#event-section input[type="date"],
#event-section input[type="text"] {
	margin: 10px 0;
	padding: 5px;
	width: 80%;
}

#event-section button {
	background: green;
	color: white;
	border: none;
	padding: 5px 10px;
	cursor: pointer;
}

.event-marker {
	position: relative;
}

.event-marker::after {
	content: '';
	display: block;
	width: 6px;
	height: 6px;
	background-color: red;
	border-radius: 50%;
	position: absolute;
	bottom: 0;
	left: 0;
}

/* event tooltip styling */
.event-tooltip {
	position: absolute;
	background-color: rgba(234, 232, 232, 0.763);
	color: black;
	padding: 10px;
	border-radius: 4px;
	bottom: 20px;
	left: 50%;
	transform: translateX(-50%);
	display: none;
	transition: all 0.3s;
	box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
	z-index: 1;
}

.event-marker:hover .event-tooltip {
	display: block;
}

/* Reminder section styling */
#reminder-section {
	padding: 10px;
	background: #f5f5f5;
	margin: 20px 0;
	border: 1px solid #ccc;
}

#reminder-section h3 {
	color: green;
	font-size: 18px;
	margin: 0;
}

#reminderList {
	list-style: none;
	padding: 0;
}

#reminderList li {
	margin: 5px 0;
	font-size: 16px;
}

/* Style for the delete buttons */
.delete-event {
	background: rgb(237, 19, 19);
	color: white;
	border: none;
	padding: 5px 10px;
	cursor: pointer;
	margin-left: 10px;
	align-items: right;
}

/* Buttons in the calendar */
.button-container-calendar button {
	cursor: pointer;
	background: green;
	color: #fff;
	border: 1px solid green;
	border-radius: 4px;
	padding: 5px 10px;
}

/* Calendar table */
.table-calendar {
	border-collapse: collapse;
	width: 100%;
}

.table-calendar td,
.table-calendar th {
	padding: 5px;
	border: 1px solid #e2e2e2;
	text-align: center;
	vertical-align: top;
}

/* Date picker */
.date-picker.selected {
	background-color: #f2f2f2;
	font-weight: bold;
	outline: 1px dashed #00BCD4;
}

.date-picker.selected span {
	border-bottom: 2px solid currentColor;
}

/* Day-specific styling */
.date-picker:nth-child(1) {
	color: red;
	/* Sunday */
}

.date-picker:nth-child(6) {
	color: green;
	/* Friday */
}

/* Hover effect for date cells */
.date-picker:hover {
	background-color: green;
	color: white;
	cursor: pointer;
}

/* Header for month and year */
#monthAndYear {
	text-align: center;
	margin-top: 0;
}

/* Navigation buttons */
.button-container-calendar {
	position: relative;
	margin-bottom: 1em;
	overflow: hidden;
	clear: both;
}

#previous {
	float: left;
}

#next {
	float: right;
}

/* Footer styling */
.footer-container-calendar {
	margin-top: 1em;
	border-top: 1px solid #dadada;
	padding: 10px 0;
}

.footer-container-calendar select {
	cursor: pointer;
	background: #ffffff;
	color: #585858;
	border: 1px solid #bfc5c5;
	border-radius: 3px;
	padding: 5px 1em;
}

</style>
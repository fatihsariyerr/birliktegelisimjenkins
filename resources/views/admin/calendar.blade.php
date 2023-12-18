<!doctype html>
<html lang="en">
  <head>
  	<title>Doktor Takvimi</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="../calendar/css/style.css">
<style>
    .cssbuttons-io {
  position: relative;
  font-family: inherit;
  font-weight: 400;
  font-size: 14px;
  letter-spacing: 0.05em;
  border-radius: 0.8em;
  border: none;
  background: linear-gradient(to right, #8e2de2, #4a00e0);
  color: ghostwhite;
  overflow: hidden;
}

.cssbuttons-io svg {
  width: 1.2em;
  height: 1.2em;
  margin-right: 0.5em;
}

.cssbuttons-io span {
  position: relative;
  z-index: 10;
  transition: color 0.4s;
  display: inline-flex;
  align-items: center;
  padding: 0.8em 1.2em 0.8em 1.05em;
}

.cssbuttons-io::before,
.cssbuttons-io::after {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 0;
}

.cssbuttons-io::before {
  content: "";
  background: #000;
  width: 120%;
  left: -10%;
  transform: skew(30deg);
  transition: transform 0.4s cubic-bezier(0.3, 1, 0.8, 1);
}

.cssbuttons-io:hover::before {
  transform: translate3d(100%, 0, 0);
}

.cssbuttons-io:active {
  transform: scale(0.95);
}

    </style>
	</head>
	<body>
	<section class="ftco-section">
	<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Takvimimdeki Etkinlikler</h2>
				</div>
			</div>
            <div class="row">
				<div class="col-md-12">
					<div class="content w-100">
				    <div class="calendar-container">
				      <div class="calendar"> 
				        <div class="year-header"> 
				          <span class="left-button fa fa-chevron-left" id="prev"> </span> 
				          <span class="year" id="label"></span> 
				          <span class="right-button fa fa-chevron-right" id="next"> </span>
				        </div> 
				        <table class="months-table w-100"> 
				          <tbody>
				            <tr class="months-row">
				              <td class="month">Oca</td> 
				              <td class="month">Şub</td> 
				              <td class="month">Mar</td> 
				              <td class="month">Nis</td> 
				              <td class="month">May</td> 
				              <td class="month">Haz</td> 
				              <td class="month">Tem</td>
				              <td class="month">Ağu</td> 
				              <td class="month">Eyl</td> 
				              <td class="month">Eki</td>          
				              <td class="month">Kas</td>
				              <td class="month">Ara</td>
				            </tr>
				          </tbody>
				        </table> 
				        
				        <table class="days-table w-100"> 
				          <td class="day">Pzr</td> 
				          <td class="day">Pzt</td> 
				          <td class="day">Sal</td> 
				          <td class="day">Çar</td> 
				          <td class="day">Per</td> 
				          <td class="day">Cum</td> 
				          <td class="day">Cmt</td>
				        </table> 
				        <div class="frame"> 
				          <table class="dates-table w-100"> 
			              <tbody class="tbody">             
			              </tbody> 
				          </table>
				        </div> 
				      
				      </div>
				    </div>
				    <div class="events-container">
				    </div>
                    <button class="cssbuttons-io" onclick="window.location.href='/lightmain'">
  <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0z"></path><path fill="currentColor" d="M24 12l-5.657 5.657-1.414-1.414L21.172 12l-4.243-4.243 1.414-1.414L24 12zM2.828 12l4.243 4.243-1.414 1.414L0 12l5.657-5.657L7.07 7.757 2.828 12zm6.96 9H7.66l6.552-18h2.128L9.788 21z"></path></svg> Geri Dön</span>
</button>
				  </div>
           
				</div>
                </div>
	</section>

	<script src="../calendar/js/jquery.min.js"></script>
  <script src="../calendar/js/popper.js"></script>
  <script src="../calendar/js/bootstrap.min.js"></script>
  <script>
   (function($) {

"use strict";

// Setup the calendar with the current date
$(document).ready(function(){
    var date = new Date();
    var today = date.getDate();
    // Set click handlers for DOM elements
    $(".right-button").click({date: date}, next_year);
    $(".left-button").click({date: date}, prev_year);
    $(".month").click({date: date}, month_click);
    // Set current month as active
    $(".months-row").children().eq(date.getMonth()).addClass("active-month");
    init_calendar(date);
    var events = check_events(today, date.getMonth()+1, date.getFullYear());
    show_events(events, months[date.getMonth()], today);
});

// Initialize the calendar by appending the HTML dates
function init_calendar(date) {
    $(".tbody").empty();
    $(".events-container").empty();
    var calendar_days = $(".tbody");
    var month = date.getMonth();
    var year = date.getFullYear();
    var day_count = days_in_month(month, year);
    var row = $("<tr class='table-row'></tr>");
    var today = date.getDate();
    // Set date to 1 to find the first day of the month
    date.setDate(1);
    var first_day = date.getDay();
    // 35+firstDay is the number of date elements to be added to the dates table
    // 35 is from (7 days in a week) * (up to 5 rows of dates in a month)
    for(var i=0; i<35+first_day; i++) {
        // Since some of the elements will be blank, 
        // need to calculate actual date from index
        var day = i-first_day+1;
        // If it is a sunday, make a new row
        if(i%7===0) {
            calendar_days.append(row);
            row = $("<tr class='table-row'></tr>");
        }
        // if current index isn't a day in this month, make it blank
        if(i < first_day || day > day_count) {
            var curr_date = $("<td class='table-date nil'>"+"</td>");
            row.append(curr_date);
        }   
        else {
            var curr_date = $("<td class='table-date'>"+day+"</td>");
            var events = check_events(day, month+1, year);
            if(today===day && $(".active-date").length===0) {
                curr_date.addClass("active-date");
                show_events(events, months[month], day);
            }
            // If this date has any events, style it with .event-date
            if(events.length!==0) {
                curr_date.addClass("event-date");
            }
            // Set onClick handler for clicking a date
            curr_date.click({events: events, month: months[month], day:day}, date_click);
            row.append(curr_date);
        }
    }
    // Append the last row and set the current year
    calendar_days.append(row);
    $(".year").text(year);
}

// Get the number of days in a given month/year
function days_in_month(month, year) {
    var monthStart = new Date(year, month, 1);
    var monthEnd = new Date(year, month + 1, 1);
    return (monthEnd - monthStart) / (1000 * 60 * 60 * 24);    
}

// Event handler for when a date is clicked
function date_click(event) {
    $(".events-container").show(250);
    $("#dialog").hide(250);
    $(".active-date").removeClass("active-date");
    $(this).addClass("active-date");
    show_events(event.data.events, event.data.month, event.data.day);
};

// Event handler for when a month is clicked
function month_click(event) {
    $(".events-container").show(250);
    $("#dialog").hide(250);
    var date = event.data.date;
    $(".active-month").removeClass("active-month");
    $(this).addClass("active-month");
    var new_month = $(".month").index(this);
    date.setMonth(new_month);
    init_calendar(date);
}

// Event handler for when the year right-button is clicked
function next_year(event) {
    $("#dialog").hide(250);
    var date = event.data.date;
    var new_year = date.getFullYear()+1;
    $("year").html(new_year);
    date.setFullYear(new_year);
    init_calendar(date);
}

// Event handler for when the year left-button is clicked
function prev_year(event) {
    $("#dialog").hide(250);
    var date = event.data.date;
    var new_year = date.getFullYear()-1;
    $("year").html(new_year);
    date.setFullYear(new_year);
    init_calendar(date);
}

// Display all events of the selected date in card views
function show_events(events, month, day) {
    
    // Clear the dates container
    $(".events-container").empty();
    $(".events-container").show(250);
    console.log(event_data["events"]);
    // If there are no events for this date, notify the user
    if(events.length===0) {
        var event_card = $("<div class='event-card'></div>");
        var event_name = $("<div class='event-name'>"+day+" "+month+"'ta Planlanan Bir Görüsme Bulunmuyor.</div>");
        $(event_card).css({ "border-left": "10px solid #FF1744" });
        $(event_card).append(event_name);
        $(".events-container").append(event_card);
    }
    else {
        // Go through and add each event as a card to the events container
        for(var i=0; i<events.length; i++) {
            var event_card = $("<div class='event-card'></div>");
          
            if(events[i]["status"]==='Kabul Edildi') {
                var event_name = $("<div class='event-name'>"+events[i]["time"]+"</div>");
            var event_count = $("<div class='event-count'>"+events[i]["name"]+" ile Görüntülü Görüşme</div>");
				
				}
                else
                {
                    var event_name = $("<div class='event-name'>"+events[i]["time"]+"</div>");
                    event_count = $("<div class='event-cancelled'>"+events[i]["name"]+" Ödeme Bekleniyor</div>");
                }


            $(event_card).append(event_name).append(event_count);
            $(".events-container").append(event_card);
        }
    }
}

// Checks if a specific date has any events
function check_events(day, month, year) {
    var events = [];
    for(var i=0; i<eventsData2.length; i++) {
        var event = eventsData2[i];
        if(event["day"]===day &&
            event["month"]===month &&
            event["year"]===year) {
                events.push(event);
                }
            }
            return events;
        }
        var eventsData2 = {!! $jsonResponse !!};
    console.log(eventsData2);
    for (var i = 0; i < eventsData2.length; i++) {
    var event = eventsData2[i];
    
    // "date" alanını parçala
    var dateParts = event.date.split('-');
    
    // Ayrı ayrı yıl, ay ve gün değerlerini al
    var year = parseInt(dateParts[0]);
    var month = parseInt(dateParts[1]);
    var day = parseInt(dateParts[2]);

    // eventsData2'nin içindeki olayı güncelle
    eventsData2[i].year = year;
    eventsData2[i].month = month;
    eventsData2[i].day = day;

    // "date" alanını temizle (istediğiniz takdirde)
    delete eventsData2[i].date;
}

console.log(eventsData2);
    
    //
        // Given data for events in JSON format
        var event_data = {
            "events": [
            {
                "occasion": " Repeated Test Event ",
                "invited_count": 120,
                "year": 2020,
                "month": 5,
                "day": 10,
                "cancelled": true
            },
            {
                "occasion": " Repeated Test Event ",
                "invited_count": 120,
                "year": 2020,
                "month": 5,
                "day": 10,
                "cancelled": true
            },
            {
                "occasion": " Repeated Test Event ",
                "invited_count": 120,
                "year": 2020,
                "month": 5,
                "day": 10,
                "cancelled": true
            },
            {
                "occasion": " Repeated Test Event ",
                "invited_count": 120,
                "year": 2020,
                "month": 5,
                "day": 10
            },
            {
                "occasion": " Repeated Test Event ",
                "invited_count": 120,
                "year": 2020,
                "month": 5,
                "day": 10,
                "cancelled": true
            },
            {
                "occasion": " Repeated Test Event ",
                "invited_count": 120,
                "year": 2020,
                "month": 5,
                "day": 10
            },
            {
                "occasion": " Repeated Test Event ",
                "invited_count": 120,
                "year": 2020,
                "month": 5,
                "day": 10,
                "cancelled": true
            },
            {
                "occasion": " Repeated Test Event ",
                "invited_count": 120,
                "year": 2020,
                "month": 5,
                "day": 10
            },
            {
                "occasion": " Repeated Test Event ",
                "invited_count": 120,
                "year": 2020,
                "month": 5,
                "day": 10,
                "cancelled": true
            },
            {
                "occasion": " Repeated Test Event ",
                "invited_count": 120,
                "year": 2020,
                "month": 5,
                "day": 10
            },
            {
                "occasion": " Test Event",
                "invited_count": 120,
                "year": 2020,
                "month": 5,
                "day": 11
            }
            ]
        };

        const months = [ 
            "Ocak", 
            "Şubat", 
            "Mart", 
            "Nisan", 
            "Mayıs", 
            "Haziran", 
            "Temmuz", 
            "Agustos", 
            "Eylül", 
            "Ekim", 
            "Kasım", 
            "Aralık" 
        ];

    })(jQuery);

    </script>

	</body>
</html>


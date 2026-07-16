<x-admin-layout>

<x-slot name="header">

<div class="d-flex justify-content-between align-items-center">

<div>

<h2 class="fw-bold text-white mb-0">

Booking Calendar

</h2>

<p class="text-secondary mb-0">

Sports Facility Booking Schedule

</p>

</div>

</div>

</x-slot>

<link
href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css"
rel="stylesheet">

<style>

.calendar-card{
background:#111827;
border-radius:22px;
padding:30px;
box-shadow:0 20px 45px rgba(0,0,0,.35);
}

.fc{
color:white;
}

.fc-theme-standard td,
.fc-theme-standard th,
.fc-theme-standard .fc-scrollgrid{
border-color:#374151;
}

.fc-toolbar-title{
font-size:28px;
font-weight:700;
color:white;
}

.fc-button{
background:#7C3AED!important;
border:none!important;
}

.fc-button:hover{
background:#6D28D9!important;
}

.fc-daygrid-day{
background:#111827;
}

.fc-day-today{
background:#1E293B!important;
}

.fc-event{
border:none!important;
border-radius:8px;
padding:3px;
cursor:pointer;
font-size:12px;
}

.legend{
display:flex;
gap:20px;
margin-bottom:20px;
flex-wrap:wrap;
}

.legend-item{
display:flex;
align-items:center;
gap:8px;
color:white;
}

.legend-color{
width:18px;
height:18px;
border-radius:5px;
}

</style>

<div class="calendar-card">

<div class="legend">

<div class="legend-item">

<div
class="legend-color"
style="background:#10B981;"></div>

Approved

</div>

<div class="legend-item">

<div
class="legend-color"
style="background:#F59E0B;"></div>

Pending

</div>

<div class="legend-item">

<div
class="legend-color"
style="background:#3B82F6;"></div>

Completed

</div>

<div class="legend-item">

<div
class="legend-color"
style="background:#EF4444;"></div>

Rejected

</div>

<div class="legend-item">

<div
class="legend-color"
style="background:#6B7280;"></div>

Cancelled

</div>

</div>

<div id="calendar"></div>

</div>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

<script>

document.addEventListener("DOMContentLoaded",function(){

let calendarEl=document.getElementById("calendar");

let calendar=new FullCalendar.Calendar(calendarEl,{

initialView:"dayGridMonth",

height:750,

headerToolbar:{

left:"prev,next today",

center:"title",

right:"dayGridMonth,timeGridWeek,timeGridDay"

},

events:"{{ route('calendar.events') }}",

eventClick:function(info){

Swal.fire({

title:info.event.extendedProps.facility,

html:

"<b>Student:</b> "+info.event.extendedProps.student+"<br><br>"+

"<b>Status:</b> "+info.event.extendedProps.status+"<br><br>"+

"<b>Purpose:</b> "+info.event.extendedProps.purpose+"<br><br>"+

"<b>Remarks:</b> "+(info.event.extendedProps.remarks ?? "-"),

background:"#111827",

color:"#ffffff",

confirmButtonColor:"#7C3AED"

});

}

});

calendar.render();

});

</script>

</x-admin-layout>
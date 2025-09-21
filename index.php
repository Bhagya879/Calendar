<?php
// PHP part: set default month/year
$month = date('m'); 
$year = date('Y');
$todayDate = date('l, F j, Y'); // Full date display
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bhagya's Colorful Calendar</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f2f5;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
    }
    .calendar {
      width: 350px;
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.15);
      overflow: hidden;
      text-align: center;
    }
    .calendar-date {
      background: #e0f7fa;
      padding: 10px;
      font-weight: bold;
      color: #00796b;
    }
    .calendar-header {
      background: #4a90e2;
      color: white;
      text-align: center;
      padding: 12px;
      font-size: 20px;
      font-weight: bold;
      position: relative;
    }
    .calendar-header button {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: white;
      font-size: 18px;
      cursor: pointer;
    }
    .prev { left: 10px; }
    .next { right: 10px; }
    .calendar-body {
      padding: 15px;
    }
    .weekdays, .days {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      text-align: center;
    }
    .weekdays div {
      font-weight: bold;
      margin-bottom: 10px;
      color: #555;
    }
    .days div {
      padding: 10px;
      margin: 2px;
      border-radius: 50%;
      transition: background 0.3s;
      cursor: pointer;
    }
    .days div:hover {
      background: #cce5ff;
    }
    .today {
      background: #ff7043;
      color: white;
      font-weight: bold;
    }
    .weekend {
      color: #f44336; /* Red for weekends */
    }
  </style>
</head>
<body>
  <div class="calendar">
    <div class="calendar-date"><?php echo $todayDate; ?></div>
    <div class="calendar-header">
      <button class="prev">&#10094;</button>
      <span id="month-year"></span>
      <button class="next">&#10095;</button>
    </div>
    <div class="calendar-body">
      <div class="weekdays">
        <div>Sun</div>
        <div>Mon</div>
        <div>Tue</div>
        <div>Wed</div>
        <div>Thu</div>
        <div>Fri</div>
        <div>Sat</div>
      </div>
      <div class="days" id="days"></div>
    </div>
  </div>

  <script>
    const monthYear = document.getElementById("month-year");
    const daysContainer = document.getElementById("days");
    const prevBtn = document.querySelector(".prev");
    const nextBtn = document.querySelector(".next");

    let date = new Date(<?php echo $year; ?>, <?php echo $month - 1; ?>);

    function renderCalendar() {
      const year = date.getFullYear();
      const month = date.getMonth();

      monthYear.textContent = date.toLocaleString("default", { month: "long" }) + " " + year;

      const firstDay = new Date(year, month, 1).getDay();
      const lastDate = new Date(year, month + 1, 0).getDate();

      daysContainer.innerHTML = "";

      for (let i = 0; i < firstDay; i++) {
        daysContainer.innerHTML += `<div></div>`;
      }

      for (let i = 1; i <= lastDate; i++) {
        const today = new Date();
        const currentDay = new Date(year, month, i);
        const isToday =
          i === today.getDate() &&
          month === today.getMonth() &&
          year === today.getFullYear();

        const weekend = (currentDay.getDay() === 0 || currentDay.getDay() === 6) ? "weekend" : "";

        daysContainer.innerHTML += `<div class="${isToday ? "today" : ""} ${weekend}">${i}</div>`;
      }
    }

    prevBtn.addEventListener("click", () => {
      date.setMonth(date.getMonth() - 1);
      renderCalendar();
    });

    nextBtn.addEventListener("click", () => {
      date.setMonth(date.getMonth() + 1);
      renderCalendar();
    });

    renderCalendar();
  </script>
</body>
</html>


<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="capstone_project_employee.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  </head>
  <body>
    <div class="container">
      <form class="Manager" action="index.html" method="post">
        <div class="schedule">
          <label for="Schedule"></label>
          <a href=""><input id ="schedule-btn" type="button" name="Request" value="Display Schedule"></a>
          <p>In a quick glance you can see the ongoing and upcoming events and availability of the resource. You can also use it to monitor your own schedule in real-time.</p>
        </div>
        <div class="request">
          <label for="Request"></label>
          <input id="request-btn"  type="button" name="Request" value="Request">
          <p>Making request to change schedule has never been that easy. You can request and get timely response from manager smoothly without any interruption. </p>
        </div>
			<button type="submit" name="logout"><a href="logout.php">Logout</button>
    </div>

    </form>
  </body>
</html>

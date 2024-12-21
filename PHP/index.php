<?php
include('db_config.php');

$query = "SELECT * FROM iit_parking_status ORDER BY timestamp DESC LIMIT 1";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $temperature = $row['temperature'];
    $humidity = $row['humidity'];
    $parking_status_1 = $row['parking_status_1'];
    $parking_status_2 = $row['parking_status_2'];
    $parking_status_3 = $row['parking_status_3'];
    $parking_status_4 = $row['parking_status_4'];
} else {
    $temperature = $humidity = $parking_status_1 = $parking_status_2 = $parking_status_3 = $parking_status_4 = "N/A";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track IIT Guwahati Parking Spot</title>
    <link rel="icon" href="clipart2767277.png" type="image/png">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        header {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #003366;
            color: white;
            padding: 20px 0;
            font-size: 24px;
        }

        header img {
            width: 50px;
            margin-right: 20px;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
            gap: 20px;
        }

        .temhum {
            width: 200px;
            height: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border: 2px solid #ccc;
            border-radius: 8px;
            background-color: #f4f4f4;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-size: 12px;
            font-weight: bold;
            text-align: center;
        }

        .timestamp {
            width: 200px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px solid #ccc;
            border-radius: 8px;
            background-color: #e8e8e8;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-size: 12px;
            font-weight: bold;
            text-align: center;
        }

        .box {
            position: relative;
            width: 200px;
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px solid #ccc;
            border-radius: 8px;
            background-color: #f4f4f4;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-size: 18px;
            font-weight: bold;
            text-align: center;
        }

        .box-label {
            position: absolute;
            top: -20px;
            font-size: 14px;
            font-weight: bold;
            background-color: white;
            padding: 2px 5px;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .map {
            width: 100%;
            max-width: 400px;
            height: 300px;
            border: 2px solid #ccc;
            border-radius: 8px;
        }

        footer {
            text-align: center;
            margin: 20px 0;
            font-size: 14px;
            color: #666;
        }

        @media (max-width: 768px) {
            .box {
                width: 150px;
                height: 80px;
            }

            .map {
                height: 250px;
            }
        }

        @media (max-width: 480px) {
            header {
                font-size: 20px;
                padding: 10px 0;
            }

            .box {
                width: 100px;
                height: 60px;
                font-size: 14px;
            }
        }
    </style>
    <script>
        function updateTime() {
            const timestampElement = document.getElementById("timestamp");
            const now = new Date();
            const timeString = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            timestampElement.textContent = `Time: ${timeString}`;
        }

        setInterval(updateTime, 1000);
        setInterval(function() {
            location.reload();
        }, 5000); // 5000 milliseconds = 5 seconds
    </script>
</head>

<body onload="updateTime()">
    <header>
        <img src="clipart2767277.png" alt="Indian Institute Of Technology Guwahati Logo @clipartmax.com">
        Track IIT Guwahati Parking Spot
    </header>
    <div class="container">
        <div id="timestamp" class="timestamp">Time: --:--:--</div>
        <div class="temhum">
            <div>Temperature: <?php echo $temperature; ?> &#8451; </div>
            
        </div>
        <div class="temhum">
            <div>Humidity: <?php echo $humidity; ?> %</div>
        </div>
    </div>
    <div class="container">
        <div class="box">
            <div class="box-label">Barak</div>
            <div><?php echo $parking_status_1; ?></div>
        </div>
        <div class="box">
            <div class="box-label">Manas </div>
            <div><?php echo $parking_status_2; ?></div>
        </div>
    </div>
    <div class="container">
        <div class="box">
            <div class="box-label">Brahmaputra</div>
            <div><?php echo $parking_status_3; ?></div>
        </div>
        <div class="box">
            <div class="box-label">Kameng</div>
            <div><?php echo $parking_status_4; ?></div>
        </div>
    </div>
    <div class="container">
        <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d57282.50088716505!2d91.62366752167964!3d26.191593199999986!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x375a5b6bf26969f1%3A0xc752809363b33443!2sIndian%20Institute%20of%20Technology%20Guwahati!5e0!3m2!1sen!2sin!4v1734602012622!5m2!1sen!2sin" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <footer>
        &copy; 2024 IIT Guwahati Parking Station | <a href="contact.html">Admin</a>
    </footer>
</body>

</html>

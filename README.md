# Track Parking Spot IIOT IIT Guwahati

Overview The Track Parking Spot project uses four ultrasonic sensors to monitor parking spaces and track their availability. Additionally, the system captures environmental data such as temperature and humidity using a DHT11 sensor. The data is sent to a server and displayed on a dashboard for real-time tracking of parking spot status and environmental conditions.

# Features:
1. Parking Spot Detection:
   - Monitors the availability of four parking spots using ultrasonic sensors.
   - Reports the status as "Available" or "Occupied."
2. Environmental Monitoring:
  -Captures temperature and humidity data using a DHT11 sensor.
3. Real-Time Data Processing:
   - Sends parking and environmental data to a Node.js server.
   - Stores data in a MySQL database.
   - Displays the data on a web-based dashboard.
# Hardware Requirements:
1. ESP8266/ESP32
2. DHT11 Sensor
3. 4xUltrasonic Sensors (e.g., HC-SR04)
4. Jumper Wires
5. Breadboard
6. Power Supply
# Software Requirements:
1. Arduino IDE (to program NodeMCU)
2. Node.js (server-side application)
3. MySQL (database)
4. PHP (for dashboard integration)
5. Web Browser (to view the dashboard)
# System Architecture:
1. ESP8266/ESP32
   - Reads data from the ultrasonic sensors and DHT11.
   - Sends data to the Node.js server via HTTP POST.
2. Node.js Server
   - Receives and processes data from the ESP8266.
   - Stores data in the MySQL database.
3. MySQL Database
   - Stores parking statuses and environmental data.
4.Dashboard
   - Displays real-time parking and environmental data using PHP, HTML, CSS, and JavaScript.
# Hardware Setup:
1. Connect the DHT11 sensor to the ESP8266:
   - VCC -> 3.3V
   - GND -> GND
   - DATA -> D4
2. Connect each ultrasonic sensor to the ESP8266:
   - Trigger Pins: D1, D2, D5, D6
   - Echo Pins: D7, D8, D9, D10
### Hardware view 1

[![hardware_view1](https://github.com/prkshdas/Track-Parking-Spot-IIoT-IIT-Guwahati/blob/main/hardware_view1.jpg)]([link_url](https://github.com))

### Hardware view 2

[![hardware_view2](https://github.com/prkshdas/Track-Parking-Spot-IIoT-IIT-Guwahati/blob/main/hardware_view2.jpg)]([link_url](https://github.com))

# Software Setup:
1. Arduino IDE:
   - install required libraries (e.g., DHT, ESP8266WiFi).
   - Upload esp8266_code.ino to the NodeMCU.
2. Node.js Server:
   - Install dependencies with npm install.
   - Start the server: node server.js.
3. MySQL Database:
   - Create the database using parking_system.sql.
4. Dashboard:
   - Place PHP files (db_config.php, fetch_data.php) in your web server’s directory.
   - Access the dashboard via your browser.
# Website View:
### project_view1

[![project_view1](https://github.com/prkshdas/Track-Parking-Spot-IIOT-IIT-Guwahati/blob/main/project_view1.jpg)]([link_url](https://github.com))

### project_view2

[![project_view2](https://github.com/prkshdas/Track-Parking-Spot-IIOT-IIT-Guwahati/blob/main/project_view2.jpg)]([link_url](https://github.com))

### project_view3

[![project_view3](https://github.com/prkshdas/Track-Parking-Spot-IIOT-IIT-Guwahati/blob/main/project_view3.jpg)]([link_url](https://github.com))

### project_database

[![project_database](https://github.com/prkshdas/Track-Parking-Spot-IIOT-IIT-Guwahati/blob/main/project_database.png)]([link_url](https://github.com))


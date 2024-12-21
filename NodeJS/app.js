const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');

const app = express();
const port = 3000;

app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json()); // To parse JSON data

// MySQL connection
const db = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "parking_system"
});

db.connect((err) => {
  if (err) throw err;
  console.log("Connected to the database!");
});

// Handle data from NodeMCU
app.post('/send-data', (req, res) => {
  const { temperature, humidity, parking_status_1, parking_status_2, parking_status_3, parking_status_4 } = req.body;

  // Ensure all required data is present
  if (!temperature || !humidity || !parking_status_1 || !parking_status_2 || !parking_status_3 || !parking_status_4) {
    return res.status(400).send('Missing data');
  }

  const query = `
    INSERT INTO iit_parking_status 
    (temperature, humidity, parking_status_1, parking_status_2, parking_status_3, parking_status_4) 
    VALUES (?, ?, ?, ?, ?, ?)
  `;

  db.query(query, [temperature, humidity, parking_status_1, parking_status_2, parking_status_3, parking_status_4], (err, result) => {
    if (err) {
      console.error(err);
      return res.status(500).send('Error saving data');
    }
    console.log('Data inserted into database:', { temperature, humidity, parking_status_1, parking_status_2, parking_status_3, parking_status_4 });
    res.status(200).send('Data saved successfully');
  });
});

app.listen(port, () => {
  console.log(`Server running at http://localhost:${port}`);
});

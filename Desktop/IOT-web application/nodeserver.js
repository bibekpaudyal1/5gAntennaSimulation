// Create express app
var express = require("express");
var app = express();
var db1 = require("./database.js");

var HTTP_PORT = 8000;
app.listen(HTTP_PORT, () => {
  console.log("Server running on port %PORT%".replace("%PORT%", HTTP_PORT));
});
app.use(express.json());

app.get("/", (req, res, next) => {
  res.json({ message: "Ok" });
});

app.post("/api/sensorData", (req, res) => {
  const { dataandTime, temperature, humidity } = req.body;
  if (!dataandTime || !temperature || !humidity) {
    return res.status(400).json({ error: "The data is not relievent" });
  }
  const sql =
    "INSERT INTO sensorData (dataandTime, temperature, humidity) VALUES (?, ?, ?)";
  db1.run(sql, [dataandTime, temperature, humidity], function (err) {
    if (err) {
      return res.status(500).json({ error: err.message });
    }
    res.status(201).json({ message: "Data inserted for the sensor data" });
  });
});

app.post("/api/acceleratorMode", (req, res) => {
  const { dataandTime, x, y, z } = req.body;
  if (!dataandTime || !x || !y || !z) {
    return res.status(400).json({ error: "The data is not relievent" });
  }
  const sql = "INSERT INTO acceletorMode(dataandTime,x,y,z) VALUES (?,?,?,?)";
  db1.run(sql, [dateandTime, x, y, z], function (err) {
    if (err) {
      return res.status(500).json({ error: err.message });
    }
    res
      .status(201)
      .json({ message: "data for the accelerator mode are inserted" });
  });
});

//endpoint to see the sensor data
app.get("/api/sensorData", (req, res) => {
  const sql = "SELECT * FROM sensorData";
  db1.all(sql, [], (err, rows) => {
    if (err) {
      return res.status(500).json({ error: err.message });
    }
    res.status(200).json({ data: rows });
  });
});

//end point to acceletor mode
app.get("/api/acceleratorMode", (req, res) => {
  const sql = "SELECT * FROM acceletorMode";
  db1.all(sql, [], (err, rows) => {
    if (err) {
      return res.status(500).json({ error: err.message });
    }
    res.status(200).json({ data: rows });
  });
});

app.use(function (req, res) {
  res.status(404).json({ error: "the data haven't been found " });
});

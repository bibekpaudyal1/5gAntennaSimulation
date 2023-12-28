const express = require("express");
const bodyParser = require("body-parser");
const cors = require("cors");
const db = require("./database");
const telerivet = require("telerivet");

const app = express();
const port = 8000;

app.use(cors());
app.use(bodyParser.json());

const HOST = "localhost";
async function computeWeeklyAverages() {
  try {
    const weekStartDate = new Date();
    weekStartDate.setDate(weekStartDate.getDate() - 7);

    const sql =
      "SELECT AVG(temperature) AS avgTemperature, AVG(humidity) AS avgHumidity FROM sensorData WHERE dataandTime >= ?";
    const result = await db.get(sql, [weekStartDate.toISOString()]);
    const avgTemperature = result.avgTemperature || 0;
    const avgHumidity = result.avgHumidity || 0;

    let message = "";
    if (avgTemperature >= 30 && avgHumidity > 55) {
      message = "Alert: Temperature is high, increase water level by 30%.";
    } else {
      message =
        "Weekly Averages: Temperature " +
        avgTemperature.toFixed(2) +
        ", Humidity " +
        avgHumidity.toFixed(2);
    }
    await sendSMS(message);
  } catch (error) {
    console.error("Error computing weekly averages:", error.message);
  }
}
async function sendSMS(message) {
  try {
    const apiKey = "";
    const projectId = "";
    const phoneNumber = "";

    const tr = new telerivet(apiKey);
    const project = tr.initProjectById(projectId);
    const messageSent = await project.sendMessage({
      to_number: phoneNumber,
      content: message,
    });

    console.log("SMS sent successfully:", messageSent.id);
  } catch (error) {
    console.error("Error sending SMS:", error.message);
  }
}

setInterval(computeWeeklyAverages, 7 * 24 * 60 * 60 * 1000);

app.get("/api/sensorData/logic", (req, res) => {
  const sql = "SELECT * FROM sensorData";
  db.all(sql, [], (err, rows) => {
    if (err) {
      console.error("Error fetching sensor data:", err.message);
      return res
        .status(500)
        .json({ error: "Internal server error while fetching sensor data." });
    }
    res.status(200).json({ data: rows });
  });
});

app.post("/api/sendData", async (req, res) => {
  const { temperature, humidity } = req.body;
  console.log(`Temperature is ${temperature} and humidity is ${humidity}`);

  if (!temperature || !humidity) {
    return res
      .status(400)
      .json({ error: "Temperature and humidity are required." });
  }

  const now = new Date().toISOString();
  const sql =
    "INSERT INTO sensorData (dataandTime, temperature, humidity) VALUES (?, ?, ?)";

  try {
    await db.run(sql, [now, temperature, humidity]);
    res.status(201).json({ message: "Data received and stored successfully." });
  } catch (error) {
    console.error("Error storing data:", error.message);
    res.status(500).json({ error: "Internal server error." });
  }
});

app.listen(port, HOST, () => {
  console.log(`Server is running on port ${port}`);
});

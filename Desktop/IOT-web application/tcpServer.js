const express = require("express");
const bodyParser = require("body-parser");
const cors = require("cors");
const db = require("./database");

const app = express();
const port = 3000;

app.use(cors());
app.use(bodyParser.json());

app.get("/api/sensorData", (req, res) => {
  const query = "SELECT * FROM sensorData";
  db.all(query, [], (err, rows) => {
    if (err) {
      console.error(err.message);
      res.status(500).json({ error: "Internal Server Error" });
    } else {
      res.json(rows);
    }
  });
});

app.listen(port, () => {
  console.log(`API server is running on port ${port}`);
});

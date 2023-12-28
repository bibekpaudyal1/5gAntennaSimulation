const sqlite3 = require("sqlite3").verbose();

const DBSOURCE = "db.sqlite";

let db = new sqlite3.Database(DBSOURCE, (err) => {
  if (err) {
    console.error("Error connecting to the SQLite database:", err.message);
    throw err;
  } else {
    console.log("Connected to the SQLite database.");

    db.run(
      `CREATE TABLE IF NOT EXISTS sensorData (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        dataandTime TEXT,
        temperature REAL,
        humidity REAL
      )`,
      (err) => {
        if (err) {
          console.error("Error creating the sensorData table:", err.message);
        } else {
          console.log("sensorData table is ready.");
        }
      }
    );
  }
});

module.exports = db;

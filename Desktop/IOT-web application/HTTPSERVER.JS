const express = require("express");
const bodyParser = require("body-parser");
const app = express();
app.use(bodyParser.urlencoded({ extended: false }));
app.post("/", (req, res) => {
  let acc_x = req.body.acc_x;
  let acc_y = req.body.acc_y;
  let acc_z = req.body.acc_z;
  console.log(`X: ${acc_x} Y: ${acc_y} Z: ${acc_z}`);
  res.status(200).send("Data received !");
});
const server = app.listen(3000, () => {
  console.log("Server is listenning on port 3000");
});

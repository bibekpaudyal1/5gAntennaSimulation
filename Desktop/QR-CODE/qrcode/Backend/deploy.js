const express = require("express");
const bodyParser = require("body-parser");
const app = express();
const axios = require("axios");
var telerivet = require("telerivet");
const cors = require("cors");

const port = process.env.PORT || 2700;

app.use(
  cors({
    origin: "http://localhost:3000",
  })
);

const API_KEY = "t5_5e_s8wf9PxX1VYfLvH3jQXa3Dq8gxHBjD";
const PROJECT_ID = "PJc05976859cc8e166";
var tr = new telerivet.API(API_KEY);
var project = tr.initProjectById(PROJECT_ID);

app.use(bodyParser.json());

app.post("/contact", async (req, res) => {
  console.log(req.body);
  const { name, email, phone } = req.body;

  try {
    project.getOrCreateContact(
      {
        name: name,
        phone_number: phone,
      },
      function (err, contact) {
        if (err) {
          console.error(err);
        } else {
          console.log(
            "Contact created or updated successfully:",
            contact.name,
            contact.phone_number
          );
          project.sendMessage(
            {
              content: `Thank you ${name}for registering in our system`,
              to_number: phone,
            },
            function (err, message) {
              if (err) {
                console.log(err);
              } else {
                console.log(message);
              }
            }
          );
          res.sendStatus(200);
        }
      }
    );
  } catch (error) {
    console.error(error);
    res.sendStatus(500);
  }
});

app.listen(port, () => {
  console.log("Server started on port 2700");
});

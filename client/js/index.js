import fetch from "node-fetch";
import crypto from "crypto";

let sha = crypto.createHash("sha1");
sha.update(`2022-03-09 17:28:00|ZIDAN|Ad0oNkQWJi7LJBsQoCqV`);

const data = {
  dttm: "2022-03-09 17:28:00",
  vehicle_code: "ZIDAN",
  signature: sha.digest("hex"),
};

fetch("http://emoto-api.bubileg.cz/get-last-log", {
  method: "POST",
  headers: {
    "Content-Type": "application/json",
  },
  body: JSON.stringify(data),
})
  .then((response) => response.json())
  .then((data) => console.log(data));

const request = require("request");

const apiUrl = "https://api.twitch.tv/kraken/games/top"
const clientID = 't8jkx3lx10vohbdwgs8ngatu0s27xx';

request(
  {
    method: "GET",
    url: apiUrl,
    headers: {
      "client-ID": clientID,
      Accept: "application/vnd.twitchtv.v5+json",
    },
  },
  (err, res, body) => {
    if (err) return console.log("抓取失敗");
    const data = JSON.parse(body).top;
    for (const i of data) {
      console.log(i.viewers, i.game.name);
    }
    return true;
  }
);
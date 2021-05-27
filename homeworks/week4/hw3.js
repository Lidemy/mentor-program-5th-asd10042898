const request = require('request');
const name = process.argv[2];
const apiUrl = 'https://restcountries.eu/rest/v2';
//console.log(process.argv) 確認裡面資料有甚麼
if (!name) {
    return console.log("請輸入國家名稱");
  }
request(`${apiUrl}/name/${name}`, function (err, response, body){
  /*const json = JSON.parse(body)//將資料轉為JSON格式並可以了解資料型態為甚麼, 才知道如何取資料
  console.log(json)*/
  if (err) {
    return console.log("抓取失敗", err);
  }
  const data = JSON.parse(body);
  if (data.status === 404) {
    return console.log("找不到國家資訊");
  }

  for (let i = 0; i < data.length; i++) {
    console.log("============");
    console.log("國家：" + data[i].name);
    console.log("首都：" + data[i].capital);
    console.log("貨幣：" + data[i].currencies[0].code);//為何要加 .code?
    console.log("國碼：" + data[i].callingCodes[0]);//看到單字後面加 s 時，代表這資料使用的是陣列型態,所以取資料需要用callingCodes[0]
  }
})
const API_URL = 'https://api.twitch.tv/kraken'
const CLIENT_ID = 't8jkx3lx10vohbdwgs8ngatu0s27xx'
const STREAM_TEMPLATE = `<div class="stream">
            <img src="$preview" />
            <div class="stream__data">
              <div class="stream__avatar">
                <img src="$logo">
              </div>
              <div class="stream__intro">
                <div class="stream__title">$title</div>
                <div class="stream__channel">
                  $name
                </div>
              </div>
            </div>
          </div>`/* 使用 ${} 去抓取資料並放入 */

getGames((games) => { /* 只拿遊戲資料, 並且因為非同步所以只能使用callback fuction */
  for (const game of games/* 這是用來把 games 陣列每個元素印出來並取名為 game 的方法, 這文法老師說要再自己去查怎麼用 */) {
    const element = document.createElement('li')/* 要在 ul 裡面放入我們找到的遊戲名稱, 並用 li 的標籤 */
    element.innerText = game.game.name/* 一樣看取的資料在哪邊才能知道要打甚麼明稱 */
    document.querySelector('.navbar__nav').appendChild(element)
  }

  changeGame(games[0].game.name)
  /* (原本這樣然後改成 changeGame(games[0].game.name))// 顯示第一個遊戲的實況並更改標題的遊戲名稱
      document.querySelector('h1').innerText = games[0].game.name

      // 抓取第一個遊戲的實況內容
      getStreams(games[0].game.name) */
})

// 因為我們上面的資料是動態新增, 所以使用事件代理的方法是最好的
document.querySelector('.navbar__nav').addEventListener('click', (e) => {
  // 使用 console.log(e.target) 去看我們點到的東西是甚麼才能知道要怎麼做
  if (e.target.tagName.toLowerCase() === 'li') /* tagName 是去看點到的東西是甚麼, 但因為通常抓出來的都是大寫, 所以要使用 toLowerCase() 轉成小寫 */{
    const gameName = e.target.innerText
    changeGame(gameName)
  }
})

function changeGame(gameName) {
  document.querySelector('h1').innerText = gameName
  document.querySelector('.streams').innerHTML = ''// 這是為了換遊戲時要先清空原本的資料, 才能再抓取新的
  // 這裡的 request2 不需要改名是因為他跟上面的 request2 不再同一個 function 內, 所以不會互相影響
  getStreams(gameName, (streams) => {
    for (const stream of streams) {
      appendStream(stream)
    }
  })
}

function appendStream(stream) {
  const element = document.createElement('div')
  document.querySelector('.streams').appendChild(element)
  element.outerHTML = STREAM_TEMPLATE
    .replace('$preview', stream.preview.large)
    .replace('$logo', stream.channel.logo)
    .replace('$title', stream.channel.status)
    .replace('$name', stream.channel.name)
    /* 這個 element.outerHTML 是把那些資料放在一起, 並使用 document.querySelector('.streams').appendChild(element); 放入我們要的地方 */
    /* .replace 的意思是把前面的文字替換成後面的東西, 這種寫法可以把介面跟資料分開提取, 要修程式比較方便 */
}

function getGames(callback) {
  const request = new XMLHttpRequest()/* 去拿 API */
  request.open('GET', `${API_URL}/games/top?limit=5`, true)/* 抓前五個的遊戲, 並設定 true 非同步 */
  request.setRequestHeader('Client-ID', CLIENT_ID)
  request.setRequestHeader('Accept', 'application/vnd.twitchtv.v5+json')/* 兩個 request.setRequestHeader 是 twitch 要求要設定的 header */
  request.onload = function() {
    if (request.status >= 200 && request.status < 400) {
      // console.log(request.response) 確認是否有拿到資料
      const games = JSON.parse(request.response).top/* 因為一開始拿到的資料是文字, 所以要用 JSON.parse 轉成 JSON 格式, 後面的 top 是從管理台看要取的資料是甚麼才知道打甚麼 */
      // console.log(games) 看要的資料名稱是甚麼
      callback(games)
    }
  }
  request.send()
}

function getStreams(gameName, callback) {
  const request2 = new XMLHttpRequest()// 每次發一個新的 request 都要設定一次 new XMLHttpRequest()
  request2.open('GET', `${API_URL}/streams?game=${encodeURIComponent(gameName)}`, true)/* 抓選擇的遊戲 gameName, 並設定 true 非同步, encodeURIComponent() 會將字串轉換成 UTF-8 編碼 */
  request2.setRequestHeader('Client-ID', CLIENT_ID)
  request2.setRequestHeader('Accept', 'application/vnd.twitchtv.v5+json')/* 兩個 request.setRequestHeader 是 twitch 要求要設定的 header */
  request2.onload = function() {
    if (request2.status >= 200 && request2.status < 400) {
      const data = JSON.parse(request2.response).streams
      callback(data)
    }
  }
  request2.send()
}

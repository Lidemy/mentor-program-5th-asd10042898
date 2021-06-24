const apiUrl = 'https://dvwhnbka7d.execute-api.us-east-1.amazonaws.com/default/lottery'
const errorMessage = '系統不穩定，請再試一次'

/* 抽獎 function */
/* 第一個 function 主要是去拿取 API 資料, 如果當中有錯誤的話, 會回傳 err, 完全沒錯誤的話,
會在第 381 行的 data 回傳要的資料 */
function getPrize(cb) {
  const xhr = new XMLHttpRequest()
  xhr.open('GET', apiUrl, true)/* 這個 true 是指設成非同步 */
  xhr.onload = function() {
    if (xhr.status >= 200 && xhr.status < 400) {
      let data
      try {
        data = JSON.parse(xhr.response)
      } catch (err) {
        cb(errorMessage)
        return
      }

      if (!data.prize) {
        cb(errorMessage)
        return
      }

      cb(null, data)
    }
  }
  xhr.onerror = function() {
    alert(errorMessage)
  }
  xhr.send()/* 記得把 request 送出 */
}

/* 這 function 主要是做拿完 API 之後顯示的事情 */
document.querySelector('.lottery-info__btn').addEventListener('click', () => {
  getPrize((err, data) =>/* 這行 function 是去 call 上面的 function 去拿 API */ {
    if (err) {
      alert(err)
      return
    }

    const prizes = { /* 因為模式固定, 老師把他變成類似設定檔的方式, 用"物件"去儲存資料 */
      First: {
        className: 'first-prize',
        title: '恭喜你中頭獎了！日本東京來回雙人遊！'
      },
      SECOND: {
        className: 'second-prize',
        title: '二獎！90 吋電視一台！'
      },
      THIRD: {
        className: 'third-prize',
        title: '恭喜你抽中三獎：知名 YouTuber 簽名握手會入場券一張，bang！'
      },
      NONE: {
        className: 'none-prize',
        title: '銘謝惠顧'
      }
    }

    // const className= prizes[data.prize].className
    // const title = prizes[data.prize].title
    const { className, title } = prizes[data.prize]/* 老師是運用解構手法來取得要得檔案, 前面兩行是原本的方式 */
    document.querySelector('.section-lottery').classList.add(className)
    document.querySelector('.lottery-result__title').innerText = title
    document.querySelector('.lottery-info').classList.add('hide')
    document.querySelector('.lottery-result').classList.remove('hide')
  })
})

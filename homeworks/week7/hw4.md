## 什麼是 DOM？

　　DOM（Document Object Model）文件物件模型，他是一種與瀏覽器、平台、語言的接口，讓我們可以訪問頁面的其他標準組件；是給 HTML 跟 XML 文件使用的 API，他提供了文件的結構表述，讓我們可以更動在頁面上看到物件的架構、風格和內容的方法 ，其本質就是建立網頁與程式語言溝通的橋樑。

## 事件傳遞機制的順序是什麼；什麼是冒泡，什麼又是捕獲？

照著老師補充影片跟網路上查找的資料，事件傳遞順序的機制，以我們擁有三個物件 outer、inner 跟 box 當舉例：

<img src="./pic3.png">

　　當我們點選我們的 target （box）時，這個點擊事件會一路從 window 開始往下傳，先經過 outer、inner，最後到 box，這個過程就是 Capture Phase 捕獲階段；接著事件傳到 box 本身，這個階段叫做 At Target；最後事件會從 box 一路回傳經過 inner、outer，最後到 window，這個過程就是 Bubble Phase 冒泡階段。

## 什麼是 event delegation，為什麼我們需要它？

　　Event delegation 指的是：假設同時有很多 DOM element 都有相同的 event handler（處理函式），與其在每個 DOM element 上個別附加 event handler，不如利用 event bubbling 的特性，統一在他們的父元素的 event handler 處理；這樣就不需要在每次需要新增同樣功能的物件時，還要再綁一次相同事件，可以大大省去程式的冗長程度，在做增減相同功能物件時也會方便許多。

參考資料：[網址] : https://ithelp.ithome.com.tw/articles/10120565 "Optional Title Here"


## event.preventDefault() 跟 event.stopPropagation() 差在哪裡，可以舉個範例嗎？

　　event.preventDefault() 就是取消事件繼續往下傳遞，event.stopPropagation() 則是取消瀏覽器的預設行為。

　　event.preventDefault() 最常見的做法就是阻止超連結，當點擊超連結的時候，就不會執行原本預設的行為（新開分頁或是跳轉），這就是 event.preventDefault() 的作用，但跟 JavaScript 的事件傳遞「一點關係都沒有」，一旦 call 了 event.preventDefault，在之後傳遞下去的事件裡面也會有效果。

　　event.stopPropagation() 就是你加在哪邊，事件的傳遞就斷在哪裡，不會繼續往下傳遞。因為事件的傳遞被停止，所以剩下的 listener 都不會再收到任何事件，意思是說不會再把事件傳遞給「下一個節點」，但若是你在同一個節點上有不只一個 listener，還是會被執行到，對於同一個層級，剩下的 listener 還是會被執行，若是想要讓其他同一層級的 listener 也不要被執行，可以改用 event.stopImmediatePropagation()。

<img src="./pic3.png">

　　以老師圖片舉例的話，如果我們要點擊到 Target（box），並在 outer 跟 box 上放上 click 事件，若是在左邊捕獲階段的 outer 放上 event.preventDefault() 的話，則 outer 跟 box 的 click 事件都不會觸發；但如果放的是 event.stopPropagation() 則會只阻止 outer 的 click 並不會阻止 box 的 click。

參考資料：[網址] : https://blog.techbridge.cc/2017/07/15/javascript-event-propagation/ "Optional Title Here"
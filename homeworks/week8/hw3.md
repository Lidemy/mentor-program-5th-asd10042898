## 什麼是 Ajax？

　　Ajax 是 Asynchronous JavaScript and XML 的縮寫，指的是一套綜合了多項技術的瀏覽器端網頁開發技術。

* Asynchronous：非同步
* JavaScript：使用的程式語言
* XML：Client 與 Server 交換資料用的資料與方法，近年由於 JSON 等格式的流行，使用 Ajax 處理的資料並不限於 XML

　　當我們在串接第三方 API 時，由於要等待遠端伺服器回應，等待的時候有可能會大幅影響到使用者的體驗，因此「非同步請求」變得更加重要；如果使用非同步請求的話，在客戶端 (client) 對伺服器端 (server) 送出 request 之後，不需要等待結果，仍可以持續處理其他事情，甚至繼續送出其他 request。Responese 傳回之後，就被融合進當下頁面或應用中。

　　Ajax 不是指一種單一的技術，而是有機地利用了一系列相關的技術。雖然其名稱包含XML，但實際上資料格式可以由JSON代替以進一步減少資料量。

Ajax 可以幫助我們實現非同步的狀況，讓使用者有更好的使用體驗。

## 用 Ajax 與我們用表單送出資料的差別在哪？

　　<font color=#FF0000>Form</font> 比較適合在提交併重新整理當前頁面，或者提交後跳轉到其他頁面的狀況使用；<font color=#FF0000>Ajax</font> 比較適合在提交資料並展示後臺返回的處理資訊的狀況，在函式中對返回的資訊做一些需要的操作處理，通過js對使用者輸入做取出操作，通過引數傳遞給後臺處理；根據不同的情況選擇不同的處理方式，一般 <font color=#FF0000>Form</font> 提交處理的方式比較多的使用，<font color=#FF0000>Ajax</font> 更多的使用在動態載入更多元素。

　　<font color=#FF0000>Form</font> 和 <font color=#FF0000>Ajax</font> 使用的最大區別是：<font color=#FF0000>Form</font> 需要重新整理頁面，而 <font color=#FF0000>Ajax</font> 可以在不重新整理頁面的情況下執行資料請求或者提交資料等操作，如果需要在 <font color=#FF0000>Ajax</font> 提交成功後重新整理頁面，可以呼叫 window 物件的 location 屬性的 load() 方法重新載入當前文件。

比較：

（1）<font color=#FF0000>Ajax</font> 在提交、請求、接收時，都是<font color=#FF0000>不同步</font>進行，網頁不需要刷新，只刷新頁面局部，不影響頁面其他部分的內容。

<font color=#FF0000>Form</font> 提交則是新建一個頁面，為了維持頁面用戶對表單的狀態改變，要在控制器和模板之間傳遞更多參數以保持頁面狀態。

（2）<font color=#FF0000>Ajax</font> 提交時，是在後台新建一個請求。

<font color=#FF0000>Form</font> 卻是放棄本頁面，然後再請求。

（3）<font color=#FF0000>Ajax</font> 必須要用 <font color=#FF0000>JS</font> 來實現，存在調試麻煩、瀏覽器兼容問題，而且不啟用js的瀏覽器，無法完成操作。

<font color=#FF0000>Form</font> 表單是瀏覽器自帶的，無論是否開啟js，都可以提交表單。

（4）<font color=#FF0000>Ajax</font> 在提交、請求、接收時，整個過程都需要使用程式來對其進行數據處理。

<font color=#FF0000>Form</font> 表單提交，是根據表單結構自動完成，不需要代碼干預，用 submit 提交。

## JSONP 是什麼？

　　JSONP（JSON with Padding）是資料格式 JSON 的一種「使用模式」，可以讓網頁從<font color=#FF0000>別的網域</font>取得資料。

由於同源策略，一般來說位於 server1.example.com 的網頁無法與 server2.example.com 的伺服器溝通，而[HTML](https://zh.wikipedia.org/wiki/HTML)的 [``](https://zh.wikipedia.org/wiki/HTML元素#script_tag)元素是一個例外。利用  [``](https://zh.wikipedia.org/wiki/HTML元素#script_tag)元素的這個開放策略，網頁可以得到從其他來源動態產生的 JSON 資料，而這種使用模式就是所謂的 JSONP。

　　還有使用 src 指向的路徑，提到 src，就是`<script>`，JSONP就是利用「同源策略」的這一漏洞來進行的。（其實有`src`屬性的不止有`<script>`,還有`<img>`和`<iframe>`，而`<iframe>`也是能夠運用 JSONP 的）。

　　用 JSONP 抓到的資料並不是 JSON，而是任意的 JavaScript，用 JavaScript 直譯器執行而不是用 JSON 解析器解析。

## 要如何存取跨網域的 API？

　　利用跨來源資源共用（Cross-Origin Resource Sharing，CORS）會透過在 Response header 的 Access-Control-Allow-Origin 來限制誰可以存取資源。如果 Access-Control-Allow-Origin: * 就代表允許任何網域跨站存取資源。

　　當使用者代理請求一個不是目前文件來源——例如來自於不同網域（domain）、通訊協定（protocol）或通訊埠（port）的資源時，會建立一個跨來源 HTTP 請求（cross-origin HTTP request）。

## 為什麼我們在第四週時沒碰到跨網域的問題，這週卻碰到了？

　　因為第四週是藉由 Node.js 透過作業系統向 server 發送請求，而第八週則是透過瀏覽器向 server 發送請求。

　　而通常瀏覽器會為了安全性考量，對於 request 審核有所限制，而當中的同源政策規範了不同源的網域的互動關係，同源政策是指兩份網頁具備相同協定、埠號以及主機位置。只要不符合上述所規範，若想要存取資訊，就會碰到跨網域的問題。

　　而這次的作業我們想要從 TWITCH 的網站獲取資料，就是因為這樣的關係，所以需要透過設定跨來源資源共用（Cross-Origin Resource Sharing，CORS）在 Response header 的 Access-Control-Allow-Origin，來設定成可以獲得資料。
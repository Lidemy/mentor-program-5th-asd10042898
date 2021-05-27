## 請以自己的話解釋 API 是什麼

* API 的全名是 Appication Programming Interface ，用中文來說就是應用程式介面，可以把他當作應用程式之間溝通的橋樑。以老師舉的例子跟網路上的例子來看，API 就像餐廳中的服務生或拉麵店的點餐機，可以把我們的請求(菜單)傳達給廚房，廚房再經由服務生傳回我們要的回應(食物)。

## 請找出三個課程沒教的 HTTP status code 並簡單介紹

1. 201 Created

   請求已經被實現，而且有一個新的資源已經依據請求的需要而建立，且其[URI](https://zh.wikipedia.org/wiki/URI)已經隨Location頭資訊返回。假如需要的資源無法及時建立的話，應當返回'[202 Accepted](https://zh.wikipedia.org/wiki/HTTP状态码#202)'。

2. 408 Request Timeout

   請求逾時。根據HTTP規範，客戶端沒有在伺服器預備等待的時間內完成一個請求的傳送，客戶端可以隨時再次提交這一請求而無需進行任何更改。

3. 409 Conflict

   表示因為請求存在衝突無法處理該請求，例如多個同步更新之間的[編輯衝突](https://zh.wikipedia.org/w/index.php?title=编辑冲突&action=edit&redlink=1)。

## 假設你現在是個餐廳平台，需要提供 API 給別人串接並提供基本的 CRUD 功能，包括：回傳所有餐廳資料、回傳單一餐廳資料、刪除餐廳、新增餐廳、更改餐廳，你的 API 會長什麼樣子？請提供一份 API 文件。

內容包含 API 的 url 、 API 的作用 、 使用的 HTTP method 、 header 欄位 、 request body 、response body 等等資訊



Base URL: https://asd10042898.com



說明                               |Method        |path                        |參數                                          |範例        

-------------------------------|:----------------:|:-------------------------:|:---------------------------------------:|-------------------------------------

獲取所有餐廳資料        |GET               |/restaurant            |_limit:限制回傳資料數量          |/restaurants_?limit=5

獲取單一餐廳資料        |GET               |/restaurants/:id     |無                                             |/restaurant/10

新增餐廳                       |POST             |/restaurants          |name: 店名                              |無

刪除餐廳                       |DELETE         |/restaurants/:id     |無                                             |無

更改餐廳資訊               |PATCH          |/restaurants/:id     |name: 店名                             |無



* 回傳所有餐廳資料

  ![1](C:\Users\煜翔\Desktop\1.PNG)

* 回傳單一餐廳資料

  ![2](C:\Users\煜翔\Desktop\2.PNG)

* 增新餐廳

  ![3](C:\Users\煜翔\Desktop\3.PNG)

* 刪除餐廳

  ![4](C:\Users\煜翔\Desktop\4.PNG)

* 更改餐廳資訊

  ![5](C:\Users\煜翔\Desktop\5.PNG)
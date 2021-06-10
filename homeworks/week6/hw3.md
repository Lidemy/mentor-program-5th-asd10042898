## 請找出三個課程裡面沒提到的 HTML 標籤並一一說明作用。

1. <abbr></abbr>（縮寫，縮寫詞）表示一個縮寫詞或者字母縮寫詞
2. <cite></cite> （vt：引用；）定義作品的標題
3. <del></del> 定義文字中已經刪除的部分。樣式是帶有刪除線的文字。

## 請問什麼是盒模型（box modal）

所有 HTML 元素可以看作盒子，在 CSS 中，盒模型（Box Model）是用來設計和布局使用，Box Model 包含了元素內容（content）、內邊距（padding）、邊框（border）、外邊距（margin）。

![图1.盒模型示意图](https://segmentfault.com/img/remote/1460000013069519)

## 請問 display: inline, block 跟 inline-block 的差別是什麼？

dispaly 屬性基本上可分為兩種顯示模式，一種是行內元素（inline），另一種為區塊元素（block）。

* inline ： 無法調整寬高，元素的寬高是依據內容決定，上下邊距沒用，只有左右會變。
* block ： 元素寬高預設會撐到最大，使其占滿整個容器。
* inline-block ： 對外像 inline 可並排，對內像 block 可調各種屬性。

## 請問 position: static, relative, absolute 跟 fixed 的差別是什麼？

* static ： 不會特別被定位在頁面上特定位置，而是照著瀏覽器預設的配置自動排版在頁面上。
* relative ： 在一個設定為 position: relative 的元素內設定 top 、 right 、 bottom 和 left 屬性，會使其元素「相對地」調整其原本該出現的所在位置，而不管這些「相對定位」過的元素如何在頁面上移動位置或增加了多少空間，都不會影響到原本其他元素所在的位置。
* fixed ： viewport，相對於瀏覽器做定位，即便頁面捲動，它還是會固定在相同的位置。和 relative 一樣，會使用 top 、 right 、 bottom 和 left 屬性來定位。
* absolute ： 某個參考點做定位，往上找不是 static 做定位。


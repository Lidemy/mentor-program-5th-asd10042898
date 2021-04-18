## 交作業流程

初步步驟

1. 設定 GitHub repo ，開啟 github classroom 按下 accept this assignment，點下連接 lidemy/mentor-program-5th-asd10042898。
2. 在 GitHub 網站裡點選 Code，複製自己的連結，在 Git Bash 中輸入 git clone https://github.com/Lidemy/mentor-program-5th-asd10042898.git。
3. 輸入 ls 查看存放位置。
4. 輸入 cd mentor-prgram-5th-asd10042898。

 

固定步驟

1. 先 cd 至自己的交作業倉庫。
2. 將作業內容打入 Markdown 檔案中。
3. 看自己更改的內容 ： git status。
4. 新開一個 branch ： git branch week1-hw1。
5. 切換到新 branch ： git checkout week1-hw1（4.5 步驟可以用 ： git checkout -b week1-hw1）。
6. 將檔案 add 進去 ： git commit -am ‘finished hw1’。
7. 將檔案推至遠端 GitHub ： git push original week1-hw1。
8. 到 GitHub 介面點選 pull requests。
9. 再點選 Compare & Pull requests 讓新的 branch 與原本的 master 合併。
10. 點選 Create pull request，並自我檢測完作業。
11. 複製作業網址，再到 Lidemy 繳交作業的地方貼上 PR。
12. 等助教改完作業。
13. 輸入 git checkout master，回到master位置。
14. 輸入 git pull origin master 讓遠端 master 與本地的同步。
15. 輸入 git branch -d “week1” 刪除本地的 branch。
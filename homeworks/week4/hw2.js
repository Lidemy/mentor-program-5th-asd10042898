/* eslint-disable import/no-unresolved */
const request = require('request')

const action = process.argv[2]
const apiUrl = 'https://lidemy-book-store.herokuapp.com'

switch (action) {
  case 'list':
    listBooks()
    break
  case 'read':
    readBooks(process.argv[3])
    break
  case 'delete':
    deleteBooks(process.argv[3])
    break
  case 'update':
    updateBooks(process.argv[3], process.argv[4])
    break
  case 'create':
    createBooks(process.argv[3])
    break
  default:
    console.log('unknown action')
}

function listBooks() {
  request(`${apiUrl}/books?_limit=20`, (err, response, body) => {
    if (err) {
      console.log('err', err)// 判別資料是否正確
      return
    }

    let books
    try {
      books = JSON.parse(body)// 判別是否為json格式
    } catch (err) {
      console.log(err)
      return
    }
    for (let i = 0; i < books.length; i++) {
      console.log(`${books[i].id} ${books[i].name}`)
    }
  })
}

function readBooks(id) {
  request(`${apiUrl}/books/${id}`, (err, response, body) => {
    if (err) {
      console.log('err', err)// 判別資料是否正確
      return
    }

    let book
    try {
      book = JSON.parse(body)// 判別是否為json格式
    } catch (err) {
      console.log(err)
      return
    }
    console.log(book)
  })
}

function deleteBooks(id) {
  request.delete(`${apiUrl}/books/${id}`, (err, response, body) => {
    if (err) {
      console.log('err', err)// 判別資料是否正確
      return
    }

    let book
    try {
      /* eslint-disable no-unused-vars */
      book = JSON.parse(body)// 判別是否為json格式
    } catch (err) {
      console.log(err)
      return
    }
    console.log('刪除成功')
  })
}

function createBooks(name) {
  request.post({
    url: `${apiUrl}/books`,
    form: {
      name
    }
  }, (err) => {
    if (err) {
      return console.log('新增失敗', err)
    }
    console.log('新增成功')
  })
}

function updateBooks(id, name) {
  request.patch({
    url: `${apiUrl}/books/${id}`,
    form: {
      name/* 這邊參考其他人的解法時, 發現有人會使用 newName, 但發現這樣會直接讓那本書後面多一個 newName 的 id, 應該用 name 才會讓原本 id更改 */
    }
  }, (err) => {
    if (err) {
      return console.log('更新失敗', err)
    }
    console.log('更新成功')
  })
}

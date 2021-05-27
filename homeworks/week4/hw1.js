const request = require('request');

request('https://lidemy-book-store.herokuapp.com/books?_limit=10', function (err, response, body) {
  //console.log(typeof body)可以查看資料是甚麼型態
  if(err){
    console.log('err', err)//判別資料是否正確
    return
  }

  let books
  try{
    books = JSON.parse(body)//判別是否為json格式
  }catch(err){
    console.log(err)
    return
  }
  
  for(i=0; i<books.length; i++){
    console.log(books[i].id + ' ' + books[i].name)
  }

});

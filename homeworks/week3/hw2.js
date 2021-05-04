var readline = require('readline');

var lines = []
var rl = readline.createInterface({
  input: process.stdin
});

rl.on('line', function (line) {
  lines.push(line)
});

rl.on('close', function() {
  solve(lines)
})

function solve(lines){
  // 5 200 =>['5', '200']
  let temp = lines[0].split(' ')
  let n = Number(temp[0])
  let m = Number(temp[1])
  for(let i=n; i<=m; i++){
    if(isNarcissistic(i)){
      console. log(i)
    }
  }
}

function isNarcissistic(n){
  //幾位數
  let digits = digitsCount(n)
  let sum = 0
  let m = n
  while(m != 0){
    let num = m % 10
    sum += num**digits
    m = Math.floor(m / 10)
  }
  if (sum === n){
    return true
  }else{
    return false
  }
}

//回傳數字幾位數
function digitsCount(n){
  let count = 0
  while(n != 0){
    n = Math.floor(n / 10)
    count++
  }
  return count
}




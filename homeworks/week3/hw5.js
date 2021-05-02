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
  let n = Number(lines[0])
  for(let i=1; i<=n; i++){
    let [a, b, k] = lines[i].split(' ')
    console.log(lagerOrSmaller(a, b, k))
  }
}



function lagerOrSmaller(a, b, k){
  if(a === b){
    return 'DRAW'
  }
  if(k == -1){
    let temp = b
    b = a
    a = temp
  }
  const lengthA = a.length
  const lengthB = b.length

  if(lengthA !== lengthB){
    return lengthA > lengthB ? 'A' : 'B'
  }
  return a > b ? 'A' : 'B'
}

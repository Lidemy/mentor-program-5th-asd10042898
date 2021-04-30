function join(arr, concatStr) {
	var a = ''
	for(var i=0; i<arr.length-1; i++){
		a = a + arr[i] + concatStr
	}
	a = a + arr[arr.length-1]
	return a
}

function repeat(str, times) {
	var a = ''
	for(var i=1; i<=times; i++){
		a = a + str
	}
	return a
}

console.log(join(['a', 'b'], '!'));
console.log(repeat('a', 5));

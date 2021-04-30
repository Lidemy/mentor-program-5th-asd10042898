function reverse(str) {
	var newstr = []
	var a = str.length
	for(var i=0; i<=str.length; i++){
		newstr[i] = str[i+a-2*(i)]
	}
	newstr = newstr.join('')
	console.log(newstr)
}

reverse('hello');
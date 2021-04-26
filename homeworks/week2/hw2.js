function capitalize(str) {
	if(str[0]>='a' && str[0]<='z'){
		var firstWord = str[0].toUpperCase()
	str = str.replace(str[0], firstWord)
	return str
    }
	return str
}

console.log(capitalize(',hello'))

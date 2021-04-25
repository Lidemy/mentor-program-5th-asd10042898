function capitalize(str) {
	if(str[0]>='a' && str[0]<='z'){
		var a = str[0].toUpperCase()
	str = str.replace(str[0], a)
	return str
    }else{
    	return str
    }
	
}

console.log(capitalize(',hello'))

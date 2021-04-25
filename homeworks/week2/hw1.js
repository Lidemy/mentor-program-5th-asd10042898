function printStars(n) {
		if(1<=n && n<=30){
			for(var i=1; i<=n; i++){
			console.log('*')
		}
	}else{
		console.log('超出範圍')
	}
}

printStars(31)
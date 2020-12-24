let percent = document.querySelector("#percent");
let dec = document.querySelector("#dec");
let indicator = document.querySelector("#indicator");
let Incr = document.querySelector("#incr");
let num = 0;

/*set default percentage to num*/ 
if (percent.innerHTML === ''){
		percent.innerHTML = num;
}

function IncDec(fval){

	/*	function call on increase button click	*/
	if (fval === 'inc')
	{
		
		if (percent.innerHTML === "100"){
			Incr.setAttribute("disabled", "disabled");	
			Incr.style.background = "#7f7f7f";		
		} else{
			num = num + 10;
			percent.innerHTML = num;
			dec.removeAttribute("disabled", "disabled");
			dec.style.background = "#000";		
		}

		indicator.style.width = `${num}%`;

	} else if (fval === 'dec'){ 

		/*	function call on increase button click	*/
		if (percent.innerHTML === "0"){
			dec.setAttribute("disabled", "disabled");
			dec.style.background = "#7f7f7f";			
		} else{
			num = num - 10;
			percent.innerHTML = num;
			Incr.removeAttribute("disabled", "disabled");
			Incr.style.background = "#000";		
		}

		indicator.style.width = `${num}%`;		
	
	}

}

// Rating box js script
let ratingIndicator = document.querySelector("#rating-indicator");
let ratingPercent = document.querySelector("#rating-percent");
let uFeed = document.querySelector("#uFeed"); 
let feedBtn = document.querySelector("#feedBtn");
let ratings = [];

if (ratingPercent.innerHTML === ''){
		ratingPercent.innerHTML = 0;
}

function addToFeed() {
	// adding elements to array ratings
	ratings.push(+(uFeed.value)); //type conversion to integer
	console.log(ratings);	

	// return sum of array elements
	const sum = (x, y) => x + y;

	// Deriving Percentage

	const sumResult = ratings.reduce(sum);

	const nol = ratings.length*10;

	const sbn = sumResult/nol;

	const percentage = sbn*100;
	/*const exactPercentage = percentage.toPrecision(3);*/
	const exactPercentage = percentage<100?percentage.toPrecision(2):percentage.toPrecision(3);

	ratingPercent.innerHTML = exactPercentage;
	ratingIndicator.style.width = `${exactPercentage}%`;	
}

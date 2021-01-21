var lis = document.querySelectorAll("li");

//Append "Close" text to all todos
var i;
for (i = 0; i < lis.length; i++) {
	
	var span1 = document.createElement("SPAN");
	var spanText1 = document.createTextNode("Close");
	span1.className = "close";	
	span1.appendChild(spanText1);
	lis[i].appendChild(span1);

	var span2 = document.createElement("SPAN");
	var spanText2 = document.createTextNode("Done");
	span2.className = "done";
	span2.appendChild(spanText2);
	lis[i].appendChild(span2);
}

//Remove todo from list
var close = document.getElementsByClassName("close");
var i;
for (i = 0; i < close.length; i++) {
	
	close[i].onclick = function () {

		this.parentElement.classList.add("liTransaction");

	}
}

//Mark todo as done from list
var done = document.getElementsByClassName("done");
var i;
for (i = 0; i < close.length; i++) {
	
	done[i].onclick = function () {
	
		this.innerHTML === "Done"?this.innerHTML = "Undo":this.innerHTML = "Done";
	
		this.parentElement.classList.toggle("mark");		
	}
}


function add_to_todo(){
	var ul = document.querySelector("ul");
	var inputValue = document.querySelector("#inputValue");
	
	var li = document.createElement("li");
	var inputs = document.createTextNode(inputValue.value);
	li.appendChild(inputs);
	if (inputValue === '') {
		alert("You must write something!");
	} else {
		ul.appendChild(li);
	}

	inputValue.value = "";

	var span1 = document.createElement("SPAN");
	var spanText1 = document.createTextNode("Close");
	span1.classList.add("close");	
	span1.appendChild(spanText1);
	li.appendChild(span1);

	var span2 = document.createElement("SPAN");
	var spanText2 = document.createTextNode("Done");
	span2.classList.add("done");
	span2.appendChild(spanText2);
	li.appendChild(span2);

	for (i = 0; i <= close.length; i++) {

		close[i].onclick = function () {
			this.parentElement.classList.add("liTransaction");
		}

		done[i].onclick = function () {
			this.innerHTML === "Done"?this.innerHTML = "Undo":this.innerHTML = "Done";
			this.parentElement.classList.toggle("mark");
		}

	}
	
}


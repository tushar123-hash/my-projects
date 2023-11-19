
// On scroll perform gallery block animation

window.onscroll = function() {scrollFunction()};

function scrollFunction() 
{
  if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) 
  {

    document.querySelector("#check-availability").style.left = "1%";
    document.querySelector("#gallery").classList.add("change-position");
  } 
  else {
	document.querySelector("#check-availability").style.left = "30%";
  	document.querySelector("#gallery").classList.remove("change-position");
  }
}


// Swap log in to sign up form

function swapForm() {

const formType = document.querySelector("#form-type");
const msg = document.querySelector("#msg");
const logIn = document.querySelector("#logIn");
const signUp = document.querySelector("#signUp");

	if (formType.innerText === "Sign Up") {
		logIn.classList.toggle("hide");
		signUp.classList.toggle("hide");
		formType.innerText = "Log In";
		msg.innerText = "Already having account";
	} else{
		logIn.classList.toggle("hide");
		signUp.classList.toggle("hide");
		formType.innerText = "Sign Up";	
		msg.innerText = "create new account";
	}
}


// Open log in and sign up form
function openForms() {
	document.querySelector("#form-container").style.visibility = "visible";
}

// closes log in and sign up form
function closeBtn() {
	document.querySelector("#form-container").style.visibility = "hidden";
}

function navResize(){
	const header = document.querySelector("header");
	header.classList.toggle("change-size");
}

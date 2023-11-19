var effectText = document.querySelector("#effectText");
var sn = "We Offer the best self-pace Course.";
var i = 0;
var snCo = "";

setInterval(startAnim, 250);

function startAnim() {
	if (i < sn.length) {
		snCo += sn[i];
		effectText.innerHTML = snCo;
		i++;
	} else {
		i = 0;
		snCo = "";
		sn === "Learn new technologies everyday, anytime." ? sn = "We Offer the best self-pace course." : sn = "Learn new technologies everyday, anytime.";
	}
}

var courseListBox = document.querySelectorAll(".courseListBox");
for (let q = 0; q < 4; q++) {
	courseListBox[q].addEventListener('mouseover', function () {
		// this.style.transform = "translateX(40px)";
		// this.style.transition = "0.5s";
		// this.style.zIndex = "101";
		this.classList.add("animSec");
	});

	courseListBox[q].addEventListener('mouseout', function () {
		// this.style.transform = "translateX(0px)";
		// this.style.transition = "2s";
		this.classList.remove("animSec");
	});
}


function setRole(x) {
	document.getElementById("role"+x).checked = true;
}

function setLeadership(y) {
	document.getElementById("leadership"+y).checked = true;
}

function setParticipation(z) {
	document.getElementById("participation"+z).checked = true;
}

function setProfessionalism(a) {
	document.getElementById("professionalism"+a).checked = true;
}

function setQuality(b) {//each of these input numbers is the score, when this is called the element wil be updated with which number was stored in the database to be pre checked upon revisiting this page
	document.getElementById("quality"+b).checked = true;
}

function clearRadioButtons(){
	var ele = document.getElementsByClassName("radio");
	for(var i=0;i<ele.length;i++)
		ele[i].checked = false;
}

function setStudentName(n){
	document.getElementById("currentStudent").innerHTML = n;
}
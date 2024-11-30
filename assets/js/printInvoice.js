function printform() {
	let printContent = document.querySelector(".user").innerHTML;
	let originalContent = document.body.innerHTML;
	document.body.innerHTML = printContent;
	window.print();
	document.body.innerHTML = originalContent;
}

async function createUser() {
	let fullname = document.getElementById("fullName");
	let username = document.getElementById("username");
	let password = document.getElementById("password");
	let userData = {
		fullName: fullname.value,
		username: username.value,
		password: password.value,
	};

	await fetch("http://numberone.com/src/functions/createUser", {
		method: "POST",
		headers: {
			"Content-Type": "application/json",
		},
		body: JSON.stringify(userData),
	})
		.then((response) => {
			return response.json();
		})
		.then((response) => {
			if (response.success == 200) {
				alertify.success(response.message);
			} else {
				alertify.error(response.message);
			}
		})
		.catch((error) => {
			alertify.error(error);
			console.error("خطأ:", error);
		});
}

document.getElementById("create").onclick = (e) => {
	e.preventDefault();
	createUser();
	document.querySelector(".user").reset();
};

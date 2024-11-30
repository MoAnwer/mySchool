async function editUser() {
	let id = document.getElementById("id").value;
	let fullname = document.getElementById("fullName").value;
	let username = document.getElementById("username").value;
	let password = document.getElementById("password").value;
	let userData = {
		id: id,
		fullName: fullname,
		username: username,
		password: password,
	};

	await fetch("http://numberone.com/src/functions/editUser", {
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
				document.querySelector(".user").reset();
			} else {
				alertify.error(response.message);
			}
		})
		.catch((error) => {
			alertify.error(error);
			console.error("خطأ:", error);
		});
}

document.getElementById("edit").onclick = (e) => {
	e.preventDefault();
	editUser();
};

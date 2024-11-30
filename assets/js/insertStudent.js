function validate() {
	let validData = true;
	document
		.querySelectorAll("form.user input.requierd")
		.values()
		.forEach((e) => {
			if (e.value == "") {
				validData = false;
				e.classList.add("is-invalid");
			} else {
				e.classList.contains("is-invalid")
					? e.classList.remove("is-invalid")
					: "";
			}
		});
	return validData;
}

async function saveStudent() {
	var fromData = {
		student: {
			fullName: document.querySelector('[name="fullName"]').value,
			enrollNumber: parseInt(
				document.querySelector('[name="enrollNumber"]').value
			),
			enrollDate: document.querySelector('[name="enrollDate"]').value,
			gender: document.querySelector('[name="gender"]').value,
			birthDate: document.querySelector('[name="birthDate"]').value,
			birthPlace: document.querySelector('[name="birthPlace"]').value,
			address: document.querySelector('[name="address"]').value,
			guardian: document.querySelector('[name="guardian"]').value,
			guardianCopula: document.querySelector('[name="guardianCopula"]').value,
			guardianCareer: document.querySelector('[name="guardianCareer"]').value,
			phoneOne: document.querySelector('[name="phoneOne"]').value,
			phoneTwo: document.querySelector('[name="phoneTwo"]').value,
			whatsappPhone: document.querySelector('[name="whatsappPhone"]').value,
			class: document.querySelector('[name="class"]').value,
			stage: document.querySelector('select[name="stage"]').value,
		},

		installments: {
			total: parseFloat(document.querySelector('[name="total"]').value),
			install_1: parseFloat(document.querySelector('[name="install_1"]').value),
			installDate_1: document.querySelector('[name="installDate_1"]').value,
			install_2: parseFloat(document.querySelector('[name="install_2"]').value),
			installDate_2: document.querySelector('[name="installDate_2"]').value,
			install_3: parseFloat(document.querySelector('[name="install_3"]').value),
			installDate_3: document.querySelector('[name="installDate_3"]').value,
			install_4: parseFloat(document.querySelector('[name="install_4"]').value),
			installDate_4: document.querySelector('[name="installDate_4"]').value,
			install_5: parseFloat(document.querySelector('[name="install_5"]').value),
			installDate_5: document.querySelector('[name="installDate_5"]').value,
			install_6: parseFloat(document.querySelector('[name="install_6"]').value),
			installDate_6: document.querySelector('[name="installDate_6"]').value,
		},
	};

	await fetch("../../src/functions/insertStudent.ajax.php", {
		method: "POST",
		headers: {
			"Content-Type": "application/json",
		},
		body: JSON.stringify(fromData),
	})
		.then((response) => {
			return response.json();
		})
		.then((response) => {
			if (response.statusCode == 200) {
				alertify.showAccountData(
					`
						<p class="my-3 h6 text-info">اسم المستخدم للحساب : <b class='text-dark'>${response.studentAccount.username}</b></p>
						<p class="mb-3 h6 text-info">كلمة المرور الحساب : <b class='text-dark'>${response.studentAccount.password}</b></p>
				`
				);
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

document.querySelector("#alert").onclick = (e) => {
	e.preventDefault();

	if (!validate()) {
		alertify.error(
			' <i class="bi bi-x-circle-fill mx-1"></i>  لا يمكنك ترك الحقول فارغة !'
		);
		return;
	}

	saveStudent();
};

if (!alertify.showAccountData) {
	//define a new dialog
	alertify.dialog("showAccountData", function factory() {
		return {
			main: function (message) {
				this.message = message;
			},
			setup: function () {
				return {
					buttons: [{ text: "اغلاق", key: 27 }],
					options: {
						title: "بيانات حساب التلميذ المالي",
					},
				};
			},
			prepare: function () {
				this.setContent(this.message);
			},
		};
	});
}

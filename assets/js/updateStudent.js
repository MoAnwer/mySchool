async function updateStudent() {
	const data = {
		studentId: document.querySelector('[name="id"]').value,
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
			stage: document.querySelector('[name="stage"]').value,
		},

		installments: {
			total: parseFloat(document.querySelector('[name="total"]').value),
			install_1: parseFloat(document.querySelector('[name="install_1"]').value),
			installDate_1: document.querySelector('[name="installDate_1"]').value,
			paid_1: parseFloat(document.querySelector('[name="paid_1"]').value),
			install_2: parseFloat(document.querySelector('[name="install_2"]').value),
			installDate_2: document.querySelector('[name="installDate_2"]').value,
			paid_2: parseFloat(document.querySelector('[name="paid_2"]').value),
			install_3: parseFloat(document.querySelector('[name="install_3"]').value),
			installDate_3: document.querySelector('[name="installDate_3"]').value,
			paid_3: parseFloat(document.querySelector('[name="paid_3"]').value),
			install_4: parseFloat(document.querySelector('[name="install_4"]').value),
			installDate_4: document.querySelector('[name="installDate_4"]').value,
			paid_4: parseFloat(document.querySelector('[name="paid_4"]').value),
			install_5: parseFloat(document.querySelector('[name="install_5"]').value),
			installDate_5: document.querySelector('[name="installDate_5"]').value,
			paid_5: document.querySelector('[name="paid_5"]').value,
			install_6: document.querySelector('[name="install_6"]').value,
			installDate_6: document.querySelector('[name="installDate_6"]').value,
			paid_6: parseFloat(document.querySelector('[name="paid_6"]').value),
		},
	};

	await fetch("http://numberone.com/src/functions/editStudent.php", {
		method: "POST",
		headers: {
			"Content-Type": "application/json",
		},
		body: JSON.stringify(data),
	})
		.then((data) => {
			return data.json();
		})
		.then((data) => {
			console.log(data);
		})
		.catch((error) => {
			console.error("خطأ:", error);
		});

	return true;
}

document.querySelector("#updateBtn").onclick = (e) => {
	e.preventDefault();
	if (updateStudent()) {
		alertify.success(
			'!! تم تعديل الطالب بنجاح <i class="bi bi-check-circle-fill mx-1"></i>'
		);
	} else {
		alertify.error(
			'!!لم تم تعديل الطالب بنجاح <i class="fas fa-xmark mx-1"></i>'
		);
	}
};

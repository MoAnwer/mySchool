const installmentsNames = {
	1: "الاول",
	2: "الثاني",
	3: "الثالث",
	4: "الرابع",
	5: "الخامس",
	6: "السادس",
};

// get paids and installs
$("#installsAndPaids").click(function (e) {
	e.preventDefault();
	let stage = document.getElementById("stageInstallsAndPaids").value;
	let gender = document.getElementById("genderInstallsAndPaids").value;
	$.ajax({
		type: "POST",
		url: "http://numberone.com/src/reports/installsAndPaids",
		data: { stage: stage, gender: gender },
		success: function (response) {
			alertify
				.alert()
				.set({
					maximizable: true,
					autoReset: true,
					startMaximized: true,
					message: response,
					title: `قائمة الأقساط المطلوبة و مدفوعاتها - ${stage} ${gender}`,
				})
				.show();
		},
		error: function (response) {
			console.log(response);
		},
	});
});

$("#bankakPaid").click(function (e) {
	e.preventDefault();
	let stage = document.getElementById("stageBankak").value;
	let install = document.getElementById("installBankak").value;
	let gender = document.getElementById("genderBankak").value;

	$.ajax({
		type: "POST",
		url: "http://numberone.com/src/reports/paidWithBankak",
		data: { stage: stage, install: install, gender: gender },
		success: function (response) {
			alertify
				.alert()
				.set({
					maximizable: true,
					autoReset: true,
					startMaximized: true,
					message: response,
					title: ` <i class='bi bi-credit-card'></i> سداد القسط ${installmentsNames[install]} عبر بنكك - ${stage} ${gender}  `,
				})
				.show();
		},
		error: function (response) {
			console.log(response);
		},
	});
});

// سداد عبر بنكك برقم العملية

$("#bankakWithProcessNumber").click(function (e) {
	e.preventDefault();
	let processNumber = document.getElementById(
		"bankakWithProcessNumber_processNumber"
	).value;
	let stage = document.getElementById("bankakWithProcessNumber_stage").value;
	let install = document.getElementById(
		"bankakWithProcessNumber_install"
	).value;

	$.ajax({
		type: "POST",
		url: "http://numberone.com/src/reports/bankakWithProcessNumber",
		data: { processNumber: processNumber, install: install, stage: stage },
		success: function (response) {
			alertify
				.alert()
				.set({
					maximizable: true,
					autoReset: true,
					startMaximized: true,
					message: response,
					title: `سداد عبر بنكك برقم العملية - ${stage} `,
				})
				.show();
		},
		error: function (response) {
			console.log(response);
		},
	});
});

$("#remanents").click(function (e) {
	e.preventDefault();
	let stage = document.getElementById("remanents_stage").value;
	let gender = document.getElementById("remanents_gender").value;
	let install = document.getElementById("remanents_install").value;

	$.ajax({
		type: "POST",
		url: "http://numberone.com/src/reports/remanents",
		data: { stage: stage, install: install, gender: gender },
		success: function (response) {
			alertify
				.alert()
				.set({
					maximizable: true,
					autoReset: true,
					startMaximized: true,
					message: response,
					title: `متبقي القسط ${installmentsNames[install]} - ${stage}  ${gender}`,
				})
				.show();
		},
		error: function (response) {
			console.log(response);
		},
	});
});

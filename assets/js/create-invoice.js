var invoiceContainer = document.getElementById("invoice");

function validate() {
	let validData = true;
	document
		.querySelectorAll("form.user input")
		.values()
		.forEach((e) => {
			if (e.id != "processNumber") {
				if (e.value == "") {
					validData = false;
					e.classList.add("is-invalid");
				} else {
					e.classList.contains("is-invalid")
						? e.classList.remove("is-invalid")
						: "";
				}
			}
		});
	invoiceContainer.innerHTML = `
			<div class="text-gray-800 h-100 text-center p-4" style="background-color: #f5f5f5;">
				<h1>معاينة</h1>
			</div>
	`;
	return validData;
}

let select = document.querySelector('[name="paidWay"]');

select.onchange = (e) => {
	let processNumber = `
		<label for="processNumber">رقم العملية</label>
		<input type="number" id="processNumber" class="form-control" name="processNumber" placeholder="0000" />
	`;

	if (select.value == "بنكك") {
		document.getElementById("proNum").innerHTML = processNumber;
	} else {
		document.getElementById("proNum").innerHTML = "";
	}
};

async function getInvoiceData() {
	const data = {
		enrollNumber: parseInt(
			document.querySelector('[name="enrollNumber"]').value
		),
		install: parseInt(document.querySelector('[name="install"]').value),
		paid: parseInt(document.querySelector('[name="paid"]').value),
		gender: document.querySelector('[name="gender"]').value,
		stage: document.querySelector('[name="stage"]').value,
	};

	await fetch("../../src/functions/createInvoice.ajax.php", {
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

			invoiceArea(data);

			const sendBtn = document.getElementById("sendWathsapp");

			sendBtn.addEventListener("click", (e) => {
				alertify.success("انتظر قليلاً حتى يتم الارسال...");
				sendToWhatapp(data);
			});

			const printBtn = document.querySelector("#print");
			printBtn.addEventListener("click", (e) => {
				saveAndPrintInvoice(data, data.invoiceId);
			});
		})
		.catch((error) => {
			alertify.error("خطأ: تحقق من صحة البيانات و حاول مجدداً");
			invoiceContainer.innerHTML =
				"<h1 class='text-center mt-5'> تحقق من صحة البيانات </h1>";
			console.error("خطأ:", error);
		});
}

document.querySelector("#create").onclick = (e) => {
	e.preventDefault();

	invoiceContainer.innerHTML = "";

	if (!validate()) {
		alertify.error(' <i class="bi bi-tools mx-1"></i>   قم بملء كل الحقول  !!');
		return;
	}
	getInvoiceData();
};

function invoiceArea(data) {
	let invoice = `
    <div class="invoice py-3 px-5 h-100 w-100 text-dark" id="invoice-paper" style="background-color: #f5f5f5;">
      <div class="invoice-header d-flex align-items-center justify-content-center flex-column">
        <span class="h3 mb-3">${data.appName}</span>
        <h4>ايصال دفع رقم (${data.invoiceId}) </h4>
      </div>
      <hr style="border-style:dashed">
      <div class="student-info mb-2 d-flex justify-content-between">
        <span><b>الاسم :</b>${data.student}</span>
        <span><b>الصف :</b> ${data.studentClass}</span>
      </div>
      <hr style="border-style:dashed">
      <table class="table table-bordered text-center">
        <thead class="table-dark">
          <tr>
            <th>القسط</th>
            <th>المبلغ</th>
            <th>المتبقي</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>${data.installName}</td>
            <td>${data.newPaid} جنية</td>
            <td>${data.remanent}  جنية</td>
          </tr>
        </tbody>
      </table>
      <div class="more-info mt-5 d-flex justify-content-between align-items-center">
        <span><b>التاريخ: </b> <p dir="ltr">${data.date}</p></span>
        <span><b>التوقيع: </b> <img src="http://numberone.com/assets/images/inkedPhoto.png" width="100"></span>
      </div>
    </div>
    <div class="btns d-flex">
      <button class="btn btn-success d-block w-100 m-1" id="sendWathsapp"><i class="bi bi-whatsapp mx-1"></i>ارسال عبر الواتساب</button>
      <button class="btn btn-info d-block w-100 m-1" id="print"><i class="bi bi-printer mx-1"></i>حفظ و طباعة</button>
    </div>
    `;
	invoiceContainer.innerHTML = invoice;
}

function sendToWhatapp(data) {
	let processNumber = $("#processNumber").val() ?? 0;
	let invoiceData = {
		id: data.invoiceId,
		student: data.student,
		stage: data.stage,
		installNumber: data.installName,
		studentID: parseInt(data.studentID),
		paid: data.newPaid,
		whatsappNumber: data.whatsapp,
		paidWay: document.querySelector('[name="paidWay"]').value,
		processNumber: processNumber,
	};

	html2canvas($("#invoice-paper")[0]).then(function (canvas) {
		sendImageToServer(data.invoiceId, canvas.toDataURL("image/png"));
		toWhatsapp();
	});

	async function sendImageToServer(invoiceID, imageData) {
		$.ajax({
			type: "POST",
			url: "http://numberone.com/save_image.php",
			data: { id: invoiceID, image: imageData },
			success: function (response) {
				console.log("تم حفظ الصورة على الخادم!");
			},
			error: function (response) {
				console.log(response);
			},
		});
	}

	function toWhatsapp() {
		$.ajax({
			type: "POST",
			url: "http://numberone.com/src/functions/sendInvoice.php",
			data: { number: invoiceData.whatsappNumber, id: invoiceData.id },
			success: function (response) {
				alertify.success("تم ارسال الايصال بنجاح  !!");
			},
			error: function (response) {
				console.log(response.responseText);
			},
		});
	}
	// save invoice on the db
	saveInovice(invoiceData);

	// end
	invoiceContainer.innerHTML = `
			<div class="text-gray-800 h-100 text-center p-4" style="background-color: #f5f5f5;">
				<h1>معاينة</h1>
			</div>
	`;
}

function saveInovice(invoice) {
	$.ajax({
		type: "POST",
		url: "http://numberone.com/src/functions/saveInvoiceData.php",
		data: invoice,
		success: function (response) {
			alertify.success(JSON.parse(response).message);
		},
		error: function () {
			console.log("حدث خطأ أثناء حفظ الصورة.");
		},
	});
}

function saveAndPrintInvoice(invoiceData, id) {
	const invoiceDataToServer = {
		id: invoiceData.invoiceId,
		student: invoiceData.student,
		stage: invoiceData.stage,
		installNumber: invoiceData.installName,
		studentID: parseInt(invoiceData.studentID),
		paid: invoiceData.newPaid,
		whatsappNumber: invoiceData.whatsapp,
		paidWay: select.value,
		processNumber: $("#processNumber").val() ?? 0,
	};

	html2canvas($("#invoice-paper")[0]).then(function (canvas) {
		sendImageToServer(id, canvas.toDataURL("image/png"));
	});

	async function sendImageToServer(invoiceID, imageData) {
		$.ajax({
			type: "POST",
			url: "http://numberone.com/src/functions/saveImage.php",
			data: { id: invoiceID, image: imageData },
			success: function (response) {
				alertify.success(JSON.parse(response).message);
				console.log("تم حفظ الصورة على الخادم!");
			},
			error: function (response) {
				console.log(response);
			},
		});
	}
	// save invoice on the db
	saveInovice(invoiceDataToServer);
	console.log(invoiceDataToServer);

	setTimeout((e) => {
		let printContents = document.getElementById("invoice-paper").innerHTML;
		let originalContents = document.body.innerHTML;

		document.body.innerHTML = printContents;
		window.print();
		document.body.innerHTML = originalContents;

		invoiceContainer.innerHTML = `
			<div class="text-gray-800 h-100 text-center p-4" style="background-color: #f5f5f5;">
				<h1>معاينة</h1>
			</div>
		`;
	}, 3000);
}

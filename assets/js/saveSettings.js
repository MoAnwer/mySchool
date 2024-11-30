function exportBackup() {
	$.ajax({
		type: "POST",
		url: "http://numberone.com/src/functions/databaseBackup.php",
		data: { do: "backup" },
		success: function (response) {
			alertify.success(
				"تم عمل بنسخة احتياطية بنجاح  <i class='bi bi-database'></i>"
			);
		},
		error: function (response) {
			console.log(response.responseText);
		},
	});
}

function downloadBackupFile() {
	window.location.href =
		"http://numberone.com/src/functions/downloadBackup.php";

	alertify.success("جاري تحميل .... <i class='fas fa-download'></i>");
}

function updateAppName() {
	let name = $("#name").val();
	$.ajax({
		type: "POST",
		url: "http://numberone.com/src/functions/updateAppName.php",
		data: { appName: name },
		success: function (response) {
			alertify.updateSuccess(
				`
					<div class="mt-4">
						تم التعديل قم <a href=''> باعادة تحميل </a>ليظهر المحتوى الجديد
				 	</div>
				`
			);
		},
		error: function (response) {
			console.log(response.responseText);
		},
	});
}

function updateMsg() {
	let msg = $("#msg").val();
	$.ajax({
		type: "POST",
		url: "http://numberone.com/src/functions/updateInvoiceMsg.php",
		data: { msg: msg },
		success: function (response) {
			console.log(response);

			alertify.updateSuccess(
				`
						<div class="mt-4">
							تم التعديل قم <a href=''> باعادة تحميل </a>ليظهر المحتوى الجديد
						 </div>
					`
			);
		},
		error: function (response) {
			console.log(response);
		},
	});
}

function exportExcel() {
	$.ajax({
		type: "POST",
		url: "http://numberone.com/src/functions/exportToXlsx.php",
		data: { do: "export" },
		success: function () {
			alertify.success("جاري انشاء الملفات، الرجاء الانتظار....");
			alertify.success(`تم تصدير الملفات بنجاح`);
			console.info("export success");
		},
		error: function (response) {
			console.log(response);
		},
	});
}

function deleteDatebase() {
	$.ajax({
		type: "POST",
		url: "http://numberone.com/src/functions/deleteDatabase.php",
		data: { password: $("#password").val() },
		success: function (response) {
			if (JSON.parse(response).success == 200) {
				alertify.deleteSuccess(
					`
						<div class="mt-4 h5">
								${JSON.parse(response).message}
						 	</div>
					`
				);
				console.log(JSON.parse(response).message);
			} else {
				alertify.error(JSON.parse(response).message);
				console.log(response);
			}
		},
		error: function (response) {
			console.log(response);
		},
	});
}

$("#backup").click(function () {
	exportBackup();
});

$("#download").click(function () {
	downloadBackupFile();
});

$("#updateData").click(function () {
	updateAppName();
});

$("#updateMsg").click(function () {
	updateMsg();
});

$("#exportExcel").click(function () {
	exportExcel();
});

$("#deleteDatabase").click(function () {
	deleteDatebase();
});

if (!alertify.updateSuccess) {
	//define a new dialog
	alertify.dialog("updateSuccess", function factory() {
		return {
			main: function (message) {
				this.message = message;
			},
			setup: function () {
				return {
					buttons: [{ text: "اغلاق", key: 27 /*Esc*/ }],
					options: {
						title: "تم التعديل بنجاح",
					},
				};
			},
			prepare: function () {
				this.setContent(this.message);
			},
		};
	});
}

if (!alertify.deleteSuccess) {
	//define a new dialog
	alertify.dialog("deleteSuccess", function factory() {
		return {
			main: function (message) {
				this.message = message;
			},
			setup: function () {
				return {
					buttons: [{ text: "اغلاق", key: 27 /*Esc*/ }],
					options: {
						title: " <i class='bi bi-trash-fill ml-1'></i> تم الحذف بنجاح",
					},
				};
			},
			prepare: function () {
				this.setContent(this.message);
			},
		};
	});
}

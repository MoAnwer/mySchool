<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $imageData = $_POST["image"];

    // إزالة البادئة data:image/png;base64,
    $imageData = str_replace("data:image/png;base64,", "", $imageData);
    $imageData = str_replace(" ", "+", $imageData);
    $imageData = base64_decode($imageData);

    $filename = "../../uploads/$id.png";
    file_put_contents($filename, $imageData);

    echo json_encode(["status" => "success", "message" => "تم حفظ الصورة بنجاح"]);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}
?>
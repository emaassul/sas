<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // جمع البيانات من النموذج
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // مسار ملف CSV
    $file = 'attendance.csv';

    // تحقق مما إذا كان الملف موجودًا
    $file_exists = file_exists($file);

    // فتح ملف CSV في وضع الإضافة
    $handle = fopen($file, 'a');

    // إذا كان الملف جديدًا، إضافة العناوين
    if (!$file_exists) {
        fputcsv($handle, ['الاسم', 'البريد الإلكتروني', 'رقم الهاتف', 'حضور اليوم الأول', 'حضور اليوم الثاني', 'حضور اليوم الثالث']);
    }

    // كتابة البيانات الجديدة مع حضور اليوم الأول (قيمته 1)
    fputcsv($handle, [$name, $email, $phone, 1, 0, 0]);

    // إغلاق الملف
    fclose($handle);

    // رسالة النجاح
    echo "<script>alert('تم تسجيل حضورك لليوم الأول.');</script>";
}
?>


<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>التسجيل</title>
    <style>
        body {
            background-color: rgb(255, 255, 255);
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        /* نمط للصورة */
        .top-right-img {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 100px; 
            height: auto;
        }
        .form-container {
            width: 470px;
            height: 350px;
            margin: 0 auto;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #92d0a6;
            padding: 40px;
            border-radius: 20px;
            text-align: center;
        }
        .form-field[type="text"],
        .form-field[type="email"] {
            width: calc(100% - 22px);
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #131010;
            border-radius: 5px;
            text-align: center;
            background-color: #c4ead6;
            color: black;
        }
        .submit-button {
            background-color: #ddefdd;
            border: 1px solid #131010;
            border-radius: 5px;
            padding: 10px 20px;
            color: black;
            cursor: pointer;
        }
        .submit-button:hover {
            background-color: #c3f3e1;
            color: #000;
        }
        h8 {
            text-align: center;
            font-style: italic;
            background: #92d0a6;
            padding: 20px;
        }
    </style>
</head>
<body>
    <!-- إضافة الصورة -->
    <img src="s.jpg" alt="صورة" class="top-right-img">

    <div class="form-container">
        <h8>التسجيل</h8>
        <br><br><br>
        <form action="" method="post">
            <label for="name">الاسم:</label>
            <input type="text" id="name" name="name" class="form-field" required>
            <br>
            <label for="email">البريد الإلكتروني:</label>
            <input type="email" id="email" name="email" class="form-field" required>
            <br>
            <label for="phone">رقم الهاتف:</label>
            <input type="text" id="phone" name="phone" class="form-field" required>
            <br><br><br>
            <input type="submit" class="submit-button" value="تسجيل">
        </form>
    </div>
</body>
</html>

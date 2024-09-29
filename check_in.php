<?php
// مسار ملف CSV
$file = 'attendance.csv';

// التحقق مما إذا كان البريد الإلكتروني موجودًا
if (isset($_GET['email'])) {
    $email = $_GET['email'];
} else {
    // توجيه المستخدم لصفحة التسجيل إذا لم يتم تمرير البريد الإلكتروني
    echo "لم يتم تمرير البريد الإلكتروني. <a href='register.php'>اضغط هنا للتسجيل</a>.";
    exit();
}

// اليوم الحالي (يمكن تغيير القيمة بناءً على اليوم الفعلي)
$current_day = 2; // مثال: 2 لليوم الثاني، 3 لليوم الثالث

// فتح ملف CSV
$rows = array_map('str_getcsv', file($file));
$header = array_shift($rows); // استخراج العناوين

// البحث عن المستخدم في ملف CSV
$found = false;
foreach ($rows as &$row) {
    if ($row[1] == $email) { // التحقق من البريد الإلكتروني
        $found = true;

        // تسجيل الحضور بناءً على اليوم الحالي
        if ($current_day == 1 && $row[3] == 0) {
            $row[3] = 1; // تسجيل حضور اليوم الأول
            echo "تم تسجيل حضورك لليوم الأول.";
        } elseif ($current_day == 2 && $row[4] == 0) {
            $row[4] = 1; // تسجيل حضور اليوم الثاني
            echo "تم تسجيل حضورك لليوم الثاني.";
        } elseif ($current_day == 3 && $row[5] == 0) {
            $row[5] = 1; // تسجيل حضور اليوم الثالث
            echo "تم تسجيل حضورك لليوم الثالث.";
        } else {
            echo "لقد تم تسجيل حضورك سابقًا.";
        }
        break;
    }
}

// إذا لم يتم العثور على البريد الإلكتروني، توجيه المستخدم للتسجيل
if (!$found) {
    echo "لم يتم العثور على بياناتك. <a href='register.php'>اضغط هنا للتسجيل</a>.";
}

// إعادة كتابة الملف مع تحديث بيانات الحضور
$handle = fopen($file, 'w');
fputcsv($handle, $header);
foreach ($rows as $row) {
    fputcsv($handle, $row);
}
fclose($handle);
?>

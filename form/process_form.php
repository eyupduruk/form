<?php
// process_form.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];

    // Hataları depolamak için bir dizi oluşturalım
    $errors = [];

    // E-posta formatını kontrol edelim
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Geçersiz e-posta formatı.";
    }

    // Şifre ve şifre tekrarının eşleşip eşleşmediğini kontrol eder
    if ($password !== $password_confirm) {
        $errors[] = "Şifreler uyuşmuyor.";
    }

    // Şifre uzunluğunu kontrol eder
    if (strlen($password) < 6) {
        $errors[] = "Şifre en az 6 karakter uzunluğunda olmalıdır.";
    }

    // Veritabanı bağlantısı ve e-posta benzersizlik kontrolü
    $servername = "localhost";
    $username = "root"; // Veritabanı kullanıcı adınızı buraya yazın
    $password_db = ""; // Veritabanı şifrenizi buraya yazın
    $dbname = "kullanici_veritabani"; // Kullanıcı veritabanınızın adını buraya yazın

    // Veritabanı bağlantısını oluştur
    $conn = new mysqli($servername, $username, $password_db, $dbname);

    // Bağlantıyı kontrol et
    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    // E-posta adresinin benzersiz olup olmadığını kontrol edelim
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $errors[] = "Bu e-posta adresi zaten kayıtlı.";
    }

    // Eğer hata yoksa, kullanıcıyı kaydet
    if (empty($errors)) {
        // Şifreyi hashleyelim
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Kullanıcıyı veritabanına ekleyelim
        $stmt = $conn->prepare("INSERT INTO users (name, surname, email, password, birthdate, gender) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $surname, $email, $hashed_password, $birthdate, $gender);

        if ($stmt->execute()) {
            echo "Kayıt başarılı!";
        } else {
            echo "Hata: " . $stmt->error;
        }
    } else {
        // Hataları ekrana yazdıralım
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }

    // Veritabanı bağlantısını kapat
    $stmt->close();
    $conn->close();
}
?>

<?php
// list_users.php

$servername = "localhost";
$username = "worldwhok"; // Veritabanı kullanıcı adınızı buraya yazın
$password_db = "Duruk1221."; // Veritabanı şifrenizi buraya yazın
$dbname = "kullanici_veritabani"; // Kullanıcı veritabanınızın adını buraya yazın

// Veritabanı bağlantısını oluştur
$conn = new mysqli($servername, $username, $password_db, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

$sql = "SELECT name, surname, email, birthdate, gender FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>İsim</th>
                <th>Soyisim</th>
                <th>E-posta</th>
                <th>Doğum Tarihi</th>
                <th>Cinsiyet</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['surname']}</td>
                <td>{$row['email']}</td>
                <td>{$row['birthdate']}</td>
                <td>{$row['gender']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Kayıtlı kullanıcı bulunmamaktadır.";
}

// Veritabanı bağlantısını kapat
$conn->close();
?>

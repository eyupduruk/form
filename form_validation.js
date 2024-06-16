function validateForm() {
    var name = document.forms["registerForm"]["name"].value;
    var surname = document.forms["registerForm"]["surname"].value;
    var email = document.forms["registerForm"]["email"].value;
    var password = document.forms["registerForm"]["password"].value;
    var passwordConfirm = document.forms["registerForm"]["password_confirm"].value;
    var birthdate = document.forms["registerForm"]["birthdate"].value;
    var gender = document.forms["registerForm"]["gender"].value;
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (name == "" || surname == "" || email == "" || password == "" || passwordConfirm == "" || birthdate == "" || gender == "") {
        alert("Tüm alanlar doldurulmalıdır.");
        return false;
    }

    if (!emailPattern.test(email)) {
        alert("Geçerli bir e-posta adresi giriniz.");
        return false;
    }

    if (password.length < 6) {
        alert("Şifre en az 6 karakter uzunluğunda olmalıdır.");
        return false;
    }

    if (password !== passwordConfirm) {
        alert("Şifreler uyuşmuyor.");
        return false;
    }

    return true;
}


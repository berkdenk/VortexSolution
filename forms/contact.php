<?php
// Alıcı e-posta adresi
$to = 'berktugdenk@gmail.com';

// Formdan gelen veriler
$name = isset($_POST['name']) ? strip_tags(trim($_POST['name'])) : '';
$email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
$subject = isset($_POST['subject']) ? strip_tags(trim($_POST['subject'])) : 'Yeni iletişim formu mesajı';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

// Basit doğrulama
if (empty($name) || empty($email) || empty($message)) {
    echo 'Lütfen tüm zorunlu alanları doldurun.';
    exit;
}

// Email başlığı ve içeriği
$email_subject = "İletişim Formu: $subject";
$email_body = "İsim: $name\n";
$email_body .= "Email: $email\n\n";
$email_body .= "Mesaj:\n$message\n";

// Email başlıkları (header)
$headers = "From: $name <$email>\r\n";
$headers .= "Reply-To: $email\r\n";

// Email gönderimi
if (mail($to, $email_subject, $email_body, $headers)) {
    echo 'OK';  // JavaScript ile bu mesajı yakalayıp kullanıcıya bildirebilirsin
} else {
    echo 'Email gönderilirken hata oluştu.';
}
?>

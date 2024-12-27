<!DOCTYPE html>
<html>
<head>
    <title>Détails de votre compte</title>
</head>
<body>
    <h2>Bonjour {{ $name }},</h2>
    <p>Votre compte employé a été créé avec succès.</p>
    <p>Voici vos informations de connexion :</p>
    <ul>
        <li>Email : {{ $email }}</li>
        <li>Mot de passe : {{ $password }}</li>
    </ul>
    <p>Veuillez vous connecter dès que possible et changer votre mot de passe pour des raisons de sécurité.</p>
    <p>Merci,</p>
    <p>L'équipe de gestion.</p>
</body>
</html>

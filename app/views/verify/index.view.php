<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>
</head>
<body>
    <div class="verify-responses" data-success="<?= json_encode($view_data["result"]["success"]) ?>" data-message="<?= $view_data["result"]["error_mess"] ?? '' ?>"></div>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= BASE_URL ?>assets/js/account/verify.js"></script>
<?php
echo '
<!DOCTYPE html>
<html lang="lo">
<head>
    <meta charset="UTF-8">
    <title>ຂໍ້ຄວາມ</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #fff;
            font-family: "Phetsarath OT", sans-serif;
            text-align: center;
        }

        .orbit-container {
            position: relative;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            border: 2px dashed #ddd;
        }

        /* The moving orbit text */
        .orbit {
            position: absolute;
            top: 50%;
            left: 50%;
            transform-origin: -120px center; /* radius from center */
            animation: orbit 10s linear infinite;
            font-weight: bold;
            font-size: 20px;
            color: green;
        }

        @keyframes orbit {
            0%   { transform: rotate(0deg) translateX(120px) rotate(0deg); }
            100% { transform: rotate(360deg) translateX(120px) rotate(-360deg); }
        }

        /* Fixed time pins */
        .pin {
            position: absolute;
            font-weight: bold;
            color: blue;
        }
        .pin12 { top: 10px; left: 50%; transform: translateX(-50%); }
        .pin3  { top: 50%; right: 10px; transform: translateY(-50%); }
        .pin6  { bottom: 10px; left: 50%; transform: translateX(-50%); }
        .pin9  { top: 50%; left: 10px; transform: translateY(-50%); }

        .message {
            margin-top: 20px;
            color: orange;
            font-weight: bold;
              font-size: 20px;
        }
    </style>
</head>
<body>
    <div>
        <div class="orbit-container">
            <!-- Orbiting text -->
            <div class="orbit">ໂປຼແກຼມຂອງທ່ານໝົດກຳນົດແລ້ວ "ຄົບຮອບ 365 ວັນ"</div>
            
            <!-- Fixed pins -->
            <div class="pin pin12">0 |12 ເດືອນ</div>
            <div class="pin pin3">3 ເດືອນ</div>
            <div class="pin pin6">6 ເດືອນ</div>
            <div class="pin pin9">9 ເດືອນ</div>
        </div>
        <div class="message">
            ກະລຸນາຕິດຕໍ່ທີ່ເບີ 020 59339954 ເພື່ອ Activate
        </div>
    </div>
</body>
</html>
';
?>

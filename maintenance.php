<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Maintenance - PT Ganda Elang Tangguh</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}

body {
  height: 100vh;
  background: radial-gradient(circle at top left, #1f2937, #0f172a 60%);
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}

/* subtle animated light */
body::after {
  content: "";
  position: absolute;
  width: 600px;
  height: 600px;
  background: rgba(250,204,21,0.08);
  border-radius: 50%;
  top: -200px;
  right: -200px;
  filter: blur(120px);
  animation: glow 6s ease-in-out infinite alternate;
}

@keyframes glow {
  0% { transform: scale(1); }
  100% { transform: scale(1.2); }
}

.container {
  text-align: center;
  max-width: 850px;
  padding: 40px 20px;
  z-index: 2;
}

.logo {
  width: 180px;
  margin-bottom: 30px;
}

h1 {
  font-size: 42px;
  font-weight: 700;
  margin-bottom: 20px;
}

p {
  font-size: 18px;
  opacity: 0.85;
  line-height: 1.6;
  margin-bottom: 40px;
}

/* Countdown */
.countdown {
  display: flex;
  justify-content: center;
  gap: 20px;
  margin-bottom: 40px;
  flex-wrap: wrap;
}

.time-box {
  background: rgba(255,255,255,0.06);
  padding: 20px;
  border-radius: 10px;
  min-width: 90px;
  backdrop-filter: blur(6px);
}

.time-box h2 {
  font-size: 28px;
}

.time-box span {
  font-size: 14px;
  opacity: 0.7;
}

/* Progress bar */
.progress-container {
  width: 100%;
  height: 6px;
  background: rgba(255,255,255,0.1);
  border-radius: 20px;
  overflow: hidden;
  margin-bottom: 40px;
}

.progress-bar {
  height: 100%;
  width: 0%;
  background: #facc15;
  animation: loading 5s infinite;
}

@keyframes loading {
  0% { width: 0%; }
  50% { width: 85%; }
  100% { width: 0%; }
}

/* Buttons */
.buttons {
  display: flex;
  gap: 20px;
  justify-content: center;
  flex-wrap: wrap;
}

.btn {
  padding: 12px 28px;
  border-radius: 6px;
  font-weight: 600;
  text-decoration: none;
  transition: 0.3s ease;
}

.btn-primary {
  background: #facc15;
  color: #000;
}

.btn-primary:hover {
  background: #eab308;
  transform: translateY(-3px);
}

.btn-outline {
  border: 1px solid #fff;
  color: #fff;
}

.btn-outline:hover {
  background: #fff;
  color: #000;
}

@media(max-width:768px){

  body {
    padding: 20px;
    height: auto;
    min-height: 100vh;
  }

  body::after {
    width: 400px;
    height: 400px;
    top: -150px;
    right: -150px;
    filter: blur(100px);
  }

  .container {
    padding: 30px 15px;
  }

  .logo {
    width: 140px;
    margin-bottom: 20px;
  }

  h1 {
    font-size: 26px;
    line-height: 1.3;
  }

  p {
    font-size: 15px;
    line-height: 1.6;
    margin-bottom: 30px;
  }

  .countdown {
    gap: 12px;
    margin-bottom: 30px;
  }

  .time-box {
    min-width: 70px;
    padding: 15px;
    border-radius: 8px;
  }

  .time-box h2 {
    font-size: 20px;
  }

  .time-box span {
    font-size: 12px;
  }

  .progress-container {
    margin-bottom: 30px;
  }

  .buttons {
    flex-direction: column;
    gap: 12px;
  }

  .btn {
    width: 100%;
    text-align: center;
    padding: 14px;
    font-size: 14px;
  }

}
</style>
</head>
<body>

<div class="container">

  <img src="/images/logo.webp" class="logo" alt="Logo PT Ganda Elang Tangguh">

  <h1>Website Sedang Dalam Pembaruan</h1>

  <p>
    PT Ganda Elang Tangguh sedang melakukan peningkatan sistem
    untuk menghadirkan pengalaman layanan yang lebih optimal.
    Website akan segera kembali online.
  </p>

  <div class="countdown">
    <div class="time-box">
      <h2 id="days">00</h2>
      <span>Hari</span>
    </div>
    <div class="time-box">
      <h2 id="hours">00</h2>
      <span>Jam</span>
    </div>
    <div class="time-box">
      <h2 id="minutes">00</h2>
      <span>Menit</span>
    </div>
    <div class="time-box">
      <h2 id="seconds">00</h2>
      <span>Detik</span>
    </div>
  </div>

  <div class="progress-container">
    <div class="progress-bar"></div>
  </div>

  <div class="buttons">
    <a href="https://wa.me/6281234567890" class="btn btn-primary">
      <i class="fa-brands fa-whatsapp"></i> Hubungi Kami
    </a>

    <a href="mailto:info@gandaelangtangguh.com" class="btn btn-outline">
      <i class="fa-solid fa-envelope"></i> Email Support
    </a>
  </div>

</div>

<script>
// Tanggal selesai maintenance
var countDownDate = new Date("Feb 28, 2026 22:00:00").getTime();

var x = setInterval(function() {

  var now = new Date().getTime();
  var distance = countDownDate - now;

  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  document.getElementById("days").innerHTML = days;
  document.getElementById("hours").innerHTML = hours;
  document.getElementById("minutes").innerHTML = minutes;
  document.getElementById("seconds").innerHTML = seconds;

  if (distance < 0) {
    clearInterval(x);
    document.querySelector(".countdown").innerHTML = "Website Segera Online";
  }

}, 1000);
</script>

</body>
</html>
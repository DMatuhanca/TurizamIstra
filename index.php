<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <title>Istra Guide</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    :root{
      --bg:#fdf6ec; --card:#ffffff; --text:#333; --muted:#666;
      --brand:#3A9679; --brand-dark:#2d7a60;
      --shadow:0 8px 20px rgba(0,0,0,.08);
      --radius:14px; --radius-sm:10px; --maxw:1200px;
    }
    *{box-sizing:border-box} html,body{margin:0;background:var(--bg);color:var(--text);font-family:system-ui,-apple-system,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans","Liberation Sans",sans-serif}

    .hero{
      position:relative; min-height: 48vh; display:flex; align-items:center; justify-content:center;
      text-align:center; color:#fff; padding: 80px 20px; overflow:hidden;
      background:#0d2a36; 
    }
    .hero::before{
      content:""; position:absolute; inset:0;
      background: url('assets/images/hero.jpg') center/cover no-repeat;
      opacity: 0.85;          
      z-index:0;
    }
    .hero::after{
      content:""; position:absolute; inset:0;
      background: linear-gradient(rgba(0,0,0,.45), rgba(0,0,0,.35)); 
      z-index:1;
    }
    .hero > .inner{position:relative; z-index:2}
    .hero h1{font-size: clamp(28px,4vw,48px); margin:0 0 10px}
    .hero p{font-size: clamp(16px,2.2vw,20px); margin:0 0 22px; color:#f3f3f3}
    .btn{
      display:inline-block; padding:12px 18px; border-radius:10px;
      background:#fff; color:#111; text-decoration:none; font-weight:600;
      transition:transform .15s ease, box-shadow .2s ease; box-shadow:var(--shadow)
    }
    .btn:hover{transform:translateY(-2px)}

    .wrap{max-width:var(--maxw); margin: 28px auto 60px; padding: 0 20px;}
    .section-title{font-size: clamp(22px,3vw,32px); margin: 10px 0 16px}
    .section-sub{color:var(--muted); margin:0 0 24px; font-size: 15px}

    .grid{display:grid; grid-template-columns: repeat(3, 1fr); gap: 22px;}
    @media (max-width: 960px){ .grid{grid-template-columns: repeat(2, 1fr);} }
    @media (max-width: 640px){ .grid{grid-template-columns: 1fr;} }

    .card{display:block; text-decoration:none; color:inherit; background:var(--card); border-radius:var(--radius);
      overflow:hidden; box-shadow:var(--shadow); transition: transform .18s ease, box-shadow .25s ease;}
    .card:hover{ transform: translateY(-4px); box-shadow: 0 14px 30px rgba(0,0,0,.12); }
    .thumb{width:100%; aspect-ratio: 3/2; object-fit:cover; display:block;}
    .card-body{padding:14px 16px 16px}
    .card-title{margin:0 0 6px; font-size:18px; font-weight:700}
    .card-desc{margin:0; color:var(--muted); font-size:14px; line-height:1.45}

    .map-wrap{margin-top:48px; background:var(--card); border-radius:var(--radius); box-shadow:var(--shadow); padding:16px;}
    .map-frame{position:relative; width:100%; padding-top: 130%; border:1px solid #e7e3dc; border-radius:10px; overflow:hidden; background:#fafafa;}
    .map-frame object, .map-frame embed{position:absolute; inset:0; width:100%; height:100%; border:0;}
    .map-note{font-size:13px; color:#777; margin-top:10px}
  </style>
</head>
<body>

  <header class="hero">
    <div class="inner">
      <h1>Otkrijte ljepotu Istre</h1>
      <p>Vaš vodič kroz povijest, kulturu i prirodu</p>
      <a class="btn" href="plan.php">Kreiraj plan puta</a>
    </div>
  </header>

  <main class="wrap">
    <h2 class="section-title">Popularne lokacije</h2>
    <p class="section-sub">Istražite najpoznatije gradove i atrakcije – kliknite na karticu za detalje i ideje što raditi.</p>

    <div class="grid">
      <?php
        $result = $conn->query("SELECT * FROM cities");
        while($row = $result->fetch_assoc()):
          $id   = (int)$row['id'];
          $name = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
          $desc = htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8');
          $img  = htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8');
      ?>
        <a class="card" href="city.php?id=<?= $id ?>">
          <img class="thumb" src="assets/images/<?= $img ?>" alt="<?= $name ?>">
          <div class="card-body">
            <h3 class="card-title"><?= $name ?></h3>
            <p class="card-desc"><?= $desc ?></p>
          </div>
        </a>
      <?php endwhile; ?>
    </div>

    <section class="map-wrap">
      <h2 class="section-title">Karta Istre – turističke rute</h2>
      <p class="section-sub">Službena karta Istre s označenim rutama i točkama interesa.</p>
      <div class="map-frame">
        <object data="assets/maps/istria-map.pdf" type="application/pdf">
          <embed src="assets/maps/istria-map.pdf" type="application/pdf"/>
        </object>
      </div>
    </section>

  </main>

</body>
</html>

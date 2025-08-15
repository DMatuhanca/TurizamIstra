<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <title>Detalji lokacije</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    :root{ --bg:#fdf6ec; --card:#fff; --text:#333; --muted:#666; --brand:#3A9679; --brand-dark:#2d7a60; --shadow:0 8px 20px rgba(0,0,0,.08); --maxw:1100px; --radius:14px; }
    html,body{margin:0;background:var(--bg);color:var(--text);font-family:system-ui,-apple-system,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans","Liberation Sans",sans-serif}
    header{background:#1A5F7A; color:#fff; padding:18px 20px}
    header a{color:#fff; text-decoration:none; opacity:.9}
    header a:hover{opacity:1}
    .wrap{max-width:var(--maxw); margin: 26px auto 60px; padding: 0 20px;}

    .hero-card{background:var(--card); border-radius:var(--radius); box-shadow:var(--shadow); overflow:hidden}
    .hero-img{width:100%; max-height:460px; object-fit:cover; display:block}
    h1{font-size: clamp(24px,3.2vw,34px); margin:16px 16px 6px}
    .lead{margin:0 16px 18px; color:var(--muted); line-height:1.55}

    .content{
      display:grid; gap:24px; grid-template-columns: 2fr 1fr; margin-top: 10px;
    }
    @media (max-width: 900px){ .content{grid-template-columns: 1fr;} }

    .card{background:var(--card); border-radius:var(--radius); box-shadow:var(--shadow); padding:16px}
    h3{margin:6px 0 14px; font-size:20px}
    p{margin:0 0 12px; line-height:1.6}
    ul{margin:0 0 12px 18px}

    .gallery{
        display:grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
    }
    @media (max-width: 900px){ .gallery{grid-template-columns: repeat(2, 1fr);} }
    @media (max-width: 560px){ .gallery{grid-template-columns: 1fr;} }

    .gitem{
        display:flex; flex-direction:column; align-items:center;
        text-align:center;
    }
    .gimg{
        width:100%; aspect-ratio: 4/3;
        object-fit:cover; border-radius:10px; box-shadow:var(--shadow);
        transition: transform .2s ease, box-shadow .2s ease, opacity .2s ease;
        cursor:pointer;
    }
    .gimg:hover{
      transform: scale(1.04);
      box-shadow: 0 12px 25px rgba(0,0,0,.25);
      opacity: .92;
    }
    .gcap{
      margin-top:6px; font-size:13px; color:var(--muted);
    }


    .back{display:inline-block; margin-top: 20px; background:var(--brand); color:#fff; padding:10px 14px; border-radius:10px; text-decoration:none}
    .back:hover{background:var(--brand-dark)}
    .lightbox {
        position: fixed; inset: 0;
        background: rgba(0,0,0,.85);
        display: none; align-items: center; justify-content: center;
        z-index: 9999;
    }
    .lightbox img {
        max-width: 90%; max-height: 90%;
        border-radius: 10px; box-shadow: 0 0 20px rgba(0,0,0,.5);
    }
    .lightbox:target { display: flex; }  
    </style>
</head>
<script>
document.addEventListener("DOMContentLoaded", function(){
  const imgs = document.querySelectorAll(".gallery img");
  const lightbox = document.createElement("div");
  lightbox.className = "lightbox";
  lightbox.innerHTML = "<img>";
  document.body.appendChild(lightbox);

  const lbImg = lightbox.querySelector("img");

  imgs.forEach(img=>{
    img.addEventListener("click", ()=>{
      lbImg.src = img.src;
      lbImg.alt = img.alt;
      lightbox.style.display = "flex";
    });
  });

  lightbox.addEventListener("click", ()=>{
    lightbox.style.display = "none";
  });
});
</script>
<body>

<header>
  <a href="index.php">← Povratak na početnu</a>
</header>

<main class="wrap">
<?php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$res = $conn->query("SELECT * FROM cities WHERE id=$id");
if ($row = $res->fetch_assoc()):
  $name = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
  $desc = nl2br(htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8'));
  $attr = nl2br(htmlspecialchars($row['attractions'], ENT_QUOTES, 'UTF-8'));
  $img  = htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8');

  $images = [];
  $gres = $conn->query("SELECT image, COALESCE(alt_text,'') AS alt_text FROM city_images WHERE city_id=$id");
  if ($gres) { while($g = $gres->fetch_assoc()){ $images[] = $g; } }
?>
  <section class="hero-card">
    <img class="hero-img" src="assets/images/<?= $img ?>" alt="<?= $name ?>">
    <h1><?= $name ?></h1>
    <p class="lead"><?= $desc ?></p>
  </section>

  <section class="content">
    <article class="card">
      <h3>Što raditi ovdje</h3>
      <p><?= $attr ?></p>
      <a class="back" href="index.php">← Natrag</a>
    </article>

    <aside class="card">
      <h3>Galerija</h3>
      <?php if (count($images)): ?>
        <div class="gallery">
          <?php foreach ($images as $gi): 
            $gimg = htmlspecialchars($gi['image'], ENT_QUOTES, 'UTF-8');
            $alt  = htmlspecialchars($gi['alt_text'], ENT_QUOTES, 'UTF-8');
          ?>
            <div class="gitem">
              <img class="gimg" src="assets/images/<?= $gimg ?>" alt="<?= $alt ?: $name ?>">
              <?php if($alt): ?><div class="gcap"><?= $alt ?></div><?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <p>Galerija za ovu lokaciju još nije dodana.</p>
      <?php endif; ?>
    </aside>


<?php else: ?>
  <p>Lokacija nije pronađena.</p>
  <a class="back" href="index.php">← Natrag</a>
<?php endif; ?>
</main>

</body>
</html>

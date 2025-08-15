<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <title>Plan puta</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    :root{ --bg:#fdf6ec; --card:#fff; --text:#333; --muted:#666; --brand:#3A9679; --brand-dark:#2d7a60; --shadow:0 8px 20px rgba(0,0,0,.08); --maxw:720px; --radius:14px;}
    html,body{margin:0;background:var(--bg);color:var(--text);font-family:system-ui,-apple-system,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans","Liberation Sans",sans-serif}
    header{background:#1A5F7A; color:#fff; padding:18px 20px}
    header a{color:#fff; text-decoration:none; opacity:.9}
    header a:hover{opacity:1}
    .wrap{max-width:var(--maxw); margin: 26px auto 60px; padding: 0 20px;}
    .card{background:var(--card); border-radius:var(--radius); box-shadow:var(--shadow); padding:20px;}
    h1{font-size: clamp(22px,3vw,28px); margin:0 0 14px}
    label{display:block; margin-top:12px; font-weight:600}
    input[type="text"], input[type="number"], textarea{
      width:100%; padding:10px; border-radius:10px; border:1px solid #ddd; margin-top:6px; font:inherit;
    }
    .checks{display:grid; grid-template-columns: repeat(2, 1fr); gap:6px 14px; margin-top:6px}
    .btn{margin-top:16px; background:var(--brand); color:#fff; padding:12px 16px; border:none; border-radius:10px; cursor:pointer; font-weight:700}
    .btn:hover{background:var(--brand-dark)}
    .alert{margin-bottom:14px; padding:12px; border-radius:10px}
    .ok{background:#d4edda; color:#155724}
    .err{background:#fde2e2; color:#7c1d1d}
  </style>
</head>
<body>

<header>
  <a href="index.php">← Natrag na početnu</a>
</header>

<main class="wrap">
  <div class="card">
    <h1>Kreiraj svoj plan puta</h1>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $conn->real_escape_string(trim($_POST['name'] ?? ''));
        $locs = isset($_POST['locations']) ? $_POST['locations'] : [];
        $locations = $conn->real_escape_string(implode(", ", $locs));
        $days = intval($_POST['days'] ?? 0);
        $comment = $conn->real_escape_string(trim($_POST['comment'] ?? ''));

        if ($name && $locations && $days > 0) {
            $conn->query("INSERT INTO plans (name, locations, days, comment) VALUES ('$name', '$locations', $days, '$comment')");
            echo '<div class="alert ok">Plan je uspješno spremljen! Hvala.</div>';
        } else {
            echo '<div class="alert err">Molimo popunite sva obavezna polja (ime, barem jedna lokacija i broj dana &gt; 0).</div>';
        }
    }
    ?>

    <form method="post">
      <label for="name">Vaše ime</label>
      <input type="text" id="name" name="name" required>

      <label>Odaberite lokacije</label>
      <div class="checks">
        <label><input type="checkbox" name="locations[]" value="Rovinj"> Rovinj</label>
        <label><input type="checkbox" name="locations[]" value="Pula Arena"> Pula Arena</label>
        <label><input type="checkbox" name="locations[]" value="Brijuni"> Brijuni</label>
        <label><input type="checkbox" name="locations[]" value="Motovun"> Motovun</label>
        <label><input type="checkbox" name="locations[]" value="Poreč"> Poreč</label>
        <label><input type="checkbox" name="locations[]" value="Rt Kamenjak"> Rt Kamenjak</label>
      </div>

      <label for="days">Broj dana</label>
      <input type="number" id="days" name="days" min="1" required>

      <label for="comment">Dodatne napomene</label>
      <textarea id="comment" name="comment" rows="4"></textarea>

      <button class="btn" type="submit">Spremi plan</button>
    </form>
  </div>
</main>

</body>
</html>

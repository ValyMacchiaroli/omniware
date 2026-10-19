<?php

  function getConnessione(): PDO

  {
      $host       = 'database';
      $utente     = 'phpmyadmin';
      $pwd        = 'Debian';
      $dbname     = 'catalogo';
      $charset    = 'utf8mb4';

      $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
 
      $opzioni = [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          PDO::ATTR_EMULATE_PREPARES => false,
      ];
 
      try {
          return new PDO($dsn, $utente, $pwd, $opzioni);
      } catch (PDOException $e) {
          error_log('Errore di connessione ' . $e->getMessage());
          die('Riprovare più tardi ' . $e->getMessage());
      }

  }
 
  $pdo = getConnessione();

  $stmt = $pdo->query('SELECT * FROM prodotti ORDER BY id');

  $prodotti = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="it">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>OmniWare — AI E-Commerce</title>
<!-- BOOTSTRAP 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- BOOTSTRAP ICONS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<!-- IL NOSTRO FILE CSS PERSONALIZZATO -->
<link rel="stylesheet" href="style.css">
</head>
<body>
<!-- NAVBAR -->
<nav class="navbar bg-white border-bottom py-3">
<div class="container d-flex justify-content-between align-items-center">
<!-- LOGO -->
<span class="fw-bold fs-5"><i class="bi bi-cpu text-primary"></i> OmniWare</span>
 
      <!-- AZIONI UTENTE -->
<div class="d-flex align-items-center gap-3">
<!-- ICONA CARRELLO -->
<a href="#" class="nav-icon-link text-dark text-decoration-none" title="Carrello">
<i class="bi bi-cart3 custom-cart-icon"></i>
</a>
 
        <!-- ICONA UTENTE / ACCESSO -->
<a href="#" class="nav-icon-link text-dark text-decoration-none" title="Accedi">
<i class="bi bi-person custom-user-icon"></i>
</a>
 
        <!-- BADGE PROJECT WORK -->
<span class="badge bg-light text-dark border ms-2">Project Work</span>
</div>
</div>
</nav>
<!-- HERO SECTION / RICERCA AI -->
<section class="hero-section text-center py-5 px-3">
<div class="container">
<h1 class="fw-bold display-6 d-flex align-items-center justify-content-center gap-2 flex-wrap">
<span>Cosa stai cercando oggi?</span>
<span class="badge bg-primary-subtle text-primary border border-primary-subtle fs-6 rounded-pill fw-normal align-middle">
<i class="bi bi-stars"></i> AI Search
</span>
</h1>
<p class="text-muted fs-6">Descrivi le tue necessità in linguaggio naturale. L'IA troverà i dispositivi ideali per te.</p>
<div class="search-container mx-auto mt-4">
<form action="#" method="GET">
<!-- CASTELLO DI RICERCA AI -->
<div class="search-group mb-2 d-flex align-items-start p-3">
<i class="bi bi-stars search-icon me-3 mt-1 fs-5 text-primary"></i>
<textarea

              class="form-control search-textarea border-0 shadow-none bg-transparent p-0 fs-6"

              rows="2"

              placeholder="Es. Cerco un tablet per prendere appunti all'università, leggero e con penna inclusa..."

              required></textarea>
</div>
<!-- CHIP PROMPT AI SUGGERITI -->
<div class="d-flex flex-wrap justify-content-center gap-2 mb-4">
<span class="small text-muted align-self-center me-1">Prova a chiedere:</span>
<button type="button" class="btn btn-sm ai-chip">
<i class="bi bi-laptop me-1 text-primary"></i> Laptop per università under 800€
</button>
<button type="button" class="btn btn-sm ai-chip">
<i class="bi bi-camera me-1 text-primary"></i> Smartphone per foto notturne
</button>
<button type="button" class="btn btn-sm ai-chip">
<i class="bi bi-headphones me-1 text-primary"></i> Cuffie con noise-cancelling
</button>
</div>
 
          <div class="d-flex justify-content-center">
<button type="submit" class="btn btn-primary search-btn px-4 py-2 fw-semibold d-inline-flex align-items-center gap-2">
<i class="bi bi-magic"></i>
<span>Analizza e Cerca</span>
</button>
</div>
</form>
</div>
</div>
</section>
 
  <!-- CATALOGO PRODOTTI DINAMICO DAL DATABASE -->
<main class="container my-4">
<div class="alert alert-primary border-0 rounded-4 p-4 mb-5 shadow-sm ai-response-box">
<div class="d-flex align-items-center gap-2 mb-2 text-primary fw-bold">
<i class="bi bi-stars fs-5"></i>
<span>Suggerimenti dell'Assistente AI OmniWare</span>
</div>
<p class="mb-0 text-dark small">

       In base alla tua ricerca, abbiamo selezionato i dispositivi direttamente dal nostro database in tempo reale.
</p>
</div>
 
    <section class="mb-5">
<div class="h5 fw-bold mb-4 d-flex align-items-center gap-2">
<i class="bi bi-fire text-danger"></i>
<span>Catalogo Prodotti (Database)</span>
</div>
 
      <div class="row g-4">
<?php if (empty($prodotti)): ?>
<div class="col-12">
<p class="text-muted">Nessun prodotto trovato nel database. Esegui lo script di popolamento per aggiungere articoli.</p>
</div>
<?php else: ?>
<?php for ($i=0;$i<3;$i++): ?>
<div class="col-md-4">
<div class="card product-card p-3 h-100">
<div class="mb-2">
</div>
<div class="product-img-box text-center">
<img src="<?= htmlspecialchars($prodotti[$i]['image'] ?? 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=500&auto=format&fit=crop&q=80') ?>" class="product-img img-fluid" alt="<?= htmlspecialchars($prodotto['nome']) ?>" style="max-height: 180px; object-fit: contain;">
</div>
<div class="card-body p-0 d-flex flex-column mt-3">
<h6 class="fw-bold mb-2"><?= htmlspecialchars($prodotti[$i]['nome']) ?></h6>
<p class="text-primary fw-bold mb-2">€ <?= number_format($prodotti[$i]['prezzo'], 2, ',', '.') ?></p>
<div class="mb-3 small text-muted">
<?= htmlspecialchars($prodotti[$i]['specifiche'] ?? '') ?>
</div>
</div>
</div>
</div>
<?php endfor; ?>
<?php endif; ?>
</div>
</section>
</main>
 
  <!-- FOOTER -->
<footer class="text-center py-4 text-muted border-top bg-white mt-5">
<p class="small mb-0">Project Work — Eleonora Giuliani, Eros Ibarra, Alexander Santagati, Valy Macchiaroli</p>
</footer>
 
</body>
</html>
 
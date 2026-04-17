<?php
// ─────────────────────────────────────────────
//  Ejercicio #27 – Menú PHP (ejercicios 21–26)
//  Programación del lado del servidor
// ─────────────────────────────────────────────

// Ejercicio activo (por defecto: ninguno)
$ejercicio = isset($_GET['ej']) ? (int)$_GET['ej'] : 0;

// ── Lógica PHP de cada ejercicio ──────────────

// Ej 21 – Operaciones aritméticas
$res21 = '';
if ($ejercicio === 21 && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $a  = isset($_POST['a']) ? (float)$_POST['a'] : 0;
    $b  = isset($_POST['b']) ? (float)$_POST['b'] : 0;
    $op = $_POST['operacion'] ?? '';

    switch ($op) {
        case 'sumar':    $res21 = "Resultado: " . ($a + $b); break;
        case 'restar':   $res21 = "Resultado: " . ($a - $b); break;
        case 'dividir':
            $res21 = ($b == 0) ? "Error: división entre 0" : "Resultado: " . ($a / $b);
            break;
        case 'potencia': $res21 = "Resultado: " . ($a ** $b); break;
        default:         $res21 = "Selecciona una operación.";
    }
}

// Ej 22 – Fórmula general
$res22 = '';
if ($ejercicio === 22 && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = isset($_POST['a']) ? (float)$_POST['a'] : null;
    $b = isset($_POST['b']) ? (float)$_POST['b'] : null;
    $c = isset($_POST['c']) ? (float)$_POST['c'] : null;

    if ($a === null || $b === null || $c === null) {
        $res22 = "Ingresa todos los valores.";
    } elseif ($a == 0) {
        $res22 = "El valor de 'a' no puede ser 0.";
    } else {
        $discriminante = ($b * $b) - (4 * $a * $c);
        if ($discriminante < 0) {
            $res22 = "No hay soluciones reales.";
        } else {
            $x1 = (-$b + sqrt($discriminante)) / (2 * $a);
            $x2 = (-$b - sqrt($discriminante)) / (2 * $a);
            $res22 = "x1 = $x1 &nbsp;|&nbsp; x2 = $x2";
        }
    }
}

// Ej 23 – IMC
$res23 = '';
if ($ejercicio === 23 && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $peso   = isset($_POST['peso'])   ? (float)$_POST['peso']   : null;
    $altura = isset($_POST['altura']) ? (float)$_POST['altura'] : null;

    if ($peso === null || $altura === null) {
        $res23 = "Ingresa todos los datos.";
    } elseif ($altura <= 0) {
        $res23 = "Altura inválida.";
    } else {
        $imc = $peso / ($altura * $altura);
        if      ($imc < 18.5) $grado = "Bajo peso";
        elseif  ($imc < 25)   $grado = "Normal";
        elseif  ($imc < 30)   $grado = "Sobrepeso";
        elseif  ($imc < 35)   $grado = "Obesidad grado I";
        elseif  ($imc < 40)   $grado = "Obesidad grado II";
        else                  $grado = "Obesidad grado III";
        $res23 = "IMC: " . number_format($imc, 2) . " &nbsp;|&nbsp; Clasificación: $grado";
    }
}

// Ej 24 – Fecha actual con switch
$res24 = '';
if ($ejercicio === 24) {
    $diasSemana = ['domingo','lunes','martes','miércoles','jueves','viernes','sábado'];
    $meses      = ['enero','febrero','marzo','abril','mayo','junio',
                   'julio','agosto','septiembre','octubre','noviembre','diciembre'];

    $diaNombre = $diasSemana[(int)date('w')];
    $mesNombre = $meses[(int)date('n') - 1];
    $diaMes    = date('j');
    $anio      = date('Y');

    $res24 = "Hoy es <strong>$diaNombre $diaMes de $mesNombre del año $anio</strong>";
}

// Ej 25 – Tablas del 1 al 10
$res25 = '';
if ($ejercicio === 25) {
    for ($i = 1; $i <= 10; $i++) {
        $res25 .= "<div class='tabla'><h4>Tabla del $i</h4>";
        for ($j = 1; $j <= 10; $j++) {
            $res25 .= "$i × $j = " . ($i * $j) . "<br>";
        }
        $res25 .= "</div>";
    }
}

// Ej 26 – Tablas dinámicas
$res26 = '';
if ($ejercicio === 26 && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $num = isset($_POST['numero']) ? (int)$_POST['numero'] : 0;
    if ($num < 1) {
        $res26 = "Ingresa un número positivo mayor a 0.";
    } else {
        for ($i = 1; $i <= $num; $i++) {
            $res26 .= "<div class='tabla'><h4>Tabla del $i</h4>";
            for ($j = 1; $j <= 10; $j++) {
                $res26 .= "$i × $j = " . ($i * $j) . "<br>";
            }
            $res26 .= "</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ejercicio #27 – PHP</title>
  <style>
    /* ── Reset & base ── */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Segoe UI', sans-serif;
      font-size: 15px;
      background: #f4f4f2;
      color: #1a1a1a;
      min-height: 100vh;
    }

    /* ── Header ── */
    header {
      background: #1a1a1a;
      color: #fff;
      padding: 1.2rem 2rem;
    }
    header span {
      font-size: .75rem;
      color: #888;
      display: block;
      margin-bottom: .2rem;
      text-transform: uppercase;
      letter-spacing: .08em;
    }
    header h1 { font-size: 1.2rem; font-weight: 600; }

    /* ── Layout ── */
    .layout {
      display: flex;
      min-height: calc(100vh - 56px);
    }

    /* ── Menú lateral ── */
    nav {
      width: 210px;
      flex-shrink: 0;
      background: #fff;
      border-right: 1px solid #e0e0e0;
      padding: 1.5rem 0;
    }
    nav p {
      font-size: .7rem;
      text-transform: uppercase;
      letter-spacing: .08em;
      color: #999;
      padding: 0 1.2rem;
      margin-bottom: .8rem;
    }
    nav a {
      display: block;
      padding: .65rem 1.2rem;
      text-decoration: none;
      color: #333;
      font-size: .9rem;
      border-left: 3px solid transparent;
      transition: background .15s, border-color .15s;
    }
    nav a:hover            { background: #f4f4f2; }
    nav a.activo           { background: #f4f4f2; border-left-color: #1a1a1a; font-weight: 600; color: #1a1a1a; }

    /* ── Contenido ── */
    main {
      flex: 1;
      padding: 2rem;
      max-width: 700px;
    }

    .card {
      background: #fff;
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      padding: 1.8rem 2rem;
    }
    .card h2 {
      font-size: 1.05rem;
      font-weight: 600;
      margin-bottom: .4rem;
    }
    .card .desc {
      font-size: .82rem;
      color: #777;
      margin-bottom: 1.4rem;
      border-bottom: 1px solid #efefef;
      padding-bottom: 1rem;
    }

    /* ── Formularios ── */
    label { display: block; font-size: .82rem; color: #555; margin-bottom: .3rem; }

    input[type="number"],
    select {
      width: 100%;
      padding: .55rem .75rem;
      border: 1px solid #d0d0d0;
      border-radius: 5px;
      font-size: .9rem;
      background: #fafafa;
      margin-bottom: 1rem;
      outline: none;
      transition: border-color .15s;
    }
    input[type="number"]:focus,
    select:focus { border-color: #1a1a1a; background: #fff; }

    .fila { display: flex; gap: 1rem; }
    .fila > div { flex: 1; }

    button[type="submit"] {
      background: #1a1a1a;
      color: #fff;
      border: none;
      padding: .6rem 1.4rem;
      border-radius: 5px;
      font-size: .88rem;
      cursor: pointer;
      transition: background .15s;
    }
    button[type="submit"]:hover { background: #333; }

    /* ── Resultado ── */
    .resultado {
      margin-top: 1.2rem;
      background: #f4f4f2;
      border-left: 3px solid #1a1a1a;
      border-radius: 4px;
      padding: .85rem 1rem;
      font-size: .9rem;
      color: #1a1a1a;
    }

    /* ── Tablas de multiplicar ── */
    .tablas-grid {
      display: flex;
      flex-wrap: wrap;
      gap: .8rem;
      margin-top: 1rem;
    }
    .tabla {
      border: 1px solid #e0e0e0;
      border-radius: 6px;
      padding: .75rem 1rem;
      font-size: .8rem;
      line-height: 1.7;
      background: #fafafa;
      min-width: 130px;
    }
    .tabla h4 {
      font-size: .82rem;
      margin-bottom: .4rem;
      color: #333;
      border-bottom: 1px solid #efefef;
      padding-bottom: .3rem;
    }

    /* ── Pantalla de bienvenida ── */
    .bienvenida {
      color: #aaa;
      padding: 3rem 0;
      text-align: center;
      font-size: .9rem;
    }
    .bienvenida strong { color: #555; display: block; font-size: 1rem; margin-bottom: .4rem; }
  </style>
</head>
<body>

<header>
  <span>Ejercicio #27 · Programación Web · PHP</span>
  <h1>Menú de ejercicios – Lado del servidor</h1>
</header>

<div class="layout">

  <!-- Menú lateral -->
  <nav>
    <p>Ejercicios</p>
    <?php
    $menu = [
      21 => 'Ej. 21 – Operaciones',
      22 => 'Ej. 22 – Fórmula general',
      23 => 'Ej. 23 – IMC',
      24 => 'Ej. 24 – Fecha actual',
      25 => 'Ej. 25 – Tablas (1–10)',
      26 => 'Ej. 26 – Tablas dinámicas',
    ];
    foreach ($menu as $num => $titulo):
      $clase = ($ejercicio === $num) ? ' activo' : '';
    ?>
      <a href="?ej=<?= $num ?>" class="<?= $clase ?>"><?= $titulo ?></a>
    <?php endforeach; ?>
  </nav>

  <!-- Contenido principal -->
  <main>

    <?php if ($ejercicio === 0): ?>
      <div class="bienvenida">
        <strong>Selecciona un ejercicio del menú</strong>
        Cada uno usa PHP del lado del servidor.
      </div>

    <!-- ══════════════ EJERCICIO 21 ══════════════ -->
    <?php elseif ($ejercicio === 21): ?>
      <div class="card">
        <h2>Ejercicio #21 – Operaciones aritméticas</h2>
        <p class="desc">Ingresa dos valores, elige la operación y el servidor PHP calcula el resultado.</p>
        <form method="POST" action="?ej=21">
          <div class="fila">
            <div>
              <label>Valor A</label>
              <input type="number" name="a" step="any" value="<?= htmlspecialchars($_POST['a'] ?? '') ?>">
            </div>
            <div>
              <label>Valor B</label>
              <input type="number" name="b" step="any" value="<?= htmlspecialchars($_POST['b'] ?? '') ?>">
            </div>
          </div>
          <label>Operación</label>
          <select name="operacion">
            <option value="sumar">Sumar</option>
            <option value="restar">Restar</option>
            <option value="dividir">Dividir</option>
            <option value="potencia">Exponenciación</option>
          </select>
          <button type="submit">Calcular</button>
        </form>
        <?php if ($res21): ?><div class="resultado"><?= $res21 ?></div><?php endif; ?>
      </div>

    <!-- ══════════════ EJERCICIO 22 ══════════════ -->
    <?php elseif ($ejercicio === 22): ?>
      <div class="card">
        <h2>Ejercicio #22 – Fórmula general</h2>
        <p class="desc">Resuelve ecuaciones cuadráticas: ax² + bx + c = 0</p>
        <form method="POST" action="?ej=22">
          <div class="fila">
            <div>
              <label>Valor de a</label>
              <input type="number" name="a" step="any" value="<?= htmlspecialchars($_POST['a'] ?? '') ?>">
            </div>
            <div>
              <label>Valor de b</label>
              <input type="number" name="b" step="any" value="<?= htmlspecialchars($_POST['b'] ?? '') ?>">
            </div>
            <div>
              <label>Valor de c</label>
              <input type="number" name="c" step="any" value="<?= htmlspecialchars($_POST['c'] ?? '') ?>">
            </div>
          </div>
          <button type="submit">Calcular</button>
        </form>
        <?php if ($res22): ?><div class="resultado"><?= $res22 ?></div><?php endif; ?>
      </div>

    <!-- ══════════════ EJERCICIO 23 ══════════════ -->
    <?php elseif ($ejercicio === 23): ?>
      <div class="card">
        <h2>Ejercicio #23 – Cálculo de IMC</h2>
        <p class="desc">Calcula el Índice de Masa Corporal y su clasificación.</p>
        <form method="POST" action="?ej=23">
          <div class="fila">
            <div>
              <label>Peso (kg)</label>
              <input type="number" name="peso" step="any" value="<?= htmlspecialchars($_POST['peso'] ?? '') ?>">
            </div>
            <div>
              <label>Altura (m)</label>
              <input type="number" name="altura" step="any" value="<?= htmlspecialchars($_POST['altura'] ?? '') ?>">
            </div>
          </div>
          <button type="submit">Calcular IMC</button>
        </form>
        <?php if ($res23): ?><div class="resultado"><?= $res23 ?></div><?php endif; ?>
      </div>

    <!-- ══════════════ EJERCICIO 24 ══════════════ -->
    <?php elseif ($ejercicio === 24): ?>
      <div class="card">
        <h2>Ejercicio #24 – Fecha actual</h2>
        <p class="desc">PHP obtiene la fecha del servidor y la muestra en texto usando arrays (equivalente al switch de JS).</p>
        <div class="resultado"><?= $res24 ?></div>
      </div>

    <!-- ══════════════ EJERCICIO 25 ══════════════ -->
    <?php elseif ($ejercicio === 25): ?>
      <div class="card">
        <h2>Ejercicio #25 – Tablas del 1 al 10</h2>
        <p class="desc">PHP genera con bucles <code>for</code> las tablas de multiplicar del 1 al 10.</p>
        <div class="tablas-grid">
          <?= $res25 ?>
        </div>
      </div>

    <!-- ══════════════ EJERCICIO 26 ══════════════ -->
    <?php elseif ($ejercicio === 26): ?>
      <div class="card">
        <h2>Ejercicio #26 – Tablas dinámicas</h2>
        <p class="desc">Indica cuántas tablas quieres generar y PHP las crea con bucles.</p>
        <form method="POST" action="?ej=26">
          <label>¿Cuántas tablas? (número positivo)</label>
          <input type="number" name="numero" min="1" value="<?= htmlspecialchars($_POST['numero'] ?? '') ?>">
          <button type="submit">Generar tablas</button>
        </form>
        <?php if (is_string($res26) && !str_contains($res26, '<div')): ?>
          <div class="resultado"><?= $res26 ?></div>
        <?php elseif ($res26): ?>
          <div class="tablas-grid"><?= $res26 ?></div>
        <?php endif; ?>
      </div>

    <?php endif; ?>

  </main>
</div>

</body>
</html>

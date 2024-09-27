<?php
session_start();

// Destruir todas las variables de sesión.
$_SESSION = array();

// Si se desea destruir la cookie de la sesión.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destruir la sesión.
session_destroy();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerrar sesión</title>
    <style>
        *,
        *:after,
        *:before {
          box-sizing: border-box;
          transform-style: preserve-3d;
          touch-action: none;
        }

        :root {
          --rotation-y: 0;
          --rotation-x: 0;
          --size: 80vmin;
          --segment: calc(var(--size) / 100);
          --loading-speed: 10s;
          --color: hsl(127 89% 50%);
          --total-length: 400;
          --segments-per-second: calc(var(--loading-speed) / var(--total-length));
        }

        body {
          display: grid;
          place-items: center;
          min-height: 100vh;
          background: hsl(0 0% 90%);
          font-family: "Google Sans", sans-serif, system-ui;
          margin: 0;
          padding: 0;
        }

        #flip:checked ~ .container {
          --rotation-y: -24;
          --rotation-x: -24;
        }

        [for] {
          transform: translateZ(200vmin);
          position: fixed;
          inset: 0;
        }

        .sr-only {
          position: absolute;
          width: 1px;
          height: 1px;
          padding: 0;
          margin: -1px;
          overflow: hidden;
          clip: rect(0, 0, 0, 0);
          white-space: nowrap;
          border-width: 0;
        }

        .loading-label {
          position: absolute;
          left: 50%;
          bottom: 110%;
          transform: translateX(-50%);
          font-weight: bold;
          font-size: clamp(1rem, var(--size) * 0.025, 2rem);
          color: #333;
        }

        .container {
          width: var(--size);
          aspect-ratio: 16 / 1.25;
          position: relative;
        }

        .scene {
          height: 100%;
          width: 100%;
          transform: translate3d(0, 0, 100vmin)
            rotateX(calc(var(--rotation-y, 0) * 1deg))
            rotateY(calc(var(--rotation-x, 0) * 1deg));
          transition: transform 0.25s;
        }

        h1 {
          opacity: 0.8;
          color: var(--color);
          font-size: 2rem;
          position: fixed;
          top: 2rem;
          left: 50%;
          transform: translateX(-50%);
          margin: 0;
        }

        .bar {
          width: 100%;
          height: 100%;
          display: grid;
          grid-template-columns: var(--columns);
        }

        .bar__segment {
          background: hsl(0 0% 100%);
          transform: translateZ(calc(var(--depth) * var(--segment)));
          border: calc(var(--segment) * 0.5) solid black;
          position: relative;
          overflow: hidden;
        }

        .bar__segment:after {
          content: "";
          position: absolute;
          inset: 0;
          background: var(--color);
          transform-origin: 0 50%;
          animation-name: var(--name);
          animation-duration: var(--loading-speed);
          animation-fill-mode: both;
          animation-timing-function: linear;
          animation-iteration-count: infinite;
        }

        @keyframes reveal {
          from {
            transform: scaleX(0);
          }
        }

        .bar__segment:not(:first-of-type, :last-of-type) {
          border-left: transparent;
          border-right: transparent;
        }

        .bar__segment:first-of-type {
          border-right: transparent;
        }
        .bar__segment:last-of-type {
          border-left: transparent;
        }

        .bar__segment:not(.bar__segment--aligned) {
          width: calc(var(--segment) * var(--length));
          transform-origin: 0 50%;
          filter: brightness(0.78);
          transform: translateZ(calc(var(--depth) * var(--segment)))
            rotateY(var(--rotation, 0deg));
        }

        .bar__segment--front {
          --rotation: -90deg;
        }

        .bar__segment--back {
          --rotation: 90deg;
        }

        @keyframes segment-1 {
          0% {
            transform: scaleX(0);
          }
          5%,
          100% {
            transform: scaleX(1);
          }
        }
        @keyframes segment-2 {
          0%,
          5% {
            transform: scaleX(0);
          }
          12.5%,
          100% {
            transform: scaleX(1);
          }
        }
        @keyframes segment-3 {
          0%,
          12.5% {
            transform: scaleX(0);
          }
          15%,
          100% {
            transform: scaleX(1);
          }
        }
        @keyframes segment-4 {
          0%,
          15% {
            transform: scaleX(0);
          }
          27.5%,
          100% {
            transform: scaleX(1);
          }
        }
        @keyframes segment-5 {
          0%,
          27.5% {
            transform: scaleX(0);
          }
          30%,
          100% {
            transform: scaleX(1);
          }
        }
        @keyframes segment-6 {
          0%,
          30% {
            transform: scaleX(0);
          }
          45%,
          100% {
            transform: scaleX(1);
          }
        }
        @keyframes segment-7 {
          0%,
          45% {
            transform: scaleX(0);
          }
          47.5%,
          100% {
            transform: scaleX(1);
          }
        }
        @keyframes segment-8 {
          0%,
          47.5% {
            transform: scaleX(0);
          }
          65%,
          100% {
            transform: scaleX(1);
          }
        }
        @keyframes segment-9 {
          0%,
          65% {
            transform: scaleX(0);
          }
          70%,
          100% {
            transform: scaleX(1);
          }
        }
        @keyframes segment-10 {
          0%,
          70% {
            transform: scaleX(0);
          }
          82.5%,
          100% {
            transform: scaleX(1);
          }
        }
        @keyframes segment-11 {
          0%,
          82.5% {
            transform: scaleX(0);
          }
          90%,
          100% {
            transform: scaleX(1);
          }
        }
        @keyframes segment-12 {
          0%,
          90% {
            transform: scaleX(0);
          }
          95%,
          100% {
            transform: scaleX(1);
          }
        }
        @keyframes segment-13 {
          0%,
          95% {
            transform: scaleX(0);
          }
          100% {
            transform: scaleX(1);
          }
        }
    </style>
</head>
<body>
    <h1>Cerrando Sesión</h1>
    <div class="container" id="animation-container">
      <div class="scene">
        <span class="loading-label">Cargando...</span>
        <div class="bar" style="--columns: 20% 0 10% 0 10% 0 10% 0 20% 0 10% 0 20%; --total-length: 400;">
          <div style="--name:  segment-1; --delay:   0; --length: 20; --depth:   0;" class="bar__segment bar__segment--aligned"></div>
          <div style="--name:  segment-2; --delay:  20; --length: 30; --depth:   0;" class="bar__segment bar__segment--front"></div>
          <div style="--name:  segment-3; --delay:  50; --length: 10; --depth:  30;" class="bar__segment bar__segment--aligned"></div>
          <div style="--name:  segment-4; --delay:  60; --length: 50; --depth:  30;" class="bar__segment bar__segment--back"></div>
          <div style="--name:  segment-5; --delay: 110; --length: 10; --depth: -20;" class="bar__segment bar__segment--aligned"></div>
          <div style="--name:  segment-6; --delay: 120; --length: 60; --depth: -20;" class="bar__segment bar__segment--front"></div>
          <div style="--name:  segment-7; --delay: 180; --length: 10; --depth:  40;" class="bar__segment bar__segment--aligned"></div>
          <div style="--name:  segment-8; --delay: 190; --length: 70; --depth:  40;" class="bar__segment bar__segment--back"></div>
          <div style="--name:  segment-9; --delay: 260; --length: 20; --depth: -30;" class="bar__segment bar__segment--aligned"></div>
          <div style="--name: segment-10; --delay: 280; --length: 50; --depth: -30;" class="bar__segment bar__segment--front"></div>
          <div style="--name: segment-11; --delay: 330; --length: 30; --depth:  20;" class="bar__segment bar__segment--aligned"></div>
          <div style="--name: segment-12; --delay: 360; --length: 20; --depth:  20;" class="bar__segment bar__segment--back"></div>
          <div style="--name: segment-13; --delay: 380; --length: 20; --depth:   0;" class="bar__segment bar__segment--aligned"></div>
        </div>
      </div>
    </div>

    <script>
        // Duración de la animación en milisegundos
        const animationDuration = 9995; // 10 segundos

        // Redirigir al usuario después de que termine la animación
        setTimeout(() => {
            window.location.href = 'inicio.html';
        }, animationDuration);
    </script>
</body>
</html>

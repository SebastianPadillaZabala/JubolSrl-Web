<!-- component -->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@900&family=Satisfy&display=swap" rel="stylesheet" />
<script src="https://cdn.tailwindcss.com"></script>
<style>
    html {
        font-family: 'Inter', sans-serif;
    }

    /* GTA Text */
    main .title {
        text-shadow: 0 0 0.125em rgb(192 38 211 / 0.5), 0 0 0.45em currentColor;
    }

    /* Vice City Text */
    main .cursive {
        font-family: 'Satisfy', cursive;
        text-shadow: 0 0 0.125em rgb(192 38 211 / 0.5), 0 0 0.45em currentColor;
    }

    /* Reflection Color */
    main #main_container::before {
        content: "";
        width: 100%;
        height: 100%;
        top: 120%;
        left: 0;
        position: absolute;
        transform: perspective(1em) rotateX(40deg) scale(1, 0.35);
    }
</style>
<main class="grid min-h-screen place-content-center place-items-center overflow-hidden bg-gradient-to-b from-slate-900 to-black">
    <!-- 
    This is using Tailwind CSS "before:"
    you can directly place it in CSS
    but I prefer to do that in here, to so I can use bg-gradient too
  -->
    <div id="main_container" class="relative grid place-content-center place-items-center gap-2 before:bg-gradient-to-t before:from-teal-500/70 before:via-fuchsia-600 before:to-transparent before:blur-xl before:filter">
        <h1 class="title text-6xl font-black text-teal-500">GTA</h1>
        <h2 class="cursive text-6xl font-thin text-fuchsia-600">Vice City</h2>
    </div>
</main>
<!-- 
    Inspiried by Kevin Powell
    https://www.youtube.com/watch?v=6xNcXwC6ikQ
 -->
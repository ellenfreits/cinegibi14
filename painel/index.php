<?php

include("../login/protect.php");

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Painel - CineGibi</title>

    <link rel="stylesheet" href="painel.css">

</head>

<body>

    <header>

        <h1>🎬 CineGibi</h1>

        <a href="../login/logout.php" class="btn-sair">
            Sair
        </a>

    </header>

    <main>

        <div class="boas-vindas">

        <h2>
            ⭐ Painel Administrativo ⭐
        </h2>

        <p>
             Bem-vindo(a) ao CineGibi!
        </p>

            <p>
                Sistema Administrativo do CineGibi
            </p>

        </div>

        <section class="cards">

            <a href="../filmes/listar.php" class="card">

                <span class="icone">🎬</span>

                <h3>Filmes</h3>

                <p>
                    Gerenciar filmes cadastrados.
                </p>

            </a>

            <a href="../sessoes/listar.php" class="card">

                <span class="icone">🕒</span>

                <h3>Sessões</h3>

                <p>
                    Gerenciar horários e salas.
                </p>

            </a>

            <a href="../ingresso/listar.php" class="card">

                <span class="icone">🎟️</span>

                <h3>Ingressos</h3>

                <p>
                    Gerenciar ingressos disponíveis.
                </p>

            </a>

        </section>

    </main>

</body>

</html>
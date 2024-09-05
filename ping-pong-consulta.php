<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de partidas jogadas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            border: 1px solid #ddd;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: red;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .connection-status {
            text-align: center;
            margin: 20px;
            font-weight: bold;
            color: #4CAF50;
        }
        .menu-button {
            padding: 5px 10px;
            border: none;
            background: none;
            cursor: pointer;
            font-size: 18px;
            position: relative;
        }
        .menu-button::before {
            content: '\2022 \2022 \2022';
            color: black;
        }
        .actions {
            display: none;
            flex-direction: column;
            position: absolute;
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            z-index: 1000;
            width: 120px;
        }
        .actions button {
            padding: 15px 20px;
            border: none;
            border-bottom: 1px solid #ddd;
            cursor: pointer;
            text-align: left;
        }
        .actions button:last-child {
            border-bottom: none;
        }
        .actions button:hover {
            opacity: 0.8;
        }
        .delete {
            background-color: #e74c3c; /* Vermelho */
            color: white;
        }
        .share {
            background-color: #3498db; /* Azul */
            color: white;
        }
        .favorite-star {
            color: gold;
            font-size: 20px;
            cursor: pointer;
        }
        .favorite-star.favorited {
            color: gold;
        }
        .favorite-star:not(.favorited) {
            color: gray;
        }
    </style>
    <script>
        function toggleActions(id, event) {
            var actions = document.getElementById('actions-' + id);
            var rect = event.target.getBoundingClientRect();
            actions.style.display = 'flex';
            actions.style.left = rect.right + 'px';
            actions.style.top = rect.top + 'px';
        }

        function share(row) {
            alert('Compartilhar: ' + row);
        }

        function toggleFavorite(id, element) {
            var isFavorited = element.classList.contains('favorited');
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'favorite.php?id=' + id + '&action=' + (isFavorited ? 'remove' : 'add'), true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    element.classList.toggle('favorited');
                } else {
                    alert('Erro ao atualizar favorito: ' + xhr.statusText);
                }
            };
            xhr.send();
        }

        function deleteRow(id) {
            if (confirm('Tem certeza que deseja apagar este registro?')) {
                window.location.href = 'delete.php?id=' + id;
            }
        }

        // Fecha o menu se clicar fora dele
        window.onclick = function(event) {
            if (!event.target.matches('.menu-button')) {
                var dropdowns = document.getElementsByClassName("actions");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.style.display === 'flex') {
                        openDropdown.style.display = 'none';
                    }
                }
            }
        }
    </script>
</head>
<body>
    <h1>Histórico de Partidas Jogadas</h1>
    
    <?php
        $host = "localhost";
        $db_user = "root";
        $db_password = "senai";
        $db_name = "pingpong";

        $conn = new mysqli($host, $db_user, $db_password, $db_name);

        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        } else {
            echo "<div class='connection-status'>Conexão bem-sucedida!</div>";
        }

        $sql = "SELECT * FROM historico";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>Jogador 1</th>
                        <th>Pontos Jogador 1</th>
                        <th>Jogador 2</th>
                        <th>Pontos Jogador 2</th>
                        <th>Round</th>
                        <th>Ações</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['player1Name'] . " <span class='favorite-star " . ($row['favorite'] ? "favorited" : "") . "' onclick='toggleFavorite(" . $row['id'] . ", this)'>★</span></td>
                        <td>" . $row['ponto1'] . "</td>
                        <td>" . $row['player2Name'] . " <span class='favorite-star " . ($row['favorite'] ? "favorited" : "") . "' onclick='toggleFavorite(" . $row['id'] . ", this)'>★</span></td>
                        <td>" . $row['ponto2'] . "</td>
                        <td>" . $row['raund'] . "</td>
                        <td>
                            <button class='menu-button' onclick='toggleActions(" . $row['id'] . ", event)'></button>
                            <div class='actions' id='actions-" . $row['id'] . "'>
                                <button class='share' onclick='share(" . $row['id'] . ")'>Compartilhar</button>
                                <button class='delete' onclick='deleteRow(" . $row['id'] . ")'>Apagar</button>
                            </div>
                        </td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p style='text-align:center;'>Nenhum histórico encontrado.</p>";
        }

        $conn->close();
    ?>
</body>
</html>

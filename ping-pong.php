<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet">
<title>Contador de Pontos</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #0f0c16
    }
    p {
        font-family: 'VT323', monospace;
        font-size: 45px;
        color: #fff;
    }
    .forms {
        display: flex;
    }
    .ping1{
        top: 0;
        left: 0;
        margin: 0;
        padding: 10px;
        box-shadow: 0 2px 4px rgba(244, 242, 242, 0.912); 
        font-size: 30px;  
        color: white;
        text-align: center;
        font-family: 'VT323', monospace;
    }
    .ping {
        top: 0;
        left: 0;
        margin: 0;
        
        box-shadow: 0 2px 4px rgba(244, 242, 242, 0.912); 
        font-size: 65px;  
        color: white;
        text-align: center;
        font-family: 'VT323', monospace;
    }
    .tudo {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 90vh;
    }
    .container {
        text-align: center;
        width: 600px;
        background-color: #1d212b;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 10px;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
    }
    .score-container {
        flex: 1;
        text-align: center;
    }
    .score {
        font-size: 72px;
        margin: 20px 0;
        color: #4ab0b6;
    }
    .btnedit1, .btnedit2 {
        padding: 10px 15px;
        font-size: 10px;
        cursor: pointer;
        background-color: #3d3a3a;
        color: #fff;
        border-radius: 5px;
    }
    .btnedit1 {
        margin-right: 210px;
    }
    .btnedit2 {
        margin-left: 210px;
    }
    .btn-Pl1, .btn-Pl2, .btnmorePL1, .btnmorePL2 {
        padding: 10px 20px;
        font-size: 16px;
        margin-top: 10px;
        cursor: pointer;
        color: #fff;
        border: none;
        border-radius: 5px;
    }
    .btn-Pl1, .btn-Pl2 {
        background-color: #993939;
    }
    .btnmorePL1, .btnmorePL2 {
        background-color: #9ab692;
    }
    .btn-Pl2:hover, .btn-Pl1:hover {
        background-color: #9a0000;
    }
    .btnmorePL2:hover, .btnmorePL1:hover {
        background: #49764e;
    }
    .raund {
        margin-top: 30px;
        font-size: 24px;
        color: #ffffff;
        text-align: center;
        width: 100%;
    }
    .reset-button, .historico, .salve {
        padding: 10px 20px;
        font-size: 16px;
        margin: 20px;
        cursor: pointer;
        background-color: #2c313f;
        color: #fff;
        border: none;
        border-radius: 5px;
    }
    .historico, .salve {
        width: 70%;
    }
    .historico:hover {
        background-color: #c82333;
    }
    .ponto1, .ponto2 {
        font-size: xx-large;
        color: white;
    }
    .vertical-line {
        margin-top: 15px;
        border-left: 3px solid #ffffff;;
        height: 300px;
    }
    .horizontal-line {
        border-top: 3px solid #ffffff;;
        width: 100%;
        margin-top: 10px;
        margin-left: 15px;
        margin-right: 15px;
    }
    .editing {
        background-color: #4ab0b6;
    }
</style>
</head>
<body>

<h1 class="ping">Ping - Pong</h1><h4 class="ping1">Luis - Enzo - Laryssa - Otavio</h4>

<div class="tudo">
    <div class="container"> 
        <div class="score-container">
            <button class="btnedit1" onclick="editar1Nome()">Editar</button>
            <div class="ponto1" id="ponto1">0</div>
            <p id="player1Name">Jogador 1</p>
            <div class="score" id="player1Score">0</div>
            <button class="btnmorePL1" onclick="incrementScore('player1Score', 'ponto1')">+</button>
            <button class="btn-Pl1" onclick="decrementScore('player1Score')">-</button>
        </div>
        <div class="vertical-line"></div>
        <div class="score-container">
            <button class="btnedit2" onclick="editar2Nome()">Editar</button>
            <div class="ponto2" id="ponto2">0</div>
            <p id="player2Name">Jogador 2</p>
            <div class="score" id="player2Score">0</div>
            <button class="btnmorePL2" onclick="incrementScore('player2Score', 'ponto2')">+</button>
            <button class="btn-Pl2" onclick="decrementScore('player2Score')">-</button>
        </div>
        <div class="horizontal-line"></div>
        <div class="raund" id="raund">Round: 1</div>
        <button class="reset-button" onclick="resetScores()">Zerar Placar</button>
        <form method="post" action="ping-pong-consulta.php">
            <button type="submit" name="historico" class="historico">Ver Historicos</button>
        </form>
        <form method="post" action="ping-pong.php" class="forms" id="salvarForm">
            <input type="hidden" name="player1Name" id="hiddenPlayer1Name">
            <input type="hidden" name="player1Score" id="hiddenPlayer1Score">
            <input type="hidden" name="player2Name" id="hiddenPlayer2Name">
            <input type="hidden" name="player2Score" id="hiddenPlayer2Score">
            <input type="hidden" name="raund" id="hiddenRound">
            <input type="hidden" name="ponto1" id="hiddenPonto1">
            <input type="hidden" name="ponto2" id="hiddenPonto2">
            <button type="submit" name="salve" class="salve">Salvar Historicos</button>
        </form>
    </div>
</div>

<script>
    let round = 1;

    function incrementScore(playerScoreId, playerPointId) {
        const scoreElement = document.getElementById(playerScoreId);
        const pointElement = document.getElementById(playerPointId);
        let score = parseInt(scoreElement.textContent);
        let point = parseInt(pointElement.textContent);
        scoreElement.textContent = ++score;

        if (score === 11) {
            scoreElement.textContent = 0;
            pointElement.textContent = ++point;
            score = 0;
            round++;
            document.getElementById('raund').textContent = `Round: ${round}`;
        }
    }
    function decrementScore(playerId) {
        const scoreElement = document.getElementById(playerId);
        let score = parseInt(scoreElement.textContent);
        if (score > 0) {
            scoreElement.textContent = --score;
        }
    }
    function resetScores() {
        document.getElementById('player1Score').textContent = '0';
        document.getElementById('player2Score').textContent = '0';
        document.getElementById('ponto1').textContent = '0';
        document.getElementById('ponto2').textContent = '0';
        round = 1;
        document.getElementById('raund').textContent = 'Round: 1';
    }
    function editar1Nome() {
        var novoNome = prompt("Digite o novo nome do jogador:");
        if (novoNome !== null && novoNome.trim() !== "") {
            document.getElementById("player1Name").textContent = novoNome;
        }
    }
    function editar2Nome() {
        var novo2Nome = prompt("Digite o novo nome do jogador:");
        if (novo2Nome !== null && novo2Nome.trim() !== "") {
            document.getElementById("player2Name").textContent = novo2Nome;
        }
    }
    document.getElementById('salvarForm').onsubmit = function() {
        document.getElementById('hiddenPlayer1Name').value = document.getElementById('player1Name').textContent;
        document.getElementById('hiddenPlayer1Score').value = document.getElementById('player1Score').textContent;
        document.getElementById('hiddenPlayer2Name').value = document.getElementById('player2Name').textContent;
        document.getElementById('hiddenPlayer2Score').value = document.getElementById('player2Score').textContent;
        document.getElementById('hiddenRound').value = round;
        document.getElementById('hiddenPonto1').value = document.getElementById('ponto1').textContent;
        document.getElementById('hiddenPonto2').value = document.getElementById('ponto2').textContent;
    };
</script>

<?php
if (isset($_POST['salve'])) {
    $servername = "localhost";
    $database = "pingpong";
    $username = "root";
    $password = "senai";

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }

    $ponto1 = mysqli_real_escape_string($conn, $_POST['ponto1']);
    $ponto2 = mysqli_real_escape_string($conn, $_POST['ponto2']);
    $player1Name = mysqli_real_escape_string($conn, $_POST['player1Name']);
    $player2Name = mysqli_real_escape_string($conn, $_POST['player2Name']);
    $round = mysqli_real_escape_string($conn, $_POST['raund']);

    $sql = "INSERT INTO historico (player1Name, player2Name, ponto1, ponto2, raund) 
            VALUES ('$player1Name', '$player2Name', '$ponto1', '$ponto2', '$round')";

    if (mysqli_query($conn, $sql)) {
        echo "Dados inseridos com sucesso!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

</body>
</html>

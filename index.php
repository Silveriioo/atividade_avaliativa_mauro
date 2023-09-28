<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="controller/script/script.js"></script>
    <title>Home Page</title>
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script src="controller/script/datatables.js"></script>

</head>

<body>
    <h1>Exemplo de Fila em PHP e MySQL</h1>

    <form id="formAdd" method="POST"">
        <label for=" data">Item para adicionar à fila:</label>
        <input type="text" name="data" id="Add">
        <button type="submit" name="add">Adicionar à Fila</button>
    </form>

    <br>

    <form id="formRemove" method="POST">
        <input type="submit" value="Esvaziar Fila" id="remover">
    </form>

    <br>

    <?php
    include_once('controller/utils/functions.php');

    graphItem();
    ?>

</body>

</html>
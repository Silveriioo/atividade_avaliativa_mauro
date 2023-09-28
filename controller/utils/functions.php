<?php

function connection()
{
    $hostname = "127.0.0.1";
    $username = "root";
    $password = "";
    $database = "mauro";

    $conn = mysqli_connect($hostname, $username, $password, $database);

    if ($conn->connect_errno) {
        die('Falha na conexão' . $conn->connect_errno);
    }

    return $conn;
}

function preencherFila()
{

    global $conn;
    $conn = connection();

    $data = $_POST["adicionar"];
    $sql = "INSERT INTO queue (data) VALUES ('$data')";

    if ($conn->query($sql) === TRUE) {
        // echo "Item adicionado à fila: $data";
        echo json_encode(['success' => true, 'item' => $data]);
    } else {
        // echo "Erro ao adicionar item à fila: " . $conn->error;
        echo json_encode(['success' => false, 'item' => $data]);
    }

    $conn->close();
}

function esvaziarFila()
{
    global $conn;
    $conn = connection();

    $sql = "SELECT * FROM queue";
    $result = $conn->query($sql);

    $response = array();

    if ($result->num_rows > 0) {
        $response['success'] = true;
        $response['items'] = array();

        while ($row = $result->fetch_assoc()) {
            $item = array(
                'ID' => $row["id"],
                'Data' => $row["data"]
            );
            $response['items'][] = $item;
        }

        $conn->query("TRUNCATE TABLE queue");
    } else {
        $response['success'] = false;
    }

    $conn->close();

    echo json_encode($response);
}

// function graphItem() {

//     global $conn;
//     $conn = connection();


// }

// function tabelaDatabase() {
//     $html = "    <table id='myTable' class='display'>
//     <thead>
//         <tr>
//             <th>ID</th>
//             <th>Data</th>
//         </tr>
//     </thead>
//     <tbody>
//         <tr>
//             <td>Row 1 Data 1</td>
//             <td>Row 1 Data 2</td>
//         </tr>
//         <tr>
//             <td>Row 2 Data 1</td>
//             <td>Row 2 Data 2</td>
//         </tr>
//     </tbody>
// </table>
// ";
// }

function tabelaDatabase()
{
    global $conn;
    $conn = connection();

    $html = "<table id='myTable' class='display'>
    <thead>
        <tr>
            <th>ID</th>
            <th>Data</th>
        </tr>
    </thead>
    <tbody>";

    $sql = "SELECT id, data FROM mauro.queue"; 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $html .= "<tr>";
            $html .= "<td>" . $row["id"] . "</td>";
            $html .= "<td>" . $row["data"] . "</td>";
            $html .= "</tr>";
        }
    } else {
        $html .= "<tr><td colspan='2'>Nenhum dado encontrado na tabela.</td></tr>";
    }

    $html .= "</tbody></table>";

    return $html;
}

function graphItem()
{
    global $conn;
    $conn = connection();

    $tableHTML = tabelaDatabase();

    echo $tableHTML;
}

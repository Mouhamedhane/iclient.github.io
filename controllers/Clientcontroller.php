<?php
require_once '../models/Client.php';

class ClientController {
    private $client;
    private $db;

    public function __construct() {
        // Connexion à la base de données
        $this->db = new PDO('mysql:host=localhost;dbname=gclient;charset=utf8', 'root', '');
        $this->client = new Client($this->db);
    }

    public function index() {
        $stmt = $this->client->read();
        $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require '../views/clients/index.php';
    }

    public function create() {
        if ($_POST) {
            $this->client->name = $_POST['name'];
            $this->client->address = $_POST['address'];
            $this->client->phone = $_POST['phone'];
            $this->client->email = $_POST['email'];
            $this->client->gender = $_POST['gender'];
            $this->client->status = $_POST['status'];

            if ($this->client->create()) {
                header("Location: ../public/index.php");
                exit();
            } else {
                echo "Erreur lors de la création du client.";
            }
        } else {
            require '../views/clients/create.php';
        }
    }

    public function edit($id) {
        if ($_POST) {
            $this->client->id = $id;
            $this->client->name = $_POST['name'];
            $this->client->address = $_POST['address'];
            $this->client->phone = $_POST['phone'];
            $this->client->email = $_POST['email'];
            $this->client->gender = $_POST['gender'];
            $this->client->status = $_POST['status'];

            if ($this->client->update()) {
                header("Location: ../public/index.php");
                exit();
            } else {
                echo "Erreur lors de la mise à jour du client.";
            }
        } else {
            $this->client->id = $id;
            $client = $this->client->readOne();
            if ($client) {
                require '../views/clients/edit.php';
            } else {
                echo "Client non trouvé.";
            }
        }
    }

    public function delete($id) {
        $this->client->id = $id;
        if ($this->client->delete()) {
            header("Location: ../public/index.php");
            exit();
        } else {
            echo "Erreur lors de la suppression du client.";
        }
    }

    public function filter($column, $value) {
        $stmt = $this->client->filter($column, $value);
        $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require '../views/clients/index.php';
    }

    public function sort($column, $order) {
        $stmt = $this->client->sort($column, $order);
        $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require '../views/clients/index.php';
    }

    public function exportCSV() {
        $result = $this->client->read();
        $clients = $result->fetchAll(\PDO::FETCH_ASSOC);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="clients.csv"');

        $output = fopen('php://output', 'w');
        fputcsv($output, array('ID', 'Name', 'Address', 'Phone', 'Email', 'Gender', 'Status'));

        foreach ($clients as $client) {
            fputcsv($output, $client);
        }

        fclose($output);
        exit();
    }

    public function exportPDF() {
        $result = $this->client->read();
        $clients = $result->fetchAll(\PDO::FETCH_ASSOC);

        $pdf = new \TCPDF();
        $pdf->AddPage();
        $pdf->SetFont('Helvetica', '', 12);

        $html = '<h1>Liste des Clients</h1>';
        $html .= '<table border="1" cellpadding="5">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Adresse</th>
                            <th>Numéro de téléphone</th>
                            <th>Email</th>
                            <th>Sexe</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($clients as $client) {
            $html .= '<tr>';
            foreach ($client as $value) {
                $html .= '<td>' . htmlspecialchars($value) . '</td>';
            }
            $html .= '</tr>';
        }

        $html .= '</tbody></table>';
        $pdf->writeHTML($html);
        $pdf->Output('clients.pdf', 'D');
        exit();
    }
}

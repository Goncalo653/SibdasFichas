<?php
require_once __DIR__ . '/../../includes/funcoes.php';
require_once __DIR__ . '/../../includes/validacoes.php';
redirect_if_not_logged();

if (!in_array($_SERVER['REQUEST_METHOD'], ['GET', 'POST'])) {
    header('Location: ' . BASE_URL . '/public/login.php');
    exit;
}

/* -------------------------
OBTER ID ENCRIPTADO
-------------------------*/

$idClientEncrypted = $_GET['id_cliente'] ?? null;
$idClient = aes_decrypt($idClientEncrypted);

if (!$idClient || !is_numeric($idClient)) {
    header('Location: ' . BASE_URL . '/private/views/clientes/lista.php');
    exit;
}

$erro = "";

/* -------------------------
ATUALIZAR CLIENTE (POST)
-------------------------*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $novoNome = $_POST['nome_cliente'] ?? '';
    $novoEmail = $_POST['email_cliente'] ?? '';
    $novaMorada = $_POST['morada_cliente'] ?? '';
    $novoTelefone = $_POST['tel_cliente'] ?? '';

    $erros = validar_nome($novoNome);
    $erros = array_merge($erros, validar_email($novoEmail));
    $erros = array_merge($erros, validar_telefone($novoTelefone));
    $erros = array_merge($erros, validar_morada($novaMorada));
    
    if (empty($erros)) {

        try {

            $ligacao = new PDO(
                "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE . ";charset=utf8",
                MYSQL_USERNAME,
                MYSQL_PASSWORD
            );

            $ligacao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $ligacao->prepare("
                UPDATE clientes 
                SET nome = :nome,
                email = :email,
 morada = :morada,
 telefone = :telefone
                WHERE id = :id
            ");

            $stmt->bindParam(':nome', $novoNome, PDO::PARAM_STR);
            $stmt->bindParam(':email', $novoEmail, PDO::PARAM_STR);
            $stmt->bindParam(':morada', $novaMorada, PDO::PARAM_STR);
            $stmt->bindParam(':telefone', $novoTelefone, PDO::PARAM_STR);
            $stmt->bindParam(':id', $idClient, PDO::PARAM_INT); // ou $
            $stmt->execute();

            header('Location: lista.php');
            exit;
        } catch (PDOException $err) {

            $erro = "Erro ao atualizar o nome: " . $err->getMessage();
        }
    }
}

/* -------------------------
PROCURAR CLIENTE NA BD
-------------------------*/

try {

    $ligacao = new PDO(
        "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE . ";charset=utf8",
        MYSQL_USERNAME,
        MYSQL_PASSWORD
    );

    $ligacao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $ligacao->prepare("SELECT * FROM clientes WHERE id = :id");

    $stmt->bindParam(':id', $idClient, PDO::PARAM_INT);

    $stmt->execute();

    $cliente = $stmt->fetch(PDO::FETCH_OBJ);

    if (!$cliente) {
        header('Location: ' . BASE_URL . '/private/views/clientes/lista.php');
        exit;
    }
} catch (PDOException $err) {

    $erro = "Erro na ligação à base de dados.";
    $cliente = null;
}

$ligacao = null;

?>
<?php include '../../includes/header.php'; ?>
<?php include '../../includes/nav.php'; ?>

<div class="container-fluid">
    <div class="row">

        <?php include '../../includes/sidebar.php'; ?>

        <main class="col-md-9 col-lg-10 p-4">

            <div class="d-flex justify-content-center mt-4">

                <div class="card w-100 shadow rounded" style="max-width:1200px;">
                    <div class="card-body">

                        <h2 class="mb-4">
                            <strong>
                                <i class="fa-solid fa-pen-to-square me-2"></i>
                                Atualização de Dados CLIENTES
                            </strong>
                        </h2>

                        <hr>

                        <form action="editar.php?id_cliente=<?= $idClientEncrypted ?>" method="post" novalidate>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label">Nome Completo</label>

                                    <input type="text"
                                        class="form-control"
                                        name="nome_cliente"
                                        value="<?= htmlspecialchars($cliente->nome) ?>"
                                        required>

                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-12">

                                    <label class="form-label">
                                        Morada <small>(NºPorta, Andar)</small>
                                    </label>

                                    <input type="text"
                                        class="form-control"
                                        name="morada_cliente"
                                        value="<?= htmlspecialchars($cliente->morada) ?>">

                                </div>
                            </div>


                            <div class="row mb-3">

                                <div class="col-md-3">

                                    <label class="form-label">Código Postal</label>

                                    <input type="text"
                                        class="form-control"
                                        name="cp_cliente"
                                        value="<?= htmlspecialchars($cliente->codigo_postal ?? '') ?>">

                                </div>


                                <div class="col-md-3">

                                    <label class="form-label">Cidade</label>

                                    <input type="text"
                                        class="form-control"
                                        name="cid_cliente"
                                        value="<?= htmlspecialchars($cliente->cidade) ?>">

                                </div>


                                <div class="col-md-3">

                                    <label class="form-label">Telefone</label>

                                    <input type="text"
                                        class="form-control"
                                        name="tel_cliente"
                                        value="<?= htmlspecialchars($cliente->telefone) ?>">

                                </div>


                                <div class="col-md-3">

                                    <label class="form-label">Email</label>

                                    <input type="email"
                                        class="form-control"
                                        name="email_cliente"
                                        value="<?= htmlspecialchars($cliente->email) ?>">

                                </div>

                            </div>


                            <div class="row mb-3">

                                <div class="col-md-6">

                                    <label class="form-label">Sexo</label>

                                    <div>

                                        <div class="form-check form-check-inline">

                                            <input class="form-check-input"
                                                type="radio"
                                                name="radio_gender"
                                                value="m"
                                                <?= $cliente->sexo == 'm' ? 'checked' : '' ?>>

                                            <label class="form-check-label">Masculino</label>

                                        </div>


                                        <div class="form-check form-check-inline">

                                            <input class="form-check-input"
                                                type="radio"
                                                name="radio_gender"
                                                value="f"
                                                <?= $cliente->sexo == 'f' ? 'checked' : '' ?>>

                                            <label class="form-check-label">Feminino</label>

                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-6">

                                    <label class="form-label">Data de nascimento</label>

                                    <input type="text"
                                        class="form-control"
                                        name="dnasc_cliente"
                                        value="<?= htmlspecialchars($cliente->data_nascimento) ?>">

                                </div>

                            </div>


                            <div class="row mb-3">

                                <div class="col-md-4">

                                    <label class="form-label">Estado Civil</label>

                                    <select class="form-select" name="estaciv_cliente">

                                        <option value="solt" <?= ($cliente->estado_civil ?? '') == 'solt' ? 'selected' : '' ?>>Solteiro</option>
                                        <option value="casd" <?= ($cliente->estado_civil ?? '') == 'casd' ? 'selected' : '' ?>>Casado</option>
                                        <option value="ufat" <?= ($cliente->estado_civil ?? '') == 'ufat' ? 'selected' : '' ?>>União de Facto</option>

                                    </select>

                                </div>


                                <div class="col-md-4">

                                    <label class="form-label">Sistema de Saúde</label>

                                    <input type="text"
                                        class="form-control"
                                        name="campo_opcao"
                                        list="sistemasaude"
                                        value="<?= htmlspecialchars($cliente->sistema_saude) ?>">

                                    <datalist id="sistemasaude">
                                        <option value="SNS">
                                        <option value="ADSE">
                                        <option value="SMAS">
                                        <option value="CTT">
                                        <option value="PSP">
                                    </datalist>

                                </div>


                                <div class="col-md-4">

                                    <label class="form-label">Profissão</label>

                                    <input type="text"
                                        class="form-control"
                                        name="profissao_cliente"
                                        value="<?= htmlspecialchars($cliente->profissao ?? '') ?>">

                                </div>

                            </div>


                            <div class="d-flex justify-content-end gap-2 mb-4">

                                <a href="lista.php" class="btn btn-outline-secondary">
                                    <i class="fa-solid fa-xmark me-1"></i>
                                    Cancelar
                                </a>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fa-regular fa-floppy-disk me-1"></i>
                                    Guardar
                                </button>

                            </div>


                            <?php if (!empty($erros)): ?>
                                <div class="alert alert-danger text-center" role="alert">
                                    <?php foreach ($erros as $erro): ?>
                                        <div><?= htmlspecialchars($erro) ?></div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>


                        </form>

                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>
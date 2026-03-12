<?php
function validar_nome(string $nome): array
{
    $erros = [];
    if (empty(trim($nome))) {
        $erros[] = "O campo Nome é obrigatório.";
    } elseif (preg_match('/\d/', $nome)) {
        $erros[] = "O campo Nome não pode conter números.";
    }
    return $erros;
}

function validar_morada(string $morada): array
{
    $erros = [];
    if (empty(trim($morada))) {
        $erros[] = "O campo Morada é obrigatório.";
    }elseif (strlen($morada) < 5 || strlen($morada) > 100) {
        $erros[] = "O campo Morada deve ter entre 5 e 100 caracteres.";
    }
    return $erros;
}

function validar_cidade(string $cidade): array
{
    $erros = [];
    if (empty(trim($cidade))) {
        $erros[] = "O campo Cidade é obrigatório.";
    }elseif (strlen($cidade) < 2 || strlen($cidade) > 50) {
        $erros[] = "O campo Cidade deve ter entre 2 e 50 caracteres.";
    }
    return $erros;
}

function validar_telefone(string $telefone): array
{
    $erros = [];
    if (empty(trim($telefone))) {
        $erros[] = "O campo Telefone é obrigatório.";
    } elseif (!preg_match('/^\d{9}$/', $telefone)) {
        $erros[] = "O campo Telefone deve conter exatamente 9 dígitos numéricos.";
    }
    return $erros;
}

function validar_email(string $email): array
{
    $erros = [];
    if (empty(trim($email))) {
        $erros[] = "O campo Email é obrigatório.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "O campo Email deve conter um endereço de email válido.";
    }
    return $erros;
}

function validar_cp(string $cp): array
{
    $erros = [];
    if (empty(trim($cp))) {
        $erros[] = "O campo Código Postal é obrigatório.";
    } elseif (!preg_match('/^\d{4}-\d{3}$/', $cp)) {
        $erros[] = "O campo Código Postal deve estar no formato 1234-567.";
    }
    return $erros;
}

function validar_data_nascimento(string $dnasc): array
{
    $erros = [];
    if (empty(trim($dnasc))) {
        $erros[] = "O campo Data de Nascimento é obrigatório.";
    } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $dnasc)) {
        $erros[] = "O campo Data de Nascimento deve estar no formato YYYY-MM-DD.";
    } else {
        $partes = explode('-', $dnasc);
        if (!checkdate((int)$partes[1], (int)$partes[2], (int)$partes[0])) {
            $erros[] = "O campo Data de Nascimento deve conter uma data válida.";
        }
    }
    return $erros;
}

function validar_estado_civil(string $estado): array
{
    $erros = [];
    $opcoes_validas = ['Solteiro', 'Casado', 'Divorciado', 'Viúvo'];
    if (empty(trim($estado))) {
        $erros[] = "O campo Estado Civil é obrigatório.";
    } elseif (!in_array($estado, $opcoes_validas)) {
        $erros[] = "O campo Estado Civil deve ser uma das seguintes opções: " . implode(', ', $opcoes_validas) . ".";
    }
    return $erros;
}

function validar_sistema_saude(string $sistema): array
{
    $erros = [];
    $opcoes_validas = ['ADSE', 'Particular', 'Outros'];
    if (empty(trim($sistema))) {
        $erros[] = "O campo Sistema de Saúde é obrigatório.";
    } elseif (!in_array($sistema, $opcoes_validas)) {
        $erros[] = "O campo Sistema de Saúde deve ser uma das seguintes opções: " . implode(', ', $opcoes_validas) . ".";
    }
    return $erros;
}

function validar_profissao(string $profissao): array
{
    $erros = [];
    if (empty(trim($profissao))) {
        $erros[] = "O campo Profissão é obrigatório.";
    } elseif (strlen($profissao) < 2 || strlen($profissao) > 50) {
        $erros[] = "O campo Profissão deve ter entre 2 e 50 caracteres.";
    }
    return $erros;
}

function valida_sexo(string $sexo): array
{
    $erros = [];
    $opcoes_validas = ['m', 'f'];
    if (empty(trim($sexo))) {
        $erros[] = "O campo Sexo é obrigatório.";
    } elseif (!in_array($sexo, $opcoes_validas)) {
        $erros[] = "O campo Sexo deve ser 'm' para masculino ou 'f' para feminino.";
    }
    return $erros;
}



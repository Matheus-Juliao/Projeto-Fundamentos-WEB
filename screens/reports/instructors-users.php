<?php
    include '../../conexaoMysql.php';

    $arquivo = "instrutores-usuarios.xls";
    $html = '';
    $html .= '<table border="1">';
        
    $html .= '<td colspan="14">Instrutores e usuários</td>';
        $html .=  '<tr>';
            $html .= '<td><b>Nome</b></td>';
            $html .= '<td><b>Idade</b></td>';
            $html .= '<td><b>Genero</b></td>';
            $html .= '<td><b>Telefone</b></td>';
            $html .= '<td><b>Endereço</b></td>';
            $html .= '<td><b>Especialização</b></td>';
            $html .= '<td><b>Usuário</b></td>';
        $html .= '</tr>';

        $query = ("SELECT i.id, i.nome_instrutor, i.idade, i.genero, i.especializacao, i.telefone, i.endereco, u.nome 
            FROM usuarios u INNER JOIN instrutores i ON u.id = i.usuario_id");
        $busca = mysqli_query($conn, $query);

        while($dados = mysqli_fetch_array($busca)) {   
            $html .= '<tr>';
                $html .= '<td>'; $html .= $dados['nome_instrutor']; $html .= '</td>';
                $html .= '<td>'; $html .= $dados['idade']; $html .= '</td>';
                $html .= '<td>'; $html .= $dados['genero']; $html .= '</td>';
                $html .= '<td>'; $html .= $dados['telefone']; $html .= '</td>';
                $html .= '<td>'; $html .= $dados['endereco']; $html .= '</td>';
                $html .= '<td>'; $html .= $dados['especializacao']; $html .= '</td>';
                $html .= '<td>'; $html .= $dados['nome']; $html .= '</td>';
            $html .= '</tr>';         
        }
    $html .= '</table>';

    // Configurações header para forçar o download
    header ("Expires: Mon, 07 Jul 2016 05:00:00 GMT");
    header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
    header ("Cache-Control: no-cache, must-revalidate");
    header ("Pragma: no-cache");
    header ("Content-type: application/x-msexcel");
    header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
    header ("Content-Description: PHP Generated Data" );
    // Envia o conteúdo do arquivo
    echo $html;
    exit;
?>
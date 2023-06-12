<?php
    include '../../conexaoMysql.php';

    $arquivo = "alunos-planos.xls";
    $html = '';
    $html .= '<table border="1">';
        
    $html .= '<td colspan="14">Alunos e Planos</td>';
        $html .=  '<tr>';
            $html .= '<td><b>Nome</b></td>';
            $html .= '<td><b>Idade</b></td>';
            $html .= '<td><b>Genero</b></td>';
            $html .= '<td><b>Telefone</b></td>';
            $html .= '<td><b>Endereço</b></td>';
            $html .= '<td><b>Planos</b></td>';
            $html .= '<td><b>Valor</b></td>';
        $html .= '</tr>';

        $query = ("SELECT a.id, a.nome_aluno, a.idade, a.genero, a.telefone, a.endereco, p.id, p.nome, p.valor
        FROM alunos a
        INNER JOIN alunos_planos_de_treinamento ap ON a.id = ap.aluno_id
        INNER JOIN planos_de_treinamento p ON ap.planos_de_treinamento_id = p.id;");
        $busca = mysqli_query($conn, $query);

        while($dados = mysqli_fetch_array($busca)) {   
            $html .= '<tr>';
                $html .= '<td>'; $html .= $dados['nome_aluno']; $html .= '</td>';
                $html .= '<td>'; $html .= $dados['idade']; $html .= '</td>';
                $html .= '<td>'; $html .= $dados['genero']; $html .= '</td>';
                $html .= '<td>'; $html .= $dados['telefone']; $html .= '</td>';
                $html .= '<td>'; $html .= $dados['endereco']; $html .= '</td>';
                $html .= '<td>'; $html .= $dados['nome']; $html .= '</td>';
                $html .= '<td>'; $html .= $dados['valor']; $html .= '</td>';
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
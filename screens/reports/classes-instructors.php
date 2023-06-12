<?php
    include '../../conexaoMysql.php';

    $arquivo = "aulas-instrutores.xls";
    $html = '';
    $html .= '<table border="1">';
        
    $html .= '<td colspan="14">Aulas e Instrutores</td>';
        $html .=  '<tr>';
            $html .= '<td><b>Aula</b></td>';
            $html .= '<td><b>Nome do instrutor</b></td>';
            $html .= '<td><b>Especialização do instrutor</b></td>';
        $html .= '</tr>';

        $query = ("SELECT a.id, a.nome as aula, i.nome_instrutor, i.especializacao FROM aulas a INNER JOIN instrutores i ON a.instrutor_id = i.id");
        $busca = mysqli_query($conn, $query);

        while($dados = mysqli_fetch_array($busca)) {   
            $html .= '<tr>';
                $html .= '<td>'; $html .= $dados['aula']; $html .= '</td>';
                $html .= '<td>'; $html .= $dados['nome_instrutor']; $html .= '</td>';
                $html .= '<td>'; $html .= $dados['especializacao']; $html .= '</td>';
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
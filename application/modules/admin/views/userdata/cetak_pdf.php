<?php
$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('Detail User');
$pdf->SetHeaderMargin(30);
$pdf->SetTopMargin(20);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true);
$pdf->SetAuthor('Author');
$pdf->SetDisplayMode('real', 'default');
$pdf->AddPage();
$i = 0;
$html = '<h3>Detail User</h3>
        <table cellspacing="1" bgcolor="#666666" cellpadding="2">
            <tr class="txtbio" bgcolor="#ffffff">
                <td width="20%" >Nama</td>
                <td width="80%">' . $result->fullname . '</td>
            </tr>
            <tr class="txtbio" bgcolor="#ffffff">
                <td width="20%" >Gender</td>
                <td width="80%">' . $result->gender . '</td>
            </tr>
            <tr class="txtbio" bgcolor="#ffffff">
                <td width="20%">Alamat</td>
                <td width="80%">' . $result->address_user . '</td>
            </tr>
            <tr class="txtbio" bgcolor="#ffffff">
                <td width="20%">Kategori</td>
                <td width="80%">' . $result->category . '</td>
            </tr>
            <tr class="txtbio" bgcolor="#ffffff">
                <td width="20%">Sub Kategori</td>
                <td width="80%">' . $result->sub_category . '</td>
            </tr>
            <tr class="txtbio" bgcolor="#ffffff">
                <td width="20%">Email</td>
                <td width="80%">' . $result->email . '</td>
            </tr>
            <tr class="txtbio" bgcolor="#ffffff">
                <td width="20%">No HP</td>
                <td width="80%">' . $result->phone_user . '</td>
            </tr>
            <tr class="txtbio" bgcolor="#ffffff">
                <td width="20%">Instansi</td>
                <td width="80%">' . $result->instansi . '</td>
            </tr>
        </table>';

$pdf->writeHTML($html, true, false, true, false, '');
$filename='Detail '.$result->fullname.'.pdf';
$pdf->Output($filename, 'I');

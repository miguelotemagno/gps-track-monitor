<?php
session_start();
echo "<script>";
$gbelmm= new gbelmm2();
echo $gbelmm->declaravar();
echo $gbelmm->iniciamenu();
echo $gbelmm->Buscar();
echo $gbelmm->BuscarDire();
echo $gbelmm->Changei();
echo $gbelmm->Pertenece();;
echo $gbelmm->GetDist();
echo $gbelmm->Removel();
echo $gbelmm->SetRouteP();
echo $gbelmm->TratarPto();
echo $gbelmm->UpdatL();

echo $gbelmm->drawR(); 
echo $gbelmm->getDireccion();

echo $gbelmm->maplimpio();
echo $gbelmm->onGDirecion2();
echo $gbelmm->onGDirection3();
echo $gbelmm->opciones();
//echo $gbelmm->ptosTot();
//echo $gbelmm->removeMas();
//echo $gbelmm->removeWay();
echo $gbelmm->BluidW();
echo $gbelmm->clearR();
echo $gbelmm->CreaInf();
echo "</script>";

?>

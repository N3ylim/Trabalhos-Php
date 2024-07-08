<?php
require_once(__DIR__ . '/resources/fmac/autoload.php');
setDebug(true);

use FMAC\MVC\TModel;

TModel::connectDB(__DIR__ . '/_docs/connect.ini');

function usuario_select($usuario)
{
   $Model = new TModel();
   return $Model->onePrepare(
      'SELECT *
        FROM usuario
        WHERE
            nome = {nome}
        AND
            senha = MD5({senha});',
      $usuario
   );
}

function usuario_insert($usuario)
{
   $Model = new TModel();
   $id = $Model->lastIdPrepare(
      'INSERT INTO usuario (nome, senha)
         VALUES ({nome}, MD5({senha}));',
      $usuario
   );
   return $id;
}

function produto_list($usuario)
{
   $Model = new TModel();
   return $Model->prepare(
      'SELECT *
        FROM produto
        WHERE
            usuario_id = {id};',
      $usuario
   );
}

function produto_select($id)
{
   $Model = new TModel();
   return $Model->onePrepare(
      'SELECT *
        FROM produto
        WHERE
            id = {id};',
      $id
   );
}

function produto_update($produto)
{
   $Model = new TModel();
   if (!ifset($produto, 'id')) {
      return $Model->lastIdPrepare(
         'INSERT INTO produto (nome, quantidade, validade, usuario_id)
             VALUES ({nome:S},{quantidade:N},{validade:SN},{usuario_id:N});',
         $produto
      );
   } else {
      return $Model->boolPrepare(
         'UPDATE produto SET
                nome = {nome:S},
                quantidade = {quantidade:N},
                validade = {validade:SN}
             WHERE
                id = {id};',
         $produto
      ) ? $produto['id'] : 0;
   }
}
function produto_delete($produto_id) {
   $Model = new TModel();
   
   return $Model->boolPrepare(
       'DELETE FROM produto
        WHERE id = {id};',
       array('id' => $produto_id)
   );
}

function registrar_compra($compra)
{
   $Model = new TModel();
   
   $produto = $Model->onePrepare('SELECT quantidade FROM produto WHERE id = {produto_id};', ['produto_id' => $compra['produto_id']]);

   if (!$produto) {
      return false;
   }

   $nova_quantidade = $produto['quantidade'] + $compra['quantidade'];

   $atualizado = $Model->boolPrepare(
      'UPDATE produto SET quantidade = {nova_quantidade} WHERE id = {produto_id};',
      ['nova_quantidade' => $nova_quantidade, 'produto_id' => $compra['produto_id']]
   );

   if (!$atualizado) {
      return false;
   }

   $compra_id = $Model->lastIdPrepare(
      'INSERT INTO compra (produto_id, quantidade, valor) VALUES ({produto_id:N}, {quantidade:N}, {valor:N});',
      $compra
   );

   return $compra_id ? $compra_id : false;
}

function registrar_venda($venda)
{
    $Model = new TModel();
    
    $produto = $Model->onePrepare('SELECT quantidade FROM produto WHERE id = {produto_id};', ['produto_id' => $venda['produto_id']]);

    if (!$produto) {
        return false;
    }

    $nova_quantidade = $produto['quantidade'] - $venda['quantidade'];

    if ($nova_quantidade < 0) {
        return false;
    }

    $atualizado = $Model->boolPrepare(
        'UPDATE produto SET quantidade = {nova_quantidade} WHERE id = {produto_id};',
        ['nova_quantidade' => $nova_quantidade, 'produto_id' => $venda['produto_id']]
    );

    if (!$atualizado) {
        return false;
    }

    $venda_id = $Model->lastIdPrepare(
        'INSERT INTO venda (produto_id, quantidade, valor) VALUES ({produto_id:N}, {quantidade:N}, {valor:N});',
        $venda
    );

    return $venda_id ? $venda_id : false;
}

?>
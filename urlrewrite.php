<?php
$arUrlRewrite=array (
  10 => 
  array (
    'CONDITION' => '#^/personal/addresses/(.+)/(\\\\?(.*))?#',
    'RULE' => 'CODE=$1&$2',
    'ID' => '',
    'PATH' => '/personal/addresses/detail.php',
    'SORT' => 100,
  ),
  1 => 
  array (
    'CONDITION' => '#^/wholesale/(.+)/(.+)/(\\\\?(.*))?#',
    'RULE' => 'SECTION_CODE=$1&ELEMENT_CODE=$2&$3',
    'ID' => '',
    'PATH' => '/catalog/detail.php',
    'SORT' => 100,
  ),
  2 => 
  array (
    'CONDITION' => '#^/catalog/(.+)/(.+)/(\\\\?(.*))?#',
    'RULE' => 'SECTION_CODE=$1&ELEMENT_CODE=$2&$3',
    'ID' => '',
    'PATH' => '/catalog/detail.php',
    'SORT' => 100,
  ),
  4 => 
  array (
    'CONDITION' => '#^/wholesale/(.+)/(\\\\?(.*))?#',
    'RULE' => 'SECTION_CODE=$1&$2',
    'ID' => '',
    'PATH' => '/catalog/index.php',
    'SORT' => 100,
  ),
  0 => 
  array (
    'CONDITION' => '#^/sale/(.+)/(.+)/(\\\\?(.*))?#',
    'RULE' => 'SECTION_CODE=$1&ELEMENT_CODE=$2&$3',
    'ID' => '',
    'PATH' => '/catalog/detail.php',
    'SORT' => 100,
  ),
  5 => 
  array (
    'CONDITION' => '#^/bitrix/services/ymarket/#',
    'RULE' => '',
    'ID' => '',
    'PATH' => '/bitrix/services/ymarket/index.php',
    'SORT' => 100,
  ),
  6 => 
  array (
    'CONDITION' => '#^/catalog/(.+)/(\\\\?(.*))?#',
    'RULE' => 'SECTION_CODE=$1&$2',
    'ID' => '',
    'PATH' => '/catalog/index.php',
    'SORT' => 100,
  ),
  11 => 
  array (
    'CONDITION' => '#^/product/(.+)/(\\\\?(.*))?#',
    'RULE' => 'ID=$1&$2',
    'ID' => '',
    'PATH' => '/product/index.php',
    'SORT' => 100,
  ),
  13 => 
  array (
    'CONDITION' => '#^/gallery/(.+)/(\\\\?(.*))?#',
    'RULE' => 'ELEMENT_CODE=$1',
    'ID' => '',
    'PATH' => '/gallery/detail.php',
    'SORT' => 100,
  ),
  3 => 
  array (
    'CONDITION' => '#^/sale/(.+)/(\\\\?(.*))?#',
    'RULE' => 'SECTION_CODE=$1&$2',
    'ID' => '',
    'PATH' => '/sale/index.php',
    'SORT' => 100,
  ),
  7 => 
  array (
    'CONDITION' => '#^/wholesale/(\\\\?(.*))?#',
    'RULE' => 'WHOLESALE=Y&$1',
    'ID' => '',
    'PATH' => '/catalog/index.php',
    'SORT' => 100,
  ),
  12 => 
  array (
    'CONDITION' => '#^/item/(.+)(\\\\?(.*))?#',
    'RULE' => 'ID=$1&$2',
    'ID' => '',
    'PATH' => '/product/index.php',
    'SORT' => 100,
  ),
  8 => 
  array (
    'CONDITION' => '#^/personal/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.section',
    'PATH' => '/personal/index.php',
    'SORT' => 100,
  ),
  9 => 
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
);

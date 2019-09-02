<?php


$hostname 				= 'freshbt.mysql';
$username 				= 'freshbt_new';
$password 				= 'DSf98hs74ih893a#as!';
$dbName 				= 'freshbt_new';

/*$hostname <----><------><------><------>= 'mysql.freshbt.z8.ru';
$username <----><------><------><------>= 'dbu_freshbt_6';
$password <----><------><------><------>= 'sswwSSS';
$dbName <------><------><------><------>= 'db_freshbt_6';*/

/*$hostname 				= 'mysql';
$username 				= 'root';
$password 				= 'root';
$dbName 				= 'db_freshbt_6';*/

$catalogue = 'b_iblock_section';
$item = 'b_iblock_element';
$price = 'b_catalog_price';
$files = 'b_file';

$categoriesExcl         = array(398);
$categories             = array(
    1093,       // Агар-агар, пектин и желатин
    1151,       // Красители
    1028,       // Мастика, паста для лепки и обтяжки тортов
    1044,       // Орехи, мука и пасты ореховые, семечки
    1032,       // Шоколад и какао
    1154,       // Принтер и бумага пищевые
//    1087,       // Упаковка, коробки для тортов и капкейков
    1692,       // Коробки для тортов
    1691,       // Коробки для капкейков
    1155,       // Упаковочные материалы, подложки и салфетки
    1051       // Формы для выпечки
);

// **********
// Connect DB
// **********

$link = mysqli_connect($hostname, $username, $password, $dbName);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

//mysqli_select_db($dbName, $link) or die('Could not select db: ' . mysqli_error());

mysqli_query($link, 'set names utf8');

// ************
// Write header
// ************

echo"<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
echo"<!DOCTYPE yml_catalog SYSTEM 'shops.dtd'>\n";
echo"<yml_catalog date=\"";
echo date('Y-m-d H:i');
echo"\">\n";
echo"<shop>\n";
echo"<name>Вкусный магазин</name>\n";
echo"<company>ООО Вкусный магазин</company>\n";
echo"<url>http://nevkusno.ru</url>\n";
echo"<currencies><currency id=\"RUR\" rate=\"1\"/></currencies>\n";

// ******************
// Categories section
// ******************

echo"<categories>\n";

//$query_cat = "SELECT * FROM $catalogue WHERE (parent_id=0 OR parent_id in (SELECT catalogue_id FROM $catalogue WHERE status=1 AND parent_id=0 AND catalogue_id!=398)) AND catalogue_id!=398 AND status=1";


$catInclStr = count($categories) ? ('ID IN ('.implode(', ', $categories).')') : '';
$catExclStr = count($categoriesExcl) ? ('ID NOT IN ('.implode(', ',$categoriesExcl).')') : '';

$catWhere[] = "ACTIVE = 'Y' AND GLOBAL_ACTIVE = 'Y'";
if (!empty($catInclStr)) $catWhere[] = $catInclStr;
if (!empty($catExclStr)) $catWhere[] = $catExclStr;
$catWhereStr = implode(' AND ', $catWhere);

$query_cat = "SELECT * FROM $catalogue WHERE ".$catWhereStr;
$res_cat = mysqli_query($link, $query_cat) or die(mysqli_error());
// $rw=1;
while ($row_cat=mysqli_fetch_array($res_cat)) {
	$cat_parent_id = $row_cat['IBLOCK_SECTION_ID'];
	$cat_child_id = $row_cat['ID'];
	$cat_name = $row_cat['NAME'];
	if ($cat_parent_id == 0) {
		echo"<category id=\"".$cat_child_id."\">".$cat_name."</category>\n";
	}
	else {
		echo"<category id=\"".$cat_child_id."\" parentId=\"".$cat_parent_id."\">".$cat_name."</category>\n";
	}
//	$rw++;
}
echo"</categories>\n";

// ****************
// Products section
// ****************

echo"<offers>\n";

$catInclStr = count($categories) ? ('(IBLOCK_SECTION_ID IN ('.implode(', ', $categories).') OR i.IBLOCK_SECTION_ID IN (SELECT ID FROM '.$catalogue.' WHERE IBLOCK_SECTION_ID IN ('.implode(', ', $categories).')))') : '';
$catExclStr = count($categoriesExcl) ? ('IBLOCK_SECTION_ID NOT IN ('.implode(', ',$categoriesExcl).')') : '';

$prodWhere = array();
$prodWhere[] = "i.ACTIVE = 'Y'";

if (!empty($catInclStr)) $prodWhere[] = $catInclStr;
if (!empty($catExclStr)) $prodWhere[] = $catExclStr;

$prodWhereStr = implode(' AND ', $prodWhere);

//$query = "SELECT * FROM $item i RIGHT JOIN $price p ON p.PRODUCT_ID = i.ID WHERE $prodWhereStr LIMIT 1000";
$query = "SELECT i.*, p.PRICE, f.SUBDIR, f.HEIGHT, f.WIDTH, f.FILE_NAME FROM $item i RIGHT JOIN $price p ON p.PRODUCT_ID = i.ID RIGHT JOIN $files f ON f.ID = i.DETAIL_PICTURE WHERE $prodWhereStr LIMIT 1000";

$result = mysqli_query($link, $query) or die(mysqli_error());
// $rw=1;
while ($row=mysqli_fetch_array($result)) {
    if (preg_match('/^.{1,2900}\b/s', strip_tags($row['DETAIL_TEXT']), $match)) {
        $item_desc = trim($match[0]);
    } else {
        $item_desc = trim(strip_tags($row['DETAIL_TEXT']));
    }

    $item_cat_id=$row['ID'];
    $item_name=strip_tags($row['NAME']);
//    $item_desc=trim(substr(strip_tags($row['XML']), 0, 2999));
    $item_image="https://www.nevkusno.ru/upload/resize_cache/".$row['SUBDIR']."/".$row['WIDTH']."_".$row['HEIGHT']."_15f114315e1b4ebd23b54a12f15a1d38a/".$row['FILE_NAME'];
    $item_price=$row['PRICE'];
    $item_url="https://www.nevkusno.ru/item/".$row['ID'];
//    $item_isweight=$row['IS_WEIGHT'];

/*
 * <offer id="12346" available="true" bid="80" cbid="90" fee="325">
 * <url>http://best.seller.ru/product_page.asp?pid=12348</url>
        <price>1490</price>
        <oldprice>1620</oldprice>
        <currencyId>RUR</currencyId>
        <categoryId>101</categoryId>
        <picture>http://best.seller.ru/img/large_12348.jpg</picture>
        <store>false</store>
        <pickup>true</pickup>
        <delivery>true</delivery>
        <delivery-options>
          <option cost="300" days="0" order-before="12"/>
        </delivery-options>
        <name>Вафельница First FA-5300</name>
        <vendor>First</vendor>
        <vendorCode>A1234567B</vendorCode>
        <description>
        <![CDATA[
          <p>Отличный подарок для любителей венских вафель.</p>
        ]]>
        </description>
        <sales_notes>Необходима предоплата.</sales_notes>
        <manufacturer_warranty>true</manufacturer_warranty>
        <country_of_origin>Россия</country_of_origin>
        <barcode>0156789012</barcode>
        <cpa>1</cpa>
        <rec>123,456</rec>
 * */
    echo"\n<offer id=\"".$row['ID']."\" available=\"true\">\n";
    echo"<category_id>$item_cat_id</category_id>\n";
    echo"<name>$item_name</name>\n";
    echo"<description><![CDATA[$item_desc]]></description>\n";
    echo"<sales_notes>Необходима предоплата.</sales_notes>\n";
    echo"<price>".$item_price."</price>\n";
    echo"<picture>".$item_image ."</picture>\n";
    echo"<url>$item_url</url>\n";
    echo"</offer>";
//	$rw++;
}

echo"\n</offers>\n";
echo"</shop>\n";
echo"</yml_catalog>\n";

function isweight($weight){
    if ($weight == 1) { $res = "true"; } else { $res = "false"; }
    return $res;
}

mysqli_close($link);
?>
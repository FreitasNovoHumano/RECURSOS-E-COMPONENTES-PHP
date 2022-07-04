<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("07.08 - Imagem, cache e miniaturas");

require __DIR__ . "/../vendor/autoload.php";

/*
 * [ cropper ] https://packagist.org/packages/coffeecode/cropper
 */
fullStackPHPClassSession("cropper", __LINE__);

$t = new \Source\Support\Thumb();
var_dump($t);


/*
 * [ generate ]
 */
fullStackPHPClassSession("generate", __LINE__);

echo "<img src='{$t->make("images/2022/07/certificado-jquery.jpg", 300)}' alt='' title=''/>";
echo "<img src='{$t->make("images/2022/07/certificado-jquery.png", 180, 180)}' alt='' title=''/>";

var_dump($t->make("images.jpg", 100));

echo "<img src='{$t->make("images/2022/07/f-aacute-bio.jpg", 300)}' alt='' title=''/>";
echo "<img src='{$t->make("images/2022/07/f-aacute-bio.png", 180, 180)}' alt='' title=''/>";

//LIBERANO CACHE
$t->flush("images/2022/06/nome-do-arquivo-1656565054.jpg");
$t->flush();

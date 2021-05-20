<?php

if ( ! function_exists('remover_caracteres')) {

    function remover_caracteres($str) {
        $str = preg_replace('/[áàãâä]/ui', 'a', $str);
        $str = preg_replace('/[éèêë]/ui', 'e', $str);
        $str = preg_replace('/[íìîï]/ui', 'i', $str);
        $str = preg_replace('/[óòõôö]/ui', 'o', $str);
        $str = preg_replace('/[úùûü]/ui', 'u', $str);
        $str = preg_replace('/[ç]/ui', 'c', $str);
        $str = preg_replace('/[,(),;:|!"#$%&=?~^><ªº-]/', '-', $str);
        $str = preg_replace('/[^a-z0-9]/i', '-', $str);
        $str = preg_replace('/_+/', '-', $str); // ideia do Bacco :)

        $string = strtolower($str);

        return $string;

    }

}


if (!function_exists('limpaCPF_CNPJ')) {

    function limpaCPF_CNPJ($valor)
    {

        $valor = trim($valor);
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", "", $valor);
        $valor = str_replace("-", "", $valor);
        $valor = str_replace("/", "", $valor);
        return $valor;
    }
}

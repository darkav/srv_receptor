<?php
namespace App\Custom;
class HardCodeMenu
{
    public static function get_menu()
    {
        return [
                    ["modulo" => "Parametros", "programas" => [
                        ["programa" => "Sucursal", "icono" => "mif-home","link" => "/sucursal"],
                        ["programa" => "Categoria", "icono" => "mif-cabinet","link" => "/categoria"]
                    ]],
                    ["modulo" => "Procesos", "programas" => [
                        ["programa" => "Generando tablas", "icono" => "mif-cog", "link" => "/genera-tabla"],

                    ]]
                ];
    }
}
?>
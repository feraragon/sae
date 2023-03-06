<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Empresas_model extends Model
{
    use HasFactory;

    public static function get_all()
    {
        return DB::table('empresas')->where('estado', 'Activo')->orderBy('nombre')->get();
    }

    public static function get_by_id($id)
    {
        return DB::table('empresas')->where([['estado', '=','Activo'],['id','=', $id]])->get();
    }
    
    public static function agregar($request)
    {
        $data = [
            'nombre'                => $request['nombre'],
            'fecha_constitucion'    => $request['fechaConstitucion'],
            'tipo_empresa'          => $request['tipoEmpresa'],
            'comentarios'           => $request['comentarios'],
            'estado'                => 'Activo',
            'created_at'             => date('Y-m-d H:i:s')
        ];
        return DB::table('empresas')->insert($data);
    }

    public static function editar($request)
    {
        $data = [
            'nombre'                => $request['nombre'],
            'fecha_constitucion'    => $request['fechaConstitucion'],
            'tipo_empresa'          => $request['tipoEmpresa'],
            'comentarios'           => $request['comentarios'],
        ];
        return DB::table('empresas')->where('id', '=', $request['id'])->update($data);
    }

    public static function eliminar($id)
    {
        $data = [
            'estado' => 'Eliminado'
        ];
        return DB::table('empresas')->where('id', '=', $id)->update($data);
    }
}

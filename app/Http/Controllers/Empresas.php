<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresas_model;
use Illuminate\Support\Facades\Redirect;

class Empresas extends Controller
{

    //Funció para cargar la vista
    public function index()
    {
        $data = [
            'empresas'  => Empresas_model::get_all(),
        ];
        return view('empresas', $data);
    }

    //Función para buscar por id de empresa
    public function get_by_id(Request $request)
    {
       
        $empresa = Empresas_model::get_by_id($request->id);
      
        http_response_code(200);
        echo json_encode($empresa);
        
    }

    //Función para agregar empresas
    public function agregar(Request $request)
    {
        if ($response = Empresas_model::agregar($request->all())) {
            session()->flash('alert', [
                'type' => 'success',
                'msg'  => 'La empresa se registró correctamente.'
            ]);
        } else {
            session()->flash('alert', [
                'type' => 'danger',
                'msg'  => 'Error al registrar la empresa, favor intentarlo más tarde.'
            ]);
        }

        Redirect::to(url('/'))->send();
    }

    //Función para editar empresas
    public function editar(Request $request)
    {
        if (Empresas_model::editar($request->all())) {
            session()->flash('alert', [
                'type' => 'success',
                'msg'  => 'La empresa se editó con exito.'
            ]);
        } else {
            session()->flash('alert', [
                'type' => 'danger',
                'msg'  => 'Error al editar la empresa, favor intentarlo más tarde.'
            ]);
        }
        Redirect::to(url('/'))->send();
    }

    //Función para eliminar empresas
    public function eliminar(Request $request)
    {
        if (Empresas_model::eliminar($request->id)) {
            session()->flash('alert', [
                'type' => 'success',
                'msg'  => 'La empresa se eliminó con exito.'
            ]);
        } else {
            session()->flash('alert', [
                'type' => 'danger',
                'msg'  => 'Error al eliminar la empresa, favor intentarlo más tarde.'
            ]);
        }
    }
}

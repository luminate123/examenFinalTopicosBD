<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Cliente;
use Laracasts\Flash\Flash;

class ClientesController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes', compact('clientes'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nombres' => 'required',
                'email' => 'required',
                'direccion' => 'required',
                'telefono' => 'required',

            ]
        );

        if ($validator->fails()) {
            toastr()->error('Datos no validos');
        }

        //si el cliente ya exite en la base de datos mandar un mensaje que ya existe
        if (Cliente::where('nombres', $request->nombres)->exists()) {
            toastr()->error('Cliente con ese nombre ya existe');
        } else if (Cliente::where('email', $request->email)->exists()) {
            toastr()->error('Cliente con ese email ya existe');
        } else {
            $cliente = Cliente::create([
                'nombres' => $request->nombres,
                'email' => $request->email,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
            ]);
            toastr()->success('Cliente creado correctamente');
        }

        return redirect('/clientes');
    }

    public function update($id, Request $request)
    {
        $cliente = Cliente::find($id);
        $cliente->nombres = $request->nombres;
        $cliente->email = $request->email;
        $cliente->direccion = $request->direccion;
        $cliente->telefono = $request->telefono;
        $cliente->save();


        toastr()->success('Cliente actualizado correctamente');

        return redirect('/clientes');
    }

    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();

        toastr()->success('Cliente eliminado correctamente');

        return redirect('/clientes');
    }
}

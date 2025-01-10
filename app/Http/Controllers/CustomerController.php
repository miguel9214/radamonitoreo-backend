<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {

        $customers = Customer::all();
        return response()->json(['message'=>'Lista de clientes', 'customers'=>$customers, 200]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:customers',
            'phone' => 'required|string',
            'address' => 'required|string'
        ]);

        $customer = new Customer([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ]);

        $customer->save();

        return response()->json([
            'message' => 'Cliente creado exitosamente'
        ], 201);
    }


    public function show($id)
    {
        $customer = Customer::find($id);
        return response()->json(['message'=>'Cliente encontrado', 'customer'=>$customer, 200]);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->update($request->all());
        return response()->json([
            'message' => 'Cliente actualizado exitosamente'
        ], 200);
    }


    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return response()->json([
            'message' => 'Cliente eliminado exitosamente'
        ], 200);
    }
}

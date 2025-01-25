<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;


class CustomerController extends Controller
{
    public function index(Request $request)
    {
        try{
            $search = $request->input('search');

            $query = DB::table("customers as c")->select(
                "c.id",
                "c.dni",
                "c.name",
                "c.email",
                "c.phone",
                "c.address"
            );

            if ($search) {
                $query->where('c.name', 'like', '%' . $search . '%');
            }

            $customerList = $query->paginate(5);

            return response()->json(['message' => 'Customer list', 'customers' => $customerList], 200);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error getting customer list', 'error' => $e->errorInfo], 400);
        }

    }

    public function store(Request $request)
    {
        $request->validate([
            'dni'=>'required|numeric|unique:customers',
            'name' => 'required|string',
            'email' => 'required|string|email|unique:customers',
            'phone' => 'required|string',
            'address' => 'required|string'
        ]);
        try {
            $customer = new Customer();
            $customer->dni = $request->dni;
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->created_by_user = auth()->user()->id;
            $customer->save();
            return response()->json(['message' => 'Customer created successfully', 'customer' => $customer], 201);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error creating customer', 'error' => $e->errorInfo], 400);
        }
    }

    public function show($id)
    {
        try{
            $customer = DB::table("customers as c")->select(
                "c.id",
                "c.dni",
                "c.name",
                "c.email",
                "c.phone",
                "c.address"
            )->where('c.id', $id)->first();
            if($customer){
                return response()->json(['message' => 'Customer found', 'customer' => $customer]);
            }else{
                return response()->json(['message' => 'Customer not found'], 404);
            }
        }
        catch(QueryException $e){
            return response()->json(['message' => 'Error getting customer details', 'error' => $e->errorInfo], 400);
        }

    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'dni'=>'required|numeric|unique:customers,dni,'.$id,
            'name' => 'required|string',
            'email' => 'required|string|email',
            'phone' => 'required|string',
            'address' => 'required|string'
        ]);

        try {
            // Verificar si el cliente existe
            $customer = Customer::find($id);
            if (!$customer) {
                return response()->json(['message' => 'Cliente no encontrado'], 404);
            }

            // Verificar si el email ya está en uso por otro cliente
            if (Customer::where('email', $request->email)->where('id', '!=', $id)->exists()) {
                return response()->json(['message' => 'El correo electrónico ya está en uso'], 400);
            }

            // Actualizar los datos del cliente
            $customer->dni = $request->dni;
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->updated_by_user = auth()->user()->id;
            $customer->save();

            return response()->json(['message' => 'Cliente actualizado exitosamente', 'customer' => $customer], 200);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error al actualizar el cliente', 'error' => $e->errorInfo], 400);
        }
    }


    public function destroy($id)
    {
        try {
            $customer = Customer::find($id);
            if (!$customer) {
                return response()->json(['message' => 'Customer not found'], 404);
            } else {
                $customer->delete();
                return response()->json(['message' => 'Customer deleted successfully'], 200);
            }
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error deleting customer', 'error' => $e->errorInfo], 400);
        }

    }
}

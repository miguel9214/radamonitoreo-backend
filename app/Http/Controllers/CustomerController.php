<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;


class CustomerController extends Controller
{
    public function index()
    {
        $customerList = DB::table("customers as c")->select(
            "c.id",
            "c.name",
            "c.email",
            "c.phone",
            "c.address"
        )->get();

        $customerList::paginate(6);

        return response()->json(['message' => 'Customer list', 'customers' => $customerList], 200);

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
        try {
            $customer = new Customer();
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
        $customer = DB::table("customers as c")->select(
            "c.id",
            "c.name",
            "c.email",
            "c.phone",
            "c.address"
        )->where('c.id', $id)->first();

        if ($customer) {
            return response()->json(['message' => 'Customer found', 'customer' => $customer]);
        } else {
            return response()->json(['message' => 'Customer not found'], 404);
        }

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


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'phone' => 'required|string',
            'address' => 'required|string'
        ]);

        try {

            if ($customer = Customer::where('email', $request->email)->where('id', '!=', $id)->first()) {
                return response()->json(['message' => 'The email is already in use'], 400);
            }
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
        $customer = Customer::find($id);
        $customer->update($request->all());
        return response()->json([
            'message' => 'Cliente actualizado exitosamente'
        ], 200);
    }


    public function destroy($id)
    {
        if (!$customer = Customer::find($id)) {
            return response()->json(['message' => 'Customer not found'], 404);
        } else {
            $customer->delete();
            return response()->json(['message' => 'Customer deleted successfully'], 200);
        }
        $customer = Customer::find($id);
        $customer->delete();
        return response()->json([
            'message' => 'Cliente eliminado exitosamente'
        ], 200);
    }
}

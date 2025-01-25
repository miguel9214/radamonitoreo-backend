<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Supplier;
use Illuminate\Database\QueryException;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        try {
            $search = $request->input('search');

            $query = DB::table("suppliers as s")->select(
                "s.id",
                "s.rut",
                "s.company_name",
                "s.name",
                "s.email",
                "s.phone",
                "s.address"
            );

            if ($search) {
                $query->where('s.name', 'like', '%' . $search . '%');
            }

            $supplierList = $query->paginate(5);

            return response()->json(['message' => 'Supplier list', 'suppliers' => $supplierList], 200);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error getting supplier list', 'error' => $e->errorInfo], 400);
        }
    }

    public function show($id)
    {
        try {

            $supplier = DB::table('suppliers as s')->select(
                's.id',
                's.rut',
                's.company_name',
                's.name',
                's.email',
                's.phone',
                's.address'
            )->where('s.id', $id)->first();

            return response()->json(['message' => 'Supplier details', 'supplier' => $supplier], 200);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error getting supplier details', 'error' => $e->errorInfo], 400);
        }
    }

    public function store(Request $request)
    {

        $request->validate([
            'rut' => 'required|string|unique:suppliers',
            'company_name' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|string|email|unique:suppliers',
            'phone' => 'required|string',
            'address' => 'required|string'
        ]);

        try {
            $supplier = new Supplier();
            $supplier->rut = $request->rut;
            $supplier->company_name = $request->company_name;
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->created_by_user = auth()->user()->id;
            $supplier->save();
            return response()->json(['message' => 'Supplier created successfully', 'supplier' => $supplier], 201);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error creating supplier', 'error' => $e->errorInfo], 400);
        }
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'rut' => 'required|string|unique:suppliers,rut,' . $id,
            'company_name' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|string|email|unique:suppliers,email,' . $id,
            'phone' => 'required|string',
            'address' => 'required|string'
        ]);

        try {

            $supplier = Supplier::find($id);

            if (!$supplier) {
                return response()->json(['message' => 'Supplier not found'], 404);
            }

            if((Supplier::where('rut', $request->rut)->where('id', '!=', $id)->exists())||(Supplier::where('email', $request->email)->where('id', '!=', $id)->exists())){
                return response()->json(['message' => 'Supplier with this rut already exists'], 400);
            }


            $supplier = Supplier::find($id);
            $supplier->rut = $request->rut;
            $supplier->company_name = $request->company_name;
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->updated_by_user = auth()->user()->id;
            $supplier->save();
            return response()->json(['message' => 'Supplier updated successfully', 'supplier' => $supplier], 200);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error updating supplier', 'error' => $e->errorInfo], 400);
        }
    }

    public function destroy($id)
    {
        try {

            if(!$supplier = Supplier::find($id)){
                return response()->json(['message' => 'Supplier not found'], 404);
            }else{
                $supplier->delete();
                return response()->json(['message' => 'Supplier deleted successfully'], 200);
            }
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error deleting supplier', 'error' => $e->errorInfo], 400);
        }
    }
}

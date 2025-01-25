<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
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

        if($search) {
            $query->where('s.name', 'like', '%' . $search . '%');
        }

        $supplierList = $query->paginate(5);

        return response()->json(['message' => 'Supplier list', 'suppliers' => $supplierList], 200);

    }

    public function show($id)
    {
        $supplier = DB::table('suppliers as s')->select(
            's.id',
            's.rut',
            's.company_name',
            's.name',
            's.email',
            's.phone',
            's.address'
        )->where('s.id', $id)->first();

        if($supplier) {
            return response()->json(['message' => 'Supplier found', 'supplier' => $supplier], 200);
        } else {
            return response()->json(['message' => 'Supplier not found'], 404);
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

        $supplier = DB::table('suppliers')->insert([
            'rut' => $request->rut,
            'company_name' => $request->company_name,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'created_by_user' => auth()->user()->id
        ]);

        return response()->json(['message' => 'Supplier created successfully', 'supplier' => $supplier], 201);
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

        $supplier = DB::table('suppliers')->where('id', $id)->update([
            'rut' => $request->rut,
            'company_name' => $request->company_name,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ]);

        return response()->json(['message' => 'Supplier updated successfully', 'supplier' => $supplier], 200);
    }

    public function destroy($id)
    {
        $supplier = DB::table('suppliers')->where('id', $id)->delete();

        return response()->json(['message' => 'Supplier deleted successfully', 'supplier' => $supplier], 200);
    }


}

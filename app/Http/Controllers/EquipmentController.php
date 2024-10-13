<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipment;

class EquipmentController extends Controller
{
    public function index()
    {
        $paginate = true;
        $searchTerm = request('search');

        $filterTerm = request('filter');
        if($filterTerm){
            $query = Equipment::where('refcode','=', $filterTerm);
        }else{
            $query = Equipment::where('id','<>',null);
        }

        if($searchTerm || $filterTerm){
            $equipments = $query->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('description', 'like', '%' . $searchTerm . '%')
                      ->orWhere('quantity', 'like', '%' . $searchTerm . '%');
                    
            })->orderBy('id', 'desc')->get();
    
            $paginate = false;
        }else{
            $equipments = Equipment::orderBy('id', 'desc')->paginate(5);
            $paginate = true;
        }
        return view('pages.equipment', compact('equipments','paginate'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required'],
                'description' => ['required'],
                'quantity' => ['required'],
            ]);

            Equipment::create([
                'name' => $request->name,
                'description' => $request->description,
                'quantity' => $request->quantity,
            ]);
    
            return response()->json(['success' => true, 'message' => 'Equipment has been added.']);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['success' => false, 'errors' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required'],
                'description' => ['required'],
            ]);

            $equipment = Equipment::findOrFail($request->id);
            $equipment->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
    
            return response()->json(['success' => true, 'message' => 'Equipment info has been updated.']);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['success' => false, 'errors' => $e->getMessage()], 500);
        }
    }

    public function updateStock(Request $request)
    {
        try {
            $request->validate([
                'quantity' => ['required'],
            ]);

            $equipment = Equipment::findOrFail($request->id);
            $totalStock = $request->quantity + $equipment->quantity;
            $equipment->update([
                'quantity' => $totalStock,
            ]);
    
            return response()->json(['success' => true, 'message' => 'Equipment stock has been updated.']);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['success' => false, 'errors' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $equipment = Equipment::findOrFail($id);
            $equipment->delete();
            return response()->json(['success' => true, 'message' => 'Equipment has been deleted.']);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['success' => false, 'errors' => $e->getMessage()], 500);
        }
       
    }
}

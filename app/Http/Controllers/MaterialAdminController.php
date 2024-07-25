<?php

namespace App\Http\Controllers;

use App\Models\Materials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaterialAdminController extends Controller
{
    public function materialsadminView()
    {
        $materials = Materials::all();
        return view('admin/materials/materials', compact('materials'));
    }

    public function showAddMaterialsForm()
    {
        return view('admin/materials/addmaterials');
    }

    public function addMaterials(Request $request)
    {
        $request->validate([
            'material' => 'required|string|max:255',
            'material_desc' => 'required|string|max:255',
        ]);

        $latestMaterial = Materials::orderBy(DB::raw('CAST(SUBSTRING(material_id, 2) AS UNSIGNED)'), 'desc')->first();
        if ($latestMaterial) {
            $lastMaterialId = intval(substr($latestMaterial->material_id, 1));
            $newMaterialId = 'M' . str_pad($lastMaterialId + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newMaterialId = 'M0001';
        }

        Materials::create([
            'material_id' => $newMaterialId,
            'material' => $request->input('material'),
            'material_desc' => $request->input('material_desc'),
        ]);

        return redirect()->route('materials')->with('success', 'Material added successfully');
    }

    public function editMaterials($id)
    {
        $material = Materials::findOrFail($id);
        return view('admin/materials/editmaterials', compact('material'));
    }

    public function updateMaterials(Request $request, $id)
    {
        $request->validate([
            'material' => 'required|string|max:255',
            'material_desc' => 'required|string|max:255',
        ]);

        $material = Materials::findOrFail($id);
        $material->update([
            'material' => $request->input('material'),
            'material_desc' => $request->input('material_desc'),
        ]);

        return redirect()->route('materials')->with('success', 'Materials updated successfully');
    }

    public function deleteMaterials($id)
    {
        $material = Materials::findOrFail($id);
        $material->delete();

        return redirect()->route('materials')->with('success', 'Materials deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Materials;
use App\Models\Product;
use App\Support\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaterialAdminController extends Controller
{
    public function materialsadminView()
    {
        $materials = Materials::query()->withCount('products')->orderBy('material')->get();

        return view('admin/materials/materials', compact('materials'));
    }

    public function showAddMaterialsForm()
    {
        return view('admin/materials/addmaterials');
    }

    public function addMaterials(Request $request)
    {
        $data = $this->validated($request);

        DB::transaction(fn () => Materials::create([
            'material_id' => IdGenerator::next('materials', 'material_id', 'M'),
            ...$data,
        ]));

        return redirect()->route('materials')->with('success', 'Material berhasil ditambahkan.');
    }

    public function editMaterials(string $id)
    {
        $material = Materials::findOrFail($id);

        return view('admin/materials/editmaterials', compact('material'));
    }

    public function updateMaterials(Request $request, string $id)
    {
        Materials::findOrFail($id)->update($this->validated($request));

        return redirect()->route('materials')->with('success', 'Material berhasil diperbarui.');
    }

    public function deleteMaterials(string $id)
    {
        $material = Materials::findOrFail($id);

        if (Product::query()->where('material_id', $material->material_id)->exists()) {
            return redirect()->route('materials')
                ->with('error', 'Material masih dipakai oleh produk, ubah produknya terlebih dahulu.');
        }

        $material->delete();

        return redirect()->route('materials')->with('success', 'Material berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'material' => ['required', 'string', 'max:255'],
            'material_desc' => ['required', 'string', 'max:1000'],
        ]);
    }
}

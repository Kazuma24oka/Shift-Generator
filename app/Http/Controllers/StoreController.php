<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function createStore()
    {
        return view('employees.create-store');
    }

    public function storeStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Store::create([
            'name' => $request->name,
        ]);

        return redirect()->route('employees.information')->with('success', '店舗情報が登録されました。');
    }

    public function editStore($id)
    {
        $store = Store::find($id);
        return view('employees.edit-store', compact('store'));
    }

    public function updateStore(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $store = Store::find($id);
        $store->update([
            'name' => $request->name,
        ]);

        return redirect()->route('employees.information')->with('success', '店舗情報が更新されました。');
    }
}
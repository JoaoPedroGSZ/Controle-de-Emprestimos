<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all(); 

    
        return view('items.index', compact('items'));
    }

    public function emprestar(Item $item){
        if($item->status === 'disponivel'){
            $item->status = 'emprestado';
            $item->save();

            return redirect()->route('items.index')->with('success', 'Item emprestado com sucesso!');
        }

        return redirect()->route('items.index')->with('error', 'Item não disponível para empréstimo!');

    }

    public function devolver(Item $item){
        if($item->status === 'emprestado'){
            $item->status = 'disponivel';
            $item->save();

            return redirect()->route('items.index')->with('success', 'Item devolvido com sucesso!');
        }

        return redirect()->route('items.index')->with('error', 'Item não está emprestado!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'status' => 'nullable|in:disponivel,emprestado',
        ]);

        Item::create($validatedData);

        return redirect()->route('items.index')->with('success', 'Item criado com sucesso!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
{
    $validatedData = $request->validate([
        'nome' => 'required|string|max:255',
        'descricao' => 'required|string',
        'status' => 'required|in:disponivel,emprestado,manutencao',
    ]);

    $item->update($validatedData);

    return redirect()->route('items.index')->with('success', 'Item atualizado com sucesso!');
}

       public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deletado com sucesso!');
    }
}

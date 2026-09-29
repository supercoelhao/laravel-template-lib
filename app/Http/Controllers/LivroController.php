<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Livro;
use Illuminate\Support\Facades\Redirect;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $livros = livro::all();
        return view('livros.index', ['livros' => $livros]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('livros.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $livros = $request ->validate([
    'titulo' => ['required', 'string', 'max:255'],
    'autor' => ['required', 'string', 'max:255'],
    'ano_publicacao' => ['required', 'integer', 'min:1000', 'max:' . now()->year],
    'isbn' => ['nullable', 'string', 'max:20'],
    ]);

        livro::create($livros); 
        return redirect()->route('livros.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $livro = livro::find($id);
        return view("livros.edit", ["livro" => $livro]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $livroDados = $request->validade([
    'titulo' => ['required', 'string', 'max:255'],
    'autor' => ['required', 'string', 'max:255'],
    'ano_publicacao' => ['required', 'integer', 'min:1000', 'max:' . now()->year],
    'isbn' => ['nullable', 'string', 'max:20'],
    ]);

    $livro = livro::find($id);
    $livro -> update($livroDados);
    return redirect()->route("livros.index");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        livro::destroy($id);
        return redirect()->route("livros.index");
    }
}

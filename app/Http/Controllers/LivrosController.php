<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivrosRequest;
use App\Models\Livros;
use App\Models\LivrosCategorias;
use Illuminate\Facades\File;
use Illuminate\Http\Request;
Use App\Services\Book\BookService;
use PhpParser\Node\Stmt\TryCatch;
use RealRashid\SweetAlert\Facades\Alert;
use App\Exceptions\BookCreateException;

class LivrosController extends Controller
{

    private $bookService;

    public function __construct(BookService $bookService)
    {

        $this->bookService = $bookService;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 

    public function index()
    {
      
    return view('livros.index');
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $categorias = LivrosCategorias::all();

        return view('livros.create', compact('categorias'));
  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LivrosRequest $request)
    {
        try{

          $this->bookService->create($request);

           toast('Livro cadastrado com Sucesso','success');
           return redirect()->route('livros.index');
            
        }catch(BookCreateException $e){

            toast($e->getMessage(),'error');
            return redirect()
                ->back()
                ->withInput();
        }
 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Livros  $livros
     * @return \Illuminate\Http\Response
     */
    public function show(Livros $livros)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Livros  $livros
     * @return \Illuminate\Http\Response
     */
    public function edit(Livros $livros)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Livros  $livros
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Livros $livros)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Livros  $livros
     * @return \Illuminate\Http\Response
     */
    public function destroy(Livros $livros)
    {
        //
    }
}

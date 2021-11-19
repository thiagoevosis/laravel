<?php

namespace App\Services\Book;
use App\Models\Livros;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Exceptions\BookCreateException;

class bookService
{
    public function index()
    {



    }

    public function find(int $id): ?int
    {
        return $id;
    }

    public function create(Request $request ): ?Livros
    {

        $livro = Livros::create($request->only([
            'titulo',
            'autor',
            'editora',
            'ano',
            'edicao',
            'paginas',
            'descricao',
            'preco',
            'imagem',
            'id_categoria'
        ]));

     
        if(!empty($request->imagem)){
            $extensao = $request->imagem->extension();
            $name = uniqid(date('H'));
            $nomeImagem = "{$name}.{$extensao}";
            $request->imagem->storeAs('photos', $nomeImagem);
            $livro->imagem = $nomeImagem;
        }
     
        if($livro) throw new BookCreateException('Erro ao cadastrar Livro',401);
           // toast('Livro cadastrado com Sucesso','success');
           // return redirect()->route('livros.index');
   
      
        return $livro;
    }

    public function update()
    {


    }

    public function delete()
    {


    }
}
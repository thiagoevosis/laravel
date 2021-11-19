<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Categorias;
use App\Models\Livros as ModelLivros;
use App\Models\LivrosCategorias;
use GuzzleHttp\Psr7\UploadedFile;
use Livewire\Component;
use Livewire\WithFileUploads;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\File; 
class Livros extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $livros;
    public  $categorias , $categoria, $titulo, $autor, $editora, $ano, $edicao,  $paginas, $descricao, $categoria_id ,$imagem ,$imagembanco;
    public $updateMode = false;
    public $id_livro;
    public $id_categoria;
    public $checkedCountry = [];
    public $procurar =null;
    public $selectFormato ;
    public $tipo ;
    public $selectCategoria= null;
    protected $listeners = ['refreshComponent' => '$refresh'];


    public function render()
    {
        return view('livewire.livros');
    }


    public function mount()
  
    {

 
     if(!empty($this->selectCategoria)){
        $this->livros = ModelLivros::where('categoria_id',$this->selectCategoria)->get();
     }else{
        $this->livros = ModelLivros::all();
     }
     $this->categorias = LivrosCategorias::all(); 
   
   }


    private function resetInputFields(){
        $this->categoria = '';
     
    }


    public function edit($id)
    {
        
        $livro = ModelLivros::where('id',$id)->first();
        $this->titulo = $livro->titulo;
        $this->id_livro = $livro->id;
        $this->autor = $livro->autor;
        $this->editora = $livro->editora;
        $this->ano = $livro->ano;
        $this->edicao = $livro->edicao;
        $this->tipo = $livro->tipo;
        $this->paginas = $livro->paginas;
        $this->descricao = $livro->descricao;
        $this->imagembanco = $livro->imagem;
        $this->id_categoria = $livro->id_categoria;

        $this->updateMode = true;
        
    }
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();


    }

    public function update($id)
    {
       


        $validatedDate = $this->validate([
            'titulo' => 'required',
            'autor' => 'required',
            'titulo' => 'required',
            'tipo' => 'required',
            'paginas' => 'required',
            'autor' => 'required',
            'id_categoria' => 'required',
            'descricao' => 'required',
           
        ]);

        if (!empty($id)) {

            $livros = ModelLivros::find($id);
    
             if(!empty($this->imagem)){
                $extensao = $this->imagem->extension();
                $nomeImagem = "{$id}.{$extensao}";
                $this->imagem->storeAs('photos', $nomeImagem);
                File::delete($this->imagem-> getRealPath());
       
        }
            if(empty($this->imagem)){
                $nomeImagem = $this->imagembanco;
            }

            $livros->update([
                'titulo' => $this->titulo,
                'autor' => $this->autor,
                'editora' => $this->editora,
                'ano' => $this->ano,
                'tipo' => $this->tipo,
                'edicao' => $this->edicao,
                'paginas' => $this->paginas,
                'descricao' => $this->descricao,
                'imagem' => $nomeImagem,
                'id_categoria' => $this->id_categoria,
               
            ]);
            $this->alert('success', 'Livro Atualizado com Sucesso!');
            $this->resetInputFields();
            $this->emit('refreshComponent');
        }
    }
    public function delete($id)
    {
        if($id){
            ModelLivros::where('id',$id)->delete();

            $this->alert('success', 'Livro Atualizado com Sucesso!');
            
            $this->refresh();
          
          
        }
    }
    public function refresh()
    {
        $this->emit('refreshComponent');
    } 

    public function updatedSelectFormato()
    {

             if(!empty($this->selectFormato)){
  
            $this->livros = ModelLivros::where('tipo','like', '%' .$this->selectFormato.'%')->get();
    
            }else{
                $this->livros = ModelLivros::all();
            }
    } 
    public function updatedSelectCategoria()
    {
    
        if(!empty($this->selectCategoria)){
  
        $this->livros = ModelLivros::where('id_categoria',$this->selectCategoria)->get();


        }else{
            $this->livros = ModelLivros::all();
        }
    }

    public function updatedProcurar()
    {

        if(!empty($this->procurar)){

            $this->livros = ModelLivros::where('titulo','like', '%' .$this->procurar.'%')->
            where('id_categoria','like', '%' .$this->selectCategoria.'%')->get();
       
        }else{
            $this->livros = ModelLivros::all();
        }
    }



}
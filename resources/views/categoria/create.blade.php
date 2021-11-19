
@extends('layouts.master')

@section('content')
<div class="page-header">
    <h4 class="page-title">Livros</h4>
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a href="{{route('dashboard')}}">
                <i class="flaticon-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
     
        <li class="nav-item">
            <a href="#">Adicionar</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <a href="{{route('livros.index')}}" > Listar categoria</a>
    </ul>
  
</div>
    
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#categoria-create">
    Adicionar Categoria
</button>

@endsection
<div  class="modal fade" id="categoria-create" tabindex="-1" role="dialog" aria-labelledby="categoria-create" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoria-create">Adicionar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <form  class="form-control" action="{{route('categorias.store')}}" method="post" enctype="multipart/form-data">
                @csrf
           <div class="modal-body">
           

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nome da Categoria</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Name" name="categoria">
                        @error('categoria') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <button type="submit"class="btn btn-primary close-modal">Save changes</button>
            </div>
            
        </form>
        </div>
    </div>
</div>
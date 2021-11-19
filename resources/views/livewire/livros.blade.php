<div>

    @include('livros.editar')
    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">x
          {{ session('message') }}
        </div>
    @endif
        <div class="card">
            <div class="card-header">
                <div class="form-group">
                    <div class="row">
                <div class="col-md-6">
                    <div class="input-icon">
                        <input wire:model="procurar" type="text" name="procurar" id="procurar" class="form-control" placeholder="Pesquisar ..." >
                        <span class="input-icon-addon">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
                    <div class="input-icon">
                       <select  wire:model="selectFormato" class="form-control" name="selectFormato" id="selectFormato">
                        <option >Selecione o Formato</option>
                            <option value="%">Todos </option>
                            <option value="Digital">Digital</option>
                            <option value="Impresso">Impresso</option>
                        </select>
                    </div>
                    <div class="input-icon">
                        <select wire:model="selectCategoria" class="form-control" name="selectCategoria" id="selectCategoria">
                             <option value="">Selecione a Categoria</option>
                             <option value="%">Todas</option>
                             @if (!Empty($categorias))
                                @foreach ($categorias as $categoria)
                                    <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
                                @endforeach
                                @endif
                         </select>
                     </div>
                    <div class="col-md-2">
                    <a href="{{route('livros.create')}}" class="btn btn-primary"> Adicionar Livro</a>
                 </div>
            </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-head-bg-success">
              
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Titulo</th>
                                <th>Autor</th>
                                <th>Editora</th>
                                <th>Categoria</th>
                                <th>Lancamento</th>
                                <th>Tipo</th>
                                <th>Editar</th>
                                <th>Deletar</th>
                            </tr>
                        </thead>
                        <tbody>
                
                      
                            @foreach($livros as $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->titulo }}</td>
                                <td>{{ $value->autor }}</td>
                                <td>{{ $value->editora }}</td>
                                <td>{{ $value->Categoria->categoria }}</td>
                                <td>{{ $value->ano }}</td>
                                <td>{{$value->tipo}}</td>                                
                                <td>
                                <button data-toggle="modal" data-target="#updateModal" wire:click="edit({{ $value->id }})" class="btn btn-primary btn-sm">Editar</button>
                                </td>
                                <td>
                                    <button wire:click="delete({{ $value->id }})" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>

    <script type="text/javascript">
        window.livewire.on('userStore', () => {
            $('#livro-create').modal('hide');
        });
    </script>
</div>
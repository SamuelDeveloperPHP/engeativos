@extends('dashboard')
@section('title', 'Funções CBO')
@section('content')


<div class="row">
    <div class="col-2 breadcrumb-item active" aria-current="page">
        <h3 class="page-title text-center">
            <span class="page-title-icon bg-gradient-primary me-2">
                <i class="mdi mdi-account-hard-hat  mdi-24px"></i>
            </span> Funções
        </h3>
    </div>

    <div class="col-4 active m-2">
        <h5 class="page-title text-left m-0">
            <span>Cadastros <i class="mdi mdi-check icon-sm text-primary align-middle"></i></span>
        </h5>
    </div>

</div>

<hr>

<div class="row my-4">
    <div class="col-2">
        <h3 class="page-title text-left">
            @if (session()->get('usuario_vinculo')->id_nivel == 1 or session()->get('usuario_vinculo')->id_nivel == 10 or session()->get('usuario_vinculo')->id_nivel == 15 or session()->get('usuario_vinculo')->id_nivel == 14) 
            <a href="{{ route('cadastro.funcionario.funcoes.create') }}">
                <span class="btn btn-sm btn-success">Novo Registro</span>
                </a>
                @endif
        </h3>
    </div>

    <div class="col-10">
        <form action="{{ route('cadastro.funcionario.funcoes.index') }}" method="GET" class="mb-4">
            @csrf
            
            <div class="row justify-content-center">
                <div class="col-5 m-0 p-0 ">
                    <input type="text" class="form-control shadow" name="funcao" placeholder="Pesquisar categoria" value="{{ request()->funcao }}">
                </div>
                <div class="col-2 text-left  m-0 p-0 mb-2 mx-2">

                    <button type="submit" class="btn btn-primary btn-sm py-0 shadow" title="Pesquisar"><i class="mdi mdi-file-search-outline mdi-24px"></i></button>

                    <a href="{{ route('cadastro.funcionario.funcoes.index') }}" title="Limpar pesquisa">
                        <span class="btn btn-warning btn-sm py-0 shadow"><i class="mdi mdi-delete-outline mdi-24px"></i></span>
                    </a>
                </div>
                <div class="col-1 text-left m-0">

                </div>
            </div>
        </form>
    </div>
</div>


<hr class="my-3">

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle table-nowrap mb-0">
                        <thead>
                            <tr>
                                <th class="text-center" width="8%">ID</th>
                                <th>Código</th>
                                <th>Função</th>
                                <th class="text-center" width="10%">Qtd Funcionários</th>
                                @if (session()->get('usuario_vinculo')->id_nivel <= 1 or session()->get('usuario_vinculo')->id_nivel == 10 or session()->get('usuario_vinculo')->id_nivel == 15)
                                    <th class="text-center" width="10%">Ações</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($funcoes as $funcao)
                            <tr>
                                <td class="text-center align-middle">{{ $funcao->id }}</td>
                                <td class="align-middle">{{ $funcao->codigo }}</td>
                                <td class="align-middle">{{ $funcao->funcao }}</td>
                                <td class="align-middle text-center">{{ $funcao->funcionarios ? count($funcao->funcionarios) : 0 }}</td>
    
                                <td class="text-center {{ session()->get('usuario_vinculo')->id_nivel <= 1 or session()->get('usuario_vinculo')->id_nivel == 10 or session()->get('usuario_vinculo')->id_nivel == 15 ? 'd-block' : 'd-none' }}">
                                    <div class="hstack gap-3 fs-15">
                                        <a class="btn  btn-success btn-sm" href="{{ route('cadastro.funcionario.funcoes.show', $funcao->id) }}"><i class="mdi mdi-eye-outline"></i></a>
    
                                        <a class="btn  btn-warning btn-sm" href="{{ route('cadastro.funcionario.funcoes.edit', $funcao->id) }}"><i class="mdi mdi-pencil-outline"></i></a>
    
    
    
                                        <form action="{{ route('cadastro.funcionario.funcoes.destroy', $funcao->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn  btn-danger btn-sm" data-toggle="tooltip" data-placement="top" type="submit" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir o registro?')">
                                                <i class="mdi mdi-delete-outline"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end col-sm-12 col-md-12 col-lg-12 ">
                    <div class="paginacao">
                        {{$funcoes->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@extends('app')
@section('titulo', 'Pagina Inicial')

@section('conteudo')
   <h1>Lista de Diaristas</h1>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Telefone</th>
                <th scope="col">Ações</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($diaristas as $diarista)
                    <tr>
                    <th scope="row">{{ $diarista->id }}</th>
                    <td>{{ $diarista->nome_completo }}</td>
                    <td>{{ \Clemdesign\PhpMask\Mask::apply($diarista->telefone, '(00) 00000-0000') }}</td>
                    <td>
                        <a href="{{route('diarista.edit', $diarista)}}" class="btn btn-primary">Atualizar</a>
                        <a href="{{route('diarista.destroy', $diarista)}}" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja apagar?')">Excluir</a>
                    </td>
                    </tr>
                    @empty
                    <tr>
                    <th scope="row"></th>
                    <td>Nenhum registro cadastrado</td>
                    <td></td>
                    <td></td>
                    </tr>
                    @endforelse
            </tbody>

        </table>
         <a class="btn btn-success" href="{{route('diarista.create')}}">Nova Diarista</a>
@endsection

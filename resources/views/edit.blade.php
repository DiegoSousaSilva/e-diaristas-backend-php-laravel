@extends('app')
@section('titulo', 'Editar Diarista')
<h1>Editar Diarista</h1>
        <form action="{{ route('diarista.update', $diarista) }}" method="POST" enctype="multipart/form-data">
            @include('_form')
            @method('PUT')


        </form>
@section('conteudo')




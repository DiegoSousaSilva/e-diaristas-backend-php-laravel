@extends('app')
@section('titulo', 'Criar Diarista')
<h1>Criar Diarista</h1>
        <form action="{{ route('diarista.store') }}" method="POST" enctype="multipart/form-data">
          @include('_form')
        </form>
@section('conteudo')




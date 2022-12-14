@extends('dashboard.index')

@section('css')

@endsection

@section('title')
@section('pagename')
@section('object')

@section('content')
<p>home page _ {{auth('owner')->id();}}</p>
@endsection

@section('js')

@endsection

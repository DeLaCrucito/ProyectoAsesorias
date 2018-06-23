@extends('templates.static')
@section('body')
    <header>@yield('header')</header>
    <aside>@yield('aside')</aside>
    <main>@yield('main')</main>
    <footer class="page-footer transparent">@yield('footer')</footer>
@endsection
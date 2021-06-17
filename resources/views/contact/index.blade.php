@extends('layouts.app_admin')

@section('content')

<h1>問い合わせ一覧</h1>

@foreach ($contacts as $contact)
<p>{{ $contact->content }}</p>
<p>{{ $contact->email }}</p>
<p>{{ $contact->status }}</p>
<p>{{ $contact->created_at }}</p>

@endforeach

@endsection
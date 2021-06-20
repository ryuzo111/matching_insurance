@extends('layouts.app_admin')

@section('content')

<h1>問い合わせ一覧</h1>

@foreach ($contacts as $contact)
	<p>{{ $contact->created_at }}</p>
	<p>お問い合わせ内容:{{ $contact->content }}</p>
	<p>お問い合わせ者のメールアドレス:{{ $contact->email }}</p>
	<p>対応状況:{{ config('status.' . $contact->status) }}</p>
	@if ($contact->status === 0)
		<a href="{{ route('contact.show_answer_form', ['contact_id' => $contact->id]) }}">回答する</a>
		</br>
		<a href="{{ route('contact.change_status', ['contact_id' => $contact->id]) }}">対応状況を対応中にする</a>
	@elseif ($contact->status === 1) 
		<a href="{{ route('contact.show_answer_form', ['contact_id' => $contact->id]) }}">回答する</a>
		</br>
		<a href="{{ route('contact.change_status', ['contact_id' => $contact->id]) }}">対応状況を解決済みにする</a>
	@endif
	</br>
	</br>
@endforeach

@endsection
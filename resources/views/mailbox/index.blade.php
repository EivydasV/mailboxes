@extends('layout.layout')

@section('content')
    <div class="d-flex flex-column gap-3">
        @include('mailbox.component.form')
        @include('mailbox.component.table')
    </div>
    <div class="d-flex justify-content-center">
        @if (method_exists($mailboxes, 'appends'))
            {{ $mailboxes->appends(request()->except('page'))->links() }}
        @endif
    </div>
@endsection

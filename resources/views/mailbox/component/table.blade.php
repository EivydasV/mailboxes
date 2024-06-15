<table class="table table-dark table-striped">
    <thead>
    <tr>
        @foreach($columns as $column)
            <th>{{ $column }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($mailboxes as $mailboxPage)
        <tr>
        @foreach($mailboxPage->toArray() as $mailbox)
            <td>{{ $mailbox }}</td>
            @endforeach
        </tr>
    @endforeach

    </tbody>
</table>

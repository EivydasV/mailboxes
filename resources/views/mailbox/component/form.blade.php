<div class="d-flex flex-column gap-2">
    <form action="{{ route('mailboxes') }}" method="GET">
        <div class="d-flex justify-content-center gap-2">
            <div class="">
                <label for="column" class="form-label">Column</label>
                <select class="form-select" aria-label="Default select example" id="column" name="column">
                    <option value="">Select Value</option>
                    @foreach($columns as $column)
                        <option value="{{ $column }}"
                                @if(request()->query('column') === $column) selected @endif>{{ $column }}</option>
                    @endforeach
                </select>
                @error('column')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="">
                <label for="operator" class="form-label">Operator</label>
                <select class="form-select" aria-label="Default select example" id="operator" name="operator">
                    <option value="">Select Value</option>
                    <option value="contains" @if(request()->query('operator') === 'contains') selected @endif>contains
                    </option>
                    <option value="equal" @if(request()->query('operator') === 'equal') selected @endif>equal</option>
                    <option value="not_equal" @if(request()->query('operator') === 'not_equal') selected @endif>not
                        equal
                    </option>
                </select>
                @error('operator')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="">
                <label for="value" class="form-label">Value</label>
                <input type="text" class="form-control" id="value" placeholder="Search" name="value"
                       value="{{ request()->query('value') }}">
                @error('value')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="">
                <label for="address" class="form-label">Search nearest mailboxes</label>
                <input type="text" class="form-control" id="address" placeholder="Address" name="address"
                       value="{{ request()->query('address') }}">
                @error('address')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex align-items-end">
                <button type="submit" class="btn btn-primary d-inline">Filter</button>
            </div>
        </div>
    </form>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
</div>

@if(count($types) > 0)
    <option value="">Select One</option>
    @foreach ($types as $type)
        <option value="{{ $type->its_protype_slno }}">
            {{ $type->its_protype_name }}
        </option>
    @endforeach
@endif



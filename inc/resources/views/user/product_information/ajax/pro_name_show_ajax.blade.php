@if (count($product_names) > 0)
    <option value="">Select One</option>
    @foreach ($product_names as $name)
        <option value="{{ $name->its_proname_slno }}">
            {{ $name->its_proname_product_name }}
        </option>
    @endforeach
@endif


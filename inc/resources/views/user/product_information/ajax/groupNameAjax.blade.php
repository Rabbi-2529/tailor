@if(count($group_names) > 0)
    <option value="">Select One</option>
        @foreach ($group_names as $group_name)
        <option value="{{ $group_name->its_proname_group_id }}">
            {{ $group_name->groupName->its_inv_progrp_name }}
        </option>
    @endforeach
@endif


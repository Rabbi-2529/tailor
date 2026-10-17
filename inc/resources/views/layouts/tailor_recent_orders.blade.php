{{--
    Recent orders card for the branch and staff dashboards (read-only).
    Expects: $tl_com, $tl_bran (company / branch ids), $tl_detail_route (customer-order-details route name),
             $tl_all_route (route name for the "view all" link)
--}}
@php
    $tl_recent_orders = App\Models\IglTailorAddOrder::with('customer_name')
        ->select(
            'its_add_order_order_id',
            'its_add_order_cus_id',
            DB::raw('MAX(its_add_order_receive_date) as tl_receive_date'),
            DB::raw('MAX(its_add_order_delivery_date) as tl_delivery_date'),
            DB::raw('MIN(its_add_order_status) as tl_status_min'),
            DB::raw('MAX(its_add_order_status) as tl_status_max'),
            DB::raw('COUNT(*) as tl_items')
        )
        ->where('its_add_order_com_id', $tl_com)
        ->where('its_add_order_bran_id', $tl_bran)
        ->groupBy('its_add_order_order_id', 'its_add_order_cus_id')
        ->orderBy('its_add_order_order_id', 'desc')
        ->limit(8)
        ->get();

    // same status codes the order report pages use
    $tl_status_map = [
        0 => ['With maker', 'processing'],
        1 => ['Pending', 'pending'],
        2 => ['Received', 'received'],
        3 => ['Processing', 'processing'],
        4 => ['Complete', 'complete'],
        5 => ['Delivered', 'delivered'],
    ];
@endphp
<div class="card">
    <div class="card-header d-flex align-items-center">
        <h3 class="card-title mb-0">Recent Orders</h3>
        <a href="{{ route($tl_all_route) }}" class="btn btn-sm btn-default ml-auto">View all <i class="fas fa-arrow-right ml-1"></i></a>
    </div>
    <div class="card-body p-0 table-responsive">
        @if ($tl_recent_orders->isEmpty())
            <div class="tl-empty">
                <i class="fas fa-ruler-combined"></i>
                No orders yet. New orders will show up here.
            </div>
        @else
        <table class="table tl-orders mb-0">
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Customer</th>
                    <th>Received</th>
                    <th>Delivery</th>
                    <th class="text-center">Items</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tl_recent_orders as $tl_order)
                    @php
                        $tl_name = optional($tl_order->customer_name)->its_cus_name ?? 'Walk-in';
                        $tl_initials = collect(preg_split('/\s+/', trim($tl_name)))->filter()->take(2)
                            ->map(function ($w) { return mb_strtoupper(mb_substr($w, 0, 1)); })->implode('');
                        $tl_status = $tl_order->tl_status_min == $tl_order->tl_status_max
                            ? ($tl_status_map[$tl_order->tl_status_min] ?? ['Pending', 'pending'])
                            : ['In progress', 'mixed'];
                    @endphp
                    <tr>
                        <td><span class="tl-order-id">#{{ $tl_order->its_add_order_order_id }}</span></td>
                        <td>
                            <div class="tl-customer">
                                <span class="tl-initials">{{ $tl_initials ?: '?' }}</span>
                                <div>
                                    {{ $tl_name }}
                                    <small>{{ optional($tl_order->customer_name)->its_cus_mobile }}</small>
                                </div>
                            </div>
                        </td>
                        <td>{{ $tl_order->tl_receive_date ? \Carbon\Carbon::parse($tl_order->tl_receive_date)->format('d M Y') : '-' }}</td>
                        <td>{{ $tl_order->tl_delivery_date ? \Carbon\Carbon::parse($tl_order->tl_delivery_date)->format('d M Y') : '-' }}</td>
                        <td class="text-center">{{ $tl_order->tl_items }}</td>
                        <td><span class="tl-status tl-status-{{ $tl_status[1] }}">{{ $tl_status[0] }}</span></td>
                        <td class="text-right">
                            <a href="{{ route($tl_detail_route, base64_encode($tl_order->its_add_order_order_id)) }}" class="btn btn-sm btn-default" title="Order details">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>

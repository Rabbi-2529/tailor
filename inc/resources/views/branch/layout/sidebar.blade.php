<aside class="main-sidebar sidebar-dark-primary elevation-4">
    @include('layouts.tailor_brand', ['tl_home' => route('branch.dashboard')])

    <!-- Sidebar -->
    <div class="sidebar">
      <div class="user-panel tl-user-card d-flex">
        <div class="image">
          <img src="{{ asset('') }}{{ Auth::user()->BranchDetailsUser->its_branch_com_logo }}" class="img-circle" alt="User Image" onerror="this.onerror=null;this.src='{{ asset('assets/dist/img/avatar04.png') }}'">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->its_username }}</a>
          <small>Branch Manager</small>
        </div>
      </div>

      @php
          $user_slno = Auth::user()->its_slno;
      @endphp

      {{-- Quick actions: "Order Now" needs a price list and making cost first --}}
      <div class="tl-quick">
        @if (!App\Models\IglTailorPriceList::where('its_price_list_submit_by', $user_slno)->exists())
          <a href="{{ route('branch.price-update.price-update') }}" class="tl-quick-main tl-quick-setup" title="Set your price list before taking orders">
            <i class="fas fa-list-alt"></i> Order Now <small>&middot; set prices</small>
          </a>
        @elseif(!App\Models\IglTailorWorkerSalary::where('its_worker_submit_by', $user_slno)->exists())
          <a href="{{ route('branch.cost.set-making-cost') }}" class="tl-quick-main tl-quick-setup" title="Set making cost before taking orders">
            <i class="fas fa-dollar-sign"></i> Order Now <small>&middot; set cost</small>
          </a>
        @else
          <a href="{{ route('branch.order.order-now') }}" class="tl-quick-main">
            <i class="fas fa-ruler-combined"></i> Order Now
          </a>
        @endif
        <div class="tl-quick-row">
          <a href="{{ route('branch.buy.buy-product') }}"><i class="fas fa-shopping-cart"></i> Buy</a>
          <a href="{{ route('branch.sale.sale-product') }}"><i class="fas fa-tags"></i> Sale</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview @yield('dashboard')">
            <a href="{{ route('branch.dashboard') }}" class="nav-link @yield('dashboard_link')">
              <i class="nav-icon fas fa-th-large"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-header">ORDERS &amp; PEOPLE</li>
          {{-- Order --}}
          <li class="nav-item has-treeview @yield('order_report_class')">
            <a href="#" class="nav-link @yield('order_report_class_link')">
            <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                Order Report
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('branch.OrderReport.receive') }}" class="nav-link py-1  @yield('receiving_class')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Receive</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('branch.OrderReport.processing') }}" class="nav-link py-1 @yield('processing_class')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Processing</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('branch.OrderReport.waiting') }}" class="nav-link py-1 @yield('waiting_class')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Waiting For Complete</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('branch.OrderReport.order-details') }}" class="nav-link py-1 @yield('order_details')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Show Order Details</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('branch.OrderReport.order-list') }}" class="nav-link py-1 @yield('order_list')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Order Lists</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- End Order --}}

          {{-- Customer --}}
          <li class="nav-item has-treeview @yield('customer_class')">
            <a href="#" class="nav-link @yield('customer_class_link')">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Customers
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('branch.customer.customer-registration') }}" class="nav-link py-1 @yield('customer_registration')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer Registration</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('branch.customer.all-customer') }}" class="nav-link py-1 @yield('all_customer')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Customers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('branch.customer.payments') }}" class="nav-link py-1 @yield('payments')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Payments</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('branch.customer.view-statements') }}" class="nav-link py-1 @yield('view_statements')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Statement</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- End Customer --}}

          {{-- Worker --}}
          <li class="nav-item has-treeview @yield('worker_class')">
            <a href="#" class="nav-link @yield('worker_class_link')">
              <i class="nav-icon fas fa-cut"></i>
              <p>
                Maker
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('branch.worker.maker-registration') }}" class="nav-link py-1 @yield('maker_registration')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Maker Registration</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('branch.worker.maker-payment') }}" class="nav-link py-1 @yield('maker_payment')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Maker Payment</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('branch.worker.maker-pending-payment') }}" class="nav-link py-1 @yield('maker_pending_payment')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Maker Pending Payment</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('branch.worker.statement') }}" class="nav-link py-1 @yield('statement')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Statements</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- End Worker --}}

          {{-- User --}}
          <li class="nav-item has-treeview @yield('user_class')">
              <a href="#" class="nav-link @yield('user_class_link')">
                <i class="nav-icon fas fa-users-cog"></i>
                <p>
                  User
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('branch.user.user-registration') }}" class="nav-link py-1 @yield('user_registration')">
                    <i class="far fa-circle nav-icon"></i>
                    <p>User Registration</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('branch.user.user-list') }}" class="nav-link py-1 @yield('user_list')">
                    <i class="far fa-circle nav-icon"></i>
                    <p>User List</p>
                  </a>
                </li>
              </ul>
            </li>
          {{-- End User --}}
          <li class="nav-header">PRICING &amp; COSTS</li>
          {{-- Price Update --}}
          <li class="nav-item has-treeview @yield('price_update')">
              <a href="{{ route('branch.price-update.price-update') }}" class="nav-link @yield('price_update_link')">
              <i class="nav-icon fas fa-tags"></i>
                <p>
                  Price Update
                </p>
              </a>
            </li>
          {{-- End Price Update --}}

          {{-- Cost --}}
          <li class="nav-item has-treeview @yield('cost_class')">
            <a href="#" class="nav-link @yield('cost_class_link')">
           
  <i class="nav-icon fas fa-coins"></i>
  <p>
    Cost
    <i class="right fas fa-angle-left"></i>
  </p>
</a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('branch.cost.set-making-cost') }}" class="nav-link py-1 @yield('making_cost')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Set Making Cost</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('branch.cost.total-income-spend') }}" class="nav-link py-1 @yield('income_spend')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Total Income and Spend</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('branch.cost.expend') }}" class="nav-link py-1 @yield('expend_class')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Expend</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- End Cost --}}
          <li class="nav-header">FABRICS &amp; STOCK</li>
          {{-- Product Information --}}
          <li class="nav-item has-treeview @yield('product_information')">
            <a href="#" class="nav-link @yield('product_information_link')">
  <i class="nav-icon fas fa-tshirt"></i>
  <p>
    Product Information
    <i class="right fas fa-angle-left"></i>
  </p>
</a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('branch.ProductInformation.add-group') }}" class="nav-link py-1 @yield('add_group')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Group</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('branch.ProductInformation.view-group') }}" class="nav-link py-1 @yield('view_group')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Group</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('branch.ProductInformation.add-type') }}" class="nav-link py-1 @yield('add_type')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Product Type</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('branch.ProductInformation.view-type') }}" class="nav-link py-1 @yield('view_type')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Product Type</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('branch.ProductInformation.add-name') }}" class="nav-link py-1 @yield('add_name')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Product Name</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('branch.ProductInformation.view-name') }}" class="nav-link py-1 @yield('view_name')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Product Name</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('branch.ProductInformation.add-location') }}" class="nav-link py-1 @yield('add_location')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Location</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('branch.ProductInformation.view-location') }}" class="nav-link py-1 @yield('view_location')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Location</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('branch.ProductInformation.add-product') }}" class="nav-link py-1 @yield('add_product')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('branch.ProductInformation.view-product') }}" class="nav-link py-1 @yield('view_product')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Product</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- End Product Information --}}
          {{-- Supplier Information --}}
          <li class="nav-item has-treeview @yield('supplier_information')">
       <a href="#" class="nav-link @yield('supplier_information_link')">
  <i class="nav-icon fas fa-truck"></i>
  <p>
    Supplier Information
    <i class="right fas fa-angle-left"></i>
  </p>
</a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('branch.supplier.add') }}" class="nav-link py-1 @yield('add_supplier')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Supplier</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('branch.supplier.view') }}" class="nav-link py-1 @yield('view_supplier')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Supplier</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('branch.supplier.add-bank') }}" class="nav-link py-1 @yield('add_bank')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Supplier Bank</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('branch.supplier.payment-date') }}" class="nav-link py-1 @yield('payment_date')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Payment Date</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('branch.supplier.view-payment-date') }}" class="nav-link py-1 @yield('view_payment_date')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Payment Date</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('branch.supplier.payment') }}" class="nav-link py-1 @yield('supplier_payment')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Supplier Payment</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('branch.supplier.statement') }}" class="nav-link py-1 @yield('supplier_statement')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Supplier Statement</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- End Supplier Information --}}
          <li class="nav-header">FINANCE</li>
          {{-- Bank Details --}}
          <li class="nav-item has-treeview @yield('bank_details')">
          <a href="#" class="nav-link @yield('bank_details_link')">
  <i class="nav-icon fas fa-university"></i>
  <p>
    Bank Details
    <i class="right fas fa-angle-left"></i>
  </p>
</a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('branch.bank.open-bank-statement') }}" class="nav-link py-1 @yield('open_bank_statement')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Open Bank Account</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('branch.bank.bank-account-list') }}" class="nav-link py-1 @yield('bank_acc_list')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bank Account List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('branch.bank.bank-deposit') }}" class="nav-link py-1 @yield('bank_deposit')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bank Deposit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('branch.bank.bank-withdraw') }}" class="nav-link py-1 @yield('bank_withdraw')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bank WithDraw</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('branch.bank.cash-transfer') }}" class="nav-link py-1 @yield('cash_transfer')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cash Transfer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('branch.bank.bank-statement') }}" class="nav-link py-1 @yield('bank_statement')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bank Statement</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- End Bank Details --}}
          {{-- Account --}}
          <li class="nav-item has-treeview @yield('account_class')">
             <a href="#" class="nav-link @yield('account_class_link')">
                  <i class="nav-icon fas fa-file-invoice-dollar"></i>
                  <p>
                    Account
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('branch.account.account-statement') }}" class="nav-link py-1 @yield('account_statement')">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Account Statement</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('branch.account.buy-statement') }}" class="nav-link py-1 @yield('buy_statement')">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Product Buy Statement</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('branch.account.sell-statement') }}" class="nav-link py-1 @yield('sell_statement')">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Product Sell Statement</p>
                  </a>
                </li>
              </ul>
            </li>
          {{-- End Account --}}

          <li class="nav-header">SHOP</li>
          {{-- Edit --}}
          <li class="nav-item has-treeview @yield('logo_address')">
              <a href="{{ route('branch.logo-address.logo-address') }}" class="nav-link @yield('logo_address_link')">
                <i class="nav-icon fas fa-store"></i>
                <p>
                  Edit Logo and Address
                </p>
              </a>
            </li>
          {{-- End Edit --}}

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
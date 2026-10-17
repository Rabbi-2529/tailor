<aside class="main-sidebar sidebar-dark-primary elevation-4">
    @include('layouts.tailor_brand', ['tl_home' => route('user.dashboard')])
      @php
          $user_info = App\Models\IglTailorUserUser::where('its_user_login_id',Auth::User()->its_slno)->first();
          $permission_status = explode(',',$user_info->its_user_permission_status);
      @endphp
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="user-panel tl-user-card d-flex">
        <div class="image">
            @if (empty(Auth::user()->UserDetails->its_user_pic))
            <img src="{{ asset('assets/dist/img/avatar04.png') }}" class="img-circle" alt="User Image" onerror="this.onerror=null;this.src='{{ asset('assets/dist/img/avatar04.png') }}'">
            @else
            <img src="{{ asset('') }}/{{ Auth::user()->UserDetails->its_user_pic }}" class="img-circle" alt="User Image" onerror="this.onerror=null;this.src='{{ asset('assets/dist/img/avatar04.png') }}'">
            @endif
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->its_username }}</a>
          <small>Staff</small>
        </div>
      </div>
      @if(in_array(1,$permission_status) || in_array(2,$permission_status) || in_array(3,$permission_status))
      <div class="tl-quick">
        @if(in_array(3,$permission_status))
          <a href="{{ route('user.order.order-now') }}" class="tl-quick-main"><i class="fas fa-ruler-combined"></i> Order Now</a>
        @endif
        @if(in_array(1,$permission_status) || in_array(2,$permission_status))
        <div class="tl-quick-row">
          @if(in_array(1,$permission_status))
            <a href="{{ route('user.buy.buy-product') }}"><i class="fas fa-shopping-cart"></i> Buy</a>
          @endif
          @if(in_array(2,$permission_status))
            <a href="{{ route('user.sale.sale-product') }}"><i class="fas fa-tags"></i> Sale</a>
          @endif
        </div>
        @endif
      </div>
      @endif
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class  -->
               
          <li class="nav-item has-treeview @yield('dashboard')">
            <a href="{{ route('user.dashboard') }}" class="nav-link @yield('dashboard_link')">
              <i class="nav-icon fas fa-th-large"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          {{-- Order --}}
          @if(
            in_array(4,$permission_status) || in_array(5,$permission_status) || in_array(6,$permission_status) 
            || in_array(7,$permission_status) || in_array(8,$permission_status)
          )
          <li class="nav-item has-treeview @yield('order_report_class')">
            <a href="#" class="nav-link @yield('order_report_class_link')">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                Order Report
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if(in_array(4,$permission_status))
                <li class="nav-item">
                  <a href="{{ route('user.OrderReport.receive') }}" class="nav-link @yield('receiving_class')">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Receive</p>
                  </a>
                </li>
              @endif
              @if(in_array(5,$permission_status))
                <li class="nav-item">
                  <a href="{{ route('user.OrderReport.processing') }}" class="nav-link @yield('processing_class')">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Processing</p>
                  </a>
                </li>
              @endif
              @if(in_array(6,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.OrderReport.waiting') }}" class="nav-link @yield('waiting_class')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Waiting For Complete</p>
                </a>
              </li>
              @endif
              @if(in_array(7,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.OrderReport.order-details') }}" class="nav-link @yield('order_details')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Show Order Details</p>
                </a>
              </li>
              @endif
              @if(in_array(8,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.OrderReport.order-list') }}" class="nav-link @yield('order_list')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Order Lists</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @endif
          {{-- End Order --}}
         
          {{-- Customer --}}
          @if(
             in_array(9,$permission_status) || in_array(10,$permission_status) || in_array(11,$permission_status) || in_array(12,$permission_status)
          )
          <li class="nav-item has-treeview @yield('customer_class')">
            <a href="#" class="nav-link @yield('customer_class_link')">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Customers
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if(in_array(9,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.customer.customer-registration') }}" class="nav-link @yield('customer_registration')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer Registration</p>
                </a>
              </li>
              @endif
              @if(in_array(10,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.customer.all-customer') }}" class="nav-link @yield('all_customer')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Customers</p>
                </a>
              </li>
              @endif
              @if(in_array(11,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.customer.payments') }}" class="nav-link @yield('payments')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Payments</p>
                </a>
              </li>
              @endif
              @if(in_array(12,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.customer.view-statements') }}" class="nav-link @yield('view_statements')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Statement</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @endif
          {{-- End Customer --}}
          
          {{-- Worker --}}
          @if(
             in_array(13,$permission_status) || in_array(14,$permission_status) || in_array(15,$permission_status) || in_array(16,$permission_status)
          )
          <li class="nav-item has-treeview @yield('worker_class')">
            <a href="#" class="nav-link @yield('worker_class_link')">
              <i class="nav-icon fas fa-cut"></i>
              <p>
                Maker
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if(in_array(13,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.worker.maker-registration') }}" class="nav-link @yield('maker_registration')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Maker Registration</p>
                </a>
              </li>
              @endif
              @if(in_array(14,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.worker.maker-payment') }}" class="nav-link @yield('maker_payment')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Maker Payment</p>
                </a>
              </li>
              @endif
              @if(in_array(15,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.worker.maker-pending-payment') }}" class="nav-link @yield('maker_pending_payment')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Maker Pending Payment</p>
                </a>
              </li>
              @endif
              @if(in_array(16,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.worker.statement') }}" class="nav-link @yield('statement')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Statements</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @endif
          {{-- End Worker --}}
          @if(in_array(17,$permission_status))
          {{-- Price Update --}}
          <li class="nav-item has-treeview @yield('price_update')">
              <a href="{{ route('user.price-update.price-update') }}" class="nav-link @yield('price_update_link')">
                <i class="nav-icon fas fa-tags"></i>
                <p>
                  Price Update
                </p>
              </a>
            </li>
          {{-- End Price Update --}}
          @endif
          {{-- Cost --}}
          @if(
              in_array(18,$permission_status) || in_array(19,$permission_status) || in_array(20,$permission_status) 
          )
          <li class="nav-item has-treeview @yield('cost_class')">
            <a href="#" class="nav-link @yield('cost_class_link')">
              <i class="nav-icon fas fa-coins"></i>
              <p>
                Cost
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if(in_array(18,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.cost.set-making-cost') }}" class="nav-link py-1 @yield('making_cost')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Set Making Cost</p>
                </a>
              </li>
              @endif
              @if(in_array(19,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.cost.total-income-spend') }}" class="nav-link py-1 @yield('income_spend')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Total Income and Spend</p>
                </a>
              </li>
              @endif
              @if(in_array(20,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.cost.expend') }}" class="nav-link py-1 @yield('expend_class')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Expend</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          {{-- End Cost --}}
          @endif
          {{-- Product Information --}}
          @if(
              in_array(21,$permission_status) || in_array(22,$permission_status) || in_array(23,$permission_status) || in_array(24,$permission_status)
              || in_array(25,$permission_status) || in_array(26,$permission_status) || in_array(27,$permission_status) || in_array(28,$permission_status)
              || in_array(29,$permission_status)
          )
          <li class="nav-item has-treeview @yield('product_information')">
            <a href="#" class="nav-link @yield('product_information_link')">
              <i class="nav-icon fas fa-tshirt"></i>
              <p>
                Product Information
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if(in_array(21,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.ProductInformation.add-group') }}" class="nav-link @yield('add_group')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Group</p>
                </a>
              </li>
              @endif
              @if(in_array(22,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.ProductInformation.view-group') }}" class="nav-link py-1 @yield('view_group')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Group</p>
                </a>
              </li>
              @endif
              @if(in_array(23,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.ProductInformation.add-type') }}" class="nav-link @yield('add_type')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Product Type</p>
                </a>
              </li>
              @endif
              @if(in_array(24,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.ProductInformation.view-type') }}" class="nav-link py-1 @yield('view_type')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Product Type</p>
                </a>
              </li>
              @endif
              @if(in_array(25,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.ProductInformation.add-name') }}" class="nav-link @yield('add_name')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Product Name</p>
                </a>
              </li>
              @endif
              @if(in_array(26,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.ProductInformation.view-name') }}" class="nav-link py-1 @yield('view_name')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Product Name</p>
                </a>
              </li>
              @endif
              @if(in_array(27,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.ProductInformation.add-location') }}" class="nav-link @yield('add_location')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Location</p>
                </a>
              </li>
              @endif
              @if(in_array(28,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.ProductInformation.view-location') }}" class="nav-link @yield('view_location')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Location</p>
                </a>
              </li>
              @endif
              @if(in_array(29,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.ProductInformation.add-product') }}" class="nav-link @yield('add_product')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Product</p>
                </a>
              </li>
              @endif
              @if(in_array(30,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.ProductInformation.view-product') }}" class="nav-link py-1 @yield('view_product')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Product</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @endif
          {{-- End Product Information --}}
         
          {{-- Supplier Information --}}
          @if(
              in_array(31,$permission_status) || in_array(32,$permission_status) || in_array(33,$permission_status) || in_array(34,$permission_status)
              || in_array(35,$permission_status)  || in_array(36,$permission_status) || in_array(37,$permission_status)
          )
          <li class="nav-item has-treeview @yield('supplier_information')">
            <a href="#" class="nav-link @yield('supplier_information_link')">
              <i class="nav-icon fas fa-truck"></i>
              <p>
                Supplier Information
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if(in_array(31,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.supplier.add') }}" class="nav-link @yield('add_supplier')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Supplier</p>
                </a>
              </li>
              @endif
              @if(in_array(32,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.supplier.view') }}" class="nav-link py-1 @yield('view_supplier')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Supplier</p>
                </a>
              </li>
              @endif
              @if(in_array(33,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.supplier.add-bank') }}" class="nav-link @yield('add_bank')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Supplier Bank</p>
                </a>
              </li>
              @endif
              @if(in_array(34,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.supplier.payment-date') }}" class="nav-link @yield('payment_date')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Payment Date</p>
                </a>
              </li>
              @endif
              @if(in_array(35,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.supplier.view-payment-date') }}" class="nav-link @yield('view_payment_date')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Payment Date</p>
                </a>
              </li>
              @endif
              @if(in_array(36,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.supplier.payment') }}" class="nav-link @yield('supplier_payment')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Supplier Payment</p>
                </a>
              </li>
              @endif
              @if(in_array(37,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.supplier.statement') }}" class="nav-link @yield('supplier_statement')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Supplier Statement</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @endif
          {{-- End Supplier Information --}}
          {{-- Bank Details --}}
         @if (
            in_array(38,$permission_status) || in_array(39,$permission_status) || in_array(40,$permission_status) || in_array(41,$permission_status)
            || in_array(42,$permission_status) || in_array(43,$permission_status)
         )
          <li class="nav-item has-treeview @yield('bank_details')">
            <a href="#" class="nav-link @yield('bank_details_link')">
              <i class="nav-icon fas fa-university"></i>
              <p>
                Bank Details
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if(in_array(38,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.bank.open-bank-statement') }}" class="nav-link py-1 @yield('open_bank_statement')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Open Bank Account</p>
                </a>
              </li>
              @endif
              @if(in_array(39,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.bank.bank-account-list') }}" class="nav-link py-1 @yield('bank_acc_list')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bank Account List</p>
                </a>
              </li>
              @endif
              @if(in_array(40,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.bank.bank-deposit') }}" class="nav-link py-1 @yield('bank_deposit')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bank Deposit</p>
                </a>
              </li>
              @endif
              @if(in_array(41,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.bank.bank-withdraw') }}" class="nav-link py-1 @yield('bank_withdraw')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bank WithDraw</p>
                </a>
              </li>
              @endif
              @if(in_array(42,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.bank.cash-transfer') }}" class="nav-link py-1 @yield('cash_transfer')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cash Transfer</p>
                </a>
              </li>
              @endif
              @if(in_array(43,$permission_status))
              <li class="nav-item">
                <a href="{{ route('user.bank.bank-statement') }}" class="nav-link py-1 @yield('bank_statement')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bank Statement</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @endif
          {{-- End Bank Details --}}
          {{-- Account --}}
          @if (
               in_array(44,$permission_status) || in_array(45,$permission_status) 
               || in_array(46,$permission_status) 
          )
          <li class="nav-item has-treeview @yield('account_class')">
              <a href="#" class="nav-link @yield('account_class_link')">
                <i class="nav-icon fas fa-file-invoice-dollar"></i>
                <p>
                  Account
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @if(in_array(44,$permission_status))
                <li class="nav-item">
                  <a href="{{ route('user.account.account-statement') }}" class="nav-link py-1 @yield('account_statement')">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Account Statement</p>
                  </a>
                </li>
                @endif
                @if(in_array(45,$permission_status))
                <li class="nav-item">
                  <a href="{{ route('user.account.buy-statement') }}" class="nav-link py-1 @yield('buy_statement')">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Product Buy Statement</p>
                  </a>
                </li>
                @endif
                 @if(in_array(46,$permission_status))
                <li class="nav-item">
                  <a href="{{ route('user.account.sell-statement') }}" class="nav-link py-1 @yield('sell_statement')">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Product Sell Statement</p>
                  </a>
                </li>
                @endif
              </ul>
            </li>
            @endif
          {{-- End Account --}}
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
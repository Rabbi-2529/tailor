<?php
Route::get('/','AuthController@loginPage')->name('login');
Route::post('login-process','AuthController@processLogin')->name('login-process');
Route::get('/logout','AuthController@logout')->name('logout');

//Admin Group
Route::group(['prefix' => 'admin' , 'as' => 'admin.' , 'middleware' => 'admin'],function(){
    Route::get('/','Admin\AdminController@index')->name('dash');
    Route::post('company-suspend-unsuspend','Admin\AdminController@company_suspend_unsuspend')->name('company-suspend-unsuspend');
    Route::post('company-active','Admin\AdminController@company_active')->name('company-active');
    Route::post('branch-suspend-unsuspend','Admin\AdminController@branch_suspend_unsuspend')->name('branch-suspend-unsuspend');
    Route::post('branch-active','Admin\AdminController@branch_active')->name('branch-active');
    Route::get('company-registration','Admin\AdminController@company_registration')->name('company-registration');
    Route::post('company-registration-insert','Admin\CompanyController@CompanyRegistration')->name('company-registration-insert');
    Route::get('mobile-number-exist','Admin\CompanyController@mobile_number_exist')->name('mobile-number-exist');

    Route::get('company-list','Admin\AdminController@comapny_list')->name('company-list');
Route::get('company-edit-ajax','Admin\CompanyController@CompanyEditAjax')->name('company-edit-ajax');
Route::post('company-update','Admin\CompanyController@CompanyUpdate')->name('company-update');
    Route::get('branch-registration','Admin\AdminController@branch_registration')->name('branch-registration');
    Route::get('district-name-show','Admin\BranchController@districtNameShow')->name('district-name-show');
    Route::get('upazila-name-show','Admin\BranchController@upazilaNameShow')->name('upazila-name-show');
    Route::post('branch-registration-insert','Admin\BranchController@BranchRegistration')->name('branch-registration-insert');
    Route::get('branch-list','Admin\AdminController@branch_list')->name('branch-list');
});
// End Admin Group

//Company Group
Route::group(['prefix' => 'company' , 'as' => 'company.' , 'middleware' => 'company'],function(){
    Route::get('/','company\CompanyController@index')->name('dashboard');
    
    Route::get('branch-registration','company\BranchController@branch_registration')->name('branch-registration');
    Route::get('district-name-show','company\BranchController@districtNameShow')->name('district-name-show');
    Route::get('upazila-name-show','company\BranchController@upazilaNameShow')->name('upazila-name-show');
    Route::post('branch-registration-insert','company\BranchController@BranchRegistrationInsert')->name('branch-registration-insert');
    Route::get('mobile-number-exist','company\BranchController@mobile_number_exist')->name('mobile-number-exist');

    Route::get('branch-list','company\BranchController@branch_list')->name('branch-list');
    Route::get('balance','company\CompanyController@balance')->name('balance');
    // Sms Setup
    Route::get('sms-setup','company\CompanyController@sms_setup')->name('sms-setup');
    Route::post('sms-setup-insert','company\CompanyController@sms_setup_insert')->name('sms-setup-insert');
});
//End Company Group

//Branch Group
Route::group(['prefix' => 'branch' , 'as' => 'branch.' , 'middleware' => 'branch'],function(){
    Route::get('/','Branch\BranchController@index')->name('dashboard');

    //Sale
    Route::group(['prefix' => 'sale' , 'as' => 'sale.'],function(){
        Route::get('sale-product','Branch\SaleController@saleProduct')->name('sale-product');
        Route::get('type-name','Branch\SaleController@typeName')->name('type-name');
        Route::get('product-search','Branch\SaleController@productSearch')->name('product-search');
        Route::get('add-to-cart','Branch\SaleController@addToCart')->name('add-to-cart');
        Route::get('get-cart-content','Branch\SaleController@getCartContent')->name('get-cart-content');
        Route::get('get-cart-delete/{temp_id}','Branch\SaleController@getCartDelete')->name('get-cart-delete');

        Route::post('sale-product-invoice','Branch\SaleController@saleProductInvoice')->name('sale-product-invoice');
        Route::get('sale-product-invoice-insert','Branch\SaleController@saleProductInvoiceInsert')->name('sale-product-invoice-insert');
        Route::get('sale-invoice-generate/{invoice_no}','Branch\SaleController@saleInvoiceGenerate')->name('sale-invoice-generate');
        
        Route::get('sale-product-invoice-close','Branch\SaleController@saleProductInvoiceClose')->name('sale-product-invoice-close');
    });
    //End Sale

    //Buy/Purchase
    Route::group(['prefix' => 'buy' , 'as' => 'buy.'],function(){
        Route::get('buy-product','Branch\BuyController@productBuy')->name('buy-product');
        Route::get('supplier-product-show','Branch\BuyController@supplierProductShow')->name('supplier-product-show');
        Route::get('add-to-cart','Branch\BuyController@addToCart')->name('add-to-cart');
        Route::get('cart-product-show','Branch\BuyController@cartProductShow')->name('cart-product-show');
        Route::get('cart-product-delete','Branch\BuyController@cartProductDelete')->name('cart-product-delete');
        Route::post('buy-product-invoice','Branch\BuyController@buyProductInvoice')->name('buy-product-invoice');
        Route::get('buy-product-invoice-insert','Branch\BuyController@buyProductInvoiceInsert')->name('buy-product-invoice-insert');
        Route::get('buy-product-invoice-close','Branch\BuyController@buyProductInvoiceClose')->name('buy-product-invoice-close');

    });
    //End Buy/Purchase

    //Order
    Route::group(['prefix' => 'order' , 'as' => 'order.'],function(){
        Route::get('order-now','Branch\OrderController@orderNow')->name('order-now');
        Route::post('order-now-insert','Branch\OrderController@orderAddToCart')->name('order-now-insert');
        Route::get('get-cart-content','Branch\OrderController@getCartContent')->name('get-cart-content');
        Route::get('get-cart-delete/{id}','Branch\OrderController@getCartContentDelete')->name('get-cart-delete');
    });
    //End Order
    //Measure
    Route::group(['prefix' => 'measure' , 'as' => 'measure.'],function(){
        Route::match(['post','get'],'take-measure','Branch\MeasureController@takeMeasure')->name('take-measure');
        Route::get('delivery-date','Branch\MeasureController@deliveryDate')->name('delivey-date');
        Route::post('take-measure-shirt','Branch\MeasureController@shirtMeasurement')->name('take-measure-shirt');
        Route::post('take-measure-pant','Branch\MeasureController@pantMeasurement')->name('take-measure-pant');
        Route::post('take-measure-blazer','Branch\MeasureController@blazerMeasurement')->name('take-measure-blazer');
        Route::post('take-measure-panjabi','Branch\MeasureController@panjabiMeasurement')->name('take-measure-panjabi');
        Route::post('take-measure-payjama','Branch\MeasureController@payjamaMeasurement')->name('take-measure-payjama');
        Route::post('take-measure-safari','Branch\MeasureController@safariMeasurement')->name('take-measure-safari');
        Route::post('take-measure-photua','Branch\MeasureController@photuaMeasurement')->name('take-measure-photua');
        Route::post('take-measure-mojib-cort','Branch\MeasureController@mojibCortMeasurement')->name('take-measure-mojib-cort');
        Route::post('take-measure-kable','Branch\MeasureController@kableMeasurement')->name('take-measure-kable');
        Route::post('take-measure-koti','Branch\MeasureController@kotiMeasurement')->name('take-measure-koti');
        Route::get('finish-order-print/{order_id}','Branch\MeasureController@finishOrderPrint')->name('finish-order-print');
        // Measure Data Update Controller
        Route::post('update-shirt-measure','Branch\MeasureUpdateController@updateShirtMeasure')->name('update-shirt-measure');
        Route::post('update-pant-measure','Branch\MeasureUpdateController@updatePantMeasure')->name('update-pant-measure');
        Route::post('update-blazer-measure','Branch\MeasureUpdateController@updateBlazerMeasure')->name('update-blazer-measure');
        Route::post('update-panjabi-measure','Branch\MeasureUpdateController@updatePanjabiMeasure')->name('update-panjabi-measure');
        Route::post('update-payjama-measure','Branch\MeasureUpdateController@updatePayjamaMeasure')->name('update-payjama-measure');
        Route::post('update-safari-measure','Branch\MeasureUpdateController@updateSafariMeasure')->name('update-safari-measure');
        Route::post('update-photua-measure','Branch\MeasureUpdateController@updatePhotuaMeasure')->name('update-photua-measure');
        Route::post('update-mojib-cort-measure','Branch\MeasureUpdateController@updateMojibcortMeasure')->name('update-mojib-cort-measure');
        Route::post('update-kable-measure','Branch\MeasureUpdateController@updateKableMeasure')->name('update-kable-measure');
        Route::post('update-koti-measure','Branch\MeasureUpdateController@updateKotiMeasure')->name('update-koti-measure');
    });
    //End Measure

    //Order Report Group
    Route::group(['prefix' => 'OrderReport' , 'as' => 'OrderReport.'],function(){
        Route::get('receive','Branch\OrderReportController@receiving')->name('receive');
        Route::get('processing','Branch\OrderReportController@processing')->name('processing');
        Route::get('delivery-date-change','Branch\OrderReportController@deliveryDateChange')->name('delivery-date-change');
        Route::get('maker-set-for-order','Branch\OrderReportController@makerSetForOrder')->name('maker-set-for-order');
        Route::get('maker-update-for-order','Branch\OrderReportController@makerUpdateForOrder')->name('maker-update-for-order');
        Route::get('receive-order-view/{order_slnoId}','Branch\OrderReportController@receiveOrderView')->name('receive-order-view');
        Route::get('processing-order-view/{order_slnoId}','Branch\OrderReportController@processingOrderView')->name('processing-order-view');
        Route::get('waiting','Branch\OrderReportController@waitForComplete')->name('waiting');
        Route::get('complete-status-change','Branch\OrderReportController@completeStatusChange')->name('complete-status-change');
        Route::get('real-data-for-waiting','Branch\OrderReportController@realDataForWaiting')->name('real-data-for-waiting');
        Route::get('order-details','Branch\OrderReportController@orderDetails')->name('order-details');
        Route::post('search-order-details','Branch\OrderReportController@searchOrderDetails')->name('search-order-details');
        Route::get('order-list','Branch\OrderReportController@orderList')->name('order-list');
        Route::get('real-data-for-complete','Branch\OrderReportController@realDataForComplete')->name('real-data-for-complete');
        Route::post('search-delivery-order','Branch\OrderReportController@searchDeliveryOrder')->name('search-delivery-order');
        Route::get('real-data-delivery-order','Branch\OrderReportController@realDataDeliveryOrder')->name('real-data-delivery-order');
        Route::get('delivery-status','Branch\OrderReportController@deliveryStatus')->name('delivery-status');
        Route::get('make-standard-print/{product_name}/{maker_order_slno}','Branch\OrderReportController@makeStandardPrint')->name('make-standard-print');
        Route::get('make-classical-print/{product_name}/{maker_order_slno}','Branch\OrderReportController@makeClassicalPrint')->name('make-classical-print');
        Route::get('total-order','Branch\OrderReportController@totalOrder')->name('total-order');
        Route::get('today-order','Branch\OrderReportController@todayOrder')->name('today-order');
    });
    //End Order Report

    //Customer Group
    Route::group(['prefix' => 'customer' , 'as' => 'customer.'],function(){
        Route::get('customer-registration','Branch\CustomersController@CustomerRegistration')->name('customer-registration');
        Route::get('customer-mobile-number-exist','Branch\CustomersController@CustomerMobileNumberExist')->name('customer-mobile-number-exist');
        Route::post('customer-registration-insert','Branch\CustomersController@CustomerRegistrationInsert')->name('customer-registration-insert');
        Route::get('customer-insert-from-company','Branch\CustomersController@CustomerInsertFromCompany')->name('customer-insert-from-company');
        Route::get('all-customer','Branch\CustomersController@AllCustomer')->name('all-customer');
        Route::get('customer-order-status/{its_cus_slno}','Branch\CustomersController@CustomerOrderStatus')->name('customer-order-status');
        Route::get('customer-order-details/{its_order_id}','Branch\CustomersController@CustomerOrderDetails')->name('customer-order-details');
        Route::get('payments','Branch\CustomersController@Payments')->name('payments');
        Route::post('customer-payment','Branch\CustomersController@CustomerPayment')->name('customer-payment');
        Route::get('customer-payable-amount','Branch\CustomersController@CustomerPayableAmount')->name('customer-payable-amount');
        Route::get('view-statements','Branch\CustomersController@CustomerStatements')->name('view-statements');
        Route::get('view-statement-details/{customer_id}','Branch\CustomersController@CustomerStatementsDetails')->name('view-statement-details');
    });
    //End Customer Group

    //Worker Group
    Route::group(['prefix' => 'worker' , 'as' => 'worker.'],function(){
        Route::get('maker-registration','Branch\WorkerController@MakerRegistration')->name('maker-registration');
        Route::post('maker-registration-insert','Branch\WorkerController@MakerRegistrationInsert')->name('maker-registration-insert');
        Route::get('maker-payment','Branch\WorkerController@MakerPayment')->name('maker-payment');
        Route::get('maker-payment-insert','Branch\WorkerController@MakerPaymentInsert')->name('maker-payment-insert');
        Route::get('maker-payable-amount','Branch\WorkerController@MakerPayableAmount')->name('maker-payable-amount');
        Route::get('maker-pending-payment','Branch\WorkerController@MakerPendingPayment')->name('maker-pending-payment');
        Route::post('search-maker-panding-payment','Branch\WorkerController@searchMakerPendingPayment')->name('search-maker-panding-payment');
        Route::get('statement','Branch\WorkerController@Statement')->name('statement');
        Route::get('statement-view/{maker_slno}','Branch\WorkerController@StatementView')->name('statement-view');
        Route::get('statement-details/{maker_slno}/{order_id}','Branch\WorkerController@StatementDetails')->name('statement-details');
        Route::post('worker-salary-show','Branch\WorkerController@WorkerSalaryShow')->name('worker-salary-show');
        Route::get('real-data-worker-salary/{its_maker_slno}','Branch\WorkerController@RealDataWorkerSalary')->name('real-data-worker-salary');
    });
    //End Worker Group

    //User Group
    Route::group(['prefix' => 'user' , 'as' => 'user.'],function(){
        Route::get('mobile-exist','Branch\UserController@mobile_number_exist')->name('mobile-exist');
        Route::get('user-registration','Branch\UserController@UserRegistration')->name('user-registration');
        Route::post('user-registration-insert','Branch\UserController@UserRegistrationInsert')->name('user-registration-insert');
        Route::get('user-list','Branch\UserController@UserList')->name('user-list');
        Route::get('user-edit/{user_id}','Branch\UserController@UserEdit')->name('user-edit');
        Route::get('mobile-exist-edit','Branch\UserController@mobile_exist_edit')->name('mobile-exist-edit');
        Route::post('user-registration-update','Branch\UserController@UserRegistrationUpdate')->name('user-registration-update');
        Route::get('user-menu-permission/{user_id}','Branch\UserController@UserMenuPermission')->name('user-menu-permission');
        Route::post('user-menu-permission-insert','Branch\UserController@UserMenuPermissionInsert')->name('user-menu-permission-insert');
    });
    //End User Group

    //Product Information Group
    Route::group(['prefix' => 'ProductInformation' , 'as' => 'ProductInformation.'],function(){
        //Product Group
        Route::get('add-group','Branch\ProductInformationController@AddGroup')->name('add-group');
        Route::post('add-group-insert','Branch\ProductInformationController@AddGroupInsert')->name('add-group-insert');
        Route::get('add-group-ajax','Branch\ProductInformationController@groupEditAjax')->name('add-group-ajax');
        Route::post('group-update','Branch\ProductInformationController@productGroupUpdate')->name('group-update');
        Route::get('view-group','Branch\ProductInformationController@ViewGroup')->name('view-group');
        Route::get('group-delete/{id}','Branch\ProductInformationController@productGroupDelete')->name('group-delete');
        //End Product Group

        //Product Type
        Route::get('add-type','Branch\ProductInformationController@AddProductType')->name('add-type');
        Route::post('add-type-insert','Branch\ProductInformationController@ProductTypeInsert')->name('add-type-insert');
        Route::get('type-ajax','Branch\ProductInformationController@typeEditAjax')->name('type-ajax');
        Route::get('view-type','Branch\ProductInformationController@ViewType')->name('view-type');
        Route::post('type-update','Branch\ProductInformationController@productTypeUpdate')->name('type-update');
        Route::get('type-delete/{id}','Branch\ProductInformationController@productTypeDelete')->name('type-delete');
        //End Product Type

        //Product Name
        Route::get('add-name','Branch\ProductInformationController@AddProductName')->name('add-name');
        Route::get('group-ajax-for-type','Branch\ProductInformationController@groupAjaxForType')->name('group-ajax-for-type');
        Route::post('add-name-insert','Branch\ProductInformationController@AddProductNameInsert')->name('add-name-insert');
        Route::get('view-name','Branch\ProductInformationController@ViewName')->name('view-name');
        Route::get('name-ajax','Branch\ProductInformationController@nameEditAjax')->name('name-ajax');
        Route::post('name-update','Branch\ProductInformationController@nameUpdate')->name('name-update');
        Route::get('name-delete/{id}','Branch\ProductInformationController@nameDelete')->name('name-delete');
        //End Product Name

        //Product Location
        Route::get('add-location','Branch\ProductInformationController@AddLocation')->name('add-location');
        Route::get('type-ajax-for-pro-name','Branch\ProductInformationController@typeAjaxForProName')->name('type-ajax-for-pro-name');
        Route::post('add-location-insert','Branch\ProductInformationController@productLocationSubmit')->name('add-location-submit');
        Route::get('view-location','Branch\ProductInformationController@ViewLocation')->name('view-location');
        Route::get('location-ajax','Branch\ProductInformationController@locationEditAjax')->name('location-ajax');
        Route::post('location-update','Branch\ProductInformationController@locationUpdate')->name('location-update');
        Route::get('location-delete/{id}','Branch\ProductInformationController@locationDelete')->name('location-delete');
        //End Product Location

        //Add Product
        Route::get('add-product','Branch\ProductInformationController@AddProduct')->name('add-product');
        Route::get('supplierId-ajax-for-group','Branch\ProductInformationController@supplierAjaxForGroup')->name('supplierId-ajax-for-group');
        Route::post('add-product-insert','Branch\ProductInformationController@addProductSubmit')->name('add-product-insert');
        Route::get('view-product','Branch\ProductInformationController@ViewProduct')->name('view-product');
        Route::get('product-edit-ajax','Branch\ProductInformationController@productEditAjax')->name('product-edit-ajax');
        Route::post('product-update','Branch\ProductInformationController@productUpdate')->name('product-update');
        Route::get('product-delete/{id}','Branch\ProductInformationController@productDelete')->name('product-delete');
        //End Add Product
    });
    //End Product Information Group

    //Supplier Information Group
    Route::group(['prefix' => 'supplier' , 'as' => 'supplier.'],function(){
        // Supplier Add Route
        Route::get('add','Branch\SupplierInformationController@add')->name('add');
        Route::post('add-supplier','Branch\SupplierInformationController@SupplierAdd')->name('add-supplier');
        Route::get('view','Branch\SupplierInformationController@ViewSupplier')->name('view');
        Route::get('update/{sup_slno}','Branch\SupplierInformationController@UpdateSupplier')->name('update');
        Route::post('update-info-insert','Branch\SupplierInformationController@UpdateInfoInsert')->name('update-info-insert');
        Route::get('delete/{sup_slno}','Branch\SupplierInformationController@delete')->name('delete');
        // Supplier Add Bank Route
        Route::get('add-bank','Branch\SupplierInformationController@AddBank')->name('add-bank');
        Route::post('add-bank-insert','Branch\SupplierInformationController@AddBankInsert')->name('add-bank-insert');
        Route::get('bank-details','Branch\SupplierInformationController@BankDetails')->name('bank-details');
        // Supplier Add Payment Date Route
        Route::get('payment-date','Branch\SupplierInformationController@PaymentDate')->name('payment-date');
        Route::post('payment-date-insert','Branch\SupplierInformationController@PaymentDateInsert')->name('payment-date-insert');
        Route::get('view-payment-date','Branch\SupplierInformationController@ViewPaymentDate')->name('view-payment-date');
        Route::get('payment-date-update-info','Branch\SupplierInformationController@PaymentDateUpdateInfo')->name('payment-date-update-info');
        Route::get('payment-date-delete/{sup_pay_date_id}','Branch\SupplierInformationController@PaymentDateDelete')->name('payment-date-delete');
        Route::post('payment-date-update','Branch\SupplierInformationController@PaymentDateUpdate')->name('payment-date-update');
        // Supplier Add Payment Route
        Route::get('payment','Branch\SupplierInformationController@payment')->name('payment');
        Route::get('payable-amount','Branch\SupplierInformationController@payableAmount')->name('payable-amount');
        Route::post('payment-insert','Branch\SupplierInformationController@paymentInsert')->name('payment-insert');
        Route::get('statement','Branch\SupplierInformationController@SupplierStatement')->name('statement');
        Route::get('view-statement-details/{sup_id}','Branch\SupplierInformationController@ViewStatementDetails')->name('view-statement-details');
    });
    //End Supplier Information Group

    //Bank Details
    Route::group(['prefix' => 'bank' , 'as' => 'bank.'],function(){
        Route::get('open-bank-statement','Branch\BankController@OpenBankStatement')->name('open-bank-statement');
        Route::post('open-bank-account','Branch\BankController@bankAccountSubmit')->name('open-bank-account');

        Route::get('bank-account-list','Branch\BankController@BankAccountList')->name('bank-account-list');
        Route::get('bank-edit-ajax','Branch\BankController@bankEditAjax')->name('bank-edit-ajax');
        Route::post('bank-update','Branch\BankController@bankUpdate')->name('bank-update');
        Route::get('bank-account-delete/{id}','Branch\BankController@bankAccountDelete')->name('bank-account-delete');

        Route::get('bank-deposit','Branch\BankController@BankDeposit')->name('bank-deposit');
        Route::get('bank-acc-no-ajax','Branch\BankController@bankAccNoAjax')->name('bank-acc-no-ajax');
        Route::post('bank-deposit-submit','Branch\BankController@bankDepositSubmit')->name('bank-deposit-submit');

        Route::get('bank-withdraw','Branch\BankController@BankWithdraw')->name('bank-withdraw');
        Route::post('bank-withdraw-submit','Branch\BankController@bankWithdrawSubmit')->name('bank-withdraw-submit');

        Route::get('cash-transfer','Branch\BankController@CashTransfer')->name('cash-transfer');
        Route::get('bank-amount','Branch\BankController@BankAmount')->name('bank-amount');
        Route::get('check-bank-amount','Branch\BankController@CheckBankAmount')->name('check-bank-amount');
        Route::post('cash-transfer-insert','Branch\BankController@CashTransferInsert')->name('cash-transfer-insert');

        Route::get('bank-statement','Branch\BankController@BankStatement')->name('bank-statement');
        Route::get('bank_statement_details/{bank_id}','Branch\BankController@BankStatementDetails')->name('bank_statement_details');
    });
    //End Bank Details

    //Price Update
    Route::group(['prefix' => 'price-update' , 'as' => 'price-update.'],function(){
        Route::get('price-update','Branch\BranchController@price_update')->name('price-update');
        Route::get('price-delete/{id}','Branch\BranchController@priceDelete')->name('price-delete');
        Route::get('price-update-ajax','Branch\BranchController@priceUpdateAjax')->name('price-update-ajax');
        Route::post('price-update-insert','Branch\BranchController@priceUpdateInsert')->name('price-update-insert');
        Route::post('price-edit-insert','Branch\BranchController@priceEdit')->name('price-edit-insert');
    });
    //End Price Update

    //Cost Group
    Route::group(['prefix' => 'cost' , 'as' => 'cost.'],function(){
        Route::get('set-making-cost','Branch\CostController@setMakingCost')->name('set-making-cost');
        Route::post('set-making-cost-insert','Branch\CostController@CostSetting')->name('set-making-cost-insert');
        
        Route::get('total-income-spend','Branch\CostController@totalIncomeSpend')->name('total-income-spend');
        Route::get('expend','Branch\CostController@expend')->name('expend');
        Route::post('expend-insert','Branch\CostController@expendInsert')->name('expend-insert');
    });
    //End Cost Group

    //Account Group
    Route::group(['prefix' => 'account' , 'as' => 'account.'],function(){
        Route::get('account-statement','Branch\AccountController@accountStatement')->name('account-statement');
        Route::post('search-account-statement','Branch\AccountController@searcAccountStatement')->name('search-account-statement');
        Route::get('buy-statement','Branch\AccountController@BuyStatement')->name('buy-statement');
        Route::get('buy-statement-ajax','Branch\AccountController@buyStatementAjax')->name('buy-statement-ajax');
        Route::get('sell-statement','Branch\AccountController@SellStatement')->name('sell-statement');
        Route::get('sale-statement-ajax','Branch\AccountController@saleStatementAjax')->name('sale-statement-ajax');
    });
    //End Account Group

    //Logo Address
    Route::group(['prefix' => 'logo-address' , 'as' => 'logo-address.'],function(){
        Route::get('logo-address','Branch\BranchController@logoAddress')->name('logo-address');
        Route::post('logo-address-insert','Branch\BranchController@logoAddressInsert')->name('logo-address-insert');
    });
    //End Logo Address
    
});
//End Branch Group

//User Group
Route::group(['prefix' => 'user' , 'as' => 'user.' , 'middleware' => 'user'],function(){
    Route::get('/','user\UserController@index')->name('dashboard');

    //Buy/Purchase
    Route::group(['prefix' => 'buy' , 'as' => 'buy.'],function(){
        Route::get('buy-product','user\BuyController@productBuy')->name('buy-product');
        Route::get('supplier-product-show','user\BuyController@supplierProductShow')->name('supplier-product-show');
        Route::get('add-to-cart','user\BuyController@addToCart')->name('add-to-cart');
        Route::get('cart-product-show','user\BuyController@cartProductShow')->name('cart-product-show');
        Route::get('cart-product-delete','user\BuyController@cartProductDelete')->name('cart-product-delete');
        Route::post('buy-product-invoice','user\BuyController@buyProductInvoice')->name('buy-product-invoice');
        Route::get('buy-product-invoice-insert','user\BuyController@buyProductInvoiceInsert')->name('buy-product-invoice-insert');
        Route::get('buy-product-invoice-close','user\BuyController@buyProductInvoiceClose')->name('buy-product-invoice-close');

    });
    //End Buy/Purchase

    //Sale
    Route::group(['prefix' => 'sale' , 'as' => 'sale.'],function(){
        Route::get('sale-product','user\SaleController@saleProduct')->name('sale-product');
        Route::get('type-name','user\SaleController@typeName')->name('type-name');
        Route::get('product-search','user\SaleController@productSearch')->name('product-search');
        Route::get('add-to-cart','user\SaleController@addToCart')->name('add-to-cart');
        Route::get('get-cart-content','user\SaleController@getCartContent')->name('get-cart-content');
        Route::get('get-cart-delete/{temp_id}','user\SaleController@getCartDelete')->name('get-cart-delete');
        Route::post('sale-product-invoice','user\SaleController@saleProductInvoice')->name('sale-product-invoice');
        Route::get('sale-product-invoice-insert','user\SaleController@saleProductInvoiceInsert')->name('sale-product-invoice-insert');
        Route::get('sale-invoice-generate/{invoice_no}','user\SaleController@saleInvoiceGenerate')->name('sale-invoice-generate');
        Route::get('sale-product-invoice-close','user\SaleController@saleProductInvoiceClose')->name('sale-product-invoice-close');
    });
    //End Sale
    //Order
    Route::group(['prefix' => 'order' , 'as' => 'order.'],function(){
        Route::get('order-now','user\OrderController@orderNow')->name('order-now');
        Route::post('order-now-insert','user\OrderController@orderAddToCart')->name('order-now-insert');
        Route::get('get-cart-content','user\OrderController@getCartContent')->name('get-cart-content');
        Route::get('get-cart-delete/{id}','user\OrderController@getCartContentDelete')->name('get-cart-delete');
    });
    //End Order

    //Measure
    Route::group(['prefix' => 'measure' , 'as' => 'measure.'],function(){
        Route::match(['post','get'],'take-measure','user\MeasureController@takeMeasure')->name('take-measure');
        Route::get('delivery-date','user\MeasureController@deliveryDate')->name('delivey-date');
        Route::post('take-measure-shirt','user\MeasureController@shirtMeasurement')->name('take-measure-shirt');
        Route::post('take-measure-pant','user\MeasureController@pantMeasurement')->name('take-measure-pant');
        Route::post('take-measure-blazer','user\MeasureController@blazerMeasurement')->name('take-measure-blazer');
        Route::post('take-measure-panjabi','user\MeasureController@panjabiMeasurement')->name('take-measure-panjabi');
        Route::post('take-measure-payjama','user\MeasureController@payjamaMeasurement')->name('take-measure-payjama');
        Route::post('take-measure-safari','user\MeasureController@safariMeasurement')->name('take-measure-safari');
        Route::post('take-measure-photua','user\MeasureController@photuaMeasurement')->name('take-measure-photua');
        Route::post('take-measure-mojib-cort','user\MeasureController@mojibCortMeasurement')->name('take-measure-mojib-cort');
        Route::post('take-measure-kable','user\MeasureController@kableMeasurement')->name('take-measure-kable');
        Route::post('take-measure-koti','user\MeasureController@kotiMeasurement')->name('take-measure-koti');
        Route::get('finish-order-print/{order_id}','user\MeasureController@finishOrderPrint')->name('finish-order-print');
        // Measure Data Update Controller
        Route::post('update-shirt-measure','user\MeasureUpdateController@updateShirtMeasure')->name('update-shirt-measure');
        Route::post('update-pant-measure','user\MeasureUpdateController@updatePantMeasure')->name('update-pant-measure');
        Route::post('update-blazer-measure','user\MeasureUpdateController@updateBlazerMeasure')->name('update-blazer-measure');
        Route::post('update-panjabi-measure','user\MeasureUpdateController@updatePanjabiMeasure')->name('update-panjabi-measure');
        Route::post('update-payjama-measure','user\MeasureUpdateController@updatePayjamaMeasure')->name('update-payjama-measure');
        Route::post('update-safari-measure','user\MeasureUpdateController@updateSafariMeasure')->name('update-safari-measure');
        Route::post('update-photua-measure','user\MeasureUpdateController@updatePhotuaMeasure')->name('update-photua-measure');
        Route::post('update-mojib-cort-measure','user\MeasureUpdateController@updateMojibcortMeasure')->name('update-mojib-cort-measure');
        Route::post('update-kable-measure','user\MeasureUpdateController@updateKableMeasure')->name('update-kable-measure');
        Route::post('update-koti-measure','user\MeasureUpdateController@updateKotiMeasure')->name('update-koti-measure');
    });
    //End Measure

   //Order Report Group
    Route::group(['prefix' => 'OrderReport' , 'as' => 'OrderReport.'],function(){
        Route::get('receive','user\OrderReportController@receiving')->name('receive');
        Route::get('processing','user\OrderReportController@processing')->name('processing');
        Route::get('delivery-date-change','user\OrderReportController@deliveryDateChange')->name('delivery-date-change');
        Route::get('maker-set-for-order','user\OrderReportController@makerSetForOrder')->name('maker-set-for-order');
        Route::get('maker-update-for-order','user\OrderReportController@makerUpdateForOrder')->name('maker-update-for-order');
        Route::get('receive-order-view/{order_slnoId}','user\OrderReportController@receiveOrderView')->name('receive-order-view');
        Route::get('processing-order-view/{order_slnoId}','user\OrderReportController@processingOrderView')->name('processing-order-view');
        Route::get('waiting','user\OrderReportController@waitForComplete')->name('waiting');
        Route::get('complete-status-change','user\OrderReportController@completeStatusChange')->name('complete-status-change');
        Route::get('real-data-for-waiting','user\OrderReportController@realDataForWaiting')->name('real-data-for-waiting');
        Route::get('order-details','user\OrderReportController@orderDetails')->name('order-details');
        Route::post('search-order-details','user\OrderReportController@searchOrderDetails')->name('search-order-details');
        Route::get('order-list','user\OrderReportController@orderList')->name('order-list');
        Route::get('real-data-for-complete','user\OrderReportController@realDataForComplete')->name('real-data-for-complete');
        Route::post('search-delivery-order','user\OrderReportController@searchDeliveryOrder')->name('search-delivery-order');
        Route::get('real-data-delivery-order','user\OrderReportController@realDataDeliveryOrder')->name('real-data-delivery-order');
        Route::get('delivery-status','user\OrderReportController@deliveryStatus')->name('delivery-status');
        Route::get('make-standard-print/{product_name}/{maker_order_slno}','user\OrderReportController@makeStandardPrint')->name('make-standard-print');
        Route::get('make-classical-print/{product_name}/{maker_order_slno}','user\OrderReportController@makeClassicalPrint')->name('make-classical-print');
        Route::get('total-order','user\OrderReportController@totalOrder')->name('total-order');
        Route::get('today-order','user\OrderReportController@todayOrder')->name('today-order');
    });
    //End Order Report

    //Customer Group
    Route::group(['prefix' => 'customer' , 'as' => 'customer.'],function(){
        Route::get('customer-registration','user\CustomerController@CustomerRegistration')->name('customer-registration');
        Route::get('customer-mobile-number-exist','user\CustomerController@CustomerMobileNumberExist')->name('customer-mobile-number-exist');
        Route::post('customer-registration-insert','user\CustomerController@CustomerRegistrationInsert')->name('customer-registration-insert');
        Route::get('customer-insert-from-company','user\CustomerController@CustomerInsertFromCompany')->name('customer-insert-from-company');
        Route::get('all-customer','user\CustomerController@AllCustomer')->name('all-customer');
        Route::get('customer-order-status/{its_cus_slno}','user\CustomerController@CustomerOrderStatus')->name('customer-order-status');
        Route::get('customer-order-details/{its_order_id}','user\CustomerController@CustomerOrderDetails')->name('customer-order-details');
        Route::get('payments','user\CustomerController@Payments')->name('payments');
        Route::get('customer-payable-amount','user\CustomerController@CustomerPayableAmount')->name('customer-payable-amount');
        Route::post('customer-payment','user\CustomerController@CustomerPayment')->name('customer-payment');
        Route::get('view-statements','user\CustomerController@CustomerStatements')->name('view-statements');
        Route::get('view-statement-details/{customer_id}','user\CustomerController@CustomerStatementsDetails')->name('view-statement-details');
    });
    //End Customer Group

    //Worker Group
    Route::group(['prefix' => 'worker' , 'as' => 'worker.'],function(){
        Route::get('maker-registration','user\WorkerController@MakerRegistration')->name('maker-registration');
        Route::post('maker-registration-insert','user\WorkerController@MakerRegistrationInsert')->name('maker-registration-insert');
        Route::get('maker-payment','user\WorkerController@MakerPayment')->name('maker-payment');
        Route::get('maker-payment-insert','user\WorkerController@MakerPaymentInsert')->name('maker-payment-insert');
        Route::get('maker-payable-amount','user\WorkerController@MakerPayableAmount')->name('maker-payable-amount');
        Route::get('maker-pending-payment','user\WorkerController@MakerPendingPayment')->name('maker-pending-payment');
        Route::post('search-maker-panding-payment','user\WorkerController@searchMakerPendingPayment')->name('search-maker-panding-payment');
        Route::get('statement','user\WorkerController@Statement')->name('statement');
        Route::get('statement-view/{maker_slno}','user\WorkerController@StatementView')->name('statement-view');
        Route::get('statement-details/{maker_slno}/{order_id}','user\WorkerController@StatementDetails')->name('statement-details');
        Route::post('worker-salary-show','user\WorkerController@WorkerSalaryShow')->name('worker-salary-show');
        Route::get('real-data-worker-salary/{its_maker_slno}','user\WorkerController@RealDataWorkerSalary')->name('real-data-worker-salary');
    });
    //End Worker Group
    //Price Update
    Route::group(['prefix' => 'price-update' , 'as' => 'price-update.'],function(){
        Route::get('price-update','user\UserController@price_update')->name('price-update');
        Route::get('price-delete/{id}','user\UserController@priceDelete')->name('price-delete');
        Route::get('price-update-ajax','user\UserController@priceUpdateAjax')->name('price-update-ajax');
        Route::post('price-update-insert','user\UserController@priceUpdateInsert')->name('price-update-insert');
        Route::post('price-edit-insert','user\UserController@priceEdit')->name('price-edit-insert');
    });
    //End Price Update

    //Cost Group
    Route::group(['prefix' => 'cost' , 'as' => 'cost.'],function(){
        Route::get('set-making-cost','user\CostController@setMakingCost')->name('set-making-cost');
        Route::post('set-making-cost-insert','user\CostController@CostSetting')->name('set-making-cost-insert');
        
        Route::get('total-income-spend','user\CostController@totalIncomeSpend')->name('total-income-spend');
        Route::get('expend','user\CostController@expend')->name('expend');
        Route::post('expend-insert','user\CostController@expendInsert')->name('expend-insert');
    });
    //End Cost Group
    //Product Information Group
    Route::group(['prefix' => 'ProductInformation' , 'as' => 'ProductInformation.'],function(){
        //Product Group
        Route::get('add-group','user\ProductInformationController@AddGroup')->name('add-group');
        Route::post('add-group-insert','user\ProductInformationController@AddGroupInsert')->name('add-group-insert');
        Route::get('add-group-ajax','user\ProductInformationController@groupEditAjax')->name('add-group-ajax');
        Route::post('group-update','user\ProductInformationController@productGroupUpdate')->name('group-update');
        Route::get('view-group','user\ProductInformationController@ViewGroup')->name('view-group');
        Route::get('group-delete/{id}','user\ProductInformationController@productGroupDelete')->name('group-delete');
        //End Product Group

        //Product Type
        Route::get('add-type','user\ProductInformationController@AddProductType')->name('add-type');
        Route::post('add-type-insert','user\ProductInformationController@ProductTypeInsert')->name('add-type-insert');
        Route::get('type-ajax','user\ProductInformationController@typeEditAjax')->name('type-ajax');
        Route::get('view-type','user\ProductInformationController@ViewType')->name('view-type');
        Route::post('type-update','user\ProductInformationController@productTypeUpdate')->name('type-update');
        Route::get('type-delete/{id}','user\ProductInformationController@productTypeDelete')->name('type-delete');
        //End Product Type

        //Product Name
        Route::get('add-name','user\ProductInformationController@AddProductName')->name('add-name');
         Route::get('group-ajax-for-type','user\ProductInformationController@groupAjaxForType')->name('group-ajax-for-type');
        Route::post('add-name-insert','user\ProductInformationController@AddProductNameInsert')->name('add-name-insert');
        Route::get('view-name','user\ProductInformationController@ViewName')->name('view-name');
        Route::get('name-ajax','user\ProductInformationController@nameEditAjax')->name('name-ajax');
        Route::post('name-update','user\ProductInformationController@nameUpdate')->name('name-update');
        Route::get('name-delete/{id}','user\ProductInformationController@nameDelete')->name('name-delete');
        //End Product Name

        //Product Location
        Route::get('add-location','user\ProductInformationController@AddLocation')->name('add-location');
        Route::get('type-ajax-for-pro-name','user\ProductInformationController@typeAjaxForProName')->name('type-ajax-for-pro-name');
        Route::post('add-location-insert','user\ProductInformationController@productLocationInsert')->name('product-location-insert');
        Route::get('view-location','user\ProductInformationController@ViewLocation')->name('view-location');
        Route::get('location-ajax','user\ProductInformationController@locationEditAjax')->name('location-ajax');
        Route::post('location-update','user\ProductInformationController@locationUpdate')->name('location-update');
        Route::get('location-delete/{id}','user\ProductInformationController@locationDelete')->name('location-delete');
        //End Product Location

        //Add Product
        Route::get('add-product','user\ProductInformationController@AddProduct')->name('add-product');
        Route::get('supplierId-ajax-for-group','user\ProductInformationController@supplierAjaxForGroup')->name('supplierId-ajax-for-group');
        Route::post('add-product-insert','user\ProductInformationController@addProductInsert')->name('add-product-insert');
        Route::get('view-product','user\ProductInformationController@ViewProduct')->name('view-product');
        Route::get('product-edit-ajax','user\ProductInformationController@productEditAjax')->name('product-edit-ajax');
        Route::post('product-update','user\ProductInformationController@productUpdate')->name('product-update');
        Route::get('product-delete/{id}','user\ProductInformationController@productDelete')->name('product-delete');
        //End Add Product
    });
    //End Product Information Group

    //Supplier Information Group
    Route::group(['prefix' => 'supplier' , 'as' => 'supplier.'],function(){
        
        // Supplier Add Route
        Route::get('add','user\SupplierInformationController@add')->name('add');
        Route::post('add-supplier','user\SupplierInformationController@SupplierAdd')->name('add-supplier');
        Route::get('view','user\SupplierInformationController@ViewSupplier')->name('view');
        Route::get('update/{sup_slno}','user\SupplierInformationController@UpdateSupplier')->name('update');
        Route::post('update-info-insert','user\SupplierInformationController@UpdateInfoInsert')->name('update-info-insert');
        Route::get('delete/{sup_slno}','user\SupplierInformationController@delete')->name('delete');
        // Supplier Add Bank Route
        Route::get('add-bank','user\SupplierInformationController@AddBank')->name('add-bank');
        Route::post('add-bank-insert','user\SupplierInformationController@AddBankInsert')->name('add-bank-insert');
        Route::get('bank-details','user\SupplierInformationController@BankDetails')->name('bank-details');
        // Supplier Add Payment Date Route
        Route::get('payment-date','user\SupplierInformationController@PaymentDate')->name('payment-date');
        Route::post('payment-date-insert','user\SupplierInformationController@PaymentDateInsert')->name('payment-date-insert');
        Route::get('view-payment-date','user\SupplierInformationController@ViewPaymentDate')->name('view-payment-date');
        Route::get('payment-date-update-info','user\SupplierInformationController@PaymentDateUpdateInfo')->name('payment-date-update-info');
        Route::get('payment-date-delete/{sup_pay_date_id}','user\SupplierInformationController@PaymentDateDelete')->name('payment-date-delete');
        Route::post('payment-date-update','user\SupplierInformationController@PaymentDateUpdate')->name('payment-date-update');
        // Supplier Add Payment Route
        Route::get('payment','user\SupplierInformationController@payment')->name('payment');
        Route::get('payable-amount','user\SupplierInformationController@payableAmount')->name('payable-amount');
        Route::post('payment-insert','user\SupplierInformationController@paymentInsert')->name('payment-insert');
        Route::get('statement','user\SupplierInformationController@SupplierStatement')->name('statement');
        Route::get('view-statement-details/{sup_id}','user\SupplierInformationController@ViewStatementDetails')->name('view-statement-details');
    });
    //End Supplier Information Group

    //Bank Group
    Route::group(['prefix' => 'bank' , 'as' => 'bank.'],function()
    {
        Route::get('open-bank-statement','user\BankDetailsController@OpenBankStatement')->name('open-bank-statement');
        Route::post('open-bank-account','user\BankDetailsController@bankAccountSubmit')->name('open-bank-account');

        Route::get('bank-account-list','user\BankDetailsController@BankAccountList')->name('bank-account-list');
        Route::get('bank-edit-ajax','user\BankDetailsController@bankEditAjax')->name('bank-edit-ajax');
        Route::post('bank-update','user\BankDetailsController@bankUpdate')->name('bank-update');
        Route::get('bank-account-delete/{id}','user\BankDetailsController@bankAccountDelete')->name('bank-account-delete');

        Route::get('bank-deposit','user\BankDetailsController@BankDeposit')->name('bank-deposit');
        Route::get('bank-acc-no-ajax','user\BankDetailsController@BankAccNoAjax')->name('bank-acc-no-ajax');
        Route::post('bank-deposit-submit','user\BankDetailsController@BankDepositSubmit')->name('bank-deposit-submit');

        Route::get('bank-withdraw','user\BankDetailsController@BankWithdraw')->name('bank-withdraw');
        Route::post('bank-withdraw-submit','user\BankDetailsController@bankWithdrawSubmit')->name('bank-withdraw-submit');

        Route::get('cash-transfer','user\BankDetailsController@CashTransfer')->name('cash-transfer');
        Route::get('bank-amount','user\BankDetailsController@BankAmount')->name('bank-amount');
        Route::get('check-bank-amount','user\BankDetailsController@CheckBankAmount')->name('check-bank-amount');
        Route::post('cash-transfer-insert','user\BankDetailsController@CashTransferInsert')->name('cash-transfer-insert');

        Route::get('bank-statement','user\BankDetailsController@BankStatement')->name('bank-statement');
        Route::get('bank_statement_details/{bank_id}','user\BankDetailsController@BankStatementDetails')->name('bank_statement_details');

        
    });
    //End Bank Group
    //Account Group
    Route::group(['prefix' => 'account' , 'as' => 'account.'],function(){
        Route::get('account-statement','user\AccountController@accountStatement')->name('account-statement');
        Route::post('search-account-statement','user\AccountController@searcAccountStatement')->name('search-account-statement');
        Route::get('buy-statement','user\AccountController@BuyStatement')->name('buy-statement');
        Route::get('buy-statement-ajax','user\AccountController@buyStatementAjax')->name('buy-statement-ajax');
        Route::get('sell-statement','user\AccountController@SellStatement')->name('sell-statement');
        Route::get('sale-statement-ajax','user\AccountController@saleStatementAjax')->name('sale-statement-ajax');
    });
    //End Account Group
});
//End User Group

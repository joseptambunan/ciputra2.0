<?php

Route::group(['middleware' => 'web', 'prefix' => 'inventory', 'namespace' => 'Modules\Inventory\Http\Controllers'], function()
{
	// brand
	Route::get('/brand/index', 'BrandController@index');
	Route::get('/brand/add_form', 'BrandController@add');
	Route::get('/brand/edit_form', 'BrandController@edit');
	Route::post('/brand/create', 'BrandController@addPost');
	Route::post('/brand/edit', 'BrandController@update');
	Route::post('/brand/inactive', 'BrandController@inactive');
	Route::post('/brand/delete', 'BrandController@delete');

	// category
	Route::get('/category/getTreeCategories','CategoryController@getCategories');

	Route::get('/category/index', 'CategoryController@index');
	Route::get('/category/add_form', 'CategoryController@add');
	Route::get('/category/getparent','CategoryController@getparent');
	Route::get('/category/edit_form', 'CategoryController@edit');
	Route::post('/category/create', 'CategoryController@addPost');
	Route::post('/category/edit', 'CategoryController@update');
	Route::post('/category/inactive', 'CategoryController@inactive');
	Route::post('/category/delete', 'CategoryController@delete');

	// items_satuan
	Route::get('/items_satuan/index', 'ItemSatuanController@index');
	Route::get('/items_satuan/add_form', 'ItemSatuanController@add');
	Route::get('/items_satuan/edit_form', 'ItemSatuanController@edit');
	Route::post('/items_satuan/typeSatuan','ItemSatuanController@typeSatuan');
	Route::post('/items_satuan/create', 'ItemSatuanController@addPost');
	Route::post('/items_satuan/edit', 'ItemSatuanController@update');
	Route::post('/items_satuan/inactive', 'ItemSatuanController@inactive');
	Route::post('/items_satuan/delete', 'ItemSatuanController@delete');

	// items_price
	Route::get('/items_price/index', 'ItemPriceController@index');
	Route::get('/items_price/add_form', 'ItemPriceController@add');
	Route::get('/items_price/edit_form', 'ItemPriceController@edit');
	Route::post('/items_price/create', 'ItemPriceController@addPost');
	Route::post('/items_price/edit', 'ItemPriceController@update');
	Route::post('/items_price/inactive', 'ItemPriceController@inactive');
	Route::post('/items_price/delete', 'ItemPriceController@delete');
	Route::post('/items_price/getComparePrice','ItemPriceController@comparePrice');

	// items atau barang
	Route::get('/item/report','ItemController@Report');
	Route::post('/item/getSubCategories','ItemController@getSubCategories');
	Route::get('/items/getItems','ItemController@getItems');

	Route::get('/items/details/{id}','ItemController@details');

	Route::get('/items/index', 'ItemController@index');
	Route::get('/items/add_form', 'ItemController@add');
	Route::get('/items/edit_form', 'ItemController@edit');
	Route::post('/items/create', 'ItemController@addPost');
	Route::post('/items/edit', 'ItemController@update');
	Route::post('/items/inactive', 'ItemController@inactive');
	Route::post('/items/delete', 'ItemController@delete');

	Route::get('/items_project/index','ItemProjectController@index');
	Route::get('/items_project/add_form','ItemProjectController@create');
	Route::get('/items_project/getData','ItemProjectController@getData');
	Route::post('/items_project/store','ItemProjectController@store');
	Route::get('/items_project/details/{id}','ItemProjectController@details');
	Route::get('/items_project/edit/{id}','ItemProjectController@edit');
	Route::post('/items_project/update','ItemProjectController@update');
	Route::post('/items_project/delete','ItemController@delete');

	Route::get('/user/hod',function(){
		return view('inventory::hod_inventory.dashboard');
	});

    Route::get('/', 'InventoryController@index');

    // permintaan_barang
	Route::get('/permintaan_barang/index', 'PermintaanBarangController@index');
	Route::get('/permintaan_barang/add_form', 'PermintaanBarangController@add');
	Route::get('/permintaan_barang/edit_form', 'PermintaanBarangController@edit');
	Route::post('/permintaan_barang/create', 'PermintaanBarangController@addPost');
	Route::post('/permintaan_barang/edit', 'PermintaanBarangController@update');
	Route::post('/permintaan_barang/delete', 'PermintaanBarangController@delete');
	Route::post('/permintaan_barang/print','PermintaanBarangController@print');
	Route::post('/permintaan_barang/approve','PermintaanBarangController@approvePermintaanBarang');

	// permintaan_barang_detail
	Route::get('/permintaan_barang_detail/item_source','PermintaanBarangDetailController@ItemSource');
	Route::get('/permintaan_barang_detail/is_inventarisasi_source','PermintaanBarangDetailController@IsInvetarisasiSource');
	Route::get('/permintaan_barang_detail/index', 'PermintaanBarangDetailController@index');
	Route::get('/permintaan_barang_detail/add_form', 'PermintaanBarangDetailController@add');
	Route::get('/permintaan_barang_detail/edit_form', 'PermintaanBarangDetailController@edit');

	Route::post('/permintaan_barang_detail/create_item', 'PermintaanBarangDetailController@addPostItem');

	Route::post('/permintaan_barang_detail/create_all', 'PermintaanBarangDetailController@addPost');
	Route::post('/permintaan_barang_detail/edit', 'PermintaanBarangDetailController@update');
	Route::post('/permintaan_barang_detail/delete', 'PermintaanBarangDetailController@delete');
	Route::post('/permintaan_barang_details/update','PermintaanBarangDetailController@update');

	// barang_keluar
	Route::get('/barang_keluar/index', 'BarangKeluarController@index');
	Route::get('/barang_keluar/add_form', 'BarangKeluarController@add');
	Route::get('/barang_keluar_detail/getDataTables/{id}','BarangKeluarController@getDataBarangKeluar');
	Route::get('/barang_keluar/edit_form', 'BarangKeluarController@edit');
	Route::post('/barang_keluar/create', 'BarangKeluarController@addPost');
	Route::post('/barang_keluar/edit', 'BarangKeluarController@update');
	Route::post('/barang_keluar/delete', 'BarangKeluarController@delete');
	Route::post('/barang_keluar/print','BarangKeluarController@print');
	Route::post('/barang_keluar/approval','BarangKeluarController@approve');

	Route::post('/barang_keluar/check_qty_item_warehouse','BarangKeluarController@checkQty');

	// barang_keluar_detail

	Route::get('/barang_keluar_detail/index', 'BarangKeluarDetailController@index');
	Route::get('/barang_keluar_detail/add_form', 'BarangKeluarDetailController@add');
	Route::get('/barang_keluar_detail/edit_form', 'BarangKeluarDetailController@edit');
	Route::post('/barang_keluar_detail/create', 'BarangKeluarDetailController@addPost');
	Route::post('/barang_keluar_detail/edit', 'BarangKeluarDetailController@update');
	Route::post('/barang_keluar_detail/delete', 'BarangKeluarDetailController@delete');
	Route::post('/barang_keluar_detail/sent','BarangKeluarDetailController@sent');
	//barang masuk hibah
	Route::get('/barangmasuk_hibah/printReport','BarangMasukHibahController@printReport');
	Route::get('/barangmasuk_hibah/index','BarangMasukHibahController@index');
	Route::get('/barangmasuk_hibah/add_form','BarangMasukHibahController@add');
	Route::get('/barangmasuk_hibah/add_details/{id_barangmasukhibah}','BarangMasukHibahController@addDetails');
	Route::get('/barangmasuk_hibah/getPtExist/{projectid}','BarangMasukHibahController@getPtExists');

	Route::get('/barangmasuk_hibah/details_reject/{id}','BarangMasukHibahController@detailsReject');

	Route::get('/barangmasuk_hibah/getDataDetails/{id}','BarangMasukHibahController@getDataDetails');

	Route::get('/barangmasuk_hibah/cetakReject/{id}','BarangMasukHibahController@cetakReject');
	Route::get('/barangmasuk_hibah/cetakBarangMasuk/{id}','BarangMasukHibahController@cetakBarangMasuk');

	Route::get('/barangmasuk_hibah/getData','BarangMasukHibahController@getData');
	Route::get('/barangmasuk_hibah/details/{id}','BarangMasukHibahController@details');
	//delete
	Route::post('/barangmasuk_hibah/delete','BarangMasukHibahController@delete');

	//insert data
	Route::post('barangmasuk_hibah/create','BarangMasukHibahController@addPost');
	Route::post('/barangmasuk_hibah/create_item','BarangMasukHibahController@addItem');
	//Route::post('/barangmasuk_hibah/store_item','BarangMasukHibahController@storeItem');
	Route::post('/barangmasuk_hibah/update','BarangMasukHibahController@update');
	Route::post('/barangmasuk_hibah/updateQuantity','BarangMasukHibahController@updateQuantity');
	Route::post('/barangmasuk_hibah/deliver','BarangMasukHibahController@delivery');

	//Route::post('/barangmasuk_hibah/storeAll','BarangMasukHibahController@addPost');
	//autocomplete
	Route::post('/barangmasuk_hibah/project_autocomplete','BarangMasukHibahController@project_autocomplete');
	Route::post('/barangmasuk_hibah/pt_autocomplete','BarangMasukHibahController@pt_autocomplete');
	//
	Route::post('/barangmasuk_hibah/changeSatuan','BarangMasukHibahController@changeSatuan');
	//editable
	Route::get('/barangmasuk_hibah/project_source','BarangMasukHibahController@projectSource');
	Route::get('/barangmasuk_hibah_details/warehouse_source','BarangMasukHibahController@warehouseSource');
	Route::get('/barangmasuk_hibah_details/satuan_source','BarangMasukHibahController@satuanSource');

	Route::get('/barangmasuk_hibah/pt_source','BarangMasukHibahController@ptSource');
	Route::get('/barangmasuk_hibah/edit','BarangMasukHibahController@edit');
	//details
	Route::post('/barangmasuk_hibah_details/update','BarangMasukHibahController@updateDetails');

	//pengembalian barang

	Route::get('/pengembalian_barang/index','PengembalianbarangController@index');
	Route::get('/pengembalian_barang/add','PengembalianbarangController@add');
	Route::get('/pengembalian_barang/getData','PengembalianbarangController@getData');
	Route::post('/pengembalian_barang/store','PengembalianbarangController@store');
	Route::get('/pengembalian_barang/details/{idbarangkeluar}','PengembalianbarangController@details');

	Route::post('/pengembalian_barang/check_no_permintaan','PengembalianbarangController@checkNoPermintaanBarang');

	Route::post('/pengembalian_barang/delete','PengembalianbarangController@delete');
	Route::post('/pengembalian_barang/update','PengembalianbarangController@update');
	Route::post('/pengembalian_barang/check',"PengembalianbarangController@checkNoBarangKeluar");

	// asset
	Route::get('/asset/index', 'AssetController@index');

	Route::get('/asset/print','AssetController@print');
	Route::get('/asset/printReport','AssetController@printReport');
	Route::get('/asset/getPenyusutanAsset','AssetController@getPenyusutanAsset');

	Route::get('/asset/posisiAsset','AssetController@posisiAsset');
	Route::get('/asset/getPosisi','AssetController@getPosisiAsset');
	Route::get('/asset/laporanposisiasset','AssetController@laporanPosisiAsset');

	Route::get('/asset/add_form', 'AssetController@add');
	Route::get('/asset/edit_form', 'AssetController@edit');
	Route::post('/asset/is_labeled','AssetController@checkLabled');
	Route::post('/asset/create', 'AssetController@addPost');
	Route::post('/asset/update', 'AssetController@update');
	Route::post('/asset/delete', 'AssetController@delete');
	Route::post('/asset/create_qrCode','AssetController@printQrCode');
	Route::get('/asset/daftarAsset','AssetController@daftarAsset');
	Route::get('/asset/getListAssets','AssetController@getListAssets');
	Route::get('/asset/getAssets','AssetController@getAssets');
	Route::get('/asset/details/{item_id}','AssetController@details');
	Route::get('/asset/getDetailsPerItem/{item_id}','AssetController@getAssetPerItem');
	Route::get('/asset/getDetailTransactionPerItem/{asset_id}','AssetController@getAssetTransactionRotasi');
	Route::get('/asset/detailTransaction/{asset_id}','AssetController@detailTransaction');

	//mutasi in
	Route::get('/mutasi_in/getData','MutasiInController@getData');
	Route::get('/mutasi_in/indexFromEmployee','MutasiInController@indexFromEmployee');
	Route::get('/mutasi_in/indexFromProyek','MutasiInController@indexFromProyek');
	Route::get('/mutasi_in/indexFromOther','MutasiInController@indexFromOther');
	Route::get('/mutasi_in/indexFromRekanan','MutasiInController@indexFromRekanan');
	Route::get('/mutasi_in/index','MutasiInController@index');

	Route::post('/mutasi_in/create_asset','MutasiInController@createAsset');
	Route::get('/mutasi_in/details_assets/{mutasi_in_id}','MutasiInController@detail_assets');
	Route::get('/mutasi_in/getAssets/{mutasi_in_id}','MutasiInController@getAssets');
	Route::get('/mutasi_in/printQrCode/{mutasi_in_id}','MutasiInController@printQrCode');

	Route::get('/mutasi_in/projectTypeaHead','MutasiInController@ProjectTypeAhead');

	Route::get('/mutasi_in/add_from_employee','MutasiInController@addFromEmployee');
	Route::get('/mutasi_in/add_from_proyek','MutasiInController@addFromProject');
	Route::get('/mutasi_in/add_from_rekanan','MutasiInController@addFromRekanan');
	Route::get('/mutasi_in/add_from_other','MutasiInController@addFromOther');

	Route::get('/mutasi_in/getDataFromEmployee','MutasiInController@getMutasiInfromEmployee');
	Route::get('/mutasi_in/getDataFromProyek','MutasiInController@getMutasiInfromProyek');
	Route::get('/mutasi_in/getDataFromRekanan','MutasiInController@getMutasiInfromRekanan');
	Route::get('/mutasi_in/getDataFromOther','MutasiInController@getMutasiInfromOther');

	Route::get('/mutasi_in/details/{id}','MutasiInController@details');
	Route::post('/mutasi_in/details_assets/postDepartment','MutasiInController@postDepartment');


	Route::get('/getUsers/type_user','MutasiInController@getUsers');
	Route::get('/getmembers/type_member','MutasiInController@getMembers');
	Route::get('/getRekanan/type_rekanan','MutasiInController@getRekanan');

	Route::post('/mutasi_in/create','MutasiInController@addPost');
	//mutasi out
	Route::get('/mutasi_out/getData','MutasiOutController@getData');
	Route::post('/mutasi_out/getSource','MutasiOutController@getSource');
	Route::get('/mutasi_out/index','MutasiOutController@index');
	Route::get('/mutasi_out/add','MutasiOutController@add');
	Route::get('/mutasi_out/details/{id}','MutasiOutController@detail');
	Route::post("/mutasi_out/store","MutasiOutController@addPost");
	Route::post('/mutasi_out/getItemAsset','MutasiOutController@getItemAsset');
	//rotasi
	Route::post('/rotasi/getCurrentPosition','RotasiController@getCurrentPosition');
	Route::get('/rotasi/getData','RotasiController@getData');
	Route::get('/rotasi/index','RotasiController@index');
	Route::get('/rotasi/add','RotasiController@add');
	Route::post('/rotasi/create','RotasiController@addPost');
	Route::get('/rotasi/details/{id}','RotasiController@details');
	//Route::get("/rotasi/details2/{id}","RotasiController@details2");

	// asset_detail
	Route::get('/asset_detail/index', 'AssetDetailController@index');
	Route::get('/asset_detail/add_form', 'AssetDetailController@add');
	Route::get('/asset_detail/edit_form', 'AssetDetailController@edit');
	Route::post('/asset_detail/create', 'AssetDetailController@addPost');
	Route::post('/asset_detail/edit', 'AssetDetailController@update');
	Route::post('/asset_detail/delete', 'AssetDetailController@delete');

	// asset_detail_item
	Route::get('/asset_detail_item/index', 'AssetDetailItemController@index');
	Route::get('/asset_detail_item/add_form', 'AssetDetailItemController@add');
	Route::get('/asset_detail_item/edit_form', 'AssetDetailItemController@edit');
	Route::post('/asset_detail_item/create', 'AssetDetailItemController@addPost');
	Route::post('/asset_detail_item/edit', 'AssetDetailItemController@update');
	Route::post('/asset_detail_item/delete', 'AssetDetailItemController@delete');

	// asset_transaction
	Route::get('/asset_transaction/index', 'AssetTransactionController@index');
	Route::get('/asset_transaction/add_form', 'AssetTransactionController@add');
	Route::get('/asset_transaction/edit_form', 'AssetTransactionController@edit');
	Route::post('/asset_transaction/create', 'AssetTransactionController@addPost');
	Route::post('/asset_transaction/edit', 'AssetTransactionController@update');
	Route::post('/asset_transaction/delete', 'AssetTransactionController@delete');

	// asset_transaction_detail
	Route::get('/asset_transaction_detail/index', 'AssetTransactionDetailController@index');
	Route::get('/asset_transaction_detail/add_form', 'AssetTransactionDetailController@add');
	Route::get('/asset_transaction_detail/edit_form', 'AssetTransactionDetailController@edit');
	Route::post('/asset_transaction_detail/create', 'AssetTransactionDetailController@addPost');
	Route::post('/asset_transaction_detail/edit', 'AssetTransactionDetailController@update');
	Route::post('/asset_transaction_detail/delete', 'AssetTransactionDetailController@delete');

	// warehouse
	Route::get('/warehouse/pic/index','WarehouseController@picIndex');
	Route::get('/warehouse/pic/add_form','WarehouseController@picAdd');

	Route::post('/warehouse/storePic','WarehouseController@storePic');

	Route::get('/warehouse/details/{id}','WarehouseController@details');
	Route::post('/warehouse/pic/store','WarehouseController@picStore');
	Route::post('/warehouse/pic/delete','WarehouseController@picDelete');

	Route::get('/warehouse/index', 'WarehouseController@index');
	Route::get('/warehouse/add_form', 'WarehouseController@add');
	Route::get('/warehouse/edit_form', 'WarehouseController@edit');
	Route::post('/warehouse/create', 'WarehouseController@addPost');
	Route::post('/warehouse/update', 'WarehouseController@update');
	Route::post('/warehouse/delete', 'WarehouseController@delete');

	
	//inventarisir
	Route::get('/inventarisir/index','InventarisirController@index');
	Route::get('/inventarisir/add_form','InventarisirController@add');
	Route::get('/inventarisir/edit_form','InventarisirController@edit');
	Route::post('/inventarisir/create','InventarisirController@addPost');
	Route::post('/inventarisir/edit', 'InventarisirController@update');
	Route::post('/inventarisir/delete', 'InventarisirController@delete');

	//inventarisir Detail
	Route::get('/inventarisir_detail/index','InventarisirDetailController@index');
	Route::get('/inventarisir_detail/add_form','InventarisirDetailController@add');
	Route::get('/inventarisir_detail/edit_form','InventarisirDetailController@edit');
	Route::post('/inventarisir_detail/create','InventarisirDetailController@addPost');
	Route::post('/inventarisir_detail/create_other','InventarisirDetailController@addPostOther');
	Route::post('/inventarisir_detail/edit', 'InventarisirDetailController@update');
	Route::post('/inventarisir_detail/delete', 'InventarisirDetailController@delete');
	//stock opname
	Route::get('/opname/listPeriod','StockOpNameController@periode_index');
	Route::get('/opname/getPeriods','StockOpNameController@getPeriodAssetOp');
	Route::get('/opname/getAssets','StockOpNameController@getAssets');
	Route::get('/opname/assets/{periode_id}','StockOpNameController@assets');
	Route::get('/opname/create_period','StockOpNameController@setup_period');
	Route::get('/opname/scan_qr_code/{periode_id}','StockOpNameController@scan');

	Route::post('/period/opname_delete','StockOpNameController@deletePeriode');
	Route::post('/period_opname/update','StockOpNameController@updatePeriod');
	Route::post('/opname/store_period','StockOpNameController@store_period');
	Route::post('/opname/store_opname_asset','StockOpNameController@store_opname');


	Route::get('/stock/transactionReport','StockController@printInventoryTransaction');
	Route::get('/stock/items_stock','StockController@getStocks');
	Route::get('/stock/view_stock','StockController@viewStock');
	Route::get('/stock/view_details/{id}','StockController@detailsStock');
	Route::get('/stock/print','StockController@print');
	Route::get('/stock/minimum_stock','StockController@printMinimumStock');

	Route::get('/member/index','MemberController@index');
	Route::post('/member/delete','MemberController@delete');
	Route::get('/member/getData','MemberController@getData');
	Route::post('/member/store','MemberController@store');

	Route::get('/room/index','RoomController@index');
	Route::get('/room/getData','RoomController@getData');
	Route::post('/room/store','RoomController@store');
	Route::post('/room/delete','RoomController@delete');
	Route::get('/room/type_room','RoomController@typeRoom');

	Route::get('/hod_inventory/approval_mutasiin','InventoryController@approvalMutasiIn');

	//Laporan Inventory
	Route::get('/laporan/index','LaporanController@index');
	Route::get('/laporan/getdaftarbarang','LaporanController@getdaftarbarang');
	Route::get('/laporan/printMin/{id}','LaporanController@printMin');
	Route::get('laporan/indexpemakaian','LaporanController@indexpemakaian');
	Route::get('/laporan/getdaftarbarangpemakaian','LaporanController@getdaftarbarangpemakaian');
	Route::get('/laporan/printMinpemakaian','LaporanController@printMinpemakaian');
	Route::get('/laporan/indexpersediaan','LaporanController@indexpersediaan');
	Route::get('/laporan/getposisi', 'LaporanController@getposisi');
	Route::get('/laporan/cetak', 'LaporanController@cetak');

	//General Source Controller
	Route::get('/general/type_department','GeneralSourceController@typeDepartmentSource');
	Route::get('/general/department_source','GeneralSourceController@DepartmentSource');
	Route::get('/general/user_source','GeneralSourceController@UserSource');
	Route::get('/general/city_source','GeneralSourceController@CitySource');
	Route::get('/general/room_source','GeneralSourceController@RoomSource');\
	//statu permintaan
	Route::get('/status_permintaan/index','StatusPermintaanController@index');
	Route::get('/status_permintaan/getData','StatusPermintaanController@getData');
	Route::post('/status_permintaan/store','StatusPermintaanController@store');
	Route::post('/status_permintaan/delete','StatusPermintaanController@delete');

	//barangmasuk hibah
	Route::get('/hod_inventory/approval_barangmasukhibah','InventoryController@approval_barangmasuk');
	Route::post('/hod_inventory/barangmasuk/undelivered','InventoryController@undeliveredBarangMasuk');
	Route::get('/hod_inventory/barangmasuk_hibah/details/{id}','InventoryController@barangmasuk_hibah_details');
	Route::get('/hod_inventory/barangmasuk_hibah/Getdetails/{id}','InventoryController@getDataDetailsBarangMasukHibah');
	Route::get('/hod_inventory/barangmasuk_hibah/details_item/{barangmasukhibah_id}/{warehouse_id}/{item_id}/{item_satuan_id}','InventoryController@barangmasuk_hibah_details_items');
	//aproval
	Route::post('/barangmasuk_hibah/approve','InventoryController@barangmasuk_approve');
	Route::post('/hod_inventory/barangmasuk_hibah/unapprove','InventoryController@barangmasuk_unapprove');
	//
	Route::get('/hod_inventory/daftar_barangmasukhibah','InventoryController@daftar_barangmasukHibah');
	Route::get('/hod_inventory/getDaftarBarangMasukHibah','InventoryController@getDaftarBarangMasukHibah');
	Route::get('/hod_inventory/getApprovalBarangMasukHibah','InventoryController@getListApprovalBarangMasuk');
	//barang keluar
	//Route::get('/hod_inventory/getListApprovalBarangKeluar','InventoryController@getListApprovalBarangKeluar');
	//
	Route::get('/hod_inventory/approval_barangkeluar','InventoryController@approval_barangkeluar');
	Route::get('/hod_inventory/getListApprovalBarangKeluar','InventoryController@getListApprovalBarangKeluar');
	Route::get('/hod_inventory/detailsBarangKeluar/{id}','InventoryController@detailsBarangkeluar');
	Route::post('/hod_inventory/approveBarangKeluar','InventoryController@approveBarangKeluar');
	Route::get('/hod_inventory/daftar_barangkeluar','InventoryController@daftarBarangKeluar');
	Route::get('/hod_inventory/getDaftarBarangKeluar','InventoryController@getDaftarBarangKeluar');
	//pengembalian barang
	Route::get('/hod_inventory/getListApprovalPengembalianbarang','InventoryController@getListApprovalPengembalianbarang');
	Route::get('/hod_inventory/approval_pengembalianbarang','InventoryController@approval_pengembalianbarang');
	Route::get('/hod_inventory/getDaftarPengembalianbarang','InventoryController@getDaftarPengembalianbarang');
	Route::get('/hod_inventory/daftar_pengembalianbarang','InventoryController@DaftarPengembalianBarang');

	Route::post('/hod_inventory/approve_pengembalianbarang','InventoryController@approvePengembalianBarang');

	//mutasi out 
	Route::get('/hod_inventory/approvalMutasiOut','InventoryController@approvalMutasiOut');
	Route::get('/hod_inventory/getListApprovalMutasiOut','InventoryController@getListApprovalMutasiOut');
	Route::post('/hod_inventory/approveMutasiOut','InventoryController@approveMutasiOut');
	Route::get('/hod_inventory/detailsMutasiOut/{id}','InventoryController@detailsMutasiOut');
	Route::get('/hod_inventory/getListMutasiOut','InventoryController@getListMutasiOut');
	Route::get('/hod_inventory/daftarMutasiOut','InventoryController@daftarMutasiOut');
	Route::post('/hod_inventory/approveMutasiIn','InventoryController@approveMutasiIn');
	//mutasi in
	Route::get('/hod_inventory/approvalMutasiIn','InventoryController@approvalMutasiIn');
	Route::get('/hod_inventory/getApprovalMutasiIn','InventoryController@getApprovalMutasiIn');
	Route::get('/hod_inventory/getDaftarMutasiIn','InventoryController@getDaftarMutasiIn');
	Route::get('/hod_inventory/DaftarMutasiIn','InventoryController@daftarMutasiIn');

	//permintaan barang hod
	Route::get('/hod_inventory/detailsPermintaan/{id}','InventoryController@detailsPermintaan');
	Route::post('/hod_inventory/approvePermintaanbarang','InventoryController@approvalPermintaan');
	Route::get('/hod_inventory/approval_permintaan','InventoryController@approval_permintaan');
	Route::get('/hod_inventory/getListApprovalPermintaanbarang','InventoryController@getListApprovalPermintaanbarang');
	Route::get('/hod_inventory/getListPermintaan','InventoryController@getListPermintaan');
	Route::get('/hod_inventory/daftar_permintaanbarang','InventoryController@daftar_permintaanbarang');


});

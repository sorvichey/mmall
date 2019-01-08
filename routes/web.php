<?php

// front controller
Route::get('/',"FrontController@index");
Route::get('/career',"FrontController@career");
Route::get('/career/detail/{id}',"FrontController@career_detail");
Route::get('/product/detail/{id}', "FrontController@product_detail");
Route::get('/product/best-deal', "FrontProductListController@best_deal");
Route::get('/product/best-deal/list-view', "FrontProductListController@best_deal_list_view");
Route::get('/product/best-seller', "FrontProductListController@best_seller");
Route::get('/product/best-seller/list-view', "FrontProductListController@best_seller_list_view");
Route::get('/product/new-arrival', "FrontProductListController@new_arrival");
Route::get('/product/new-arrival/list-view', "FrontProductListController@new_arrival_list_view");
// Buyer 
Route::post('/buyer/sign-up', "SecurityController@buyer_sign_up");
Route::post('/buyer/sign-in', "SecurityController@do_login");
Route::post('/buyer/wish/save', "WishController@save");
Route::get('/buyer/account-recovery', "SecurityController@buyer_account_recovery");
Route::post('/buyer/account-recovery/send', "SecurityController@buyer_send_account_recovery");
Route::post('/buyer/reset-password/save', "SecurityController@buyer_reset_password");
Route::get('/buyer/service/reset/{id}', "SecurityController@buyer_new_password");
Route::get('/buyer/service/activated/{id}', "SecurityController@buyer_activated_account");
Route::post('buyer/activated/save', "SecurityController@buyer_activated_save");
Route::get('/buyer/wishlist', "WishController@index");
Route::get('/buyer/wishlist/delete/{id}', "WishController@delete");
Route::get('/my-account/setting/{id}', "SecurityController@buyer_account_setting");
Route::post('/my-account/setting/save/{id}', "SecurityController@buyer_account_save_change");
Route::post('/my-account/setting/pwd/{id}', "SecurityController@buyer_account_save_change_pwd");

// Product category
Route::get('product/category/{id}', "FrontProductListController@product_by_category");
Route::get('product/category/list-view/{id}', "FrontProductListController@product_by_category_list_view");

Route::get('product-search', "FrontProductListController@product_search");
Route::post('/product/rate', "ReviewProductController@save");
Route::get('/tracking', "FrontTrackingController@tracking");


Route::get('/buyer/logout', "SecurityController@logout");

//Shop owner
Route::get('/owner/logout', "ShopOwnerController@logout");
Route::get('/owner/login', "ShopOwnerController@login");
Route::post('/owner/sign-up', "ShopOwnerController@shop_owner_sign_up");
Route::post('/owner/sign-in', "ShopOwnerController@do_login");
Route::get('/owner/service/activated/{id}', "ShopOwnerController@shop_owner_activated_account");
Route::post('owner/activated/save', "ShopOwnerController@shop_owner_activated_save");
Route::get('/owner/account-recovery', "ShopOwnerController@shop_owner_account_recovery");
Route::post('/owner/account-recovery/send', "ShopOwnerController@shop_owner_send_account_recovery");
Route::post('/owner/reset-password/save', "ShopOwnerController@shop_owner_reset_password");
Route::get('/owner/service/reset/{id}', "ShopOwnerController@shop_owner_new_password");
Route::get('/owner/home', "ShopOwnerController@home");
Route::get('/owner/profile/{id}', "ShopOwnerController@edit");
Route::post('/owner/update', "ShopOwnerController@update");
Route::get('/owner/my-shop', "ShopOwnerController@my_shop");
Route::get('/owner/create-shop', "ShopOwnerController@create_shop");

Route::post('/owner/shop/create', "ShopOwnerController@do_create_shop");
Route::get('/owner/shop/edit/{id}', "ShopOwnerController@edit_shop");
Route::post('/owner/shop/update', "ShopOwnerController@do_edit_shop");
Route::get('/owner/shop-subscribe/{id}', "ShopOwnerController@shop_subscription");
Route::get('/owner/shop/subcribe/{id}', "ShopOwnerController@do_shop_subscription");

Route::get('/owner/my-product', "ShopOwnerController@product");
Route::get('/owner/new-product', "ShopOwnerController@new_product");
Route::post('/owner/add-product', "ShopOwnerController@save_product");
Route::get('/owner/detail-product/{id}', "ShopOwnerController@detail_product");
Route::get('/owner/edit-product/{id}', "ShopOwnerController@edit_product");
Route::post('/owner/save-edit-product/', "ShopOwnerController@do_edit_product");
Route::get('/owner/delete-product/{id}', "ShopOwnerController@delete_product");

// product image for shop owner
Route::get('/owner/product/detail/{id}/image', "OwnerPhotoController@index");
Route::get('/owner/product/photo/delete/{id}', "OwnerPhotoController@delete");
Route::post('/owner/product/photo/save', "OwnerPhotoController@save");

// product color for shop owner
Route::get('/owner/product/detail/{id}/color', "OwnerProductColorController@index");
Route::get('/owner/product-color/photo/delete/{id}', "OwnerProductColorController@delete");
Route::post('/owner/product-color/photo/save', "OwnerProductColorController@save");

// product size for shop owner
Route::get('/owner/product/detail/{id}/size', "OwnerProductSizeController@index");
Route::get('/owner/product-size/delete/{id}', "OwnerProductSizeController@delete");
Route::post('/owner/product-size/save', "OwnerProductSizeController@save");
// shop owner best seller and best deal
Route::get('/owner/product/best-seller/{id}', "ShopOwnerController@best_seller");
Route::get('/owner/product/best-seller/return/{id}', "ShopOwnerController@best_seller_return");
Route::get('/owner/product/best-deal/{id}', "ShopOwnerController@best_deal");
Route::get('/owner/product/best-deal/return/{id}', "ShopOwnerController@best_deal_return");

Route::get('/owner/message/', "OwnerMessageController@index");






//header('Access-Control-Allow-Headers: X-Requested-With, origin, content-type');
// admin controller
Route::get('/admin', function () {
    return redirect('/login');
});

Route::get('/page/{id}', 'FrontPageController@page');
Route::get('/', 'FrontController@index');
Route::get('/buyer/login', 'SecurityController@login');
//admin dashboard layout
Route::get('/home', 'HomeController@index')->name('home');

//admin shop owner managment
Route::get('/admin/shop-owner', "AdminShopOwnerController@index");
Route::get('/admin/shop-owner/delete/{id}', "AdminShopOwnerController@delete");
Route::get('/admin/shop-owner/reset-password/{id}', "AdminShopOwnerController@reset_password");
Route::post('/admin/shop-owner/change-password', "AdminShopOwnerController@change_password");
Route::get('/admin/shop-owner/detail/{id}', "AdminShopOwnerController@detail");

//subscription
Route::get('/admin/subscription/', "AdminSubscriptionController@index");
Route::get('/admin/subscription/create', "AdminSubscriptionController@create");
Route::post('/admin/subscription/save', "AdminSubscriptionController@save");
Route::get('/admin/subscription/detail/{id}', "AdminSubscriptionController@detail");
Route::get('/admin/subscription/edit/{id}', "AdminSubscriptionController@edit");
Route::post('/admin/subscription/update', "AdminSubscriptionController@update");
Route::get('/admin/subscription/delete/{id}', "AdminSubscriptionController@delete");

//shops for admin
Route::get('/admin/shops/', "AdminShopController@index");
Route::get('/admin/shops/detail/{id}', "AdminShopController@detail");
Route::get('/admin/shops/disable/{id}', "AdminShopController@disable");
Route::get('/admin/shops/approve/{id}', "AdminShopController@approve");

//shop subscription
Route::get('/admin/shop-subscription/', "AdminShopSubscriptionController@index");
Route::get('/admin/shop-subscription/detail/{id}', "AdminShopSubscriptionController@detail");
Route::post('/admin/shop-subscription/update', "AdminShopSubscriptionController@update");
Route::get('/admin/shop-subscription/delete/{id}', "AdminShopSubscriptionController@delete");
Route::get('/admin/shop-subscription/approve/{id}', "AdminShopSubscriptionController@approve_subscription");

// management layout
Route::get('/admin/product-management', "ManagementController@product");
Route::get('/admin/customer-management', "ManagementController@customer");
Route::get('/admin/career-management', "ManagementController@career");
Route::get('/admin/tracking-management', "ManagementController@tracking");

// product category
Route::resource('product-category', "ProductCategoryController");

// user route
Route::get('/user', "UserController@index");
Route::get('/user/profile', "UserController@load_profile");
Route::get('/user/reset-password', "UserController@reset_password");
Route::post('/user/change-password', "UserController@change_password");
Route::get('/user/finish', "UserController@finish_page");
Route::post('/user/update-profile', "UserController@update_profile");
Route::get('/user/delete/{id}', "UserController@delete");
Route::get('/user/create', "UserController@create");
Route::post('/user/save', "UserController@save");
Route::get('/user/edit/{id}', "UserController@edit");
Route::post('/user/update', "UserController@update");
Route::get('/user/update-password/{id}', "UserController@load_password");
Route::post('/user/save-password', "UserController@update_password");

// scholarship
Route::get("/admin/scholarship", "ScholarshipController@index");
Route::get("/admin/scholarship/create", "ScholarshipController@create");
Route::get("/admin/scholarship/edit/{id}", "ScholarshipController@edit");
Route::get("/admin/scholarship/detail/{id}", "ScholarshipController@show");
Route::get("/admin/scholarship/delete/{id}", "ScholarshipController@destroy");
Route::post("/admin/scholarship/save", "ScholarshipController@store");
Route::post("/admin/scholarship/update", "ScholarshipController@update");

// product category
Route::get("/admin/product-category", "ProductCategoryController@index");
Route::get("/admin/product-category/create", "ProductCategoryController@create");
Route::get("/admin/product-category/edit/{id}", "ProductCategoryController@edit");
Route::get("/admin/product-category/delete/{id}", "ProductCategoryController@destroy");
Route::post("/admin/product-category/save", "ProductCategoryController@save");
Route::post("/admin/product-category/update", "ProductCategoryController@update");

// shop category
Route::get("/admin/shop-category", "ShopCategoryController@index");
Route::get("/admin/shop-category/create", "ShopCategoryController@create");
Route::get("/admin/shop-category/edit/{id}", "ShopCategoryController@edit");
Route::get("/admin/shop-category/delete/{id}", "ShopCategoryController@destroy");
Route::post("/admin/shop-category/save", "ShopCategoryController@save");
Route::post("/admin/shop-category/update", "ShopCategoryController@update");

// tracking
Route::get('/admin/tracking', "TrackingController@index");
Route::get('/admin/tracking/create', "TrackingController@create");
Route::get('/admin/tracking/edit/{id}', "TrackingController@edit");
Route::get('/admin/tracking/delete/{id}', "TrackingController@delete");
Route::post('/admin/tracking/save', "TrackingController@save");
Route::post('/admin/tracking/update', "TrackingController@update");
Route::get('/admin/tracking/detail/{id}', "TrackingController@view");
Route::get('/admin/sub-tracking/delete/{id}', "TrackingController@sub_tracking_delete");
Route::post('/admin/sub-tracking/save', "TrackingController@sub_tracking_save");

// slide show
Route::get('/admin/slide', "SlideController@index");
Route::get('/admin/slide/create', "SlideController@create");
Route::post('/admin/slide/save', "SlideController@save");
Route::get('/admin/slide/edit/{id}', "SlideController@edit");
Route::post('/admin/slide/update', "SlideController@update");
Route::get('/admin/slide/delete/{id}', "SlideController@delete");

// origin
Route::get('/admin/tracking-origin', "TrackingOriginController@index");
Route::get('/admin/tracking-origin/create', "TrackingOriginController@create");
Route::post('/admin/tracking-origin/save', "TrackingOriginController@save");
Route::get('/admin/tracking-origin/edit/{id}', "TrackingOriginController@edit");
Route::post('/admin/tracking-origin/update', "TrackingOriginController@update");
Route::get('/admin/tracking-origin/delete/{id}', "TrackingOriginController@delete");

// location
Route::get('/admin/tracking-location', "TrackingLocationController@index");
Route::get('/admin/tracking-location/create', "TrackingLocationController@create");
Route::post('/admin/tracking-location/save', "TrackingLocationController@save");
Route::get('/admin/tracking-location/edit/{id}', "TrackingLocationController@edit");
Route::post('/admin/tracking-location/update', "TrackingLocationController@update");
Route::get('/admin/tracking-location/delete/{id}', "TrackingLocationController@delete");

// destination
Route::get('/admin/tracking-destination', "TrackingDestinationController@index");
Route::get('/admin/tracking-destination/create', "TrackingDestinationController@create");
Route::post('/admin/tracking-destination/save', "TrackingDestinationController@save");
Route::get('/admin/tracking-destination/edit/{id}', "TrackingDestinationController@edit");
Route::post('/admin/tracking-destination/update', "TrackingDestinationController@update");
Route::get('/admin/tracking-destination/delete/{id}', "TrackingDestinationController@delete");

// destination
Route::get('/admin/tracking-status', "TrackingStatusController@index");
Route::get('/admin/tracking-status/create', "TrackingStatusController@create");
Route::post('/admin/tracking-status/save', "TrackingStatusController@save");
Route::get('/admin/tracking-status/edit/{id}', "TrackingStatusController@edit");
Route::post('/admin/tracking-status/update', "TrackingStatusController@update");
Route::get('/admin/tracking-status/delete/{id}', "TrackingStatusController@delete");

// payment type
Route::get('/admin/payment-type', "PaymentTypeController@index");
Route::get('/admin/payment-type/create', "PaymentTypeController@create");
Route::post('/admin/payment-type/save', "PaymentTypeController@save");
Route::get('/admin/payment-type/edit/{id}', "PaymentTypeController@edit");
Route::post('/admin/payment-type/update', "PaymentTypeController@update");
Route::get('/admin/payment-type/delete/{id}', "PaymentTypeController@delete");

// contact info
Route::get('/admin/contact-info', "ContactInfoController@index");
Route::get('/admin/contact-info/create', "ContactInfoController@create");
Route::post('/admin/contact-info/save', "ContactInfoController@save");
Route::get('/admin/contact-info/edit/{id}', "ContactInfoController@edit");
Route::post('/admin/contact-info/update', "ContactInfoController@update");
Route::get('/admin/contact-info/delete/{id}', "ContactInfoController@delete");

// phone support
Route::get('/admin/phone-support', "PhoneSupportController@index");
Route::get('/admin/phone-support/edit/{id}', "PhoneSupportController@edit");
Route::post('/admin/phone-support/update', "PhoneSupportController@update");

// social
Route::get('/admin/social', "SocialController@index");
Route::get('/admin/social/create', "SocialController@create");
Route::post('/admin/social/save', "SocialController@save");
Route::get('/admin/social/edit/{id}', "SocialController@edit");
Route::post('/admin/social/update', "SocialController@update");
Route::get('/admin/social/delete/{id}', "SocialController@delete");


// product brand
Route::get('/admin/brand', "BrandController@index");
Route::get('/admin/brand/create', "BrandController@create");
Route::post('/admin/brand/save', "BrandController@save");
Route::get('/admin/brand/edit/{id}', "BrandController@edit");
Route::post('/admin/brand/update', "BrandController@update");
Route::post('/admin/brand/top', "BrandController@top");
Route::post('/admin/brand/down', "BrandController@down");
Route::get('/admin/brand/delete/{id}', "BrandController@delete");

// page
Route::get('/admin/page', "PageController@index");
Route::get('/admin/page/create', "PageController@create");
Route::post('/admin/page/save', "PageController@save");
Route::get('/admin/page/edit/{id}', "PageController@edit");
Route::get('/admin/page/detail/{id}', "PageController@detail");
Route::post('/admin/page/update', "PageController@update");
Route::get('/admin/page/delete/{id}', "PageController@delete");

// role
Route::get("/role", "RoleController@index");
Route::get("/role/create", "RoleController@create");
Route::get("/role/edit/{id}", "RoleController@edit");
Route::get("/role/delete/{id}", "RoleController@delete");
Route::post("/role/save", "RoleController@save");
Route::post("/role/update", "RoleController@update");
Route::get('/role/permission/{id}', "PermissionController@index");
Route::post('/rolepermission/save', "PermissionController@save");
Route::auth();

// settings
Route::get('/admin/setting', "SettingController@index");

// mgmt
Route::get("/management" ,"ManagementController@index");

// product
Route::get('/admin/product', "ProductController@index")->name('/admin/product');
Route::get('/admin/product/detail/{id}', "ProductController@detail");
Route::get('/admin/product/create', "ProductController@create");
Route::get('/admin/product/edit/{id}', "ProductController@edit");
Route::get('/admin/product/delete/{id}', "ProductController@delete");
Route::post('/admin/product/save', "ProductController@save");
Route::post('/admin/product/update', "ProductController@update");

// product image
Route::get('/admin/product/detail/{id}/image', "PhotoController@index");
Route::get('/admin/product/photo/delete/{id}', "PhotoController@delete");
Route::post('/admin/product/photo/save', "PhotoController@save");

// product color
Route::get('/admin/product/detail/{id}/color', "ProductColorController@index");
Route::get('/admin/product-color/photo/delete/{id}', "ProductColorController@delete");
Route::post('/admin/product-color/photo/save', "ProductColorController@save");


Route::get('/admin/product/best-seller/{id}', "ProductController@best_seller");
Route::get('/admin/product/best-seller/return/{id}', "ProductController@best_seller_return");
Route::get('/admin/product/best-deal/{id}', "ProductController@best_deal");
Route::get('/admin/product/best-deal/return/{id}', "ProductController@best_deal_return");
Route::get('/language/{id}', "LangController@index");

// buyer
Route::get('/admin/buyer', "BuyerController@index");
Route::get('/admin/buyer/delete/{id}', "BuyerController@delete");
Route::get('/admin/buyer/reset-password/{id}', "BuyerController@reset_password");
Route::post('/admin/buyer/change-password', "BuyerController@change_password");
Route::get('/admin/buyer/detail/{id}', "BuyerController@detail");
Route::get('/admin/buyer/edit/{id}', "BuyerController@edit");
Route::post('/admin/buyer/update/', "BuyerController@update");

//Rate
Route::get('/admin/rate', "RateController@index");
Route::get('/admin/rate/delete/{id}', "RateController@delete");
Route::get('/admin/rate/approve/{id}', "RateController@approve");
Route::get('/admin/rate', "ReviewProductController@save");

//Sub page
Route::get('/admin/sub-page', "SubPageController@index");
Route::get('/admin/sub-page/create', "SubPageController@create");
Route::post('/admin/sub-page/save', "SubPageController@save");
Route::get('/admin/sub-page/edit/{id}', "SubPageController@edit");
Route::get('/admin/sub-page/detail/{id}', "SubPageController@detail");
Route::post('/admin/sub-page/update', "SubPageController@update");
Route::get('/admin/sub-page/delete/{id}', "SubPageController@delete");

//career category
Route::get('/admin/career-category', "CareerCategoryController@index");
Route::get('/admin/career-category/create', "CareerCategoryController@create");
Route::post('/admin/career-category/save', "CareerCategoryController@save");
Route::get('/admin/career-category/edit/{id}', "CareerCategoryController@edit");
Route::post('/admin/career-category/update', "CareerCategoryController@update");
Route::get('/admin/career-category/delete/{id}', "CareerCategoryController@delete");

//department cateogry
Route::get('/admin/department-category', "DepartmentCategoryController@index");
Route::get('/admin/department-category/create', "DepartmentCategoryController@create");
Route::post('/admin/department-category/save', "DepartmentCategoryController@save");
Route::get('/admin/department-category/edit/{id}', "DepartmentCategoryController@edit");
Route::post('/admin/department-category/update', "DepartmentCategoryController@update");
Route::get('/admin/department-category/delete/{id}', "DepartmentCategoryController@delete");

//career location
Route::get('/admin/career-location', "CareerLocationController@index");
Route::get('/admin/career-location/create', "CareerLocationController@create");
Route::post('/admin/career-location/save', "CareerLocationController@save");
Route::get('/admin/career-location/edit/{id}', "CareerLocationController@edit");
Route::post('/admin/career-location/update', "CareerLocationController@update");
Route::get('/admin/career-location/delete/{id}', "CareerLocationController@delete");

////career 
Route::get('/admin/career', "CareerController@index");
Route::get('/admin/career/create', "CareerController@create");
Route::post('/admin/career/save', "CareerController@save");
Route::get('/admin/career/edit/{id}', "CareerController@edit");
Route::get('/admin/career/detail/{id}', "CareerController@detail");
Route::post('/admin/career/update', "CareerController@update");
Route::get('/admin/career/delete/{id}', "CareerController@delete");
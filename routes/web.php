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
Route::post('/buyer/sign-up', "buyer\SecurityController@buyer_sign_up");
Route::post('/buyer/sign-in', "buyer\SecurityController@do_login");
Route::get('/buyer/account-recovery', "buyer\SecurityController@buyer_account_recovery");
Route::post('/buyer/account-recovery/send', "buyer\SecurityController@buyer_send_account_recovery");
Route::post('/buyer/reset-password/save', "Sbuyer\ecurityController@buyer_reset_password");
Route::get('/buyer/service/reset/{id}', "SecurityController@buyer_new_password");
Route::get('/buyer/service/activated/{id}', "buyer\SecurityController@buyer_activated_account");
Route::post('buyer/activated/save', "buyer\SecurityController@buyer_activated_save");
Route::get('/my-account/setting/{id}', "buyer\SecurityController@buyer_account_setting");
Route::post('/my-account/setting/save/{id}', "buyer\SecurityController@buyer_account_save_change");
Route::post('/my-account/setting/pwd/{id}', "buyer\SecurityController@buyer_account_save_change_pwd");

// wishlist
Route::get('/buyer/wishlist', "buyer\WishController@index");
Route::post('/buyer/wish/save', "buyer\WishController@save");
Route::get('/buyer/wishlist/delete/{id}', "buyer\WishController@delete");
Route::get('/buyer/wishlist/count/', "buyer\WishController@wishlist_count");

//add to cart
Route::post('/buyer/cart/save', "buyer\AddToCartController@save");
Route::get('/buyer/mycart', "buyer\AddToCartController@index");
Route::post('/buyer/mycart/edit/{id}', "buyer\AddToCartController@edit");
Route::post('/buyer/mycart/update', "buyer\AddToCartController@update");
Route::get('/buyer/mycart/count', "buyer\AddToCartController@cart_count");
Route::get('/buyer/mycart/delete/{id}', "buyer\AddToCartController@delete");

//shipping info
Route::get('/buyer/shipping-info/create', "buyer\ShippingController@create");
Route::post('/buyer/shipping-info/save', "buyer\ShippingController@save");
Route::get('/buyer/shipping-info/edit/{id}', "buyer\ShippingController@edit");
Route::post('/buyer/shipping-info/update', "buyer\ShippingController@update");

//Credit card
Route::get('/buyer/credit-card/create', "buyer\CreditController@create");
Route::post('/buyer/credit-card/save', "buyer\CreditController@save");
Route::get('/buyer/credit-card/edit/{id}', "buyer\CreditController@edit");
Route::post('/buyer/credit-card/update', "buyer\CreditController@update");

//payment
Route::get('/buyer/payment/create', "buyer\PaymentController@create");
Route::post('/buyer/payment/save', "buyer\PaymentController@save");

// Product category
Route::get('product/category/{id}', "FrontProductListController@product_by_category");
Route::get('product/category/list-view/{id}', "FrontProductListController@product_by_category_list_view");

Route::get('product-search', "FrontProductListController@product_search");
Route::post('/product/rate', "ReviewProductController@save");
Route::get('/tracking', "FrontTrackingController@tracking");


Route::get('/buyer/logout', "buyer\SecurityController@logout");

//Shop owner
Route::get('/owner/logout', "owner\ShopOwnerController@logout");
Route::get('/owner/login', "owner\ShopOwnerController@login");
Route::post('/owner/sign-up', "owner\ShopOwnerController@shop_owner_sign_up");
Route::post('/owner/sign-in', "owner\ShopOwnerController@do_login");
Route::get('/owner/service/activated/{id}', "owner\ShopOwnerController@shop_owner_activated_account");
Route::post('owner/activated/save', "owner\ShopOwnerController@shop_owner_activated_save");
Route::get('/owner/account-recovery', "owner\ShopOwnerController@shop_owner_account_recovery");
Route::post('/owner/account-recovery/send', "owner\ShopOwnerController@shop_owner_send_account_recovery");
Route::post('/owner/reset-password/save', "owner\ShopOwnerController@shop_owner_reset_password");
Route::get('/owner/service/reset/{id}', "owner\ShopOwnerController@shop_owner_new_password");
Route::get('/owner/home', "owner\ShopOwnerController@home");
Route::get('/owner/profile/{id}', "owner\ShopOwnerController@edit");
Route::post('/owner/update', "owner\ShopOwnerController@update");
Route::get('/owner/my-shop', "owner\ShopOwnerController@my_shop");
Route::get('/owner/create-shop', "owner\ShopOwnerController@create_shop");

//Make shop
Route::post('/owner/shop/create', "owner\ShopOwnerController@do_create_shop");
Route::get('/owner/shop/edit/{id}', "owner\ShopOwnerController@edit_shop");
Route::post('/owner/shop/update', "owner\ShopOwnerController@do_edit_shop");
Route::get('/owner/shop-subscribe/{id}', "owner\ShopOwnerController@shop_subscription");
Route::get('/owner/shop/subcribe/{id}', "owner\ShopOwnerController@do_shop_subscription");

// Manage product
Route::get('/owner/my-product', "owner\ShopOwnerController@product");
Route::get('/owner/new-product', "owner\ShopOwnerController@new_product");
Route::post('/owner/add-product', "owner\ShopOwnerController@save_product");
Route::get('/owner/detail-product/{id}', "owner\ShopOwnerController@detail_product");
Route::get('/owner/edit-product/{id}', "owner\ShopOwnerController@edit_product");
Route::post('/owner/save-edit-product/', "owner\ShopOwnerController@do_edit_product");
Route::get('/owner/delete-product/{id}', "owner\ShopOwnerController@delete_product");
Route::post('/owner/product/add-qty/', "owner\ShopOwnerController@add_qty");
Route::get('/owner/product/out-stock/', "owner\ShopOwnerController@out_stock");

// Promotion
Route::get('/owner/product/promotion/', "owner\ShopPromotionController@index");
Route::get('/owner/product/promotion/{id}', "owner\ShopPromotionController@add");
Route::post('/owner/product/promotion/save', "owner\ShopPromotionController@save");
Route::get('/owner/product/promotion/edit/{id}', "owner\ShopPromotionController@edit");
Route::post('/owner/product/promotion/update', "owner\ShopPromotionController@update");
Route::get('/owner/product/promotion/delete/{id}', "owner\ShopPromotionController@delete");

// Product order owner
Route::get('/owner/product/order', "owner\OwnerOrderController@index");
Route::get('/owner/product/order/detail/{id}', "owner\OwnerOrderController@detail");
Route::get('/owner/product/order/edit/{id}', "owner\OwnerOrderController@edit");
Route::post('/owner/product/order/update', "owner\OwnerOrderController@update");

//Buyer order
Route::post('/buyer/product/order/create', "ProductOrderController@create");
Route::post('/buyer/product/order/save', "ProductOrderController@save");
Route::get('/my-order', "ProductOrderController@my_order");
Route::get('/buyer/order/success/{id}', "ProductOrderController@success");

//payment
Route::get('/product/order/payment', "PaymentController@index");

// product image for shop owner
Route::get('/owner/product/detail/{id}/image', "owner\OwnerPhotoController@index");
Route::get('/owner/product/photo/delete/{poId}/pid/{pId}', "owner\OwnerPhotoController@delete");
Route::post('/owner/product/photo/save', "owner\OwnerPhotoController@save");

// product color for shop owner
Route::get('/owner/product/detail/{id}/color', "owner\OwnerProductColorController@index");
Route::get('/owner/product-color/photo/delete/{id}', "owner\OwnerProductColorController@delete");
Route::post('/owner/product-color/photo/save', "owner\OwnerProductColorController@save");

// product size for shop owner
Route::get('/owner/product/detail/{id}/size', "owner\OwnerProductSizeController@index");
Route::get('/owner/product-size/delete/{id}', "owner\OwnerProductSizeController@delete");
Route::post('/owner/product-size/save', "owner\OwnerProductSizeController@save");
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
Route::get('/buyer/login', 'buyer\SecurityController@login');

//admin dashboard layout
Route::get('/home', 'HomeController@index')->name('home');

//admin shop owner managment
Route::get('/admin/shop-owner', "admin\AdminShopOwnerController@index");
Route::get('/admin/shop-owner/delete/{id}', "admin\AdminShopOwnerController@delete");
Route::get('/admin/shop-owner/reset-password/{id}', "admin\AdminShopOwnerController@reset_password");
Route::post('/admin/shop-owner/change-password', "admin\AdminShopOwnerController@change_password");
Route::get('/admin/shop-owner/detail/{id}', "admin\AdminShopOwnerController@detail");

//subscription
Route::get('/admin/subscription/', "admin\AdminSubscriptionController@index");
Route::get('/admin/subscription/create', "admin\AdminSubscriptionController@create");
Route::post('/admin/subscription/save', "admin\AdminSubscriptionController@save");
Route::get('/admin/subscription/detail/{id}', "admin\AdminSubscriptionController@detail");
Route::get('/admin/subscription/edit/{id}', "admin\AdminSubscriptionController@edit");
Route::post('/admin/subscription/update', "admin\AdminSubscriptionController@update");
Route::get('/admin/subscription/delete/{id}', "admin\AdminSubscriptionController@delete");

//shops for admin
Route::get('/admin/shops/', "admin\AdminShopController@index");
Route::get('/admin/shops/detail/{id}', "admin\AdminShopController@detail");
Route::get('/admin/shops/disable/{id}', "admin\AdminShopController@disable");
Route::get('/admin/shops/approve/{id}', "admin\AdminShopController@approve");

//shop subscription
Route::get('/admin/shop-subscription/', "admin\AdminShopSubscriptionController@index");
Route::get('/admin/shop-subscription/detail/{id}', "admin\AdminShopSubscriptionController@detail");
Route::post('/admin/shop-subscription/update', "admin\AdminShopSubscriptionController@update");
Route::get('/admin/shop-subscription/delete/{id}', "admin\AdminShopSubscriptionController@delete");
Route::get('/admin/shop-subscription/approve/{id}', "admin\AdminShopSubscriptionController@approve_subscription");

// management layout
Route::get('/admin/product-management', "admin\ManagementController@product");
Route::get('/admin/customer-management', "admin\ManagementController@customer");
Route::get('/admin/career-management', "admin\ManagementController@career");
Route::get('/admin/tracking-management', "admin\ManagementController@tracking");

// product category
Route::get('admin/product-category', "admin\ProductCategoryController@index");
Route::get('admin/product-category/edit/{id}', "admin\ProductCategoryController@edit");
Route::post('admin/product-category/update', "admin\ProductCategoryController@update");
Route::get('admin/product-category/create', "admin\ProductCategoryController@create");
Route::post('admin/product-category/save', "admin\ProductCategoryController@save");
Route::get('admin/product-category/delete/{id}', "admin\ProductCategoryController@destroy");

// user route
Route::get('/user', "admin\UserController@index");
Route::get('/user/profile', "admin\UserController@load_profile");
Route::get('/user/reset-password', "admin\UserController@reset_password");
Route::post('/user/change-password', "admin\UserController@change_password");
Route::get('/user/finish', "admin\UserController@finish_page");
Route::post('/user/update-profile', "admin\UserController@update_profile");
Route::get('/user/delete/{id}', "admin\UserController@delete");
Route::get('/user/create', "admin\UserController@create");
Route::post('/user/save', "admin\UserController@save");
Route::get('/user/edit/{id}', "admin\UserController@edit");
Route::post('/user/update', "admin\UserController@update");
Route::get('/user/update-password/{id}', "admin\UserController@load_password");
Route::post('/user/save-password', "admin\UserController@update_password");

// scholarship
Route::get("/admin/scholarship", "admin\ScholarshipController@index");
Route::get("/admin/scholarship/create", "admin\ScholarshipController@create");
Route::get("/admin/scholarship/edit/{id}", "admin\ScholarshipController@edit");
Route::get("/admin/scholarship/detail/{id}", "admin\ScholarshipController@show");
Route::get("/admin/scholarship/delete/{id}", "admin\ScholarshipController@destroy");
Route::post("/admin/scholarship/save", "admin\ScholarshipController@store");
Route::post("/admin/scholarship/update", "admin\ScholarshipController@update");

// main menu
Route::get("/admin/main-menu", "admin\MainMenuController@index");
Route::get("/admin/main-menu/create", "admin\MainMenuController@create");
Route::get("/admin/main-menu/edit/{id}", "admin\MainMenuController@edit");
Route::get("/admin/main-menu/delete/{id}", "admin\MainMenuController@destroy");
Route::post("/admin/main-menu/save", "admin\MainMenuController@save");
Route::post("/admin/main-menu/update", "admin\MainMenuController@update");

// shop category
Route::get("/admin/shop-category", "admin\ShopCategoryController@index");
Route::get("/admin/shop-category/create", "admin\ShopCategoryController@create");
Route::get("/admin/shop-category/edit/{id}", "admin\ShopCategoryController@edit");
Route::get("/admin/shop-category/delete/{id}", "admin\ShopCategoryController@destroy");
Route::post("/admin/shop-category/save", "admin\ShopCategoryController@save");
Route::post("/admin/shop-category/update", "admin\ShopCategoryController@update");

// tracking
Route::get('/admin/tracking', "admin\TrackingController@index");
Route::get('/admin/tracking/create', "admin\TrackingController@create");
Route::get('/admin/tracking/edit/{id}', "admin\TrackingController@edit");
Route::get('/admin/tracking/delete/{id}', "admin\TrackingController@delete");
Route::post('/admin/tracking/save', "admin\TrackingController@save");
Route::post('/admin/tracking/update', "admin\TrackingController@update");
Route::get('/admin/tracking/detail/{id}', "admin\TrackingController@view");
Route::get('/admin/sub-tracking/delete/{id}', "admin\TrackingController@sub_tracking_delete");
Route::post('/admin/sub-tracking/save', "admin\TrackingController@sub_tracking_save");

// slide show
Route::get('/admin/slide', "admin\SlideController@index");
Route::get('/admin/slide/create', "admin\SlideController@create");
Route::post('/admin/slide/save', "admin\SlideController@save");
Route::get('/admin/slide/edit/{id}', "admin\SlideController@edit");
Route::post('/admin/slide/update', "admin\SlideController@update");
Route::get('/admin/slide/delete/{id}', "admin\SlideController@delete");

// origin
Route::get('/admin/tracking-origin', "admin\TrackingOriginController@index");
Route::get('/admin/tracking-origin/create', "admin\TrackingOriginController@create");
Route::post('/admin/tracking-origin/save', "admin\TrackingOriginController@save");
Route::get('/admin/tracking-origin/edit/{id}', "admin\TrackingOriginController@edit");
Route::post('/admin/tracking-origin/update', "admin\TrackingOriginController@update");
Route::get('/admin/tracking-origin/delete/{id}', "admin\TrackingOriginController@delete");

// location
Route::get('/admin/tracking-location', "admin\TrackingLocationController@index");
Route::get('/admin/tracking-location/create', "admin\TrackingLocationController@create");
Route::post('/admin/tracking-location/save', "admin\TrackingLocationController@save");
Route::get('/admin/tracking-location/edit/{id}', "admin\TrackingLocationController@edit");
Route::post('/admin/tracking-location/update', "admin\TrackingLocationController@update");
Route::get('/admin/tracking-location/delete/{id}', "admin\TrackingLocationController@delete");

// destination
Route::get('/admin/tracking-destination', "admin\TrackingDestinationController@index");
Route::get('/admin/tracking-destination/create', "admin\TrackingDestinationController@create");
Route::post('/admin/tracking-destination/save', "admin\TrackingDestinationController@save");
Route::get('/admin/tracking-destination/edit/{id}', "admin\TrackingDestinationController@edit");
Route::post('/admin/tracking-destination/update', "admin\TrackingDestinationController@update");
Route::get('/admin/tracking-destination/delete/{id}', "admin\TrackingDestinationController@delete");

// destination
Route::get('/admin/tracking-status', "admin\TrackingStatusController@index");
Route::get('/admin/tracking-status/create', "admin\TrackingStatusController@create");
Route::post('/admin/tracking-status/save', "admin\TrackingStatusController@save");
Route::get('/admin/tracking-status/edit/{id}', "admin\TrackingStatusController@edit");
Route::post('/admin/tracking-status/update', "admin\TrackingStatusController@update");
Route::get('/admin/tracking-status/delete/{id}', "admin\TrackingStatusController@delete");

// payment type
Route::get('/admin/payment-type', "admin\PaymentTypeController@index");
Route::get('/admin/payment-type/create', "admin\PaymentTypeController@create");
Route::post('/admin/payment-type/save', "admin\PaymentTypeController@save");
Route::get('/admin/payment-type/edit/{id}', "admin\PaymentTypeController@edit");
Route::post('/admin/payment-type/update', "admin\PaymentTypeController@update");
Route::get('/admin/payment-type/delete/{id}', "admin\PaymentTypeController@delete");

// contact info
Route::get('/admin/contact-info', "admin\ContactInfoController@index");
Route::get('/admin/contact-info/create', "admin\ContactInfoController@create");
Route::post('/admin/contact-info/save', "admin\ContactInfoController@save");
Route::get('/admin/contact-info/edit/{id}', "admin\ContactInfoController@edit");
Route::post('/admin/contact-info/update', "admin\ContactInfoController@update");
Route::get('/admin/contact-info/delete/{id}', "admin\ContactInfoController@delete");

// phone support
Route::get('/admin/phone-support', "admin\PhoneSupportController@index");
Route::get('/admin/phone-support/edit/{id}', "admin\PhoneSupportController@edit");
Route::post('/admin/phone-support/update', "admin\PhoneSupportController@update");

// social
Route::get('/admin/social', "admin\SocialController@index");
Route::get('/admin/social/create', "admin\SocialController@create");
Route::post('/admin/social/save', "admin\SocialController@save");
Route::get('/admin/social/edit/{id}', "admin\SocialController@edit");
Route::post('/admin/social/update', "admin\SocialController@update");
Route::get('/admin/social/delete/{id}', "admin\SocialController@delete");


// product brand
Route::get('/admin/brand', "admin\BrandController@index");
Route::get('/admin/brand/create', "admin\BrandController@create");
Route::post('/admin/brand/save', "admin\BrandController@save");
Route::get('/admin/brand/edit/{id}', "admin\BrandController@edit");
Route::post('/admin/brand/update', "admin\BrandController@update");
Route::post('/admin/brand/top', "admin\BrandController@top");
Route::post('/admin/brand/down', "admin\BrandController@down");
Route::get('/admin/brand/delete/{id}', "admin\BrandController@delete");

// page
Route::get('/admin/page', "admin\PageController@index");
Route::get('/admin/page/create', "admin\PageController@create");
Route::post('/admin/page/save', "admin\PageController@save");
Route::get('/admin/page/edit/{id}', "admin\PageController@edit");
Route::get('/admin/page/detail/{id}', "admin\PageController@detail");
Route::post('/admin/page/update', "admin\PageController@update");
Route::get('/admin/page/delete/{id}', "admin\PageController@delete");

// role
Route::get("/role", "admin\RoleController@index");
Route::get("/role/create", "admin\RoleController@create");
Route::get("/role/edit/{id}", "admin\RoleController@edit");
Route::get("/role/delete/{id}", "admin\RoleController@delete");
Route::post("/role/save", "admin\RoleController@save");
Route::post("/role/update", "admin\RoleController@update");
Route::get('/role/permission/{id}', "admin\PermissionController@index");
Route::post('/rolepermission/save', "admin\PermissionController@save");
Route::auth();

// settings
Route::get('/admin/setting', "admin\SettingController@index");

// mgmt
Route::get("/management" ,"admin\ManagementController@index");

// product in admin
Route::get('/admin/product', "admin\ProductController@index")->name('/admin/product');
Route::get('/admin/product/detail/{id}', "admin\ProductController@detail");
Route::get('/admin/product/create', "admin\ProductController@create");
Route::get('/admin/product/edit/{id}', "admin\ProductController@edit");
Route::get('/admin/product/delete/{id}', "admin\ProductController@delete");
Route::post('/admin/product/save', "admin\ProductController@save");
Route::post('/admin/product/update', "admin\ProductController@update");

// product image
Route::get('/admin/product/detail/{id}/image', "admin\PhotoController@index");
Route::get('/admin/product/photo/delete/{id}', "admin\PhotoController@delete");
Route::post('/admin/product/photo/save', "admin\PhotoController@save");

// product color
Route::get('/admin/product/detail/{id}/color', "admin\ProductColorController@index");
Route::get('/admin/product-color/photo/delete/{id}', "admin\ProductColorController@delete");
Route::post('/admin/product-color/photo/save', "admin\ProductColorController@save");


Route::get('/admin/product/best-seller/{id}', "admin\ProductController@best_seller");
Route::get('/admin/product/best-seller/return/{id}', "admin\ProductController@best_seller_return");
Route::get('/admin/product/best-deal/{id}', "admin\ProductController@best_deal");
Route::get('/admin/product/best-deal/return/{id}', "admin\ProductController@best_deal_return");
Route::get('/language/{id}', "LangController@index");

// buyer
Route::get('/admin/buyer', "admin\BuyerController@index");
Route::get('/admin/buyer/delete/{id}', "admin\BuyerController@delete");
Route::get('/admin/buyer/reset-password/{id}', "admin\BuyerController@reset_password");
Route::post('/admin/buyer/change-password', "admin\BuyerController@change_password");
Route::get('/admin/buyer/detail/{id}', "admin\BuyerController@detail");
Route::get('/admin/buyer/edit/{id}', "admin\BuyerController@edit");
Route::post('/admin/buyer/update/', "admin\BuyerController@update");

//Rate
Route::get('/admin/rating', "admin\RateController@index");
Route::get('/admin/rating/delete/{id}', "admin\RateController@delete");
Route::get('/admin/rating/approve/{id}', "admin\RateController@approve");
Route::get('/admin/rating/disable/{id}', "admin\RateController@approve");
Route::get('/admin/rate', "admin\ReviewProductController@save");

//Sub page
Route::get('/admin/sub-page', "admin\SubPageController@index");
Route::get('/admin/sub-page/create', "admin\SubPageController@create");
Route::post('/admin/sub-page/save', "admin\SubPageController@save");
Route::get('/admin/sub-page/edit/{id}', "admin\SubPageController@edit");
Route::get('/admin/sub-page/detail/{id}', "admin\SubPageController@detail");
Route::post('/admin/sub-page/update', "admin\SubPageController@update");
Route::get('/admin/sub-page/delete/{id}', "admin\SubPageController@delete");

//career category
Route::get('/admin/career-category', "admin\CareerCategoryController@index");
Route::get('/admin/career-category/create', "admin\CareerCategoryController@create");
Route::post('/admin/career-category/save', "admin\CareerCategoryController@save");
Route::get('/admin/career-category/edit/{id}', "admin\CareerCategoryController@edit");
Route::post('/admin/career-category/update', "admin\CareerCategoryController@update");
Route::get('/admin/career-category/delete/{id}', "admin\CareerCategoryController@delete");

//department cateogry
Route::get('/admin/department-category', "admin\DepartmentCategoryController@index");
Route::get('/admin/department-category/create', "admin\DepartmentCategoryController@create");
Route::post('/admin/department-category/save', "admin\DepartmentCategoryController@save");
Route::get('/admin/department-category/edit/{id}', "admin\DepartmentCategoryController@edit");
Route::post('/admin/department-category/update', "admin\DepartmentCategoryController@update");
Route::get('/admin/department-category/delete/{id}', "admin\DepartmentCategoryController@delete");

//career location
Route::get('/admin/career-location', "admin\CareerLocationController@index");
Route::get('/admin/career-location/create', "admin\CareerLocationController@create");
Route::post('/admin/career-location/save', "admin\CareerLocationController@save");
Route::get('/admin/career-location/edit/{id}', "admin\CareerLocationController@edit");
Route::post('/admin/career-location/update', "admin\CareerLocationController@update");
Route::get('/admin/career-location/delete/{id}', "admin\CareerLocationController@delete");

////career 
Route::get('/admin/career', "admin\CareerController@index");
Route::get('/admin/career/create', "admin\CareerController@create");
Route::post('/admin/career/save', "admin\CareerController@save");
Route::get('/admin/career/edit/{id}', "admin\CareerController@edit");
Route::get('/admin/career/detail/{id}', "admin\CareerController@detail");
Route::post('/admin/career/update', "admin\CareerController@update");
Route::get('/admin/career/delete/{id}', "admin\CareerController@delete");
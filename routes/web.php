<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/cron-price', 'FrontendController@cronPrice');

//Payment IPN

Route::get('/ipnbtc', 'PaymentController@ipnBchain')->name('ipn.bchain');
Route::get('/ipnblockbtc', 'PaymentController@blockIpnBtc')->name('ipn.block.btc');
Route::get('/ipnblocklite', 'PaymentController@blockIpnLite')->name('ipn.block.lite');
Route::get('/ipnblockdog', 'PaymentController@blockIpnDog')->name('ipn.block.dog');
Route::post('/ipnpaypal', 'PaymentController@ipnpaypal')->name('ipn.paypal');
Route::post('/ipnperfect', 'PaymentController@ipnperfect')->name('ipn.perfect');
Route::post('/ipnstripe', 'PaymentController@ipnstripe')->name('ipn.stripe');
Route::post('/ipnskrill', 'PaymentController@skrillIPN')->name('ipn.skrill');
Route::post('/ipncoinpaybtc', 'PaymentController@ipnCoinPayBtc')->name('ipn.coinPay.btc');
Route::post('/ipncoinpayeth', 'PaymentController@ipnCoinPayEth')->name('ipn.coinPay.eth');
Route::post('/ipncoinpaybch', 'PaymentController@ipnCoinPayBch')->name('ipn.coinPay.bch');
Route::post('/ipncoinpaydash', 'PaymentController@ipnCoinPayDash')->name('ipn.coinPay.dash');
Route::post('/ipncoinpaydoge', 'PaymentController@ipnCoinPayDoge')->name('ipn.coinPay.doge');
Route::post('/ipncoinpayltc', 'PaymentController@ipnCoinPayLtc')->name('ipn.coinPay.ltc');
Route::post('/ipncoin', 'PaymentController@ipnCoin')->name('ipn.coinpay');
Route::post('/ipncoingate', 'PaymentController@ipnCoinGate')->name('ipn.coingate');


Route::post('/ipnpaytm', 'PaymentController@ipnPayTm')->name('ipn.paytm');
Route::post('/ipnpayeer', 'PaymentController@ipnPayEer')->name('ipn.payeer');
Route::post('/ipnpaystack', 'PaymentController@ipnPayStack')->name('ipn.paystack');
Route::post('/ipnvoguepay', 'PaymentController@ipnVoguePay')->name('ipn.voguepay');
//Payment IPN


Route::get('/home', 'FrontendController@index2')->name('main2');

Route::get('/', 'FrontendController@index')->name('main');
Route::get('/rates', 'FrontendController@rate')->name('rates');
Route::get('/privacy', 'FrontendController@privacy')->name('privacy');
Route::get('/blog', 'FrontendController@blog')->name('blog');
Route::get('/blog/{id}', 'FrontendController@blogview')->name('blogview');
Route::get('/maintain', 'FrontendController@maintain')->name('maintain');
Route::post('/contactSubmit', 'FrontendController@contactSubmit')->name('contact.submit');



Route::get('/blogs', 'FrontendController@blog')->name('blog');
Route::get('/details/{id}/{slud}', 'FrontendController@details')->name('blog.details');
Route::get('/category/{id}/{slug}', 'FrontendController@categoryByBlog')->name('cats.blog');
Route::get('/about-us', 'FrontendController@about')->name('about');
Route::get('/service/{id}/{slug}', 'FrontendController@service')->name('serve');

Route::get('/faqs', 'FrontendController@faqs')->name('faqs');
Route::get('/terms-condition', 'FrontendController@termsCondition')->name('terms-condition');
Route::get('/privacy-policy', 'FrontendController@privacyPolicy')->name('privacy-policy');
Route::get('/menu/{id}/{slug}', 'FrontendController@menu')->name('menu');
Route::post('/subscribe', 'FrontendController@subscribe')->name('subscribe');
Route::get('/contact-us', 'FrontendController@contactUs')->name('contact-us');
Route::post('/contact-us', 'FrontendController@contactSubmit')->name('contact-us');

Auth::routes();

Route::group(['middleware' => ['guest']], function () {
    Route::get('/register/{reference}', 'FrontendController@register')->name('refer.register');
});


Route::group(['prefix' => 'user'], function () {

    Route::get('authorization', 'HomeController@authCheck')->name('user.authorization');
    Route::post('verification', 'HomeController@sendVcode')->name('user.send-vcode');
    Route::post('smsVerify', 'HomeController@smsVerify')->name('user.sms-verify');
    Route::post('verify-email', 'HomeController@sendEmailVcode')->name('user.send-emailVcode');
    Route::post('postEmailVerify', 'HomeController@postEmailVerify')->name('user.email-verify');
    Route::post('veribank', 'HomeController@veribank')->name('veri.bank');
    Route::get('validate/{id}', 'HomeController@validatebank')->name('bank.vvalidate');

    Route::group(['middleware' => ['auth', 'CheckStatus']], function () {
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/user-faq', 'HomeController@faqs')->name('user.faq');
        Route::get('user/daily/rewards', 'HomeController@daily')->name('userDailyBonus');



        //user Deposit
        Route::get('/make-deposit', 'HomeController@create_deposit')->name('make_deposit');
        Route::post('/make-deposit', 'HomeController@create_deposit')->name('make_deposit_now');
        Route::get('/preview-deposit', 'HomeController@deposit_preview')->name('deposit_preview');
        Route::get('/cancel-deposit/{id}', 'HomeController@cancel_deposit')->name('cancel-deposit');
        Route::get('/confirm-deposit/{id}', 'HomeController@confirm_deposit')->name('confirm_deposit');
        Route::post('/confirm-deposit', 'HomeController@confirm_deposit_save')->name('confirm_deposit_save');
        Route::post('/rave-deposit', 'HomeController@rave_save')->name('rave_save');
        // Route::post('/paystack-deposit', 'HomeController@paystack_save')->name('paystack_save');
        Route::get('/deposit', 'HomeController@depositLog')->name('deposit');
        Route::post('/deposit', 'HomeController@deposit')->name('deposit');
        Route::post('/deposit-data-insert', 'HomeController@depositDataInsert')->name('deposit.data-insert');
        Route::get('/deposit-preview', 'HomeController@depositPreview')->name('user.deposit.preview');
        Route::post('/deposit-confirm', 'PaymentController@depositConfirm')->name('deposit.confirm');

        //Buy
        Route::get('/buy-coin', 'HomeController@buycoin')->name('buy');
        Route::get('/buy-confirm', 'HomeController@confirm_buy')->name('confirm_buy');
        Route::post('/buy-confirm', 'HomeController@confirm_buy')->name('confirm_buy');
        Route::get('/confirm-buy/{id}', 'HomeController@confirm_buy_first')->name('confirm_buy_first');
        Route::post('/buy-wallet', 'HomeController@buywallet')->name('buy.wallet');
        Route::post('/buy-online', 'HomeController@buyonline')->name('buy.online');
        Route::get('/buy-online', 'HomeController@buyonlinePreview')->name('user.onlinebuy');
        Route::post('/pay-paystack', 'PaymentController@buypaystack')->name('buy.paystack');
        Route::post('/pay-rave', 'PaymentController@buyrave')->name('buy.rave');
        Route::post('/pay-bank', 'PaymentController@buybank')->name('buy.bank');
        Route::post('/buystripe', 'PaymentController@buystripe')->name('buy.stripe');

        //Sell
        Route::get('/sell-coin', 'HomeController@sellcoin')->name('sell');
        Route::get('/sell-confirm/{id}', 'HomeController@sell_form')->name('sell_form');
        Route::post('/sell-confirm', 'HomeController@confirm_sell')->name('confirm_sell');
        Route::get('/sell-save/{id}', 'HomeController@sell_get')->name('sell_get');
        Route::get('/cancel-sell/{id}', 'HomeController@cancel_sell')->name('cancel_sell');
        Route::post('/sell-save', 'HomeController@save_sell')->name('save_sell');
        Route::post('/sell-wallet', 'HomeController@sellwallet')->name('sell.wallet');
        Route::post('/sell-online', 'HomeController@sellonline')->name('sell.online');

        //Withdraw
        Route::get('/withdraw', 'HomeController@withdraw')->name('withdraw_fund');
        Route::post('/withdraw', 'HomeController@withdraw')->name('withdraw_fund');
        Route::get('/withdraw-history', 'HomeController@withdraw_log')->name('withdraw_log');




        Route::post('/crypto/payment/status', 'PaymentControlle@cryptoStatus')->name('userDepositCrypto');

        Route::post('/card-confirm', 'PaymentController@cardpay')->name('cardpay');

        Route::get('/withdraw01', 'HomeController@withdrawMoney')->name('withdraw.money');
        Route::post('/withdraw/crypto', 'HomeController@requestcrypto')->name('withdraw.crypto');
        Route::post('/withdraw/deposit', 'HomeController@requestwithdrawal')->name('withdraw.depo');
        Route::post('/withdraw-submit', 'HomeController@requestSubmit')->name('withdraw.submit');


        Route::get('/wallet', 'HomeController@wallet')->name('wallet');
        Route::post('/wallet', 'HomeController@updatewallet')->name('update.wallet');


        Route::get('/transfer', 'HomeController@transfer')->name('transfer');
        Route::post('/transfer', 'HomeController@updatetransfer')->name('update.transfer');
        Route::get('/convert', 'HomeController@convertbonus')->name('convertbonus');
        Route::post('/convert', 'HomeController@updateconvert')->name('update.convert');
        Route::get('/transfer-log', 'HomeController@transferlog')->name('transferlog');

        Route::get('/transaction-log', 'HomeController@activity')->name('user.trx');
        Route::get('/deposit-log', 'HomeController@depositLog')->name('user.depositLog');
        Route::get('/withdraw-log', 'HomeController@withdrawLog')->name('user.withdrawLog');

        Route::get('change-password', 'HomeController@changePassword')->name('user.change-password');
        Route::post('change-password', 'HomeController@submitPassword')->name('user.change-password');
        Route::get('edit-profile', 'HomeController@Profile')->name('profile');
        Route::post('check_bank', 'HomeController@check_bank')->name('check_bank');
        Route::post('edit-profile', 'HomeController@submitProfile')->name('edit-profile');
        Route::get('activity-log', 'HomeController@activitylog')->name('activities');
        Route::get('referral-log', 'HomeController@referral')->name('referral');
        Route::get('verification', 'HomeController@kyc')->name('verification');
        Route::post('verification2', 'HomeController@kyc2')->name('document.upload');

        //Bank
        Route::get('bank', 'HomeController@bank')->name('bank');
        Route::post('bank', 'HomeController@postbank')->name('post.banky');


        //Message
        Route::get('create_message', 'HomeController@messages')->name('createmessage');
        Route::post('create', 'HomeController@postmessage')->name('post.message');
        Route::get('create_testimonial', 'HomeController@usertest')->name('user.testimonial');
        Route::post('create_testimonial', 'HomeController@posttestimonial')->name('post.testimonial');
        Route::get('inbox', 'HomeController@inbox')->name('inbox');
        Route::get('notifications', 'HomeController@notifications')->name('notifications');
        Route::get('inbox/{id}', 'HomeController@inboxview')->name('inbox-view');
        Route::get('inbox/delete/{id}', 'HomeController@inboxdelete')->name('inbox-delete');





        //Trade
        Route::post('/buy-ecoin', 'HomeController@buyecoin')->name('buyecoin');
        Route::get('/ebuy-online', 'HomeController@ebuyonlinePreview')->name('user.ebuy');
        Route::get('/ebuy-submit/{id}', 'HomeController@ebuyonlinepost')->name('ebuypost');
        Route::get('/ebuy-pay/{id}', 'HomeController@ebuyonlinepay')->name('ebuypost2');
        Route::get('/ebuy-del/{id}', 'HomeController@ebuydel')->name('ebuydel');
        Route::get('/ebuy-pay', 'HomeController@ebuyonlinepost2')->name('ebuypost2');
        Route::post('/ebuy-upload', 'HomeController@ebuyupload')->name('ebuyupload');


        Route::post('/sell-ecoin', 'HomeController@sellecoin')->name('sellecoin');

        Route::get('/esell-online', 'HomeController@esellonlinePreview')->name('user.esell');
        Route::get('/esell-submit/{id}', 'HomeController@esellonlinepost')->name('esellpost');
        Route::get('/esell-pay', 'HomeController@esellonlinepay')->name('esellpost2');
        Route::get('/esell-pay/{id}', 'HomeController@esellscan2')->name('esellpost22');
        Route::get('/esell-scan', 'HomeController@esellscan')->name('esellscan');

        Route::get('/esell-del/{id}', 'HomeController@eselldel')->name('eselldel');
        Route::post('/esell-upload', 'HomeController@esellupload')->name('esellupload');



        //Trade
        Route::post('buy', 'HomeController@buy')->name('buy.amount');
        Route::get('buy/{trx}', 'HomeController@buyPreview')->name('buy.buyPreview');
        Route::post('confirm-buy', 'HomeController@buyConfirm')->name('buy.confirmed');
        Route::post('confirm-buy-slip', 'HomeController@buyConfirmSlip')->name('buy.confirmed.slip');

        Route::post('sell', 'HomeController@sell')->name('sell.amount');
        Route::get('sell/{trx}', 'HomeController@sellPreview')->name('sell.preview');
        Route::post('confirm-sell', 'HomeController@sellConfirm')->name('sell.confirmed');
        Route::post('confirm-sell-bank', 'HomeController@sellConfirmBank')->name('sell.confirmed.bank');

        Route::post('exchange/wallet', 'HomeController@exchangewallet')->name('exchange.wallet');
        Route::post('exchange/online', 'HomeController@exchangeonline')->name('exchange.online');
        Route::get('exchange', 'HomeController@exchange')->name('exchange');

        Route::get('transactions', 'HomeController@transactions')->name('transaction');
    });
});


Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'AdminLoginController@index')->name('admin.loginForm');
    Route::post('/', 'AdminLoginController@authenticate')->name('admin.login');
});


Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {



    Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');


    Route::get('/exchange-log', 'AdminController@exchangeLog')->name('exchange-currency');
    Route::get('/exchange-log/{id}', 'AdminController@exchangeInfo')->name('exchange-info');
    Route::get('/exchange-approve/{id}', 'AdminController@exchangeapprove')->name('exchange.approve');
    Route::get('/exchange-reject/{id}', 'AdminController@exchangereject')->name('exchange.reject');
    Route::post('/exchange-action', 'AdminController@exchangeAction')->name('exchange-action');

    Route::get('/sell-log', 'AdminController@sellLog')->name('sell-currency');
    Route::get('/paid-sell-log', 'AdminController@paidsellLog')->name('paidsell-currency');
    Route::get('/cancelled-sell-log', 'AdminController@cancelledsellLog')->name('cancelledsell-currency');
    Route::get('/pending-sell-log', 'AdminController@pendingsellLog')->name('pendingsell-currency');
    Route::get('/declined-sell-log', 'AdminController@declinedsellLog')->name('declinedsell-currency');
    Route::get('/sell-log/{id}', 'AdminController@sellInfo')->name('sell-info');
    Route::get('/sell-approve/{id}', 'AdminController@sellapprove')->name('sell.approve');
    Route::get('/sell-reject/{id}', 'AdminController@sellreject')->name('sell.reject');

    Route::get('/buy-log', 'AdminController@buyLog')->name('buy-currency');
    Route::post('/buy-send-prove', 'AdminController@buyapprovesendprove')->name('buy-send-prove');
    Route::get('/pending-buy-log', 'AdminController@pendingbuyLog')->name('pendingbuy-currency');
    Route::get('/declined-buy-log', 'AdminController@declinedbuyLog')->name('declinedbuy-currency');
    Route::get('/cancelled-buy-log', 'AdminController@cancelledbuyLog')->name('cancelledbuy-currency');
    Route::get('/buy-log/{id}', 'AdminController@buyInfo')->name('buy-info');
    Route::get('/buy-app/{id}', 'AdminController@buyapprove')->name('buy.approve');
    Route::get('/buy-rej/{id}', 'AdminController@buyreject')->name('buy.reject');

    //Deposit    
    Route::get('/deposit-log', 'AdminController@depositLog')->name('deposit-currency');
    Route::get('/paid-deposit-log', 'AdminController@paiddepositLog')->name('paiddeposit-currency');
    Route::get('/pending-deposit-log', 'AdminController@pendingdepositLog')->name('pendingdeposit-currency');
    Route::get('/declined-deposit-log', 'AdminController@declineddepositLog')->name('declineddeposit-currency');
    Route::get('/deposit-info/{id}', 'AdminController@depositInfo')->name('deposit-info');
    Route::get('/deposit-app/{id}', 'AdminController@depositapprove')->name('deposit_approve_admin');
    Route::get('/deposit-rej/{id}', 'AdminController@depositreject')->name('deposit.reject');

    //Withdraw    
    Route::get('/withdraw-log', 'AdminController@withdrawLog')->name('withdraw-currency');
    Route::get('/paid-withdraw-log', 'AdminController@paidwithdrawLog')->name('paidwithdraw-currency');
    Route::get('/pending-withdraw-log', 'AdminController@pendingwithdrawLog')->name('pendingwithdraw-currency');
    Route::get('/declined-withdraw-log', 'AdminController@declinedwithdrawLog')->name('declinedwithdraw-currency');
    Route::get('/withdraw-info/{id}', 'AdminController@withdrawInfo')->name('withdraw-info');
    Route::get('/withdraw-app/{id}', 'AdminController@withdrawapprove')->name('withdraw_approve_admin');
    Route::get('/withdraw-rej/{id}', 'AdminController@withdrawreject')->name('withdraw_admin_reject');

    // General Settings
    Route::get('/general-settings', 'GeneralSettingController@GenSetting')->name('admin.GenSetting');
    Route::post('/general-settings', 'GeneralSettingController@UpdateGenSetting')->name('admin.UpdateGenSetting');

    //Contact Setting
    Route::get('contact-setting', 'GeneralSettingController@getContact')->name('contact-setting');
    Route::put('contact-setting/{id}', 'GeneralSettingController@putContactSetting')->name('contact-setting-update');


    // Admin Settings
    Route::get('/change-password', 'AdminController@changePassword')->name('admin.changePass');
    Route::post('/change-password', 'AdminController@updatePassword')->name('admin.changePass');
    Route::get('/profile', 'AdminController@profile')->name('admin.profile');
    Route::post('/profile', 'AdminController@updateProfile')->name('admin.profile');

    Route::resource('currency', 'CurrencyController');
    Route::get('/activate-coin/{id}', 'CurrencyController@activate')->name('activatecoin');
    Route::get('/deactivate-coin/{id}', 'CurrencyController@deactivate')->name('deactivatecoin');
    Route::get('/delete-coin/{id}', 'CurrencyController@delete')->name('deletecoin');
    Route::post('/post-coin/', 'CurrencyController@post')->name('postcoin');


    //Gateway
    Route::get('/gateway', 'GatewayController@show')->name('gateway');
    Route::get('/actgateway/{id}', 'GatewayController@act')->name('activate.gateway');
    Route::get('/deactgateway/{id}', 'GatewayController@deact')->name('deactivate.gateway');
    Route::post('/gateway', 'GatewayController@update')->name('update.gateway');

    //Deposit
    // Route::get('/deposits', 'DepositController@index')->name('deposits');
    // Route::get('/deposits/requests', 'DepositController@requests')->name('deposits.requests');
    // Route::get('/deposit/approve/{id}', 'DepositController@approve')->name('deposit.approve');
    // Route::get('/deposit/view/{id}', 'DepositController@view')->name('deposit.view');
    // Route::get('/deposit/{deposit}/delete', 'DepositController@destroy')->name('deposit.destroy');

    //Transfer
    Route::get('/transfer/requests', 'DepositController@transfer')->name('transfer.log');
    Route::get('/transfer/delete/{id}', 'DepositController@transferdelete')->name('transfer.delete');
    Route::get('/transfer/{id}', 'DepositController@transferview')->name('transfer.view');

    //withdraw
    // Route::get('/withdraw', 'WithdrawController@index')->name('withdraw');
    // Route::post('/withdraw', 'WithdrawController@delete')->name('add.withdraw.method');
    // Route::post('/withdraw-update', 'WithdrawController@withdrawUpdateSettings')->name('update.wsettings');

    // Route::get('/withdraw/requests', 'WithdrawController@requests')->name('withdraw.requests');
    // Route::get('/withdraw/approved', 'WithdrawController@requestsApprove')->name('withdraw.approved');
    // Route::get('/withdraw/refunded', 'WithdrawController@requestsRefunded')->name('withdraw.refunded');

    // Route::get('/withdraw/view/{id}', 'WithdrawController@view')->name('withdraw.view');
    // Route::get('/withdraw/approve/{id}', 'WithdrawController@approve')->name('withdraw.approve');
    // Route::get('/withdraw/refund/{id}', 'WithdrawController@refundAmount')->name('withdraw.reject');
    // Route::get('/withdraw/delete/{id}', 'WithdrawController@deleteAmount')->name('withdraw.delete');


    //    Blog Controller
    Route::get('/blog-category', 'PostController@category')->name('admin.cat');
    Route::post('/blog-category', 'PostController@UpdateCategory')->name('update.cat');
    Route::get('blog', 'PostController@index')->name('admin.blog');
    Route::get('blog/create', 'PostController@create')->name('blog.create');
    Route::post('blog/create', 'PostController@store')->name('blog.store');
    Route::delete('blog/delete', 'PostController@destroy')->name('blog.delete');
    Route::get('blog/edit/{id}', 'PostController@edit')->name('blog.edit');
    Route::post('blog-update', 'PostController@updatePost')->name('blog.update');

    /*Manage Faq*/
    Route::get('faqs-create', 'FaqController@createFaqs')->name('faqs-create');
    Route::post('faqs-create', 'FaqController@storeFaqs')->name('faqs-create');
    Route::get('faqs', 'FaqController@allFaqs')->name('faqs-all');
    Route::get('faqs-edit/{id}', 'FaqController@editFaqs')->name('faqs-edit');
    Route::put('faqs-edit/{id}', 'FaqController@updateFaqs')->name('faqs-update');
    Route::get('faqs-delete/{id}', 'FaqController@deleteFaqs')->name('faqs-delete');

    //    SubscriberController
    Route::get('/subscribers', 'SubscriberController@manageSubscribers')->name('manage.subscribers');
    Route::post('/update-subscribers', 'SubscriberController@updateSubscriber')->name('update.subscriber');
    Route::get('/send-email', 'SubscriberController@sendMail')->name('send.mail.subscriber');
    Route::post('/send-email', 'SubscriberController@sendMailsubscriber')->name('send.email.subscriber');

    //    Testimonial Controller
    Route::get('testimonial', 'TestimonialController@index')->name('admin.testimonial');
    Route::get('testimonial/create', 'TestimonialController@create')->name('testimonial.create');
    Route::post('testimonial/create', 'TestimonialController@store')->name('testimonial.store');
    Route::delete('testimonial/delete', 'TestimonialController@destroy')->name('testimonial.delete');
    Route::get('testimonial/edit/{id}', 'TestimonialController@edit')->name('testimonial.edit');
    Route::post('testimonial-update', 'TestimonialController@updatePost')->name('testimonial.update');

    //Notification

    Route::get('notification', 'UserManageController@usernotify')->name('user.notification');
    Route::get('testimonials', 'UserManageController@usertestimonial')->name('admin.testi');
    Route::get('testimonials/{id}', 'UserManageController@usertestimonialdel')->name('admin.testidel');
    Route::post('testimonials/update', 'UserManageController@usertestimonialupdate')->name('update.testi');
    Route::post('testimonials/create', 'UserManageController@usertestimonialcreate')->name('create.testi');
    Route::get('tickets', 'UserManageController@usertickets')->name('user.tickets');
    Route::get('user-ticket/{id}', 'UserManageController@userticketview')->name('ticket.view');
    Route::post('user-reply-ticket', 'UserManageController@userticketreply')->name('ticket.reply');
    Route::post('/sendnotify', 'UserManageController@notifystore')->name('send.notification');


    //User Management
    Route::get('users', 'UserManageController@users')->name('users');
    Route::get('user-search', 'UserManageController@userSearch')->name('search.users');
    Route::get('user/{user}', 'UserManageController@singleUser')->name('user.single');
    Route::put('user/pass-change/{user}', 'UserManageController@userPasschange')->name('user.passchange');
    Route::put('user/status/{user}', 'UserManageController@statupdate')->name('user.status');
    Route::get('mail/{user}', 'UserManageController@userEmail')->name('user.email');
    Route::post('/sendmail', 'UserManageController@sendemail')->name('send.email');
    Route::get('/user-login-history/{id}', 'UserManageController@loginLogsByUsers')->name('user.login.history');
    Route::get('/user-balance/{id}', 'UserManageController@ManageBalanceByUsers')->name('user.balance');
    Route::post('/user-balance', 'UserManageController@saveBalanceByUsers')->name('user.balance.update');
    Route::post('/user-walletbalance', 'UserManageController@savecoinwalletBalanceByUsers')->name('user.coinbalance.update');
    Route::get('/user-banned', 'UserManageController@banusers')->name('user.ban');
    Route::get('login-logs/{user?}', 'UserManageController@loginLogs')->name('user.login-logs');
    Route::get('/user-transaction/{id}', 'UserManageController@userTrans')->name('user.trans');
    Route::get('/user-deposit/{id}', 'UserManageController@userDeposit')->name('user.deposit');
    Route::get('/user-block/{id}', 'UserManageController@block')->name('user.block');
    Route::get('/user-activate/{id}', 'UserManageController@activate')->name('user.activate');
    Route::get('/user-delete/{id}', 'UserManageController@delete')->name('user.delete');
    Route::get('/user-withdraw/{id}', 'UserManageController@userWithdraw')->name('user.withdraw');
    Route::get('/user-kyc', 'UserManageController@userkyc')->name('admin.kyc');
    Route::get('/view-kyc/{id}', 'UserManageController@viewkyc')->name('kycview');
    Route::get('/del-kyc/{id}', 'UserManageController@delkyc')->name('kycdelete');
    Route::get('/reject-kyc/{id}', 'UserManageController@rejectkyc')->name('kycreject');
    Route::get('/approve-kyc/{id}', 'UserManageController@approvekyc')->name('kycapprove');

    //Email & SMS Template
    Route::get('/sms-email', 'EtemplateController@index')->name('email.template');
    Route::post('/template-update', 'EtemplateController@update')->name('template.update');
    //Sms Api
    Route::get('/sms-api', 'EtemplateController@smsApi')->name('sms.api');
    Route::post('/sms-update', 'EtemplateController@smsUpdate')->name('sms.update');


    /*Menu Control*/
    Route::get('menu-create', 'WebSettingController@createMenu')->name('menu-create');
    Route::post('menu-create', 'WebSettingController@storeMenu')->name('menu-create');
    Route::get('menu-control', 'WebSettingController@manageMenu')->name('menu-control');
    Route::get('menu-edit/{id}', 'WebSettingController@editMenu')->name('menu-edit');
    Route::post('menu-update/{id}', 'WebSettingController@updateMenu')->name('menu-update');
    Route::delete('menu-delete', 'WebSettingController@deleteMenu')->name('menu-delete');

    /*Social Icon Control*/
    Route::get('manage-social', 'WebSettingController@manageSocial')->name('manage-social');
    Route::post('manage-social', 'WebSettingController@storeSocial')->name('manage-social');
    Route::get('manage-social/{product_id?}', 'WebSettingController@editSocial')->name('social-edit');
    Route::put('manage-social/{product_id?}', 'WebSettingController@updateSocial')->name('social-edit');
    Route::post('delete-social', 'WebSettingController@destroySocial')->name('del.social');

    /*Service Control*/
    Route::resource('service', 'ServiceController');

    /*Bank Control*/
    Route::get('system-banks', 'BankController@index')->name('admin.bank');
    Route::get('delete-banks/{id}', 'BankController@delete')->name('admin.bank.delete');
    Route::post('post-bank', 'BankController@update')->name('post.bank');
    Route::post('create-bank', 'BankController@create')->name('create.bank');

    // Web Settings
    Route::get('manage-logo', 'WebSettingController@manageLogo')->name('manage-logo');
    Route::post('manage-logo', 'WebSettingController@updateLogo')->name('manage-logo');

    Route::get('manage-text', 'WebSettingController@manageFooter')->name('manage-footer');
    Route::put('manage-text', 'WebSettingController@updateFooter')->name('manage-footer-update');

    Route::get('manage-breadcrumb', 'WebSettingController@manageBreadcrumb')->name('manage-breadcrumb');
    Route::post('manage-breadcrumb', 'WebSettingController@updateBreadcrumb')->name('manage-breadcrumb');


    Route::get('terms', 'WebSettingController@terms')->name('terms');
    Route::get('tserms', 'WebSettingController@terms')->name('banks.index');
    Route::get('privacy', 'WebSettingController@privacy')->name('privacy');
    Route::post('terms', 'WebSettingController@updateTerms')->name('update.terms');


    Route::get('/about', 'WebSettingController@getAbout')->name('admin.about');
    Route::post('/about', 'WebSettingController@updateAbout')->name('admin.about');
    Route::get('/header', 'WebSettingController@getheader')->name('admin.header');
    Route::post('/header', 'WebSettingController@updateheader')->name('admin.header');
    Route::get('/vmg', 'WebSettingController@getvmg')->name('admin.vmg');
    Route::post('/vmg', 'WebSettingController@updatevmg')->name('admin.vmg');
    Route::get('/policy', 'WebSettingController@getpolicy')->name('admin.privacy');
    Route::post('/policy', 'WebSettingController@updatepolicy')->name('admin.privacy');
    Route::get('/how', 'WebSettingController@gethow')->name('admin.hows');
    Route::post('/how', 'WebSettingController@updatehow')->name('admin.how');
    Route::post('/testimonial-text', 'WebSettingController@testimonialText')->name('testimonial.text');




    Route::get('/logout', 'AdminController@logout')->name('admin.logout');
});


/*============== User Password Reset Route list ===========================*/
Route::get('user-password/reset', 'User\ForgotPasswordController@showLinkRequestForm')->name('user.password.request');
Route::post('user-password/email', 'User\ForgotPasswordController@sendResetLinkEmail')->name('user.password.email');
Route::get('user-password/reset/{token}', 'User\ResetPasswordController@showResetForm')->name('user.password.reset');
Route::post('user-password/reset', 'User\ResetPasswordController@reset');

<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content=""><!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{asset('assets/images/logo/favicon.png')}}"><!-- Site Title  -->
    <title>{{isset($page_title) ? $page_title : ''}} | {{$basic->sitename}}</title><!-- Bundle and Base CSS -->
    <link rel="stylesheet" href="{{asset('front-assets/css/vendor.bundle-11966.css')}}">
    <link rel="stylesheet" href="{{asset('front-assets/css/style-salvia-11966.css')}}" id="changeTheme">
    <link href="{{asset('assets/admin/css/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/toastr.min.css')}}" rel="stylesheet" />

    <link href="{{asset('front-assets/css/jquery.growl.css')}}" rel="stylesheet" />

    <!-- Extra CSS -->
    <link rel="stylesheet" href="{{asset('front-assets/css/theme-11966.css')}}">
    <script>
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o), m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-91615293-2', 'auto');
        ga('send', 'pageview');
    </script>
</head>
<!-- Banner @s -->
<div class="header-banner bg-theme-grad-s2">

    <body class="nk-body body-wider theme-dark">
        <div class="nk-wrap">
            <main class="nk-pages nk-pages-centered bg-theme">
                <div class="ath-container">
                    <div class="ath-header text-center"><a href="{{url('/')}}" class="ath-logo"><img src="{{asset('assets/images/logo/logo.png')}}" width="100" width="150" srcset="{{asset('assets/images/logo/logo.png')}}" alt="logo"></a></div>
                    <div class="ath-body">
                        <h5 class="ath-heading title">Sign in <small class="tc-default">Administrative Login</small></h5>


                        <div id="error"></div>
                        <style>
                            #error {
                                color: red;
                            }

                            .error {
                                color: red;
                            }

                            .abir {
                                display: fixed;
                                z-index: 299;
                                position: absolute;
                                /*width: 85%;*/
                                color: #FFF;
                                background-color: #26a1ab;
                                border-color: #26a1ab;
                            }

                            .slow-spin {
                                -webkit-animation: fa-spin 2s infinite linear;
                                animation: fa-spin 2s infinite linear;
                            }
                        </style>
                        <form class="login-form" id="login-form" action="" method="post">
                            {{ csrf_field() }}
                            <div class="field-item">
                                <div class="field-wrap">
                                    <input name="username" type="text" class="input-bordered" placeholder="Admin Username" value="">
                                </div>
                            </div>
                            <div class="field-item">
                                <div class="field-wrap">
                                    <input name="password" type="password" class="input-bordered" placeholder="Password" value="">
                                </div>
                            </div>
                            <div class="form-group btn-container" id="working">
                                <button type="submit" class="btn btn-primary btn-block btn-md">Sign In</button>
                            </div>

                        </form>
                    </div>
            </main>
        </div>
        <div class="preloader"><span class="spinner spinner-round"></span></div><!-- JavaScript -->
        <script src="{{asset('front-assets/js/jquery.bundle.js?ver=192')}}"></script>
        <script src="{{asset('front-assets/js/scripts.js?ver=192')}}"></script>
        <script src="{{asset('front-assets/js/charts.js')}}"></script>

        <script src="{{asset('front-assets/js/pace.min.js')}}"></script>

        <script>
            $('document').ready(function() {
                /* validation */
                $("#login-form").validate({
                    rules: {
                        password: {
                            required: true,
                        },
                        username: {
                            required: true,
                        },
                    },
                    messages: {
                        password: "<span style='color: red'>Password is required.</span>",
                        username: "<span style='color: red'>Username is required.</span>",
                    },
                    submitHandler: submitForm
                });
                /* validation */

                /* login submit */
                function submitForm() {
                    var data = $("#login-form").serialize();

                    $.ajax({

                        type: 'POST',
                        url: "{{route('admin.login')}}",
                        data: data,
                        beforeSend: function() {
                            $("#error").fadeOut();
                            $("#working").html('<button class="btn btn-primary btn-block btn-md" >  <i class = "fa fa-spinner slow-spin"></i>&nbsp; &nbsp;  Sign In</button>');
                        },
                        success: function(response) {
                            if (response == "ok") {


                                setTimeout(' window.location.href = "{{route("admin.dashboard")}}"; ', 1);
                            } else {
                                $("#error").fadeIn(1000, function() {
                                    $("#error").html('<div class="alert alert-dismissible alert-danger"><button class="close" type="button" data-dismiss="alert">×</button>' + response + '</div>');
                                    $("#working").html('<button class="btn btn-primary btn-block btn-md" id="working"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>');
                                });
                            }
                        },
                        error: function(response) {
                            $("#error").fadeIn(1000, function() {
                                $("#error").html('<div class="alert alert-dismissible alert-danger"><button class="close" type="button" data-dismiss="alert">×</button>' + response + '</div>');
                                $("#working").html('');
                            });
                        }
                    });
                    return false;
                }
                /* login submit */
            });
        </script>


    </body>

</html>
<!-- Localized -->
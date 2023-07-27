<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" />
    <link href="/template/css/style.css" rel="stylesheet">
</head>
<body>
    {{-- sweetalert --}}
    <section class="vh-100 bg-image" style="background-image: url('/assets/img/ebooking.Jpng');">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-center mb-5">Lupa Password ?</h2>
                                <p class="text-center mb-4">Silahkan masukkan email Anda dan kami akan mengirim tautan untuk mengganti password</p>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    </div>
                                @endif
                                @if (session()->has('status'))
                                    <div class="alert alert-success">
                                        {{ session()->get('status') }}
                                    </div>
                                @endif
                                <form action="{{ route('password.email') }}" class="login-input" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Email" required/>
                                    </div>
                                    <button type="submit" class="btn text-white login-form__btn submit w-100">Submit</button>
                                    <p class="text-center text-muted mt-5 mb-0"><a href="/login">Back to Login</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    {{-- js show password --}}
    <script>
        // Select Elements, i.e Input Password & Checkbox
        let passwordInput = document.querySelector('#password');
        let showPasswordCheckbox = document.querySelector('#showPasswordCheckbox');
        // Add Event Listener to the Show/Hide Checkbox.
        showPasswordCheckbox.addEventListener('change', function() {
            //Check if User has checked the checkbox.
            if (this.checked) {
                //Change input type to text i.e Unmask Password
                passwordInput.type = 'text';
            } else {
                //Change input type back to password.
                passwordInput.type = 'password';
            }
        });
    </script>

    {{-- JQuery --}}
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    {{-- Popper --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    {{-- Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>
    <script>
        jQuery.datetimepicker.setLocale('en');
    </script>
    <script>
        $(function() {
            datetimepicker({
                format: 'L'
            });
        });
        $(function() {
            $('#datetimepicker2').datetimepicker({
                format: 'L'
            });
        });
    </script>
</body>

</html>

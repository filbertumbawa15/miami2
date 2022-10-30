<!DOCTYPE html>
<html lang="en">

<head>

  <style>
    body {
      background-color: #000000 !important;
    }

    .slogan {
      text-transform: uppercase;
      color: #c6a23f;
      letter-spacing: 0.5px;
      font-size: 30px;
      line-height: 18px;
      font-family: 'Times New Roman';
      font-weight: bold;
      margin-top: -20px;
      margin-bottom: 15px;
    }

    .login-icon {
      width: 200px;
      background-size: contain;
      background-repeat: no-repeat;
    }
  </style>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login | {{ config('app.name') }}</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-12 col-md-12 col-lg-6">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4"><img src="{{asset('guest/images/logo.png')}}" class="login-icon"></h1>
                    <div class="slogan">MIAMI CASINO 4D</div>
                  </div>
                  <form id="loginForm" method="POST">
                    @csrf
                    <div class="form-group row">
                      <div class="col-12">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control">
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-12">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary" style="background-color:#c6a23f;border-color:#c6a23f;">Login</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Sweetalert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
  <script src="{{ asset('script.js') }}"></script>

  <!-- Custom scripts for current page -->
  <script>
    $(document).ready(function() {
      const apiUrl = `http://localhost/miami/public/api`

      $('#loginForm').submit(function(event) {
        event.preventDefault()

        let form = $(this)

        clearErrorMessages(form)

        $.ajax({
          url: `${apiUrl}/auth/login`,
          method: 'POST',
          dataType: 'JSON',
          data: form.serializeArray(),
          success: response => {
            document.cookie = `access-token=${response.token}`
            document.cookie = `user=${JSON.stringify(response.user)}`

            window.location.href = 'http://localhost/miami/public/admin'
          },
          error: error => {
            if (error.status === 422) {
              setErrorMessages(form, error.responseJSON.errors)
            }
          }
        })
      })
    })
  </script>

</body>

</html>
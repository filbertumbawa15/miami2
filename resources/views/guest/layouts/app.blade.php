<!DOCTYPE html>
<html lang="en">

<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="format-detection" content="telephone=no" />
  <script src="/cdn-cgi/apps/head/3ts2ksMwXvKRuG480KNifJ2_JNM.js"></script>
  <link rel="icon" href="{{ asset('guest/images/favicon.ico') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('guest/css/grid.css') }}">
  <link rel="stylesheet" href="{{ asset('guest/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('guest/css/font-awesome.css') }}">
  <link rel="stylesheet" href="{{ asset('guest/css/owl.carousel.css') }}">
  <link rel="stylesheet" href="https://livedemo00.template-help.com/wt_51282/css/contact-form.css" media="screen">
</head>

<body id="top" class="main_page">

  @include('guest.layouts.header')

  @yield('content')

  @include('guest.layouts.footer')

  <script src="{{ asset('guest/js/jquery.js') }}"></script>
  <script src="{{ asset('guest/js/jquery-migrate-1.2.1.js') }}"></script>
  <script src="{{ asset('guest/js/owl.carousel.js') }}"></script>
  <script src="https://livedemo00.template-help.com/wt_51282/js/TMForm.js"></script>
  <script src="https://livedemo00.template-help.com/wt_51282/js/modal.js"></script>
  <script src="{{ asset('guest/js/script.js') }}"></script>
  <script src="{{ asset('vendor/jquery.countdown-2.1.0/jquery.countdown.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
  <script>
    $(document).ready(function() {
      var hours, minutes, seconds;
      $("#owl").owlCarousel({
        items: 4,
        itemsDesktop: [1299, 4],
        itemsTablet: [995, 3],
        itemsTabletSmall: [767, 1],
        itemsMobile: [479, 1],
        lazyLoad: true,
        pagination: false,
        navigation: true
      });

      $.ajax({
        url: `http://localhost/miami/public/api/result/current`,
        method: "GET",
        dataType: "JSON",
        success: response => {
          let currentResult = response.data.number
          let resultNumbers = currentResult.split('')

          $('#result_datetime').text(`WINNING NUMBER: ${
            new Date(response.data.out_at * 1000).toLocaleString(0, {
              year: 'numeric',
              month: '2-digit',
              day: '2-digit',
            })
            }
            (GMT -4)`)

          $('#result_number').html(`
            ${
              $.map(resultNumbers, (resultNumber) => {
                return `<li> ${resultNumber} </li>`
              }).join('')
            }
          `)
          // console.log(currentResult);
          // $.each(response.data, (index, result) => {

          // })
        }
      })


      $.ajax({
        url: `http://localhost/miami/public/api/result/current`,
        method: "GET",
        dataType: "JSON",
        success: response => {
          var result_time;
          const remaining_date = new Date();
          remaining_date.setHours(15);
          remaining_date.setMinutes(36);
          remaining_date.setSeconds(00);
          result_remaining_time = remaining_date.getTime();
          console.log(result_remaining_time);
          if (new Date() >= result_remaining_time) {
            result_time = new Date(result_remaining_time + 86400 * 1000).toLocaleString('eu-ES', {
              year: 'numeric',
              month: '2-digit',
              day: '2-digit',
              hours24: true,
              hour: '2-digit',
              minute: '2-digit',
              second: '2-digit',
            });
            console.log("baca atas "+result_time);
          } else {
            result_time = new Date(result_remaining_time).toLocaleString('eu-ES', {
              year: 'numeric',
              month: '2-digit',
              day: '2-digit',
              hours24: true,
              hour: '2-digit',
              minute: '2-digit',
              second: '2-digit',
            });
            console.log("baca bawah "+result_time);
          }
          if (response.data == null) {
            $("#countdown")
              .countdown('2020/01/01', function(event) {
                hours = event.strftime('%H');
                minutes = event.strftime('%M');
                seconds = event.strftime('%S');
                $('#tiles').html("<span>" + hours + "</span><span>" + minutes + "</span><span>" + seconds + "</span>")
              });
          } else {
            // var date = `${new Date(add_day * 1000).getFullYear()}/${String(new Date(add_day * 1000).getMonth()+1).padStart(2, '0')}/${String(new Date(add_day * 1000).getDate()).padStart(2, '0')} ${new Date(add_day * 1000).getHours()}:${String(new Date(add_day * 1000).getMinutes()).padStart(2, '0')}:${String(new Date(add_day * 1000).getSeconds()).padStart(2, '0')}`;
            $("#countdown")
              .countdown(result_time, function(event) {
                hours = event.strftime('%H');
                minutes = event.strftime('%M');
                seconds = event.strftime('%S');
                $('#tiles').html("<span>" + hours + "</span><span>" + minutes + "</span><span>" + seconds + "</span>")
              });
          }
        }
      })


      $.ajax({
        url: "http://localhost/miami/public/api/result/listhistory?limit=3",
        type: 'GET',
        cache: true,
        success: function(response) {
          var counter = response.count;
          $.each(response.data, function(key, value) {
            weekday = new Date(value.out_at * 1000).toLocaleString(0, {
              weekday: 'short',
            }).toUpperCase()
            date = new Date(value.out_at * 1000).toLocaleString(0, {
              day: '2-digit',
            })
            month = new Date(value.out_at * 1000).toLocaleString(0, {
              month: 'short',
            }).toUpperCase()
            year = new Date(value.out_at * 1000).toLocaleString(0, {
              year: 'numeric',
            })
            $('.bg2 .container .row').append("<div class='grid_4 wrap'>\
          <div class='thumbnail'>\
            <h3>Winning Numbers <br>" + weekday + ", " + date + " " + month + " " + year + "</h3>\
            <p>Draw No: <span>#" + counter-- + "</span></p>\
            <ul class='list'>\
              <li>" + value.number[0] + "</li>\
              <li>" + value.number[1] + "</li>\
              <li>" + value.number[2] + "</li>\
              <li>" + value.number[3] + "</li>\
            </ul>\
          </div>\
        </div>");
          });
        }
      });

      $.ajax({
        url: "http://localhost/miami/public/api/result/listhistory",
        type: "GET",
        cache: true,
        success: function(response) {
          var date = '';
          var counter = response.count;
          $.each(response.data, function(key, value) {
            weekday = new Date(value.out_at * 1000).toLocaleString(0, {
              weekday: 'short',
            }).toUpperCase()
            date = new Date(value.out_at * 1000).toLocaleString(0, {
              day: '2-digit',
            })
            month = new Date(value.out_at * 1000).toLocaleString(0, {
              month: 'short',
            }).toUpperCase()
            year = new Date(value.out_at * 1000).toLocaleString(0, {
              year: 'numeric',
            })
            $('#listhistory').append(
              "<tr>\
                <td class='c1'>#" + counter-- + "</td>\
                <td class='c2'>\
                  <ul class='list'>\
                  <li>" + value.number[0] + "</li>\
                  <li>" + value.number[1] + "</li>\
                  <li>" + value.number[2] + "</li>\
                  <li>" + value.number[3] + "</li>\
                  </ul>\
                </td>\
                <td><time>" + weekday + ",<br> " + date + "<br> " + month + "<br> " + year + "</time></td>\
              </tr>"
            );
          })
          var items = $("table.table tbody tr");
          var numItems = response.data.length;
          var perPage = 5;

          items.slice(perPage).hide();

          $('#pagination-container').pagination({
            items: numItems,
            itemsOnPage: perPage,
            prevText: "&laquo;",
            nextText: "&raquo;",
            onPageClick: function(pageNumber) {
              var showFrom = perPage * (pageNumber - 1);
              var showTo = showFrom + perPage;
              items.hide().slice(showFrom, showTo).show();
            }
          });
        }

      });
    });
  </script>


</html>
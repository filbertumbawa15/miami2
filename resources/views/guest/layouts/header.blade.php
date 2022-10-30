<header id="header" class="header">
  <div class="banner">
    <div id="stuck_container">
      <nav>
        <div class="container">
          <div class="row">
            <div class="grid_12">
              <ul class="sf-menu">
                <li class="{{ Route::is('guest.game') ? 'current' : '' }}"></li>
                <li class="{{ Route::is('guest.home') ? 'current' : '' }}"><a href="{{ route('guest.home') }}">Home</a>
                <li class="{{ Route::is('guest.winning_number') ? 'current' : '' }}"><a href="{{ route('guest.winning_number') }}">Winning Numbers</a></li>
                <li class="{{ Route::is('guest.contact') ? 'current' : '' }}"><a href="{{ route('guest.contact') }}">Contacts</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </div>
    <!-- TradingView Widget BEGIN -->
    <div class="tradingview-widget-container">
      <div class="tradingview-widget-container__widget"></div>
      <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
        {
          "symbols": [{
              "proName": "FOREXCOM:SPXUSD",
              "title": "S&P 500"
            },
            {
              "proName": "FOREXCOM:NSXUSD",
              "title": "US 100"
            },
            {
              "proName": "FX_IDC:EURUSD",
              "title": "EUR/USD"
            },
            {
              "proName": "BITSTAMP:BTCUSD",
              "title": "Bitcoin"
            },
            {
              "proName": "BITSTAMP:ETHUSD",
              "title": "Ethereum"
            },
            {
              "description": "ETHUSD",
              "proName": "COINBASE:ETHUSD"
            }
          ],
          "showSymbolLogo": true,
          "colorTheme": "light",
          "isTransparent": false,
          "displayMode": "regular",
          "locale": "en"
        }
      </script>
    </div>
    <!-- TradingView Widget END -->
    <div class="container">
      <div class="row">
        <div class="grid_12">
          <h1><a href="index.html"><img src="{{ asset('guest/images/logo.png') }}" alt=""></a></h1>
          <div class="slogan">MIAMI LOTERY</div>
          <div class="unit">
            <div class="title2">LIVE DRAW</div>
            <div class="title3" id="result_remaining">REMAINING TIME:</div>
            <div id="countdown">
              <div id='tiles'></div>
              <div class="labels">
                <li>Hours</li>
                <li>Mins</li>
                <li>Secs</li>
              </div>
            </div>
            <div class="title3" id="result_datetime">WINNING NUMBER:-</div>
            <ul class="list_history" id="result_number">
              <li></li>
              <li></li>
              <li></li>
              <li></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
<div class="clear"></div>
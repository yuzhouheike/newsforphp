<?php

return [

    /*
      |--------------------------------------------------------------------------
      | Application Debug Mode
      |--------------------------------------------------------------------------
      |
      | When your application is in debug mode, detailed error messages with
      | stack traces will be shown on every error that occurs within your
      | application. If disabled, a simple generic error page is shown.
      |
     */

    'debug' => env('APP_DEBUG'),
    /*
      |--------------------------------------------------------------------------
      | Application URL
      |--------------------------------------------------------------------------
      |
      | This URL is used by the console to properly generate URLs when using
      | the Artisan command line tool. You should set this to the root of
      | your application so that it is used when running Artisan tasks.
      |
     */
    'url' => 'http://newsapi.revanow.com/',
    /*
      |--------------------------------------------------------------------------
      | Application Timezone
      |--------------------------------------------------------------------------
      |
      | Here you may specify the default timezone for your application, which
      | will be used by the PHP date and date-time functions. We have gone
      | ahead and set this to a sensible default for you out of the box.
      |
     */
    'timezone' => 'Asia/Shanghai',
    /*
      |--------------------------------------------------------------------------
      | Application Locale Configuration
      |--------------------------------------------------------------------------
      |
      | The application locale determines the default locale that will be used
      | by the translation service provider. You are free to set this value
      | to any of the locales which will be supported by the application.
      |
     */
    'locale' => 'en',
    /*
      |--------------------------------------------------------------------------
      | Application Fallback Locale
      |--------------------------------------------------------------------------
      |
      | The fallback locale determines the locale to use when the current one
      | is not available. You may change the value to correspond to any of
      | the language folders that are provided through your application.
      |
     */
    'fallback_locale' => 'en',
    /*
      |--------------------------------------------------------------------------
      | Encryption Key
      |--------------------------------------------------------------------------
      |
      | This key is used by the Illuminate encrypter service and should be set
      | to a random, 32 character string, otherwise these encrypted strings
      | will not be safe. Please do this before deploying an application!
      |
     */
    'key' => env('APP_KEY', 'SomeRandomString'),
    'cipher' => MCRYPT_RIJNDAEL_128,
    /*
      |--------------------------------------------------------------------------
      | Logging Configuration
      |--------------------------------------------------------------------------
      |
      | Here you may configure the log settings for your application. Out of
      | the box, Laravel uses the Monolog PHP logging library. This gives
      | you a variety of powerful log handlers / formatters to utilize.
      |
      | Available Settings: "single", "daily", "syslog", "errorlog"
      |
     */
    'log' => 'daily',
    'api_en_url' => 'http://api.newsdog.today/',
    'api_in_url' => 'http://api.hindi.newsdog.today/',
    'api_log_path' => '/web/newsapi/logs/',
    'news_detail_url' => 'http://newsapi.revanow.com/articles/',
    'english_token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VybmFtZSI6ImFuZHJvaWQ6bGV3YV8xMjM0NTYiLCJhY2NvdW50X3R5cGUiOjIsInVzZXJfaWQiOiI1NzUxM2FmMDEyYzFmYjczZDVhNWRjMmYiLCJleHAiOjE0ODY5Nzk4MDh9.IXK9OlPh3drJz5yoLx4JD5bkshEFBPDr4Vu5N3ZAvZE',
    'india_token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VybmFtZSI6ImFuZHJvaWQ6bGV3YV8xMjM0NTYiLCJhY2NvdW50X3R5cGUiOjIsInVzZXJfaWQiOiI1NzU1NGJjOGExYzcyYzdjMDdjZGNiMWMiLCJleHAiOjE0ODY5Nzk4ODd9.ors364PBCpA_rsw3K1m6hwkDJWpmzVI8rHUmvD7oiOs',
    'night_color' => '#ffffff',
    'night_background' => '#444444',
    'day_color' => '#000000',
    'day_background' => '#FFFFFF',
    'black_source' => array(
        "hindi.economictimes.indiatimes.com",
        "navbharattimes.indiatimes.com",
        "khabar.ndtv.com",
        "www.livehindustan.com",
        "timesofindia.indiatimes.com",
        "economictimes.indiatimes.com",
        "www.punemirror.in",
        "www.bangaloremirror.com",
        "www.ahmedabadmirror.com",
        "www.mumbaimirror.com",
        "www.indiatimes.com",
        "www.gizmodo.in",
        "in.ign.com",
        "zoomtv.indiatimes.com",
        "www.mensxp.com",
        "www.cricbuzz.com",
        "www.filmfare.com",
        "www.timesnow.tv",
        "www.zigwheels.com",
        "photogallery.indiatimes.com",
        "blogs.economictimes.indiatimes.com",
        "realty.economictimes.indiatimes.com",
        "retail.economictimes.indiatimes.com",
        "telecom.economictimes.indiatimes.com",
        "auto.economictimes.indiatimes.com",
        "www.topgear.com",
        "www.ndtv.com",
        "movies.ndtv.com",
        "gadgets.ndtv.com",
        "ndtv.com",
        "profit.ndtv.com",
        "food.ndtv.com",
        "sports.ndtv.com",
        "auto.ndtv.com",
        "www.livemint.com",
        "money.livemint.com",
        "www.hindustantimes.com",
        "www.sportstaronnet.com",
        "www.thehindu.com",
        "www.thehinducentre.com",
        "thehindubusinessline.com",
        "www.frontline.in",
        "www.desimartini.com",
        "www.bhaskar.com",
        "daily.bhaskar.com",
        "www.huffingtonpost.in",
        "www.businessinsider.in",
        "www.intechradar.com",
        "in.askmen.com",
        "www.techgig.com",
        "www.idiva.com",
        "hindi.pinkvilla.com",
        "www.pinkvilla.com",
        "www.femina.in",
        "m.femina.in",
        "m.tech.firstpost.com",
        "www.firstpost.com",
        "tech.firstpost.com",
        "www.moneycontrol.com",
        "www.news18.com",
        "khabar.ibnlive.com",
        "khabar.ibnlive.in.com",
        "khabarindiatv.com",
        "paisa.khabarindiatv.com",
        "www.indiatvnews.com",
        "hindi.pradesh18.com",
        "english.pradesh18.com",
        "overdrive.in",
        "inextlive.jagran.com",
        "www.mid-day.com",
        "naidunia.jagran.com",
        "m.jagran.com",
        "www.jagranjunction.com",
        "post.jagran.com",
        "www.jagran.com",
        "www.sportskeeda.com",
        "hindi.sportskeeda.com",
        "www.sports24hour.com",
        "www.thenewsminute.com",
        "www.koimoi.com",
        "hindi.koimoi.com",
        "www.businesstoday.in",
        "wonderwoman.intoday.in",
        "indiatoday.intoday.in",
        "www.cosmopolitan.in",
        "m.indiatoday.in",
        "aajtak.intoday.in",
        "www.ichowk.in",
        "www.dailyo.in",
        "www.newindianexpress.com",
        "indulge.newindianexpress.com",
        "www.thestatesman.com",
        "www.thestatesman.net",
        "hindi.oneindia.com",
        "hindi.oneindia.in",
        "www.oneindia.com",
        "gallery.oneindia.in",
        "hindi.thatscricket.com",
        "www.thatscricket.com",
        "hindi.gizbot.com",
        "www.gizbot.com",
        "www.drivespark.com",
        "hindi.drivespark.com",
        "hindi.boldsky.com",
        "www.boldsky.com",
        "hindi.nativeplanet.com",
        "www.filmibeat.com",
        "hindi.filmibeat.com",
        "hindi.goodreturns.in",
        "www.goodreturns.in",
        "www.careerindia.com",
        "indianexpress.com",
        "www.thefinancialexpress-bd.com",
        "computer.financialexpress.com",
        "www.financialexpress.com",
        "www.jansatta.com",
        "www.financialexpress.com",
        "forbesindia.com",
        "www.mumbainews.net",
        "www.kolkatanews.net",
        "www.newdelhinews.net",
        "www.bombaynews.net",
        "www.newdelhinews.net",
        "www.professionalautos.com"),
    /*
      |--------------------------------------------------------------------------
      | Autoloaded Service Providers
      |--------------------------------------------------------------------------
      |
      | The service providers listed here will be automatically loaded on the
      | request to your application. Feel free to add your own services to
      | this array to grant expanded functionality to your applications.
      |
     */
    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        'Illuminate\Foundation\Providers\ArtisanServiceProvider',
        'Illuminate\Auth\AuthServiceProvider',
        'Illuminate\Bus\BusServiceProvider',
        'Illuminate\Cache\CacheServiceProvider',
        'Illuminate\Foundation\Providers\ConsoleSupportServiceProvider',
        'Illuminate\Routing\ControllerServiceProvider',
        'Illuminate\Cookie\CookieServiceProvider',
        'Illuminate\Database\DatabaseServiceProvider',
        'Illuminate\Encryption\EncryptionServiceProvider',
        'Illuminate\Filesystem\FilesystemServiceProvider',
        'Illuminate\Foundation\Providers\FoundationServiceProvider',
        'Illuminate\Hashing\HashServiceProvider',
        'Illuminate\Mail\MailServiceProvider',
        'Illuminate\Pagination\PaginationServiceProvider',
        'Illuminate\Pipeline\PipelineServiceProvider',
        'Illuminate\Queue\QueueServiceProvider',
        'Illuminate\Redis\RedisServiceProvider',
        'Illuminate\Auth\Passwords\PasswordResetServiceProvider',
        'Illuminate\Session\SessionServiceProvider',
        'Illuminate\Translation\TranslationServiceProvider',
        'Illuminate\Validation\ValidationServiceProvider',
        'Illuminate\View\ViewServiceProvider',
        'Collective\Html\HtmlServiceProvider',
        /*
         * Application Service Providers...
         */
        'App\Providers\AppServiceProvider',
        'App\Providers\BusServiceProvider',
        'App\Providers\ConfigServiceProvider',
        'App\Providers\EventServiceProvider',
        'App\Providers\RouteServiceProvider',
    ],
    /*
      |--------------------------------------------------------------------------
      | Class Aliases
      |--------------------------------------------------------------------------
      |
      | This array of class aliases will be registered when this application
      | is started. However, feel free to register as many as you wish as
      | the aliases are "lazy" loaded so they don't hinder performance.
      |
     */
    'aliases' => [

        'App' => 'Illuminate\Support\Facades\App',
        'Artisan' => 'Illuminate\Support\Facades\Artisan',
        'Auth' => 'Illuminate\Support\Facades\Auth',
        'Blade' => 'Illuminate\Support\Facades\Blade',
        'Bus' => 'Illuminate\Support\Facades\Bus',
        'Cache' => 'Illuminate\Support\Facades\Cache',
        'Config' => 'Illuminate\Support\Facades\Config',
        'Cookie' => 'Illuminate\Support\Facades\Cookie',
        'Crypt' => 'Illuminate\Support\Facades\Crypt',
        'DB' => 'Illuminate\Support\Facades\DB',
        'Eloquent' => 'Illuminate\Database\Eloquent\Model',
        'Event' => 'Illuminate\Support\Facades\Event',
        'File' => 'Illuminate\Support\Facades\File',
        'Hash' => 'Illuminate\Support\Facades\Hash',
        'Input' => 'Illuminate\Support\Facades\Input',
        'Inspiring' => 'Illuminate\Foundation\Inspiring',
        'Lang' => 'Illuminate\Support\Facades\Lang',
        'Log' => 'Illuminate\Support\Facades\Log',
        'Mail' => 'Illuminate\Support\Facades\Mail',
        'Password' => 'Illuminate\Support\Facades\Password',
        'Queue' => 'Illuminate\Support\Facades\Queue',
        'Redirect' => 'Illuminate\Support\Facades\Redirect',
        'Redis' => 'Illuminate\Support\Facades\Redis',
        'Request' => 'Illuminate\Support\Facades\Request',
        'Response' => 'Illuminate\Support\Facades\Response',
        'Route' => 'Illuminate\Support\Facades\Route',
        'Schema' => 'Illuminate\Support\Facades\Schema',
        'Session' => 'Illuminate\Support\Facades\Session',
        'Storage' => 'Illuminate\Support\Facades\Storage',
        'URL' => 'Illuminate\Support\Facades\URL',
        'Validator' => 'Illuminate\Support\Facades\Validator',
        'View' => 'Illuminate\Support\Facades\View',
        'Form' => 'Collective\Html\FormFacade',
        'Html' => 'Collective\Html\HtmlFacade',
    ],
];

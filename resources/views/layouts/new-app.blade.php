<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ORAD Consultancy </title>
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />

  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="{{asset('css/developer.css')}}" type="text/css" />
  <link rel="shortcut icon" href="{{asset("img/avatar/oradavatar.jpg")}}" type="image/x-icon">
  <link rel="icon" href="{{asset("img/avatar/oradavatar.jpg")}}" type="image/x-icon">
  <link rel="stylesheet" href="{{asset('/css/owl.carousel.min.css')}}">
<script type="text/javascript" src="{{ URL::asset('files\assets\js\sweetalert.js') }}"></script>
    @livewireStyles

    @livewireScripts
</head>

<body>

  <div x-data="setup()" x-init="$refs.loading.classList.add('hidden');">
    <div class="flex h-screen antialiased text-gray-900 bg-gray-100 ">
      <!-- Loading screen start here -->
      @include('layouts.loader')
      <!-- Loading screen end here   -->

      <!-- Sidebar start here-->
     @include('layouts.side-navigation')
      <!-- Sidebar end here  -->

      <div class="flex flex-col flex-1 min-h-screen overflow-x-hidden overflow-y-auto">

        <!-- Navbar start here -->
        @include('layouts.top-navigation')
        <!-- Navbar end here  -->


        <div class="p-4 bg-secondary">

          <!-- Main content start here -->
          <main class="space-y-4 py-4">

            {{$slot}}

            {{-- user id for pusher script --}}
            <input type="hidden" name="userid" id="userid" value="{{ auth()->user()->id}}" />
          </main>
          <!-- Main content end here  -->

          <!-- footer content start here  -->
          @include('layouts.footer')
          <!-- footer content end here  -->

        </div>

      </div>

    </div>
  </div>

  <script src="{{asset('/js/alpine.min.js')}}" defer></script>
  <script src="{{('/js/alpine-magic-helper.min.js')}}"></script>
  <script src="{{asset('/js/jquery.min.js')}}" ></script>
  <script src="{{asset('/js/owl.carousel.min.js')}}"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 
  <!-- <script src="https://datatables.net/download/build/dataTables.responsive.nightly.js"></script> -->
  <script src="{{ asset('/js/moment.js') }}" type="text/javascipt"></script>
  <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
  <script src="{{ asset('/js/developer.js') }}" type="text/javascipt"></script>
  <script src="{{ asset('/js/pusher.js') }}" type="text/javascipt"></script>

  <script>


$(document).ready(function () {
    $(".owl-carousel").owlCarousel({
      stagePadding: 0,
      loop: true,
      margin: 10,
      nav: true,
      dots:false,
      freeDrag:true,
      responsive: {
          0: {
              items: 1
          },
          600: {
              items: 2
          },
          1000: {
              items: 3
          }
      },
    });

});

  Livewire.on('flashmessage', message => {
      Swal.fire({
          position: 'center',
          icon: 'success',
          title: message,
          showConfirmButton: false,
          timer: 1500
      }).then(function(){ 
          location.reload();
      });
  })
    $(document).ready(function () {
      // navigation bar toggle
      $(".nav-toggler").each(function (_, navToggler) {
        var target = $(navToggler).data("target");
        $(navToggler).on("click", function () {
          $(target).animate({
            height: "toggle"
          }, 500);
        });
      });
    });
    // dashboard notification panel & mobile menu 
    const setup = () => {
      return {
        loading: true,
        isNotificationsPanelOpen: false,
        openNotificationsPanel() {
          this.isNotificationsPanelOpen = true
          this.$nextTick(() => {
            this.$refs.notificationsPanel.focus()
          })
        },
        isMobileMainMenuOpen: false,
        openMobileMainMenu() {
          this.isMobileMainMenuOpen = true
          this.$nextTick(() => {
            this.$refs.mobileMainMenu.focus()
          })
        },
      }
    }

        // pop model open & close for lead history
    function historyModal() {

        return {
            historyState: 'CLOSED', // [CLOSED, TRANSITION, OPEN]
            historyOpen() {
              document.getElementById("importstaff").style.display = "block";

                this.historyState = 'TRANSITION'
                setTimeout(() => { this.historyState = 'OPEN' }, 50)
            },
            historyClose() {
                this.historyState = 'TRANSITION'
                setTimeout(() => { this.historyState = 'CLOSED' }, 50)
            },
            isHistoryOpen() { return this.historyState === 'OPEN' },
            isHistoryOpening() { return this.historyState !== 'CLOSED' },
        }
    }
    // pop model open & close for lead create
    function leadModal() {

        return {
            state: 'CLOSED', // [CLOSED, TRANSITION, OPEN]
            open() {
              document.getElementById("importstaff").style.display = "block";

                this.state = 'TRANSITION'
                setTimeout(() => { this.state = 'OPEN' }, 50)
            },
            close() {
                this.state = 'TRANSITION';
                setTimeout(() => { this.state = 'CLOSED' }, 300)
            },
            isOpen() { return this.state === 'OPEN' },
            isOpening() { return this.state !== 'CLOSED' },
        }
    }
    // pop model open & close for excel import
    function excelImportModal() {
   ////////   alert("calll");
        return {
            excelState: 'CLOSED', // [CLOSED, TRANSITION, OPEN]
            excelOpen() {
              document.getElementById("importstafflead").style.display = "block";

                this.excelState = 'TRANSITION'
                setTimeout(() => { this.excelState = 'OPEN' }, 50)
            },
            excelClose() {
           //   document.getElementById("importstafflead").style.display = "none";
                this.excelState = 'TRANSITION';
                setTimeout(() => { this.excelState = 'CLOSED' }, 300)
            },
            isExcelOpen() { document.getElementById("importstafflead").style.display = "block";
 return this.excelState === 'OPEN' },
            isExcelOpening() { document.getElementById("importstafflead").style.display = "block";
return this.excelState !== 'CLOSED' },
        }
    }
    // pop model open & close for excel import
    function assignmentModal() {

        return {
            assignState: 'CLOSED', // [CLOSED, TRANSITION, OPEN]
            assignOpen() {
              document.getElementById("importstaff").style.display = "block";

                this.assignState = 'TRANSITION'
                setTimeout(() => { this.assignState = 'OPEN' }, 50)
            },
            assignClose() {
                this.assignState = 'TRANSITION';
                setTimeout(() => { this.assignState = 'CLOSED' }, 300)
            },
            isAssignOpen() { return this.assignState === 'OPEN' },
            isAssignOpening() { return this.assignState !== 'CLOSED' },
        }
    }

    //hide alert after 5 sec.
    setTimeout(function () {
      $(".alert").slideUp();
    }, 50000);

    // date picker 
    $(function () {
      $(".datepicker").datepicker({ "dateFormat": "yy-mm-dd" });
    });

    $(document).ready(function () {
        // Enable pusher logging - don't include this in production
        // Pusher.logToConsole = true;
        var pusher = new Pusher('376e5739a7cde0a14c72', {
            wsHost: window.location.hostname,
            cluster: 'ap2',
            // forceTLS: true,
            wsPort: 6003,
            wssPort: 6003,
            // encrypted: true,
            disableStats: true,
            enabledTransports: ['ws', 'wss']
        });

        var userid = $("#userid").val();
        var channelName = `receiverid-${userid}`;
        
        // Subscribe to the channel we specified in our Laravel Event
        var channel = pusher.subscribe('push-notification');

        // Bind a function to a Event (the full Laravel class)
        var audio = document.createElement("AUDIO")
        document.body.appendChild(audio);
        audio.src = "{{ asset('/audio/notification.mp3') }}";
        // const audio = new Audio(`${sound}`);
        channel.bind(channelName, function (data) {
            
            var currentcount = parseInt($('#noticount').html()) + 1
            $('#noticount').html('')
            $('#noticount').html(currentcount)
            $('.new-lead').html(currentcount)
            $("#bellicone").effect("shake",{times:5,distance:5},'slow');
            audio.play();
            var notificationsingle = `
              <a href="#" class="flex items-center px-4 py-3 border-b hover:bg-gray-100 -mx-2">
                <p class="text-gray-600 text-sm mx-2">
                  <span class="font-normal text-sm notification-msg">${data.message}</span>
                  <span class="notification-time text-primary">now</span>
                </p>
              </a>
            `;
            $('#emptynotification').remove();
            $('#notificationparent').append(notificationsingle);
        });

    })


  </script>
  
</body>

</html>
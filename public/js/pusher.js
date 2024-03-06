$(document).ready(function () {
    alert();
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;
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
    var channelName = 'userid-' + userid
    console.log(channelName);
    // Subscribe to the channel we specified in our Laravel Event
    var channel = pusher.subscribe('push-notification');

    // Bind a function to a Event (the full Laravel class)
    channel.bind(channelName, function (data) {
        console.log("message", data.message);
        var currentcount = parseInt($('#noticount').html()) + 1
        $('#noticount').html('')
        $('#noticount').html(currentcount)
        $("#noticount").effect("shake");
        var notificationsingle =
            `
                <a href="#" class="flex items-center px-4 py-3 border-b hover:bg-gray-100 -mx-2">
                    <p class="text-gray-600 text-sm mx-2">
                        <span class="font-normal text-sm notification-msg">${data.message}</span>
                        <span class="notification-time text-primary">now</span>
                    </p>
                </a>
            `;
        $('#emptynotification').remove();
        $('#notificationparent').after(notificationsingle);
    });

})

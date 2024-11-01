import _ from 'lodash';

window._ = _;

// import '@popperjs/core';
import 'bootstrap/dist/js/bootstrap.bundle.min';

import jQuery from 'jquery';

window.$ = window.jQuery = jQuery;


import axios from 'axios';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


import Swal from 'sweetalert2';

window.Swal = Swal;

window.persianDate = require('persian-date/dist/persian-date.min');
window.PersianDatepicker = require('persian-datepicker/dist/js/persian-datepicker.min');
window.moment = require('moment-jalaali/index');


/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });

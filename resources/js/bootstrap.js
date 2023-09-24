import _ from 'lodash';
import 'bootstrap';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */
import axios from 'axios';
// import Echo from 'laravel-echo';

import Pusher from 'pusher-js';

window._ = _;

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// window.Pusher = Pusher;

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key:'ABCDEFG',
//     wsHost: window.location.hostname,
//     wsPort: 6001,
//     forceTLS: false,
//     disableStats: true,
//     // enabledTransports: ['ws', 'wss'],
// });

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true,
//     wsHost: 'elo.marathishortnews.xyz',
//     wssHost: 'elo.marathishortnews.xyz',
//     wsPort: '6001',
//     wssPort: 6001,
//     disableStats: false,
//     forceTLS: false,
//     enabledTransports: ['ws', 'wss']
// });

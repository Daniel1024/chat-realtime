
Vue.component('chat-message', require('./components/ChatMessage.vue'));
Vue.component('chat-log', require('./components/ChatLog.vue'));
Vue.component('chat-composer', require('./components/ChatComposer.vue'));

import toastr from 'toastr';

let scroll = false;

const app = new Vue({
    el: '#app',
    data: {
        messages: [],
        usersInRoom: []
    },
    methods: {
        addMessage(message) {
            axios.post('/message',{message: message}).then(response => {
                this.messages.push(response.data);
                scroll = true;
            });
        }
    },
    created() {
        //console.log('created');
        window.axios.get('/messages').then(response => {
            this.messages = response.data;
            scroll = true;
        });

        window.Echo.join('chatroom')
            .here((users) => {
                this.usersInRoom = users;
            })
             .joining((user) => {
                this.usersInRoom.push(user);
                toastr.success('El usuario: '+user.name+' se acaba de unir al Chat', 'Usuario ingresando');
            })
            .leaving((user) => {
                this.usersInRoom = this.usersInRoom.filter(u => u != user)
                toastr.warning('El usuario: '+user.name+' se acaba de ir del Chat', 'Usuario saliendo')
            })
            .listen('MessagePosted', (e) => {
                this.messages.push({
                    message: e.message.message,
                    user: e.user
                });
                scroll = true;
            });
    },
    updated() {
        if (scroll) {
            $("#message-area")
                .parent()
                .animate({
                    scrollTop: $("#message-area").height()
                }, 800);
            scroll = false;
        }
    }
});

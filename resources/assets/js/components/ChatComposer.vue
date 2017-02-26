<template lang="html">
<div class="chat-composer">
    <input
        class="form-control"
        v-model="messageText"
        @keyup.enter="sendMessage"
        type="text"
        placeholder="Start typing your message...">
    <button class="btn btn-primary"
        @click.prevent="sendMessage">Send</button>
</div>
</template>
<script>
export default {
    data() {
        return {
            messageText: ''
        }
    },
    methods: {
        sendMessage() {
            if (this.messageText != '') {
                this.$emit('messagesent', this.messageText);
                this.messageText = '';
            }
        }
    }
}
</script>
<style lang="scss">
    .chat-composer {
        display: flex;
        input {
            flex: 1 auto;
        }
        button {
            border-radius: 0;
        }
    }
    
</style>
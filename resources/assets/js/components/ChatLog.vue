<template lang="html">
    <div class="chat-log" id="message-area">
        <chat-message v-for="message in messages"
            :message="message">
        </chat-message>
        <div class="empty"
            v-if="messages.length == 0">
            Nothing here yet!
        </div>
    </div>
</template>
<script>
export default {
    props: ['messages']
}
</script>
<style lang="scss">
    .chat-log {
        .chat-message {
            &:nth-child(even) {
                background-color: #ccc;
            }
        }
    }
    .empty {
        padding: 1rem;
        text-align: center;
    }
</style>

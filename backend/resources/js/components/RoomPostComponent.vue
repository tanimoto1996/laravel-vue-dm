<template>
    <div class="meassege-form">
        <input type="hidden" name="user_send_id" :value="user_send_id">
        <input type="hidden" name="user_Receive_id" :value="user_receive_id">
        <textarea name="text" id="message" cols="30" rows="10"></textarea>
        <input type="submit" value="送信">
        {{ info }}
    </div>
</template>

<script>
    export default {
        props:["user_send_id", "user_receive_id"],
        data () {
            return {
                info: null
            }
        },
        mounted () {
        },
        methods: {
        },
        created() {
        }
    }
</script>
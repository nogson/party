<template>
    <div class="content">
        <ul>
            <li v-for="notification in notifications" :key="notification.id">
                <dl v-if="notification.type === 'request'" class="notification">
                    <dt class="title">
                        <img class="avatar" :src="notification.user.avatar">
                        <span>{{notification.user.name}}さんよりメッセージが届いています</span>
                    </dt>
                    <dd>
                        <p>{{notification.message}}</p>
                        <div>
                            <b-button variant="outline-dark">仲間にならない</b-button>
                            <b-button variant="outline-primary" @click="acceptRequest(notification.user.id)">仲間になる
                            </b-button>
                        </div>
                    </dd>
                </dl>
                <dl v-else-if="notification.type === 'accept_request'" class="notification">
                    <dt class="title">
                        <img class="avatar" :src="notification.user.avatar">
                        <span>{{notification.user.name}}さんが仲間に加わりました</span>
                    </dt>
                    <dd>
                    </dd>
                </dl>

            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "notification",
        middleware: 'guest',
        layout: 'base',
        async asyncData({$axios, store}) {
            // const userId = store.getters['auth/loggedUser'].id
            const res = await $axios.$get(`api/notifications`)
            console.log(res)
            // let form = res.profile ? res.profile : {}
            // form.skill = res.skill
            return {notifications: res.notifications}
        },
        data() {
            return {
                requests: []
            }
        },
        created() {
        },
        methods: {
            async acceptRequest(userId) {
                const res = await this.$axios.$put('api/friend/accept', {user_id: userId})

            }
        }
    }
</script>

<style scoped lang="scss">

    .content {
        padding: 24px;
    }

    .notification {
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #CCC;
        .title {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .avatar {
            width: 30px;
            height: 30px;
            border-radius: 100px;
            border: 1px solid $color-border;
            margin-right: 10px;
        }
    }


</style>
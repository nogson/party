<template>
    <section>
        <div class="friend_wrap">
            <div class="friend" v-if="hasFiends" v-for="friend in friends" :key="friend.id" @click="showModal(friend)">
                {{friend.requestd}}
                <div class="thumbnail"></div>
                <!--                <img src="~/assets/images/dummy.png" class="thumbnail"/>-->
                <h2 class="friend_name">
                    <i v-if="friend.accept_status" class="accepted"></i>
                    <i v-else-if="friend.requested" class="requested"></i>
                    {{friend.name}}
                </h2>
                <p class="friend_purpose">{{friend.purpose}}</p>
                <div class="friend_skill">
                    <radar-chart :data="getChartData(friend.skill)"/>
                </div>
            </div>
            <div v-if="!hasFiends">
                仲間の候補がいません。
            </div>
        </div>
        <b-modal v-model="showFriendModal"
                 ref="friend-detail-modal">
            <template v-slot:modal-header>
                <div>
                    <i v-if="selectedFriend.requested" class="requested"></i><span>{{selectedFriend.name}}</span>
                </div>
                <a :href="link(selectedFriend.twitter_id)">
                    <font-awesome-icon class="fa-2x" :icon="['fab', 'twitter-square']"/>
                </a>
            </template>
            <p>{{selectedFriend.purpose}}</p>
            <template v-slot:modal-footer>
                <div class="w-100">
                    <b-button
                            variant="primary"
                            size="md"
                            class="float-left"
                            :disabled="selectedFriend.requested"
                            @click="showRequestModal()"
                    >仲間に誘う
                    </b-button>
                    <b-button
                            variant="outline-primary"
                            size="md"
                            class="float-right"
                            @click="showFriendModal=false"
                    >閉じる
                    </b-button>
                </div>
            </template>
        </b-modal>
        <b-modal v-model="showFriendRequestModal"
                 ref="friend-request-modal" title="仲間に誘う">
            <b-form-textarea
                    id="textarea"
                    v-model="message"
                    placeholder="Enter something..."
                    rows="3"
                    max-rows="6"
            ></b-form-textarea>
            <template v-slot:modal-footer>
                <div class="w-100">
                    <b-button
                            variant="primary"
                            size="md"
                            class="float-right"
                            @click="requestFriend()"
                    >送信
                    </b-button>
                </div>
            </template>
        </b-modal>
    </section>
</template>
<script>

    import RadarChart from "../components/RadarChart"

    export default {
        components: {RadarChart},
        middleware: 'guest',
        layout: 'base',
        async asyncData({$axios, redirect}) {
            const friends = await $axios.$get('api/users')
            return {friends}
        },
        data() {
            return {
                friends: [],
                showFriendModal: false,
                showFriendRequestModal: false,
                selectedFriend: {
                    name: ''
                },
                message: 'よろしく願いします！'
            }
        },
        created() {

        },
        computed: {
            link: () => {
                return (id) => {
                    return `https://twitter.com/${id}`
                }
            },
            hasFiends() {
                return this.friends.length > 0
            }
        },
        methods: {
            getChartData(skill) {

                let labels = skill.map(d => d.label)
                let data = skill.map(d => d.level)

                //グラフが見やすいように足りない分ばダミーデータを入れる
                if (labels.length < 5) {
                    for (let i = 0, j = 5 - labels.length; i < j; i++) {
                        labels.push('-')
                        data.push(0)
                    }
                }

                return {
                    labels: labels,
                    datasets: [{
                        backgroundColor: 'rgba(22,198,192,0.5)',
                        borderColor: '#16C6C0',
                        pointBackgroundColor: '#16C6C0',
                        data: data
                    }]
                }
            },
            showModal(friend) {
                this.selectedFriend = friend
                this.$refs['friend-detail-modal'].toggle()
            },
            showRequestModal() {
                this.showFriendModal = false
                this.$refs['friend-request-modal'].toggle()
            },
            requestFriend() {
                this.$axios.$post('api/friend/request', {
                    receive_user_id: this.selectedFriend.user_id,
                    message: this.message
                }).then(() => {
                    this.showFriendRequestModal = false
                })
            }
        }
    }
</script>
<style scoped lang="scss">

    $padding: 32px;

    .friend_wrap {
        display: flex;
        flex-wrap: wrap;
        padding: $padding;

        > .friend:not(:nth-child(5n)) {
            margin-right: $padding;
        }
    }

    .friend {
        width: calc((100% - #{$padding} * 4) / 5);
        border: 1px solid #CCC;
        padding: 56px 16px 16px 16px;
        margin-bottom: $padding + 8px + 32px;
        position: relative;
        border-radius: 4px;
    }

    .friend_name {
        color: #16C6C0;
        font-size: 14px;
        font-weight: bold;
        text-align: center;
    }

    .friend_purpose {
        margin-bottom: 16px;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
        overflow: hidden;
    }

    .thumbnail {
        width: 80px;
        height: 80px;
        top: 0;
        left: 50%;
        background: #CCC;
        border-radius: 200px;
        position: absolute;
        transform: translateY(-50%) translateX(-50%);
        border: 5px solid #FFF;
        box-sizing: border-box;
    }

    .requested {
        background: #99e0c0;
        width: 10px;
        height: 10px;
        border-radius: 10px;
        display: inline-block;
        margin-right: 5px;
    }

    .accepted {
        background: #16C6C0;
        width: 10px;
        height: 10px;
        border-radius: 10px;
        display: inline-block;
        margin-right: 5px;
    }

</style>
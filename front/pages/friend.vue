<template>
  <section>
    <div class="friend_wrap">
      <div class="friend" v-for="friend in friends" :key="friend.id">
        <div class="thumbnail"></div>
        <!--                <img src="~/assets/images/dummy.png" class="thumbnail"/>-->
        <h2 class="friend_name"><a :href="link(friend.twitter_id)">{{friend.name}}
          <font-awesome-icon :icon="['fab', 'twitter-square']"/>
        </a></h2>
        <p class="friend_purpose">{{friend.purpose}}</p>
        <div class="friend_skill">
          <radar-chart :data="getChartData(friend.skill)"/>
        </div>
        <b-button v-b-modal.modal-1>Launch demo modal</b-button>

      </div>
    </div>
    <b-modal id="modal-1" title="BootstrapVue">
      <p class="my-4">Hello from modal!</p>
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
      console.log(friends)

      return {friends}
    },
    data() {
      return {
        friends: []
      }
    },
    created() {

    },
    computed: {
      link:()=> {
        return (id) => {
          return `https://twitter.com/${id}`
        }
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


</style>
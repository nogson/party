<template>
  <div class="content">
    <button @click="logout">ログアウト</button>
    <p>あなたについて教えて下さい。</p>
    <b-form @submit="onSubmit">
      <b-form-group
          id="input-group-1"
          label="お名前"
          label-for="input-1"
      >
        <b-form-input v-model="form.name" placeholder="お名前"></b-form-input>
      </b-form-group>
      <b-form-group
          id="input-group-1"
          label="やりたいこと"
          label-for="input-1"
          description="We'll never share your email with anyone else."
      >
        <b-form-textarea
            id="textarea"
            v-model="form.purpose"
            placeholder="仲間を集めてやりたいことを書いてください"
            rows="3"
            max-rows="6"
        ></b-form-textarea>
      </b-form-group>
      <b-form-group
          id="input-group-1"
          label="得意なこと"
          label-for="input-1"
      >
        <div class="l_flex">
          <b-form-input v-model="form.skill.label" placeholder="あなたの得意なことを入力"></b-form-input>
          <b-form-select v-model="form.skill.level" :options="selectBoxOptions"></b-form-select>
        </div>

      </b-form-group>

      <b-button type="submit" variant="primary">Submit</b-button>
    </b-form>

  </div>
</template>

<script>
  export default {
    name: "home",
    middleware: 'guest',
    data() {
      return {
        form: {
          skill:{
            label:'',
            level:3
          }
        },
        user: null,
        selectBoxOptions: [
          {value: 1, text: "★☆☆☆☆"},
          {value: 2, text: "★★☆☆☆"},
          {value: 3, text: "★★★☆☆"},
          {value: 4, text: "★★★★☆"},
          {value: 5, text: "★★★★★"}
        ]
      }
    },
    methods: {
      onSubmit(evt) {
        evt.preventDefault()
        console.log(JSON.stringify(this.form))
      },
      logout(){
        this.$axios
          .$post('api/oauth/token/destroy').then(()=>{
          this.$router.push('login')

        })
      }
    }
  }
</script>

<style scoped lang="scss">
  .content {
    padding: 24px;
  }


</style>
<template>
  <div class="content">
    <p>あなたについて教えて下さい。</p>
    <b-form @submit="onSubmit">
      <b-form-group
          id="input-group-1"
          label="お名前"
          label-for="input-1"
      >
        <b-form-input v-model="text" placeholder="お名前"></b-form-input>
      </b-form-group>
      <b-form-group
          id="input-group-1"
          label="やりたいこと"
          label-for="input-1"
          description="We'll never share your email with anyone else."
      >
        <b-form-textarea
            id="textarea"
            v-model="text"
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
          <b-form-input v-model="text" placeholder="あなたの得意なことを入力"></b-form-input>
          <b-form-select v-model="form.selected" :options="selectBoxOptions"></b-form-select>
        </div>

      </b-form-group>

      <b-button type="submit" variant="primary">Submit</b-button>
    </b-form>

  </div>
</template>

<script>
  export default {
    name: "home",
    data() {
      return {
        text: '',
        form: {
          selected:3
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
    mounted() {
      this.user = this.$store.state.auth.user

      this.$axios
        .$get("/api/user")
        .then(response => {console.log(response)})
    },
    methods: {
      onSubmit(evt) {
        evt.preventDefault()
        console.log('okkk')
        // alert(JSON.stringify(this.form))
      }
    }
  }
</script>

<style scoped lang="scss">
  .content {
    padding: 24px;
  }


</style>
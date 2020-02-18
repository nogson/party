<template>
  <div class="content">
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
        <div class="l_flex" v-for="(skill,index) in form.skill" v-bind:key="index">
          <b-form-input v-model="skill.label" :disabled="!!skill.id" placeholder="あなたの得意なことを入力"></b-form-input>
          <b-form-select v-model="skill.level" :disabled="!!skill.id" :options="selectBoxOptions"></b-form-select>
          <b-button type="button" variant="primary" :disabled="!skill.id" @click="removeSkill(skill.id)">☓</b-button>

        </div>

        <b-button type="button" variant="primary" @click="addSkill">+</b-button>

      </b-form-group>

      <b-button type="submit" variant="primary">Submit</b-button>
    </b-form>

  </div>
</template>

<script>
  export default {
    name: "user",
    middleware: 'guest',
    layout: 'base',
    async asyncData({$axios, store}) {
      const userId = store.getters['auth/loggedUser'].id
      const res = await $axios.$get(`api/user/profile/${userId}`)
      let form = res.profile ? res.profile : {}
      form.skill = res.skill
      return {form, isNew: res.profile === null}
    },
    data() {
      return {
        isNew: false,
        form: {
          skill: []
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
    created() {
      // const userId = this.$store.getters['auth/loggedUser'].id
      //
      // this.$axios
      //   .$get(`api/user/profile/${userId}`).then(res => {
      //
      //   if (res.profile === null) {
      //     this.isNew = true
      //     return
      //   }
      //
      //   this.form = Object.assign({}, this.form, {
      //     name: res.profile.name,
      //     purpose: res.profile.purpose,
      //     skill: res.skill
      //   });
      //})
    },
    methods: {
      onSubmit(evt) {
        evt.preventDefault()

        if (this.isNew) {
          this.$axios.$post('api/user/profile', this.form).then(() => {
            this.$router.push('/')
          })
        } else {
          this.$axios.$put('api/user/profile', this.form).then(() => {
            this.$router.push('/')
          })
        }
      },
      addSkill() {
        this.form.skill.push({
          label: '',
          level: 3
        })
      },
      removeSkill(id) {
        this.$axios.$delete('api/user/profile', {params: {id: id}}).then(res => {
          this.form.skill = res
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
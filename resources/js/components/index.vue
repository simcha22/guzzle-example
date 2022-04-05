<template>
      <button @click="prosseslogin">Login</button>
      <button @click="prossesPost">getPost</button>
      <div>{{ token }}</div>
</template>

<script>
import axios from "axios"

export default {
      data() {
            return {
                  user_name: "simcha",
                  password: "Simcha1!",
                  token: '',
            }
      },
      methods: {
            prosseslogin() {
                  axios.post('/api/login', { user_name: this.user_name, password: this.password }).then((res) => {
                        console.log(res.data)
                        if (res.data.result == 'SUCCESS') {
                              //this.token = res.data.token
                              document.cookie = 'token=' + res.data.token + '; '
                              localStorage.setItem('token', res.data.token)
                        }
                  }).catch((err) => [
                        console.log(err)
                  ])
            },
            prossesPost() {
                  var cookies = document.cookie.split(";");

                  for (var i = 0; i < cookies.length; i++) {
                        var cookie = cookies[i].split("=");
                        if (cookie[0] == ` token`) {
                              this.token = cookie[1];
                        }
                  }
                  console.log(this.token);
                  debugger
                  const headers = { 'Authorization': 'Bearer ' + this.token }
                  axios.post('/api/v1/posts', { user_name: this.user_name, password: this.password }, { headers }).then((res) => {
                        console.log(res.data)
                  }).catch((err) => [
                        console.log(err)
                  ])
            }
      }
}
</script>

<style>
</style>
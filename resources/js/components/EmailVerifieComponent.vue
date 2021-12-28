<template>
  <div>
    <div class=" w-full h-screen  flex items-center">
        <div class="w-auto h-auto mx-auto relative">
            <div v-if="this.loading == true && this.errors == '' " class="w-96 h-full bg-gray-200 opacity-60 shadow-2xl flex items-center py-6 absolute">
                <div   class=" flex justify-center items-center mx-auto">
                    <div class="animate-spin rounded-full h-20 w-20 border-t-2 border-b-2 border-blue-500"></div>
                </div>
            </div>
            <div class=" w-96 h-auto bg-white shadow-2xl py-6">
                <div class="w-full h-16 flex items-center">
                    <p class="mx-auto">Veuillez saisir votre adresse email</p>
                </div>
                <div class="w-full h-4 flex items-center">
                    <p class="mx-auto text-red-500" v-if="this.errors == 'Mail incorrect'" >Email incorrect</p>
                    <p class="mx-auto text-red-500" v-if="this.errors == 'Email no exist'" >Cet email n'existe pas dans notre base de données</p>
                </div>
                <div  class=" w-full">
                    <div class="w-full h-16 flex items-center px-3">
                        <input type="email" v-model="form.email" class=" mx-auto border-2 bg-transparent appearance-none  focus:outline-none text-gray-600 px-2 w-full py-2 " placeholder="email">
                    </div>
                </div>
                <div class=" w-full flex items-center mt-4">
                    <div class=" mx-auto h-auto w-auto">
                        <button  @click="sendMail(); loading=true" class=" bg-blue-500 px-4 py-3 text-white hover:bg-blue-300 mx-auto rounded-lg">Envoyer</button>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
  </div>
</template>

<script>
export default {
    data(){
        return{
            form:{
                code: Math.floor(Math.random()*889799) + 110200,
                email:'',
            },
            errors:'',
            loading: '',
            user: {}
        }
    },
    methods:{
        sendMail(){
            axios.post('/api/send-email-password', this.form).then(response=>{
                this.user = response.data
                localStorage.setItem('email', this.form.email)
                localStorage.setItem('code', this.form.code)
                localStorage.setItem('id', this.user.id)
                
                this.$router.push('/confirmecode');
                console.log(this.data)
            }).catch(error=> this.errors= error.response.data[0].message)
        }
    }
}
</script>

<style>

</style>
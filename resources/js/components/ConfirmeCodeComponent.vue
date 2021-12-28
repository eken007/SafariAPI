<template>
    <div>
        <div class=" w-full h-screen  flex items-center">
            <div class="w-auto h-auto mx-auto relative">
                <div v-if="this.loading == true && this.message == false" class="w-96 h-full bg-gray-200 opacity-60 shadow-2xl flex items-center py-6 absolute">
                    <div   class=" flex justify-center items-center mx-auto">
                        <div class="animate-spin rounded-full h-20 w-20 border-t-2 border-b-2 border-blue-500"></div>
                    </div>
                </div>
                <div class="mx-auto w-96 h-auto bg-white shadow-2xl py-6">
                    <div class="w-full h-16 flex items-center">
                        <p class="mx-auto">Un code vous a été envoyé par email</p>
                    </div>
                    <div class="w-full h-4 flex items-center">
                        <p class="mx-auto text-red-500" v-if="this.message" >Code incorrect <button class=" text-blue-500 underline" @click="resendCode()">renvoyer le code</button></p>
                    </div>
                    <div  class=" w-full">
                        <div class="w-full h-16 flex items-center px-3">
                            <input type="text" v-model="codeverifie" class=" mx-auto border-2 bg-transparent appearance-none  focus:outline-none text-gray-600 px-2 w-full py-2 " placeholder="code">
                        </div>
                    </div>
                    <div class=" w-full flex items-center mt-4">
                        <div class=" mx-auto h-auto w-auto">
                            <button @click="sendCode(); loading=true" class=" bg-blue-500 px-4 py-3 text-white hover:bg-blue-300 mx-auto rounded-lg">Verifier</button>
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
            codeverifie: '',
            message: false,
            form:{
                code: '' ,
                email: '' ,
            },
            loading: '',
            id: ''
        }
    },
    mounted(){
        if(localStorage.getItem('email')){
            this.form.code = localStorage.getItem('code')
            this.form.email = localStorage.getItem('email')
            this.id = localStorage.getItem('id')
        } else {
             this.$router.push('/emailverifie');
        }
    },
    methods:{
        sendCode(){
            if(this.codeverifie == this.form.code){
                this.$router.push('/resetpassword')
            } else {
                this.message = true
            }
        },

        resendCode(){
            if(this.form.email){
                this.form.code = Math.floor(Math.random()*988989) + 124367,
                localStorage.setItem('code', this.form.code)
                axios.post('/api/send-email-password', this.form).then(response=>{
                console.log(this.response.data)
                }).catch(error=> console.log(error))
            }
        }
    },
}
</script>

<style>

</style>
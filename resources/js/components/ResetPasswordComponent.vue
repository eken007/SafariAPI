<template>
    <div>
        <div class=" w-full h-screen  flex items-center">
            <div class="w-auto h-auto mx-auto relative">
                <div v-if="this.loading == true && this.errors == ''" class="w-96 h-full bg-gray-200 opacity-60 shadow-2xl flex items-center py-6 absolute">
                    <div   class=" flex justify-center items-center mx-auto">
                        <div class="animate-spin rounded-full h-20 w-20 border-t-2 border-b-2 border-blue-500"></div>
                    </div>
                </div>
                <div class="mx-auto w-96 h-auto bg-white shadow-2xl py-6">
                    <div class="w-full h-16 flex items-center">
                        <p class="mx-auto">Entrer votre nouveau mot de passe</p>
                    </div>
                    <div class="w-full h-4 flex items-center">
                        <p class="mx-auto text-red-500" v-if="this.errors == 'The password confirmation does not match.'" >Mot de passe et confirme mot de passe différents</p>
                        <p class="mx-auto text-red-500" v-if="this.errors == 'The password must be at least 8 characters.'" >le mot de passe doit avoir minimum 8 charactères</p>
                    </div>
                    <div  class=" w-full space-y-3">
                        <div class="w-full h-16 flex items-center px-3">
                            <input type="text" v-model="form.password" class=" mx-auto border-2 bg-transparent appearance-none  focus:outline-none text-gray-600 px-2 w-full py-2 " placeholder="mot de passe">
                        </div>
                        <div class="w-full h-16 flex items-center px-3">
                            <input type="text" v-model="form.password_confirmation" class=" mx-auto border-2 bg-transparent appearance-none  focus:outline-none text-gray-600 px-2 w-full py-2 " placeholder="confirmer mot de passe">
                        </div>
                    </div>
                    <div class=" w-full flex items-center mt-4">
                        <div class=" mx-auto h-auto w-auto">
                            <button @click="resetPassword(); loading=true" class=" bg-blue-500 px-4 py-3 text-white hover:bg-blue-300 mx-auto rounded-lg">Verifier</button>
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
            form: {
                password: '',
                password_confirmation: ''
            },
            loading: '',
            id:'',
            errors: ''
        }
    },
    mounted(){
        if(localStorage.getItem('id')){
            this.id = localStorage.getItem('id')
        } else {
             this.$router.push('/emailverifie');
        }
    },

    methods:{
        resetPassword(){
           axios.put('/api/resetpassword/' + this.id ,this.form).then(({data}) => {
                localStorage.removeItem('id')
                localStorage.removeItem('email')
                localStorage.removeItem('code')
                this.$router.push('/');
                console.log(data)
            })
            .catch(error=> this.errors= error.response.data.errors[0])
       },
    }
}
</script>

<style>

</style>
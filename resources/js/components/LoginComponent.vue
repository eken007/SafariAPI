<template>
  <div>
    <div class="w-full h-screen relative">

        <!--loading-->
        <div v-if="loading == true && errors == ''" class="w-full h-full bg-white opacity-60 absolute items-center flex" style=" z-index: 2">
            <div  class="mx-auto  justify-center ">
                <div class=" animate-bounce h-32 w-32 border-t-2 border-b-2 border-blue-500 flex items-center">
                    <div class="  h-28 w-28 border-t-2 border-b-2 border-blue-500 mx-auto flex items-center">
                        <div class=" h-24 w-24 border-t-2 border-b-2 border-blue-500 mx-auto flex items-center">
                            <div class=" h-20 w-20 border-t-2 border-b-2 border-blue-500 mx-auto flex items-center">
                                <div class=" h-16 w-16 border-t-2 border-b-2 border-blue-500 mx-auto flex items-center">
                                    <div class=" h-12 w-12 border-t-2 border-b-2 border-blue-500 mx-auto flex items-center">
                                        <div class=" h-8 w-8 border-t-2 border-b-2 border-blue-500 mx-auto flex items-center">
                                            <div class=" h-4 w-4 border-t-2 border-b-2 border-blue-500 mx-auto flex items-center">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <!--loading-->
        <div class="flex">
            <div class="bg-gray-200 w-2/5 hidden lg:block h-screen bg-cover bg-no-repeat bg-center" style=" background-image: url('images/movies.jpg');" >
            
            </div>
            <div class="w-full h-screen flex xl:block items-center">
                <div class=" w-full">
                    <div class="w-full mt-8">
                        <p class="hidden xl:block text-right mr-8 text-sm text-gray-500">DashBoard SafariMovies</p>
                    </div>
                    <div class="w-full mt-12">
                        <p class="text-center text-gray-600 font-bold text-4xl tracking-widest">Bienvenue sur SafariMovies</p>
                    </div>
                    <div class="w-full mt-6">
                        <p class="text-center  text-sm text-gray-500"> Un clic, une histoire</p>
                    </div>
                    <div class="w-full mt-6">
                        <p class="text-center  text-sm text-red-500" v-if="this.errors">Email ou mot de passe incorrects</p>
                    </div>
            
                            <!--Email-->
            
                    <form @submit.prevent="login">
                        <div class=" mt-6 ">
                            <div class="border-l-4 border-gray-900   hover:border-blue-600 flex md:w-3/6 w-5/6  shadow-lg mx-auto transform hover:scale-110 motion-reduce:transform-none">
                                <div  class="w-full">
                                        <div class="relative">
                                            <input v-model="form.email" class="border-0 bg-transparent appearance-none  focus:outline-none text-gray-600 px-2 min-w-full py-4 " placeholder="iuc@gmail.com">
                                        </div>
                                </div>
                            </div> 
                                            
                            <!--Password-->
            
                            <div class="border-l-4 border-gray-900 hover:border-blue-600 flex md:w-3/6 w-5/6  shadow-lg mx-auto mt-6 transform hover:scale-110 motion-reduce:transform-none">
                                <div class="w-full">
                                        <div class="relative">
                                            <input v-model="form.password" type="password" class="border-0  bg-transparent appearance-none block focus:outline-none text-gray-600 px-2 min-w-full py-4"  placeholder="password">
                                            <router-link to="/emailverifie" class="absolute hover:text-blue-500 text-sm top-0 right-0 mt-4 mr-2" href="">Oublier</router-link>
                                        </div>
                                </div>
                            </div>
            
                                            <!--btn connexion-->
                            <div class="flex mt-6 " >
                                <div class="mx-auto transform hover:scale-110 motion-reduce:transform-none">
                                    <button type="submit" @click="loading=true"  class="px-4 py-3 bg-blue-600  rounded-full text-sm text-white  hover:bg-blue-300 shadow-lg w-48 text-center font-bold">Connexion </button>
                                </div>
                            </div>
                        </div>
                    </form>    
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
                email: '',
                password: ''
            },
            errors: '',
            loading: ''
        }
    },

    mounted(){
        if(localStorage.getItem('jwtToken')){
            this.$router.push('/accueil');
        }
    },
    methods: {
        login(){
           axios.post('/api/login', this.form).then(({data}) => {
                if(data){ 
                localStorage.setItem('jwtToken', data.access_token.token)
                this.$router.push('/accueil');
                this.$router.go();
                } 
            })
            .catch(error=> this.errors= error.response.data)
       },

       emailVerifie(){
           this.$router.push('/emailverifie');
            this.$router.go();
       }
    }
}
</script>

<style>

</style>
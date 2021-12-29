<template>
    <div>
    <!--Partie episode-->
    <transition name="slide-fade">
        <div v-show="hidden" class=" fixed flex items-center" style=" z-index:5; width: 100%; height: 80%">
            <div class="w-full h-screen mx-auto relative">
            <div class="bg-white backdrop-filter backdrop-blur-lg opacity-75 w-full h-full absolute"></div>
            <div class="w-full h-full relative  mx-auto" style=" z-index: 5;">
                <div class=" w-4/5 h-full flex items-center">
                    <div class="md:w-2/5 w-4/5 mt-3 mx-auto " style=" z-index: 5;">
                    <div class=" w-full h-auto pb-2 mt-16 items-center bg-white shadow-2xl rounded-xl" style=" z-index: 5;">
                        <!--header-->
                        <div class="w-full font-bold text-xl flex">
                            <p class="mx-auto text-white"></p>
                            <button @click="hidden = false"  class="bg-blue-500 flex items-center text-white h-8 w-8 rounded-full transform -translate-y-6 translate-x-4">
                                <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                            </button>
                            
                        </div>

                        <!--body-->
                        
                        <div class="w-full h-auto px-2">
                             <div class="w-full h-auto flex">
                                <div class="w-auto h-auto space-y-3 mx-auto">
                                    
                                    <div >
                                        <div class="flex w-full h-auto">
                                            <div v-if="loading == 'non' && this.errors == ''" class="flex w-full h-auto" >
                                                <div  class=" flex justify-center items-center mx-auto">
                                                    <div class="animate-spin rounded-full h-20 w-20 border-t-2 border-b-2 border-blue-500"></div>
                                                </div>
                                            </div>
                                            <div v-if="this.errors == 'Episode exist'" class="flex w-full h-auto" >
                                                <div  class=" flex justify-center items-center mx-auto">
                                                    <p class=" text-red-500">cet episode existe</p>
                                                </div>
                                            </div>
                                            <svg v-if="loading == 'oui'" class="w-20 h-20 mx-auto mb-4 rounded-full border-blue-500 border-2" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
                                                <circle style="fill:#fff;" cx="25" cy="25" r="25"/>
                                                <polyline style="fill:none;stroke:#5962DF;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" points="
                                                    38,15 22,33 12,25 "/>
                                            </svg>
                                        </div>
                                        <p class=" text-center text-sm text-gray-500">Vous allez Ajouter un episode</p>
                                        <form @submit.prevent="addEpisode" class=" space-y-6">
                                            <div class="w-full h-full mt-4 space-y-3">
                                                <select  v-model="form.nom"  class="border w-full h-full bg-white text-black py-2 px-3 text-grey-800">
                                                    <option  value="">Choisissez une saison</option>
                                                    <option v-for="saison in 100" :key="saison">Episode {{saison}}</option>
                                                </select>
                                                <div>
                                                    <input v-model="form.titre" class="border-2 bg-transparent appearance-none  focus:outline-none text-gray-600 px-2 min-w-full py-2 " placeholder="titre">
                                                </div>
                                                <div>
                                                    <input v-model="form.qualite" class="border-2 bg-transparent appearance-none  focus:outline-none text-gray-600 px-2 min-w-full py-2 " placeholder="qualite">
                                                </div>
                                                <div>
                                                    <input v-model="form.duree" class="border-2 bg-transparent appearance-none  focus:outline-none text-gray-600 px-2 min-w-full py-2 " placeholder="duree">
                                                </div>
                                                <div class=" w-full h-20 space-y-3">
                                                    <div class="flex w-full">
                                                        <div class=" w-1/2 ">
                                                            <label class=" ">Video</label>
                                                        </div>
                                                        <div class=" w-1/2 relative">
                                                            <button class="  bg-red-500 text-white rounded-xl absolute right-2 px-3" v-if="this.form.video"  @click="removeVideo">effacer</button>
                                                        </div>
                                                    </div>
                                                    <input @change="onVideoFile" type="file" class=" mt-2 border-2 bg-transparent appearance-none  focus:outline-none text-gray-600 px-2 w-full py-2 ">
                                                </div>
                                            </div>
                                            <div class=" w-full flex">
                                                <button @click="loading = 'non'" class=" bg-blue-500 px-4 py-3 text-white hover:bg-blue-300 mx-auto rounded-lg">Enregistrer</button>
                                            </div>
                                        </form>
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
    </transition>
        <div class=" h-16 bg-gray-900 shadow-2xl flex fixed px-2" style=" width: 80%;">
           <div class=" w-1/4 h-full flex items-center">
                <router-link to="/Series"><img  class="w-8 h-8 ml-4" src="images/return.png" alt=""></router-link>
           </div>        
          <div class=" w-2/4 h-full flex items-center">
              <p class=" mx-auto text-white text-3xl font-semibold">{{saisons.nom}}</p>
          </div>
          <div class=" w-1/4 h-full flex items-center">
              <div class="h-10 mx-auto space-x-3 flex">
                    <button>
                        <div class=" w-10 h-10 rounded-full bg-blue-500 flex items-center">
                            <p @click="hidden = true" class="mx-auto mb-2 text-white text-4xl">+</p>
                        </div>
                    </button>
              </div>
          </div>
        </div>
        <div class=" w-full">
            <div class=" w-full h-16"></div>

            <!--Episodes-->
                    <div class=" w-full bg-white flex flex-wrap overflow-hidden overflow-y-visible" style=" height: 35rem">
                        <div class=" w-36 h-44 ml-6 mt-6 space-y-4 relative" v-for="episode in episodes" :key="episode.id">
                            <button @click="deleteEpisode(episode.id)"  class="bg-red-500 flex items-center text-white h-8 w-8 rounded-full  absolute right-0 top-6">
                                <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                            <div class=" w-36 h-44 ml-6 mt-6 space-y-6">
                                <div class=" w-full h-1/2 flex">
                                    <img class=" w-28 h-28 mx-auto" src="images/vlc1.png">
                                </div>
                                <div class=" w-full h-1/2 flex">
                                    <div class="w-28 h-28 mx-auto">
                                        <p class=" font-semibold text-center text-sm">{{episode.nom}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['saison'],
    data(){
        return{
            hidden: '',
            loading: '',
            form:{
                nom: '',
                titre: '',
                video: null,
                qualie: '',
                duree: '',
                id: this.saison,
            },
            episodes:{},
            saisons: {},
            errors: ''
        }
    },
    mounted(){
        axios.get('/api/allepisodes/' + this.form.id).then(({data})=>{
                this.episodes = data[0]
                this.saisons = data[1][0]
                this.loading = false
                console.log(data)
        }).catch(error=> console.log(error))
    },
    methods:{
        addEpisode(){
            let episode = new FormData();
            episode.append('nom', this.form.nom);
            episode.append('titre', this.form.titre);
            episode.append('qualite', this.form.titre);
            episode.append('duree', this.form.titre);
            episode.append('saison_id', this.form.id);
            episode.append('video', this.form.video);
            axios.post('/api/saveepisodeserie', episode).then(({data})=>{
                this.episodes = data
                this.loading = 'oui'
                this.errors= ''
                console.log(data)
            }).catch(error=> this.errors= error.response.data.message)
        },
        onVideoFile(video) {
            console.log("video", video.target.files[0])
            this.form.video = video.target.files[0]
        },
        removeVideo: function (e) {
            this.form.video = '';
        },

        deleteEpisode(id){
            axios.delete('/api/deleteepisodeserie/' + id).then(({data})=>{
                this.episodes = data
                console.log(data)
            }).catch(error=> console.log(error))
        },
    }
}
</script>

<style>

</style>
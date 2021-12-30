<template>
  <div>
        <!--Partie edite-->
  <transition name="slide-fade">
        <div v-show="hidden" class=" fixed flex items-center" style=" z-index:5; width: 100%; height: 80%">
            <div class="w-full h-screen mx-auto relative">
            <div class="bg-white backdrop-filter backdrop-blur-lg opacity-75 w-full h-full absolute"></div>
            <div class="w-full h-full relative  mx-auto" style=" z-index: 5;">
                <div class=" w-4/5 h-full flex items-center">
                    <div class="md:w-2/5 w-4/5 mx-auto h-5/6" style=" z-index: 5;">
                    <div class=" w-full mt-8 pb-2 py-3  items-center bg-white  shadow-2xl overflow-hidden overflow-y-visible" style=" z-index: 5; height: 37rem">
                        <!--header-->
                        <div class="w-full  font-bold text-xl flex">
                            <p class="mx-auto text-white"></p>
                            <button @click="hidden = false"  class="bg-blue-500 flex items-center text-white h-8 w-8 rounded-full ">
                                <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                            </button>
                            
                        </div>

                        <!--body-->
                        
                        <div class="w-full  px-2">
                             <div class="w-full h-full flex ">
                                <div class="w-auto h-full space-y-3 mx-auto ">
                                        <div class="flex w-full h-auto" >
                                            <div v-if="AddLoading == 'non'" class="flex w-full h-auto" >
                                                <div  class=" flex justify-center items-center mx-auto">
                                                    <div class="animate-spin rounded-full h-20 w-20 border-t-2 border-b-2 border-blue-500"></div>
                                                </div>
                                            </div>
                                            <svg v-if="AddLoading == 'oui'" class="w-20 h-20 mx-auto mb-4 rounded-full border-blue-500 border-2" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
                                                <circle style="fill:#fff;" cx="25" cy="25" r="25"/>
                                                <polyline style="fill:none;stroke:#5962DF;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" points="
                                                    38,15 22,33 12,25 "/>
                                            </svg>
                                        </div>
                                        <p class=" text-center text-sm text-gray-500">Vous allez ajouter une Web serie</p>
                                        <form @submit.prevent="addWebSerie" class=" space-y-6">
                                            <div class="w-full h-full mt-4 space-y-3">
                                                <div>
                                                    <input v-model="form.titre" class="border-2 bg-transparent appearance-none  focus:outline-none text-gray-600 px-2 min-w-full py-2 " placeholder="titre">
                                                </div>
                                                <div>
                                                    <label>date de sortie</label>
                                                    <input v-model="form.date_de_sortie" type="date" class="border-2 mt-2 bg-transparent appearance-none  focus:outline-none text-gray-600 px-2 min-w-full py-2 ">
                                                </div>
                                                <div>
                                                    <input v-model="form.description" class="border-2 bg-transparent appearance-none  focus:outline-none text-gray-600 px-2 min-w-full py-2 " placeholder="description">
                                                </div>
                                                <div>
                                                    <input v-model="form.age" type="number" class="border-2 bg-transparent appearance-none  focus:outline-none text-gray-600 px-2 min-w-full py-2 " placeholder="age">
                                                </div>
                                                <div>
                                                    <div class="flex w-full">
                                                        <div class=" w-1/2 ">
                                                            <label class=" ">image premier plan</label>
                                                        </div>
                                                        <div class=" w-1/2 relative">
                                                            <button class="  bg-red-500 text-white rounded-xl absolute right-2 px-3" v-if="this.form.image"  @click="removeImage">effacer</button>
                                                        </div>
                                                    </div>
                                                    <input @change="onImageFile" type="file" class="mt-2 border-2 bg-transparent appearance-none  focus:outline-none text-gray-600 px-2 w-full py-2 ">
                                                </div>
                                                <div>
                                                    <div class="flex w-full">
                                                        <div class=" w-1/2 ">
                                                            <label class=" ">image pub</label>
                                                        </div>
                                                        <div class=" w-1/2 relative">
                                                            <button class="  bg-red-500 text-white rounded-xl absolute right-2 px-3" v-if="this.form.pub"  @click="removePub">effacer</button>
                                                        </div>
                                                    </div>
                                                    <input @change="onPubFile" type="file" class="mt-2 border-2 bg-transparent appearance-none  focus:outline-none text-gray-600 px-2 w-full py-2 ">
                                                </div>
                                            </div>
                                            <div class=" w-full flex">
                                                <button @click=" AddLoading = 'non'" type="submit" class=" bg-blue-500 px-4 py-3 text-white hover:bg-blue-300 mx-auto rounded-lg">Sauvegader</button>
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
    </transition>

    <!--Bar search-->
      <div class=" h-16 bg-gray-900 shadow-2xl flex fixed px-2" style=" width: 80%;">
           <div class=" w-1/4 h-full flex items-center">
                <p class=" text-2xl font-semibold text-white">Web Series</p>
           </div>        
          <div class=" w-2/4 h-full flex items-center">
              <div class=" w-full mx-auto">
                  <div class="flex items-center">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2 text-gray-600" fill="none" viewBox="0 0 24 24"
                          stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                      </svg>
                      <input @keyup="search" v-model="titre" type="text" name="name" placeholder="name"
                          class="w-full py-2 border-b-2 bg-gray-900 text-white border-gray-400 outline-none focus:border-blue-500">
                  </div>
              </div>
          </div>
          <div class=" w-1/4 h-full flex items-center">
              <div class="h-10 mx-auto">
                  <button>
                    <div class=" w-10 h-10 rounded-full bg-blue-500 flex items-center">
                        <p @click="hidden = true" class="mx-auto mb-2 text-white text-4xl">+</p>
                    </div>
                  </button>
              </div>
          </div>
      </div>

    <!--Tout les Series-->
        <div class=" w-full">
            <div class=" w-full h-16"></div>
        <!--Partie Loading page-->
        <div v-if="this.loading"  class="w-full h-full fixed flex items-center bg-gray-300 opacity-60">
            <div class="justify-center w-1/2 relative">
                <div class="animate-spin rounded-full h-32 w-32 border-t-2 border-b-2 absolute right-10 bottom-0 border-purple-500"></div>
            </div>
        </div>
            <div  class=" w-full flex-wrap flex overflow-hidden overflow-y-visible" style=" height: 35rem;">
                <div class=" w-36 h-44 ml-6 mt-6 space-y-4 relative" v-for="serieWeb in seriesWeb" :key="serieWeb.id">
                    <button @click="deleteWebSeie(serieWeb.id)"  class="bg-red-500 flex items-center text-white h-8 w-8 rounded-full  absolute right-1 top-8">
                        <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    <router-link :to="{name:'detailwebserie', params:{serie: serieWeb.id} }" class=" w-36 h-44 ml-6 mt-6 space-y-4">
                        <div class=" w-full h-1/2 flex">
                            <img class=" w-28 h-28 mx-auto" src="images/folder.png">
                        </div>
                        <div class=" w-full h-1/2 flex">
                            <div class="w-28 h-28 mx-auto">
                                <p class=" font-semibold text-center text-sm">{{serieWeb.titre}}</p>
                            </div>
                        </div>
                    </router-link>
                </div>
            </div>
        </div>
  </div>
</template>

<script>
export default {
    data(){
        return{
            titre: '',
            seriesWeb : {},
            loading: true,
            hidden: false,
            AddLoading: '',
            form: {
                titre: '',
                date_de_sortie: '',
                description:'',
                age: '',
                image: null,
                pub: null,
            }
        }
    },
    mounted(){
        axios.get('/api/allwebserie').then(({data})=>{
                this.seriesWeb = data
                this.loading = false
                console.log(this.data)
        }).catch(error=> console.log(error))
    },
    methods:{
        search(){
            if(this.titre.length > 0){
                axios.get('/api/searchwebserie/'+ this.titre).then(({data})=>{
                        this.seriesWeb = data
                }).catch(error=> console.log(error)) 
            }else{
                axios.get('/api/searchwebserie/'+ this.titre).then(({data})=>{
                        this.seriesWeb = data
                }).catch(error=> console.log(error)) 
            }
        },
        onImageFile(image) {
            console.log("image premier plan", image.target.files[0])
            this.form.image = image.target.files[0]
        },
        onPubFile(pub) {
            console.log("image pub", pub.target.files[0])
            this.form.pub = pub.target.files[0]
        },
        addWebSerie(){
            let webserie = new FormData();
            webserie.append('titre', this.form.titre);
            webserie.append('date_de_sortie', this.form.date_de_sortie);
            webserie.append('qualite', this.form.qualite);
            webserie.append('description', this.form.description);
            webserie.append('age', this.form.age);
            webserie.append('pub', this.form.pub);
            webserie.append('image', this.form.image);
            webserie.append('video', this.form.video);
            axios.post('/api/savewebserie',webserie).then(({data})=>{
                this.seriesWeb = data
                this.AddLoading = 'oui'
                console.log(this.data)
            }).catch(error=> console.log(error))
        },
        
        removeVideo: function (e) {
            this.form.video = '';
        },
        removeImage: function (e) {
            this.form.image = '';
        },
        removePub: function (e) {
            this.form.pub = '';
        },

        deleteWebSeie(id) {
            axios.delete('/api/deletewebserie/' + id).then(({data})=>{
                this.seriesWeb = data
                console.log(data)
            }).catch(error=> console.log(error))
        },
    },
}
</script>

<style>

</style>